<?php

namespace App\Domains\useCases;

use App\Models\Project;
use App\Repositories\FileRepository;
use App\Utils\FileArchiveExtractor;
use App\Utils\FileInspector;

class StoreFiles
{

    /**
     * @var FileArchiveExtractor
     */
    private FileArchiveExtractor $fileArchiveExtractor;

    /**
     * @var FileInspector
     */
    private FileInspector $fileInspector;

    /**
     * @var FileRepository
     */
    private FileRepository $fileRepository;


    public function __construct(
        FileArchiveExtractor $fileArchiveExtractor,
        FileInspector $fileInspector,
        FileRepository $fileRepository
    )
    {
        $this->fileInspector = $fileInspector;
        $this->fileArchiveExtractor = $fileArchiveExtractor;
        $this->fileRepository = $fileRepository;
    }

    public function handle(string $repo)
    {
        $repo = trim($repo, '/');

        $url = 'https://github.com/' . $repo;
        $project = Project::query()->where('url', $url)->first();

        $downloadUrl = 'https://api.github.com/repos/' . $repo .'/zipball';

        $archivedFilePath = $this->fileArchiveExtractor->downloadAndExtract($downloadUrl);

        $rootDirs = $this->fileInspector->getDir($archivedFilePath);
        $baseDir = $rootDirs[0] ?? null;
        if (!$baseDir) {
            throw new \Exception('Something went wrong');
        }

        $files = $this->fileInspector->getDirContents($archivedFilePath);

        $fileModelOfFiles = collect($files)
            ->filter(fn(\SplFileInfo $file) => $file->isDir() && $file->getRealPath() !== $baseDir)
            ->map(fn(\SplFileInfo $file) => $this->fileRepository->updateOrCreate($file, $project->id, $baseDir));

        $fileModelOfFiles = collect($files)
            ->filter(fn(\SplFileInfo $file) => $file->isFile())
            ->map(fn(\SplFileInfo $file) => $this->fileRepository->updateOrCreate($file, $project->id, $baseDir));

        $this->fileArchiveExtractor->deleteDir($archivedFilePath);
    }

}

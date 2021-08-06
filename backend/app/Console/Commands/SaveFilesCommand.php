<?php

namespace App\Console\Commands;

use App\Models\File;
use App\Models\Project;
use App\Repositories\FileRepository;
use App\Utils\FileArchiveExtractor;
use App\Utils\FileInspector;
use Illuminate\Console\Command;

class SaveFilesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index-code:save-files {repo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        FileArchiveExtractor $fileArchiveExtractor,
        FileInspector $fileInspector,
        FileRepository $fileRepository
    )
    {

        parent::__construct();

        $this->fileInspector = $fileInspector;
        $this->fileArchiveExtractor = $fileArchiveExtractor;
        $this->fileRepository = $fileRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $repo = $this->argument('repo');
        $repo = trim($repo, '/');

        $url = 'https://github.com/' . $repo;
        $project = Project::query()->where('url', $url)->first();

        $downloadUrl = 'https://api.github.com/repos/' . $repo .'/zipball';

        $archivedFilePath = $this->fileArchiveExtractor->downloadAndExtract($downloadUrl);

        $rootDirs = $this->fileInspector->getDir($archivedFilePath);
//        $rootDirs = $this->fileInspector->getDir(storage_path('app/temp'));
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

        return 0;
    }
}

<?php

namespace App\Console\Commands;

use App\Models\File;
use App\Models\Project;
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
    private $fileArchiveExtractor;

    /**
     * @var FileInspector
     */
    private $fileInspector;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        FileArchiveExtractor $fileArchiveExtractor,
        FileInspector $fileInspector
    )
    {

        parent::__construct();

        $this->fileInspector = $fileInspector;
        $this->fileArchiveExtractor = $fileArchiveExtractor;
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
            ->filter(fn(\SplFileInfo $file) => $file->isDir())
            ->filter(fn(\SplFileInfo $file) => $file->getRealPath() !== $baseDir)
            ->map(fn(\SplFileInfo $file) =>
                File::updateOrCreate([
                    'project_id' => $project->id,
                    'file_path' => ltrim(str_replace($baseDir, '', $file->getRealPath()), DIRECTORY_SEPARATOR),
                ], [
                    'project_id' => $project->id,
                    'name'=> $file->getFilename(),
                    'file_path' => ltrim(str_replace($baseDir, '', $file->getRealPath()), DIRECTORY_SEPARATOR),
                    'path' => ltrim(str_replace($baseDir, '', $file->getPath()), DIRECTORY_SEPARATOR),
                    'is_dir' => true,
                    'depth' => substr_count(str_replace($baseDir, '', $file->getPath()), DIRECTORY_SEPARATOR),
                ])
            );

        $fileModelOfFiles = collect($files)
            ->filter(fn(\SplFileInfo $file) => $file->isFile())
            ->map(function (\SplFileInfo $file) use ($project, $baseDir) {
                $path = ltrim(str_replace($baseDir, '', $file->getPath()), DIRECTORY_SEPARATOR);
                $fileModel = File::query()
                    ->where('project_id', $project->id)
                    ->where('file_path', $path)
                    ->first();

                return File::updateOrCreate([
                    'project_id' => $project->id,
                    'file_path' => ltrim(str_replace($baseDir, '', $file->getRealPath()), DIRECTORY_SEPARATOR),
                ], [
                    'project_id' => $project->id,
                    'name'=> $file->getFilename(),
                    'file_path' => ltrim(str_replace($baseDir, '', $file->getRealPath()), DIRECTORY_SEPARATOR),
                    'path' => $path,
                    'extension' => $file->getExtension() ?? '',
                    'parent_id' => $fileModel ? $fileModel->id : null,
                    'is_dir' => false,
                    'depth' => substr_count(str_replace($baseDir, '', $file->getPath()), DIRECTORY_SEPARATOR),
                ]);
            });

        $this->fileArchiveExtractor->deleteDir($archivedFilePath);


        return 0;
    }
}

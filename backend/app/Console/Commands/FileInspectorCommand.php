<?php

namespace App\Console\Commands;

use DirectoryIterator;
use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class FileInspectorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'file:inspector';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tempDir = storage_path('app/temp');

        // https://stackoverflow.com/questions/24783862/list-all-the-files-and-folders-in-a-directory-with-php-recursive-function/24784144
//        $result = $this->dirtree($tempDir);
//        var_dump($result);

        $result = $this->getDirContents($tempDir);
        var_dump($result);

//        $result = $this->getDireContents($tempDir);
//        var_dump($result);

        return 0;
    }

    private function dirtree($dir, $regex = '', $ignoreEmpty = false)
    {
        if (!$dir instanceof DirectoryIterator) {
            $dir = new DirectoryIterator((string)$dir);
        }
        $dirs = array();
        $files = array();
        foreach ($dir as $node) {
            if ($node->isDir() && !$node->isDot()) {
                $tree = $this->dirtree($node->getPathname(), $regex, $ignoreEmpty);
                if (!$ignoreEmpty || count($tree)) {
                    $dirs[$node->getFilename()] = $tree;
                }
            } elseif ($node->isFile()) {
                $name = $node->getFilename();
                if ('' == $regex || preg_match($regex, $name)) {
                    $files[] = $name;
                }
            }
        }
        asort($dirs);
        sort($files);

        return array_merge($dirs, $files);
    }

    private function getDirContents($dir, &$results = [])
    {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                $this->getDirContents($path, $results);
                $results[] = $path;
            }
        }

        return $results;
    }

    private function getDireContents($path)
    {
        $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

        $files = array();
        foreach ($rii as $file)
            if (!$file->isDir())
                $files[] = $file->getPathname();

        return $files;
    }

}

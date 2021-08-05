<?php

namespace App\Utils;

use Illuminate\Support\Facades\File;

class FileInspector
{

    public function getDirContents($dir, &$results = [])
    {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = new \SplFileInfo($path);
            } else if ($value != "." && $value != "..") {
                $this->getDirContents($path, $results);
                $results[] = new \SplFileInfo($path);
            }
        }

        return $results;
    }

    public function getDir($dir): array
    {
        return File::directories($dir);
    }

}

<?php

namespace App\Utils;

use Illuminate\Support\Facades\File;
use ZipArchive;

class FileArchiveExtractor
{

    /**
     * @throws \Exception
     */
    public static function downloadAndExtract($url): string
    {
        return static::unzip(static::download($url));
    }

    public static function download($url)
    {
        $options = [
            'http' => [
                'method' => 'GET',
                'header' => [
                    'User-Agent: PHP'
                ]
            ]
        ];
        $context = stream_context_create($options);
        $data = file_get_contents($url, false, $context);

        // Create temp directory
        $tmpDir = storage_path('app/temp-'.md5(mt_rand()));

        if (!File::isDirectory($tmpDir)) {
            File::makeDirectory($tmpDir);
        }

        $zipFilePath = $tmpDir.'/archive.zip';

        $download = is_int(file_put_contents($zipFilePath, $data)) ? true : false;

        if (!$download) {
            return false;
        }

        return $zipFilePath;
    }

    public static function unzip($zipFilePath)
    {
        if (!file_exists($zipFilePath)) {
            throw new \Exception('Zip file not found');
        }

        $tmpExtractDir = storage_path('app/temp2-'.md5(mt_rand()));

        if (!File::isDirectory($tmpExtractDir)) {
            File::makeDirectory($tmpExtractDir);
        }

        // Unzip the file
        $zip = new ZipArchive();

        if ($zip->open($zipFilePath)) {
            $zip->extractTo($tmpExtractDir);
        }

        $zip->close();

        // Delete zip file
        static::deleteDir(dirname($zipFilePath));

        return $tmpExtractDir;
    }

    public static function deleteDir($dir): bool
    {
        return File::deleteDirectory($dir);
    }
}

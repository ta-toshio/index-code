<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ZipArchive;

class ArchiveExtractorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'file:extract';

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
        // https://github.com/EC-CUBE/ec-cube/archive/refs/heads/4.1-beta2.zip
        $url = 'https://github.com/EC-CUBE/ec-cube/archive/refs/heads/4.0.zip';

        if (!$path = $this->download($url)) {
            return 1;
        }

        if (!$path = $this->unzip($path)) {
            return 1;
        }

        $this->info('done');
        return 0;
    }

    private function download($url)
    {
        $data = file_get_contents($url);

        // Create temp directory
        $temp_dir = storage_path('app/temp-' . md5(mt_rand()));

        if (!File::isDirectory($temp_dir)) {
            File::makeDirectory($temp_dir);
        }

        $zip_file_path = $temp_dir . '/archive.zip';

        // Add content to the Zip file
        $uploaded = is_int(file_put_contents($zip_file_path, $data)) ? true : false;

        if (!$uploaded) {
            return false;
        }

        return $zip_file_path;
    }

    public static function unzip($zip_file_path)
    {
        if(!file_exists($zip_file_path)) {
            throw new \Exception('Zip file not found');
        }

        $temp_extract_dir = storage_path('app/temp2-' . md5(mt_rand()));

        if (!File::isDirectory($temp_extract_dir)) {
            File::makeDirectory($temp_extract_dir);
        }
        // Unzip the file
        $zip = new ZipArchive();

        if ($zip->open($zip_file_path)) {
            $zip->extractTo($temp_extract_dir);
        }

        $zip->close();

        // Delete zip file
        File::delete($zip_file_path);

        return $temp_extract_dir;
    }
}

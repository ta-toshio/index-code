<?php

namespace App\Console\Commands;

use App\Domains\useCases\StoreFiles;
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
     * @var StoreFiles
     */
    private StoreFiles $storeFiles;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(StoreFiles $storeFiles)
    {
        parent::__construct();

        $this->storeFiles = $storeFiles;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $repo = $this->argument('repo');

        $this->storeFiles->handle($repo);

        return 0;
    }

}

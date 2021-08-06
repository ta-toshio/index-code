<?php

namespace App\Console\Commands;

use App\Domains\useCases\StoreFile;
use Illuminate\Console\Command;

class StoreFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index-code:store-file {repo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var StoreFile
     */
    private StoreFile $storeFile;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(StoreFile $storeFile)
    {
        parent::__construct();

        $this->storeFile = $storeFile;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $repo = $this->argument('repo');

        $this->storeFile->handle($repo);

        return 0;
    }

}

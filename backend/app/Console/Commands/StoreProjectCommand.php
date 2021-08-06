<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class StoreProjectCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index-code:store-project {repo}';

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
        // 'https://github.com/EC-CUBE/ec-cube';
        // $url = 'https://api.github.com/repos/EC-CUBE/ec-cube';

        $repo = $this->argument('repo');
        $repo = trim($repo, '/');
        $url = 'https://api.github.com/repos/'.$repo;

        $response = Http::get($url);
        $json = $response->json();

        $data = [
            'name' => $json['full_name'],
            'url' => $json['html_url'],
        ];

        $commitUrl = $url.'/commits?per_page=1';
        $response = Http::get($commitUrl);
        $json = $response->json();

        $data['version'] = $json[0]['sha'];

        Project::updateOrCreate([
            'url' => $data['url'],
        ], $data);

        return 0;
    }
}

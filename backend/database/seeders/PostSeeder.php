<?php

namespace Database\Seeders;

use App\Models\EnPost;
use App\Models\JaPost;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        JaPost::factory()
//            ->count(200)
//            ->create();
        EnPost::factory()
            ->count(200)
            ->create();
    }
}

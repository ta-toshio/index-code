<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{

    public function findByUrl(string $url): Project|null
    {
        return Project::query()->where('url', $url)->first();
    }

}

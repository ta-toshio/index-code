<?php

namespace App\Repositories;

use App\Models\Klass;

class KlassRepository
{

    public function updateOrCreate(int $fileId, string $name, array $data = []): Klass
    {
        return Klass::updateOrCreate(
            [
                'file_id' => $fileId,
                'name' => $name,
            ],
            array_merge(
                [
                    'file_id' => $fileId,
                    'name' => $name,
                ],
                $data
            )
        );
    }

}

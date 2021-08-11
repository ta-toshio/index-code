<?php

namespace App\Repositories;

use App\Models\Attribute;

class AttributeRepository
{

    public function updateOrCreate(int $fileId, int|null $klassId, string $name, array $data = []): Attribute
    {
        return Attribute::updateOrCreate(
            [
                'file_id' => $fileId,
                'klass_id' => $klassId,
                'name' => $name,
            ],
            array_merge(
                [
                    'file_id' => $fileId,
                    'klass_id' => $klassId,
                    'name' => $name,
                ],
                $data
            )
        );
    }

}

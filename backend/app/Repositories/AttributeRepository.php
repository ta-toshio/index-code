<?php

namespace App\Repositories;

use App\Models\Attribute;

class AttributeRepository
{

    public function updateOrCreate(int $klassId, string $name, array $data = []): Attribute
    {
        return Attribute::updateOrCreate(
            [
                'klass_id' => $klassId,
                'name' => $name,
            ],
            array_merge(
                [
                    'klass_id' => $klassId,
                    'name' => $name,
                ],
                $data
            )
        );
    }

}

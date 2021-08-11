<?php
declare(strict_types=1);

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreateAttributesIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::create('attributes', function (Mapping $mapping, Settings $settings) {
            $mapping->integer('file_id');
            $mapping->integer('klass_id');
            $mapping->text('name',
                [
                    'fields' => [
                        'keyword' => [
                            'type' => 'keyword',
                            'ignore_above' => 256,
                        ]
                    ]

                ]
            );
            $mapping->keyword('type');
            $mapping->short('start_line');
            $mapping->text('description');
            $mapping->date('created_at');
            $mapping->date('updated_at');
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::dropIfExists('attributes');
    }
}

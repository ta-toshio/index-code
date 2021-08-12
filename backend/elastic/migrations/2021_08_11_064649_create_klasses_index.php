<?php
declare(strict_types=1);

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreateKlassesIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::create('klasses', function (Mapping $mapping, Settings $settings) {
            $mapping->integer('file_id');
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
            $mapping->text('namespace',
                [
                    'fields' => [
                        'keyword' => [
                            'type' => 'keyword',
                            'ignore_above' => 256,
                        ]
                    ]

                ]
            );
            $mapping->text('description');
            $mapping->short('existing');
            $mapping->integer('parent_id');
            $mapping->date('created_at');
            $mapping->date('updated_at');
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::dropIfExists('klasses');
    }
}

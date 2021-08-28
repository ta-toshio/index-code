<?php
declare(strict_types=1);

use App\Utils\ElasticMigrationHelper;
use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreateAttributesIndex implements MigrationInterface
{
    use ElasticMigrationHelper;

    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::create('attributes', function (Mapping $mapping, Settings $settings) {
            $this->applyAnalysis($settings);

            $mapping->text('search_title', [
                'analyzer' => 'content_analyzer',
                'fields' => [
                    'keyword' => [
                        'type' => 'keyword',
                        'ignore_above' => 256,
                    ]
                ]
            ]);

            $mapping->text('search_subtitle', [
                'analyzer' => 'path_analyzer',
                'fields' => [
                    'hierarchy' => [
                        'type' => 'text',
                        'analyzer' => 'path_hierarchy_analyzer',
                    ],
                    'keyword' => [
                        'type' => 'keyword',
                    ],
                ]
            ]);

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

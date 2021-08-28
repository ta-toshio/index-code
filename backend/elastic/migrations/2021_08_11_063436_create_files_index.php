<?php
declare(strict_types=1);

use App\Utils\ElasticMigrationHelper;
use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreateFilesIndex implements MigrationInterface
{
    use ElasticMigrationHelper;

    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::create('files', function (Mapping $mapping, Settings $settings) {
            $this->applyAnalysis($settings);

            $mapping->text('search_title', [
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

            $mapping->integer('project_id');
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
            $mapping->text('file_path',
                [
                    'fields' => [
                        'keyword' => [
                            'type' => 'keyword',
                            'ignore_above' => 256,
                        ]
                    ]

                ]
            );
            $mapping->text('path',
                [
                    'fields' => [
                        'keyword' => [
                            'type' => 'keyword',
                            'ignore_above' => 256,
                        ]
                    ]

                ]
            );
            $mapping->text('body');
            $mapping->keyword('extension');
            $mapping->text('description');
            $mapping->integer('parent_id');
            $mapping->boolean('is_dir');
            $mapping->short('depth');
            $mapping->date('created_at');
            $mapping->date('updated_at');
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::dropIfExists('files');
    }
}

<?php
declare(strict_types=1);

use App\Utils\ElasticMigrationHelper;
use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreateTablesIndex implements MigrationInterface
{
    use ElasticMigrationHelper;

    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::create('tables', function (Mapping $mapping, Settings $settings) {
            $this->applyAnalysis($settings);

            $mapping->text('search_title', [
                'analyzer' => 'content_analyzer',
            ]);
            $mapping->text('search_subtitle', [
                'analyzer' => 'content_analyzer',
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
            $mapping->date('created_at');
            $mapping->date('updated_at');
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::dropIfExists('tables');
    }
}

<?php
declare(strict_types=1);

use App\Utils\ElasticMigrationHelper;
use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreateCodeIndex implements MigrationInterface
{
    use ElasticMigrationHelper;

    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::create('codes', function (Mapping $mapping, Settings $settings) {
            $this->applyAnalysis($settings);

            $mapping->text('search_title', [
                'analyzer' => 'standard_ngram',
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
            $mapping->text('code', [
                'analyzer' => 'content_analyzer'
            ]);
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::dropIfExists('codes');
    }
}

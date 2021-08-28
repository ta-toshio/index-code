<?php
declare(strict_types=1);

use App\Utils\ElasticMigrationHelper;
use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreateFieldsIndex implements MigrationInterface
{
    use ElasticMigrationHelper;

    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::create('fields', function (Mapping $mapping, Settings $settings) {
            $this->applyAnalysis($settings);

            $mapping->text('search_title', [
                'analyzer' => 'content_analyzer',
            ]);
            $mapping->text('search_subtitle', [
                'analyzer' => 'content_analyzer',
            ]);

            $mapping->integer('table_id');
            $mapping->text('table_name',
                [
                    'fields' => [
                        'keyword' => [
                            'type' => 'keyword',
                            'ignore_above' => 256,
                        ]
                    ]
                ]
            );
            $mapping->text('field_name',
                [
                    'fields' => [
                        'keyword' => [
                            'type' => 'keyword',
                            'ignore_above' => 256,
                        ]
                    ]
                ]
            );
            $mapping->keyword('field_type');
            $mapping->text('field_param');
            $mapping->date('created_at');
            $mapping->date('updated_at');
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::dropIfExists('fields');
    }
}

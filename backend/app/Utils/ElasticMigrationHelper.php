<?php

namespace App\Utils;

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;

trait ElasticMigrationHelper
{

    public function applyNounNgram(Settings $settings)
    {
        $settings->index([
            'max_ngram_diff' => 10,
        ]);
        $settings->analysis([
            'filter' => [
                'my_ngram' => [
                    'type' => 'ngram',
                    'min_gram' => 3,
                    'max_gram' => 10
                ]
            ],
            'analyzer' => [
                'standard_ngram' => [
                    'tokenizer' => 'standard',
                    'filter' => [
                        'my_ngram',
                        'lowercase',
                    ]
                ]
            ]
        ]);
    }

    public function applyCodeAnalyzer(Settings $settings)
    {
        $settings->analysis([
            'analyzer' => [
                'content_analyzer' => [
                    'tokenizer' => 'standard',
                    'char_filter' => ['content_char_filter'],
                    'filter' => ['lowercase']
                ],
                'path_analyzer' => [
                    'type' => 'custom',
                    'filter' => ['lowercase'],
                    'tokenizer' => 'path_tokenizer',
                ],
                'path_hierarchy_analyzer' => [
                    'type' => 'custom',
                    'tokenizer' => 'path_hierarchy_tokenizer',
                    'filter' => ['lowercase'],
                ],
            ],
            'char_filter' => [
                'content_char_filter' => [
                    'type' => 'pattern_replace',
                    'pattern' => '[.]',
                    'replacement' => ' ',
                ],
            ],
            'tokenizer' => [
                'path_tokenizer' => [
                    'type' => 'pattern',
                    'pattern' => '[\\\\./]',
                ],
                'path_hierarchy_tokenizer' => [
                    'type' => 'path_hierarchy',
                    'delimiter' => '/',
                    'reverse' => 'true',
                ],
            ],
        ]);
    }

    public function setSearchTitle(Mapping $mapping)
    {
        $mapping->text('search_title', [
            'analyzer' => 'content_analyzer'
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
    }

}

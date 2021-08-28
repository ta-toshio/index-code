<?php

namespace App\Utils;

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;

trait ElasticMigrationHelper
{

    public function applyAnalysis(Settings $settings)
    {
        $settings->index([
            'max_ngram_diff' => 10,
        ]);
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
                'lowercase_analyzer' => [
                    'type' => 'custom',
                    'filter' => ['lowercase'],
                    'tokenizer' => 'keyword',
                ],
                'standard_ngram' => [
                    'tokenizer' => 'standard',
                    'filter' => [
                        'my_ngram',
                        'lowercase',
                    ]
                ]
            ],
            'filter' => [
                'my_ngram' => [
                    'type' => 'ngram',
                    'min_gram' => 3,
                    'max_gram' => 10
                ]
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

}

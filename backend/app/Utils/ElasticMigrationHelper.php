<?php

namespace App\Utils;

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
}

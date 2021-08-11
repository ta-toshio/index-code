<?php
declare(strict_types=1);

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreateJaPostsIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::create('ja_posts', function (Mapping $mapping, Settings $settings) {
            // and analysis configuration
            $settings->analysis([
                "char_filter" => [
                    "normalize" => [
                        "type" => "icu_normalizer",
                        "name" => "nfkc",
                        "mode" => "compose"
                    ]
                ],
                "tokenizer" => [
                    "ja_kuromoji_tokenizer" => [
                        "mode" => "search",
                        "type" => "kuromoji_tokenizer",
                        "discard_compound_token" => true,
                    ],
                    "ja_ngram_tokenizer" => [
                        "type" => "ngram",
                        "min_gram" => 2,
                        "max_gram" => 2,
                        "token_chars" => [
                            "letter",
                            "digit"
                        ]
                    ]
                ],
                'analyzer' => [
                    "ja_kuromoji_index_analyzer" => [
                        "type" => "custom",
                        "char_filter" => [
                            "normalize"
                        ],
                        "tokenizer" => "ja_kuromoji_tokenizer",
                        "filter" => [
                            "kuromoji_baseform",
                            "kuromoji_part_of_speech",
                            "cjk_width",
                            "ja_stop",
                            "kuromoji_stemmer",
                            "lowercase"
                        ]
                    ],
                    "ja_kuromoji_search_analyzer" => [
                        "type" => "custom",
                        "char_filter" => [
                            "normalize"
                        ],
                        "tokenizer" => "ja_kuromoji_tokenizer",
                        "filter" => [
                            "kuromoji_baseform",
                            "kuromoji_part_of_speech",
                            "cjk_width",
                            "ja_stop",
                            "kuromoji_stemmer",
                            "lowercase"
                        ]
                    ],
                    "ja_ngram_index_analyzer" => [
                        "type" => "custom",
                        "char_filter" => [
                            "normalize"
                        ],
                        "tokenizer" => "ja_ngram_tokenizer",
                        "filter" => [
                            "lowercase"
                        ]
                    ],
                    "ja_ngram_search_analyzer" => [
                        "type" => "custom",
                        "char_filter" => [
                            "normalize"
                        ],
                        "tokenizer" => "ja_ngram_tokenizer",
                        "filter" => [
                            "lowercase"
                        ]
                    ],
                ]
            ]);

            $mapping->text('title', [
                "search_analyzer" => "ja_kuromoji_search_analyzer",
                "analyzer" => "ja_kuromoji_index_analyzer",
                "fields" => [
                    "ngram" => [
                        "type" => "text",
                        "search_analyzer" => "ja_ngram_search_analyzer",
                        "analyzer" => "ja_ngram_index_analyzer"
                    ]
                ]
            ]);
            $mapping->text('body', [
                "search_analyzer" => "ja_kuromoji_search_analyzer",
                "analyzer" => "ja_kuromoji_index_analyzer",
                "fields" => [
                    "ngram" => [
                        "type" => "text",
                        "search_analyzer" => "ja_ngram_search_analyzer",
                        "analyzer" => "ja_ngram_index_analyzer"
                    ]
                ]
            ]);
            $mapping->keyword('category');
            $mapping->text('type', [
                "search_analyzer" => "ja_kuromoji_search_analyzer",
                "analyzer" => "ja_kuromoji_index_analyzer",
                "fields" => [
                    "ngram" => [
                        "type" => "text",
                        "search_analyzer" => "ja_ngram_search_analyzer",
                        "analyzer" => "ja_ngram_index_analyzer"
                    ]
                ]
            ]);

        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::dropIfExists('ja_posts');
    }
}

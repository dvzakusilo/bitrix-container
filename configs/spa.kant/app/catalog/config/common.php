<?php
/** @var string $DBHost */
/** @var string $DBName */
/** @var string $DBLogin */
/** @var string $DBPassword */

$params = [];

// todo itsm избавитья
return array_replace_recursive([
    'filters' => [
        'elastic' => [
            'connections' => \GoodsRu\app\di\serviceLocator\Locator::container()->get('services_catalog_elastic_connections'),
            'index' => [
                'settings' => [
                    "analysis" => [
                        "analyzer" => [
                            "ru" => [
                                "type" => "custom",
                                "tokenizer" => "standard",
                                "filter" => [
                                    "search_synonym",
                                    "lowercase",
                                    "russian_stop",
                                    "russian_stemmer"
                                ],
                            ]
                        ],
                        "filter" => [
                            "search_synonym" => [
                                "type" => "synonym",
                                "synonyms_path" => \GoodsRu\app\di\serviceLocator\Locator::container()->get('services_catalog_elastic_synonymFile'),
//                                "synonyms" => [
//                                    "доска => сноуборд",
//                                    "обувь => ботинки",
//                                    "обувь => кеды",
//                                    "обувь => кроссовки",
//                                    "обувь => сапоги",
//                                    "обувь => сандалии",
//                                    "оптика => бинокль",
//                                    "оптика => очки",
//                                    "близард => blizzard",
//                                    "вельт => welt",
//                                ]
                            ],
                            "russian_stop" => [
                                "type" => "stop",
                                "stopwords" => "_russian_"
                            ],
                            "russian_stemmer" => [
                                "type" => "snowball",
                                "language" => "russian",
                            ]
                        ]
                    ],
                    'number_of_shards' => 5,
                    'number_of_replicas' => 0,
                    'mapping' => [
                        'total_fields' => ['limit' => '200000']
                    ],
                    'max_result_window' => 1000000,
                ],
                'prefix' => 'catalog_index',
                'db_source' => 'kant_live'//\GoodsRu\app\di\serviceLocator\Locator::container()->get('mysql_databaseName'),
            ]
        ]
    ]
], $params);

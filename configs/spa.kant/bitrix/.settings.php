<?php
$_ENV = parse_ini_file(__DIR__ . '/../.env');

$isDev = $_ENV['DEVELOPMENT_MODE'] == 'On';
/** @noinspection ProblematicWhitespace */
return [
    'env' => [
        'value' => 'local_dev',
    ],
    'retail_crm_settings' => [
        'value' => [
            'host' => 'https://test-live-kant.retailcrm.ru'
//            'host' => 'https://kant.retailcrm.ru'
        ]
    ],
    'redis_settings' => [
        'value' => [
            'host' => 'redis',
            'port' => '6379',
            'sid' => '9',
            'connect_timeout' => 1,
            'read_timeout' => 1,
        ],
    ],
    
    'elastic_settings' => [
        'value' => [
            'services_catalog_elastic_connections' => 'elastic@10.77.107.43:9200',
            'services_elk_connections' => [
                'host' => $_ENV['ELASTIC_ELK_HOST'] ?: '10.77.107.43',
                'port' => $_ENV['ELASTIC_ELK_PORT'] ?: '9200',
                'user' => $_ENV['ELASTIC_ELK_USER'] ?: 'elastic',
                'pass' => $_ENV['ELASTIC_ELK_PASS'] ?: ''
            ],
            'services_docker_connections' => [
                'host' => $_ENV['ELASTIC_ELK_HOST'] ?: 'elk',
                'port' => $_ENV['ELASTIC_ELK_PORT'] ?: '9200',
                'user' => $_ENV['ELASTIC_ELK_USER'] ?: 'elastic',
                'pass' => $_ENV['ELASTIC_ELK_PASS'] ?: ''
            ],
            'services_catalog_elastic_bulkUpdateDocs' => 2000, // количество документов на апдейт
        ],
    ],
    'utf_mode' => [
        'value' => true,
        'readonly' => true,
    ],
    'cache' => array(
        'value' => array(
            'type' => 'memcache',
            'memcache' => array(
                'host' => 'memcached',
                'port' => '11211',
            ),
            'sid' => $_SERVER["DOCUMENT_ROOT"]."#01"
        ),
    ),
    'cache_flags' => [
        'value' => [
            'config_options' => 3600,
            'site_domain' => 3600,
        ],
        'readonly' => false,
    ],
    'cookies' => [
        'value' => [
            'secure' => false,
            'http_only' => true,
        ],
        'readonly' => false,
    ],
    'exception_handling' => array(
        'debug' => $isDev,
        'handled_errors_types' => E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE,
        'exception_errors_types' => E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT & ~E_USER_WARNING & ~E_USER_NOTICE & ~E_COMPILE_WARNING & ~E_DEPRECATED,
        'ignore_silence' => !$isDev,
        'assertion_throws_exception' => true,
        'assertion_error_type' => 256,
        'value' => array(
            'log' => [
                'settings' => [
                    'file' => '/var/log/bitrix/bitrix-error.log',
                    'log_size' => 1000000,
                ],
            ],
        ),
        'readonly' => false
    ),
    'connections' => [
        'value' => [
            /** { @internal Подключение к дев серверу } */
            'default' =>
                [
                    'className' => '\\Bitrix\\Main\\DB\\MysqliConnection',
                    'host' => $_ENV['DB_HOST'] ?: '10.77.107.42',
                    'database' => $_ENV['DB_BASE'] ?: 'kantdb',
                    'login' => $_ENV['DB_LOGIN'] ?: 'kantusr',
                    'password' => $_ENV['DB_PASS'] ?: '',
                    'options' => 2.0,
                ],
            /** { @internal Подключение к дев докеру } */
            'docker-dev' =>
                [
                    'className' => '\\Bitrix\\Main\\DB\\MysqliConnection',
                    'host' => $_ENV['DB_HOST'] ?? 'db',
                    'database' => $_ENV['DB_BASE'] ?? 'kant',
                    'login' => $_ENV['DB_LOGIN'] ?? 'root',
                    'password' => $_ENV['DB_PASS'] ?? '123',
                    'options' => 2,
                ],

            /** { @internal Подключение к прод докеру } */
            'docker' =>
                [
                    'slave' => array (),
                    'className' => '\\Bitrix\\Main\\DB\\MysqlConnection',
                    'host' => $_ENV['DB_HOST'] ?? 'database',
                    'database' => $_ENV['DB_BASE'] ?? 'docker',
                    'login' => $_ENV['DB_LOGIN'] ?? 'docker',
                    'password' => $_ENV['DB_PASS'] ?? 'docker',
                    'options' => 2,
                ]
        ],
        'readonly' => false
    ]
];


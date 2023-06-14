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
    'rabbitmq' => [
        'value' => [
            'connections' => [
                'default' => [
                    'host' => '172.17.0.2',
                    'port' => 5672,
                    'user' => 'guest',
                    'password' => 'guest',
                    'vhost' => '/',
                    'lazy' => false,
                    'connection_timeout' => 3.0,
                    'read_write_timeout' => 3.0,
                    'keepalive' => false,
                    'heartbeat' => 0,
                    'use_socket' => true,
                ],
                'elk' => [
                    'host' => 'rabbitmq',
                    'port' => 5672,
                    'user' => 'guest',
                    'password' => 'guest',
                    'vhost' => '/',
                    'lazy' => false,
                    'connection_timeout' => 3.0,
                    'read_write_timeout' => 3.0,
                    'keepalive' => false,
                    'heartbeat' => 0,
                    'use_socket' => true,
                ],
            ],
            'producers' => [
                'logs' => [
                    'connection' => 'elk',
                    'exchange_options' => [
                        'name' => 'logs',
                        'type' => 'direct',
                    ],
                ],
            ],
            'consumers' => [
                'logs' => [
                    'connection' => 'elk',
                    'exchange_options' => [
                        'name' => 'logs',
                        'type' => 'direct',
                    ]
                ],
            ],
        ],
        'readonly' => false,
    ],
    'elastic_settings' => [
        'value' => [
//            'services_catalog_elastic_connections' => ['127.0.0.1:9200'],
            'services_catalog_elastic_connections' => [
                'host' => $_ENV['ELASTIC_HOST'] ?: '10.77.107.43',
                'port' => $_ENV['ELASTIC_PORT'] ?: '9200',
                'user' => $_ENV['ELASTIC_USER'] ?: 'elastic',
                'pass' => $_ENV['ELASTIC_PASS'] ?: ''
            ],
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
    'monolog' => array(
        'value' => array(
            'formatters' => array(
                'NativeMailerFormatter' => array(
                    'class' => '\Monolog\Formatter\HtmlFormatter',
                ),
                'StreamHandlerFormatter' => array(
                    'class' => '\Monolog\Formatter\LineFormatter',
                    "format" => "%datetime% > %level_name% > %message% %context% %extra%\n",
                    "dateFormat" => "Y n j, g:i a"
                ),
                'elk' => array(
                    'class' => '\Monolog\Formatter\LogstashFormatter',
                    'applicationName' => 'kant_web',
                    'systemName' => $_SERVER['REMOTE_ADDR']
                )
            ),
            'handlers' => array(
                'default' => array(
                    'class' => '\Monolog\Handler\StreamHandler',
                    'level' => 'DEBUG',
                    'stream' => '/var/log/bitrix/bitrix-error.log'
                ),
                'feedback_event_log' => array(
                    'class' => '\Bex\Monolog\Handler\BitrixHandler',
                    'level' => 'DEBUG',
                    'event' => 'TYPE_FOR_EVENT_LOG',
                    'module' => 'vendor.module'
                ),
                'elk_event_log' => array(
                    'class' => '\Handler\Monolog\ELKHandler',
                    'level' => 'DEBUG',
                    'formatter' => "elk"
                ),
            ),
            'loggers' => array(
                'app' => array(
                    'handlers'=> array('default'),
                ),
                'feedback' => array(
                    'handlers'=> array('feedback_event_log'),
                ),
                'elk' => array(
                    'handlers'=> array('elk_event_log'),
                )
            )
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
                    'password' => $_ENV['DB_PASS'] ?: 'wsDGS9GctpsN',
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


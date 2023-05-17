<?php

use \Bitrix\Main\Config\Configuration;

if(!defined('JSON_PRESERVE_ZERO_FRACTION'))
{
    define('JSON_PRESERVE_ZERO_FRACTION', 1024);
}

$mySqlConnection = Configuration::getValue('connections');
$redisSettings = Configuration::getValue('redis_settings');
$elasticSettings = Configuration::getValue('elastic_settings');

return [
    'mysql_host' => $mySqlConnection['default']['host'],
    'mysql_port' => $mySqlConnection['default']['port'],
    'mysql_login' => $mySqlConnection['default']['login'],
    'mysql_password' => $mySqlConnection['default']['password'],
    'mysql_databaseName' => $mySqlConnection['default']['database'],

    'redis_host' => $redisSettings['host'],
    'redis_port' => $redisSettings['port'],
    'redis_sid' => $redisSettings['sid'],
    'redis_connect_timeout' => $redisSettings['connect_timeout'],
    'redis_read_timeout' => $redisSettings['read_timeout'],


    'redis_persistent_host' => $redisSettings['host'],
    'redis_persistent_port' => $redisSettings['port'],
    'redis_persistent_sid' => $redisSettings['sid'],
    'redis_persistent_connect_timeout' => $redisSettings['connect_timeout'],
    'redis_persistent_read_timeout' => $redisSettings['read_timeout'],
    'persistentCacheLifetime' => 2592000,

    'services_catalog_elastic_connections' => [$elasticSettings['services_catalog_elastic_connections']],
//    'services_catalog_elastic_connections' => ['localhost:9200'],
    'services_catalog_elastic_bulkUpdateDocs' => $elasticSettings['services_catalog_elastic_bulkUpdateDocs'], // количество документов на апдейт

    'services_catalog_elastic_synonymFile' => "/usr/share/elasticsearch/synonym.txt",

    'services_catalog_detectum_url' => 'http://127.0.0.1',
    'services_catalog_detectum_suggest_url' => 'http://127.0.0.1',

    'elastic_index' => 'catalog_index_mmarket_mmarket_test',

    'services_catalog_priceIndex_bulkPriceQueryCount' => 2000,

    'services_dadata_token' => '018427fe5c4ff5d272e41a844424d0efd5ac4943',
    'services_dadata_standartization_key' => '878e657256362320afee8f4356918a1249faacfe',
    'services_dadata_url_base' => 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest',
    'services_dadata_standartization_url_base' => 'https://dadata.ru/api/v2/clean',


    'services_mms_url' => 'https://admin:test555@test-api.goods.ru',
    'services_bpg_url' => 'https://admin:test555@test-api.goods.ru',
    'services_oms_url' => 'https://admin:test555@test-api.goods.ru',
    'services_tms_url' => 'https://admin:test555@test-api.goods.ru',
    'services_partner_url' => 'https://admin:test555@test-api.goods.ru',
    'services_communication_url' => 'https://admin:test555@test-api.goods.ru',
    'services_cart_url' => 'http://127.0.0.1',
    'services_security_url' => 'http://127.0.0.1',

    'default_request_connect_timeout' => 1,
    'default_request_read_timeout' => 5,
    'oms_customer_order_list_read_timeout' => 10,
    'oms_customer_order_count_read_timeout' => 2,

    'mailer_smtp_host' => 'smtp.mailtrap.io',
    'mailer_smtp_password' => '588a04999756dc',
    'mailer_smtp_port' => '25',
    'mailer_smtp_username' => '08621b7979844e',
    'mailer_smtp_encryption' => '',

    'logger_files_max' => 30,
    'logger_files_path' => dirname(dirname(__DIR__)) . '/log/app.log',
    'logger_emails' => [],//['someone.who.need.it@lenvendo.ru'],

    'server_host' => 'goods.dn:3000',
    'inventory_hostname' => 'goods.dn',


    'apiSecurityServiceBaseUrl' => 'http://127.0.0.1',
    'apiCartServiceBaseUrl' => 'http://127.0.0.1',
    'personalOrderMakeFullUrl' => 'http://localhost/personal/order/make',

    'env' => 'dev',

    'staticUrls' => [
        "https://static.goods.ru/",
        "https://static1.goods.ru/",
        "https://static2.goods.ru/",
    ],

    'graylog_enabled' => false,
    'graylog_host' => '172.23.0.184',
    'graylog_port' => '12223',
    'graylog_stream' => 'from_bitrix',
    'graylog_source_host' => 'novikov',

    'cartCacheLifetime' => 2592000,

    'userViewedItemCacheLifetime' => 2592000,
    'userViewedMaxProduct'  => 21,
    'userViewedMaxCategory' => 7,

    'topMenuCacheLifetime' => 3600,
    'breadcrumbsMenuCacheLifetime' => 3600,

    'productCacheLifetime' => 3600,
    'categoryCacheLifetime' => 3600,
    'deliverySettingsCacheLifetime' => 3600,
    'mmsCacheLifetime' => 60,
    'userOrderCacheLifetime' => 3600,
    'partnerServiceLegalPersonCacheLifetime' => 86400,
    'mainPageCacheLifetime' => 3600,
    'badgeCacheLifetime' => 3600,


    'sberbank' => [
        'testEnveromentUrl' => 'https://3dsec.sberbank.ru',
        'payPageUrl'        => 'https://3dsec.sberbank.ru/payment/merchants/mvideo/payment_ru.html',
        'payPassw'          => 'mvideo',
        'payUserName'       => 'mvideo-api',
        'returnUrl'         => 'http://localhost/personal/order/success',
    ],

    'deliveryDays' => 7,

    'enabledDeliveryTypes' => [
        'COURIER',
    ],
    'enabledPaymentTypes' => [
        'cash',
        'card',
        'online',
    ],



    'manzana_login' => 'corp\svc-manzana-pos',
    'manzana_password' => 'belly-epE3V8w3K_7rkuEq9%+jrPyQbin4uFGg$TtH!pF#5/ym^UUt',
    'manzana_location' => 'http://172.22.0.92:8083/POSProcessing.asmx',
    'manzana_customer_office_location' => 'http://172.22.0.90:1011/CustomerOfficeService/',
    'manzana_administrator_office_location' => 'http://172.22.0.90:1013/AdministratorOfficeService/',
    'manzana_use_ntlm' => false,
    'manzana_org_name' => 'Marketplacetest',
    'manzana_rest_session_id' => 'CCB92DF9-A0AD-4467-A960-17441A59B4B8',
    'manzana_rest_partner_id' => '316725D9-4966-E711-80D7-005056011C49',
    'manzana_rest_virtual_card_type_id' => '8672060E-4B66-E711-80D7-005056011C49',

    'loyalty_enabled' => true,
    'manzana_uri' => 'http://loyalty.manzanagroup.ru/loyalty.xsd/ProcessRequest',
    'manzana_register_user_password' => 'xxx',
    'manzana_balance_actual_time' => 180, // время в течении которого данные о балансе манзаны актуальны
    'manzana_request_cache_lifetime' => 30,
    'manzana_online_payment_additional_percent' => 1,
    'manzana_anonymous_user_card_number' => 'gd999999999',



    'cartQuantityLimit' => 10,
    'cartPriceLimit' => 200000,
    'cartKgtQuantityLimit' => 50,
    'cartKgtPriceLimit' => 500000,

    'frontAppCheckoutMaxAddresses' => 5,

    'rabbit_mq_host' => '172.21.10.15',
    'rabbit_mq_username' => 'frontend',
    'rabbit_mq_password' => 'GCt2jwT0Fxz@3ylmO@&URbzEtrC1hw5c',
    'rabbit_mq_port' => '5672',
    'rabbit_mq_vhost' => 'frontend_dev',
    'rabbit_mq_auth' => 'AMQPLAIN',
    'rabbit_mq_oms_create_order_queue_name' => 'order_create_queue',
    'rabbit_mq_oms_payment_document_queue_name' => 'payment_document_queue',
    'rabbit_mq_oms_cancel_payment_queue_name' => 'cancelled_payment_document_queue',
    'rabbit_mq_web_payment_document_queue_name' => 'web_payment_document_queue',
    'rabbit_mq_web_payment_document_deferred_queue_name' => 'web_payment_document_deferred_queue',

    'userTokenLifetime' => 2592000, // 1 месяц

    'config.elastic' => [
        'hosts' => $elasticSettings['services_catalog_elastic_connections'], //elasticseaarch host and port
        'sources' => [
            'category' => ['index' => 'category_index_v1', 'type' => 'category', 'hosts' => []], // можно указать другой хост для конкретного индекса через параметр host
            //'item' => ['index' => 'item_index_v1', 'type' => 'item', 'hosts' => []],             // можно указать другой хост для конкретного индекса через параметр host
            'item' => ['index' => 'catalog_index_mmarket_novikov2', 'type' => 'items', 'hosts' => []],             // можно указать другой хост для конкретного индекса через параметр host
            //'filter' => ['index' => 'filter_index_v1', 'type' => 'filter', 'hosts' => []],        // можно указать другой хост для конкретного индекса через параметр host
            'filter' => ['index' => 'catalog_index_mmarket_novikov_filter2', 'type' => 'filter', 'hosts' => []],        // можно указать другой хост для конкретного индекса через параметр host
            'menu' => ['index' => 'menu_index_v1', 'type' => 'menuItem', 'hosts' => []]        // можно указать другой хост для конкретного индекса через параметр host
        ],
        'cache' => [
            'enabled' => true,
            'defaultLifeTime' => 60,
            'redis_host' => $redisSettings['host'],
            'redis_port' => $redisSettings['port'],
            'redis_sid' => $redisSettings['sid'],
            'redis_connect_timeout' => $redisSettings['connect_timeout'],
            'redis_read_timeout' => $redisSettings['read_timeout'],
        ]
    ],

    'catalog_version' => '1', // 1 - старый каталог, 2 - новый каталог

    'headerLogoCacheLifetime' => 3600,
    'staticPagesCacheLifetime' => 3600,

    'emarsys_username' => 'goods_ru002',
    'emarsys_secret'   => 'cOUh6sqpP7qsyHURa4cW',

    'sms' => [
        'apiUrl' => 'https://integrationapi.net/rest', //devino rest api url
        'auth' => [
            'login' => 'mvideo_call',
            'password' => ''
        ],
        'senderName' => 'goods.ru',
        'viber' => [
            'enable' => true, // использовать отправу сообщения через вайбер
            'lifeTime' => 10, // время в течении которого пробуется отправиться сообщение в мин, после отправка идет через СМС
        ]
    ],

    'checkout_max_delivery_distance_from_mkad' => 50,

    'recaptcha_secret_key' => '6LfTeS4UAAAAAOnzhW9ZlSoOzbXhZAi7sx0I-25A',
    'recaptcha_public_key' => '6LfTeS4UAAAAALwxyx4Vkv-ehduysNNhiW4WCkT7',

    'proAnalyticsKey' => '6e39efd603f94643b9e9d5ed96e3834d',

    'lk_personal_loyalty_block_enabled' => 1,

    'popular_products_widget_badges_limit' => 2,
    'plp_badges_limit' => 2,
    'pdp_badges_limit' => 4,

    'debug_log_enabled' => true,

    'checkoutCallCenterSecretKey' => 'a873913f-0e18-45a6-835f-38c4533658b4',

    'seoLinkService.config' => [
        'holdTime' => 60, // Время на которое блокируются заспросы к стороннему сервису.
        'dslink' => [
            'client_id'         => 63, // идентификатор Goods в системе перелинковки
            'api_uri'           =>  'http://spiders.pro/dslinks/rest/links',
            'api_version'       => '1.7',
            'api_timeout'       => 1000, //in ms
            'encoding'          => 'UTF-8',
            'check_yandexbot'   => true,
            'replaceDomainInUrl' => [ // Для сервиса перелинковки всегда передается полный урл страницы. В сервисе есть только урл с домена goods.ru. Так как информация берется с боевого сайта.
                'enabled' => false,
                'domain' => 'https://goods.ru' //goods.ru' производить замену на данный домен. Пример: *http://localhost.goods/catalog/smartfony/* url локальной площадки получим урл отправленный в сервис https://goods.ru/catalog/smartfony/
            ]
        ],
        'cache' => [
            'enabled' => true,
            'defaultLifeTime' => 0, // in second. Value 0 - unexpired cache
            'redis_host' => 'bitrix-redis',
            'redis_port' => '6379',
            'redis_sid' => '1',
            'redis_connect_timeout' => 1,
            'redis_read_timeout' => 1,
        ],
        'userAgents' => ['yandex'], // List of user agent that are initialize a request on get links from service . If value is FALSE - Any agent can do it.
    ],

    'retail_rocket_secret_key' => 'd2fc7d17c4b3d068a3aaf4f7fd9e18ac53fa21b4cff6fd20ca02946e4bbd1d63',
    'retail_rocket_partner_id' => '5a0c08fdc7d010a3b04d26e0',

];

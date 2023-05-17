<?php
 return array (
/*  'cache' =>
  array (
    'value' =>
    array (
      'type' =>
      array (
        'class_name' => '\\DHCache\\CacheEngineRedis',
        'required_file' => 'lib/cacheengineredis.php',
      ),
      'host' =>
      array (
        0 => '192.168.111.5',
        1 => '6379',
      ),
      'auth' => false,
      'db' => 9,
      'persistent' => false,
      'serializer' => 'php',
      'sid' => 'k:',
    ),
  ),*/
  'elastic_alias_path' => '/mnt/elasticsearch/synonym.txt',
  'location_repository' =>
  array (
    0 => 'Location\\Repository\\SessionRepository',
    1 => 'Location\\Repository\\CookieRepository',
  ),
  'elastic_status_list' =>
  array (
    'success' => 'Собрано',
    'progress' => 'Собирается',
    'error' => 'Ошибка',
  ),
  'rapporto_login' => 'kant_rest',
  'rapporto_password' => 'Hdivko81',
  'rapporto_url' => 'http://lk.rapporto.ru:9080/kant_rest',
);

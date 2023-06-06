<?php
#$DBHost = '37.200.71.114:3307';
#$DBHost = '192.168.111.1:3307';

//$DBHost = 'localhost:3306';
//$DBHost = 'localhost:3333';
//$DBLogin = 'root';
//$DBHost = '192.168.111.10:3306'; //web2
//$DBLogin = 'kant';//web2
//$DBPassword = 'Ghjuhfvvf01081977';//web2
//$DBName = 'kant_live';//web2

//$DBHost = '192.168.111.1:3306';
//$DBName = 'kant_live';
//$DBLogin = 'kant';
//$DBPassword = 'Ghjuhfvvf01081977';
$_ENV = parse_ini_file('/../../.env');

$DBHost = $_ENV['DB_HOST'] ?? '10.77.107.103';
$DBName = $_ENV['DB_BASE'] ?? 'kantdb';
$DBLogin = $_ENV['DB_LOGIN'] ?? 'kantusr';
$DBPassword = $_ENV['DB_PASS'] ?? 'wsDGS9GctpsN';


const LOG_FILENAME = '/var/log/bitrix/old.db-error.txt';


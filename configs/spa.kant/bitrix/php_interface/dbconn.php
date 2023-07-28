<?php
//xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
define("BX_USE_MYSQLI", true);
define("DBPersistent", false);
$DBType = "mysql";
$DBDebug = true;
$DBDebugToFile = false;
ini_set("memory_limit", "512M");
define("DELAY_DB_CONNECT", true);
define("CACHED_b_file", 3600);
define("CACHED_b_file_bucket_size", 10);
define("CACHED_b_lang", 3600);
define("CACHED_b_option", 3600);
define("CACHED_b_lang_domain", 3600);
define("CACHED_b_site_template", 3600);
define("CACHED_b_event", 3600);
define("CACHED_b_agent", 3660);
define("CACHED_menu", 3600);

define("BX_UTF", true);
define("BX_FILE_PERMISSIONS", 0644);
define("BX_DIR_PERMISSIONS", 0755);
@umask(~BX_DIR_PERMISSIONS);
define("BX_DISABLE_INDEX_PAGE", true);

//define("BX_COMP_MANAGED_CACHE", true);

define("BX_TEMPORARY_FILES_DIRECTORY", "/var/log/bitrix/knt/tmp/");

//define('BX_CACHE_TYPE', 'apc');
//define('BX_CACHE_SID', $_SERVER['DOCUMENT_ROOT'].'#01');
define("SM_SAFE_MODE", true);
require 'dbconn_extra.php';

function pre($str) {
    printf('Result:<pre>%s</pre><hr />', print_r($str, true));
}
?>

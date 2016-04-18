<?php
/*
=========================================================
6/28/2014 12:03:20 PM
Ad Bios
[config.php]
[Adam D.]
[emergencypuffjacket.com]
Overall back-end config for the AdBios website application
=========================================================
*/
date_default_timezone_set('America/New_York');
define ("g_db_server", "mysql");
// if(in_array($_SERVER['HTTP_HOST'], $localdomains)){ // LOCAL SETTINGS
	$yearout = date ("Y");
	define ("g_CORS", "/localhost|.*\.local/");
	define ("g_dbhost", "epjdb1.cwkm0e8ntibe.us-west-2.rds.amazonaws.com");
	define ("g_dbname", "ad_bios");
	define ("g_dbusr", "adamdbio");
	define ("g_dbpass", "C9PC6Jj25q4m288qx");
	define ("g_dbport", "3306");
/*
	if (class_exists("KLogger")) {
		define ("g_klogger_level", KLogger::DEBUG);
		define ("g_klogger_dir", __DIR__ .'/../_log/');
	}
*/
?>
<?php
/**
 * Client Manager
 * 
 * Configuration file to the system.
 * @package Client Manager
 * @author Jin Cong<onionboy@live.com.my>
 */

//admin's info
define('ADMINNAME', 'admin');//admin name
define('ADMINPASSWORD', 'admin');//admin password
define('ADMINEXPIRED', '3600');//login session time in second, default: 3600 sec = 1hr

//site's info
define('SITE_TITLE', 'Client Manager');//site title
define('BASE_URL', 'http://localhost/clienthub_01');//"/" is not required in the end, eg: http://domain.com/cm
define('IMAGE_MAX', '2048');//uploaded photos maximum filesize in KB 
define('SPOON_DEBUG', true); //'false' to activate productive mode or 'true' to activate debug mode

//mysql connection
define('MYSQL_HOST', 'localhost');//mysql host
define('MYSQL_DB', 'clienthub_01');//mysql database name
define('MYSQL_UN', 'root');//mysql username
define('MYSQL_PW', '');//mysql password

//directory
define('ROOT_PATH', dirname(__FILE__));
define('TEMPLATE_PATH', '/templates');
define('CONTENTS_PATH', 'contents');
define('COMPILE_PATH', ROOT_PATH . '/' . TEMPLATE_PATH . '/compiled');
define('IMAGE_PATH', ROOT_PATH.'/contents/images');
<?php
/**
 * Client Manager
 * 
 * Overrided Configuration file to the system. Shall be included if config.php is not exist.
 * @package Client Manager 0.2 alpha
 * @author Jin Cong<onionboy@live.com.my>
 */

//admin's info
define ( 'ADMINNAME', 'admin' ); //admin name
define ( 'ADMINPASSWORD', 'admin' ); //admin password
define ( 'ADMINEXPIRED', '3600' ); //login session time in second, default: 3600 sec = 1hr

//site's info
define ( 'THEME', '' );
define ( 'IMAGE_MAX', '2048' ); //uploaded photos maximum filesize in KB 
define ( 'PAGING_LIMIT', 30 ); //paging limit in list.php
define ( 'SPOON_DEBUG', false ); //'false' to activate productive mode or 'true' to activate debug mode

//mysql connection
define ( 'MYSQL_HOST', 'localhost' ); //mysql host
define ( 'MYSQL_DB', 'clientManager' ); //mysql database name
define ( 'MYSQL_UN', 'root' ); //mysql username
define ( 'MYSQL_PW', '' ); //mysql password

//directory
define ( 'COMPILE_PATH', CM_ROOT . '/cm_includes/templates/compiled' ); //compiled template files saving directory
define ( 'IMAGE_PATH', CM_ROOT . '/cm_contents/photo' );//uploaded photos saving directory
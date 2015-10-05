<?php
/**
 * Client Manager
 * 
 * Entry point to the system. Shall be required in all file throughout the system.
 * Load Spoon Library, Configuration File and Check User Role.
 * @package Client Manager 0.2 alpha
 * @author Jin Cong<onionboy@live.com.my>
 */

//Entry Time
define ( 'START_TIME', microtime ( true ) );
//Basic constant
define ( 'IN_CM', true );
//Version
define ( 'CM_VERSION', '0.2.0' );
//Base Root
define ( 'CM_ROOT', substr ( dirname ( __FILE__ ), 0, - 12 ) );
//Viewing Page Url
define ( 'CM_PAGE', strtolower ( substr ( $_SERVER ['SERVER_PROTOCOL'], 0, strpos ( $_SERVER ['SERVER_PROTOCOL'], '/' ) ) ) . '://' . $_SERVER ['HTTP_HOST'] . substr ( $_SERVER ['PHP_SELF'], 0, strrpos ( $_SERVER ['PHP_SELF'], '/' ) ) );
//Base Url
define ( 'CM_URL', str_replace ( array ("/cm_includes", "/cm_admin", "/cm_api", "/cm_contents" ), "", strtolower ( substr ( $_SERVER ['SERVER_PROTOCOL'], 0, strpos ( $_SERVER ['SERVER_PROTOCOL'], '/' ) ) ) . '://' . $_SERVER ['HTTP_HOST'] . substr ( $_SERVER ['PHP_SELF'], 0, strrpos ( $_SERVER ['PHP_SELF'], '/' ) ) ) );

//include configuration file
if (! reqFile ( CM_ROOT . '/config.php', false ))
	reqFile ( CM_ROOT . '/config_override.php', true, 'Error: Config File is not Available.' );

//checking configuration file
if (! defined ( 'ADMINNAME' ) || ! defined ( 'ADMINPASSWORD' ) || ! defined ( 'ADMINEXPIRED' ) || ! defined ( 'MYSQL_HOST' ) || ! defined ( 'MYSQL_DB' ) || ! defined ( 'MYSQL_UN' ) || ! defined ( 'MYSQL_PW' ) || ! defined ( 'IMAGE_MAX' ) || ! defined ( 'IMAGE_PATH' ) || ! defined ( 'COMPILE_PATH' )) {
	die ( 'Error: Required Params in config.php is not available.' );
}
if (defined ( 'THEME' )) {
	if (strlen ( THEME ) > 0 && ((substr ( THEME, - 1 ) != '/') || (substr ( THEME, - 1 ) != '\\'))) {
		die ( 'Error: Configuration \'THEME\' should contain "/" as the last character.' );
	}
} else {
	define ( 'THEME', '' );
}
if (! defined ( 'PAGING_LIMIT' )) {
	define ( 'PAGING_LIMIT', 30 );
}

//time zone
date_default_timezone_set('Asia/Kuala_Lumpur');

//include Spoon Library
reqFile ( CM_ROOT . '/cm_includes/spoon/spoon.php' );

//error_reporting level
if (defined ( 'SPOON_DEBUG' ) && SPOON_DEBUG == true) {
	error_reporting ( E_ALL );
} else {
	error_reporting ( 0 );
}

//load SpoonSession
SpoonSession::start ();

//include auth library
reqFile ( CM_ROOT . '/cm_includes/auth.class.php' );
if (defined ( "IN_API" ) && IN_API == true) {
	if (! cmAuth::md5_verify ( $_POST ['adminname'], $_POST ['adminpw'] )) {
		die ();
	}
} elseif (defined ( 'IN_LOGIN' ) && defined ( 'IN_IMAGE' )) {

} elseif (defined ( "IN_LOGIN" ) && IN_LOGIN == true) {
	reqFile ( CM_ROOT . '/cm_includes/securimage/securimage.php' );
	$securimage = new Securimage ();
} elseif (defined ( "IN_ADMIN" ) && IN_ADMIN == true) {
	if (! cmAuth::is_logined ()) {
		header ( 'Location: ' . CM_URL . '/cm_admin/login.php' );
	}
} elseif (defined ( 'IN_IMAGE' ) && IN_IMAGE == true) {
	if (! cmAuth::is_logined ()) {
		die ();
	}
} else {
	if (! cmAuth::is_logined ()) {
		header ( 'Location: ' . CM_URL . '/login.php' );
	}
}

//load SpoonMysql
if (defined ( 'LOAD_MYSQL' )) {
	$mysql = new SpoonDatabase ( 'mysql', MYSQL_HOST, MYSQL_UN, MYSQL_PW, MYSQL_DB );
	reqFile ( CM_ROOT . '/cm_includes/mysql.php' );
}

//load SpoonTemplate
if (defined ( 'LOAD_TEMPLATE' ))
	$tpl = reqFile ( CM_ROOT . '/cm_includes/template.php' );

	//load Form Functions
if (defined ( 'LOAD_FORM' ))
	reqFile ( CM_ROOT . '/cm_includes/form.php' );

/**
 * Require File
 * 
 * @return return true if file exists or else report error
 * @param string $filepath 	file's path
 * @param boolean $error	report error or not
 * @param string $errorMsg	custom error message
 */
function reqFile($filepath, $error = true, $errorMsg = NULL) {
	$filepath = str_replace ( '\\', '/', $filepath );
	if (is_file ( $filepath )) {
		return require_once $filepath;
	} else {
		if ($errorMsg != NULL) {
			die ( $errorMsg );
		} elseif ($error == true) {
			die ( 'Error: System Required File is Not Available - ' . substr ( $filepath, (strlen ( $filepath ) - strrpos ( $filepath, "/" )) * (- 1) ) );
		}
	}
}

/**
 * Return template file path
 * 
 * @return string
 * @param string $filename
 */
function tpl_path($filename) {
	return CM_ROOT . '/cm_includes/templates/' . THEME . $filename;
}

/**
 * Remove Multiple Keys from an Array
 * 
 * @param array $array 	the array to remove keys from
 * @param array $key	the keys to be removed
 */
function removeKeys(array $array, array $key) {
	foreach ( $key as $value ) {
		unset ( $array [$value] );
	}
	return $array;
}
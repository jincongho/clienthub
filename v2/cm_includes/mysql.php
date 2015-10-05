<?php
/**
 * Client Manager
 * 
 * Load Mysql Table Manager
 * @package Client Manager 0.2 alpha
 * @author Jin Cong<onionboy@live.com.my>
 */

(! defined ( 'IN_CM' ) && ! defined ( 'LOAD_MYSQL' )) && exit ();

/**
 * Load a mysql table parser
 * 
 * @param string $tablename
 * @param string $action[recommended: insert, delete, update]
 * @param array $value
 */
function tableParser($tablename, $action, array $value = NULL){
	global $mysql;
	static $loadedParser = array();
	
	//require required table parser file
	if(!in_array($tablename, $loadedParser)){
		$loadedParser[] = $tablename;
		reqFile ( CM_ROOT . '/cm_includes/table/' . $tablename . '.table.php' );
	}

	//load table parser class
	$tableclass = ucfirst ( $tablename ) . "Table";
	return call_user_func(array($tableclass, $action), $mysql, $value);
}
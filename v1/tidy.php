<?php
/**
 * Client Manager
 * 
 * Helps to clean unused file
 * @package Client Manager
 * @author Jin Cong<onionboy@live.com.my>
 */

define ( 'LOAD_TEMPLATE', true );
define ( 'LOAD_HEADER', true );
require 'loader.php';

//delete unused image in folder
$startTime = microtime ( true );
$images = SpoonDirectory::getList ( IMAGE_PATH, true, array (".htaccess" ) );
$records = $mysql->getRecords ( 'SELECT `photo`, `photoext` FROM `profiles`' );
$count_deleted = 0;
$count_fail_deleted = 0;
foreach ( $images as $image ) {
	foreach ( $records as $record ) {
		if (substr ( $image, 0, 13 ) == $record ['photo'] && substr ( $image, - 3 ) == $record ['photoext']) {
			$used = true;
		}
	}
	if (isset ( $used ) && $used == true) {
		unset ( $used );
	} else {
		$delete = SpoonFile::delete ( IMAGE_PATH . '/' . $image );
		if ($delete) {
			$count_deleted ++;
		} else {
			$count_fail_deleted ++;
		}
	}
}
$endtime = microtime ( true ) - $startTime;

//delete unused compile file
$files = SpoonDirectory::getList ( COMPILE_PATH, true );
foreach ( $files as $file ) {
	$delete = SpoonFile::delete ( COMPILE_PATH.'/'.$file );
	if ($delete) {
		$count_deleted ++;
	} else {
		$count_fail_deleted ++;
	}
}

//optimize table
$mysql->optimize ( 'profiles' );

$tpl->assign ( 'tooltip', $count_deleted . ' files deleted.<br />' . $count_fail_deleted . ' files failed to delete.<br />' . $endtime . ' secs spended.<br />Database was optimized too :)' );

$tpl->display ( ROOT_PATH . '/' . TEMPLATE_PATH . '/tidy.tpl.php' );

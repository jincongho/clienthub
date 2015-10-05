<?php
/**
 * Client Manager
 * 
 * Extract Profile Attachment File
 * @package Client Manager 0.2 alpha
 * @author Jin Cong<onionboy@live.com.my>
 */

define ( 'LOAD_MYSQL', true );
require '../cm_includes/entry.php';

if (empty ( $_GET ['id'] )) {
	die ();
}

$attach = tableParser ( 'profiles', 'getAttachment', array ('id' => ( int ) $_GET ['id'] ) );
if (isset ( $attach ['attachment'] ) && isset ( $attach ['attachext'] )) {
	header ( 'Content-Disposition: attachment; filename="' . $attach ['attachment'] . '.' . $attach ['attachext'] . '"' );
	
	//generate attachs' path
	$attach = ATTACH_PATH . '/' . $attach ['attachment'] . '.' . $attach ['attachext'];
	
	if (! file_exists ( $attach )) {
		die ();
	}
	
	echo gzuncompress ( file_get_contents ( $attach ) );
} else {
	die ();
}
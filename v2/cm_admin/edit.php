<?php
/**
 * Client Manager
 * 
 * Edit Form
 * @package Client Manager 0.2 alpha
 * @author Jin Cong<onionboy@live.com.my>
 */

define ( 'LOAD_TEMPLATE', true );
define ( 'LOAD_FORM', true );
define ( 'LOAD_MYSQL', true );
define ( 'IN_ADMIN', true );
require '../cm_includes/entry.php';

isset ( $_GET ['id'] ) ? $id = ( int ) $_GET ['id'] : header ( "Location: " . CM_ROOT . '/cm_admin/' );

if (isset ( $_GET ['delete'] ) && $_GET ['delete'] == 1) {
	$tpl->assign ( 'tooltip', tableParser ( 'profiles', 'delete', array ('id' => $id ) ) ? 'You have successfuly delete the profile.<br />Check out more profiles <a href="' . CM_URL . '/cm_admin/list.php">here</a>.' : 'Delete the profile resulted failed.' );
} else {
	$frm = new SpoonForm ( 'profile' );
	$get_user = tableParser ( 'profiles', 'getProf', array ('id' => $id ) );
	
	if (empty ( $get_user )) {
		$tpl->assign ( 'tooltip', 'Profile not available' );
	} else {
		//set form value
		$pf = parseForm ( $frm, 'profile', $get_user );
		$update = ($pf [0] == 3) ? tableParser ( 'profiles', 'update', array_merge ( $pf [1], array ('id' => $id ) ) ) : false;
		
		//set profile image & attachment path
		(isset ( $get_user ['photo'] ) && strlen ( $get_user ['photo'] ) > 0) && $tpl->assign ( 'photo_path', CM_URL . '/cm_api/images.php?thumbnail=1&id=' . $id );
		(isset ( $get_user ['attachment'] ) && strlen ( $get_user ['attachment'] ) > 0) && $tpl->assign ( 'attach_path', CM_URL . '/cm_api/attachments.php?id=' . $id );
		
		$tpl->assign ( 'id', $id );
		$tpl->assign ( 'lastupdate', date ( DATE_RFC822, $get_user ['lastupdate'] ) );
		
		if ($pf [0] == 3) {
			$tpl->assign ( 'tooltip', $update ? 'You have successfuly edit the profile.<br />' : 'Edit the profile resulted failed.' );
		}
		
		$frm->parse ( $tpl );
	}
}
$tpl->display ( tpl_path ( 'admin_edit.tpl.php' ) );
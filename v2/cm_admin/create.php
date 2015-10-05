<?php
/**
 * Client Manager
 * 
 * Create Profile Form
 * @package Client Manager 0.2 alpha
 * @author Jin Cong<onionboy@live.com.my>
 */

define ( 'LOAD_TEMPLATE', true );
define ( 'LOAD_FORM', true );
define ( 'LOAD_MYSQL', true );
define ( 'IN_ADMIN', true );
require '../cm_includes/entry.php';

$frm = new SpoonForm ( 'profile' );
$pf = parseForm ( $frm, 'profile' );
($pf [0] == 3) && $pf [1] = $mysql->insert ( 'profiles', $pf [1] );

if ($pf [0] == 3 && $pf [1]) {
	$tpl->assign ( 'tooltip', 'You have successfuly create a new profile. More Action ?<br /> <a href="' . CM_URL . '/cm_admin/edit.php?id=' . $pf [1] . '">Edit</a> | <a href="' . CM_URL . '/cm_admin/profile.php?id=' . $pf [1] . '">Print</a> | <a href="' . CM_URL . '/cm_admin/edit.php?id=' . $pf [1] . '&delete=1">Delete</a> or Create a new Profile <a href="' . CM_URL . '/cm_admin/create.php">here</a>.' );
} elseif ($pf [0] == 3 && ! $pf [1]) {
	$tpl->assign ( 'tooltip', 'Creating new profile resulted failed.' );
	$frm->parse ( $tpl );
} else {
	$frm->parse ( $tpl );
}

$tpl->display ( tpl_path ( 'admin_create.tpl.php' ) );

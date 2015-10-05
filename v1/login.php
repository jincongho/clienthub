<?php
/**
 * Client Manager
 * 
 * Login Page to the system.
 * @package Client Manager
 * @author Jin Cong<onionboy@live.com.my>
 */

define ( 'LOAD_TEMPLATE', true );
define ( 'LOAD_HEADER', true );
define ( 'IN_LOGIN', true );
require 'loader.php';

//create new SpoonForm
$frm = new SpoonForm ( 'login' );

//create form element
$frm->addText ( 'adminname' );
$frm->addPassword ( 'adminpw' );
$frm->addButton ( 'submit', 'Submit' );

if ($frm->isSubmitted ()) {
	if ($frm->getField ( 'adminname' )->getValue () == ADMINNAME && $frm->getField ( 'adminpw' )->getValue () == ADMINPASSWORD) {
		$_SESSION ['logined'] = true;
		$_SESSION ['adminname'] = $frm->getField ( 'adminname' )->getValue ();
		$_SESSION ['adminpw'] = $frm->getField ( 'adminpw' )->getValue ();
		$_SESSION ['expired'] = time () + ADMINEXPIRED;
		header ( 'Location: ' . BASE_URL . '/' );
		$tpl->assign('tooltip', 'Login Success! System will auto redirect you to front page, <a href="'.BASE_URL.'/index.php">click here if not</a>.');
	} else {
		$tpl->assign ( 'tooltip', 'Admin name or Admin password is not correct!' );
	}
}

$frm->parse ( $tpl );
$tpl->display ( ROOT_PATH . '/' . TEMPLATE_PATH . '/login.tpl.php' );
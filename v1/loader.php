<?php
/**
 * Client Manager
 * 
 * Loader in the system. Shall be required in all file throughout the system.
 * Load Spoon Library, Configuration File and Check User Role too.
 * @package Client Manager
 * @author Jin Cong<onionboy@live.com.my>
 */
error_reporting ( 0 );

//load Spoon Library for PHP5 and Configuration File
require_once 'config.php';
require_once 'spoon/spoon.php';

//checking configuration file
if (! defined ( 'ADMINNAME' ) || ! defined ( 'ADMINPASSWORD' ) || ! defined ( 'ADMINEXPIRED' ) || ! defined ( 'MYSQL_HOST' ) || ! defined ( 'MYSQL_DB' ) || ! defined ( 'MYSQL_UN' ) || ! defined ( 'MYSQL_PW' ) || ! defined ( 'SITE_TITLE' ) || ! defined ( 'BASE_URL' ) || ! defined ( 'ROOT_PATH' ) || ! defined ( 'TEMPLATE_PATH' ) || ! defined ( 'CONTENTS_PATH' ) || ! defined ( 'IMAGE_MAX' ) || ! defined ( 'IMAGE_PATH' ) || ! defined ( 'COMPILE_PATH' )) {
	die ( 'Configurations in config.php is not completed!' );
}

if (substr ( BASE_URL, - 1 ) == '/' || substr ( BASE_URL, - 1 ) == '\\') {
	die ( 'BASE_URL config error in config.php. (Should not contain "\" or "/" in last word!)' );
}

if (! isset ( $_SESSION ))
	session_start ();

	//authentication
if (! defined ( 'IN_API' ) && ! defined ( 'IN_LOGIN' )) {
	if (! isset ( $_SESSION ['expired'] ) || time () > $_SESSION ['expired'] || ! isset ( $_SESSION ['logined'] ) || $_SESSION ['logined'] != true || $_SESSION ['adminname'] != ADMINNAME || $_SESSION ['adminpw'] != ADMINPASSWORD) {
		if (defined ( IN_PHOTO )) {
			die ();
		}
		header ( 'Location: ' . BASE_URL . '/login.php' );
	}
}

//loading mysql system
$mysql = new SpoonDatabase ( 'mysql', MYSQL_HOST, MYSQL_UN, MYSQL_PW, MYSQL_DB );

if (defined ( 'LOAD_TEMPLATE' )) {
	//loading template system
	$tpl = new SpoonTemplate ();
	$tpl->setForceCompile ( true );
	$tpl->setCompileDirectory ( COMPILE_PATH );
	
	//loading 
	$tpl->assign ( 'title', SITE_TITLE );
	$tpl->assign ( 'base_url', BASE_URL );
	$tpl->assign ( 'css_path', BASE_URL . '/' . CONTENTS_PATH . '/css/style.css' );
	$tpl->assign ( 'jquery_path', BASE_URL . '/' . CONTENTS_PATH . '/js/jquery-1.6.4.min.js' );
	$tpl->assign ( 'profiles_total', count ( $mysql->getRecords ( 'SELECT `id` FROM `profiles` WHERE `status` !=  \'trash\'' ) ) );
	$tpl->assign ( 'expired', round ( ($_SESSION ['expired'] - time ()) / 60, 1 ) ); //expired time in minutes
	$tpl->assign ( 'adminname', md5 ( ADMINNAME ) );
	$tpl->assign ( 'adminpw', md5 ( ADMINPASSWORD ) );
}

if (defined ( 'IN_LOGIN' )) {
	$tpl->assign ( 'login', true );
}

if (defined ( 'LOAD_TEMPLATE' ) && defined ( 'LOAD_HEADER' ))
	$tpl->display ( ROOT_PATH . '/' . TEMPLATE_PATH . '/header.tpl.php' );

function setMulAttributes(&$frm, array $id, $key, $value, $type = 'Text') {
	$function = "add" . $type;
	foreach ( $id as $element ) {
		$frm->$function ( $element )->setAttribute ( $key, $value );
	}
}

function setCompanyValue(&$frm, $value) {
	$values = explode ( ', ', $value );
	$count = -1;
	for($i = 1; $i < 6; $i ++) {
		$frm->addText ( 'company' . $i, $values [$count += 1] )->setAttribute ( "placeholder", "公司名字 company name" );
		$frm->addText ( 'registerno' . $i, $values [$count += 1] )->setAttribute ( "placeholder", "注册号码 registration number" );
		$frm->addText ( 'companyno' . $i, $values [$count += 1] )->setAttribute ( "placeholder", "公司号码 Company number" );
		$frm->addText ( 'companyemail' . $i, $values [$count += 1] )->setAttribute ( "placeholder", "公司电邮 Company email" );
		$frm->addTextarea ( 'shareholder'.$i, $values[$count += 1] )->setAttribute ( "placeholder", "公司股东 Shareholder" );
		$frm->addTextarea ( 'registeraddr' . $i, $values [$count += 1] )->setAttribute ( "placeholder", "注册地址 Registered Address" );
		$frm->addTextarea ( 'businessaddr' . $i, $values [$count += 1] )->setAttribute ( "placeholder", "营业地址Business Address" );
	}
}

function setChildValue(&$frm, $value) {
	$values = explode ( ', ', $value );
	$count = - 1;
	for($i = 1; $i < 4; $i ++) {
		$frm->addText ( 'child' . $i, $values [$count ++] );
	}
}
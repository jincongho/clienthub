<?php
/**
 * Client Manager
 * 
 * Create an API to delete a profile.
 * @package Client Manager
 * @author Jin Cong<onionboy@live.com.my>
 */
if (empty ( $_POST ['id'] ))
	die ( '0' );

define('IN_API', true);
require 'loader.php';

if ($_POST ['adminname'] == md5(ADMINNAME) && $_POST ['adminpw'] == md5(ADMINPASSWORD)) {
	$delete = $mysql->update ( 'profiles', array('status' => 'trash'), 'id = ?', ( int ) $_POST ['id'] );
	echo ($delete > 0) ? "1" : "0";
} else {
	die ( '0' );
}
<?php
/**
 * Client Manager
 * 
 * This file create an api to view photo in profile.
 * @package Client Manager
 * @author Jin Cong<onionboy@live.com.my>
 */

define('IN_PHOTO', true);
require 'loader.php';

if(!isset($_GET['id'])){
	die();
}

$image = $mysql->getRecord('SELECT `photo`, `photoext` FROM `profiles` WHERE `id` = \''.(int)$_GET['id'].'\' AND `status` !=  \'trash\'');
if(isset($image['photo']) && isset($image['photoext'])){
	header('Content-Type: image/'.$image['photoext']);
	
	//generate images' path
	$image['photo'] = IMAGE_PATH . '/' . $image['photo']; 
	if(isset($_GET['thumbnail']) && $_GET['thumbnail'] == 1) {
		$image['photo'] .= '_thumbnail';
	}
	$image['photo'] .= '.'.$image['photoext'];

	if(!file_exists($image['photo'])){
		die();
	}
	
	echo file_get_contents($image['photo']);
}else{
	die();
}
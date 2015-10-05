<?php
/**
 * Client Manager
 * 
 * Show user profile image
 * @package Client Manager 0.2 alpha
 * @author Jin Cong<onionboy@live.com.my>
 */

define('IN_IMAGE', true);
define('LOAD_MYSQL', true);
require '../cm_includes/entry.php';

if(empty($_GET['id'])){
	die();
}

$image = tableParser('profiles', 'getPhoto', array('id' => $_GET['id']));
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
	
	echo gzuncompress(file_get_contents($image['photo']));
}else{
	die();
}
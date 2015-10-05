<?php
/**
 * Client Manager
 * 
 * Create an API for checking user availablity through name
 * @package Client Manager
 * @author Jin Cong<onionboy@live.com.my>
 */

define('IN_API', true);
require 'loader.php';

$json = array();

if (isset($_POST['name']) && $_POST ['adminname'] == md5(ADMINNAME) && $_POST ['adminpw'] == md5(ADMINPASSWORD)) {
	$getUser = $mysql-> getRecords( 'SELECT `id` FROM `profiles` WHERE `name` = \''.$_POST['name'].'\' AND `status` !=  \'trash\'' );
    if(count($getUser) > 1){
    	$json['count'] = count($getUser);
    	foreach($getUser as $key=>$value){
    		$json['profiles'][] = $value['id'];
    	}
    }elseif(count($getUser) == 1){
    	$json['count'] = count($getUser);
    	$json['profiles'] = $getUser[0]['id'];
    }else{
    	$json['count'] = 0;
    }
} else {
	$json['count'] = 0;
}

echo json_encode($json);
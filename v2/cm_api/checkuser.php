<?php
/**
 * Client Manager
 * 
 * CM API for checking username availability
 * @package Client Manager 0.2 alpha
 * @author Jin Cong<onionboy@live.com.my>
 */

if (empty ( $_POST ['name'] ))
	die ();

define ( 'IN_API', true );
define ( 'LOAD_MYSQL', true );
require '../cm_includes/entry.php';

$getUser = tableParser ( 'profiles', 'getName', array('name' => $_POST ['name']) );

if (count ( $getUser ) > 1) {
	$json ['count'] = count ( $getUser );
	foreach ( $getUser as $key => $value ) {
		$json ['profiles'] [] = $value ['id'];
	}
} elseif (count ( $getUser ) == 1) {
	$json ['count'] = 1;
	$json ['profiles'] = $getUser [0] ['id'];
} else {
	$json ['count'] = 0;
}

echo json_encode($json);
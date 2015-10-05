<?php
/**
 * Client Manager
 * 
 * CM API for delete a user
 * @package Client Manager 0.2 alpha
 * @author Jin Cong<onionboy@live.com.my>
 */

if (empty ( $_POST ['id'] ))
	die ();

define ( 'IN_API', true );
define ( 'LOAD_MYSQL', true );
require '../cm_includes/entry.php';

echo (tableParser ( 'profiles', 'delete', array ('id' => ( int ) $_POST ['id'] ) ) > 0) ? 1 : 0;
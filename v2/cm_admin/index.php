<?php
/**
 * Client Manager
 * 
 * Main Page of CM
 * @package Client Manager 0.2 alpha
 * @author Jin Cong<onionboy@live.com.my>
 */

define('LOAD_TEMPLATE', true);
define('LOAD_MYSQL', true);
define('IN_ADMIN', true);
require '../cm_includes/entry.php';

$tpl->assign('total', count(tableParser('profiles', 'getTotal')));
$tpl->assign('expired', round((SpoonSession::get('expiredTime') - time())/60, 1));
$tpl->display(tpl_path('admin_index.tpl.php'));
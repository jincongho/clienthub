<?php
/**
 * Client Manager
 * 
 * Login Page
 * @package Client Manager 0.2 alpha
 * @author Jin Cong<onionboy@live.com.my>
 */

define ( 'LOAD_TEMPLATE', true );
define ( 'LOAD_FORM', true );
define ( 'LOAD_MYSQL', true );
define ( 'IN_LOGIN', true );
require '../cm_includes/entry.php';

$frm = new SpoonForm ( 'login' );
$pf = parseForm ( $frm, 'login' );
($pf [0] == 3 && $pf [1]) && header ( 'Location: ' . CM_URL . '/cm_admin' );

$frm->parse ( $tpl );
$tpl->display ( tpl_path ( 'login.tpl.php' ) );
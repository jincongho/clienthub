<?php
/**
 * Client Manager
 * 
 * Template Builder
 * @package Client Manager 0.2 alpha
 * @author Jin Cong<onionboy@live.com.my>
 */

! defined ( "IN_CM" ) && exit ();

$tpl = new SpoonTemplate ();
$tpl->setForceCompile ( true );
$tpl->setCompileDirectory ( COMPILE_PATH );

$tpl->assign ( 'root', CM_ROOT );
$tpl->assign ( 'base_url', CM_URL );
$tpl->assign ( 'securimage', CM_URL . '/cm_includes/securimage' );
$tpl->assign ( 'securimageEncode', urlencode ( CM_URL . '/cm_includes/securimage/' ) );
$tpl->assign ( 'tpl_path', CM_ROOT . '/cm_includes/templates' );
$tpl->assign ( 'css_path', CM_URL . '/cm_contents/css' );
$tpl->assign ( 'js_path', CM_URL . '/cm_contents/js' );
$tpl->assign ( 'adminname', md5 ( ADMINNAME ) );
$tpl->assign ( 'adminpw', md5 ( ADMINPASSWORD ) );

$menu = array ("Home" => array ("label" => "Home", "href" => CM_URL . '/cm_admin', 'image' => CM_URL . '/cm_contents/images/home.png' ), "Create" => array ("label" => "Create", "href" => CM_URL . '/cm_admin/create.php', 'image' => CM_URL . '/cm_contents/images/add_user.png' ), "List" => array ("label" => "List", "href" => CM_URL . '/cm_admin/list.php', 'image' => CM_URL . '/cm_contents/images/list.png' ), "Search" => array ("label" => "Search", "href" => CM_URL . '/cm_admin/search.php', "target" => "_blank", 'image' => CM_URL . '/cm_contents/images/search.png' ) );
$tpl->assign ( 'menu', $menu );

return $tpl;
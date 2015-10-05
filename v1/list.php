<?php
define ( 'LOAD_TEMPLATE', true );
define ( 'LOAD_HEADER', true );
require 'loader.php';

$query = "SELECT `id`, `photo`, `file`, `case`, `name`, `ic`, `company` FROM `profiles` WHERE `status` !=  'trash'";
$query = $mysql->getRecords ( $query );

if (count ( $query ) > 0) {
	$tpl->assign ( 'isResult', true );
	foreach ( $query as $key => $value ) {
		if (isset ( $value ['photo'] )) {
			$query [$key] ['photo'] = '<img src="' . BASE_URL . '/images.php?id=' . $value ['id'] . '&thumbnail=1" />';
		}
		$query [$key] ['action'] = '<a href="' . BASE_URL . '/edit.php?id=' . $value ['id'] . '" target="_blank">Edit</a><br /><a href="' . BASE_URL . '/profile.php?id=' . $value ['id'] . '" target="_blank">Print</a><br /><a href="" id="' . $value ['id'] . '" class="delProfile">Delete</a>';
	}
	
	//datagrid, generating results table
	$grid = new SpoonDataGridSourceArray ( $query );
	$datagrid = new SpoonDatagrid ( $grid );
	$datagrid->setColumnHidden ( 'id' );
	$datagrid->setPagingLimit(10000);
	$datagrid->setHeaderLabels ( array ('file' => '档案 File', 'case' => '案情 Case', 'photo' => '照片 Photo', 'name' => '姓名 Name', 'ic' => '身份证 IC', 'company' => '公司 Company', 'action' => '操作' ) );
	
	$tpl->assign ( 'results', $datagrid->getContent () );
} else {
	$tpl->assign ( 'tooltip', 'No Relevant Results.' );
}

$tpl->display ( ROOT_PATH . '/' . TEMPLATE_PATH . '/list.tpl.php' );
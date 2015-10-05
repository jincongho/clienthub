<?php
define ( 'LOAD_TEMPLATE', true );
define ( 'LOAD_FORM', true );
define ( 'LOAD_MYSQL', true );
define ( 'IN_ADMIN', true );
define ( 'IN_SEARCH', true );
require '../cm_includes/entry.php';

$tpl->assign ( 'isSearch', true );
$frm = new SpoonForm ( 'profile', NULL, 'get' );
$pf = parseForm ( $frm, 'profile' );

if ($pf [0] == 3) {
	$query = tableParser ( 'profiles', 'searchLimit', $frm->getValues ( 'form', 'submit', '_utf8' ) );
	if (count ( $query ) > 0) {
		$tpl->assign ( 'isResult', true );
		foreach ( $query as $key => $value ) {
			if (isset ( $value ['photo'] )) {
				$query [$key] ['photo'] = '<img src="' . CM_URL . '/cm_api/images.php?id=' . $value ['id'] . '&thumbnail=1" />';
			}
			$query [$key] ['action'] = '<a href="' . CM_URL . '/cm_admin/edit.php?id=' . $value ['id'] . '" target="_blank">Edit</a><br /><a href="' . CM_URL . '/cm_admin/profile.php?id=' . $value ['id'] . '" target="_blank">Print</a><br /><a href="" id="' . $value ['id'] . '" class="delProfile">Delete</a>';
			if(isset($query[$key]['attachment']) && strlen($query[$key]['attachment']) > 0){
				$query[$key]['action'] .= '<br /><a href="' . CM_URL . '/cm_api/attachments.php?id=' . $value ['id'] . '" target="_blank">Attach</a>';
		
			}
		}
		
		//datagrid, generating results table
		$grid = new SpoonDataGridSourceArray ( $query );
		$datagrid = new SpoonDatagrid ( $grid );
		$datagrid->setColumnsHidden ( 'id', 'attachment');
		$datagrid->setCompileDirectory ( COMPILE_PATH );
		$url = ($_SERVER['QUERY_STRING']) ? cleanQuery($_SERVER['QUERY_STRING']).'offset=[offset]&order=[order]&sort=[sort]' : '?offset=[offset]&order=[order]&sort=[sort]';
		$datagrid->setURL ( $url );
		$datagrid->setSortingColumns ( array ('file', 'name', 'ic', 'id' ), 'id' );
		$datagrid->setPagingLimit ( PAGING_LIMIT );
		$datagrid->setHeaderLabels ( array ('file' => '档案 File', 'case' => '案情 Case', 'photo' => '照片 Photo', 'name' => '姓名 Name', 'ic' => '身份证 IC', 'action' => '操作' ) );
		
		$tpl->assign ( 'results', $datagrid->getContent () );
	} else {
		$tpl->assign ( 'tooltip', 'No Relevant Results.' );
		$frm->parse ( $tpl );
	}
} else {
	$frm->parse ( $tpl );
}
$tpl->display ( tpl_path ( 'admin_search.tpl.php' ) );

function cleanQuery($query){
	parse_str($query, $str);
	unset($str['offset']);
	unset($str['order']);
	unset($str['sort']);
	$query = "?";
	foreach($str as $key=>$value){
		$query .= $key.'='.$value.'&';
	}
	
	return $query;
}
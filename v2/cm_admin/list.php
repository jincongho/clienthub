<?php
/**
 * Client Manager
 * 
 * List all user profile
 * @package Client Manager 0.2 alpha
 * @author Jin Cong<onionboy@live.com.my>
 */

define ( 'LOAD_TEMPLATE', true );
define ( 'LOAD_MYSQL', true );
define ( 'IN_ADMIN', true );
require '../cm_includes/entry.php';

$records = tableParser ( 'profiles', 'getList' );

if (count ( $records ) > 0) {
	$tpl->assign ( 'isResult', true );
	
	foreach ( $records as $key => $value ) {
		if (isset ( $value ['photo'] )) {
			$records [$key] ['photo'] = '<img src="' . CM_URL . '/cm_api/images.php?id=' . $value ['id'] . '&thumbnail=1" />';
		}
		$records [$key] ['action'] = '<a href="' . CM_URL . '/cm_admin/edit.php?id=' . $value ['id'] . '" target="_blank">Edit</a><br /><a href="' . CM_URL . '/cm_admin/profile.php?id=' . $value ['id'] . '" target="_blank">Print</a><br /><a href="" id="' . $value ['id'] . '" class="delProfile">Delete</a>';
		if(isset($value['attachment']) && strlen($value['attachment']) > 0){
			$records[$key]['action'] .= '<br /><a href="' . CM_URL . '/cm_api/attachments.php?id=' . $value ['id'] . '" target="_blank">Attach</a>';
		}
		$records [$key] ['company'] = getCompanyValue ( $value ['company'] );
	}
	
	//datagrid, generating results table
	$grid = new SpoonDataGridSourceArray ( $records );
	$datagrid = new SpoonDatagrid ( $grid );
	$datagrid->setCompileDirectory ( COMPILE_PATH );
	$datagrid->setURL ( '?offset=[offset]&order=[order]&sort=[sort]' );
	$datagrid->setPagingLimit ( PAGING_LIMIT );
	$datagrid->setColumnHidden('attachment');
	$datagrid->setSortingColumns ( array ('file', 'name', 'ic', 'id' ), 'id' );
	$datagrid->setHeaderLabels ( array ('file' => '档案<br />File', 'case' => '案情<br />Case', 'photo' => '照片Photo', 'name' => '姓名 <br />Name', 'ic' => '身份证 IC', 'company' => '公司 1<br />Company', 'action' => 'Action<br />操作' ) );
	
	$tpl->assign ( 'results', $datagrid->getContent () );
} else {
	$tpl->assign ( 'tooltip', 'No Relevant Results.' );
}

$tpl->display ( tpl_path ( 'admin_list.tpl.php' ) );

/**
 * Return first company details
 * 
 * @return string
 * @param string $value
 */
function getCompanyValue($value) {
	$values = explode ( ', ', $value );
	$count = - 1;
	return $values [$count += 1];
}
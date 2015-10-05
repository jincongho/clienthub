<?php
/**
 * Client Manager
 * 
 * Search engine.
 * @package Client Manager
 * @author Jin Cong<onionboy@live.com.my>
 */

define ( 'LOAD_TEMPLATE', true );
define ( 'LOAD_HEADER', true );
require 'loader.php';

//create new SpoonForm
$frm = new SpoonForm ( 'searchProfile' );

//create forms elements
$frm->addTexts ( 'file', 'case', 'name', 'ic', 'placeofbirth', 'education', 'language', 'race', 'faith', 'maritalstatus', 'nationality', 'profession', 'epf', 'banker', 'contactno', 'email', 'platesno', 'assets', 'eye', 'hair', 'skin', 'dna', 'company', 'registerno', 'companyno', 'companyemail' );
$frm->addTextareas ( 'address', 'family', 'registeraddr', 'businessaddr', 'remarks' );
$frm->addDropdown ( 'gender', array ('' => '', 'male' => 'Male', 'female' => 'Female' ) );
$frm->addText ( 'height' )->setAttribute ( 'placeholder', 'digits only' );
$frm->addText ( 'weight' )->setAttribute ( 'placeholder', 'digits only' );
$frm->addDropdown ( 'blood', array ('' => '', 'O+' => 'O+', 'A+' => 'A+', 'B+' => 'B+', 'AB+' => 'AB+', 'O-' => 'O-', 'A-' => 'A-', 'B-' => 'B-', 'AB-' => 'AB-' ) );
$frm->addButton ( 'submit', 'Submit' );

if ($frm->isSubmitted ()) {
	//generate query
	$query = 'SELECT `id`, `photo`, `file`, `case`, `name`, `ic`, `company` FROM `profiles` WHERE `status` !=  \'trash\' ';
	$value = $frm->getValues ( 'form', 'submit', '_utf8' );
	foreach ( $value as $key => $value ) {
		if ($value != NULL) {
			$query .= 'AND ';
			$query .= '`' . $key . '` LIKE \'%';
			$query .= ( string ) $value;
			$query .= '%\' ';
		}
	}
	
	//get results
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
		$datagrid->setHeaderLabels ( array ('file' => '档案 File', 'case' => '案情 Case', 'photo' => '照片 Photo', 'name' => '姓名 Name', 'ic' => '身份证 IC', 'company' => '公司 Company', 'action' => '操作' ) );
		
		$tpl->assign ( 'results', $datagrid->getContent () );
	} else {
		$tpl->assign ( 'tooltip', 'No Relevant Results.' );
		$frm->parse($tpl);
	}
} else {
	$frm->parse ( $tpl );
}
$tpl->display ( ROOT_PATH . '/' . TEMPLATE_PATH . '/search.tpl.php' );
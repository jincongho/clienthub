<?php
/**
 * Client Manager
 * 
 * Front to the system. This file build form to create a profile.
 * @package Client Manager
 * @author Jin Cong<onionboy@live.com.my>
 */
define ( 'LOAD_TEMPLATE', true );
define ( 'LOAD_HEADER', true );
require 'loader.php';

//create new SpoonForm
$frm = new SpoonForm ( 'newProfile' );

//create forms elements
$frm->addTexts ( 'file', 'case', 'name', 'ic', 'placeofbirth', 'education', 'language', 'race', 'faith', 'maritalstatus', 'nationality', 'profession', 'epf', 'banker', 'contactno', 'email', 'platesno', 'assets', 'eye', 'hair', 'skin', 'dna' );
for($i = 1; $i < 6; $i ++) {
	$frm->addText ( 'company'.$i )->setAttribute ( "placeholder", "公司名字 company name" );
	$frm->addText ( 'registerno'.$i )->setAttribute ( "placeholder", "注册号码 registration number" );
	$frm->addText ( 'companyno'.$i )->setAttribute ( "placeholder", "公司号码 Company number" );
	$frm->addText ( 'companyemail'.$i )->setAttribute ( "placeholder", "公司电邮 Company email" );
	$frm->addTextarea ( 'shareholder'.$i )->setAttribute ( "placeholder", "公司股东 Shareholder" );
	$frm->addTextarea ( 'registeraddr'.$i )->setAttribute ( "placeholder", "注册地址 Registered Address" );
	$frm->addTextarea ( 'businessaddr'.$i )->setAttribute ( "placeholder", "营业地址Business Address" );
}
$frm->addTextareas ( 'address', 'family', 'remarks', 'casereport' );
$frm->addImage ( 'photo' );
$frm->addDropdown ( 'gender', array ('' => '', 'male' => 'Male', 'female' => 'Female' ) );
$frm->addText ( 'height' )->setAttribute ( 'placeholder', 'digits only' );
$frm->addText ( 'weight' )->setAttribute ( 'placeholder', 'digits only' );
$frm->addDropdown ( 'blood', array ('' => '', 'O+' => 'O+', 'A+' => 'A+', 'B+' => 'B+', 'AB+' => 'AB+', 'O-' => 'O-', 'A-' => 'A-', 'B-' => 'B-', 'AB-' => 'AB-' ) );
$frm->addButton ( 'submit', 'Submit' );

//if form submitted
if ($frm->isSubmitted ()) {
	$frm->getField ( 'name' )->isFilled ( 'Please Fill in Client\'s Name.' );
	if ($frm->getField ( 'email' )->isFilled ()) {
		$frm->getField ( 'email' )->isEmail ( 'Please provide a valid email address.' );
	}
	for($i = 1; $i < 6; $i ++) {
		if ($frm->getField ( 'companyemail'.$i )->isFilled ()) {
			$frm->getField ( 'companyemail'.$i )->isEmail ( 'Please provide a valid email address.' );
		}
	}
	if ($frm->getField ( 'photo' )->isFilled ()) {
		if ($frm->getField ( 'photo' )->isAllowedExtension ( array ('jpg', 'png', 'gif', 'jpeg' ), 'Only jpg/gif/png/jpeg are allowed.' )) {
			$frm->getField ( 'photo' )->isFilesize ( IMAGE_MAX, 'kb', 'smaller', 'Too large. ' . IMAGE_MAX . 'kb maximum!' );
		}
	}
	if (! in_array ( $frm->getField ( 'gender' )->getValue (), array ('', 'male', 'female' ) )) {
		$frm->getField ( 'gender' )->setError ( 'Please choose from the list only!' );
	}
	if (! in_array ( $frm->getField ( 'blood' )->getValue (), array ('', 'O+', 'A+', 'B+', 'AB+', 'O-', 'A-', 'B-', 'AB-' ) )) {
		$frm->getField ( 'blood' )->setError ( 'Please choose from the list only!' );
	}
	if ($frm->getField ( 'height' )->isFilled ()) {
		$frm->getField ( 'height' )->isNumeric ( 'Digits only please! eg: 180' ); //it needs to be numeric! 
	}
	if ($frm->getField ( 'weight' )->isFilled ()) {
		$frm->getField ( 'weight' )->isNumeric ( 'Digits only please! eg: 80' ); //it needs to be numeric! 
	}
	if ($frm->isCorrect ()) {
		if ($frm->getField ( 'photo' )->isFilled ()) {
			$imagename = uniqid ();
			SpoonFile::setContent ( IMAGE_PATH . '/' . $imagename . '.' . $frm->getField ( 'photo' )->getExtension (), SpoonFile::getContent ( $frm->getField ( 'photo' )->getTempFileName () ) );
			
			//create Thumbnail
			$frm->getField ( 'photo' )->createThumbnail ( IMAGE_PATH . '/' . $imagename . '_thumbnail.' . $frm->getField ( 'photo' )->getExtension (), 130, 130 );
		}
				
		$company = "";
		for($i = 1; $i < 6; $i ++) {
			$company .=  $frm->getField ( 'company'.$i )->getValue () . ', ' . $frm->getField ( 'registerno'.$i )->getValue () . ', ' . $frm->getField ( 'companyno'.$i )->getValue () . ', ' . $frm->getField ( 'companyemail'.$i )->getValue () . ', ' . $frm->getField('shareholder'.$i)->getValue() .', '. $frm->getField ( 'registeraddr'.$i )->getValue () . ', ' . $frm->getField ( 'businessaddr'.$i )->getValue () ;
			if($i < 6){
				$company .= ', ';
			}
		}
		
		//get values from form
		$values = array();
		for($i = 1; $i < 6; $i ++) {
			$values = array_merge($values, array( 'company'.$i, 'shareholder'.$i, 'registerno'.$i, 'companyno'.$i, 'companyemail'.$i, 'registeraddr'.$i, 'businessaddr'.$i));
		}
		$values = array_merge ( $frm->getValues ( array_merge ( array ('form', 'submit', '_utf8'), $values ) ), $frm->getField ( 'photo' )->isFilled () ? array ('photo' => $imagename, 'photoext' => $frm->getField ( 'photo' )->getExtension () ) : array (), array ("company" => $company, 'lastupdate' => time() ) );
		foreach ( $values as $key => $value ) {
			if ($value == NULL)
				unset ( $values [$key] );
		}
		
		$insert = $mysql->insert ( 'profiles', $values );
		$tpl->assign ( 'tooltip', isset ( $insert ) ? 'You have successfuly create a new profile. More Action ?<br /> <a href="' . BASE_URL . '/edit.php?id=' . $insert . '">Edit</a> | <a href="' . BASE_URL . '/profile.php?id=' . $insert . '">Print</a> | <a href="' . BASE_URL . '/edit.php?id=' . $insert . '&delete=1">Delete</a> or Create a new Profile <a href="' . BASE_URL . '">here</a>.' : 'Creating new profile resulted failed.' );
	}
}

if (! isset($insert)) {
	$frm->parse ( $tpl );
}
$tpl->display ( ROOT_PATH . '/' . TEMPLATE_PATH . '/index.tpl.php' );
<?php
/**
 * Client Manager
 * 
 * This file helps user to delete and edit profiles.
 * @package Client Manager
 * @author Jin Cong<onionboy@live.com.my>
 */

define ( 'LOAD_TEMPLATE', true );
define ( 'LOAD_HEADER', true );
require 'loader.php';

if (! isset ( $_GET ['id'] )) {
	header ( "Location: " . BASE_URL );
}

if (isset ( $_GET ['delete'] ) && $_GET ['delete'] == 1) {
	$delete = $mysql->update ( 'profiles', array ('status' => 'trash' ), 'id = ?', ( int ) $_GET ['id'] );
	$tpl->assign ( 'tooltip', $delete ? 'Profile deleted.' : 'Profile deleting failed.' );
} else {
	$get_user = $mysql->getRecord ( 'SELECT * FROM `profiles` WHERE `id` = \'' . ( int ) $_GET ['id'] . '\' AND `status` !=  \'trash\'' );
	if (empty ( $get_user )) {
		$tpl->assign ( 'tooltip', 'Profile not available' );
	} else {
		//create new SpoonForm
		$frm = new SpoonForm ( 'editProfile' );
		
		$frm->addText ( 'file', $get_user ['file'] );
		$frm->addText ( 'case', $get_user ['case'] );
		$frm->addImage ( 'photo' );
		if (! empty ( $get_user ['photo'] )) {
			$tpl->assign ( 'photo_path', BASE_URL . '/images.php?thumbnail=1&id=' . ( int ) $_GET ['id'] );
		}
		$frm->addText ( 'name', $get_user ['name'] );
		$frm->addText ( 'ic', $get_user ['ic'] );
		$frm->addDropdown ( 'gender', array ('' => '', 'male' => 'Male', 'female' => 'Female' ), $get_user ['gender'] );
		$frm->addText ( 'placeofbirth', $get_user ['placeofbirth'] );
		$frm->addText ( 'education', $get_user ['education'] );
		$frm->addText ( 'language', $get_user ['language'] );
		$frm->addText ( 'race', $get_user ['race'] );
		$frm->addText ( 'faith', $get_user ['faith'] );
		$frm->addText ( 'maritalstatus', $get_user ['maritalstatus'] );
		$frm->addText ( 'nationality', $get_user ['nationality'] );
		$frm->addText ( 'profession', $get_user ['profession'] );
		$frm->addText ( 'epf', $get_user ['epf'] );
		$frm->addText ( 'banker', $get_user ['banker'] );
		$frm->addTextarea ( 'address', $get_user ['address'] );
		$frm->addText ( 'contactno', $get_user ['contactno'] );
		$frm->addText ( 'email', $get_user ['email'] );
		$frm->addText ( 'platesno', $get_user ['platesno'] );
		$frm->addText ( 'assets', $get_user ['assets'] );
		$frm->addText ( 'height', $get_user ['height'] )->setAttribute ( 'placeholder', 'digits only' );
		$frm->addText ( 'weight', $get_user ['weight'] )->setAttribute ( 'placeholder', 'digits only' );
		$frm->addDropdown ( 'blood', array ('' => '', 'O+' => 'O+', 'A+' => 'A+', 'B+' => 'B+', 'AB+' => 'AB+', 'O-' => 'O-', 'A-' => 'A-', 'B-' => 'B-', 'AB-' => 'AB-' ), $get_user ['blood'] );
		$frm->addText ( 'eye', $get_user ['eye'] );
		$frm->addText ( 'hair', $get_user ['hair'] );
		$frm->addText ( 'skin', $get_user ['skin'] );
		$frm->addText ( 'dna', $get_user ['dna'] );
		$frm->addTextarea ( 'family', $get_user ['family'] );
		$frm->addTextarea ( 'casereport', $get_user ['casereport'] );
		setCompanyValue ( $frm, $get_user ['company'] );
		$frm->addTextArea ( 'remarks', $get_user ['remarks'] );
		$frm->addButton ( 'submit', 'Submit' );
		
		if ($frm->isSubmitted ()) { //after form submitted
			$frm->getField ( 'name' )->isFilled ( 'Please Fill in Client\'s Name.' );
			if ($frm->getField ( 'email' )->isFilled ()) {
				$frm->getField ( 'email' )->isEmail ( 'Please provide a valid email address.' );
			}
			for($i = 1; $i < 6; $i ++) {
				if ($frm->getField ( 'companyemail' . $i )->isFilled ()) {
					$frm->getField ( 'companyemail' . $i )->isEmail ( 'Please provide a valid email address.' );
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
				$values = array ();
				for($i = 1; $i < 6; $i ++) {
					$values = array_merge ( $values, array ('company' . $i, 'shareholder' . $i, 'registerno' . $i, 'companyno' . $i, 'companyemail' . $i, 'registeraddr' . $i, 'businessaddr' . $i ) );
				}
				$values = array_merge ( $frm->getValues ( array_merge ( array ('form', 'submit', '_utf8' ), $values ) ), $frm->getField ( 'photo' )->isFilled () ? array ('photo' => $imagename, 'photoext' => $frm->getField ( 'photo' )->getExtension () ) : array (), array ("company" => $company, 'lastupdate' => time () ) );
				foreach ( $values as $key => $value ) {
					if ($value == NULL)
						unset ( $values [$key] );
				}
				
				$insert = $mysql->update ( 'profiles', $values, 'id = ?', ( int ) $_GET ['id'] );
				
				//return tooltip
				$tpl->assign ( 'tooltip', $insert ? 'You have successfuly update the profile.' : 'Updating the profile resulted failed and nothing changed.' );
			
			}
		}
		
		$frm->parse ( $tpl ); //SpoonForm parsing templates
		$tpl->assign ( 'id', $_GET ['id'] );
	}
}
$tpl->display ( ROOT_PATH . '/' . TEMPLATE_PATH . '/edit.tpl.php' );
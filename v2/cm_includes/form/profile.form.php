<?php

class ProfileForm implements cmForm {
	
	private static $form = array ("Text" => array ('file', 'case', 'name', 'ic', 'placeofbirth', 'education', 'language', 'race', 'faith', 'maritalstatus', 'nationality', 'profession', 'epf', 'banker', 'contactno', 'email', 'platesno', 'assets', 'eye', 'hair', 'skin', 'dna', 'company' ), "Textarea" => array ('address', 'family', 'remarks', 'casereport' ), "Image" => array ('photo' ), "Dropdown" => array ('gender', 'blood' ), "File" => array('attachment'), "Button" => array ('submit' ) );
	
	private static $hw = array ("Text" => array ('height', 'weight' ) );
	
	private static $form_value = array ("submit" => "Submit", "gender" => array ('' => '', 'male' => 'male', 'female' => 'female' ), "blood" => array ('' => '', 'O+' => 'O+', 'A+' => 'A+', 'B+' => 'B+', 'AB+' => 'AB+', 'O-' => 'O-', 'A-' => 'A-', 'B-' => 'B-', 'AB-' => 'AB-' ) );
	
	public static function form(&$frm, array $value = NULL) {
		if (! isset ( $value )) {
			setTypeAttributes ( $frm, self::$form, self::$form_value );
			setTypeAttributes ( $frm, self::$hw, array (), array ('placeholder' => 'digits only' ) );
			self::generateComp ( $frm );
		} else {
			self::setValues ( $frm, $value );
		}
	}
	
	private static function setValues(&$frm, array $value) {
		$frm->addText ( 'file', $value ['file'] );
		$frm->addText ( 'case', $value ['case'] );
		$frm->addImage ( 'photo' );
		$frm->addFile('attachment');
		$frm->addText ( 'name', $value ['name'] );
		$frm->addText ( 'ic', $value ['ic'] );
		$frm->addDropdown ( 'gender', array ('' => '', 'male' => 'Male', 'female' => 'Female' ), $value ['gender'] );
		$frm->addText ( 'placeofbirth', $value ['placeofbirth'] );
		$frm->addText ( 'education', $value ['education'] );
		$frm->addText ( 'language', $value ['language'] );
		$frm->addText ( 'race', $value ['race'] );
		$frm->addText ( 'faith', $value ['faith'] );
		$frm->addText ( 'maritalstatus', $value ['maritalstatus'] );
		$frm->addText ( 'nationality', $value ['nationality'] );
		$frm->addText ( 'profession', $value ['profession'] );
		$frm->addText ( 'epf', $value ['epf'] );
		$frm->addText ( 'banker', $value ['banker'] );
		$frm->addTextarea ( 'address', $value ['address'] );
		$frm->addText ( 'contactno', $value ['contactno'] );
		$frm->addText ( 'email', $value ['email'] );
		$frm->addText ( 'platesno', $value ['platesno'] );
		$frm->addText ( 'assets', $value ['assets'] );
		$frm->addText ( 'height', $value ['height'] )->setAttribute ( 'placeholder', 'digits only' );
		$frm->addText ( 'weight', $value ['weight'] )->setAttribute ( 'placeholder', 'digits only' );
		$frm->addDropdown ( 'blood', array ('' => '', 'O+' => 'O+', 'A+' => 'A+', 'B+' => 'B+', 'AB+' => 'AB+', 'O-' => 'O-', 'A-' => 'A-', 'B-' => 'B-', 'AB-' => 'AB-' ), $value ['blood'] );
		$frm->addText ( 'eye', $value ['eye'] );
		$frm->addText ( 'hair', $value ['hair'] );
		$frm->addText ( 'skin', $value ['skin'] );
		$frm->addText ( 'dna', $value ['dna'] );
		$frm->addTextarea ( 'family', $value ['family'] );
		$frm->addTextarea ( 'casereport', $value ['casereport'] );
		if ($value ['company']) {
			setCompanyValue ( $frm, $value ['company'] );
		} else {
			self::generateComp ( $frm );
		}
		$frm->addTextArea ( 'remarks', $value ['remarks'] );
		$frm->addButton ( 'submit', 'Submit' );
	}
	
	public static function submitted(&$frm) {
		if(!defined('IN_SEARCH')) 
			 $frm->getField ( 'name' )->isFilled ( 'Please Fill in Client\'s Name.' );
		if ($frm->getField ( 'email' )->isFilled ())
			$frm->getField ( 'email' )->isEmail ( 'Please provide a valid email address.' );
		for($i = 1; $i < 6; $i ++) {
			if ($frm->getField ( 'companyemail' . $i )->isFilled ())
				$frm->getField ( 'companyemail' . $i )->isEmail ( 'Please provide a valid email address.' );
		}
		if ($frm->getField ( 'photo' )->isFilled ()) {
			if ($frm->getField ( 'photo' )->isAllowedExtension ( array ('jpg', 'png', 'gif', 'jpeg' ), 'Only jpg/gif/png/jpeg are allowed.' )) {
				$frm->getField ( 'photo' )->isFilesize ( IMAGE_MAX, 'kb', 'smaller', 'Too large. ' . IMAGE_MAX . 'kb maximum!' );
			}
		}
		if ($frm->getField ( 'attachment' )->isFilled ()) {
			if ($frm->getField ( 'attachment' )->isAllowedExtension ( array ('txt', 'doc', 'docx', 'xls', 'xlsx', 'pdf', 'ppt', 'pptx', 'zip', 'rar', '7z' ), 'Only txt,doc,docx,xls,xlsx,pdf,ppt,pptx,zip,rar,7z are allowed.' )) {
				$frm->getField ( 'attachment' )->isFilesize ( ATTACHMENT_MAX, 'kb', 'smaller', 'Too large. ' . ATTACHMENT_MAX . 'kb maximum!' );
			}
		}
		if (! in_array ( $frm->getField ( 'gender' )->getValue (), self::$form_value ['gender'] )) {
			$frm->getField ( 'gender' )->setError ( 'Please choose from the list only!' );
		}
		if (! in_array ( $frm->getField ( 'blood' )->getValue (), self::$form_value ['blood'] )) {
			$frm->getField ( 'blood' )->setError ( 'Please choose from the list only!' );
		}
		if ($frm->getField ( 'height' )->isFilled ()) {
			$frm->getField ( 'height' )->isNumeric ( 'Digits only please! eg: 180' ); //it needs to be numeric! 
		}
		if ($frm->getField ( 'weight' )->isFilled ()) {
			$frm->getField ( 'weight' )->isNumeric ( 'Digits only please! eg: 80' ); //it needs to be numeric! 
		}
	}
	
	public static function correct(&$frm) {
		if ($frm->getField ( 'photo' )->isFilled ()) {
			$imagename = uniqid ();
			SpoonFile::setContent ( IMAGE_PATH . '/' . $imagename . '.' . $frm->getField ( 'photo' )->getExtension (), gzcompress ( SpoonFile::getContent ( $frm->getField ( 'photo' )->getTempFileName () ), 9 ) );
			
			//create Thumbnail
			$frm->getField ( 'photo' )->createThumbnail ( IMAGE_PATH . '/' . $imagename . '_thumbnail.' . $frm->getField ( 'photo' )->getExtension (), 130, 130 );
			SpoonFile::setContent ( IMAGE_PATH . '/' . $imagename . '_thumbnail.' . $frm->getField ( 'photo' )->getExtension (), gzcompress ( SpoonFile::getContent ( IMAGE_PATH . '/' . $imagename . '_thumbnail.' . $frm->getField ( 'photo' )->getExtension () ), 9 ) );
		}
		
		if ($frm->getField ( 'attachment' )->isFilled ()) {
			$attachname = uniqid ();
			SpoonFile::setContent ( ATTACH_PATH . '/' . $attachname . '.' . $frm->getField ( 'attachment' )->getExtension (), gzcompress ( SpoonFile::getContent ( $frm->getField ( 'attachment' )->getTempFileName () ), 9 ) );
		}
		
		$company = "";
		for($i = 1; $i < 6; $i ++) {
			$company .= $frm->getField ( 'company' . $i )->getValue () . ', ' . $frm->getField ( 'registerno' . $i )->getValue () . ', ' . $frm->getField ( 'companyno' . $i )->getValue () . ', ' . $frm->getField ( 'companyemail' . $i )->getValue () . ', ' . $frm->getField ( 'shareholder' . $i )->getValue () . ', ' . $frm->getField ( 'registeraddr' . $i )->getValue () . ', ' . $frm->getField ( 'businessaddr' . $i )->getValue () . ', ';
		}
		$company = substr ( $company, 0, - 2 );
		
		//company field names
		$values = array ();
		for($i = 1; $i < 6; $i ++) {
			$values = array_merge ( $values, array ('company' . $i, 'registerno' . $i, 'companyno' . $i, 'companyemail' . $i, 'shareholder' . $i, 'registeraddr' . $i, 'businessaddr' . $i ) );
		}
		
		$values = array_merge ( $frm->getValues ( array_merge ( array ('form', 'submit', '_utf8' ), $values ) ), $frm->getField ( 'photo' )->isFilled () ? array ('photo' => $imagename, 'photoext' => $frm->getField ( 'photo' )->getExtension () ) : array (), $frm->getField ( 'attachment' )->isFilled () ? array ('attachment' => $attachname, 'attachext' => $frm->getField ( 'attachment' )->getExtension () ) : array (), array ("company" => $company, 'lastupdate' => time () ) );
		foreach ( $values as $key => $value ) {
			if ($value == NULL)
				unset ( $values [$key] );
		}
		
		return $values;
	}
	
	private static function generateComp(&$frm) {
		for($i = 1; $i < 6; $i ++) {
			$frm->addText ( 'company' . $i )->setAttribute ( "placeholder", "公司名字 company name" );
			$frm->addText ( 'registerno' . $i )->setAttribute ( "placeholder", "注册号码 registration number" );
			$frm->addText ( 'companyno' . $i )->setAttribute ( "placeholder", "公司号码 Company number" );
			$frm->addText ( 'companyemail' . $i )->setAttribute ( "placeholder", "公司电邮 Company email" );
			$frm->addTextarea ( 'shareholder' . $i )->setAttribute ( "placeholder", "公司股东 Shareholder" );
			$frm->addTextarea ( 'registeraddr' . $i )->setAttribute ( "placeholder", "注册地址 Registered Address" );
			$frm->addTextarea ( 'businessaddr' . $i )->setAttribute ( "placeholder", "营业地址Business Address" );
		}
	}
}
<?php
/**
 * Client Manager
 * 
 * Load Form Parser
 * @package Client Manager 0.2 alpha
 * @author Jin Cong<onionboy@live.com.my>
 */

(! defined ( 'IN_CM' ) && ! defined ( 'LOAD_TEMPLATE' )) && exit ();

/**
 * Interface for all form parser class
 */
interface cmForm {
	public static function form(&$frm, array $value = NULL);
	public static function submitted(&$frm);
	public static function correct(&$frm);
}

/**
 * Load a form parser
 * 
 * @return array(1 -> parsed form/ 2 -> form verified/ 3 -> form is correct, function return value)
 * @param string $name
 * @param array $value
 * @param boolean $validate
 * @param string $correct
 */
function parseForm(&$frm, $name, array $value = NULL, $validate = true, $correct = true) {
	//require required form parser file
	$formpath = CM_ROOT . '/cm_includes/form/' . $name . '.form.php';
	reqFile ( $formpath );

	//load form parser class
	$formclass = ucfirst ( $name ) . "Form";
        $return = call_user_func(array($formclass, 'form'), $frm, $value);
	$status = 1;
		
	//load form parser class validate method
	if ($validate && $frm->isSubmitted ()) {
		$return = call_user_func(array($formclass, 'submitted'), $frm);
		$status = 2;
		
		//load form parser class correct method
		if ($correct && $frm->isCorrect ()) {
			$return = call_user_func(array($formclass, 'correct'), $frm);
			$status = 3;
		}
	}
	
	return array ($status, $return );
}

/**
 * Set Multiple Attributes to Multiple Elements
 * 
 * @param SpoonForm $frm	Class
 * @param array $elements	Element id => Type(Text, Textarea)
 * @param array $value		Element id => value
 * @param array $attributes	Attributes key=>value
 */
function setMulAttributes(&$frm, array $elements, array $value = NULL, array $attributes = NULL) {
	$useAttr = (isset ( $attributes ) && count ( $attributes ) > 0);
	foreach ( $elements as $id => $type ) {
		$function = "add" . ucfirst ( $type );
		$field = $frm->$function ( $id, isset ( $value [$id] ) ? $value [$id] : NULL );
		$useAttr && $field->setAttributes ( $attributes );
	}
}

/**
 * Set Multiple Attributes to Multiple Elements with same type
 * 
 * @param SpoonForm $frm	Class
 * @param string $type		Element Type => array(ids)
 * @param array $value		Element id => value
 * @param array $attributes	Attributes key=>value
 */
function setTypeAttributes(&$frm, array $type, array $value = NULL, array $attributes = NULL) {
	$useAttr = (isset ( $attributes ) && count ( $attributes ) > 0);
	foreach ( $type as $type => $ids ) {
		$function = "add" . ucfirst ( $type );
		foreach ( $ids as $id ) {
			$field = $frm->$function ( $id, isset ( $value [$id] ) ? $value [$id] : NULL );
			$useAttr && $field->setAttributes ( $attributes );
		}
	}
}

/**
 * Set Company Value from string
 * 
 * @param SpoonForm $frm
 * @param string $value
 */
function setCompanyValue(&$frm, $value) {
	$values = explode ( ', ', $value );
	$count = - 1;
	for($i = 1; $i < 6; $i ++) {
		$frm->addText ( 'company' . $i, $values [$count += 1] )->setAttribute ( "placeholder", "公司名字 company name" );
		$frm->addText ( 'registerno' . $i, $values [$count += 1] )->setAttribute ( "placeholder", "注册号码 registration number" );
		$frm->addText ( 'companyno' . $i, $values [$count += 1] )->setAttribute ( "placeholder", "公司号码 Company number" );
		$frm->addText ( 'companyemail' . $i, $values [$count += 1] )->setAttribute ( "placeholder", "公司电邮 Company email" );
		$frm->addTextarea ( 'shareholder' . $i, $values [$count += 1] )->setAttribute ( "placeholder", "公司股东 Shareholder" );
		$frm->addTextarea ( 'registeraddr' . $i, $values [$count += 1] )->setAttribute ( "placeholder", "注册地址 Registered Address" );
		$frm->addTextarea ( 'businessaddr' . $i, $values [$count += 1] )->setAttribute ( "placeholder", "营业地址Business Address" );
	}
}
<?php

class LoginForm implements cmForm {
	
	private static $form = array ('Text' => array ('captcha', 'username' ), 'Password' => array ('password' ) );
	
	public static function form(&$frm, array $value = NULL) {
		setTypeAttributes ( $frm, self::$form );
		$frm->addButton ( 'submit', 'Submit' );
	}
	
	public static function submitted(&$frm) {
		$frm->getField ( 'username' )->isFilled ( 'Please fill in the admin username.' );
		$frm->getField ( 'password' )->isFilled ( 'Please fill in the admin password.' );
		$frm->getField ( 'captcha' )->isFilled ( 'Please fill in the captcha.' );
	}
	
	public static function correct(&$frm) {
		global $securimage;
		if ($frm->getField ( 'username' )->getValue () != ADMINNAME) {
			$frm->getField ( 'username' )->setError ( 'Admin name Incorrect.' );
		}
		if ($frm->getField ( 'password' )->getValue () != ADMINPASSWORD) {
			$frm->getField ( 'password' )->setError ( 'Admin password Incorrect.' );
		}
		if ($securimage->check ( $frm->getField ( 'captcha' )->getValue () ) == false) {
			$frm->getField ( 'captcha' )->setError ( 'Captcha Incorrect.' );
			return false;
		}else{
			return cmAuth::login ( $frm->getField ( 'username' )->getValue (), $frm->getField ( 'password' )->getValue () );
		}
	}
}
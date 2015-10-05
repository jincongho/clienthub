<?php
/**
 * Client Manager
 * 
 * Authentication Class
 * @package Client Manager 0.2 alpha
 * @author Jin Cong<onionboy@live.com.my>
 */


(!defined('IN_CM') && !class_exists('SpoonSession') ) && exit();

class cmAuth{
	
	/**
	 * Login admin
	 * 
	 * @return true if is login, false if login fail
	 * @param string $adminname	Admin's Name
	 * @param string $adminpw	Admin's Password
	 * @param string $session	Start session if set to true
	 */
	public static function login($adminname, $adminpw, $session = true){
		if(self::verify($adminname, $adminpw)){
			$session && self::setSession($adminname, $adminpw, ADMINEXPIRED);
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * Verify admin name and password
	 * 
	 * @return true if adminname is match with ADMINNAME and adminpw is match with ADMINPASSWORD
	 * @param string $adminname	Admin's Name
	 * @param string $adminpw	Admin's Password
	 */
	public static function verify($adminname, $adminpw){
		return ($adminname == ADMINNAME && $adminpw == ADMINPASSWORD);
	}
	
	/**
	 * Verify md5-ed adminname and pw
	 * 
	 * @param string $adminname
	 * @param string $adminpw
	 */
	public static function md5_verify($adminname, $adminpw){
		return ($adminname == md5(ADMINNAME) && $adminpw == md5(ADMINPASSWORD));
	}
	
	/**
	 * Return admin login status
	 * 
	 * @return true if admin is logined(session is valid)
	 */
	public static function is_logined(){
		return (SpoonSession::get('adminname') == ADMINNAME && SpoonSession::get('adminpw') == ADMINPASSWORD && self::is_valid());
	}
	
	/**
	 * Return admin login expired validity
	 * 
	 * @return true if the admin's session is still valid, false if session is expired
	 */
	public static function is_valid(){
		return (time() < SpoonSession::get('expiredTime'));
	}
	
	/**
	 * Set Param to Session
	 * 
	 * @param string $adminname	Admin's Name
	 * @param string $adminpw	Admin's Password
	 * @param string $expired	Admin's Session Length
	 */
	private static function setSession($adminname, $adminpw, $expired){
		SpoonSession::set('adminname', $adminname);
		SpoonSession::set('adminpw', $adminpw);
		SpoonSession::set('expiredTime', time()+$expired);
	}
	
}
<?php

/**
 * Bootstrap Helper
 * Generate Bootstrap Component
 */

/**
 * BS_nav
 * 
 * @example $menu = array('general' => 'link', 'dropdown' => array('first' => 'link', 'second' => 'link'))
 * 
 * @param array $menu
 * @param string $active
 * @param string $class
 */
function bs_nav(array $menu, $active = "", $class = ""){
	$return = "<ul class='nav $class'>";
	foreach($menu as $text=>$link){
		if(is_array($link)){
			$return	.= "<li class='dropdown'><a href='' class='dropdown-toggle' data-toggle='dropdown'>$text <b class='caret'></b></a><ul class='dropdown-menu'>";
			foreach($link as $ctext=>$clink){
				$return	.= "<li><a href='".(substr($clink, 0, 7) == "http://" ? $clink : site_url($clink))."'>$ctext</a></li>";
			}
			$return	.= "</ul></li>";
		}else{
			$return	.= "<li".($text == $active ? " class='active'" : "")."><a href='".(substr($link, 0, 7) == "http://" ? $link : site_url($link))."'>$text</a></li>";
		}
	}
 	$return .= "</ul>";

 	return $return;
}
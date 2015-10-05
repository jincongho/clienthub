<?php

function general($key, $value = null, $tblname = "general"){
	$CI =& get_instance();
	
	if(isset($value)){
		$check = $CI->db->get_where($tblname, array("key" => $key), 1)->result();
		if(isset($check[0]->value)){
			return $CI->db->where(array("key" => $key))->update($tblname, array('value' => $value));
		}else{
			return $CI->db->insert($tblname, array('key' => $key, 'value' => $value));
		}
	}else{
		$val = $CI->db->get_where($tblname, array("key" => $key), 1)->result();
		return $val[0]->value;
	}
}

function is_superadmin($userid){
	$CI =& get_instance();
	return in_array($userid, $CI->config->item("superadmin"));
}

function gravatar($path){
	return base_url("assets/img/".(!empty($path) ? "gravatars/".$path : general("gravatar")));
}

<?php

class Preference extends CI_Model{
	
	public $tblname = "preference";
	
	public function get($user, $key){
		$result = $this->db->get_where($this->tblname, array("user_id" => $user, "key" => $key))->result();
		return isset($result[0]->value) ? $result[0]->value : general("per_page");
	}
	
	public function set($user, $key, $value){
		$check = $this->db->get_where($this->tblname, array("user_id" => $user, "key" => $key))->result();

		if(isset($check[0]->value)){
			return $this->db->where(array('user_id' => $user, 'key' => $key))->update($this->tblname, array('value' => $value));
		}else{
			return $this->db->insert($this->tblname, array('user_id' => $user, 'key' => $key, 'value' => $value));
		}
	}
	
}
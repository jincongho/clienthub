<?php

class Search extends CI_Model{
	
	public $tblname = array(
			"brief"	=> "clients",
			"data"	=> "clientsdata"	
		);
	
	public function searchdb($key, $field = "name"){
		$this->load->model("clientdb");

		if($field == "name") {
			$query = $this->db->like($field, $key)->where("status !=", "trash")->select("id, gravatar, status, ".$field)->get($this->tblname['brief'])->result();
		}else{
			$query = $this->db->like($field, $key)->select("id, ".$field)->get($this->tblname['data'])->result();
			foreach($query as $num=>$row){
				$brief = $this->clientdb->brief($row->id, "gravatar, name, status");
				if($brief['status'] == "trash") {
					unset($query[$num]);
					continue;
				}
				$query[$num]->gravatar 	= $brief['gravatar'];
				$query[$num]->name		= $brief['name'];
				$query[$num]->status	= $brief['status'];
			}
		}
				
		return $query;
	}
	
}
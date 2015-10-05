<?php

class Clientdb extends CI_Model{
	
	public $tblname = array("brief" => "clients", "data" => "clientsdata");
	
	/**
	 * Set
	 * Create or Update Client Info
	 * 
	 * @param array $data
	 * @param int $id
	 */
	public function set(array $data, $id = null){
		//update brief
		$brief = array(
				"name"	=>	(isset($data["name"]) ? $data["name"] : null),
				"gravatar"	=> (isset($data["gravatar"]) ? $data["gravatar"] : null), //@TODO:error setting null, original meant to not change contents
				"lastupdate" => date("Y-m-d H:i:s")
				);
		
		if($id === null){ //creating client
			$this->db->insert($this->tblname['brief'], $brief);
			$data['id'] = $this->db->insert_id();
		}else{
			$this->db->where('id', $id)->update($this->tblname['brief'], $brief);
			$data['id'] = $id;
		}
		
		//filter value
		unset($data['name'], $data['gravatar']);
		$types = $this->clientdbmodel->get_type();
		foreach($types as $field=>$type){
			if($type == "int" && $data[$field] == null){
				$data[$field] = NULL;
			}elseif($type == "tinyint"){
				$data[$field] = (!isset($data[$field])) ? "0" : "1";
			}
			$this->db->set($field, $data[$field]);
		}
		
		//set value
		if($id === null){
			$this->db->insert($this->tblname['data'], $data);
		}else{
			$this->db->where('id', $id)->update($this->tblname['data'], $data);
		}
		
		return $data['id'];
	}
	
	/**
	 * Brief
	 * Get Client Info From Brief Table
	 * @param string $field Seperated Column with Comma
	 */
	public function brief($id, $field){
		$query 	= $this->db->select($field)->get_where($this->tblname['brief'], array('id' => $id))->result();
		$return = array();
		foreach($query[0] as $key=>$value){
			$return[$key] = $value;
		}
		return $return;
	}
	
	public function gravatar($id){
		$return = $this->db->select("gravatar")->get_where($this->tblname['brief'], array('id' => $id))->result();
		return $return[0] -> gravatar;
	}
	
	/**
	 * Profile
	 * 
	 * @uses set $filter to true to turn 1 into Yes
	 * @param int $id
	 * @param bool  $filter
	 */
	public function profile($id, $filter = true){
		//get all stored data
		$brief 	= $this->db->get_where($this->tblname['brief'], array("id" => $id))->result();
		$data 	= $this->db->get_where($this->tblname['data'], array("id" => $id))->result();
		foreach($data[0] as $key=>$value){
			$profile[$key] = $value;
		}
	
		//build return data
		$return = array();
		$meta = $this->clientdbmodel->get_fields();
		foreach($meta as $field){
			$value =& $profile[$field->Field];
			if($filter === true){
				if($field->Type == "int" && $value == 0){
					$value = null;
				}elseif($field->Type == "tinyint"){
					$value = ($value == "1") ? "Yes" : "No";
				}
	
				if(empty($value) && general("show_unset") != "true"){
					continue;
				}
			}
			$return[$field->Field] = array("slug" => $field->slug, "value" => $value);
		}
	
		return array( "brief" => $brief[0], "data" => $return);
	}
	
	/**
	 * Retrieve
	 * 
	 * @param array $data
	 * @param int $start
	 * @param int $num
	 */
	public function retrieve(array $data = array(), $start = 0, $num = 0, $where = array(), $sort = null, $desc = "asc", $status = "active"){
		
		if($sort === null || $sort == "id"){
			$brief 	= $this->db->limit($num, $start)->where($where)->where("status", $status);
			if(isset($sort) && $sort == "id") $brief = $brief->order_by("id ".$desc);
			$brief = $brief->get($this->tblname['brief'])->result();
			
			if(count($data) > 0){
				$data 	= $this->db->select(implode(", ", $data));
				if(isset($sort) && $sort = "id") $data = $data->order_by("id ".$desc);
				foreach($brief as $row){
					$data = $data->or_where("id", $row->id);
				}
				$data = $data->get($this->tblname['data'])->result();
				$meta = $this->clientdbmodel->get_fields();
				foreach($data as $num=>$row){
					foreach($row as $key=>$value){
						if($meta[$key]->Type == "tinyint"){
							$value = ($value == "1") ? "Yes" : "No";
						}
						$brief[$num]->{$key} = $value;
					}
				}
			}
		}
		
		return $brief;
	}
		
	/**
	 * Total
	 * 
	 */
	public function total($status = null){
		if(isset($status)){
			$total = $this->db->query("SELECT COUNT(*) FROM ".$this->db->dbprefix($this->tblname['brief'])." WHERE `status` = '".$status."'")->result();
			$total = (array) $total[0];
			return $total["COUNT(*)"];
		}else{
			return $this->db->count_all($this->tblname['brief']);
		}
		
	}
	
	/**
	 * Trash
	 * 
	 * @param int $id
	 */
	public function trash($id){
		return $this->db->where("id", $id)->update($this->tblname['brief'], array("status" => "trash"));
	}
	
	/**
	 * Recover
	 * 
	 * @param int $id
	 */
	public function recover($id){
		return $this->db->where("id", $id)->update($this->tblname['brief'], array("status" => "active"));
	}
	
	/**
	 * Clear
	 * 
	 */
	public function clear(){
		$trash = $this->db->select("id")->get_where($this->tblname['brief'], array('status' => 'trash'))->result();
		foreach($trash as $row){
			$id =& $row->id;
			$this->db->delete($this->tblname['brief'], array('id' => $id));
			$this->db->delete($this->tblname['data'], array('id' => $id));
		}
	}
	
}
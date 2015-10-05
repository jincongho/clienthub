<?php

class Transfer extends CI_Controller{
	
	public function index(){
		//die();
		$this->load->model("clientdb");
		include(__DIR__."/../../../../clientManager_new/cm_includes/spoon/spoon.php");
		$mysql = new SpoonDatabase("mysql", "localhost", "root", "", "clienthub");
		$source = $mysql->getRecords("SELECT * FROM profiles");
		/*for($i=1; $i<=1683; $i++){
			$gravatar = null;
			if(isset($source[$i-1]["photo"])){
				$gravatar = $source[$i-1]['photo'].".".$source[$i-1]['photoext'];
			}
			$this->db->insert('clients', array('name' => $source[$i-1]['name'], "gravatar" => $gravatar, "status" => ($source[$i-1]['status'] == "trash" ? "trash" : "active")));
		}*/
		foreach($source as $num=>$row){
			$data = array(
					'id'	=> $row["id"],
					//'age'	=> $row["age"],
					'file'	=> $row["file"],
					'case'	=> $row["case"],
					'ic'	=> $row["ic"],
					'sex'=> ($row["gender"] == null ? null : (($row["gender"] == "male") ? "男" : "女")),
					'placeofbirth'	=> $row["placeofbirth"],
					'education'	=> $row["education"],
					'language'	=> $row["language"],
					'race'		=> $row["race"],
					'faith'		=> $row["faith"],
					'maritalstatus'	=> ($row["maritalstatus"] == "Married" ? "已婚" : ($row["maritalstatus"] == "Singer" ? "单身" : "不详")),
					'nationality'	=> $row["nationality"],
					'profession'	=> $row["profession"],
					'address'		=> $row["address"],
					'epf'			=> $row["epf"],
					'banker'		=> $row["banker"],
					'contactno'		=> $row["contactno"],
					'email'			=> $row["email"],
					'platesno'		=> $row["platesno"],
					'asset'		=> $row["assets"],
					'height'		=> $row["height"],
					'weight'		=> $row["weight"],
					'blood'			=> $row["blood"],
					'eye'			=> $row["eye"],
					'hair'			=> $row["hair"],
					'skin'			=> $row["skin"],
					'dna'			=> $row["dna"],
					'case'			=> $row["casereport"],
					'family'		=> $row["family"],
					'company'		=> implode(" ", explode(", ", $row["company"])),
					'remarks'		=> $row["remarks"]
			);
			$this->db->insert('clientsdata', $data);
		}
	}
}

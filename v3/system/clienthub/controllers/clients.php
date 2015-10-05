<?php

class Clients extends MY_Controller{

	public function __construct(){
		parent::__construct();
		
		$this->load->library("upload");
		$this->load->library("image_lib");
		$this->load->library("form_validation");
	}

	public function index($group = "active", $sort = "id", $desc = "asc", $start = -1){
		redirect("/clients/lists/".($start < 0 ? "$group/$sort/$desc/0" : "active/id/asc/0"));
	}

	public function lists($group = "active", $sort = "id", $desc = "asc", $start = -1){
		if($start < 0) redirect("/clients/lists/$group/$sort/$desc/0");

		$this->load->library("pagination");
		$per_page = $this->preference->get($this->view['user']->id, "per_page");
		
		$this->view["start"] 	= $start;
		$this->view["group"] 	= $group;
		$this->view["sort"] 	= $sort;
		$this->view["desc"] 	= ($desc == "desc") ? "desc" : "asc";
		
		$in_list = general("in_list");
		$this->view['in_list'] 	= empty($in_list) ? array() : explode("|", $in_list);
		$this->view['meta']		= $this->clientdbmodel->get_meta();
		$this->view["clients"] 	= $this->clientdb->retrieve($this->view['in_list'], $start, $per_page, array("status" => $group), $sort, $desc, $group);
		$this->view["total_clients"]	= $this->clientdb->total($group);
		
		$this->pagination->initialize(array(
			"base_url" => base_url("/clients/lists/$group/$sort/$desc/"),
			"total_rows" => $this->view["total_clients"],
			"per_page" => $per_page,
		));
		
		$this->view["pagination"] = $this->pagination->create_links();	

		$this->__run("clients/lists");
	}
	
	public function add(){
		//required forms
		$getFields = $this->clientdbmodel->get_fields();
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules("name", "Name", "required|xss_clean");
		foreach($getFields as $field){
			$rule = "xss_clean";
			if($field->Null == "NO") $rule .= "|required";
			if((isset($field->maxlength) && $field->maxlength > 0)) $rule .= "|max_length[".$field->maxlength."]";
			if($field->Type == "int") $rule .= "|integer";
			$this->form_validation->set_rules($field->Field, $field->slug, $rule);
		}
		
		if($this->form_validation->run() == true){
			$gravatar = $_FILES['gravatar'];
			if(isset($gravatar) && $gravatar['error'] !== 4){
				$filename = uniqid();
				$this->upload->initialize(array(
						"upload_path" 	=> ASSETS."/img/gravatars",
						"allowed_types" => "jpg|jpeg|png",
						"max_size"		=> 1024*5,
						"file_name"		=> $filename
				));
				if ( ! $this->upload->do_upload("gravatar")){
					die($this->upload->display_errors());
				}else{
					$data = $this->upload->data();
					$this->image_lib->initialize(array(
							"source_image" 	=> $data['full_path'],
							"width"			=> 100,
							"height"		=> 100,
							"create_thumb"	=> true,
							"thumb_marker"	=> "_thumbnail"
					));
					if (!$this->image_lib->resize()) die($this->image_lib->display_errors());
				}
				$_POST['gravatar'] = $data['file_name'];
			}
			
			//insert client data and get id
			$id = $this->clientdb->set($this->input->post());
			
			//upload attachments
			$this->attachmentsdb->upload($id);
			
			$this->session->set_flashdata('message', "Create New Client Successfully!");
			redirect("clients/add");
		}
		
		$this->__run("clients/form", array(
				"title"		=> "Add Clients",
				"fields" 	=> $getFields
			));
	}
	
	public function profile($id = "", $download = false){
		if(empty($id)) redirect("clients");	

			$this->__run("clients/profile", array(
					"id"		=> $id,
					"profile" 	=> $this->clientdb->profile($id),
					"attachments"	=> $this->attachmentsdb->get($id)
					));		
	}
	
	public function edit($id =""){
		if(empty($id)) redirect("clients");	
		if(!$this->view['permits']) redirect("clients");
		
		//required forms
		$getFields = $this->clientdbmodel->get_fields();
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules("name", "Name", "required|xss_clean");
		foreach($getFields as $field){
			$rule = "xss_clean";
			if($field->Null == "NO") $rule .= "|required";
			if((isset($field->maxlength) && $field->maxlength > 0)) $rule .= "|max_length[".$field->maxlength."]";
			if($field->Type == "int") $rule .= "|integer";
			$this->form_validation->set_rules($field->Field, $field->slug, $rule);
		}
		
		if($this->form_validation->run() == true){
			$gravatar = $_FILES['gravatar'];
			if(isset($gravatar) && $gravatar['error'] !== 4){
				$filename = uniqid();
				$this->upload->initialize(array(
						"upload_path" 	=> ASSETS."/img/gravatars",
						"allowed_types" => "jpg|jpeg|png",
						"max_size"		=> 1024*5,
						"file_name"		=> $filename
				));
				if ( ! $this->upload->do_upload("gravatar")){
					die($this->upload->display_errors());
				}else{
					die("a");
					$data = $this->upload->data();
					$this->image_lib->initialize(array(
							"source_image" 	=> $data['full_path'],
							"width"			=> 100,
							"height"		=> 100,
							"create_thumb"	=> true,
							"thumb_marker"	=> "_thumbnail"
					));
					if (!$this->image_lib->resize()) die($this->image_lib->display_errors());
					if($old = $this->clientdb->gravatar($id)) unlink(ASSETS."/img/gravatars/".$old);
					$_POST['gravatar'] = $data['file_name'];
				}
			}
			
			//upload attachments
			$this->attachmentsdb->upload($id);
			
			$this->clientdb->set($this->input->post(), $id);
			$this->session->set_flashdata('message', "Edit ".$this->input->post("name")." Successfully!");
			redirect("clients/edit/".$id);
		}
		
		//set value
		$profile = $this->clientdb->profile($id, false);
		foreach($profile['data'] as $slug=>$array){
			$getFields[$slug]->value = $array['value'];
		}
		
		$this->__run("clients/form", array(
				"title"		=> "Edit ".$profile['brief']->name,
				"fields" 	=> $getFields,
				"brief" 	=> $profile['brief'],
				"attachments"	=> $this->attachmentsdb->get($id)
		));
	}
		
	public function trash($id = ""){
		if(empty($id)) redirect("clients");
		if(!$this->view["permits"]) redirect("clients");
		
		$this->clientdb->trash($id);
		redirect("clients");
	}
	
	public function recover($id = ""){
		if(empty($id)) redirect("clients");
		if(!$this->view["permits"]) redirect("clients");
		
		$this->clientdb->recover($id);
		redirect("clients");
	}
	
	public function clear(){
		if(!$this->view["permits"]) redirect("clients");
		
		$this->clientdb->clear();
		redirect("clients");
	}

}
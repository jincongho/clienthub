<?php
class General extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	
		if(!$this->ion_auth->logged_in()) redirect("login");
		if(!$this->ion_auth->is_admin() && !is_superadmin($this->ion_auth->user()->row()->id)) redirect("");	
		$this->header->output();
	
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->helper('url');
		$this->load->model("Clientdbmodel");
	}
	
	public function index(){
		$this->form_validation->set_error_delimiters('', '');
		$user = $this->ion_auth->user()->row();
				
		$this->form_validation->set_rules("per_page", "Per Page", "required|numeric");
		$this->form_validation->set_rules("site_title", "Site Title", "required");
		
		if($this->form_validation->run() == true){
			general("per_page", $this->input->post("per_page"));
			general("site_title", $this->input->post("site_title"));
			general("show_unset", ($this->input->post("show_unset") == "true") ? "true" : "false");
			$in_list = $this->input->post("in_list");
			general("in_list", !empty($in_list) ? implode("|",  $this->input->post("in_list")) : "");
			
			$gravatar = $_FILES["gravatar"];
			if(isset($gravatar) && $gravatar['error'] != 4){
				$this->upload->initialize(array(
						"upload_path" => ASSETS."/img",
						"allowed_types" => "jpg|jpeg|png",
						"max_size"		=> 1024*2
				));
				if ( ! $this->upload->do_upload("gravatar")){
					die($this->upload->display_errors());
				}else{
					$data = $this->upload->data();
					unlink(ASSETS.'/img/'.general("gravatar"));
					general("gravatar", $data['file_name']);
					$this->image_lib->initialize(array(
							"source_image" 	=> $data['full_path'],
							"width"			=> 100,
							"height"		=> 100	
					));
					if (!$this->image_lib->resize()) die($this->image_lib->display_errors());
				}
			}
			
			$this->session->set_flashdata('message', "Update General Settings Successfully!");
			redirect("settings/general", "refresh");
		}else{
			$this->data["per_page"] = array(
					"name" => "per_page",
					"id" => "per_page",
					"type" => "text",
					"value" => general("per_page"),
			);
			$this->data["site_title"] = array(
					"name" => "site_title",
					"id" => "site_title",
					"type" => "text",
					"value" => general("site_title"),
			);
			$this->data["show_unset"] = array(
					"name" => "show_unset",
					"id" => "show_unset",
					"type" => "checkbox",
					"value" => "true",
			);
			$this->data["gravatar"] = array(
					"name" 	=> "gravatar",
					"id"	=> "gravatar",
					"type"	=> "file"		
			);
			(general("show_unset") == "true") && $this->data["show_unset"]["checked"] = "";
			$this->data["in_list"] = array(
					"options" 	=> $this->Clientdbmodel->get_meta(),
					"selected"	=> explode("|", general("in_list"))
			);
			
			$this->data['message'] = $this->session->flashdata("message");
			$this->load->view("settings/general", $this->data);
			$this->load->view("footer");
		}
	}
	
}
<?php

class Welcome extends MY_Controller{

	public function index(){
		$q = $this->input->get("q");
		if(!empty($q)){
			$this->__run("search", array(
				"query"		=> $q,
				"target"	=> $this->input->get("field"),
				"results"	=> $this->search->searchdb($q, $this->input->get("field")),
				"meta"		=> $this->clientdbmodel->get_meta(),
				"permits"	=> $this->view["permits"],
				"field"		=> $this->clientdbmodel->get_fields()
			));
		}else{
			$this->__run("welcome", array(
				"total_clients" => $this->clientdb->total(),
				"total_staff" 	=> $this->ion_auth_model->total(),
				"total_attach"	=> $this->attachmentsdb->total(),
				"field"	=> $this->clientdbmodel->get_fields()
			));
		}
	}
	
}
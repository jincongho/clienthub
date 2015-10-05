<?php

class Attachments extends MY_Controller{
	
	public $uploadpath;
	
	public function __construct(){
		parent::__construct();
		$this->uploadpath = ASSETS."/attachments/";
		$this->load->model("attachmentsdb");
	}
	//@TODO: permission
	
	public function index(){
		redirect("login");
	}
	
	public function view($id){
		$attach	= $this->attachmentsdb->get($id, "file");
		$type 	= $attach->filetype;
		$ext	= $attach->fileext;
		
		$data['title'] = $attach->filename;
		
		if($type === "document"){
			if($ext === ".pdf"){
				$target = "attachments/pdfjs";
				$data['fileurl'] = base_url("/assets/attachments/".$attach->id.$attach->fileext);
			}elseif($ext === ".txt"){
				$target = "attachments/txt";
				$data['content'] = file_get_contents($this->uploadpath.$attach->id.".txt");
			}
		}elseif($type === "image"){
			$target = "attachments/image";
			$data['image'] = base_url("/assets/attachments/".$attach->id.$attach->fileext);
		}else{
			$this->download($id);
		}
		
		$this->load->view($target, $data);
	}
	
	public function download($id){
		$attach	= $this->attachmentsdb->get($id, "file");

		$this->load->helper("download");
		force_download(
				$attach->filename,
				file_get_contents($this->uploadpath.$attach->id.$attach->fileext)
		);
	}
	
	public function download_all($id){
		$this->load->helper("download");
		force_download("attachments_".$id.".zip", $this->attachmentsdb->pack($id));
	}
	
	public function delete($id){
		$attach = $this->attachmentsdb->delete($id);
		redirect("/clients/edit/".$attach->clientid);
	}
	
}
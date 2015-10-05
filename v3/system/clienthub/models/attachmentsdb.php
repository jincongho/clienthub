<?php

class Attachmentsdb extends CI_Model{
	
	public $tblname = "attachments";
	
	public $options = array("upload_path" => "", "max_size" => 0, "overwrite" => false);

	public $types = array(
			"mp3"	=> "music",
			"mp4"	=> "video",
			"wav"	=> "video",
			"flv"	=> "video",
			"pdf"	=> "document",
			"txt"	=> "document",
			"jpg"	=> "image",
			"png"	=> "image",
			"jpeg"	=> "image",
			"gif"	=> "image"	
		);
	
	public function __construct(){
		parent::__construct();
		$this->load->library("upload");
		
		$this->options['upload_path'] = ASSETS."/attachments/";
		$this->options['max_size'] = $this->config->item('attachsize');
		$this->options['allowed_types'] = $this->config->item('attachments');
	}
	
	/**
	 * Set Option of Model
	 * @param array $opt
	 */
	public function options(array $opt){
		if(count($opt) < 1) return;
		foreach($opt as $key=>$value){
			$this->options[$key] = $value;
		}
		return $this;
	}
	
	/**
	 * Upload Multiple File
	 * 
	 * @param int $clientid
	 * @param string $parameter Attachment name
	 */
	public function upload($clientid, $parameter = "attachments"){
		if(count($_FILES[$parameter]) < 1) return;
		
		$clone = $_FILES[$parameter];
			foreach($clone['name'] as $key=>$name){
				if($clone['error'][$key] != 4){
					$_FILES[$parameter] = array(
							"name" 		=> $name,
							"type"		=> $clone['type'][$key],
							"tmp_name"	=> $clone['tmp_name'][$key],
							"error"		=> $clone['error'][$key],
							"size"		=> $clone['size'][$key] 
						);
					$this->options['file_name'] = $filename = uniqid();
					
					$this->upload->initialize($this->options);
					$success = $this->upload->do_upload($parameter);
									
					if($success) {
						$data = $this->upload->data();
						$type = substr($data['file_ext'], 1);
						$this->save_file(array(
								"id" 		=> $filename, 
								"filename" 	=> $name,
								"fileext"	=> $data['file_ext'],
								"mimetype" 	=> $clone['type'][$key], 
								"filetype" 	=> (isset($this->types[$type]) ? $this->types[$type] : "others"),
								"clientid"	=> $clientid));
					}
				}
			}
	}
	
	/**
	 * Download All Attachment of a Client in Zip
	 * @param int $id
	 */
	public function pack($id){
		$this->load->library("zip");
		$attach = $this->get($id);
		foreach($attach as $file){
			$this->zip->add_data($file->filename, file_get_contents($this->options['upload_path'].$file->id.$file->fileext));
		}
		$return = $this->zip->get_zip();
		$this->zip->clear_data();
		return $return;
	}
		
	/**
	 * Get Record by Given Attachment Id or Client Id
	 * @param int $id
	 * @param string $by
	 */
	public function get($id, $by = "clients"){
		if($by === "clients"){
			return $this->db->get_where($this->tblname, array('clientid' => $id))->result();
		}else{
			$return = $this->db->get_where($this->tblname, array('id' => $id))->result();
			return $return[0];
		}
	}
	
	/**
	 * Delete Attachment
	 * @param int $id
	 */
	public function delete($id){
		$attach = $this->db->get_where($this->tblname, array('id' => $id))->result();
		$this->db->delete($this->tblname, array('id' => $id));
		unlink($this->options['upload_path'].$attach[0]->id.$attach[0]->fileext);
		return $attach[0];
	}
	
	/**
	 * Save Attachment Record
	 * @param array $file
	 */
	public function save_file(array $file){
		$this->db->insert($this->tblname, $file);
	}
	
	/**
	 * Count Total Attachment Amount
	 */
	public function total(){
		return $this->db->count_all($this->tblname);
	}
	
}
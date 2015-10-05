<?php

class Header extends CI_Model{
	
	public $viewfile = "header";
	
	public $js = array();
	
	public $css = array();
	
	public $menu = array("topmenu", "sidemenu");
	
	/**
	 * Constructor
	 * 
	 * @param boolean $view show header view or not
	 */
	public function __construct($viewfile = ""){
		parent::__construct();
		$this->config->load("clienthub");
		$this->config->load("template");
		$this->load->helper("bootstrap");
			
		$this->menu['topmenu'] 	= $this->config->item("topmenu");
		$this->css				= $this->config->item("css");
		$this->js				= $this->config->item("js");
	}
	
	public function output(){
		$this->load->view($this->viewfile, array(
				"title"		=> $this->_title(),
				"brand"		=> $this->_brand(),
				"topmenu"	=> bs_nav($this->menu['topmenu'], $this->_activetop()),
				"js"		=> $this->_js(),
				"css"		=> $this->_css(),
				"username"	=> $this->view["user"]->username
			));
	}
	
	private function _title(){
		return general("site_title")." powered by ClientHub v".$this->config->item("version");
	}
	
	private function _brand(){
		return '<a class="brand" href="'.site_url("").'">'.general("site_title").'</a>';
	}
	
	private function _css(){
		$return = "";
		foreach($this->css as $file){
			$return .= '<link href="'.(substr($file, 0, 7) == "http://" ? $file : base_url($file)).'" rel="stylesheet" />';
		}
		return $return;
	}
	
	private function _js(){
		$return = "";
		foreach($this->js as $file){
			$return .= '<script type="text/javascript" src="'.(substr($file, 0, 7) == "http://" ? $file : base_url($file)).'"></script>';
		}
		return $return;
	}
		
	private function _activetop(){
		$uri = $this->uri->segment(1);
		switch ($uri){
			case "clients":
				return "Clients";
			case "auth":
				return "Staff";
			case "settings":
				return "Settings";
			default :
				return "Home";
		}
	}
	
}
<?php

class Clientdbmodel extends CI_Model{
	
	public $tblname = array(
			"data" => "clientsdata",
			"meta" => "clientsdata_meta"
		);
		
	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}
	
	public function build($fields){		
		$structure = $this->db->field_data($this->tblname["data"]);//name, type, max_length, primary_key
		
		//find new columns
		$columns = array("old" => array(),"new" => array());
		foreach($fields['oldslug'] as $key=>$value){
			if(empty($value)){
				$columns['new'][] = $key; 
			}else{
				$columns['old'][] = $key;
			}
		}
		
		//find deleted columns
		$deleted = array();
		foreach($structure as $column){
			if(!in_array($column->name, $fields['oldslug']) && $column->name != "id") $deleted[] = $column->name;
		}
		
		//build new meta array
		$meta = array();
		foreach($fields['fieldslug'] as $key=>$value){
			$meta[] = array(
					"fieldname"	=> $fields['fieldname'][$key],
					"slugname"	=> $fields['fieldslug'][$key]
					);
		}
		
		//add new columns
		$add = array();
		foreach($columns['new'] as $key){
			$field =& $add[$fields['fieldslug'][$key]];
			$field['type'] = $fields["fieldtype"][$key];
			if(isset($fields['notnull'][$fields['fieldslug'][$key]])){
				$field['null'] = false;
			}else{
				$field['null'] = true;
			}
			
			if($fields["fieldtype"][$key] == "enum"){
				$choice = explode("|", $fields['selection'][$key]);
				$field['constraint'] = $choice;
			}elseif($fields["fieldtype"][$key] == "tinyint"){
				$field['constraint'] = "1";
			}elseif($fields["fieldtype"][$key] == "int"){
				$field['constraint'] = $fields['maxlength'][$key];
			}
			
			if(!empty($fields['default'][$key]) && in_array($field['type'], array("enum"))){
				$field['default'] = $fields['default'][$key];
			}
		}
		$this->dbforge->add_column($this->tblname['data'], $add);
		
		//modify columns
		$modify = array();
		foreach($columns['old'] as $key){
			$type =& $fields['fieldtype'][$key];
			$oldslug =& $fields['oldslug'][$key];
			//change column name
			if($oldslug != $fields['fieldslug'][$key]){
				$modify[$oldslug]['name'] = $fields['fieldslug'][$key];
			}
			//change column type
			$modify[$oldslug]['type'] = $type;
			//change column constraint
			if($type == "enum"){
				$choice = explode("|", $fields['selection'][$key]);
				$modify[$oldslug]['constraint'] = $choice;
			}elseif($type == "tinyint"){
				$modify[$oldslug]['constraint'] = "1";
			}elseif($fields["fieldtype"][$key] == "int"){
				$modify[$oldslug]['constraint'] = $fields['maxlength'][$key];
			}
			//change column notnull
			if(isset($fields['notnull'][$fields['fieldslug'][$key]])){
				$modify[$oldslug]['null'] = false;
			}else{
				$modify[$oldslug]['null'] = true;
			}
			//change column default
			if(!empty($fields['default'][$key]) && $type == "enum"){
				$modify[$oldslug]['default'] = $fields['default'][$key];
			}
		}
		$this->dbforge->modify_column($this->tblname['data'], $modify);
		
		//delete columns
		foreach($deleted as $column){
			$this->dbforge->drop_column($this->tblname['data'], $column);
		}
		
		//save column meta info
		$this->db->empty_table($this->tblname['meta']);
		$this->db->insert_batch($this->tblname['meta'], $meta);
		
	}
	
	/**
	 * Get_Meta
	 * 
	 */
	public function get_meta(){
		$result = array();
		$meta = $this->db->get($this->tblname['meta'])->result();
		foreach($meta as $row){
			$return[$row->slugname] = $row->fieldname;
		}
		return $return;
	}
	
	/**
	 * Get_Type
	 * 
	 */
	public function get_type(){
		$return = array();
		$structure = $this->db->field_data($this->tblname['data']);
		foreach($structure as $field){
			$return[$field->name] = $field->type;
		}
		unset($return['id']);
		return $return;
	}
	
	/**
	 * Get_Fields
	 * @uses Return Sorted Column Info According Meta
	 */
	public function get_fields(){
		//get structure and meta
		$structure = array_slice($this->db->query('DESCRIBE `'.$this->db->dbprefix($this->tblname['data']).'`')->result(), 1);
		$query = $this->db->get($this->tblname['meta']);
	
		//extract meta info
		$meta = array();
		foreach($query->result_array() as $array){
			$meta['slug'][] = $array['slugname'];
			$meta['field'][] = $array['fieldname'];
		}
	
		//modify return field info
		foreach($structure as $field){
			$occur = strpos($field->Type, "(");
			if(substr($field->Type, 0, 4) == "enum"){
				$field->selection = str_replace("','", "|", substr($field->Type, $occur+2, -2));
			}else{
				$field->maxlength = (int) substr($field->Type, $occur+1, -1);
			}
			$field->Type = ($occur > 0) ? substr($field->Type, 0, $occur) : $field->Type;
			$field->slug = $meta['field'][array_search($field->Field, $meta['slug'])];
			$structure[$field->Field] = $field;
		}
		
		//sort according meta slug
		foreach($meta['slug'] as $slug){
			$return[$slug] = $structure[$slug];
		}
	
		return $return;
	}
	
}
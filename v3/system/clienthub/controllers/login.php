<?php 

defined('BASEPATH') or exit('No direct script access allowed.'); 

class Login extends CI_Controller{

	function index(){

		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->database();

		$this->data['title'] = "Login";

		$this->form_validation->set_rules('identity', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_error_delimiters('', '');

		if ($this->form_validation->run() == true){
			$remember = (bool) $this->input->post('remember');
			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)){
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect($this->config->item('base_url'), 'refresh');
			}else{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('login', 'refresh');
			}
		}else{
			if($this->ion_auth->logged_in() === true){
				redirect($this->config->item('base_url'), 'refresh');
			}

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array(
					'name' => 'identity',
					'id' => 'identity',
					'autofocus' => '',
					'type' => 'text',
					'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array(
					'name' => 'password',
					'id' => 'password',
					'type' => 'password',
			);

			$this->load->view('auth/login', $this->data);
		}
	}

}
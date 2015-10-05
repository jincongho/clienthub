<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->database();
				
	}

	//redirect if needed, otherwise display the user list
	function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin() && !is_superadmin($this->ion_auth->user()->row()->id))
		{
			//redirect them to the home page because they must be an administrator to view this
			redirect($this->config->item('base_url'), 'refresh');
		}
		else
		{
			$this->header->output();
			
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}
			$this->data['is_sa'] = is_superadmin($this->ion_auth->user()->row()->id);

			$this->load->view('auth/index', $this->data);
		}
		$this->load->view("footer");
	}

	//log the user out
	function logout()
	{
		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them back to the page they came from
		redirect('auth', 'refresh');
	}

	//change password
	function change_password()
	{
		$this->header->output();
		
		$this->form_validation->set_rules('old', 'Old password', 'required');
		$this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{ //display the form
			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name' => 'new',
				'id'   => 'new',
				'type' => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id'   => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			//render
			$this->load->view('auth/change_password', $this->data);
		}
		else
		{
			$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{ //if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/change_password', 'refresh');
			}
		}
		$this->load->view("footer");
	}

	//activate the user
	function activate($id, $code=false)
	{
		if(!is_superadmin($this->ion_auth->user()->row()->id)){
			$this->session->set_flashdata('message', 'You are not superadmin.');
			redirect("auth", "refresh");
		}
		
		if(in_array($id, $this->config->item("superadmin"))){
			$this->session->set_flashdata('message', 'You cannot change superadmin status.');
			redirect("auth", "refresh");
		}
		
		if ($code !== false)
			$activation = $this->ion_auth->activate($id, $code);
		else if ($this->ion_auth->is_admin())
			$activation = $this->ion_auth->activate($id);

		if ($activation)
		{
			//redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth", 'refresh');
		}
	}

	//deactivate the user
	function deactivate($id = NULL, $code = false)
	{
		if(!is_superadmin($this->ion_auth->user()->row()->id)){
			$this->session->set_flashdata('message', 'You are not superadmin.');
			redirect("auth", "refresh");
		}
		
		if(in_array($id, $this->config->item("superadmin"))){
			$this->session->set_flashdata('message', 'You cannot change superadmin status.');
			redirect("auth", "refresh");
		}
		
		$id = $this->config->item('use_mongodb', 'ion_auth') ? (string) $id : (int) $id;

		if ($this->ion_auth->is_admin()) $activation = $this->ion_auth->deactivate($id);
		
		if ($activation)
		{
			//redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
		
		/*$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', 'confirmation', 'required');
		$this->form_validation->set_rules('id', 'user ID', 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->load->view('auth/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_404();
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}
			
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			
			//redirect them back to the auth page
			redirect('auth', 'refresh');
		}*/
	}
	
	function make_admin($id = null){
		if(!is_superadmin($this->ion_auth->user()->row()->id)){
			$this->session->set_flashdata('message', 'You are not superadmin.');
			redirect("auth", "refresh");
		}
		
		if(in_array($id, $this->config->item("superadmin"))){
			$this->session->set_flashdata('message', 'You cannot change superadmin status.');
			redirect("auth", "refresh");
		}
		
		if(isset($id)){
			$this->ion_auth_model->add_to_group(1, $id);
			$this->session->set_flashdata('message', 'Added 1 new admin.');
		}
		redirect("auth", "refresh");
	}
	
	function remove_admin($id = null){
		if(!is_superadmin($this->ion_auth->user()->row()->id)){
			$this->session->set_flashdata('message', 'You are not superadmin.');
			redirect("auth", "refresh");
		}
		
		if(in_array($id, $this->config->item("superadmin"))){
			$this->session->set_flashdata('message', 'You cannot change superadmin status.');
			redirect("auth", "refresh");
		}
		
		if(isset($id)){
			$this->ion_auth_model->remove_from_group(1, $id);
			$this->session->set_flashdata('message', 'Remove 1 admin.');
		}
		redirect("auth", "refresh");
	}

	//create a new user
	function create_staff()
	{

		
		$this->header->output();
		
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin() && !is_superadmin($this->ion_auth->user()->row()->id))
		{
			//redirect them to the home page because they must be an administrator to view this
			redirect($this->config->item('base_url'), 'refresh');
		}else{
			$this->form_validation->set_error_delimiters('', '');
			
			//validate form input
			$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('phone', 'Phone No.', 'xss_clean');
			$this->form_validation->set_rules('company', 'Company Name', 'xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');
	
			if ($this->form_validation->run() == true)
			{
				$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
				$email = $this->input->post('email');
				$password = $this->input->post('password');
	
				$additional_data = array('first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'company' => $this->input->post('company'),
					'phone' => $this->input->post('phone'),
				);
			}
			if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
			{ //check to see if we are creating the user
				//redirect them back to the admin page
				$this->session->set_flashdata('message', "Staff Created");
				redirect("auth", 'refresh');
			}
			else
			{ //display the create user form
				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
	
				$this->data['first_name'] = array('name' => 'first_name',
					'id' => 'first_name',
					'type' => 'text',
					'value' => $this->form_validation->set_value('first_name'),
				);
				$this->data['last_name'] = array('name' => 'last_name',
					'id' => 'last_name',
					'type' => 'text',
					'value' => $this->form_validation->set_value('last_name'),
				);
				$this->data['email'] = array('name' => 'email',
					'id' => 'email',
					'type' => 'text',
					'value' => $this->form_validation->set_value('email'),
				);
				$this->data['company'] = array('name' => 'company',
					'id' => 'company',
					'type' => 'text',
					'value' => $this->form_validation->set_value('company'),
				);
				$this->data['phone'] = array('name' => 'phone',
					'id' => 'phone',
					'type' => 'text',
					'value' => $this->form_validation->set_value('phone'),
				);
				$this->data['password'] = array('name' => 'password',
					'id' => 'password',
					'type' => 'password',
					'value' => $this->form_validation->set_value('password'),
				);
				$this->data['password_confirm'] = array('name' => 'password_confirm',
					'id' => 'password_confirm',
					'type' => 'password',
					'value' => $this->form_validation->set_value('password_confirm'),
				);
				$this->load->view('auth/create_user', $this->data);
			}
		}
		$this->load->view("footer");
	}
	
	function trash($id){
		if(!is_superadmin($this->ion_auth->user()->row()->id)){
			$this->session->set_flashdata('message', 'You are not superadmin.');
			redirect("auth", "refresh");
		}
		
		if(in_array($id, $this->config->item("superadmin"))){
			$this->session->set_flashdata('message', 'You cannot delete superadmin.');
			redirect("auth", "refresh");
		}
		
		if(isset($id)){
			$this->ion_auth_model->delete_user($id);
			$this->session->set_flashdata('message', 'Remove 1 staff.');
		}
		redirect("auth", "refresh");
	}

	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
				$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}

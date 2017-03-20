<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends Cpanel_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{ 
		// Check whether the user is already logged-in
		if ($this->ion_auth->logged_in()) {
			redirect('', 'refresh');
		}

		$this->load->library('form_validation');
		//validate form input
		$this->form_validation->set_rules('identity', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		

		if ($this->form_validation->run() == true) {
			//check to see if the user is logging in
			//check for "remember me"
			
			 $remember	 		= (bool) $this->input->post('remember'); 
			 if ($remember) {
				 $rememberMe	= TRUE;
			 } else {
				 $rememberMe	= FALSE;
			 }
			
			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $rememberMe)) {
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->session->set_flashdata('message_type', 'info');
				redirect('', 'refresh');
			} else {
				//if the login was un-successful
				//redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				$this->session->set_flashdata('message_type', 'danger');
				redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		} else {
			//the user is not logging in so display the login page
			//set the flash data error message if there is one
			if (validation_errors()) {
				$this->data['message'] 		= validation_errors();
				$this->data['message_type'] = 'danger';
			} else {
				$this->data['message'] 		= $this->session->flashdata('message');
				$this->data['message_type'] = $this->session->flashdata('message_type');
			}
			$this->render('login');
		}
	} 
	public function change_password() { // change password
		
		if ($this->ion_auth->logged_in()) { // Check whether the user is already logged-in
			
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name', 'user name', 'required');
		$this->form_validation->set_rules('current_pass', 'current password', 'required');
		$this->form_validation->set_rules('new_password', 'new password', 'required');
		$this->form_validation->set_rules('con_password', 'confirm password', 'required');
		if ($this->form_validation->run() == true) { 
				if ($this->ion_auth->change_password($this->input->post('user_name'), $this->input->post('current_pass'), $this->input->post('new_password'))) {
				// $this->session->set_flashdata('message', $this->ion_auth->messages());
				// $this->session->set_flashdata('message_type', 'info');
				// redirect('auth/logout', 'refresh');
					$data 	= array('message' => $this->ion_auth->messages(),
								'message_type' => 'success'
								);
				print_r(json_encode($data));
				} else {
				// $this->session->set_flashdata('message', $this->ion_auth->errors());
				// $this->session->set_flashdata('message_type', 'danger');
				// redirect('manage/', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
					$data 	= array('message' => $this->ion_auth->errors(),
								'message_type' => 'danger'
								);
				print_r(json_encode($data));
				}
		} else {
			//the user is not logging in so display the login page
			//set the flash data error message if there is one
			if (validation_errors()) {
				// $this->data['message'] 		= "Sorry you don't have permission to access this application";
				// $this->data['message_type'] = 'danger';
				$data 	= array('message' => "Sorry you don't have permission to access this application",
								'message_type' => 'danger'
								);
				print_r(json_encode($data));
				die();

			} else {
				$this->data['message'] 		= $this->session->flashdata('message');
				$this->data['message_type'] = $this->session->flashdata('message_type');
			}

			//redirect('manage/','');
			$data 	= array('message' => validation_errors(),
							'message_type' => 'danger'
								);
				print_r(json_encode($data));

		}
	} else {
		//if the login was un-successful
		//redirect them back to the login page
		$this->session->set_flashdata('message', $this->ion_auth->errors());
		$this->session->set_flashdata('message_type', 'danger');
		redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
	}
		
	}
	
	public function create_user() { // create new user . Admin privilege


		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { // Check whether the user is already logged-in and is admin 
			
		$this->load->library('form_validation');
		$this->form_validation->set_rules('userName', 'user name', 'trim|required|min_length[5]|max_length[12]|is_unique[users.username]|alpha');
		//$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
		//$this->form_validation->set_rules('confPassword', 'Confirm password', 'trim|matches[password]');
		$this->form_validation->set_rules('email', 'email address', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required|integer|min_length[10]|max_length[12]');
		$this->form_validation->set_rules('firstName', 'First name', 'required');
		$this->form_validation->set_rules('lastName', 'Last name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');

		$this->form_validation->set_rules('userType', 'user type', 'required');
		if ($this->form_validation->run() == true) {
			
			$userName			= $this->input->post('userName');
			$password			= $this->input->post('password');
			$confpassword 		= $this->input->post('confpassword');
			$email 				= $this->input->post('email');
			$fisrtName			= $this->input->post('firstName');
			$lastName			= $this->input->post('lastName');
			$userGroup			= $this->input->post('userType');
			$phone 				= $this->input->post('phone');
			$address 			= $this->input->post('address');
			$additionalData 	= array(
								'first_name' => $fisrtName,
								'last_name' => $lastName,
								'company'	=> $address,
								'phone' 	=> $phone
								);
			$group 				= array($userGroup); // Sets user.

			if($userGroup == 2){
				$userType = 'cashier';
			} elseif($userGroup == 3){
				$userType = 'waiter';
			}

			
			if ($this->ion_auth->register($userName, $confpassword, $email, $additionalData, $group)) {
				$user_id = _DB_insert_id();

				$userData="";
				// $this->session->set_flashdata('message', $this->ion_auth->messages());
				// $this->session->set_flashdata('message_type', 'success');
				// redirect('manage/', 'refresh');

				$userData .='<tr class="odd gradeX" >
					<td>'. stripslashes($fisrtName).'</td>
					<td>'. stripslashes($userType).'</td>
					<td>'. stripslashes($userName).'</td>
		            <td>'. stripslashes($email).'</td>					
					<td><a href="#" class="btn btn-warning btn-xs" onclick="edit_userDetails('.$user_id.')"><i class="fa fa-edit"></i> Edit</a></td>';
					if($user_id != 1){
						$userData.='<td id="td_id_'.$user_id.'" ><a href="#" class="btn btn-warning btn-xs btn_delete" onclick="deleteUser('.$user_id.')"><i class="fa fa-edit"></i> Delete</a></td>';
					}
				$userData.='</tr>';
				$data 	= array('message' => $this->ion_auth->messages(),
								'message_type' => 'success',
								'userData'  => $userData
								);
				print_r(json_encode($data));
			} else {
				// $this->session->set_flashdata('message', $this->ion_auth->errors());
				// $this->session->set_flashdata('message_type', 'danger');
				$data 	= array('message' => $this->ion_auth->errors(),
								'message_type' => 'danger'
								);
				print_r(json_encode($data));
			}
				
			} else {
				$data 	= array('message' => validation_errors(),
								'message_type' => 'danger'
								);
				print_r(json_encode($data));

			}
			
		}
	
	}
	public function status_control(){ // status changing of users
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { // Check whether the user is already logged-in and is admin 
			 $userID			= $this->input->post('userDt');
			 $user 				= $this->ion_auth->user($userID)->row();
			 $statusCode		= ($user->active == 1) ? 0 : 1;
			 $data 				= array(
										'active' => $statusCode
										 );
			 if ($this->ion_auth->update($userID,$data)) {
				 $this->render('ajax/user-list');
			 }
		}
	}
	
	public function remove_user($userId = null) {

		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { // Check whether the user is already logged-in and is admin 
			 //$userID			= $this->input->post('userDt');
			 if ($this->ion_auth->delete_user($userId)) {
				 //$this->render('ajax/user-list');
			 	$data 	= array('message' => $this->ion_auth->messages(),
								'message_type' => 'success'
								);
				print_r(json_encode($data));
			 }
		}
	}
	
	public function logout()
	{
		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		$this->session->set_flashdata('message_type', 'info');
		redirect('auth/login', 'refresh');
	}

}
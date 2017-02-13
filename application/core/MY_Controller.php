<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends CI_Controller
{
	public $data   = array();
	public $user   = array();
	public $tables = array();

	public function __construct()
	{ 
		parent::__construct();
		@session_start();
		
		$this->_initialize();
		
	}

	final public function set_message($message, $message_type = 'danger', $is_exit_message = false)
	{
		if (is_bool($message_type)) {
			$message_type = $message_type ? 'success' : 'danger';
		} else {
			$message_type = !empty($message_type) ? $message_type : 'danger';
		}
		if (!empty($message)) {
			if (is_array($message)) {
				$this->data['message'] = array_merge($this->data['message'], $message);
			} else {
				$this->data['message'][] = $message;
			}
			$this->data['message_type']       = $message_type;
			$this->data['isset_exit_message'] = $is_exit_message;
		}
	}

	final public function show_message()
	{
		if (is_array($this->data['message'])) {
			$this->data['message'] = array_map('nl2br', $this->data['message']);
		}
		// return $this->load->view('slices/common/message', array('_msg' => $this->data['message'], '_msg_type' => $this->data['message_type']), true);
	}

	final public function alert_message($message, $message_type = 'danger')
	{
		if (!empty($message) && !empty($message_type)) {
			// return $this->load->view('slices/common/message', array('_msg' => $message, '_msg_type' => $message_type), true);
		}
	}

	final public function clear_messages()
	{
		$this->_init_messages();
	}

	/**
	 * Adding new values to data attribute
	 *
	 * @param array $data
	 */
	final public function add_data($data = array())
	{
		$data       = !is_array($data) ? (array)$data: $data;
		$this->data = array_merge($this->data, $data);
	}
	

	/**
	 * Sending an ajax response as a JSON
	 *
	 * @param array $data
	 * @return mixed  JSON string on success or FALSE on failure
	 */
	final public function ajax_response($data = array())
	{
		$data = array_merge($this->data, $data);
		send_json_reponse($data);
	}

	final public function render($view, $data = array(), $return = false)
	{
		if (!empty($data)) {
			$this->add_data($data);
		}
		if ($return === true) {
			return $this->load->view($view, $this->data, $return);
		}
		$this->load->view($view, $this->data);
	}

	private function _initialize()
	{
		$this->_init_messages();

		// DB tables
		$this->load->config('db_tables', TRUE);
		$this->tables = $this->config->item('tables', 'db_tables');
	}

	private function _init_messages()
	{
		$this->data = array(
			'message'            => array(),
			'message_type'       => '',
			'isset_exit_message' => false
		);
	}
}

// Implementing authentication
class Cpanel_Controller extends Base_Controller
{  
	public function __construct()
	{  
		parent::__construct();
		
		$this->load->library('ion_auth');

		$this->login_check();
		
	}

	public function login_check()
	{		
		if ($this->ion_auth->logged_in()) {		
			if (!$this->ion_auth->is_admin()) {
				//return show_error('You must be an administrator to view this page.');
			}
			$this->user = $this->ion_auth->user()->row_array();
		} else {	  
			$this->session->set_userdata('_login_http_referrer', current_url()); 
			if (!preg_match('/auth\/(login|forgot-password|reset-password|activate)/si', uri_string())) {
				redirect(site_url('auth/login'), 'refresh');
			}
		}
	}
}

// Public controller (login not always required)
class Public_Controller extends Base_Controller
{
	public function __construct()
	{
		parent::__construct();
	}	
}
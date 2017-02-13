<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class manage extends Cpanel_Controller
{
	protected static $upload_config 	= array();
	const MAX_IMAGES_ALLOWED 			= 5;
	public function __construct() {	
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library("pagination");
		$this->load->helper('url');
		
		$this->data['message'] 			= $this->session->flashdata('message');
		$this->data['message_type'] 	= $this->session->flashdata('message_type');
			
	}
	
	public function index() {
		$this->render('dashboard');
		}
	
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends Cpanel_Controller
{	
	public function index()
	{
				redirect('manage', 'refresh');
		// $this->load->view('cpanel/home');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
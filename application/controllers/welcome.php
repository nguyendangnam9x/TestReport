<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('cookie');
		$this->load->library('session');
	}

	function index()
	{	
		$csrf = array(
			"csrfSecret" => $this->security->get_csrf_hash()
		);
		$this->session->set_userdata($csrf);
		$currentProject = $this->session->userdata('projectName');
		// $this->input->set_cookie($csrf);

		$data = array(
			"projectTitle" => "Automation Framework",
			"theme" => $this->session->userdata('theme'),
			"csrfToken" => $this->session->userdata('csrfSecret'), 
			"projectUrl" => "#/",
			"projectLogoText" => "AutoR",
			"currentProject" => $currentProject,
			"floatRightMenu" => array(
				"TesterVN" => "http://testervn.com"
			)
		);

		$this->load->helper('url');

		$this->load->view('layout', $data);
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
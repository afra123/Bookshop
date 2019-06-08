<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Base_Controller {

    public function __construct()
    {
        parent::__construct();

        //load language
		$this->lang->load("auth_lang", 'other');

        //load helpers
        $this->load->helper('form');

        //load model
        $this->load->model('admin/User_model');
    }  

	public function index()
	{
		//Encryption Key Generate
		$key = bin2hex($this->encryption->create_key(16));

		// if the user is not logged in continue to show the login page
        if ($this->auth->is_logged_in() === TRUE)
        {
        	redirect('admin/dashboard');
        } 

        $data = array(
			'site_title' 		=> $this->lang->line('site_title'),
			'page_title' 		=> $this->lang->line('login_page'),
			'txt_h3_login' 		=> $this->lang->line('txt_h3_login'),
			'span_error' 		=> $this->lang->line('span_error'),
			'lbl_userid' 		=> $this->lang->line('lbl_userid'),
			'lbl_pwd' 			=> $this->lang->line('lbl_pwd'),
			'lbl_login' 		=> $this->lang->line('lbl_login'),
			'p_createaccount' 	=> $this->lang->line('p_createaccount'),
			'txt_createaccount' => $this->lang->line('txt_createaccount'),
			'txt_footer' 		=> $this->lang->line('txt_footer')
		);
		
		$this->load->view('auth/login', $data);

        log_message('debug', 'Login page loaded successfully.');
	}

	public function singin(){
		$this->User_model->signin();
	}

	public function signout() {
    	$this->session->sess_destroy();

    	redirect('/');
    }
}

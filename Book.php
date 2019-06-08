<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends Base_Controller {

    public function __construct()
    {        
        parent::__construct();
        
        if ($this->auth->is_logged_in() === FALSE)
        {
            redirect('login');
        }
        //load helpers
		$this->lang->load("admin_lang", 'other');

        //load model
        $this->load->model('Category_model');
        $this->load->model('Book_model');
        $this->load->model('Tracker_model');
    }  

    public function index() {        

    	$data = array(
			'site_title' 		=> $this->lang->line('site_title'),
			'page_title' 		=> 'Book',
            'name' 				=> $this->session->userdata('name'),
            'categories'        => $this->Category_model->getCategories(),
            'books'             => $this->Book_model->getBooks()
        );
        
		$this->load->view('layouts/admin/default_admin_css', $data);
    	$this->load->view('layouts/admin/default_admin_header', $data);
		$this->load->view('layouts/admin/default_admin_js');
		$this->load->view('layouts/admin/default_admin_nav');
		$this->load->view('admin/book', $data);
		$this->load->view('layouts/admin/default_admin_footer', $data);

        log_message('debug', 'Admin dashboard page loaded successfully.');
    }    

    public function edit(){
        $bookId = -1;
        if($this->input->get('bookId')!==null){
            $bookId = $this->input->get('bookId');
        }

        $data = array(
			'site_title' 		=> $this->lang->line('site_title'),
			'page_title' 		=> 'Book',
            'name' 				=> $this->session->userdata('name'),
            'bookId'            => $bookId,
            'book'              => $this->Book_model->getBook($bookId),
            'total'             => $this->Tracker_model->getTotalCount(),
            'stats'             => $this->Tracker_model->getStats($bookId),
            'categories'        => $this->Category_model->getCategories()
		);

		$this->load->view('layouts/admin/default_admin_css', $data);
    	$this->load->view('layouts/admin/default_admin_header', $data);
		$this->load->view('layouts/admin/default_admin_js');
		$this->load->view('layouts/admin/default_admin_nav');
		$this->load->view('admin/editBook', $data);
		$this->load->view('layouts/admin/default_admin_footer', $data);

        log_message('debug', 'Admin dashboard page loaded successfully.');
    }

    public function save(){
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $this->Book_model->saveBook($target_file);
                redirect('admin/book');
            }
        }else{
            if (file_exists($target_file)) {
                $this->Book_model->saveBook($target_file);
                redirect('admin/book');
            }
        }
        redirect('admin/book/edit');
    }

    public function delete(){
        $this->Book_model->deleteBook();
    }
}
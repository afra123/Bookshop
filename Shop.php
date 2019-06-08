<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
    {        
        parent::__construct();
        //load model
        $this->load->model('Category_model');
        $this->load->model('Book_model');
        $this->load->model('Visiter_model');
        $this->load->model('Tracker_model');
    }  

	public function index()
	{
		$this->Visiter_model->setUid();
		$category = -1;
		if($this->input->get('category') !== null){
			$category = $this->input->get('category');
		}

		$data = array(
			'site_title' 		=> 'BookShop',
			'categories'		=> $this->Category_model->getCategories(),
			'topBooks'          => $this->Book_model->getTopBooks(),
			'categoryId'		=> $category,
			'books'				=> $this->Book_model->getBookWithCategory($category),
		);
		//var_dump($this->input->ip_address());
		$this->load->view('front/shop.php', $data);
	}

	public function cart()
	{
		$data = array(
			'site_title' 		=> 'BookShop'
		);

		$this->load->view('front/cart.php', $data);
	}

	public function product()
	{
		$bookId = $this->input->get('id');
		$data = array(
			'site_title' 		=> 'BookShop',
			'book'				=> $this->Book_model->getBook($bookId),
			'books'				=> $this->Tracker_model->saveTrack()
		);

		$this->load->view('front/product.php', $data);
	}

	public function getCartData(){
		print_r($this->Book_model->getCartData());
	}
}
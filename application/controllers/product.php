<?php
	class product extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_product');
		$this->load->helper(array('form', 'url'));
		$this->load->database();
	}
		public function index(){
			$data['product']=$this->m_product->get_all();
			$this->load->view('product',$data);
		}

		public function search(){
			$keyword = $this->input->post('keyword');
			$data['products']=$this->m_product->get_product_keyword($keyword);
			print_r($data);
			$this->load->view('search',$data);
		}
	}

?>
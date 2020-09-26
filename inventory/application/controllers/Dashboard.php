<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->user_login->check_not_login();
		// $this->load->model('count_model');
	}
	

	public function index()
	{
		check_not_login();
		// $item = $this->count_model->count_item();
		// $customer = $this->count_model->count_customer();
		// $supplier = $this->count_model->count_supplier();
		// $user = $this->count_model->count_user();

		// $data = [
		// 	'item'	=> $item,
		// 	'customer'	=> $customer,
		// 	'supplier'	=> $supplier,
		// 	'user'	=> $user,
		// ];
		$this->template_backend->load('template_backend', 'dashboard');	
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/back-end/Dashboard.php */
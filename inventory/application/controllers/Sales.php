<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//check session login, ambil data helper
		check_not_login();
		// check_admin();
		$this->load->model('sales_model');
		$this->load->model('pelanggan_model');
		$this->load->model('item_model');
	}

	public function index(){
		$pelanggan 	= $this->pelanggan_model->get()->result();
		$invoice 	= $this->sales_model->invoice_no();
		$item 		= $this->item_model->get()->result();
		$cart 		= $this->sales_model->get_cart();

		$data = [
			'pelanggan' => $pelanggan,
			'invoice' 	=> $invoice,
			'item'		=> $item,
			'cart'		=> $cart,
		];

		$this->template_backend->load('template_backend', 'transaction/sales/index', $data);	
	}

	public function process(){
		$data = $this->input->post(null, true);

		if(isset($_POST['add_cart'])){
			$item_id = $this->input->post('item_id');
			$check_cart = $this->sales_model->get_cart(['tbl_cart.item_id' => $item_id])->num_rows();
			if($check_cart > 0 ){
				$this->sales_model->update_cart_qty($data);
			}
			else{
				$this->sales_model->add_cart($data);
			}
			
				if($this->db->affected_rows() > 0 ){
					$params = array ("success" => true);
				}
				else{
					$params = array ("success" => false);
				}
				echo json_encode($params);
		}

		if(isset($_POST['edit_cart'])){
			$this->sales_model->update_cart($data);

				if($this->db->affected_rows() > 0 ){
					$params = array ("success" => true);
				}
				else{
					$params = array ("success" => false);
				}
				echo json_encode($params);
		}

		if (isset($_POST['process_payment'])){
			$query = $this->sales_model->add_sale($data);
			// $this->sales_model->add_sale($post);
			$cart =  $this->sales_model->get_cart()->result();
			$row = [];
			foreach ($cart as $c => $value) {
				array_push($row,array(
					'sale_id'		=> $query,
					'item_id' 		=> $value->item_id,
					'price' 		=> $value->price,
					'qty' 			=> $value->qty,
					'discount_item' => $value->discount_item,
					'total' 		=> $value->total,
					)
				);
			}

			$this->sales_model->add_sale_detail($row);
			$this->sales_model->delete_cart(['user_id' => $this->session->userdata('user_id')]);
				if ($this->db->affected_rows()) {
					$params = array("success" => true);
				}
				else{
					$params = array("success" => false);
				}
				echo json_encode($params);
		} 

	} 

	function cart_data(){
		$cart 		= $this->sales_model->get_cart();
	
		$data = [
			'cart'		=> $cart,
		];
		$this->load->view('transaction/sales/cart_data', $data, FALSE);
	}

	public function cart_delete(){
		$cart_id = $this->input->post('cart_id');

		$this->sales_model->delete_cart(['cart_id' => $cart_id]);

		if($this->db->affected_rows() > 0 ){
			$params = array ("success" => true);
		}
		else{
			$params = array ("success" => false);
		}
		echo json_encode($params);
	}

	public function set_max_value()
	{
		$id = $this->input->post('item_id');
		// echo $id;
		$data = $this->sales_model->m_get_stock($id);
		// print_r($data);
		echo json_encode($data);
	}
	
}

/* End of file Sales.php */
/* Location: ./application/controllers/Sales.php */
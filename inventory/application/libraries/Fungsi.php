<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Fungsi{

	public function __construct()
	{
        $this->ci =& get_instance();
        $this->ci->load->model('item_model');
        $this->ci->load->model('supplier_model');
        $this->ci->load->model('pelanggan_model');
        $this->ci->load->model('user_model');
	}

	public function count_item(){
		return $this->ci->item_model->get()->num_rows();
	}

	public function count_supplier(){
		return $this->ci->supplier_model->get()->num_rows();
	}

	public function count_pelanggan(){
		return $this->ci->pelanggan_model->get()->num_rows();
	}

	public function count_user(){
		return $this->ci->user_model->get()->num_rows();
	}
}
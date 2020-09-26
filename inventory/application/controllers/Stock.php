<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(['item_model','kategory_model','unit_model','supplier_model','stock_model']);
		//check session login, ambil data helper
		check_not_login();
		// check_admin();
	} 

	public function stock_in_data(){
		$post = $this->input->post(null, true);
		$tombol = $this->input->post('cari_tanggal');
		if($tombol == ""){
			// echo "here1";
			$data['row'] = $this->stock_model->get_stock_in();
		} else {
			// echo "here2";
			$tgl_awal = $this->input->post('tgl_awal');
			$tgl_akhir = $this->input->post('tgl_akhir');
			$post = [
				'tgl_awal' => $tgl_awal,
				'tgl_akhir' => $tgl_akhir
			];

			$data['row'] = $this->stock_model->filter_stock_in($post);
			// print('<pre>');print_r($data);exit();
		}
		$this->template_backend->load('template_backend', 'transaction/stock_in/index', $data);
	}

	public function stock_in_delete(){
		$id_stock 	= $this->uri->segment(4);
		$item_id 	= $this->uri->segment(5);
		$qty		= $this->stock_model->get($id_stock)->row()->qty;

		$data 			=[
			'qty' 		=> $qty,
			'item_id' 	=> $item_id,
		];

		$this->item_model->update_stock_out($data);
		$this->stock_model->delete($id_stock);
		if($this->db->affected_rows() > 0 ){
			$this->session->set_flashdata('warning', 'Data Stock-In Berhasil Dihapus');
		}
			redirect(base_url('stock/in'),'refresh');
	}

	public function stock_in_add(){
		$item = $this->item_model->get()->result();
		$supplier = $this->supplier_model->get()->result();
		$data = ['item' => $item, 'supplier' => $supplier];
		$this->template_backend->load('template_backend', 'transaction/stock_in/tambah', $data);
	}

	public function process(){
		if(isset($_POST['in_add'])) {
			$post = $this->input->post(null, true);
			$this->stock_model->add_stock_in($post);
			$this->item_model->update_stock_in($post);

			if($this->db->affected_rows() > 0 ){
				$this->session->set_flashdata('sukses', 'Data Stock-In Berhasil Disimpan');
			}
				redirect(base_url('stock/in'),'refresh');
		}

		else if(isset($_POST['out_add'])) {
			$post = $this->input->post(null, true);
			$item_row = $this->item_model->get($post['id_item'])->row();
			if($item_row->stock < $post['qty']){
				$this->session->set_flashdata('warning', 'Data QTY Melebihi Barang Item');
				redirect(base_url('stock/out/add'),'refresh');
			}
			else{
			$this->stock_model->add_stock_out($post);
			$this->item_model->update_stock_out($post);
				if($this->db->affected_rows() > 0 ){
					$this->session->set_flashdata('sukses', 'Data Stock-Out Berhasil Disimpan');
				}
					redirect(base_url('stock/out'),'refresh');
			}
		}
	}

	//bagian stock out

	public function stock_out_data(){
		$post = $this->input->post(null, true);
		$tombol = $this->input->post('cari_tanggal');
		if($tombol == ""){
			// echo "here1";
			$data['row'] = $this->stock_model->get_stock_out();
		} else {
			// echo "here2";
			$tgl_awal = $this->input->post('tgl_awal');
			$tgl_akhir = $this->input->post('tgl_akhir');
			$post = [
				'tgl_awal' => $tgl_awal,
				'tgl_akhir' => $tgl_akhir
			];

			$data['row'] = $this->stock_model->filter_stock_out($post);
			// print('<pre>');print_r($data);exit();
		}
		$this->template_backend->load('template_backend', 'transaction/stock_out/index', $data);
	}

	public function stock_out_delete(){
		$stock_id 	= $this->uri->segment(4);
		$item_id 	= $this->uri->segment(5);
		$qty		= $this->stock_model->get($stock_id)->row()->qty;

		$data 			=[
			'qty' 		=> $qty,
			'item_id' 	=> $item_id,
		];

		$this->item_model->update_stock_in($data);
		$this->stock_model->delete($stock_id);
		if($this->db->affected_rows() > 0 ){
			$this->session->set_flashdata('warning', 'Data Stock-out Berhasil Dihapus');
		}
			redirect(base_url('stock/out'),'refresh');
	}

	public function stock_out_add(){
		$item = $this->item_model->get()->result();
		$data = ['item' => $item];
		$this->template_backend->load('template_backend', 'transaction/stock_out/stock_out', $data);
	}

	// //bagian mutasi stock
	// public function mutasi_stock(){
	// 	$post = $this->input->post(null, true);
	// 	$tombol = $this->input->post('cari_tanggal');
	// 	if($tombol == ""){
	// 		// echo "here1";
	// 		$data['row'] = $this->stock_model->get_mutasi_stock();
	// 	} else {
	// 		// echo "here2";
	// 		$tgl_awal = $this->input->post('tgl_awal');
	// 		$tgl_akhir = $this->input->post('tgl_akhir');
	// 		$post = [
	// 			'tgl_awal' => $tgl_awal,
	// 			'tgl_akhir' => $tgl_akhir
	// 		];

	// 		$data['row'] = $this->stock_model->filter_stock_out($post);
	// 		// print('<pre>');print_r($data);exit();
	// 	}
	// 	$this->template_backend->load('template_backend', 'transaction/mutasi_stock/index', $data);
	// }

}

/* End of file Stock.php */
/* Location: ./application/controllers/Stock.php */
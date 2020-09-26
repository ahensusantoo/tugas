<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('report_model');
		$this->load->model('item_model');
	}

	public function get_sale(){
		$sale =	$this->report_model->get_sale();
		$item = $this->item_model->get()->result();
		$data = [
			'sale' => $sale,
			'item' => $item,
		];
		$this->template_backend->load('template_backend', 'report/sale/index', $data);
	} 

	//bagian mutasi stock

	//bagian halaman utama
	public function mutasi_stock(){
		$post = $this->input->post(null, true);
		$tombol = $this->input->post('cari_tanggal');
		$kode_item = $this->input->post('kode_item');
		// echo $kode_item;
			$data['item'] 		= $this->item_model->get()->result();
			$get['get_itemid'] 		= $this->report_model->get_item_id()->result();
		if($kode_item == ""){
			// echo "here1";
			$mutasi 	= $this->report_model->get_mutasi_stock();
			$data = [
				'row' => $mutasi
			];
			// echo "here1";exit();
			// $data['row_modal'] = $this->report_model->get_mutasi_stock()->result();
			$data['row'] = $this->report_model->get_mutasi_stock()->result();

		} else {
			echo "here2";
			$tgl_awal = $this->input->post('tgl_awal');
			$tgl_akhir = $this->input->post('tgl_akhir');
			$post = [
				'tgl_awal' => $tgl_awal,
				'tgl_akhir' => $tgl_akhir,
				'item_id' => $kode_item
			];
			// print_r($post);
			$data['row'] = $this->report_model->filter_stock($post);
			// echo "here2";exit();
		}
		// print('<pre>');print_r($get);exit();
		$this->template_backend->load('template_backend', 'report/mutasi_stock/index', $data);
	}

}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */
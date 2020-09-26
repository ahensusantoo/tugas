<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(['item_model','kategory_model','unit_model']);
		//check session login, ambil data helper
		check_not_login();
		// check_admin();
	}

	function get_ajax() {
        $list = $this->item_model->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $item->barcode.'<br><a href="'.site_url('item/barcode_qrcode/'.$item->item_id).'" class="btn btn-default btn-xs">Generate <i class="fa fa-barcode"></i></a>';
            $row[] = $item->nama_item;
            $row[] = $item->nama_kategory;
            $row[] = $item->nama_unit;
            $row[] = indo_currency($item->price);
            $row[] = $item->stock;
            $row[] = $item->image != null ? '<img src="'.base_url('uploads/product/'.$item->image).'" class="img" style="width:100px">' : null;
            // add html for action
            $row[] = '<a href="'.site_url('item/update/'.$item->item_id).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
                    <a href="'.site_url('item/delete/'.$item->item_id).'" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->item_model->count_all(),
                    "recordsFiltered" => $this->item_model->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

	public function index(){
		$item['row'] = $this->item_model->get();

		$this->template_backend->load('template_backend', 'product/item/index', $item);
	}

	public function add(){
		$item 				= new stdClass();
		$item->item_id		= null;
		$item->kode_item	= null;
		$item->barcode 		= null;
		$item->nama_item 	= null;
		$item->price 		= null;
		$item->deskripsi 	= null;
		$item->kategory_id 	= null;

		$query_kategory 	= $this->kategory_model->get();
		$query_unit 		= $this->unit_model->get();

		$unit[null]			= '--PILIH--';
		foreach ($query_unit->result() as $key => $unt) {
			$unit[$unt->unit_id] = $unt->nama_unit;
		}

		$data = array(
			'page' 		=> 'add',
			'row'		=> $item,
			'kategory' 	=> $query_kategory,
			'unit'		=> $unit, 'selectedunit' => null,
		);
		$this->template_backend->load('template_backend', 'product/item/tambah_edit', $data);
	}

	public function update($id){
		$query = $this->item_model->get($id);
		if($query->num_rows() > 0 ) {
			$item = $query->row();

			$query_kategory 	= $this->kategory_model->get();
			$query_unit 		= $this->unit_model->get();

			$unit[null]			= '--PILIH--';
			foreach ($query_unit->result() as $key => $unt) {
				$unit[$unt->unit_id] = $unt->nama_unit;
			}

			$data = array(
				'page' 		=> 'update',
				'row'		=> $item,
				'kategory' 	=> $query_kategory,
				'unit'		=> $unit, 'selectedunit' => $item->unit_id,
			);
			$this->template_backend->load('template_backend', 'product/item/tambah_edit', $data);
		}
		else{
			echo "<script>alert('Data tidak ditemukan');";
				echo "window.location='".site_url('item')."'</script>";
		}
	}

	public function process(){
		$config['upload_path']          = './uploads/product/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['file_name']            = 'item-'.date('ymd').'-'.substr(md5(rand()),0,10);
        $this->load->library('upload', $config);
	
		$post = $this->input->post(null, true);
		if(isset($_POST['add'])){
			if($this->item_model->check_kode_item($post['kode_item'])->num_rows() > 0 ){
				$this->session->set_flashdata('warning', "Kode Item $post[kode_item] sudah digunakan!");
				redirect('item/add','refresh');
			}
			else{
                //jika ada gambar yang di upload
				if(@$_FILES['image']['name'] != null ) {
					if ($this->upload->do_upload('image')){
						$post['image'] = $this->upload->data('file_name');
						$this->item_model->add($post);
						if($this->db->affected_rows() > 0 ){
							$this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						}
						redirect(base_url('item'),'refresh');
					}
					else{
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('warning', $error);
						redirect('item/add','refresh');
					}
				}
				//jika upload tanpa gambar
				else{
					$post['image'] = null;
					$this->item_model->add($post);
					if($this->db->affected_rows() > 0 ){
						$this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
					}
					redirect(base_url('item'),'refresh');
				}
			}
		}
		else if(isset($_POST['update'])){
			if($this->item_model->check_kode_item($post['barcode'], $post['id'])->num_rows() > 0 ){
				$this->session->set_flashdata('warning', "Kode Item $post[kode_item] sudah digunakan!");
				redirect('item/update/'.$post['id'],'refresh');
			}
			else{
                //jika ada gambar yang di upload
				if(@$_FILES['image']['name'] != null ) {
					if ($this->upload->do_upload('image')){

						$item = $this->item_model->get($post['id'])->row();
						if($item->image != null ){
							$target_file = './uploads/product/'.$item->image;
							unlink($target_file);
						}

						$post['image'] = $this->upload->data('file_name');
						$this->item_model->update($post);
						if($this->db->affected_rows() > 0 ){
							$this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						}
						redirect(base_url('item'),'refresh');
					}
					else{
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('warning', $error);
						redirect('item/update','refresh');
					}
				}
				//jika upload tanpa gambar
				else{
					$post['image'] = null;
					$this->item_model->update($post);
					if($this->db->affected_rows() > 0 ){
						$this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
					}
					redirect(base_url('item'),'refresh');
				}
			}
		}
	}

	public function delete($id){
		$item = $this->item_model->get($id)->row();
		if($item->image != null ){
			$target_file = './uploads/product/'.$item->image;
			unlink($target_file);
		}
		// $id = $this->input->post('id_item');
			$this->item_model->delete($id);
			if($this->db->affected_rows() > 0 ){
				$this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
			}
				redirect(base_url('item'),'refresh');
	}

	function barcode_qrcode($id){
		$item['row'] = $this->item_model->get($id)->row();

		$this->template_backend->load('template_backend', 'product/item/barcode_qrcode', $item);
	}

	function coba_qrcode(){
		$qrCode = new Endroid\QrCode\QrCode('123456');

		header('Content-Type: '.$qrCode->getContentType());
		echo $qrCode->writeString();
	}

} 

/* End of file Item.php */
/* Location: ./application/controllers/Item.php */
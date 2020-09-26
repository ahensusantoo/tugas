<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('pelanggan_model');
		//check session login, ambil data helper
		check_not_login();
		// check_admin();
	}

	public function index(){
		$pelanggan['row'] = $this->pelanggan_model->get();

		$this->template_backend->load('template_backend', 'pelanggan/index', $pelanggan);
	}

	public function add(){
		$pelanggan 					= new stdClass();
		$pelanggan->pelanggan_id	= null;
		$pelanggan->kode_pelanggan 	= null;
		$pelanggan->nama_pelanggan 	= null;
		$pelanggan->phone 			= null;
		$pelanggan->alamat 			= null;
		$data = array(
			'page' 	=> 'add',
			'row'	=> $pelanggan
		);
		$this->template_backend->load('template_backend', 'pelanggan/tambah_edit', $data);
	}

	public function update($id){
		$query = $this->pelanggan_model->get($id);
		if($query->num_rows() > 0 ) {
			$pelanggan = $query->row();
			$data = array(
			'page' 	=> 'update',
			'row'	=> $pelanggan
			);
			$this->template_backend->load('template_backend', 'pelanggan/tambah_edit', $data);
		}
		else{
			echo "<script>alert('Data tidak ditemukan');";
				echo "window.location='".site_url('pelanggan')."'</script>";
		}
	}

	public function process(){
		$post = $this->input->post(null, true);
		if(isset($_POST['add'])){
			if($this->pelanggan_model->check_code_pelanggan($post['kode_pelanggan'])->num_rows() > 0 ){
				$this->session->set_flashdata('warning', "Kode Item $post[kode_pelanggan] sudah digunakan!");
				redirect('pelanggan/add','refresh');
			}
			$this->pelanggan_model->add($post);
		}

		else if(isset($_POST['update'])){
			if($this->pelanggan_model->check_code_pelanggan($post['kode_pelanggan'])->num_rows() > 0 ){
				$this->session->set_flashdata('warning', "Kode Item $post[kode_pelanggan] sudah digunakan!");
				redirect('pelanggan/add','refresh');
			}
			$this->pelanggan_model->update($post);
		}

		if($this->db->affected_rows() > 0 ){
			if(isset($_POST['add'])){
				$this->session->set_flashdata('sukses','Data Berhasil Di Tambah');
			}
			else if (isset($_POST['update'])){
				$this->session->set_flashdata('sukses','Data Berhasil Di Update');
			}
		}
			echo "<script>window.location='".site_url('pelanggan')."'</script>";
	}

	public function delete($id){
		// $id = $this->input->post('id_pelanggan');
			$this->pelanggan_model->delete($id);
			if($this->db->affected_rows() > 0 ){
				$this->session->set_flashdata('sukses','Data Berhasil Di Hapus');
			}
				echo "<script>window.location='".site_url('pelanggan')."'</script>";
	}
	

} 

/* End of file Pelanggan.php */
/* Location: ./application/controllers/Pelanggan.php */
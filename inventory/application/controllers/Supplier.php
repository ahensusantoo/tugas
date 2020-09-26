<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('supplier_model');
		//check session login, ambil data helper
		check_not_login();
		// check_admin();
	}

	public function index(){
		$supplier['row'] = $this->supplier_model->get();

		$this->template_backend->load('template_backend', 'supplier/index', $supplier);
	}

	public function add(){
		$supplier = new stdClass();
		$supplier->supplier_id = null;
		$supplier->kode_supplier = null;
		$supplier->nama_supplier = null;
		$supplier->phone = null;
		$supplier->alamat = null;
		$supplier->deskripsi = null;
		$data = array(
			'page' 	=> 'add',
			'row'	=> $supplier
		);
		$this->template_backend->load('template_backend', 'supplier/tambah_edit', $data);
	}

	public function update($id){
		$query = $this->supplier_model->get($id);
		if($query->num_rows() > 0 ) {
			$supplier = $query->row();
			$data = array(
			'page' 	=> 'update',
			'row'	=> $supplier
			);
			$this->template_backend->load('template_backend', 'supplier/tambah_edit', $data);
		}
		else{
			echo "<script>alert('Data tidak ditemukan');";
				echo "window.location='".site_url('supplier')."'</script>";
		}
	}

	public function process(){
		$post = $this->input->post(null, true);
		if(isset($_POST['add'])){
			// $valid = $this->form_validation;

			// $valid->set_rules('kode_supplier','Kode Supplier','required|is_unique[tbl_user.username]');
			// $valid->set_message(array(	'required'		=> '%s harus diisi',
			// 						'is_unique'		=> '%s sudah digunakan',));
			// $valid->set_error_delimiters('<span class="help-block">', '</span>');

			// if($valid->run() == false){
				// $this->template_backend->load('template_backend', 'supplier/add');
			// }
			// else{
				$this->supplier_model->add($post);
			// }
		}

		else if(isset($_POST['update'])){
			$this->supplier_model->update($post);
		}

		if($this->db->affected_rows() > 0 ){
			if(isset($_POST['add'])){
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Tambah');
			}
			else if (isset($_POST['update'])){
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Update');
			}
		}
			echo "<script>window.location='".site_url('supplier')."'</script>";
	}

	public function delete($id){
		// $id = $this->input->post('id_supplier');
		$this->supplier_model->delete($id);

		//cara membuat notif saat tabel sudah berelasi
		$error = $this->db->error();
		if ($error['code'] != 0 ){
			echo "<script>alert('Data Tidak Dapat Dihapus (Karena Sudah Berelasi )');</script>";
		}
		else{
			echo "<script>alert('Data Berhasil Dihapus');</script>";
		}
		echo "<script>window.location='".site_url('supplier')."'</script>";
	}
	

} 

/* End of file Supplier.php */
/* Location: ./application/controllers/Supplier.php */
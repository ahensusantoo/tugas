<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategory extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('kategory_model');
		//check session login, ambil data helper
		check_not_login();
		// check_admin();
	}

	public function index(){
		$kategory['row'] = $this->kategory_model->get();

		$this->template_backend->load('template_backend', 'product/kategory/index', $kategory);
	}

	public function add(){
		$kategory 					= new stdClass();
		$kategory->kategory_id		= null;
		$kategory->nama_kategory 	= null;
		$data = array(
			'page' 	=> 'add',
			'row'	=> $kategory
		);
		$this->template_backend->load('template_backend', 'product/kategory/tambah_edit', $data);
	}

	public function update($id){
		$query = $this->kategory_model->get($id);
		if($query->num_rows() > 0 ) {
			$kategory = $query->row();
			$data = array(
			'page' 	=> 'update',
			'row'	=> $kategory
			);
			$this->template_backend->load('template_backend', 'product/kategory/tambah_edit', $data);
		}
		else{
			echo "<script>alert('Data tidak ditemukan');";
				echo "window.location='".site_url('kategory')."'</script>";
		}
	}

	public function process(){
		$post = $this->input->post(null, true);
		if(isset($_POST['add'])){
			$this->kategory_model->add($post);
		}

		else if(isset($_POST['update'])){
			$this->kategory_model->update($post);
		}

		if($this->db->affected_rows() > 0 ){
			if(isset($_POST['add'])){
				$this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
			}
			else if (isset($_POST['update'])){
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Update');
			}
		}
			redirect(base_url('kategory'),'refresh');
	}

	public function delete($id){
		// $id = $this->input->post('id_kategory');
			$this->kategory_model->delete($id);
			if($this->db->affected_rows() > 0 ){
				$this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
			}
				redirect(base_url('kategory'),'refresh');
	}
	

} 

/* End of file Kategory.php */
/* Location: ./application/controllers/Kategory.php */
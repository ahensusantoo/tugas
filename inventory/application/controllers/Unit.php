<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('unit_model');
		//check session login, ambil data helper
		check_not_login();
		// check_admin();
	}

	public function index(){
		$unit['row'] = $this->unit_model->get();

		$this->template_backend->load('template_backend', 'product/unit/index', $unit);
	}

	public function add(){
		$unit 					= new stdClass();
		$unit->unit_id			= null;
		$unit->nama_unit 			= null;
		$data = array(
			'page' 	=> 'add',
			'row'	=> $unit
		);
		$this->template_backend->load('template_backend', 'product/unit/tambah_edit', $data);
	}

	public function update($id){
		$query = $this->unit_model->get($id);
		if($query->num_rows() > 0 ) {
			$unit = $query->row();
			$data = array(
			'page' 	=> 'update',
			'row'	=> $unit
			);
			$this->template_backend->load('template_backend', 'product/unit/tambah_edit', $data);
		}
		else{
			echo "<script>alert('Data tidak ditemukan');";
				echo "window.location='".site_url('unit')."'</script>";
		}
	}

	public function process(){
		$post = $this->input->post(null, true);
		if(isset($_POST['add'])){
			$this->unit_model->add($post);
		}

		else if(isset($_POST['update'])){
			$this->unit_model->update($post);
		}

		if($this->db->affected_rows() > 0 ){
			if(isset($_POST['add'])){
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			}
			else if (isset($_POST['update'])){
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Update');
			}
		}
			redirect(base_url('unit'),'refresh');
	}

	public function delete($id){
		// $id = $this->input->post('id_unit');
			$this->unit_model->delete($id);
			if($this->db->affected_rows() > 0 ){
				$this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
			}
				redirect(base_url('unit'),'refresh');
	}
	

} 

/* End of file Unit.php */
/* Location: ./application/controllers/Unit.php */
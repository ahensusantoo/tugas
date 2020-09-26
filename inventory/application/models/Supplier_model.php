<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model {

public function __construct()
	{
		parent::__construct();
		
	}

	public function get($id = null){
		$this->db->select('*');
		$this->db->from('tbl_supplier');
		$this->db->order_by('supplier_id', 'desc');
		if($id != null){
			$this->db->where('supplier_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	//proses tambah
	public function add($post){
		$params 	= [
			'kode_supplier'	=> $post['kode_supplier'],
			'nama_supplier'	=> $post['nama_supplier'],
			'phone'			=> $post['phone'],
			'alamat'		=> $post['alamat'],
			'deskripsi'		=> empty($post['desc']) ? null : $post['desc'],
			'created'		=> date('Y-m-d')
		];
		$this->db->insert('tbl_supplier', $params);
	}

	public function update($post){
		$params 	= [
			'kode_supplier'	=> $post['kode_supplier'],
			'nama_supplier'	=> $post['nama_supplier'],
			'phone'			=> $post['phone'],
			'alamat'		=> $post['alamat'],
			'deskripsi'		=> empty($post['desc']) ? null : $post['desc'],
		];
		$this->db->where('supplier_id', $post['id']);
		$this->db->update('tbl_supplier', $params);
	}

	public function delete($id){
		$this->db->where('supplier_id', $id);
		$this->db->delete('tbl_supplier');
	}

}

/* End of file Supplier_model.php */
/* Location: ./application/models/Supplier_model.php */
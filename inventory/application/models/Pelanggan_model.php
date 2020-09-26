<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model {

public function __construct()
	{
		parent::__construct();
		
	}

	public function get($id = null){
		$this->db->select('*');
		$this->db->from('tbl_pelanggan');
		$this->db->order_by('pelanggan_id', 'desc');
		if($id != null){
			$this->db->where('pelanggan_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	//proses tambah
	public function add($post){
		$params 	= [
			'kode_pelanggan'	=> $post['kode_pelanggan'],
			'nama_pelanggan'	=> $post['nama_pelanggan'],
			'phone'				=> $post['phone'],
			'alamat'			=> empty($post['addres']) ?null : $post['addres'],
			'created'			=> date('Y-m-d')
		];
		$this->db->insert('tbl_pelanggan', $params);
	}

	public function update($post){
		$params 	= [
			'kode_pelanggan'	=> $post['kode_pelanggan'],
			'nama_pelanggan'	=> $post['nama_pelanggan'],
			'phone'				=> $post['phone'],
			'alamat'			=> empty($post['addres']) ?null : $post['addres'],
		];
		$this->db->where('pelanggan_id', $post['id']);
		$this->db->update('tbl_pelanggan', $params);
	}

	public function delete($id){
		$this->db->where('pelanggan_id', $id);
		$this->db->delete('tbl_pelanggan');
	}

	public function check_code_pelanggan($code, $id = null){
		$this->db->from('tbl_pelanggan');
		$this->db->where('kode_pelanggan', $code);
		if($id != null){
			$this->db->where('item_id !=', $id);
		}
		$query = $this->db->get();
		return $query;
	}

}

/* End of file Pelanggan_model.php */
/* Location: ./application/models/Pelanggan_model.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategory_model extends CI_Model {

public function __construct()
	{
		parent::__construct();
		
	}

	public function get($id = null){
		$this->db->select('*');
		$this->db->from('tbl_kategory');
		$this->db->order_by('kategory_id', 'desc');
		if($id != null){
			$this->db->where('kategory_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	//proses tambah
	public function add($post){
		$params 	= [
			'nama_kategory'	=> $post['kategory_name'],
			'created'		=> date('Y-m-d')	
		];
		$this->db->insert('tbl_kategory', $params);
	}

	public function update($post){
		$params 	= [
			'nama_kategory'	=> $post['kategory_name'],
		];
		$this->db->where('kategory_id', $post['id']);
		$this->db->update('tbl_kategory', $params);
	}

	public function delete($id){
		$this->db->where('kategory_id', $id);
		$this->db->delete('tbl_kategory');
	}

}

/* End of file Kategory_model.php */
/* Location: ./application/models/Kategory_model.php */
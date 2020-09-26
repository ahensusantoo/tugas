<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_model extends CI_Model {

public function __construct()
	{
		parent::__construct();
		
	}

	public function get($id = null){
		$this->db->select('*');
		$this->db->from('tbl_unit');
		$this->db->order_by('unit_id', 'desc');
		if($id != null){
			$this->db->where('unit_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	//proses tambah
	public function add($post){
		$params 	= [		
			'nama_unit'		=> $post['unit_name'],
			'created'		=> date('Y-m-d')	
		];
		$this->db->insert('tbl_unit', $params);
	}

	public function update($post){
		$params 	= [
			'nama_unit'			=> $post['unit_name'],
		];
		$this->db->where('unit_id', $post['id']);
		$this->db->update('tbl_unit', $params);
	}

	public function delete($id){
		$this->db->where('unit_id', $id);
		$this->db->delete('tbl_unit');
	}

}

/* End of file Unit_model.php */
/* Location: ./application/models/Unit_model.php */
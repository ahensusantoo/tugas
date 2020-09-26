<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

public function __construct()
	{
		parent::__construct();
		
	}

	public function login($post){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('username', $post['username']);
		$this->db->where('password', sha1($post['password']));
		$query = $this->db->get();
		return $query;
	}	

	public function get($id = null){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->order_by('user_id', 'desc');
		if($id != null){
			$this->db->where('user_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	//proses tambah
	public function add($post){
		// $params['name'] = $post['fullname'];
		// $params['username'] = $post['username'];
		// $params['password'] = $post['password'];
		// $params['addres'] = $post['addres'] != "" ? $post['addres'] : null;
		// $params['level'] = $post['level'];
		$params = array(	'username'		=> $post['username'],
							'password'		=> SHA1($post['password']),
							'level'			=> $post['level'],	
						);
		$this->db->insert('tbl_user', $params);
	}

	public function update($post){
		$params['username'] = $post['username'];
		if(!empty($post['password'])){
			$params['password'] = SHA1($post['password']);
		}
		$params['level'] = $post['level'];
		
		$this->db->where('user_id', $post['user_id']);
		$this->db->update('tbl_user', $params);
	}

	public function delete($id){
		$this->db->where('user_id', $id);
		$this->db->delete('tbl_user');
	}

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
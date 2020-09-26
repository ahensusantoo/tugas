<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {

	public function get($id=null){
		$this->db->select('*');
		$this->db->from('tbl_stock');
		if($id != null){
			$this->db->where('stock_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function delete($id){
		$this->db->where('stock_id', $id);
		$this->db->delete('tbl_stock');
	}


	public function get_stock_in(){
		$this->db->select('*');
		$this->db->from('tbl_stock');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_stock.item_id', 'left');
		$this->db->join('tbl_user', 'tbl_user.user_id = tbl_stock.user_id', 'left');
		$this->db->join('tbl_supplier', 'tbl_supplier.supplier_id = tbl_stock.supplier_id', 'left');
		$this->db->where('type', 'in');
		$this->db->order_by('stock_id', 'decs');
		$query = $this->db->get()->result();
		$_SESSION["isi_tanggal"] = "kosong";
		return $query;
	}

	public function add_stock_in($post){
		$params 	= [		
			'item_id'			=> $post['item_id'],
			'type'				=> 'in',
			'detail'			=> $post['detail'],
			'supplier_id'		=> $post['supplier'] == '' ? null : $post['supplier'],
			'qty'				=> $post['qty'],
			'date'				=> $post['date'],
			'user_id'			=> $this->session->userdata('user_id'),
		];
		$this->db->insert('tbl_stock', $params);
	}


	//bagian stock out
	public function get_stock_out(){
		$this->db->select('*');
		$this->db->from('tbl_stock');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_stock.item_id', 'left');
		$this->db->join('tbl_user', 'tbl_user.user_id = tbl_stock.user_id', 'left');
		$this->db->join('tbl_supplier', 'tbl_supplier.supplier_id = tbl_stock.supplier_id', 'left');		$this->db->where('type', 'out');
		$this->db->order_by('stock_id', 'decs');
		$query = $this->db->get()->result();
		return $query;
	}

	public function add_stock_out($post){
		$params 	= [		
			'item_id'			=> $post['item_id'],
			'type'				=> 'out',
			'detail'			=> $post['detail'],
			'supplier_id'		=> $post['supplier'] == '' ? null : $post['supplier'],
			'qty'				=> $post['qty'],
			'date'				=> $post['date'],
			'user_id'			=> $this->session->userdata('user_id'),
		];
		$this->db->insert('tbl_stock', $params);
	}

	public function filter_stock_in($post){
		// print_r($post);
		$this->db->select()
				->from('tbl_stock')
				->where('date >=', $post['tgl_awal'])
				->where('date <=', $post['tgl_akhir'])
				->where('type=','in');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_stock.item_id', 'left');
		$this->db->join('tbl_user', 'tbl_user.user_id = tbl_stock.user_id', 'left');
		$this->db->join('tbl_supplier', 'tbl_supplier.supplier_id = tbl_stock.supplier_id', 'left');
		$query = $this->db->get_compiled_select();
		// print('<pre>');print_r($query);exit();
		$data = $this->db->query($query)->result();
		// $_SESSION["isi_tanggal"] = "isi";
		return $data;
		// $sql = "SELECT * FROM tbl_stock WHERE date BETWEEN  '$post[tgl_awal]' AND '$post[tgl_akhir]' AND type = 'in'";
		// return $sql;
	}

	public function filter_stock_out($post){
		// print_r($post);
		$this->db->select()
				->from('tbl_stock')
				->where('date >=', $post['tgl_awal'])
				->where('date <=', $post['tgl_akhir'])
				->where('type=','out');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_stock.item_id', 'left');
		$this->db->join('tbl_user', 'tbl_user.user_id = tbl_stock.user_id', 'left');
		$this->db->join('tbl_supplier', 'tbl_supplier.supplier_id = tbl_stock.supplier_id', 'left');
		$query = $this->db->get_compiled_select();
		// print('<pre>');print_r($query);exit();
		$data = $this->db->query($query)->result();
		// $_SESSION["isi_tanggal"] = "isi";
		return $data;
		// $sql = "SELECT * FROM tbl_stock WHERE date BETWEEN  '$post[tgl_awal]' AND '$post[tgl_akhir]' AND type = 'in'";
		// return $sql;
	}


	// //mutasi stock
	// public function get_mutasi_stock($id = null){
	// 	$this->db->select('*');
	// 	$this->db->from('tbl_stock');
	// 	$this->db->join('tbl_item', 'tbl_item.item_id = tbl_stock.item_id', 'left');
	// 	$this->db->order_by('stock_id', 'desc');
	// 	if($id != null){
	// 		$this->db->where('stock_id', $id);
	// 	}
	// 	$query = $this->db->get();
	// 	return $query;
	// }

}

/* End of file Stock_model.php */
/* Location: ./application/models/Stock_model.php */
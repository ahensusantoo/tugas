<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

	public function get_sale($id = null){
		$this->db->select('*');
		$this->db->from('tbl_sale');
		$this->db->join('tbl_pelanggan', 'tbl_pelanggan.pelanggan_id = tbl_sale.pelanggan_id','left');
		$this->db->join('tbl_user', 'tbl_user.user_id = tbl_sale.user_id','left');
		// $this->db->join('tbl_sale_detail', 'tbl_sale_detail.detail_id = tbl_sale.detail_id','left');
		$this->db->order_by('sale_id', 'desc');
		if($id != null){
			$this->db->where('sale_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_sale_detail($id = null){
		$this->db->select('*');
		$this->db->from('tbl_detail');
		$this->db->join('tbl_pelanggan', 'tbl_pelanggan.pelanggan_id = tbl_sale.pelanggan_id');
		$this->db->join('tbl_user', 'tbl_user.user_id = tbl_sale.user_id');
		// $this->db->join('tbl_sale', 'tbl_sale.sale_id = tbl_sale_detail.sale_id');
		$this->db->order_by('sale_id', 'desc');
		if($id != null){
			$this->db->where('sale_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_item_id(){
		$this->db->select('item_id, kode_item');
		$this->db->from('tbl_item');
		$query = $this->db->get();
		return $query;
	}

	//mutasi stock
	public function get_mutasi_stock($id = null){
		$this->db->select('*');
		$this->db->from('tbl_stock');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_stock.item_id', 'left');
		$this->db->order_by('stock_id', 'desc');
		if($id != null){
			$this->db->where('stock_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function filter_stock($post){
		print_r($post);
		$this->db->select()
				->from('tbl_stock')
				->where('date >=', $post['tgl_awal'])
				->where('date <=', $post['tgl_akhir'])
				->where('item_id=',	$post['item_id']);
		$query = $this->db->get_compiled_select();
		// print_r($query);
		$data = $this->db->query($query)->result();
		// print('<pre>');print_r($data);exit();
		// $_SESSION["isi_tanggal"] = "isi";
		return $data;
		// $sql = "SELECT * FROM tbl_stock WHERE date BETWEEN  '$post[tgl_awal]' AND '$post[tgl_akhir]' AND type = 'in'";
		// return $sql;
	}

}

/* End of file Report_model.php */
/* Location: ./application/models/Report_model.php */
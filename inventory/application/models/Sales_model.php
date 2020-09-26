<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_model extends CI_Model {

	public function invoice_no(){
		$sql = "SELECT MAX(MID(invoice,9 ,4)) AS invoice_no 
				FROM tbl_sale 
				WHERE MID(invoice, 3, 6) = DATE_FORMAT(CURDATE(), '%y%m%d') ";

		$query = $this->db->query($sql);
		if($query->num_rows() > 0 ){
			$row 	= $query->row();
			$n 		= ((int)$row->invoice_no) + 1;
			$no 	= sprintf("%'.04d", $n);
		}
		else{
			$no 	= "0001" ;
		}
		$invoice 	= "TB".date('ymd').$no;
		return $invoice;
	}

	public function get_cart($params = null){
		$this->db->select('*, tbl_cart.price as price_cart');
		$this->db->from('tbl_cart');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_cart.item_id');
		// $this->db->order_by('id_cart', 'asc');
		if($params != null){
			$this->db->where($params);
		}
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$query = $this->db->get();
		return $query;
	}

	public function add_cart($post){
		$query = $this->db->query("SELECT MAX(cart_id) AS nomor_cart FROM tbl_cart");
		if ($query->num_rows() > 0 ){
			$row = $query->row();
			$cart_no = ((int)$row->nomor_cart) + 1;
		}
		else{
			$cart_no = "1";
		}

		$params = array(
			'cart_id'	=> $cart_no,
			'item_id' 	=> $post['item_id'],
			'price'		=> $post['price'],
			'qty'		=> $post['qty'],
			'total'		=> ($post['price'] * $post['qty']),
			'user_id'	=> $this->session->userdata('user_id')
		);
		$this->db->insert('tbl_cart', $params);
	}

	function update_cart_qty($post){
		$sql = "UPDATE tbl_cart SET price = '$post[price]',
				qty = qty + '$post[qty]',
				total = '$post[price]' * qty
				WHERE item_id = '$post[item_id]'";
		$this->db->query($sql);
	}

	public function delete_cart($params = null){
		if($params != null){
			$this->db->where($params);
		}
		$this->db->delete('tbl_cart');
	}

	public function update_cart($post){
		$params = array(
			'price' 		=> $post['price'],
			'qty' 			=> $post['qty'],
			'discount_item' => $post['discount'],
			'total' 		=> $post['total'],
		);
		$this->db->where('cart_id', $post['cart_id']);
		$this->db->update('tbl_cart', $params);
	}

	public function add_sale($post)
	{
		$params = array(
			'invoice' 		=> $this->invoice_no(),
			'pelanggan_id' 	=> $post['pelanggan_id'] == '' ? null : $post['pelanggan_id'],
			'total_price' 	=> $post['subtotal'],
			'discount'		=> $post['discount'],
			'final_price' 	=> $post['grand_total'],
			'cash'			=> $post['cash'],
			'remaning' 		=> $post['change'],
			'note'			=> $post['note'] == '' ? null : $post['note'],
			'date'			=> $post['date'],
			'user_id' 		=>$this->session->userdata('user_id')
		);
		$this->db->insert('tbl_sale', $params);
		return $this->db->insert_id();
	}
	function add_sale_detail($params){
		$this->db->insert_batch('tbl_sale_detail', $params);
	}

	public function m_get_stock($id)
	{
		 $this->db->select('stock')
            ->from('tbl_item')
            ->where("kode_item = ", $id);
        $query = $this->db->get_compiled_select();
        // print('<pre>');print_r($query);exit;
        $data  = $this->db->query($query)->row_array();
        return $data;
	}


}

/* End of file Sales_model.php */
/* Location: ./application/models/Sales_model.php */
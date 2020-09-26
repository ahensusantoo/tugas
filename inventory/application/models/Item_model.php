<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model {

	// start datatables
    var $column_order = array(null, 'barcode', 'tbl_item.nama_item', 'nama_kategory', 'nama_unit', 'price', 'stock'); //set column field database for datatable orderable
    var $column_search = array('barcode', 'nama_item', 'price'); //set column field database for datatable searchable
    var $order = array('item_id' => 'asc'); // default order 
 
    private function _get_datatables_query() {
        $this->db->select('*');
        $this->db->from('tbl_item');
        $this->db->join('tbl_kategory', 'tbl_item.kategory_id = tbl_kategory.kategory_id');
        $this->db->join('tbl_unit', 'tbl_item.unit_id = tbl_unit.unit_id');
        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables() {
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from('tbl_item');
        return $this->db->count_all_results();
    }
    // end datatables


	public function get($id = null){
		$this->db->select('*');
		$this->db->from('tbl_item');
		$this->db->join('tbl_kategory', 'tbl_kategory.kategory_id = tbl_item.kategory_id');
		$this->db->join('tbl_unit', 'tbl_unit.unit_id = tbl_item.unit_id');
		$this->db->order_by('kode_item', 'asc');
		if($id != null){
			$this->db->where('item_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	//proses tambah
	public function add($post){
		$params 	= [
			'kode_item'		=> $post['kode_item'],
			'barcode'		=> $post['kode_item'],
			'nama_item'		=> $post['product_name'],
			'kategory_id'	=> $post['kategory'],
			'unit_id'		=> $post['unit'],
			'price'			=> $post['price'],
			'image'			=> $post['image'],
			'deskripsi'		=> $post['deskripsi'],
			'created'		=> date('Y-m-d')
		];
		$this->db->insert('tbl_item', $params);
	}

	public function update($post){
		$params 	= [
			'kode_item'		=> $post['kode_item'],
			'barcode'		=> $post['kode_item'],
			'nama_item'		=> $post['product_name'],
			'kategory_id'	=> $post['kategory'],
			'unit_id'		=> $post['unit'],
			'price'			=> $post['price'],
			'image'			=> $post['image'],
			'deskripsi'		=> $post['deskripsi'],
			'created'		=> date('Y-m-d')
		];
		if ($post['image'] != null ){
			$params['image'] = $post['image'];
		}
		$this->db->where('item_id', $post['id']);
		$this->db->update('tbl_item', $params);
	}

	public function delete($id){
		$this->db->where('item_id', $id);
		$this->db->delete('tbl_item');
	}

	public function check_kode_item($code, $id = null){
		$this->db->from('tbl_item');
		$this->db->where('kode_item', $code);
		if($id != null){
			$this->db->where('item_id !=', $id);
		}
		$query = $this->db->get();
		return $query;
	}


	public function check_barcode($code, $id = null){
		$this->db->from('tbl_item');
		$this->db->where('barcode', $code);
		if($id != null){
			$this->db->where('item_id !=', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	function update_stock_in($post){
		$qty = $post['qty'];
		$id = $post['item_id'];

		$sql = "UPDATE tbl_item SET stock = stock + '$qty' WHERE item_id ='$id'";
		$this->db->query($sql); 
	}

	function update_stock_out($post){
		$qty = $post['qty'];
		$id = $post['item_id'];

		$sql = "UPDATE tbl_item SET stock = stock - '$qty' WHERE item_id ='$id'";
		$this->db->query($sql); 
	}	

}

/* End of file Item_model.php */
/* Location: ./application/models/Item_model.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Count_model extends CI_Model {

	public function count_item()
	{   
	    $query = $this->db->get('tbl_item');
	    if($query->num_rows()>0)
	    {
	      return $query->num_rows();
	    }
	    else
	    {
	      return 0;
	    }
	}

	public function count_customer()
	{   
	    $query = $this->db->get('tbl_customer');
	    if($query->num_rows()>0)
	    {
	      return $query->num_rows();
	    }
	    else
	    {
	      return 0;
	    }
	}

	public function count_supplier()
	{   
	    $query = $this->db->get('tbl_supplier');
	    if($query->num_rows()>0)
	    {
	      return $query->num_rows();
	    }
	    else
	    {
	      return 0;
	    }
	}

	public function count_user()
	{   
	    $query = $this->db->get('tbl_user');
	    if($query->num_rows()>0)
	    {
	      return $query->num_rows();
	    }
	    else
	    {
	      return 0;
	    }
	}

}

/* End of file Count_model.php */
/* Location: ./application/models/Count_model.php */
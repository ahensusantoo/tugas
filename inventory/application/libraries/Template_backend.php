<?php

class Template_backend{
	var $template_data = array();

	function set($name, $value){
		$this->template_data[$name] = $value;
	}

	function load($Template_backend = '', $view='', $view_data = array(), $return = FALSE){
        $this->CI =& get_instance();
        $this->set('backend', $this->CI->load->view($view, $view_data, TRUE));
        return $this->CI->load->view($Template_backend, $this->template_data, $return);
	}

}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */

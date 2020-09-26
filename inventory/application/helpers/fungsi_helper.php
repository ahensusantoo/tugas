<?php

function check_already_login(){
	$ci =& get_instance();
	$user_session = $ci->session->userdata('user_id');
	if($user_session){
		$ci->session->set_flashdata('warning', 'anda belum login');
		redirect('dashboard');
	}		
}

function check_not_login(){
	$ci =& get_instance();
	$user_session = $ci->session->userdata('user_id');
	if(!$user_session){
		// $this->CI->session->set_flashdata('warning', 'anda belum login');
		redirect('auth');
	}		
}

function check_admin(){
	$ci =& get_instance();
	$ci->load->library('user_login');
	if($ci->user_login->user_session()->level != 1 ){
		redirect('dashboard');
	}
}

function indo_currency($nominal){
	$result = "Rp " . number_format($nominal, 2, ',', '.');
	return $result;
}

function indo_date($date){
	$d = substr($date,8,2);
	$m = substr($date,5,2);
	$y = substr($date,0,4);
	return $d.'-'.$m.'-'.$y;
}
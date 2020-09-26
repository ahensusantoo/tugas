<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_login
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
        $this->ci->load->model('user_model');
	}

	public function logout()
	{
		//membuang semua session yang telah dibuat pada saat login
		$this->ci->session->unset_userdata('user_id');
		$this->ci->session->unset_userdata('level');
		//proses menderect ke halaman login setelah logout
		$this->ci->session->set_flashdata('sukses', 'anda berhasil logout');
		redirect(base_url('auth'),'refresh');
	}

	function user_session(){
		$user_id	= $this->ci->session->userdata('user_id');
		$user_data 	= $this->ci->user_model->get($user_id)->row();
		return $user_data; 
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		//check session login, ambil data helper
		check_not_login();
		check_admin();
	}

	public function index(){
		$user['row'] = $this->user_model->get();
		$this->template_backend->load('template_backend', 'user/index', $user);
	}

	public function add(){
		$valid = $this->form_validation;

		$valid->set_rules('username','Username','required|is_unique[tbl_user.username]');
		$valid->set_rules('password','Password','min_length[4]|max_length[20]');
		$valid->set_rules('passconf','Password Confirmasi','matches[password]');
		$valid->set_rules('level','Level Akses','required');
		//cara lain nampilkan pesan error form validation
		//ditampung dalam array
		/*array(	'required'		=> '%s harus diisi',
						'matches'		=> '%s  tidak sama',*/

		$valid->set_message(array(	'required'		=> '%s harus diisi',
									'is_unique'		=> '%s sudah digunakan',
									'min_length'	=> '%s minimal 4 karakter',
									'max_length'	=> '%s maksimal 15 karakter',
									'matches'		=> '%s  tidak sama'));

		$valid->set_error_delimiters('<span class="help-block">', '</span>');

		if($valid->run() == false){
			$this->template_backend->load('template_backend', 'user/tambah');	
		}
		else{
			$post = $this->input->post(null, true);
			$this->user_model->add($post);
			if($this->db->affected_rows() > 0 ){
				$this->session->set_flashdata('sukses','Data Berhasil Di Tambah');
			}
				echo "<script>window.location='".site_url('user')."'</script>";
		}
	}

	public function update($id){
		$valid = $this->form_validation;

		$valid->set_rules('username','Username','required|callback_username_check');
		//jika di isi baru memberi rules
		if($this->input->post('password')){
			$valid->set_rules('password','Password','required|min_length[4]|max_length[20]');
			$valid->set_rules('passconf','Password Confirmasi','required|matches[password]');
		}
		if($this->input->post('passconf')){
			$valid->set_rules('passconf','Password Confirmasi','required|matches[password]');
		}

		$valid->set_rules('level','Level Akses','required');
		//cara lain nampilkan pesan error form validation
		//ditampung dalam array
		/*array(	'required'		=> '%s harus diisi',
						'matches'		=> '%s  tidak sama',*/

		$valid->set_message(array(	'required'		=> '%s harus diisi',
									'min_length'	=> '%s minimal 4 karakter',
									'max_length'	=> '%s maksimal 20 karakter',
									'matches'		=> '%s  tidak sama'));

		$valid->set_error_delimiters('<span class="help-block">', '</span>');

		if($valid->run() == false){
			$query = $this->user_model->get($id);
			if($query->num_rows() > 0 ){
				$data['row'] = $query->row();
				$this->template_backend->load('template_backend', 'user/update',$data);	
			}
			else{
				echo "<script>alert('Data tidak ditemukan');";
				echo "window.location='".site_url('user')."'</script>";
			}
		}
		else{
			$post = $this->input->post(null, true);
			$this->user_model->update($post);
			if($this->db->affected_rows() > 0 ){
				$this->session->set_flashdata('sukses','Data Berhasil Di Perbarui');
			}
				echo "<script>window.location='".site_url('user')."'</script>";
		}
	}

	public function username_check(){
		$post = $this->input->post(null, true);
		$valid = $this->form_validation;
		$query = $this->db->query("SELECT * FROm tbl_user WHERE username = '$post[username]' AND user_id != '$post[user_id]'");
		if($query->num_rows() > 0 ){
			$valid->set_message('username_check','%s sudah digunakan, silahkan ganti!');
			return false;
		}
		else{
			return true;
		}
	}

	public function delete($user_id){
		$id = $this->input->post('user_id');
			$this->user_model->delete($id);
			if($this->db->affected_rows() > 0 ){
				$this->session->set_flashdata('sukses','Data Berhasil Di Hapus');
			}
				echo "<script>window.location='".site_url('user')."'</script>";
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
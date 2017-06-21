<?php

class Login extends CI_Controller{
	
	function __construct(){
		parent::__construct();
	}

	function index(){

		$this->load->view('template/header');
		$this->load->view('menulogin');
		$this->load->view('login_form');
		$this->load->view('template/footer');
	}

	function validate_credentials(){
		$this->load->model('membership_model');
		$query = $this->membership_model->validate();

		if($query){
			$username1 = $this->input->post('username');
			$r = $this->membership_model->find_for_sesion($username1);
			$t = $this->membership_model->find_unit($r->id_unit);

			$data = array(
					'username' => $this->input->post('username'),
					'is_logged_in' => true,
					'id_unit' => $r->id_unit,
					'nama_unit' => $t->name_unit,
					'id_user'=> $r->id_user,
				);

			$this->session->set_userdata($data);

			// $this->load->view('template/header');
			// $this->load->view('member_area');
			// $this->load->view('template/footer');

			redirect('site/menu_jenis_pelaporan');

			// $this->load->model('master_model');
			// $data['semuaUsulan'] = $this->master_model->cari_semua_usulan();
			// $this->load->view('lihat_usulan',$data);
		}else{
			$data['account_created'] = 'Username atau password Anda salah.<br/><br/> Silahkan coba lagi!';

			$this->load->view('template/header');
			$this->load->view('login_form', $data);
			$this->load->view('template/footer');
		}
	}

	function signup(){
		if($this->session->userdata('username') == "simrs"){
			$this->load->model('membership_model');
			$data['allUnit'] = $this->membership_model->find_all_unit();

			$this->load->view('template/header');
			$this->load->view('menu');
			$this->load->view('signup_form',$data);
			$this->load->view('template/footer');
		}else{
			echo"you shall not pass";
		}
	}

	function create_member(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[15]|callback_check_if_username_exists');
		$this->form_validation->set_rules('unit', 'Unit', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'trim|required|matches[password]');

		if($this->form_validation->run() == FALSE){
			$this->signup();
		}
		else{
			$this->load->model('membership_model');

			if($query = $this->membership_model->create_member()){
				$data['account_created'] = 'Akun sudah tersimpan.<br/><br/>Anda bisa login sekarang.';

				$this->load->view('template/header');
				$this->load->view('login_form', $data);
				$this->load->view('template/footer');
			}else{
				$this->signup();
			}

		}
	}

	function check_if_username_exists($requested_username){
		$this->load->model('membership_model');

		$username_available = $this->membership_model->check_if_username_exists($requested_username);

		if($username_available){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function daftar_users(){
		$this->load->model('membership_model');
		$data['allUser'] = $this->membership_model->find_all_users();

		$this->load->view('template/header');
		$this->load->view('allUsers',$data);
		$this->load->view('template/footer');
	}
	
	function destroy_session(){
		$array_items = array('username', 'is_logged_in', 'id_unit', 'hakAkses', 'id_user');

		$this->session->unset_userdata($array_items);
		redirect('login');
	}
        
        function test(){
            echo 'test aja';
        }
}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('User_m');
		$this->load->model('Attempts_admin_m');
	}

	public function index() {

		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        } else {
        	$data['message'] = '';
        }

		$this->load->view('login', $data);
	}

	public function processing(){
			
		$rules = $this->User_m->rules_login;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh dikosongkan');
		$this->form_validation->set_message('min_length', 'Form %s minimal 8 karakter');
		$this->form_validation->set_message('valid_email', 'Email anda tidak valid');

		if($this->form_validation->run() == TRUE){
			
			$email = $this->input->post('email');
			$pass = $this->input->post('password');

			$attemptslogin = $this->_checkbrute_admin($email);
			$countencrypt = strlen($this->User_m->hash($pass));

			if($attemptslogin == true){
				record_activity('Account Terkunci');
				$data = array(
					'title' => 'Error!',
					'style' => 'is-warning',
		            'text' => 'Maaf, untuk sementara akun Anda telah terkunci, silakan hubungi bagian Admin kami untuk melaporkan masalah ini. Terima kasih!',
		            'addClass' =>'visible'
		        );
		        $this->session->set_flashdata('message',$data);
				redirect('login');
			}

			if ($countencrypt > 128 OR $countencrypt < 128) {
				record_activity('Account Terkunci');
				$data = array(
					'title' => 'Error!',
					'style' => 'is-warning',
		            'text' => 'Maaf, untuk sementara akun Anda telah terkunci, silakan hubungi bagian Admin kami untuk melaporkan masalah ini. Terima kasih!'
		        );

		        $checks = $this->User_m->checkusers($email)->row();
		        $data_stat['statusUSER'] = 0;
		        $this->User_m->save($data_stat, $checks->idADMIN);

		        $this->session->set_flashdata('message',$data);
				redirect('login');
			}

			if ($this->User_m->login($email, $pass) == "ADMIN") {
				$checkid = $this->User_m->checkuser($email)->row();
				
				$data['lastloginADMIN'] = date("Y-m-d H:i:s");
				$this->User_m->save($data, $checkid->idADMIN);
				record_activity('Berhasil login');
				$data = array(
		            'title' => 'Welcome!',
		            'text' => 'Hallo, Selamat datang '. $this->session->userdata('Email').' !',
		            'type' => 'success',
		            'addClass' =>'visible'
		        );
		        $this->session->set_flashdata('message',$data);
				redirect('zigzagadmin/dashboard/index_dashboard');

			} elseif($this->User_m->login($email, $pass) == "NOT ACTIVE"){
				record_activity('Account telah di Non-Aktifkan setelah mencoba login');
				$data = array(
					'title' => 'Maaf!',
		            'text' => 'Akun anda telah di Non-Aktifkan',
		            'type' => 'danger',
		            'addClass' =>'visible'
		        );
		        
		        $this->session->set_flashdata('message',$data);
				redirect('login');

			}  else {
				$mailing = $this->input->post('email');

				$logindata_admin = $this->User_m->checkuser($mailing)->row();
				$data['idADMIN'] = $logindata_admin->idADMIN;
				$data['timeATTEMPTS'] = time();
				$this->Attempts_admin_m->insertdatabrute_admin($data);
				record_activity('Tidak berhasil login katasandi atau email salah');
				$data = array(
					'title' => 'Warning!',
			  		'text' => 'email atau kata sandi yang anda masukkan salah',
			  		'type' => 'danger',
			  		'addClass' =>'visible'
			    );
		 	 	$this->session->set_flashdata('message',$data);
				redirect('login');
			}
			
		} else {
			record_activity('Tidak berhasil login format email atau katasandi salah');
			$data = array(
				'title' => 'Warning!',
	            'text' => 'Silakan ulangi email anda kata sandi anda dibawah!',
	            'type' => 'danger',
	            'addClass' =>'visible'
        	);
	        $this->session->set_flashdata('message',$data);
			$this->index();
		}
	}

	public function Logout (){
		record_activity('Berhasil Keluar');
		$this->User_m->logout();
		$data = array(
			'title' => 'Success',
			'type' => 'success',
	  		'text' => 'Successfully Logout',
	  		'addClass' =>'visible'
	    );
 	 	$this->session->set_flashdata('message',$data);
		$this->index();
	}

	private function _checkbrute_admin($email) {
	    $now = time();
	    $valid_attempts = $now - (2 * 60 * 60);

	    $idlogin_admin = $this->User_m->checkuser($email)->row();

	    if(empty($idlogin_admin)){
	    	record_activity('Akun tidak terdaftar');
	    	$data = array(
	    		'title' => 'Error!',
				'style' => 'is-warning',
	            'text' => 'Maaf, akun Anda tidak terdaftar di data kami.',
	            'addClass' =>'visible'
	        );
	        $this->session->set_flashdata('message',$data);
			redirect('login');
	    }

	    $attempts = $this->Attempts_admin_m->checkingbrute_admin($idlogin_admin->idADMIN,$valid_attempts);
	    if($attempts  >= 4){
	    	return true;
	    } else {
	    	return false;
	    }
	}
}

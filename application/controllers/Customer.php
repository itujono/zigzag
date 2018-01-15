<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Frontend_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Customer_m');
		$this->load->model('City_m');
		$this->load->model('Attempts_customer_m');
	}

	public function register(){
		$rules = $this->Customer_m->rules_save_customer;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh kosong');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_message('valid_email', 'Maaf, $s Anda tidak valid');
        $this->form_validation->set_message('is_unique', 'Tampaknya inputan %s anda sudah terdaftar');
        $this->form_validation->set_message('min_length', 'Minimal kata sandi 8 karakter');
        $this->form_validation->set_message('is_numeric', 'Hanya memasukan angka saja');
        $this->form_validation->set_error_delimiters('<p class="help">', '</p>');
		if ($this->form_validation->run() == TRUE) {
			$data = $this->Customer_m->array_from_post(array('nameCUSTOMER','emailCUSTOMER','passwordCUSTOMER','addressCUSTOMER','cityCUSTOMER','zipCUSTOMER','teleCUSTOMER','skCUSTOMER'));
			if($data['skCUSTOMER'] == 'on')$data['skCUSTOMER']=1;
			else $data['skCUSTOMER'] = 0;
			
            $data['passwordCUSTOMER'] = $this->Customer_m->hash($data['passwordCUSTOMER']);

   			$data = $this->security->xss_clean($data);
			$saveid = $this->Customer_m->save($data);

			if ($saveid) {

				$email = $this->input->post('emailCUSTOMER');
                $name = ucwords($this->input->post('nameCUSTOMER'));

	                // if($this->sendemailconfirmation($name, $email, $saveid)){
						// $data = array(
						// 	'title' => 'Sukses',
						// 	'style' => 'is-success',
		    //                 'text' => 'Terima kasih sudah mendaftar. Silakan cek kotak masuk ataupun kotak spam email Anda. Terima Kasih!'
		    //             );
		    //             $this->session->set_flashdata('message',$data);
		    //             redirect('home');
                	$errors['status'] = 'success';
					$errors['redirect'] = base_url();
		            echo json_encode($errors);
					// } else {
					// 	$data = array(
		   //                  'title' => 'Error',
					// 		'style' => 'is-warning',
		   //                  'text' => 'Maaf, ada kesalahan koneksi, Silakan ulangi beberapa saat lagi.'
		   //              );
		   //              $this->session->set_flashdata('message',$data);
		   //              redirect('home');
					// }

			} else {
				$data = array(
					'title' => 'Error!',
					'style' => 'is-warning',
		            'text' => 'Maaf, sistem tidak dapat menyimpan data Anda. Silakan ulangi beberapa saat lagi.'
		        );
		       	$this->session->set_flashdata('message',$data);
		        redirect('home');
			}
		} else {
			$errors['status'] = 'error';
			$errors['message'] = validation_errors();
            echo json_encode($errors);
		}
	}

	public function load_city($id){
	  $city = $this->City_m->get_city_by_province($id)->result();
	  if(!empty($city)){
	  	  $data = "";
	      foreach ($city as $value) {
	          $data .= "<option value='".$value->idCITY."'>".$value->nameCITY."</option>";
	      }
	      echo $data;
	  } else {
	  	  $data = "<option value='' selected disabled>Maaf, Lokasi anda belum tersedia</option>";
	      echo $data;
	  }
	}

	public function confirmuser($id=NULL) {
		if (empty($id)){
			$data = array(
				'title' => 'Error!',
				'style' => 'is-warning',
	            'text' => 'Maaf, sedang terjadi kesalahan teknis. Silakan coba beberapa saat lagi.'
        	);
		} else {
			$id = decode($id);
			$checkuser = $this->Customer_m->checkusers('',$id);
			if (!empty($checkuser)) {
				$data['statusUSER'] = '1';
				if ($this->Customer_m->save($data, $id)) {

					$data = array(
						'title' => 'Sukses!',
						'style' => 'is-success',
		                'text' => 'Selamat, kami telah mengonfirmasi email Anda. Silakan login terlebih dulu untuk memulai beraktifitas di NyatKadir.org.'
	            	);
				} else{
					$data = array(
						'title' => 'Error!',
						'style' => 'is-warning',
			            'text' => 'Maaf, sedang terjadi kesalahan teknis. Silakan coba beberapa saat lagi.'
		        	);
				}

			} else {
				$data = array(
					'title' => 'Error!',
					'style' => 'is-warning',
		            'text' => 'Maaf, Anda belum terdaftar di sistem kami, silakan mendaftar terlebih dulu.'
	        	);
			}
		}
		$this->session->set_flashdata('message',$data);
        redirect('home');
	}

	private function _checkbrute_customer($email) {
	    $now = time();
	    $valid_attempts = $now - (2 * 60 * 60);

	    $idlogin_customer = $this->Customer_m->checkcustomer($email)->row();

	    if(empty($idlogin_customer)){
	    	$data = array(
	    		'title' => 'Error!',
				'style' => 'is-warning',
	            'text' => 'Maaf, akun Anda tidak terdaftar di data kami.'
	        );
	        $this->session->set_flashdata('message',$data);
			redirect('home');
	    }

	    $attempts = $this->Attempts_customer_m->checkingbrute_customer($idlogin_customer->idCUSTOMER,$valid_attempts);
	    if($attempts  >= 4){
	    	return true;
	    } else {
	    	return false;
	    }
	}

	public function process(){

		$rules = $this->Customer_m->rules_login_customer;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh kosong');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_message('valid_email', 'Maaf, $s anda tidak valid');
        $this->form_validation->set_message('min_length', 'Minimal 8 karakter');

		if($this->form_validation->run() == TRUE){

			$email = $this->input->post('emailLogin');
			$pass = $this->input->post('passwordLogin');

			$attemptslogin = $this->_checkbrute_customer($email);
			$countencrypt = strlen($this->Customer_m->hash($pass));

			if($attemptslogin == true){
				$data = array(
					'title' => 'Error!',
					'style' => 'is-warning',
		            'text' => 'Maaf, untuk sementara akun Anda telah terkunci, silakan hubungi bagian Admin kami untuk melaporkan masalah ini. Terima kasih!'
		        );
		        $this->session->set_flashdata('message',$data);
				redirect('home');
			}

			if ($countencrypt > 128 OR $countencrypt < 128) {
				$data = array(
					'title' => 'Error!',
					'style' => 'is-warning',
		            'text' => 'Maaf, untuk sementara akun Anda telah terkunci, silakan hubungi bagian Admin kami untuk melaporkan masalah ini. Terima kasih!'
		        );

		        $checks = $this->Customer_m->checkcustomer($email)->row();
		        $data_stat['statusCUSTOMER'] = 0;
		        $this->Customer_m->save($data_stat, $checks->idCUSTOMER);

		        $this->session->set_flashdata('message',$data);
				redirect('home');
			}

			if ($this->Customer_m->login($email, $pass) == "CUSTOMER"){

				$data = array(
					'title' => 'Sukses!',
					'style' => 'is-success',
		            'text' => 'Halo! Selamat datang, '. $this->session->userdata('Name')
		        );

		        $this->session->set_flashdata('message',$data);
				redirect('home');

			} else if ($this->Customer_m->login($email, $pass) == "NOT ACTIVE"){

				$data = array(
					'title' => 'Error!',
					'style' => 'is-warning',
		            'text' => 'Maaf, akun Anda belum aktif, silakan cek email Anda untuk konfirmasi, atau hubungi kami di form Contact Us. Terima kasih!'
		        	);
		        $this->session->set_flashdata('message',$data);
				redirect('home');

			} else {
				$mailing = $this->input->post('emailLogin');

				$logindata_customer = $this->Customer_m->checkcustomer($mailing)->row();
				$data['idCUSTOMER'] = $logindata_customer->idCUSTOMER;
				$data['timeATTEMPTS'] = time();
				$this->Attempts_customer_m->save($data);

				$data = array(
					'title' => 'Gagal',
					'style' => 'is-warning',
		            'text' => 'Maaf, email atau kata sandi yang Anda masukkan salah. Mohon periksa kembali terlebih dulu dengan seksama.'
		        	);
		        $this->session->set_flashdata('message',$data);
				redirect('home');
			}
		} else {
			$data = array(
			'title' => 'Error',
			'style' => 'is-warning',
            'text' => 'Maaf, silakan ulangi inputan email dan kata sandi Anda di bawah.'
        	);
        $this->session->set_flashdata('message',$data);
		redirect('home');
		}
	}

	public function logout (){
		$this->session->unset_userdata('message');
		$this->Customer_m->logout();
		$data = array(
			'title' => 'Sukses!',
			'style' => 'is-success',
            'text' => 'Anda sudah berhasil logout. Sampai jumpa lagi!'
        	);
        $this->session->set_flashdata('message',$data);
		redirect('home');
	}
}
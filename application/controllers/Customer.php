<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Frontend_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Customer_m');
		$this->load->model('City_m');
		$this->load->model('Attempts_customer_m');
		$this->load->model('Social_customer_m');
		$this->load->model('Wish_m');
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
			$data = $this->Customer_m->array_from_post(array('nameCUSTOMER','emailCUSTOMER','passwordCUSTOMER','addressCUSTOMER','provinceCUSTOMER', 'cityCUSTOMER','zipCUSTOMER','teleCUSTOMER','skCUSTOMER'));
			$data['loginwithCUSTOMER'] = 1;
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

	// public function load_city($id){
	//   $city = $this->City_m->get_city_by_province($id)->result();
	//   if(!empty($city)){
	//   	  $data = "";
	//       foreach ($city as $value) {
	//           $data .= "<option value='".$value->idCITY."'>".$value->nameCITY."</option>";
	//       }
	//       echo $data;
	//   } else {
	//   	  $data = "<option value='' selected disabled>Maaf, Lokasi anda belum tersedia</option>";
	//       echo $data;
	//   }
	// }

	public function load_city($id){
	  $city = selectall_city_by_province(NULL, $id);
	  if(!empty($city)){
	  	  $data = "";
	      foreach ($city as $val) {
        	$data .= "<option value='".$val['city_id']."'>".$val['city_name']." - ".$val['postal_code']."</option>";
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

	public function login_facebook(){
		$userData = array();
		if($this->facebook->is_authenticated()){
			$userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,picture');
			
			$fb_data['loginwithCUSTOMER'] = '2';
			$fb_data['passwordCUSTOMER'] = $this->Customer_m->hash($userProfile['id']);
			$fb_data['nameCUSTOMER'] = $userProfile['first_name'].' '.$userProfile['last_name'];
            $fb_data['emailCUSTOMER'] = $userProfile['email'];
   //          if($userProfile['gender'] == 'male'){
   //          	$gender = 1;
   //          } else {
   //          	$gender = 2;
   //          }
			// $fb_data['genderSELLER'] = $gender;
            $fb_data['picture_facebook'] = $userProfile['picture']['data']['url'];

			// Insert or update user data
            $check_user_fb = $this->Customer_m->check_user_fb($fb_data['passwordCUSTOMER'])->row();
            
            if(!empty($check_user_fb)){
            	$data = array(
	    			'Email' => $userProfile['email'],
					'idCUSTOMER' => $check_user_fb->idCUSTOMER,
					'profile_picture' => $fb_data['picture_facebook'],
					'Name' => $userProfile['first_name'].' '.$userProfile['last_name'],
					'loggedin' => TRUE
	    		);
	    		$this->session->set_userdata($data);
	    		$data = array(
					'title' => 'Sukses!',
					'style' => 'is-success',
		            'text' => 'Halo! Selamat datang, '. $this->session->userdata('Name')
		        );

		        $this->session->set_flashdata('message',$data);
				redirect('home');
            } else {
            	$saving_data_fb['loginwithCUSTOMER'] = '2';
				$saving_data_fb['passwordCUSTOMER'] = $this->Customer_m->hash($userProfile['id']);
				$saving_data_fb['nameCUSTOMER'] = $userProfile['first_name'].' '.$userProfile['last_name'];
	            $saving_data_fb['emailCUSTOMER'] = $userProfile['email'];
	            $saving_data_fb['skCUSTOMER'] = '1';
	            $saving_data_fb['statusCUSTOMER'] = '1';

	            $saveid = $this->Customer_m->save($saving_data_fb);

	            if($saveid){
	            	$data = array(
		    			'Email' => $userProfile['email'],
						'idCUSTOMER' => $saveid,
						'profile_picture' => $fb_data['picture_facebook'],
						'Name' => $userProfile['first_name'].' '.$userProfile['last_name'],
						'loggedin' => TRUE
		    		);
		    		$this->session->set_userdata($data);
		    		$data = array(
						'title' => 'Sukses!',
						'style' => 'is-success',
			            'text' => 'Halo! Selamat datang, '. $this->session->userdata('Name'),
			            'addClass' =>'visible'
			        );

			        $this->session->set_flashdata('message',$data);
					redirect('home');
	            } else {
	            	$data = array(
						'title' => 'Error!',
						'style' => 'is-warning',
			            'text' => 'Maaf, untuk sementara akun facebook anda tidak dapat kami simpan, silakan daftar lewat web. Terima kasih!',
			            'addClass' =>'visible'
			        );
			        $this->session->set_flashdata('message',$data);
					redirect('home');
	            }
            }	
		} else {
            $data = array(
				'title' => 'Error!',
				'style' => 'is-warning',
	            'text' => 'Maaf, untuk sementara akun facebook anda tidak dapat kami autentifikasi, silakan daftar lewat web. Terima kasih!',
	            'addClass' =>'visible'
	        );
	        $this->session->set_flashdata('message',$data);
			redirect('home');
        }
	    $this->load->view('login',$data);
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
		            'text' => 'Maaf, untuk sementara akun Anda telah terkunci, silakan hubungi bagian Admin kami untuk melaporkan masalah ini. Terima kasih!',
		            'addClass' => 'visible'
		        );
		        $this->session->set_flashdata('message',$data);
				redirect('home');
			}

			if ($countencrypt > 128 OR $countencrypt < 128) {
				$data = array(
					'title' => 'Error!',
					'style' => 'is-warning',
		            'text' => 'Maaf, untuk sementara akun Anda telah terkunci, silakan hubungi bagian Admin kami untuk melaporkan masalah ini. Terima kasih!',
		            'addClass' =>'visible'
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
					'text' => 'Halo! Selamat datang, '. $this->session->userdata('Name'),
					'addClass' => 'visible'
		        );

		        $this->session->set_flashdata('message',$data);
				redirect('home');

			} else if ($this->Customer_m->login($email, $pass) == "NOT ACTIVE"){

				$data = array(
					'title' => 'Error!',
					'style' => 'is-warning',
		            'text' => 'Maaf, akun Anda belum aktif, silakan cek email Anda untuk konfirmasi, atau hubungi kami di form Contact Us. Terima kasih!',
		            'addClass' =>'visible'
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
		            'text' => 'Maaf, email atau kata sandi yang Anda masukkan salah. Mohon periksa kembali terlebih dulu dengan seksama.',
		            'addClass' =>'visible'
		        	);
		        $this->session->set_flashdata('message',$data);
				redirect('home');
			}
		} else {
			$data = array(
			'title' => 'Error',
			'style' => 'is-warning',
            'text' => 'Maaf, silakan ulangi inputan email dan kata sandi Anda di bawah.',
            'addClass' =>'visible'
        	);
        $this->session->set_flashdata('message',$data);
		redirect('home');
		}
	}

	public function logout (){
		// $this->session->unset_userdata('message');
		// $this->facebook->destroy_session();
		$this->Customer_m->logout();
		$data = array(
			'title' => 'Sukses!',
			'style' => 'is-success',
			'text' => 'Anda sudah berhasil logout. Sampai jumpa lagi!',
			'addClass' => 'visible'
        	);
        $this->session->set_flashdata('message',$data);
		redirect('home');
	}

	public function move_wish_list_to_cart($id){
		$this->Wish_m->move_wish_list_to_cart($id);
	}

	public function return_barang(){
		$data['addONS'] = '';
		$data['class'] = 'retur';
		$data['title'] = 'Form Retur Barang - Zigzag Shop Batam - Official Shop';
		if(empty($this->session->userdata('idCUSTOMER'))){
			redirect('home');
		}
		$data['subview'] = $this->load->view($this->data['frontendDIR'].'return_barang', $data, TRUE);
		$this->load->view($this->data['rootDIR'].'_layout_base_frontend',$data);
	}

	public function account(){
		$data['addONS'] = 'account-customer';
		$data['class'] = 'account';
		$data['title'] = 'Akun '.$this->session->userdata('Name').' - Zigzag Shop Batam - Official Shop';

		$data['data_customer'] = $this->Customer_m->selectall_customer($this->session->userdata('idCUSTOMER'))->row();
		
		$map = directory_map('assets/upload/customer/pic-customer-'.seo_url($data['data_customer']->nameCUSTOMER.''.folenc($data['data_customer']->idCUSTOMER)), FALSE, TRUE);
		if(!empty($map)){
			$data['data_customer']->imageCUSTOMER = base_url() . 'assets/upload/customer/pic-customer-'.seo_url($data['data_customer']->nameCUSTOMER.''.folenc($data['data_customer']->idCUSTOMER)).'/'.$map[0];
		} elseif ($this->session->userdata('profile_picture') != '') {
			$data['data_customer']->imageCUSTOMER = $this->session->userdata('profile_picture');
		} else {
			$data['data_customer']->imageCUSTOMER = base_url() . 'assets/upload/user.jpg';
		}

		$data['data_customer_province_city'] = selectall_city_by_province($data['data_customer']->cityCUSTOMER, $data['data_customer']->provinceCUSTOMER);
		
		$data['data_customer_social'] = $this->Social_customer_m->selectall_social_customer($data['data_customer']->idCUSTOMER)->row();
		$data['data_customer_wish'] = $this->Wish_m->selectall_wish_by_customer($data['data_customer']->idCUSTOMER)->result();
		foreach ($data['data_customer_wish'] as $key => $value) {
			$map = directory_map('assets/upload/barang/pic-barang-'.folenc($data['data_customer_wish'][$key]->idBARANG), FALSE, TRUE);
			if(!empty($map)){
				$data['data_customer_wish'][$key]->imageWISHBARANG = base_url() . 'assets/upload/barang/pic-barang-'.folenc($data['data_customer_wish'][$key]->idBARANG).'/'.$map[0];
			} else {
				$data['data_customer_wish'][$key]->imageWISHBARANG = base_url() . 'assets/upload/no-image-available.png';
			}
		}

		if(empty($this->session->userdata('idCUSTOMER'))){
			redirect('customer/logout');
		}

		$data['subview'] = $this->load->view($this->data['frontendDIR'].'account', $data, TRUE);
		$this->load->view($this->data['rootDIR'].'_layout_base_frontend',$data);
	}

	public function save_profile_picture_customer() {
		$rules = $this->Customer_m->rules_save_profile_picture_customer;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh kosong');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_error_delimiters('<p class="help">', '</p>');

		if ($this->form_validation->run() == TRUE) {

			$data['cityCUSTOMER'] = $this->input->post('inline_city');
			
			$id = decode(urldecode($this->session->userdata('idCUSTOMER')));

			$data = $this->security->xss_clean($data);
			$idsave = $this->Customer_m->save($data, $id);

			$subject = seo_url($this->session->userdata('Name'));
			$filenamesubject = 'pic-customer-'.$subject.'-'.folenc($idsave);
			
			if(!empty($_FILES['imgCUSTOMER']['name'][0])){
				$path = 'assets/upload/customer/'.$filenamesubject;
				if (!file_exists($path)){
	            	mkdir($path, 0777, true);
	        	}
				$config['upload_path']		= $path;
	            $config['allowed_types']	= 'jpg|png|jpeg';
	            $config['file_name']        = $this->security->sanitize_filename($filenamesubject);
	            $config['overwrite'] 		= TRUE;
		        $this->upload->initialize($config);
		        if ($this->upload->do_upload('imgCUSTOMER')){
		        	$data['uploads'] = $this->upload->data();
		        	$response['status'] = 'success';
		  			$response['message'] = '';
		            echo json_encode($response);
		        } else {
		        	$response['status'] = 'notsave';
		  			$response['message'] = '';
		            echo json_encode($response);
		        }
  			}
  			
		} else {
			$response['status'] = 'error';
			$response['message'] = validation_errors();
            echo json_encode($response);
		}
	}

	public function save_email_tele_customer() {
		$rules = $this->Customer_m->rules_save_email_tele_customer;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh kosong');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_message('valid_email', 'Maaf, email Anda tidak valid');
        $this->form_validation->set_message('is_unique', 'Tampaknya inputan email anda sudah terdaftar');

        $this->form_validation->set_message('is_numeric', 'Hanya memasukan angka saja');
        $this->form_validation->set_error_delimiters('<p class="help">', '</p>');

		if ($this->form_validation->run() == TRUE) {

			$data = $this->Customer_m->array_from_post(array('emailCUSTOMER','teleCUSTOMER'));
			$id = $this->session->userdata('idCUSTOMER');

			$data = $this->security->xss_clean($data);
			$idsave = $this->Customer_m->save($data, $id);

			if($idsave){
				$response['status'] = 'success';
				$response['message'] = 'Berhasil terkirim';
				$response['dataEmail'] = $data['emailCUSTOMER'];
				$response['dataTele'] = $data['teleCUSTOMER'];
	            echo json_encode($response);
			} else {
				$response['status'] = 'notsave';
	  			$response['message'] = 'Gak berhasil ya';
	            echo json_encode($response);
			}
  			
		} else {
			$response['status'] = 'error_validation';
			$response['message'] = validation_errors();
            echo json_encode($response);
		}
	}

	public function save_address_zip_customer() {
		$rules = $this->Customer_m->rules_save_address_zip_customer;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh kosong');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_message('min_length', 'Minimal kata sandi 8 karakter');
        $this->form_validation->set_message('max_length', 'Maksimal Kode Pos 5 karakter');
        $this->form_validation->set_message('is_numeric', 'Hanya memasukan angka saja');
        $this->form_validation->set_error_delimiters('<p class="help">', '</p>');

		if ($this->form_validation->run() == TRUE) {

			$data = $this->Customer_m->array_from_post(array('addressCUSTOMER','zipCUSTOMER'));
			$id = $this->session->userdata('idCUSTOMER');

			$data = $this->security->xss_clean($data);
			$idsave = $this->Customer_m->save($data, $id);

			if($idsave){
				$response['status'] = 'success';
				$response['message'] = '';
				$response['dataAddress'] = $data['addressCUSTOMER'];
				$response['dataZip'] = $data['zipCUSTOMER'];
	            echo json_encode($response);
			} else {
				$response['status'] = 'notsave';
	  			$response['message'] = '';
	            echo json_encode($response);
			}
  			
		} else {
			$response['status'] = 'error_validation';
			$response['message'] = validation_errors();
            echo json_encode($response);
		}
	}

	public function save_social_customer() {
		$rules = $this->Social_customer_m->rules_social_customer;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh kosong');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_error_delimiters('<p class="help">', '</p>');

		if ($this->form_validation->run() == TRUE) {

			$data = $this->Social_customer_m->array_from_post(array('idCUSTOMER','facebooknameSOCIAL','instagramnameSOCIAL'));
			$data['idCUSTOMER'] = $this->session->userdata('idCUSTOMER');
			$id = $this->session->userdata('idCUSTOMER');

			$data = $this->security->xss_clean($data);
			$check_social_customer = $this->Social_customer_m->check_social_customer($id)->row();

			if(empty($check_social_customer)){
				$idsave = $this->Social_customer_m->save($data);
			} else {
				$idsave = $this->Social_customer_m->update_data_social($data, $id);
			}

			if($idsave){
				$response['status'] = 'success';
	  			$response['message'] = '';
	  			$response['dataFb'] = $data['facebooknameSOCIAL'];
				$response['dataIg'] = $data['instagramnameSOCIAL'];
	            echo json_encode($response);
			} else {
				$response['status'] = 'notsave';
	  			$response['message'] = '';
	            echo json_encode($response);
			}
  			
		} else {
			$response['status'] = 'error_validation';
			$response['message'] = validation_errors();
            echo json_encode($response);
		}
	}

	public function change_password_customer(){

		$ids = $this->session->userdata('idCUSTOMER');

		if(empty($ids)){
			$this->Customer_m->logout();
			redirect('home');
		}

		$rules = $this->Customer_m->rules_changepassword_customer;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh dikosongkan');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_message('min_length', 'Minimal 8 karakter');

	    if($this->form_validation->run() == TRUE) {

			$oldpassword = $this->Customer_m->hash($this->input->post('oldpassword'));
			$password = $this->Customer_m->hash($this->input->post('password'));
			$renewpassword = $this->Customer_m->hash($this->input->post('repassword'));

			if($password != $renewpassword){
				$response['status'] = 'error_validation_not_same';
				$response['message'] = '';
	            echo json_encode($response);
			}

			$checkoldpassword = $this->Customer_m->checkoldpassword($ids)->row();

			if($oldpassword == $checkoldpassword->passwordCUSTOMER){

				$data['passwordCUSTOMER'] = $this->Customer_m->hash($this->input->post('password'));
				$this->Customer_m->save($data, $ids);
				//if($this->sendemailnotifforgotpasswordadmin()){

					$response['status'] = 'success';
					$response['message'] = '';
		            echo json_encode($response);
				//}

			} else {
				$response['status'] = 'error';
				$response['message'] = '';
	            echo json_encode($response);
			}
		} else {
			$response['status'] = 'error_validation';
			$response['message'] = validation_errors();

			print_r($response);
			exit;

            echo json_encode($response);
		}
	}
}
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
		$this->load->model('Order_confirmation_m');
		$this->load->model('Order_m');
		$this->load->model('Return_m');
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

	public function load_city($id){
	  $city = selectall_city_by_province(NULL, $id);
	  if(!empty($city)){
	  	  $data = "";
	      foreach ($city as $val) {
        	$data .= "<option value='".$val['city_id']."'>".$val['city_name']." - ".$val['postal_code']."</option>";
	      }
	      echo $data;
	  } else {
	  	  $data = "<option value='' disabled>Maaf, Lokasi anda belum tersedia</option>";
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
	            'text' => 'Maaf, akun Anda tidak terdaftar di data kami.',
	            'addClass' =>'visible'
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
		            'text' => 'Halo! Selamat datang, '. $this->session->userdata('Name'),
		            'addClass' =>'visible'
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
		$this->facebook->destroy_session();
		$this->Customer_m->logout();
		// $response['status'] = 'success';
		// $response['redirect'] = base_url();
		// echo json_encode($response);
		redirect('home');
	}

	public function move_wish_list_to_cart($id){
		$this->Wish_m->move_wish_list_to_cart($id);
	}

	public function return_barang(){
		$data['addONS'] = 'return_barang';
		$data['class'] = 'retur';
		$data['title'] = 'Form Retur Barang - Zigzag Shop Batam - Official Shop';
		if(empty($this->session->userdata('idCUSTOMER'))){
			redirect('home');
		}

		$data['list_kodeorder_customer'] = $this->Return_m->list_kodeorder_customer($this->session->userdata('idCUSTOMER'))->result();

		if(!empty($this->session->flashdata('message_return'))) {
            $data['message_return'] = $this->session->flashdata('message_return');
        }

		$data['subview'] = $this->load->view($this->data['frontendDIR'].'return_barang', $data, TRUE);
		$this->load->view($this->data['rootDIR'].'_layout_base_frontend',$data);
	}


	public function load_product_by_kode_order($kode){
	  $get_id_order = $this->Order_confirmation_m->get_idorder_from_kodeorder($kode)->row();
	  $customer_product = $this->Return_m->get_all_product_customer_by_kodeorder($get_id_order->idORDER)->result();
	  if(!empty($customer_product)){
	  	  $data = "";
	      foreach ($customer_product as $val) {
        	$data .= "<option value='".$val->codeBARANG."'>".$val->codeBARANG." - ".$val->nameBARANG."</option>";
	      }
	      echo $data;
	  } else {
	  	  $data = "<option value='' disabled>Maaf, Produk yang anda beli belum tersedia</option>";
	      echo $data;
	  }
	}

	public function process_return_barang(){
		$rules = $this->Return_m->rules_return_barang;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh kosong');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_error_delimiters('<p class="help">', '</p>');
		if ($this->form_validation->run() == TRUE) {
			$data = $this->Return_m->array_from_post(array('kodeorderRETURN','kodebarangRETURN','reasonRETURN','setujuRETURN'));
			if($data['setujuRETURN'] == 'on')$data['setujuRETURN']=1;
			else $data['setujuRETURN'] = 0;

   			$data = $this->security->xss_clean($data);
			$saveid = $this->Return_m->save($data);
			if($saveid){
				$data = array(
					'title' => 'Berhasil,',
					'text' => 'Okay, terima kasih udah luangin waktunya, ya. <br> Kami akan segera memberi kabar begitu permintaan return barang kamu disetujui.',
					'type' => 'success'
					);
				$this->session->set_flashdata('message_return',$data);
				redirect('customer/return_barang');
			}

		} else {
			$data = array(
				'title' => 'Gagal,',
				'text' => 'Maaf, silakan ulangi pengisian form Konfirmasi anda kembali.',
				'type' => 'error'
				);
			$this->session->set_flashdata('message_return',$data);
			$this->return_barang();
		}
	}

	public function account(){
		$data['addONS'] = 'account-customer';
		$data['class'] = 'account';
		$data['title'] = 'Akun '.$this->session->userdata('Name').' - Zigzag Shop Batam - Official Shop';

		$this->load->model('Order_m');

		$data['data_customer'] = $this->Customer_m->selectall_customer($this->session->userdata('idCUSTOMER'))->row();
		$map = directory_map('assets/upload/customer/pic-customer-'.seo_url($data['data_customer']->nameCUSTOMER.'-'.folenc($data['data_customer']->idCUSTOMER)), FALSE, TRUE);
		if(!empty($map)){
			$data['data_customer']->imageCUSTOMER = base_url() . 'assets/upload/customer/pic-customer-'.seo_url($data['data_customer']->nameCUSTOMER.'-'.folenc($data['data_customer']->idCUSTOMER)).'/'.$map[0];
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

		$data['history_order'] = $this->Order_m->history_order_customer($this->session->userdata('idCUSTOMER'))->result();
		foreach ($data['history_order'] as $key => $val) {
			if($val->statusORDER == 1){
				$status='<i class="check square green icon"></i> Order diterima';
			} elseif($val->statusORDER == 2) {
				$status='<i class="check square green icon"></i> Menunggu pembayaran';
			} elseif ($val->statusORDER == 3) {
				$status='<i class="check square green icon"></i> Proses pembayaran';
			} else if ($val->statusORDER == 4){
				$status='<i class="check square green icon"></i> Pembayaran disetujui';
			} else if ($val->statusORDER == 5){
				$status='<i class="check square green icon"></i> Proses digudang';
			} elseif($val->statusORDER == 6){
				$status='<i class="check square green icon"></i> Barang terkirim';
			} elseif($val->statusORDER == 7){
				$status='<i class="check square green icon"></i> Pesanan dibatalkan';
			} else {
				$status='<span class="uk-badge uk-badge-danger">Pembayaran ditolak</span>';
			}
			$data['history_order'][$key]->status = $status;
		}

		if(empty($this->session->userdata('idCUSTOMER'))){
			redirect('customer/logout');
		}

		$data['subview'] = $this->load->view($this->data['frontendDIR'].'account', $data, TRUE);
		$this->load->view($this->data['rootDIR'].'_layout_base_frontend',$data);
	}

	public function save_profile_picture_customer() {
		
		$subject = seo_url($this->session->userdata('Name'));
		$filenamesubject = 'pic-customer-'.$subject.'-'.folenc($this->session->userdata('idCUSTOMER'));
		
		if(isset($_FILES['imgCUSTOMER']['name'])){
			//delete directory first and then uploading again
			$path_for_delete = 'assets/upload/customer/'.$filenamesubject;
			delete_files($path_for_delete);

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
	        	$response['status'] = 'notuploaded';
	  			$response['message'] = $this->upload->display_errors();
	            echo json_encode($response);
	        }
		}
	}

	public function save_data_customer() {
		$rules = $this->Customer_m->rules_save_data_customer;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh kosong');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_error_delimiters('<p class="help">', '</p>');

		if ($this->form_validation->run() == TRUE) {

			$data['nameCUSTOMER'] = $this->input->post('name_customer');
			$data['cityCUSTOMER'] = $this->input->post('inline_city');
			$data['provinceCUSTOMER'] = $this->input->post('inline_provinsi');
			
			$id = $this->session->userdata('idCUSTOMER');

			$data = $this->security->xss_clean($data);
			$idsave = $this->Customer_m->save($data, $id);

	        if ($idsave){
	        	$response['status'] = 'success';
	  			$response['message'] = 'Berhasil terkirim';
				$response['name_customer'] = $data['nameCUSTOMER'];

				$data['data_customer'] = $this->Customer_m->selectall_customer($id)->row();
				$data['data_customer_province_city'] = selectall_city_by_province($data['data_customer']->cityCUSTOMER, $data['data_customer']->provinceCUSTOMER);

				$response['inline_provinsi'] = $data['data_customer_province_city']['province'];
				$response['inline_city'] = $data['data_customer_province_city']['city_name'];
	            echo json_encode($response);
	        } else {
	        	$response['status'] = 'error_validation';
				$response['message'] = validation_errors();
	            echo json_encode($response);
	        }
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

            echo json_encode($response);
		}
	}

	public function forgot_password(){
		$data['addONS'] = '';
		$data['class'] = 'forgot';
		$data['title'] = 'Lupa Kata sandi - Zigzag Shop Batam - Official Shop';
		
		$data['subview'] = $this->load->view($this->data['frontendDIR'].'forgot_password', $data, TRUE);
		$this->load->view($this->data['rootDIR'].'_layout_base_frontend',$data);
	}

	public function process_forgot_password(){
		$email = $this->input->post('emailForgot');
		if(empty($email)){
			$data = array(
				'title' => 'Warning!',
				'style' => 'is-warning',
	            'text' => 'Maaf, Anda belum memasukkan email.'
	        	);
	        $this->session->set_flashdata('message',$data);
			redirect('customer/forgot_password');
		} else {
			$checkemail = $this->Customer_m->checkcustomer($email)->row();
			if(!empty($checkemail)){
				$emailnotifreset = $this->sendemailnotificationreset($checkemail->idCUSTOMER, $checkemail->emailCUSTOMER, $checkemail->nameCUSTOMER);
				if($emailnotifreset){
					$data = array(
	                    'title' => 'Sukses!',
						'style' => 'is-success',
			            'text' => 'Kami sudah berhasil mengirim tautan reset kata sandi lewat email. <br> Harap periksa inbox email Anda.'
	                );
	                $this->session->set_flashdata('message',$data);
	                redirect('customer/forgot_password');
				} else {
					$data = array(
						'title' => 'Warning!',
						'style' => 'is-warning',
	                    'text' => 'Maaf, kami tidak dapat mengirim email kepada Anda, silakan coba beberapa saat kembali. <br> Terima Kasih!'
	                );
	                $this->session->set_flashdata('message',$data);
	                redirect('customer/forgot_password');
				}
			} else {
				$data = array(
					'title' => 'Warning!',
					'style' => 'is-warning',
                    'text' => 'Maaf, email Anda tidak terdaftar pada sistem kami, silakan masukkan kembali alamat email Anda dengan benar. <br> Terima kasih!'
                );

                $this->session->set_flashdata('message',$data);
                redirect('customer/forgot_password');
			}
		}
	}
}	
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Frontend_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Customer_m');
		$this->load->model('City_m');
	}

	public function register(){
		$rules = $this->Customer_m->rules_save_users;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh kosong');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_message('valid_email', 'Maaf, $s Anda tidak valid');
        $this->form_validation->set_message('is_unique', 'Tampaknya inputan Anda sudah terdaftar');
        $this->form_validation->set_message('min_length', 'Minimal kata sandi 8 karakter');
        $this->form_validation->set_message('is_numeric', 'Hanya memasukan angka saja');
        $this->form_validation->set_error_delimiters('<p class="help">', '</p>');
		if ($this->form_validation->run() == TRUE) {
			$data = $this->Customer_m->array_from_post(array('nameUSER','emailUSER','passwordUSER','addressUSER','cityUSER','zipUSER','genderUSER','ageUSER','teleUSER'));
            $data['passwordUSER'] = $this->Customer_m->hash($data['passwordUSER']);

   			$data = $this->security->xss_clean($data);
			$saveid = $this->Customer_m->save($data);

			if ($saveid) {

				$email = $this->input->post('emailUSER');
                $name = ucwords($this->input->post('nameUSER'));

	                if($this->sendemailconfirmation($name, $email, $saveid)){
						$data = array(
							'title' => 'Sukses',
							'style' => 'is-success',
		                    'text' => 'Terima kasih sudah mendaftar. Silakan cek kotak masuk ataupun kotak spam email Anda. Terima Kasih!'
		                );
		                $this->session->set_flashdata('message',$data);
		                redirect('user');
					} else {
						$data = array(
		                    'title' => 'Error',
							'style' => 'is-warning',
		                    'text' => 'Maaf, ada kesalahan koneksi, Silakan ulangi beberapa saat lagi.'
		                );
		                $this->session->set_flashdata('message',$data);
		                redirect('user/index_registration');
					}

			} else {
				$data = array(
					'title' => 'Error!',
					'style' => 'is-warning',
		            'text' => 'Maaf, sistem tidak dapat menyimpan data Anda. Silakan ulangi beberapa saat lagi.'
		        );
		       	$this->session->set_flashdata('message',$data);
		        redirect('user/index_registration');
			}
		} else {
			$data = array(
				'title' => 'Error!',
				'style' => 'is-warning',
	            'text' => 'Maaf, silakan cek inputan anda kembali.'
	        );
	        $this->session->set_flashdata('message',$data);
	        $this->index_registration();
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
}
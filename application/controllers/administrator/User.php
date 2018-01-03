<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('User_m');
		$this->load->model('Menu_join_admin_m');
	}

	public function index_user_admin($id=NULL) {
		$data['addONS'] = 'plugins_create_menu_admin_and_user';
		$id = decode(urldecode($id));

		$data['listuseradmin'] = $this->User_m->selectall_user_admin()->result();

		if($id == NULL){
	        $data['tab'] = array(
	            'data-tab' => 'uk-active',
	            'form-tab' => '',
	        );
			$data['getuser'] = $this->User_m->get_new();
		} else {
			
			//conf tab (optional)
	        $data['tab'] = array(
	            'data-tab' => '',
	            'form-tab' => 'uk-active',
	        );
			$data['getuser'] = $this->User_m->selectall_user_admin($id)->row();
		}

		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }

		$data['subview'] = $this->load->view($this->data['backendDIR'].'user', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function saveuser() {
		$rules = $this->User_m->rules_save_user;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh dikosongkan');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_message('valid_email', 'Email anda tidak valid');
        $this->form_validation->set_message('is_unique', 'Maaf email sudah dipakai, silakan masukkan  yang lain.');

		if ($this->form_validation->run() == TRUE) {
			$data = $this->User_m->array_from_post(array('emailADMIN','statusADMIN'));
			if($data['emailADMIN'] === $this->input->post('oldEMAIL')){
				$rules['emailADMIN']['rules']='trim|required|valid_email';
			} else {
				$rules['emailADMIN']['rules']='trim|required|valid_email|is_unique[nyat_users_admin.emailADMIN]';
			}
			if(empty($this->input->post('oldEMAIL'))) {
				$data['passwordADMIN'] = $this->User_m->hash($this->input->post('passwordADMIN'));
				$rules['passwordADMIN']['rules']='trim|required|min_length[8]';
			}
			$data['statusADMIN'] = 1;
			
			$id = decode(urldecode($this->input->post('idADMIN')));
			if(empty($id))$id=NULL;
			
			$data = $this->security->xss_clean($data);
			$idsave = $this->User_m->save($data, $id);

			foreach ($this->input->post('idMENU') as $value) {

				$datas['idADMIN'] = $idsave;
				$datas['idMENU'] = $value;
				$checkinginput = $this->Menu_join_admin_m->checking_input($datas['idADMIN'],$datas['idMENU'])->row();
				if(!empty($checkinginput)){
					//nothing to do
				} else {
					$this->Menu_join_admin_m->save($datas);
				}
				
			}
			$data = array(
            	'title' => 'Sukses',
                'text' => 'Penyimpanan Data berhasil dilakukan',
                'type' => 'success'
          	);
	    	$this->session->set_flashdata('message', $data);
	  		redirect('administrator/user/index_user_admin');
	  		
		} else {
				$data = array(
		            'title' => 'Terjadi Kesalahan',
		            'text' => 'mohon ulangi inputan form anda.',
		            'type' => 'warning'
		        );
	        $this->session->set_flashdata('message',$data);
	        $this->index_user_admin();
		}
	}

	public function actiondelete_user($id=NULL){
		$id = decode(urldecode($id));
		if($id != 0){
			$this->User_m->delete($id);
			$data = array(
                    'title' => 'Sukses',
                    'text' => 'Penghapusan Data berhasil dilakukan',
                    'type' => 'success'
                );
                $this->session->set_flashdata('message',$data);
                redirect('administrator/user/index_user_admin');
		}else{
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'Maaf, data tidak berhasil dihapus silakan coba beberapa saat kembali',
	            'type' => 'error'
		        );
		        $this->session->set_flashdata('message',$data);
		        $this->index_user_admin();
		}
	}

	public function delete_join_menu_user_admin($id=NULL){
		$id = decode(urldecode($id));
		if($id != 0){
			$this->Menu_join_admin_m->delete($id);
			$data = array(
                    'title' => 'Sukses',
                    'text' => 'Penghapusan Data berhasil dilakukan',
                    'type' => 'success'
                );
                $this->session->set_flashdata('message',$data);
                redirect('administrator/user/index_user_admin');
		}else{
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'Maaf, data tidak berhasil dihapus silakan coba beberapa saat kembali',
	            'type' => 'error'
		        );
		        $this->session->set_flashdata('message',$data);
		        $this->index_user_admin();
		}
	}
}

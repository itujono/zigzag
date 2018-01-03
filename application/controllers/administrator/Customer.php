<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Admin_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Customer_m');
	}

	public function index_customer() {
		$data['addONS'] = 'plugins_user';
        $data['listusers'] = $this->Customer_m->selectall_customer()->result();
        foreach ($data['listusers'] as $key => $value) {
			$map = directory_map('assets/upload/users/pic-users-'.folenc($data['listusers'][$key]->idUSER), FALSE, TRUE);
			if(!empty($map)){
				$data['listusers'][$key]->imageUSERS = base_url() . 'assets/upload/users/pic-users-'.folenc($data['listusers'][$key]->idUSER).'/'.$map[0];
			} else {
				$data['listusers'][$key]->imageUSERS = base_url() . 'assets/upload/no-image-available.png';
			}
		}
		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }

		$data['subview'] = $this->load->view($this->data['backendDIR'].'general_customer', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function actiondelete_customer($id=NULL){
		$id = decode(urldecode($id));
		if($id != 0){
			$this->Customer_m->delete($id);
			$data = array(
                    'title' => 'Sukses',
                    'text' => 'Penghapusan Data berhasil dilakukan',
                    'type' => 'success'
                );
                $this->session->set_flashdata('message',$data);
                redirect('administrator/users/index_customer');
		}else{
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'Maaf, data tidak berhasil dihapus silakan coba beberapa saat kembali',
	            'type' => 'error'
		        );
		        $this->session->set_flashdata('message',$data);
		        $this->index_customer();
		}
	}
}

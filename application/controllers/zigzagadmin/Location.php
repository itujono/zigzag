<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location extends Admin_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Province_m');
		$this->load->model('City_m');
	}

	public function index_province($id = NULL){
		$data['addONS'] = 'plugins_datatables';
		$id = decode(urldecode($id));
		
		$data['listprovince'] = $this->Province_m->selectall_province()->result();
		
		if($id == NULL){
	        $data['tab'] = array(
	            'data-tab' => 'uk-active',
	            'form-tab' => '',
	        );
			$data['getprovince'] = $this->Province_m->get_new();
		} else {
			
			//conf tab (optional)
	        $data['tab'] = array(
	            'data-tab' => '',
	            'form-tab' => 'uk-active',
	        );
			$data['getprovince'] = $this->Province_m->selectall_province($id)->row();
		}

		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }
        record_activity('Mengunjungi halaman Province');
		$data['subview'] = $this->load->view($this->data['backendDIR'].'province', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function saveprovince() {
		$rules = $this->Province_m->rules_province;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh dikosongkan');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_message('is_unique', 'Tampaknya inputan Anda sudah terdaftar');
        $this->form_validation->set_error_delimiters('<p class="text-red">','</p>');

		if ($this->form_validation->run() == TRUE) {
			$data = $this->Province_m->array_from_post(array('namePROVINCE'));
			$id = decode(urldecode($this->input->post('idPROVINCE')));

			if(empty($id))$id=NULL;
			$data = $this->security->xss_clean($data);
			$this->Province_m->save($data, $id);
	    	record_activity('Penyimpanan data province berhasil');
	  		$data = array(
	        	'title' => 'Sukses',
	            'text' => 'Penyimpanan Data berhasil dilakukan',
	            'type' => 'success'
      		);
      		$this->session->set_flashdata('message', $data);
  			redirect('zigzagadmin/location/index_province');

		} else {
			record_activity('Penyimpanan data province tidak berhasil format salah');
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'mohon ulangi inputan form anda dibawah.',
	            'type' => 'warning'
	        );
	        $this->session->set_flashdata('message',$data);
	        $this->index_province();
		}
	}

	public function actiondelete_province($id=NULL){
		$id = decode(urldecode($id));
		if($id != 0){
			$this->Province_m->delete($id);
			record_activity('Penghapusan data province berhasil');
			$data = array(
                    'title' => 'Sukses',
                    'text' => 'Penghapusan Data berhasil dilakukan',
                    'type' => 'success'
                );
                $this->session->set_flashdata('message',$data);
                redirect('zigzagadmin/location/index_province');
		}else{
			record_activity('Penghapusan data province tidak berhasil');
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'Maaf, data tidak berhasil dihapus silakan coba beberapa saat kembali',
	            'type' => 'error'
		        );
		        $this->session->set_flashdata('message',$data);
		        redirect('zigzagadmin/location/index_province');
		}
	}

	public function index_city($id = NULL){
		$data['addONS'] = 'plugins_datatables';
		$id = decode(urldecode($id));
		
		$data['listcity'] = $this->City_m->selectall_city()->result();
		
		if($id == NULL){
	        $data['tab'] = array(
	            'data-tab' => 'uk-active',
	            'form-tab' => '',
	        );
			$data['getcity'] = $this->City_m->get_new();
		} else {
			
			//conf tab (optional)
	        $data['tab'] = array(
	            'data-tab' => '',
	            'form-tab' => 'uk-active',
	        );
			$data['getcity'] = $this->City_m->selectall_city($id)->row();
		}

		$data['dropdown_province'] = $this->Province_m->select_province_drop();

		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }
        
        record_activity('Mengunjungi halaman City');
		$data['subview'] = $this->load->view($this->data['backendDIR'].'city', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function savecity() {
		$rules = $this->City_m->rules_city;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh dikosongkan');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_message('is_unique', 'Tampaknya inputan Anda sudah terdaftar');
        $this->form_validation->set_error_delimiters('<p class="text-red">','</p>');

		if ($this->form_validation->run() == TRUE) {
			$data = $this->City_m->array_from_post(array('nameCITY','idPROVINCE'));
			$id = decode(urldecode($this->input->post('idCITY')));

			if(empty($id))$id=NULL;
			$data = $this->security->xss_clean($data);
			$this->City_m->save($data, $id);
	    	record_activity('Penyimpanan data kota berhasil');
	  		$data = array(
	        	'title' => 'Sukses',
	            'text' => 'Penyimpanan Data berhasil dilakukan',
	            'type' => 'success'
      		);
      		$this->session->set_flashdata('message', $data);
  			redirect('zigzagadmin/location/index_city');

		} else {
			record_activity('Penyimpanan data kota tidak berhasil format salah');
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'mohon ulangi inputan form anda dibawah.',
	            'type' => 'warning'
	        );
	        $this->session->set_flashdata('message',$data);
	        $this->index_city();
		}
	}

	public function actiondelete_city($id=NULL){
		$id = decode(urldecode($id));
		if($id != 0){
			$this->City_m->delete($id);
			record_activity('Penghapusan data kota berhasil');
			$data = array(
                    'title' => 'Sukses',
                    'text' => 'Penghapusan Data berhasil dilakukan',
                    'type' => 'success'
                );
                $this->session->set_flashdata('message',$data);
                redirect('zigzagadmin/location/index_city');
		}else{
			record_activity('Penghapusan data kota tidak berhasil');
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'Maaf, data tidak berhasil dihapus silakan coba beberapa saat kembali',
	            'type' => 'error'
		        );
		        $this->session->set_flashdata('message',$data);
		        redirect('zigzagadmin/location/index_city');
		}
	}
}
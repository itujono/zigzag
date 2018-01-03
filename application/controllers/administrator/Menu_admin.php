<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_admin extends Admin_Controller{

	public function __construct (){
		parent::__construct();
		$this->load->model('Menu_m');
	}

	public function index_menu($id = NULL){
		$data['addONS'] = 'plugins_create_menu_admin_and_user';
		$id = decode(urldecode($id));
		
		$data['listmenu'] = $this->Menu_m->selectall_menu()->result();
		
		if($id == NULL){
	        $data['tab'] = array(
	            'data-tab' => 'uk-active',
	            'form-tab' => '',
	        );
			$data['getmenu'] = $this->Menu_m->get_new();
		} else {
			
			//conf tab (optional)
	        $data['tab'] = array(
	            'data-tab' => '',
	            'form-tab' => 'uk-active',
	        );
			$data['getmenu'] = $this->Menu_m->selectall_menu($id)->row();
		}

		$data['dropdown_menu'] = $this->Menu_m->select_parents_drop();
		
		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }

		$data['subview'] = $this->load->view($this->data['backendDIR'].'menu_admin', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function savemenu() {
		$rules = $this->Menu_m->rules_menu;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh dikosongkan');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        
		if ($this->form_validation->run() == TRUE) {
			$data = $this->Menu_m->array_from_post(array('namaMENU','iconMENU','functionMENU','parentMENU','statusMENU'));
			$data['statusMENU'] == 'on';
			if($data['statusMENU'] == 'on')$data['statusMENU']=1;else $data['statusMENU']=0;
			$id = decode(urldecode($this->input->post('idMENU')));
			if(empty($id))$id=NULL;
			
			$data = $this->security->xss_clean($data);
			$idsave = $this->Menu_m->save($data, $id);
			
	  		$data = array(
            	'title' => 'Sukses',
                'text' => 'Penyimpanan Data berhasil dilakukan',
                'type' => 'success'
          	);
	    	$this->session->set_flashdata('message', $data);
	  		redirect('administrator/menu_admin/index_menu');
		} else {
				$data = array(
		            'title' => 'Terjadi Kesalahan',
		            'text' => 'mohon ulangi inputan form anda dibawah.',
		            'type' => 'warning'
		        );
	        $this->session->set_flashdata('message',$data);
	        $this->index_menu();
		}
	}

	public function delete_menu_admin($id=NULL){
		$id = decode(urldecode($id));
		if($id != 0){
			$this->Menu_m->delete($id);
			$data = array(
                    'title' => 'Sukses',
                    'text' => 'Penghapusan Data berhasil dilakukan',
                    'type' => 'success'
                );
                $this->session->set_flashdata('message',$data);
                redirect('administrator/menu_admin/index_menu');
		}else{
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'Maaf, data tidak berhasil dihapus silakan coba beberapa saat kembali',
	            'type' => 'error'
		        );
		        $this->session->set_flashdata('message',$data);
		        $this->index_menu();
		}
	}
}
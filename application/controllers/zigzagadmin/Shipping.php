<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shipping extends Admin_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Shipping_m');
	}

	public function index_shipping($id = NULL){
		$data['addONS'] = 'plugins_datatables';
		$id = decode(urldecode($id));
		
		$data['listshipping'] = $this->Shipping_m->selectall_shipping()->result();
		foreach ($data['listshipping'] as $key => $value) {
			$map = directory_map('assets/upload/shipping/pic-shipping-'.folenc($data['listshipping'][$key]->idSHIPPING), FALSE, TRUE);
			if(!empty($map)){
				$data['listshipping'][$key]->imageSHIPPING = base_url() . 'assets/upload/shipping/pic-shipping-'.folenc($data['listshipping'][$key]->idSHIPPING).'/'.$map[0];
			} else {
				$data['listshipping'][$key]->imageSHIPPING = base_url() . 'assets/upload/no-image-available.png';
			}

			if($value->statusSHIPPING == 1){
				$status='<a href="#" data-uk-tooltip title="Aktif"><i class="material-icons md-36 uk-text-success">&#xE86C;</i></a>';
			} else {
				$status='<a href="#" data-uk-tooltip title="Tak Aktif"><i class="material-icons  md-36 uk-text-danger">&#xE5C9;</i></a>';
			}
			$data['listshipping'][$key]->status = $status;
		}
		if($id == NULL){
	        $data['tab'] = array(
	            'data-tab' => 'uk-active',
	            'form-tab' => '',
	        );
			$data['getshipping'] = $this->Shipping_m->get_new();
		} else {
			
			//conf tab (optional)
	        $data['tab'] = array(
	            'data-tab' => '',
	            'form-tab' => 'uk-active',
	        );
			$data['getshipping'] = $this->Shipping_m->selectall_shipping($id)->row();
			$map = directory_map('assets/upload/shipping/pic-shipping-'.folenc($data['getshipping']->idSHIPPING), FALSE, TRUE);
			if(!empty($map)){
				$data['getshipping']->imageSHIPPING = base_url() . 'assets/upload/shipping/pic-shipping-'.folenc($data['getshipping']->idSHIPPING).'/'.$map[0];
			} else {
				$data['getshipping']->imageSHIPPING = '';
			}
		}

		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }
        record_activity('Mengunjungi halaman Shipping');
		$data['subview'] = $this->load->view($this->data['backendDIR'].'shipping', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function saveshipping() {
		$id = decode(urldecode($this->input->post('idSHIPPING')));
		if(empty($id)) {
			$rules = $this->Shipping_m->rules_shipping;
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_message('required', 'Form %s tidak boleh dikosongkan');
	        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
	        $this->form_validation->set_message('is_unique', 'Tampaknya inputan Anda sudah terdaftar');
        } else {
			$this->form_validation->set_rules('nameSHIPPING', 'Nama Shipping', 'trim|required');
			$this->form_validation->set_message('required', 'Form %s tidak boleh dikosongkan');
    		$this->form_validation->set_message('trim', 'Form %s adalah Trim');
		}
        $this->form_validation->set_error_delimiters('<p class="text-red">','</p>');

		if ($this->form_validation->run() == TRUE) {
			$data = $this->Shipping_m->array_from_post(array('nameSHIPPING','statusSHIPPING'));
			if($data['statusSHIPPING'] == 'on')$data['statusSHIPPING']=1;
			else $data['statusSHIPPING']=0;
			
			if(empty($id))$id=NULL;
			$data = $this->security->xss_clean($data);
			$idsave = $this->Shipping_m->save($data, $id);

			$subject = $idsave;
			$filenamesubject = 'pic-shipping-'.folenc($subject);
			if(!empty($_FILES['imgSHIPPING']['name'][0])) {
				$path = 'assets/upload/shipping/'.$filenamesubject;
				if (!file_exists($path)){
	            	mkdir($path, 0777, true);
	        	}

				$config['upload_path']		= $path;
	            $config['allowed_types']	= 'jpg|png|jpeg';
	            $config['file_name']        = $this->security->sanitize_filename($filenamesubject);

		        $this->upload->initialize($config);

		        if ($this->upload->do_upload('imgSHIPPING')){
		        	$data['uploads'] = $this->upload->data();
		        }
		    }

	    	record_activity('Penyimpanan data shipping berhasil');
	  		$data = array(
	        	'title' => 'Sukses',
	            'text' => 'Penyimpanan Data berhasil dilakukan',
	            'type' => 'success'
      		);
      		$this->session->set_flashdata('message', $data);
  			redirect('zigzagadmin/shipping/index_shipping');

		} else {
			record_activity('Penyimpanan data shipping tidak berhasil format salah');
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'mohon ulangi inputan form anda dibawah.',
	            'type' => 'warning'
	        );
	        $this->session->set_flashdata('message',$data);
	        $this->index_shipping();
		}
	}

	public function actionedit($id=NULL , $id2=NULL){
		$id = decode(urldecode($id));
		$ss = 0;
		if($id2 != NULL)$ss = 1;
		if($id != 0){
			$data['statusSHIPPING'] = $ss;
			$this->Shipping_m->save($data, $id);
			record_activity('Perubahan data status shipping berhasil');
			$data = array(
                    'title' => 'Sukses',
                    'text' => 'Perubahan Data berhasil dilakukan',
                    'type' => 'success'
                );
                $this->session->set_flashdata('message',$data);
                redirect('zigzagadmin/shipping/index_shipping');
		}else{
			record_activity('Perubahan data status shipping tidak berhasil');
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'Maaf, Sesuatu yang memalukan terjadi',
	            'type' => 'error'
		        );
		        $this->session->set_flashdata('message',$data);
		        redirect('zigzagadmin/shipping/index_shipping');
		}
	}

	public function deleteimgshipping($id1=NULL){
		if($id1 != NULL){
			$id = decode(urldecode($id1));
			$map = directory_map('assets/upload/shipping/pic-shipping-'.folenc($id), FALSE, TRUE);
			$path = 'assets/upload/shipping/pic-shipping-'.folenc($id);
			foreach ($map as $value) {
				unlink('assets/upload/shipping/pic-shipping-'.folenc($id).'/'.$value);
			}
			if(is_dir($path)){
				rmdir($path);
			}
		}
		record_activity('Penghapusan data gambar shipping berhasil');
		$data = array(
            'title' => 'Sukses',
            'text' => 'Penghapusan Gambar berhasil dilakukan',
            'type' => 'success'
        );
        $this->session->set_flashdata('message',$data);
		redirect('zigzagadmin/shipping/index_shipping/'.$id1);
	}
}

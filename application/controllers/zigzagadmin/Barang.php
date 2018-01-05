<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang extends Admin_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Category_barang_m');
	}

	public function index_category_barang($id = NULL){
		$data['addONS'] = 'plugins_datatables';
		$id = decode(urldecode($id));
		
		$data['listcategorybarang'] = $this->Category_barang_m->selectall_category_barang()->result();
		
		if($id == NULL){
	        $data['tab'] = array(
	            'data-tab' => 'uk-active',
	            'form-tab' => '',
	        );
			$data['getcategory'] = $this->Category_barang_m->get_new();
		} else {
			//conf tab (optional)
	        $data['tab'] = array(
	            'data-tab' => '',
	            'form-tab' => 'uk-active',
	        );
			$data['getcategory'] = $this->Category_barang_m->selectall_category_barang($id)->row();
		}

		$data['dropdown_category_barang'] = $this->Category_barang_m->select_category_barang_drop();
		// print_r($data['dropdown_category_barang']);
		// exit;
		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }
        record_activity('Mengunjungi halaman Category barang');
		$data['subview'] = $this->load->view($this->data['backendDIR'].'category_barang', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function savecategorybarang() {
		$rules = $this->Category_barang_m->rules_category;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh dikosongkan');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        if(empty(decode(urldecode($this->input->post('idCATEGORY'))))) {
        	$this->form_validation->set_message('is_unique', 'Tampaknya inputan Anda sudah terdaftar');   	
        }
        $this->form_validation->set_error_delimiters('<p class="text-red">','</p>');

		if ($this->form_validation->run() == TRUE) {
			$data = $this->Category_barang_m->array_from_post(array('nameCATEGORY','parentCATEGORY'));
			$id = decode(urldecode($this->input->post('idCATEGORY')));

			if(empty($id))$id=NULL;
			$data = $this->security->xss_clean($data);
			$this->Category_barang_m->save($data, $id);

	    	record_activity('Penyimpanan data kategori barang berhasil');
	  		$data = array(
	        	'title' => 'Sukses',
	            'text' => 'Penyimpanan Data berhasil dilakukan',
	            'type' => 'success'
      		);
      		$this->session->set_flashdata('message', $data);
  			redirect('zigzagadmin/barang/index_category_barang');

		} else {
			record_activity('Penyimpanan data kategori barang tidak berhasil format salah');
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'mohon ulangi inputan form anda dibawah.',
	            'type' => 'warning'
	        );
	        $this->session->set_flashdata('message',$data);
	        $this->index_category_barang();
		}
	}

	public function actiondelete_category_barang($id=NULL){
		$id = decode(urldecode($id));
		$checking_parent = $this->Category_barang_m->check_parent_category_barang($id)->row();
		if(!empty($checking_parent)){
			record_activity('Penghapusan data kategori barang tidak berhasil data kategori masih terkait dengan data kategori yang lain');
			$data = array(
                'title' => 'Terjadi Kesalahan',
                'text' => 'Silakan hapus data kategori '.$checking_parent->nameCATEGORY.' terlebih dahulu',
                'type' => 'warning'
            );
            $this->session->set_flashdata('message',$data);
            redirect('zigzagadmin/barang/index_category_barang');
		}
		if($id != 0){
			$this->Category_barang_m->delete($id);
			record_activity('Penghapusan data kategori barang berhasil');
			$data = array(
                    'title' => 'Sukses',
                    'text' => 'Penghapusan Data berhasil dilakukan',
                    'type' => 'success'
                );
                $this->session->set_flashdata('message',$data);
                redirect('zigzagadmin/barang/index_category_barang');
		}else{
			record_activity('Penghapusan data kategori barang tidak berhasil');
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'Maaf, data tidak berhasil dihapus silakan coba beberapa saat kembali',
	            'type' => 'error'
		        );
		        $this->session->set_flashdata('message',$data);
		        redirect('zigzagadmin/barang/index_category_barang');
		}
	}
}
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang extends Admin_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Category_barang_m');
		$this->load->model('Barang_m');
	}

	public function index_barang($id = NULL){
		$data['addONS'] = '';
		$id = decode(urldecode($id));
		
		$data['listbarang'] = $this->Barang_m->selectall_barang()->result();
		
		foreach ($data['listbarang'] as $key => $value) {
			$map = directory_map('assets/upload/barang/pic-barang-'.folenc($data['listbarang'][$key]->idBARANG), FALSE, TRUE);
			if(!empty($map)){
				$data['listbarang'][$key]->imageBARANG = base_url() . 'assets/upload/barang/pic-barang-'.folenc($data['listbarang'][$key]->idBARANG).'/'.$map[0];
			} else {
				$data['listbarang'][$key]->imageBARANG = base_url() . 'assets/upload/no-image-available.png';
			}

		}

		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }

        record_activity('Mengunjungi halaman Barang/Product');
		$data['subview'] = $this->load->view($this->data['backendDIR'].'barang', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function add_barang($id=NULL){
		$data['addONS'] = 'plugins_datatables';
		$id = decode(urldecode($id));
		if($id == NULL){
			$data['getbarang'] = $this->Barang_m->get_new();
		} else {
			$data['getbarang'] = $this->Barang_m->selectall_barang($id)->row();
			$map = directory_map('assets/upload/barang/pic-barang-'.folenc($data['getbarang']->idBARANG), FALSE, TRUE);
			$maps = array();
			$imgs = array();
			if(!empty($map)){
				foreach ($map  as $key => $value) {
					$maps[] = base_url().'assets/upload/barang/pic-barang-'.folenc($data['getbarang']->idBARANG).'/'.$value;
					$imgs[] = $value;
				}
			}
			$data['getbarang']->map = $maps;
			$data['getbarang']->imgs = $imgs;
		}

		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }

        $data['getcategory'] = $this->Category_barang_m->select_category_barang_drop(1);

        record_activity('Mengunjungi halaman Tambah Barang/Product');

		$data['subview'] = $this->load->view($this->data['backendDIR'].'add_barang', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function detail_barang($id){
		$data['addONS'] = 'plugins_datatables';
		$id = decode(urldecode($id));

		$data['getbarang'] = $this->Barang_m->selectall_barang($id)->row();
		$map = directory_map('assets/upload/barang/pic-barang-'.folenc($data['getbarang']->idBARANG), FALSE, TRUE);
		$maps = array();
		$imgs = array();
		if(!empty($map)){
			foreach ($map  as $key => $value) {
				$maps[] = base_url().'assets/upload/barang/pic-barang-'.folenc($data['getbarang']->idBARANG).'/'.$value;
				$imgs[] = $value;
			}
		}
		$data['getbarang']->map = $maps;
		$data['getbarang']->imgs = $imgs;
		
		record_activity('Mengunjungi halaman Detail Barang/Product ("'.$data['getbarang']->nameBARANG.'")');
		$data['subview'] = $this->load->view($this->data['backendDIR'].'detail_barang', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function savebarang() {
		$rules = $this->Barang_m->rules_barang;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh dikosongkan');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_message('numeric', 'Silakan masukan hanya berupa angka');
        
		if ($this->form_validation->run() == TRUE) {
			$data = $this->Barang_m->array_from_post(array('idCATEGORY','nameBARANG','priceBARANG','descBARANG','materialBARANG','dimensionBARANG','weightBARANG','stockBARANG','codeBARANG','colorBARANG','hotBARANG','slugBARANG'));
			$data['slugBARANG'] = slugify($data['nameBARANG']);
			if($data['hotBARANG'] == 'on')$data['hotBARANG']=1;
			else $data['hotBARANG']=0;

			$id = decode(urldecode($this->input->post('idBARANG')));
			if(empty($id))$id=NULL;
			
			$data = $this->security->xss_clean($data);
			$data['descBARANG'] = $this->input->post('descBARANG');
			$idsave = $this->Barang_m->save($data, $id);

			$subject = $idsave;
			$filenamesubject = 'pic-barang-'.folenc($subject);

			if(!empty($_FILES['imgBARANG']['name'][0])){
				$number_of_files = sizeof($_FILES['imgBARANG']['tmp_name']);
				$files = $_FILES['imgBARANG'];
				$path = 'assets/upload/barang/'.$filenamesubject;
				if (!file_exists($path)){
	            	mkdir($path, 0777, true);
	        	}

				$config['upload_path']		= $path;
	            $config['allowed_types']	= 'jpg|png|jpeg';
	            $config['file_name']        = $this->security->sanitize_filename($filenamesubject);

	            for ($i = 0; $i < $number_of_files; $i++) {
			        $_FILES['imgBARANG']['name'] = $files['name'][$i];
			        $_FILES['imgBARANG']['type'] = $files['type'][$i];
			        $_FILES['imgBARANG']['tmp_name'] = $files['tmp_name'][$i];
			        $_FILES['imgBARANG']['error'] = $files['error'][$i];
			        $_FILES['imgBARANG']['size'] = $files['size'][$i];
			        //now we initialize the upload library
			        $this->upload->initialize($config);
			        // we retrieve the number of files that were uploaded
			        if ($this->upload->do_upload('imgBARANG')){
			          $data['uploads'][$i] = $this->upload->data();
			        }else{
			          $data['upload_errors'][$i] = $this->upload->display_errors();
			        }
			    }
	    	}
	    	record_activity('Penyimpanan data barang/produk berhasil');
	  		$data = array(
            	'title' => 'Sukses',
                'text' => 'Penyimpanan Data berhasil dilakukan',
                'type' => 'success'
          	);
	    	$this->session->set_flashdata('message', $data);
	  		redirect('zigzagadmin/barang/index_barang');

		} else {
			record_activity('Penyimpanan data barang/produk tidak berhasil format salah');
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'mohon ulangi inputan form anda dibawah.',
	            'type' => 'warning'
	        );
	        $this->session->set_flashdata('message',$data);
	        $this->add_barang();
		}
	}

	public function actiondelete_barang($id=NULL){
		$id = decode(urldecode($id));
		if($id != 0){
			$this->Barang_m->delete($id);
			record_activity('Penghapusan barang/produk berhasil');
			$data = array(
                    'title' => 'Sukses',
                    'text' => 'Penghapusan Data berhasil dilakukan',
                    'type' => 'success'
                );
                $this->session->set_flashdata('message',$data);
                redirect('zigzagadmin/barang/index_barang');
		}else{
			record_activity('Penghapusan barang/produk tidak berhasil');
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'Maaf, data tidak berhasil dihapus silakan coba beberapa saat kembali',
	            'type' => 'error'
		        );
		        $this->session->set_flashdata('message',$data);
		        redirect('zigzagadmin/barang/index_barang');
		}
	}

	public function deleteimgbarang($id1=NULL, $id2=NULL){
		if($id1 != NULL){
			$id = decode(urldecode($id1));
			unlink('assets/upload/barang/pic-barang-'.folenc($id).'/'.$id2);
		}
		record_activity('Penghapusan gambar barang/produk berhasil');
		$data = array(
            'title' => 'Sukses',
            'text' => 'Penghapusan Gambar berhasil dilakukan',
            'type' => 'success'
        );
        $this->session->set_flashdata('message',$data);
		redirect('zigzagadmin/barang/add_barang/'.$id1);
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
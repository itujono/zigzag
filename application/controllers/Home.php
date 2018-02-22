<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Frontend_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Slider_m');
		$this->load->model('Barang_m');
	}

	public function index() {
		
		$data['addONS'] = 'home';
		$data['title'] = 'Zigzag Shop Batam - Official Shop';
		$data['class'] = 'app';
		$data['listslider'] = $this->Slider_m->selectall_slider(NULL,1)->result();
		foreach ($data['listslider'] as $key => $value) {
			$map = directory_map('assets/upload/slider/pic-slider-'.folenc($data['listslider'][$key]->idSLIDER), FALSE, TRUE);
			if(!empty($map)){
				$data['listslider'][$key]->imageSLIDER = base_url() . 'assets/upload/slider/pic-slider-'.folenc($data['listslider'][$key]->idSLIDER).'/'.$map[0];
			} else {
				$data['listslider'][$key]->imageSLIDER = base_url() . 'assets/upload/no-image-available.png';
			}
		}
		
		$data['barangpromo'] = $this->Barang_m->select_barang_promo()->result();
		foreach ($data['barangpromo'] as $key => $value) {
			$map = directory_map('assets/upload/barang/pic-barang-'.folenc($data['barangpromo'][$key]->idBARANG), FALSE, TRUE);
			if(!empty($map)){
				$data['barangpromo'][$key]->imageBARANG = base_url() . 'assets/upload/barang/pic-barang-'.folenc($data['barangpromo'][$key]->idBARANG).'/'.$map[0];
				$data['barangpromo'][$key]->imageBARANG2 = base_url() . 'assets/upload/barang/pic-barang-'.folenc($data['barangpromo'][$key]->idBARANG).'/'.$map[1];
			} else {
				$data['barangpromo'][$key]->imageBARANG = base_url() . 'assets/upload/no-image-available.png';
				$data['barangpromo'][$key]->imageBARANG2 = base_url() . 'assets/upload/no-image-available.png';
			}
		}

		$data['updatedbarang'] = $this->Barang_m->select_updated_barang()->result();
		foreach ($data['updatedbarang'] as $key => $value) {
			$map = directory_map('assets/upload/barang/pic-barang-'.folenc($data['updatedbarang'][$key]->idBARANG), FALSE, TRUE);
			if(!empty($map)){
				$data['updatedbarang'][$key]->imageBARANG = base_url() . 'assets/upload/barang/pic-barang-'.folenc($data['updatedbarang'][$key]->idBARANG).'/'.$map[0];
				$data['updatedbarang'][$key]->imageBARANG2 = base_url() . 'assets/upload/barang/pic-barang-'.folenc($data['updatedbarang'][$key]->idBARANG).'/'.$map[1];
			} else {
				$data['updatedbarang'][$key]->imageBARANG = base_url() . 'assets/upload/no-image-available.png';
				$data['updatedbarang'][$key]->imageBARANG2 = base_url() . 'assets/upload/no-image-available.png';
			}
		}

		$data['bestselling'] = $this->Barang_m->select_best_selling_barang()->result();

		foreach ($data['bestselling'] as $key => $value) {
			$map = directory_map('assets/upload/barang/pic-barang-'.folenc($data['bestselling'][$key]->idproductdetailORDER), FALSE, TRUE);
			if(!empty($map)){
				$data['bestselling'][$key]->imageBARANG = base_url() . 'assets/upload/barang/pic-barang-'.folenc($data['bestselling'][$key]->idproductdetailORDER).'/'.$map[0];
				$data['bestselling'][$key]->imageBARANG2 = base_url() . 'assets/upload/barang/pic-barang-'.folenc($data['bestselling'][$key]->idproductdetailORDER).'/'.$map[1];
			} else {
				$data['bestselling'][$key]->imageBARANG = base_url() . 'assets/upload/no-image-available.png';
				$data['bestselling'][$key]->imageBARANG2 = base_url() . 'assets/upload/no-image-available.png';
			}
		}

		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }
        
		$data['subview'] = $this->load->view($this->data['frontendDIR'].'home', $data, TRUE);
        $this->load->view($this->data['rootDIR'].'_layout_base_frontend',$data);
	}
}

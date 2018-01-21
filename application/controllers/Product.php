<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends Frontend_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Category_barang_m');
		$this->load->model('Barang_m');
		$this->load->model('Wish_m');
	}

	public function detail($slug){
		$data['addONS'] = 'product-detail';

		$data['getbarang'] = $this->Barang_m->select_barang_by_slug($slug)->row();
		$data['title'] = $data['getbarang']->nameBARANG.' - Zigzag Shop Batam - Official Shop';

		$data['parentcategory'] = $this->Category_barang_m->select_parent_category_barang($data['getbarang']->parentCATEGORY)->row();
		if(!empty($data['getbarang'])){
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
		} else {
			redirect('home','refresh');
		}
		
		$data['subview'] = $this->load->view($this->data['frontendDIR'].'product_detail', $data, TRUE);
		$this->load->view($this->data['rootDIR'].'_layout_base_frontend',$data);
	}

	public function add_to_cart(){ //fungsi Add To Cart
		$data = array(
			'id' => $this->input->post('idBARANG'), 
			'name' => $this->input->post('nameBARANG'), 
			'price' => $this->input->post('priceBARANG'), 
			'qty' => $this->input->post('qtyBARANG'), 
		);
		$this->cart->insert($data);
		echo $this->show_cart(); //tampilkan cart setelah added
	}

	public function load_cart(){ //load data cart
		echo $this->show_cart();
	}

	public function show_cart(){ //Fungsi untuk menampilkan Cart
		$output = '';
		if(!empty($this->cart->contents())){
			foreach ($this->cart->contents() as $items) {
				$map = directory_map('assets/upload/barang/pic-barang-'.folenc($items['id']), FALSE, TRUE);
				$imageBARANG = base_url() . 'assets/upload/barang/pic-barang-'.folenc($items['id']).'/'.$map[0];
				$output .='
	                    <div class="item">
	                        <a href="#" class="ui mini image">
	                            <img src="'.$imageBARANG.'" alt="">
	                        </a>
	                        <div class="content">
	                            <h4 class="header">'.$items['name'].'</h4>
	                            <div class="description">
	                                <p>'.$items['qty'].' x Rp '.number_format($items['price']).'</p>
	                            </div>
	                            <button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-xs">Batal</button>
	                        </div>
	                    </div>
	               		';
			}
			$output .= '
			 <div class="centered cart-total">
                <h4>Total: Rp '.number_format($this->cart->total()).'</h4>
            </div>
            <a href="cart.html" class="ui animated bottom attached fade black button" tabindex="0">
                <div class="visible content"><i class="send icon"></i></div>
                <div class="hidden content">Checkout sekarang</div>
            </a>
			';
		}
		
		return $output;
	}

	public function hapus_cart(){ //fungsi untuk menghapus item cart
		$data = array(
			'rowid' => $this->input->post('row_id'),
			'qty' => 0
		);
		$this->cart->update($data);
		echo $this->show_cart();
	}

	public function wish(){

		$data['idBARANG'] = decode(urldecode($this->input->post('idBARANG')));
        $data['idCUSTOMER'] = $this->session->userdata('idCUSTOMER');

        if($data['idCUSTOMER'] == 0  OR $data['idBARANG'] == 0) {
        	$result['status'] = 'error';
            echo json_encode($result);
        }

		$data = $this->security->xss_clean($data);
		$saveid = $this->Wish_m->save($data);

		if ($saveid) {
             
        	$result['status'] = 'success';
            echo json_encode($result);
            
		} else {

	        $result['status'] = 'error';
            echo json_encode($result);

		}
	}

	public function search(){
		$data['addONS'] = 'search-product';
		$data['title'] = 'Zigzag Shop Batam - Official Shop';

		$product = $this->input->get('product');
		if(strlen($product) > 3){
			$Searching = $this->Barang_m->searching_product($product)->result();
	        if(!empty($Searching)){
		        $data['searching'] = $Searching;

		        foreach ($data['searching'] as $key => $value) {
					$map = directory_map('assets/upload/barang/pic-barang-'.folenc($data['searching'][$key]->idBARANG), FALSE, TRUE);
					if(!empty($map)){
						$data['searching'][$key]->imageSEARCH = base_url() . 'assets/upload/barang/pic-barang-'.folenc($data['searching'][$key]->idBARANG).'/'.$map[0];
					} else {
						$data['searching'][$key]->imageSEARCH = base_url() . 'assets/upload/no-image-available.png';
					}
				}

		        $data['countresult'] = count($Searching);
		        $data['keyword'] = ucwords($product);
		        
				$data['subview'] = $this->load->view($this->data['frontendDIR'].'search', $data, TRUE);
				$this->load->view($this->data['rootDIR'].'_layout_base_frontend',$data);
			} else {
				$data = array(
					'title' => 'Gagal,',
					'text' => 'Data product tidak ditemukan, coba cari dengan kata kunci lain.',
					'type' => 'error'
					);
				$this->session->set_flashdata('message',$data);
				redirect('home');
			}
		} else {
			$data = array(
				'title' => 'Gagal,',
				'text' => 'Masukkan kata kunci nya minimal 3 karakter untuk dapat melakukan pencarian',
				'type' => 'error'
				);
			$this->session->set_flashdata('message',$data);
			redirect('home');
		}
		if(!empty($this->session->flashdata('message'))) {
	        $data['message'] = $this->session->flashdata('message');
	    }
	}
}
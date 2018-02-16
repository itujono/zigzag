<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends Frontend_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Category_barang_m');
		$this->load->model('Barang_m');
		$this->load->model('Wish_m');
		$this->load->model('Shipping_m');
		$this->load->model('Customer_m');
		$this->load->model('Order_m');
		$this->load->model('Order_detail_m');
	}

	public function detail($slug){
		$data['addONS'] = 'product-detail';
		$data['class'] = 'product-detail';

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
			'weight' => $this->input->post('weightBARANG'),
			'stock' => $this->input->post('stockBARANG')
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
					<div class="ui divided items">				
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
            <a href="'.base_url().'product/checkout_shipping" class="ui animated bottom attached fade black button" tabindex="0">
                <div class="visible content"><i class="send icon"></i></div>
                <div class="hidden content">Checkout sekarang</div>
            </a>
          	</div>
			';
		} else {
			$output = 
			'<div class="ui divided items">
                <div class="item">
                    <div class="content">
                        <h4 class="header">Kamu belum menambahkan item apapun di Cart</h4>
                    </div>
                </div>
            </div>
            <div class="ui divided items"></div>';
		}
		
		return $output;
	}

	public function hapus_cart(){ //fungsi untuk menghapus item cart
		foreach ($this->cart->contents() as $val) {
			$data = array(
				'rowid' => $this->input->post('row_id'),
				'qty' => ($val['qty'] - 1)
			);
		}

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
		$data['class'] = 'search';
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

	public function checkout_shipping(){
		$data['addONS'] = 'checkout-customer';
		$data['class'] = 'checkout';
		$data['title'] = 'Checkout - '.$this->session->userdata('Name');
		if(empty($this->session->userdata('idCUSTOMER')) || empty($this->cart->contents())){
			redirect('customer/logout');
		}
		$data['checkshipping_notactive'] = $this->Shipping_m->checkshipping(0)->result();
		$data['checkshipping_active'] = $this->Shipping_m->checkshipping(1)->result();
		foreach ($data['checkshipping_active'] as $key => $value) {
			$map = directory_map('assets/upload/shipping/pic-shipping-'.folenc($data['checkshipping_active'][$key]->idSHIPPING), FALSE, TRUE);
			if(!empty($map)){
				$data['checkshipping_active'][$key]->imageSHIPPING = base_url() . 'assets/upload/shipping/pic-shipping-'.folenc($data['checkshipping_active'][$key]->idSHIPPING).'/'.$map[0];
			} else {
				$data['checkshipping_active'][$key]->imageSHIPPING = base_url() . 'assets/upload/no-image-available.png';
			}
		}
		$data['data_customer'] = $this->Customer_m->selectall_customer($this->session->userdata('idCUSTOMER'))->row();
		$data['data_customer_province_city'] = selectall_city_by_province($data['data_customer']->cityCUSTOMER, $data['data_customer']->provinceCUSTOMER);

		$data['subview'] = $this->load->view($this->data['frontendDIR'].'checkout_shipping', $data, TRUE);
		$this->load->view($this->data['rootDIR'].'_layout_base_frontend',$data);
	}

	public function process_checkout(){
			if($this->input->post('original_data') == ''){
				$rules = $this->Order_m->rules_order;
				$this->form_validation->set_rules($rules);
				$this->form_validation->set_message('required', 'Form %s tidak boleh kosong');
		        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
		        $this->form_validation->set_message('valid_email', 'Maaf, inputan email Anda tidak valid');
		        $this->form_validation->set_message('is_unique', 'Tampaknya inputan %s anda sudah terdaftar');
		        $this->form_validation->set_message('min_length', 'Minimal kata sandi 8 karakter');
		        $this->form_validation->set_message('is_numeric', 'Hanya memasukan angka saja');
		        $this->form_validation->set_error_delimiters('<p class="help">', '</p>');
				if ($this->form_validation->run() == TRUE) {

				$data = $this->Order_m->array_from_post(array('customerORDER','csORDER','kodeORDER','descORDER','statusORDER', 'nameORDER','emailORDER','teleORDER','zipORDER','addressORDER','ekspedisiORDER','dropshipperORDER','dropshippercompanyORDER','telehomeORDER'));
				$data['customerORDER'] = $this->session->userdata('idCUSTOMER');
				$data['csORDER'] = '0';
				$data['provinceORDER'] = $this->input->post('provinsi-checkout');
				$data['cityORDER'] = $this->input->post('city-checkout');
				if($data['telehomeORDER'] == ''){
					$data['telehomeORDER'] = 0;
				}
				$keterangan_ekspedisi = $this->input->post('keterangan_ekspedisi');
				$break = explode("-",$keterangan_ekspedisi);
				$data['ketekspedisiORDER'] = $break[1];
				$data['totalekspedisiORDER'] = $break[0];
				
				//START GENERATE KODE ORDER //
				$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				$res = "";
				for ($i = 0; $i < 4; $i++) {
				    $res .= $chars[mt_rand(0, strlen($chars)-1)];
				}
				$kodeorder = "ZG" . date('Ymd') . $res;
				//END GENERATE KODE ORDER //
				$data['kodeORDER'] = $kodeorder;

				$checkkodeorder = $this->Order_m->checkkodeorder($data['kodeORDER'])->row();
				if($checkkodeorder != NULL){
					//START GENERATE KODE ORDER //
					$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
					$res = "";
					for ($i = 0; $i < 4; $i++) {
					    $res .= $chars[mt_rand(0, strlen($chars)-1)];
					}
					$kodeorder = "ZG" . date('Ymd') . $res;
					//END GENERATE KODE ORDER //
					$data['kodeORDER'] = $kodeorder;
				}

				$data['statusORDER'] = 1;
				if($this->input->post('dropshipper_check') == ''){
					$data['dropshipperORDER'] = '-';
					$data['dropshippercompanyORDER'] = '-';
				}
	   			$data = $this->security->xss_clean($data);
				$saveid = $this->Order_m->save($data);
					if ($saveid) {
		            	redirect('product/checkout_billing');
					} else {
						$data = array(
							'title' => 'Gagal,',
							'text' => 'Maaf, silakan ulangi pengisian form shipping kembali.',
							'type' => 'error'
							);
						$this->session->set_flashdata('message',$data);
						$this->checkout_shipping();
					}
				} else {
					$data = array(
						'title' => 'Gagal,',
						'text' => 'Maaf, silakan ulangi pengisian form shipping anda kembali.',
						'type' => 'error'
						);
					$this->session->set_flashdata('message',$data);
					$this->checkout_shipping();
				}
		} else if($this->input->post('original_data') == 'on') {
			$rules = $this->Order_m->rules_order_default;
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_message('required', 'Form %s tidak boleh kosong');
	        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
	        $this->form_validation->set_message('valid_email', 'Maaf, inputan email Anda tidak valid');
	        $this->form_validation->set_message('is_unique', 'Tampaknya inputan %s anda sudah terdaftar');
	        $this->form_validation->set_message('min_length', 'Minimal kata sandi 8 karakter');
	        $this->form_validation->set_message('is_numeric', 'Hanya memasukan angka saja');
	        $this->form_validation->set_error_delimiters('<p class="help">', '</p>');
			if ($this->form_validation->run() == TRUE) {

			$data['customerORDER'] = $this->session->userdata('idCUSTOMER');
			$data['descORDER'] = $this->input->post('descdefaultORDER');
			$data['nameORDER'] = $this->input->post('namedefaultORDER');
			$data['emailORDER'] = $this->input->post('emaildefaultORDER');
			$data['teleORDER'] = $this->input->post('teledefaultORDER');
			$data['zipORDER'] = $this->input->post('zipdefaultORDER');
			$data['addressORDER'] = $this->input->post('addressdefaultORDER');
			$data['csORDER'] = '0';
			$data['provinceORDER'] = $this->input->post('provinsi_checkout_default');
			$data['cityORDER'] = $this->input->post('city_checkout_default');
			if($data['telehomeORDER'] == ''){
				$data['telehomeORDER'] = 0;
			}
			$keterangan_ekspedisi = $this->input->post('keterangan_ekspedisi');
			$break = explode("-",$keterangan_ekspedisi);
			$data['ketekspedisiORDER'] = $break[1];
			$data['totalekspedisiORDER'] = $break[0];
			
			//START GENERATE KODE ORDER //
			$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$res = "";
			for ($i = 0; $i < 4; $i++) {
			    $res .= $chars[mt_rand(0, strlen($chars)-1)];
			}
			$kodeorder = "ZG" . date('Ymd') . $res;
			//END GENERATE KODE ORDER //
			$data['kodeORDER'] = $kodeorder;

			$checkkodeorder = $this->Order_m->checkkodeorder($data['kodeORDER'])->row();
			if($checkkodeorder != NULL){
				//START GENERATE KODE ORDER //
				$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				$res = "";
				for ($i = 0; $i < 4; $i++) {
				    $res .= $chars[mt_rand(0, strlen($chars)-1)];
				}
				$kodeorder = "ZG" . date('Ymd') . $res;
				//END GENERATE KODE ORDER //
				$data['kodeORDER'] = $kodeorder;
			}

			$data['statusORDER'] = 1;
			if($this->input->post('dropshipper_check') == ''){
				$data['dropshipperORDER'] = '-';
				$data['dropshippercompanyORDER'] = '-';
			}
   			$data = $this->security->xss_clean($data);
			$saveid = $this->Order_m->save($data);
				if ($saveid) {
	            	redirect('product/checkout_billing');
				} else {
					$data = array(
						'title' => 'Gagal,',
						'text' => 'Maaf, silakan ulangi pengisian form shipping kembali.',
						'type' => 'error'
						);
					$this->session->set_flashdata('message',$data);
					$this->checkout_shipping();
				}
			} else {
				$data = array(
					'title' => 'Gagal,',
					'text' => 'Maaf, silakan ulangi pengisian form shipping anda kembali.',
					'type' => 'error'
					);
				$this->session->set_flashdata('message',$data);
				$this->checkout_shipping();
			}
		}
	}

	public function checking_ongkir(){
		$asal = 48;
	    $tujuan = $this->input->post('city_ids');
	    $kurir = $this->input->post('ekspedisi');
	    $berat = $this->input->post('weight');

	    $curl = curl_init();
	    curl_setopt_array($curl, array(
	    CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_ENCODING => "",
	    CURLOPT_MAXREDIRS => 10,
	    CURLOPT_TIMEOUT => 30,
	    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    CURLOPT_CUSTOMREQUEST => "POST",
	    CURLOPT_POSTFIELDS => "origin=".$asal."&destination=".$tujuan."&weight=".$berat."&courier=".$kurir."",
	    CURLOPT_HTTPHEADER => array(
	      "content-type: application/x-www-form-urlencoded",
	      "key: d59049b12bec5f149cb709f386dbd012"
	    ),
	    ));

	    $response = curl_exec($curl);
	    $err = curl_error($curl);

	    curl_close($curl);

	    if ($err) {
	    echo "cURL Error #:" . $err;
	    } else {
	    $response = json_decode($response, TRUE);
	    $output = '';
	    $data_ekspedisi = $response['rajaongkir']['results'][0]['costs'];
	    if(!empty($data_ekspedisi)){
	    $output .= '<div class="ui horizontal segments">
                        <div class="ui segment">
                            <h4>Pengiriman</h4>
                            <select name="keterangan_ekspedisi" class="ui search dropdown">';
                            foreach ($data_ekspedisi as $cost_val) {
                                $output .= '<option value="'.$cost_val['cost'][0]['value'].'-'.$cost_val['description'].'">'.$cost_val['service'].' '.'('.$cost_val['description'].')'.' '.$cost_val['cost'][0]['etd'].' Hari'.' - '.'Rp. '.number_format($cost_val['cost'][0]['value'], 0,',','.').'</option>';
                            }
                            $output .= '</select>
                        </div>
                    </div>';
        } else {
        	$output .= 
    			'<div class="ui horizontal segments">
                    <div class="ui segment">
                        <h4>Pengiriman</h4>
                        <select name="" class="ui search dropdown">
                            <option selected="true" disabled="disabled">Maaf, tidak ada pengantaran didaerah yang anda pilih.</option>
                        </select>
                    </div>
                </div>';
        }
        echo $output;
	    }
	}

	public function checkout_billing(){
		$data['addONS'] = 'checkout-customer';
		$data['class'] = 'checkout';
		$data['title'] = 'Checkout Billing - '.$this->session->userdata('Name');
		if(empty($this->session->userdata('idCUSTOMER')) || empty($this->cart->contents())){
			redirect('customer/logout');
		}
		$data['checkshipping_notactive'] = $this->Shipping_m->checkshipping(0)->result();

		$data['subview'] = $this->load->view($this->data['frontendDIR'].'checkout_billing', $data, TRUE);
		$this->load->view($this->data['rootDIR'].'_layout_base_frontend',$data);
	}

	public function process_checkout_billing(){
		$rules = $this->Order_m->rules_order_billing;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh kosong');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_error_delimiters('<p class="help">', '</p>');
		if ($this->form_validation->run() == TRUE) {
				$data = $this->Order_m->array_from_post(array('paymentORDER'));
				$id = $this->session->userdata('idCUSTOMER');
				$check_latest_data_order = $this->Order_m->check_latest_data_order($id);

	   			$data = $this->security->xss_clean($data);
				$saveid = $this->Order_m->save($data, $check_latest_data_order->idORDER);

				if ($saveid) {

	            	redirect('product/checkout_payment');

				} else {
					$data = array(
						'title' => 'Gagal,',
						'text' => 'Maaf, silakan ulangi pengisian form shipping kembali.',
						'type' => 'error'
						);
					$this->session->set_flashdata('message',$data);
					$this->checkout_billing();
				}

		} else {
			$data = array(
				'title' => 'Gagal,',
				'text' => 'Maaf, silakan ulangi pengisian form billing anda kembali.',
				'type' => 'error'
				);
			$this->session->set_flashdata('message',$data);
			$this->checkout_billing();
		}
	}
	
	public function checkout_payment(){
		$data['addONS'] = 'checkout-customer';
		$data['class'] = 'checkout';
		$data['title'] = 'Checkout Payment - '.$this->session->userdata('Name');
		$id = $this->session->userdata('idCUSTOMER');
		if(empty($id) || empty($this->cart->contents())){
			redirect('customer/logout');
		}
		$data['order_payment'] = $this->Order_m->check_latest_data_order_for_payment($id);

		$data['subview'] = $this->load->view($this->data['frontendDIR'].'checkout_payment', $data, TRUE);
		$this->load->view($this->data['rootDIR'].'_layout_base_frontend',$data);
	}

	public function process_checkout_payment(){
		$id = $this->session->userdata('idCUSTOMER');
		if(empty($id)){
			redirect('customer/logout');
		}
		$check_latest_data_process_payment_order = $this->Order_detail_m->check_latest_data_order_for_process_payment($id);

		foreach ($this->cart->contents() as $key => $value) {
            $array_data_detail_order[$key]['idORDER'] = $check_latest_data_process_payment_order->idORDER;
            $array_data_detail_order[$key]['idproductdetailORDER'] = $value['id'];
            $array_data_detail_order[$key]['productdetailORDER'] = $value['name'];
            $array_data_detail_order[$key]['qtydetailORDER'] = $value['qty'];
            $array_data_detail_order[$key]['pricedetailORDER'] = $value['price'];
        }
        $insert_all = $this->Order_detail_m->insert_batch_detail_order($array_data_detail_order);
        if($insert_all == TRUE){
	        foreach ($this->cart->contents() as $item) {
	            $stock = $item['stock'] - $item['qty'];
	            $data = array(
	                    'stockBARANG' => $stock
	            );
		        $this->Barang_m->save($data, $item['id']);
	        }
	    }
        $this->cart->destroy();
        redirect('home','refresh');

	}

	//function testing aje
	public function cek_ongkir(){
		$costing = cost_ekspedisi();
		echo "<pre>";
		print_r($costing);
		exit;
	}

}
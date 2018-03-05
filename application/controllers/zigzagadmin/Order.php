<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends Admin_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Order_m');
		$this->load->model('Return_m');
		$this->load->model('Payment_m');
		$this->load->model('Order_confirmation_m');
	}
	
	public function index_order(){
		$data['addONS'] = 'plugins_order';
		$ids = $this->session->userdata('idADMIN');

		$data['orderlist'] = $this->Order_m->selectall_order_for_order_page()->result();
		foreach ($data['orderlist'] as $key => $value) {
			if($value->statusORDER == 1){
				$status='<span class="uk-badge uk-badge-primary"> Order diterima</span>';
			} elseif($value->statusORDER == 2) {
				$status='<span class="uk-badge uk-badge-warning"> Menunggu pembayaran</span>';
			} elseif ($value->statusORDER == 3) {
				$status='<span class="uk-badge uk-badge-warning"> Proses pembayaran</span>';
			} else if ($value->statusORDER == 4){
				$status='<span class="uk-badge uk-badge-primary"> Pembayaran disetujui</span>';
			} else if ($value->statusORDER == 5){
				$status='<span class="uk-badge uk-badge-warning"> Proses digudang</span>';
			} elseif($value->statusORDER == 6){
				$status='<span class="uk-badge uk-badge-primary"> Barang terkirim</span>';
			} elseif($value->statusORDER == 7){
				$status='<span class="uk-badge uk-badge-danger"> Pesanan dibatalkan</span>';
			} else {
				$status='<span class="uk-badge uk-badge-danger">Pembayaran ditolak</span>';
			}
			$data['orderlist'][$key]->status = $status;
		}

		$data['order_diterima'] = $this->Order_m->counts('zigzag_order','statusORDER = 1');
        $data['progress_gudang'] = $this->Order_m->counts('zigzag_order','statusORDER = 5');
        $data['barang_terkirim'] = $this->Order_m->counts('zigzag_order','statusORDER = 6');
        $data['order_dibatalkan'] = $this->Order_m->counts('zigzag_order','statusORDER = 7');
		
		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }
        
		$data['subview'] = $this->load->view($this->data['backendDIR'].'order', $data, TRUE);
		$this->load->view($this->data['rootDIR'].'_layout_base',$data);
	}

	public function detail($id){
		$data['addONS'] = 'plugins_detail_order';

		$id = decode(urldecode($id));
		if(empty($id)){
			$data = array(
                'title' => 'Perhatian',
                'text' => 'Kamu tidak dapat melihat detail order, tanpa memilih data order',
                'type' => 'danger'
            );
            $this->session->set_flashdata('message',$data);
			redirect('order/index_order');
		}
		$detailorder = $this->Order_m->selectall_order($id)->row();
			if($detailorder->statusORDER == 1){
				$status='<span class="uk-badge uk-badge-primary"> Order diterima</span>';
			} elseif($detailorder->statusORDER == 2) {
				$status='<span class="uk-badge uk-badge-warning"> Menunggu pembayaran</span>';
			} elseif ($detailorder->statusORDER == 3) {
				$status='<span class="uk-badge uk-badge-warning"> Proses pembayaran</span>';
			} else if ($detailorder->statusORDER == 4){
				$status='<span class="uk-badge uk-badge-primary"> Pembayaran disetujui</span>';
			} else if ($detailorder->statusORDER == 5){
				$status='<span class="uk-badge uk-badge-warning"> Proses digudang</span>';
			} elseif($detailorder->statusORDER == 6){
				$status='<span class="uk-badge uk-badge-primary"> Barang terkirim</span>';
			} elseif($detailorder->statusORDER == 7){
				$status='<span class="uk-badge uk-badge-danger"> Pesanan dibatalkan</span>';
			} else {
				$status='<span class="uk-badge uk-badge-danger">Pembayaran ditolak</span>';
			}
			$detailorder->status = $status;

		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }

        $data['detailorder'] = $detailorder;

        $data['data_customer_province_city'] = selectall_city_by_province($detailorder->cityCUSTOMER, $detailorder->provinceCUSTOMER);

        $data['destinasi_data_customer_province_city'] = selectall_city_by_province($detailorder->cityORDER, $detailorder->provinceORDER);

        $data['order_detail_customer'] = $this->Order_m->get_detail_order_customer_by_idorder($detailorder->idORDER)->result();
		$data['subview'] = $this->load->view($this->data['backendDIR'].'detail_order', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function changestatus($id=NULL, $ss=NULL){
		$ids = decode(urldecode($id));
		$ss = $ss;

		if($ids != 0){
			$data['statusORDER'] = $ss;
			$this->Order_m->save($data, $ids);
			$data = array(
                    'title' => 'Sukses',
                    'text' => 'Perubahan Data berhasil dilakukan',
                    'type' => 'success'
                );
                $this->session->set_flashdata('message',$data);
                redirect('zigzagadmin/order/detail/'.$id);
		}else{
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'Maaf, data tidak berhasil dirubah, silakan ulangi beberapa saat kembali!',
	            'type' => 'error'
		        );
		        $this->session->set_flashdata('message',$data);
		        redirect('zigzagadmin/order/detail/'.$id);
		}
	}

	public function editorder($id = NULL){
		$data['addONS'] = 'plugins_editorder';

		$id = decode(urldecode($id));
		if(empty($id))redirect($this->data['folBACKEND'].'Customer');

		$editorder = $this->Order_m->selectall_order($id)->row();
		
			if($editorder->statusORDER == 1){
				$status='<span class="uk-badge uk-badge-primary">Dalam Proses</span>';
			} elseif($editorder->statusORDER == 2) {
				$status='<span class="uk-badge uk-badge-primary">Proses pencucian</span>';
			} elseif ($editorder->statusORDER == 3) {
				$status='<span class="uk-badge uk-badge-warning">Menunggu Pembayaran</span>';
			} else if ($editorder->statusORDER == 4){
				$status='<span class="uk-badge uk-badge-warning">Dalam proses pembayaran</span>';
			} else if ($editorder->statusORDER == 5){
				$status='<span class="uk-badge uk-badge-success">Pembayaran berhasil (Credit card)</span>';
			} elseif($editorder->statusORDER == 6){
				$status='<span class="uk-badge uk-badge-danger">Pembayaran dibatalkan oleh admin(Credit Card)</span>';
			} elseif($editorder->statusORDER == 7){
				$status='<span class="uk-badge uk-badge-success">Pembayaran berhasil</span>';
			} elseif($editorder->statusORDER == 8){
				$status='<span class="uk-badge uk-badge-warning">Menunggu pembayaran pelanggan</span>';
			} elseif($editorder->statusORDER == 9){
				$status='<span class="uk-badge uk-badge-danger">Pesanan dibatalkan oleh admin/partner</span>';
			} else {
				$status='<span class="uk-badge uk-badge-danger">Pembayaran ditolak</span>';
			}
			$editorder->status = $status;

		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }

        $data['partner'] = $this->Partner_m->select_all_partner_drop(NULL, 1);

        $data['editorder'] = $editorder;

        $data['subview'] = $this->load->view('templates/backend/Update_order', $data, TRUE);
		$this->load->view($this->data['rootDIR'].'_layout_base',$data);
	}

	public function processeditorder(){

		$data = $this->Order_m->array_from_post(array('pickupfinishedtimeORDER','pickupfinisheddateORDER','pickupADDRESSORDERBERSIH','beratORDER','priceORDER','idPARTNER','rejectedmessagesORDER'));
		$data['pickupfinisheddateORDER'] = date("Y-m-d",strtotime($data['pickupfinisheddateORDER']));
		$data['priceORDER'] = str_replace(['Rp.',' '], ['',''], $data['priceORDER']);
		if($data['rejectedmessagesORDER'] != NULL){
			$data['statusORDER'] = 9;
		}
		$id = decode($this->input->post('idORDER'));
		if(empty($id))$id=NULL;
		$saveID = $this->Order_m->save($data, $id);
		$data = $this->Order_m->selectpartnerassignoder($saveID)->row();
		
		if($this->sendemailassignpartner($data)){
			$data = array(
                'title' => 'Sukses',
                'text' => 'Penyimpanan Data berhasil dilakukan',
                'type' => 'success'
            );
            $this->session->set_flashdata('message',$data);
            redirect('zigzagadmin/order/detail/'.encode($id));
		} else {
			$data = array(
                'title' => 'Terjadi Kesalahan',
                'text' => 'Maaf, sistem tidak dapat menyimpan perubahan anda, mohon ulangi',
                'type' => 'error'
            );
            $this->session->set_flashdata('message',$data);
            redirect('zigzagadmin/order/detail/'.encode($id));
		}
	}

	public function index_return_barang(){
		$data['addONS'] = 'plugins_datatables';
		
		$data['list_return_barang'] = $this->Return_m->list_return_customer()->result();
		
		foreach ($data['list_return_barang'] as $key => $value) {
			$map = directory_map('assets/upload/barang/pic-barang-'.folenc($data['list_return_barang'][$key]->idbarangRETURN), FALSE, TRUE);
			if(!empty($map)){
				$data['list_return_barang'][$key]->imagereturnBARANG = base_url() . 'assets/upload/barang/pic-barang-'.folenc($data['list_return_barang'][$key]->idbarangRETURN).'/'.$map[0];
			} else {
				$data['list_return_barang'][$key]->imagereturnBARANG = base_url() . 'assets/upload/no-image-available.png';
			}

			if($value->statusRETURN == 1){
				$status='<span class="uk-badge uk-badge-warning">Dalam Proses Verifikasi admin</span>';
			} elseif($value->statusRETURN == 2) {
				$status='<span class="uk-badge uk-badge-primary">Barang Return Disetujui</span>';
			} else {
				$status='<span class="uk-badge uk-badge-danger">Barang Return Ditolak</span>';
			}
			$data['list_return_barang'][$key]->status = $status;

		}
		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }
        record_activity('Mengunjungi halaman Order Return Barang');
		$data['subview'] = $this->load->view($this->data['backendDIR'].'order_return', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function detail_return_barang($id){
		$id = decode(urldecode($id));
		$data['addONS'] = '';
		$data['detail_return_barang'] = $this->Return_m->list_return_customer(NULL, $id)->row();
		
		$map = directory_map('assets/upload/barang/pic-barang-'.folenc($data['detail_return_barang']->idbarangRETURN), FALSE, TRUE);
		if(!empty($map)){
			$data['detail_return_barang']->imagereturnBARANG = base_url() . 'assets/upload/barang/pic-barang-'.folenc($data['detail_return_barang']->idbarangRETURN).'/'.$map[0];
		} else {
			$data['detail_return_barang']->imagereturnBARANG = base_url() . 'assets/upload/no-image-available.png';
		}

		$data['data_customer_province_city'] = selectall_city_by_province($data['detail_return_barang']->cityCUSTOMER, $data['detail_return_barang']->provinceCUSTOMER);
		
		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }
        record_activity('Mengunjungi halaman Order detail Return Barang - '.$data['detail_return_barang']->kodeorderRETURN.' - '.$data['detail_return_barang']->nameCUSTOMER);
		$data['subview'] = $this->load->view($this->data['backendDIR'].'detail_return', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function process_return_admin(){
		
		$data = $this->Return_m->array_from_post(array('idRETURN','reasonadminRETURN','statusRETURN'));
		
		if($data['statusRETURN'] == 2){
			$this->load->model('Barang_m');
			$data_post = $this->Return_m->array_from_post(array('idbarangRETURN','qtybarangRETURN'));
			$get_stock = $this->Return_m->get_barang_qty_from_id($data_post['idbarangRETURN'])->row();
			$data_barang['idBARANG'] = $data_post['idbarangRETURN'];
			$id_barang = $data_barang['idBARANG'];
			$data_barang['stockBARANG'] = $get_stock->stockBARANG+$data_post['qtybarangRETURN'];
			$this->Barang_m->save($data_barang, $id_barang);
		}

		$id = $data['idRETURN'];
		$save = $this->Return_m->save($data, $id);
		if($save){	
			$data = array(
	            'title' => 'Sukses',
	            'text' => 'Perubahan Data return berhasil dilakukan',
	            'type' => 'success'
	        );
	        $this->session->set_flashdata('message',$data);
	        redirect('zigzagadmin/order/index_return_barang');
	    }
	}

	public function payment($id=NULL) {
		$data['addONS'] = 'plugins_datatables';
		$id = decode(urldecode($id));
		
		$data['list_payment'] = $this->Payment_m->select_all_payment()->result();
		foreach ($data['list_payment'] as $key => $value) {
			$map = directory_map('assets/upload/payment/pic-payment-'.folenc($data['list_payment'][$key]->idPAYMENT), FALSE, TRUE);
			if(!empty($map)){
				$data['list_payment'][$key]->imagePAYMENT = base_url() . 'assets/upload/payment/pic-payment-'.folenc($data['list_payment'][$key]->idPAYMENT).'/'.$map[0];
			} else {
				$data['list_payment'][$key]->imagePAYMENT = base_url() . 'assets/upload/no-image-available.png';
			}

			if($value->statusPAYMENT == 1){
				$status='<a href="#" data-uk-tooltip title="Aktif"><i class="material-icons md-36 uk-text-success">&#xE86C;</i></a>';
			} else {
				$status='<a href="#" data-uk-tooltip title="Tak Aktif"><i class="material-icons  md-36 uk-text-danger">&#xE5C9;</i></a>';
			}
			$data['list_payment'][$key]->status = $status;
		}
		if($id == NULL){
	        $data['tab'] = array(
	            'data-tab' => 'uk-active',
	            'form-tab' => '',
	        );
			$data['getpayment'] = $this->Payment_m->get_new();
		} else {
			
			//conf tab (optional)
	        $data['tab'] = array(
	            'data-tab' => '',
	            'form-tab' => 'uk-active',
	        );
			$data['getpayment'] = $this->Payment_m->select_all_payment($id)->row();
			$map = directory_map('assets/upload/payment/pic-payment-'.folenc($data['getpayment']->idPAYMENT), FALSE, TRUE);
			if(!empty($map)){
				$data['getpayment']->imagePAYMENT = base_url() . 'assets/upload/payment/pic-payment-'.folenc($data['getpayment']->idPAYMENT).'/'.$map[0];
			} else {
				$data['getpayment']->imagePAYMENT = '';
			}
		}

		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }
        record_activity('Mengunjungi halaman Payment');
		$data['subview'] = $this->load->view($this->data['backendDIR'].'payment', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function savepayment() {
		$id = decode(urldecode($this->input->post('idPAYMENT')));
		if(empty($id)) {
			$rules = $this->Payment_m->rules_payment;
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_message('required', 'Form %s tidak boleh dikosongkan');
	        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
	        $this->form_validation->set_message('is_unique', 'Tampaknya inputan Anda sudah terdaftar');
        } else {
			$this->form_validation->set_rules('namePAYMENT', 'Nama Payment', 'trim|required');
			$this->form_validation->set_message('required', 'Form %s tidak boleh dikosongkan');
    		$this->form_validation->set_message('trim', 'Form %s adalah Trim');
		}
        $this->form_validation->set_error_delimiters('<p class="text-red">','</p>');

		if ($this->form_validation->run() == TRUE) {
			$data = $this->Payment_m->array_from_post(array('namePAYMENT','statusPAYMENT'));
			if($data['statusPAYMENT'] == 'on')$data['statusPAYMENT']=1;
			else $data['statusPAYMENT']=0;
			
			if(empty($id))$id=NULL;
			$data = $this->security->xss_clean($data);
			$data['descPAYMENT'] = $this->input->post('descPAYMENT');
			$idsave = $this->Payment_m->save($data, $id);

			$subject = $idsave;
			$filenamesubject = 'pic-payment-'.folenc($subject);
			if(!empty($_FILES['imgPAYMENT']['name'][0])) {
				$path = 'assets/upload/payment/'.$filenamesubject;
				if (!file_exists($path)){
	            	mkdir($path, 0777, true);
	        	}

				$config['upload_path']		= $path;
	            $config['allowed_types']	= 'jpg|png|jpeg';
	            $config['file_name']        = $this->security->sanitize_filename($filenamesubject);

		        $this->upload->initialize($config);

		        if ($this->upload->do_upload('imgPAYMENT')){
		        	$data['uploads'] = $this->upload->data();
		        }
		    }

	    	record_activity('Penyimpanan data payment berhasil');
	  		$data = array(
	        	'title' => 'Sukses',
	            'text' => 'Penyimpanan Data berhasil dilakukan',
	            'type' => 'success'
      		);
      		$this->session->set_flashdata('message', $data);
  			redirect('zigzagadmin/order/payment');

		} else {
			record_activity('Penyimpanan data payment tidak berhasil format salah');
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'mohon ulangi inputan form anda dibawah.',
	            'type' => 'warning'
	        );
	        $this->session->set_flashdata('message',$data);
	        redirect('zigzagadmin/order/payment');
		}
	}

	public function actionedit($id=NULL , $id2=NULL){
		$id = decode(urldecode($id));
		$ss = 0;
		if($id2 != NULL)$ss = 1;
		if($id != 0){
			$data['statusPAYMENT'] = $ss;
			$this->Payment_m->save($data, $id);
			record_activity('Perubahan data status payment berhasil');
			$data = array(
                    'title' => 'Sukses',
                    'text' => 'Perubahan Data berhasil dilakukan',
                    'type' => 'success'
                );
                $this->session->set_flashdata('message',$data);
                redirect('zigzagadmin/order/payment');
		}else{
			record_activity('Perubahan data status payment tidak berhasil');
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'Maaf, Sesuatu yang memalukan terjadi',
	            'type' => 'error'
		        );
		        $this->session->set_flashdata('message',$data);
		        redirect('zigzagadmin/order/payment');
		}
	}

	public function actiondelete_payment($id=NULL){
		$id = decode(urldecode($id));
		if($id != 0){
			$this->Payment_m->delete($id);
			record_activity('Penghapusan data payment berhasil');
			$data = array(
                    'title' => 'Sukses',
                    'text' => 'Penghapusan Data berhasil dilakukan',
                    'type' => 'success'
                );
                $this->session->set_flashdata('message',$data);
                redirect('zigzagadmin/order/payment');
		}else{
			record_activity('Penghapusan data payment tidak berhasil');
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'Maaf, data tidak berhasil dihapus silakan coba beberapa saat kembali',
	            'type' => 'error'
		        );
		        $this->session->set_flashdata('message',$data);
		        redirect('zigzagadmin/order/payment');
		}
	}

	public function deleteimgpayment($id1=NULL){
		if($id1 != NULL){
			$id = decode(urldecode($id1));
			$map = directory_map('assets/upload/payment/pic-payment-'.folenc($id), FALSE, TRUE);
			$path = 'assets/upload/payment/pic-payment-'.folenc($id);
			foreach ($map as $value) {
				unlink('assets/upload/payment/pic-payment-'.folenc($id).'/'.$value);
			}
			if(is_dir($path)){
				rmdir($path);
			}
		}
		record_activity('Penghapusan data gambar payment berhasil');
		$data = array(
            'title' => 'Sukses',
            'text' => 'Penghapusan Gambar berhasil dilakukan',
            'type' => 'success'
        );
        $this->session->set_flashdata('message',$data);
		redirect('zigzagadmin/order/payment/'.$id1);
	}

	public function confirmation_order() {
		$data['addONS'] = 'plugins_datatables';
		$data['list_confirmation_order'] = $this->Order_confirmation_m->list_confirm_order_customer()->result();
		foreach ($data['list_confirmation_order'] as $val) {
			if ($val->statusORDER == 3) {
				$status='<span class="uk-badge uk-badge-warning"> Proses pembayaran</span>';
			} else if ($val->statusORDER == 4){
				$status='<span class="uk-badge uk-badge-primary"> Pembayaran disetujui</span>';
			} else {
				$status='<span class="uk-badge uk-badge-danger">Pembayaran ditolak</span>';
			}
			$val->status = $status;
		}
		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }
        record_activity('Mengunjungi halaman Confirmation Order Admin');
		$data['subview'] = $this->load->view($this->data['backendDIR'].'confirmation_order', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function detail_confirm($kode) {
		$data['addONS'] = 'plugins_detail_order';

		if(empty($kode)){
			$data = array(
                'title' => 'Perhatian',
                'text' => 'Kamu tidak dapat melihat detail konfirmasi order, tanpa memilih data konfirmasi',
                'type' => 'danger'
            );
            $this->session->set_flashdata('message',$data);
			redirect('order/confirmation_order');
		}
		$data['detail_confirm'] = $this->Order_confirmation_m->list_confirm_order_customer($kode)->row();
		
		$data['detail_confirm_order'] = $this->Order_m->get_order_customer_by_kodeorder($kode)->row();

		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }

		$data['subview'] = $this->load->view($this->data['backendDIR'].'detail_confirm', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

}
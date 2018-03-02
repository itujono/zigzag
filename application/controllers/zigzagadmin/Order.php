<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends Admin_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Order_m');
		$this->load->model('Return_m');
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
		// echo "<pre>";
		// print_r($data['detail_return_barang']);
		// exit;
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

}
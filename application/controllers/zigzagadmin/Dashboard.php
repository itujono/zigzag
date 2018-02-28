<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Dashboard_m');
		$this->load->model('Order_m');
	}

	public function index_dashboard() {
		$data['addONS'] = 'plugins_dashboard';

		$data['orderlist'] = $this->Order_m->selectall_order()->result();
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
        record_activity('Mengunjungi halaman dashboard');

		$data['subview'] = $this->load->view($this->data['backendDIR'].'dashboard', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}
}

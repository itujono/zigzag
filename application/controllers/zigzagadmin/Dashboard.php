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
				if($val->statusORDER == 1){
					$status='<i class="check square green icon"></i> Order diterima';
				} elseif($val->statusORDER == 2) {
					$status='<i class="check square green icon"></i> Menunggu pembayaran';
				} elseif ($val->statusORDER == 3) {
					$status='<i class="check square green icon"></i> Proses pembayaran';
				} else if ($val->statusORDER == 4){
					$status='<i class="check square green icon"></i> Pembayaran disetujui';
				} else if ($val->statusORDER == 5){
					$status='<i class="check square green icon"></i> Proses digudang';
				} elseif($val->statusORDER == 6){
					$status='<i class="check square green icon"></i> Barang terkirim';
				} elseif($val->statusORDER == 7){
					$status='<i class="check square green icon"></i> Pesanan dibatalkan';
				} else {
					$status='<span class="uk-badge uk-badge-danger">Pembayaran ditolak</span>';
				}
				$data['history_order'][$key]->status = $status;
			}

		$data['process'] = $this->Order_m->counts('codewell_orders','statusORDER = 1');
        $data['wash'] = $this->Order_m->counts('codewell_orders','statusORDER = 2');
        $data['waitingpayment'] = $this->Order_m->counts('codewell_orders','statusORDER = 3 OR statusORDER = 8');
        $data['done'] = $this->Order_m->counts('codewell_orders','statusORDER = 5 OR statusORDER = 7');

		$data['totalaspirasi'] = 0;
        $data['totalmember'] = 0;
        $data['totalpolling'] = 0;
        $data['totalvisitor'] = 0;

		
		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }
        record_activity('Mengunjungi halaman dashboard');
		$data['subview'] = $this->load->view($this->data['backendDIR'].'dashboard', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}
}

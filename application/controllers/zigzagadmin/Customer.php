<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Admin_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Customer_m');
		$this->load->model('Deposit_m');
	}

	public function index_customer() {
		$data['addONS'] = 'plugins_user';
        $data['list_customer'] = $this->Customer_m->selectall_customer()->result();
        foreach ($data['list_customer'] as $key => $value) {
			$map = directory_map('assets/upload/customer/pic-customer-'.seo_url($data['list_customer'][$key]->nameCUSTOMER.'-'.folenc($data['list_customer'][$key]->idCUSTOMER)), FALSE, TRUE);

			if(!empty($map)){
				$data['list_customer'][$key]->imageCUSTOMER = base_url() . 'assets/upload/customer/pic-customer-'.seo_url($data['list_customer'][$key]->nameCUSTOMER.'-'.folenc($data['list_customer'][$key]->idCUSTOMER)).'/'.$map[0];
			} else {
				$data['list_customer'][$key]->imageCUSTOMER = base_url() . 'assets/upload/no-image-available.png';
			}
		}

		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }
        record_activity('Mengunjungi halaman customer');
		$data['subview'] = $this->load->view($this->data['backendDIR'].'general_customer', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function actiondelete_customer($id=NULL){
		$id = decode(urldecode($id));
		if($id != 0){
			$this->Customer_m->delete($id);
			record_activity('Hapus customer berhasil');
			$data = array(
                    'title' => 'Sukses',
                    'text' => 'Penghapusan Data berhasil dilakukan',
                    'type' => 'success'
                );
                $this->session->set_flashdata('message',$data);
                redirect('zigzagadmin/users/index_customer');
		}else{
			record_activity('Hapus customer error');
			$data = array(
		            'title' => 'Terjadi Kesalahan',
		            'text' => 'Maaf, data tidak berhasil dihapus silakan coba beberapa saat kembali',
		            'type' => 'error'
		        );
		        $this->session->set_flashdata('message',$data);
		        $this->index_customer();
		}
	}

	public function deposit_customer() {
		$data['addONS'] = 'plugins_deposit';

        $data['list_deposit_customer'] = $this->Deposit_m->list_deposit_customer()->result();
        foreach ($data['list_deposit_customer'] as $key => $value) {
        	if($value->statusDEPOSIT == 1){
				$status='<span class="uk-badge uk-badge-primary"> Proses Transaksi Deposit</span>';
			} elseif($value->statusDEPOSIT == 2) {
				$status='<span class="uk-badge uk-badge-success"> Transaksi Deposit Disetujui</span>';
			} elseif ($value->statusDEPOSIT == 3) {
				$status='<span class="uk-badge uk-badge-danger"> Transaksi Deposit Ditolak</span>';
			} else if ($value->statusDEPOSIT == 4){
				$status='<span class="uk-badge uk-badge-primary"> Transaksi Ditambah</span>';
			} else {
				$status='<span class="uk-badge uk-badge-warning"> Transaksi Dikurang</span>';
			}
			$data['list_deposit_customer'][$key]->status = $status;
			$amount="";
	        if($value->statusDEPOSIT == 5){
	        	$amount = "<p class='uk-text-danger uk-text-italic uk-text-bold'> - Rp. ".number_format($value->amountDEPOSIT, 0,',','.')."</p>";
	        } else if ($value->statusDEPOSIT == 4) {
	        	$amount = "<p class='uk-text-success uk-text-italic uk-text-bold'> + Rp. ".number_format($value->amountDEPOSIT, 0,',','.')."</p>";
	        } else if ($value->statusDEPOSIT == 2) {
	        	$amount = "<p class='uk-text-success uk-text-italic uk-text-bold'> + Rp. ".number_format($value->amountDEPOSIT, 0,',','.')."</p>";
	        }
	        $data['list_deposit_customer'][$key]->amount = $amount;
        }

        $data['total_deposit'] = $this->Deposit_m->count_total_deposit()->row();
        $data['customer_deposit'] = $this->Deposit_m->count_customer_deposit()->num_rows();
        $data['customer_deposit_used'] = $this->Deposit_m->customer_deposit_used()->row();

		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }
        record_activity('Mengunjungi halaman deposit customer');
		$data['subview'] = $this->load->view($this->data['backendDIR'].'deposit_customer', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}
}

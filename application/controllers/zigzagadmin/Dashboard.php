<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Dashboard_m');
	}

	public function index_dashboard() {
		$data['addONS'] = 'plugins_dashboard';

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

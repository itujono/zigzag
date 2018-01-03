<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Dashboard_m');
	}

	public function index_dashboard() {
		$data['addONS'] = 'plugins_dashboard';

		// $data['totalaspirasi'] = $this->Dashboard_m->jumlah_data('aspirasi');
  //       $data['totalmember'] = $this->Dashboard_m->jumlah_data('users');
  //       $data['totalpolling'] = $this->Dashboard_m->jumlah_data('polling');
  //       $data['totalvisitor'] = $this->Dashboard_m->jumlah_data('visitor');

  //       $data['listpolling'] = $this->Polling_m->selectall_polling('',1)->row();
        
		// $data['number_voting'] = $this->Polling_choice_m->getNumberVoting($data['listpolling']->idPOLLING);
		
		if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }

		$data['subview'] = $this->load->view($this->data['backendDIR'].'dashboard', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}
}

<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends Admin_Controller{

	public function __construct (){
		parent::__construct();
	}

	public function index_activity($id = NULL){
		$data['addONS'] = '';
		
		$list_activity = explode("\n", file_get_contents('assets/record/record_data.txt'));

		$data['list_activity'] = $list_activity;
		
        record_activity('Mengunjungi halaman Activity');
		$data['subview'] = $this->load->view($this->data['backendDIR'].'activity', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_m extends MY_Model{
	
	protected $_table_name = 'zigzag_payment';
	protected $_order_by = 'idPAYMENT';
	protected $_primary_key = 'idPAYMENT';

	public $rules_payment = array(
		'namePAYMENT' => array(
			'field' => 'namePAYMENT', 
			'label' => 'Nama Payment', 
			'rules' => 'trim|required|is_unique[zigzag_payment.namePAYMENT]'
		),
		'descPAYMENT' => array(
			'field' => 'descPAYMENT', 
			'label' => 'Deskripsi Payment', 
			'rules' => 'trim|required'
		)
	);

	function __construct (){
		parent::__construct();
	}
	
	public function get_new(){
		$payment = new stdClass();
		$payment->idPAYMENT = '';
		$payment->namePAYMENT = '';
		$payment->descPAYMENT = '';
		$payment->statusPAYMENT = '';
		return $payment;
	}

	public function select_all_payment($id = NULL) {
		$this->db->select('*');
		$this->db->from('payment');
		if ($id != NULL) {
			$this->db->where('idPAYMENT',$id);
		}
		return $this->db->get();
	}

	public function select_all_payment_for_frontend() {
		$this->db->select('namePAYMENT, descPAYMENT, idPAYMENT');
		$this->db->from('payment');
		$this->db->where('statusPAYMENT',1);
		
		return $this->db->get();
	}
}
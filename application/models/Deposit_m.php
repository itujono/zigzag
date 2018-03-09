<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit_m extends MY_Model{
	
	protected $_table_name = 'zigzag_deposit';
	protected $_order_by = 'idDEPOSIT';
	protected $_primary_key = 'idDEPOSIT';

	public $rules_deposit = array(
		'amountDEPOSIT' => array(
			'field' => 'amountDEPOSIT', 
			'label' => 'Jumlah Deposit', 
			'rules' => 'trim|required|is_numeric'
		)
	);

	public $rules_deposit_option = array(
		'amount_deposit_option' => array(
			'field' => 'amount_deposit_option', 
			'label' => 'Jumlah Deposit', 
			'rules' => 'trim|required'
		)
	);

	public $rules_deposit_number = array(
		'amount_deposit_number' => array(
			'field' => 'amount_deposit_number', 
			'label' => 'Jumlah Deposit', 
			'rules' => 'trim|required|is_numeric'
		)
	);

	function __construct (){
		parent::__construct();
	}

    public function list_deposit_customer($id=NULL, $customer_id=NULL) {
		$this->db->select('*');
		$this->db->select('customer.nameCUSTOMER');
		$this->db->from('deposit');
		$this->db->join('customer', 'customer.idCUSTOMER = deposit.customerDEPOSIT');
		if($id != NULL){
			$this->db->where('idDEPOSIT',$id);
		}
		if($customer_id != NULL){
			$this->db->where('customerDEPOSIT',$customer_id);
		}
		
		return $this->db->get();
	}

	public function count_total_deposit() {
		$this->db->select('SUM(amountDEPOSIT) as total_deposit');
		$this->db->from('deposit');
		$this->db->where('statusDEPOSIT', 2);
		$this->db->or_where('statusDEPOSIT', 4);
		return $this->db->get();
	}

	public function count_customer_deposit() {
		$this->db->select('customerDEPOSIT');
		$this->db->from('deposit');
		$this->db->group_by('customerDEPOSIT');
		return $this->db->get();
	}

	public function customer_deposit_used() {
		$this->db->select('SUM(amountDEPOSIT) as total_used_deposit');
		$this->db->from('deposit');
		$this->db->where('statusDEPOSIT', 5);
		return $this->db->get();
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_confirmation_m extends MY_Model{
	
	protected $_table_name = 'zigzag_confirm_order';
	protected $_order_by = 'idCONFIRM';
	protected $_primary_key = 'idCONFIRM';

	public $rules_order_confirmation = array(
		'kodeCONFIRM' => array(
			'field' => 'kodeCONFIRM', 
			'label' => 'Kode Order', 
			'rules' => 'trim|required'
		),
		'bankCONFIRM' => array(
			'field' => 'bankCONFIRM', 
			'label' => 'Bank Pengirim', 
			'rules' => 'trim|required'
		),
		'namaCONFIRM' => array(
			'field' => 'namaCONFIRM', 
			'label' => 'Nama Pengirim', 
			'rules' => 'trim|required'
		),
		'rekeningCONFIRM' => array(
			'field' => 'rekeningCONFIRM', 
			'label' => 'Rekening Pengirim', 
			'rules' => 'trim|required|is_numeric'
		),
		'nominalCONFIRM' => array(
			'field' => 'nominalCONFIRM', 
			'label' => 'Nominal Transfer', 
			'rules' => 'trim|required|is_numeric'
		),
		'setujuCONFIRM' => array(
			'field' => 'setujuCONFIRM', 
			'label' => 'Nominal Transfer', 
			'rules' => 'trim|required'
		),
	);

	function __construct (){
		parent::__construct();
	}

    public function listkodeorder() {
		$this->db->select('kodeORDER');
		$this->db->from('order');
		$this->db->where('statusORDER',2);
		return $this->db->get();
	}

	public function get_total_price_order($kode) {
		$this->db->select('order.totalekspedisiORDER');
		$this->db->select('SUM(qtydetailORDER * pricedetailORDER) as subtotal');
		$this->db->from('order');
		$this->db->join('detail_orders', 'detail_orders.idORDER = order.idORDER');
		$this->db->where('order.kodeORDER',$kode);
		return $this->db->get();
	}

	public function get_idorder_from_kodeorder($kode) {
		$this->db->select('idORDER');
		$this->db->from('order');
		$this->db->where('kodeORDER',$kode);
		$this->db->limit(1);
		return $this->db->get();
	}

}
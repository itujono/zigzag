<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping_m extends MY_Model{
	
	protected $_table_name = 'zigzag_shipping';
	protected $_order_by = 'idSHIPPING';
	protected $_primary_key = 'idSHIPPING';

	public $rules_shipping = array(
		'nameSHIPPING' => array(
			'field' => 'nameSHIPPING', 
			'label' => 'Nama Shipping', 
			'rules' => 'trim|required|is_unique[zigzag_shipping.nameSHIPPING]'
		)
	);

	function __construct (){
		parent::__construct();
	}
	
	public function get_new(){
		$shipping = new stdClass();
		$shipping->idSHIPPING = '';
		$shipping->nameSHIPPING = '';
		$shipping->statusSHIPPING = '';
		return $shipping;
	}

	public function selectall_shipping($id = NULL) {
		$this->db->select('*');
		$this->db->from('shipping');
		if ($id != NULL) {
			$this->db->where('idSHIPPING',$id);
		}
		return $this->db->get();
	}

	public function checkshipping($status) {
		$this->db->select('idSHIPPING, nameSHIPPING');
		$this->db->from('shipping');
		$this->db->where('statusSHIPPING', $status);
		return $this->db->get();
	}
}
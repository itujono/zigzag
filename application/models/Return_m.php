<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Return_m extends MY_Model{
	
	protected $_table_name = 'zigzag_return_barang';
	protected $_order_by = 'idRETURN';
	protected $_primary_key = 'idRETURN';

	public $rules_return_barang = array(
		'kodeorderRETURN' => array(
			'field' => 'kodeorderRETURN', 
			'label' => 'Kode Order Return', 
			'rules' => 'trim|required'
		),
		'kodebarangRETURN' => array(
			'field' => 'kodebarangRETURN', 
			'label' => 'Kode Barang', 
			'rules' => 'trim|required'
		),
		'reasonRETURN' => array(
			'field' => 'reasonRETURN', 
			'label' => 'Alasan Return', 
			'rules' => 'trim|required'
		),
		'setujuRETURN' => array(
			'field' => 'setujuRETURN', 
			'label' => 'Setuju Return', 
			'rules' => 'trim|required'
		)
	);

	function __construct (){
		parent::__construct();
	}

     public function list_kodeorder_customer($id) {
		$this->db->select('kodeORDER');
		$this->db->from('order');
		$this->db->where('customerORDER',$id);
		return $this->db->get();
	}

	public function get_all_product_customer_by_kodeorder($id){
		$this->db->select('codeBARANG, nameBARANG');
		$this->db->select('idproductdetailORDER');
		$this->db->from('barang');
		$this->db->join('detail_orders', 'detail_orders.idproductdetailORDER = barang.idBARANG');
		$this->db->where('detail_orders.idORDER',$id);
		return $this->db->get();
	}

}
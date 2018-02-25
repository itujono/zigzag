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
		),
		'qtybarangRETURN' => array(
			'field' => 'qtybarangRETURN', 
			'label' => 'Quantity Barang Return', 
			'rules' => 'trim|required|is_numeric'
		)
	);

	function __construct (){
		parent::__construct();
	}

	public function list_return_customer($id){
		$this->db->select('kodeorderRETURN, reasonRETURN, statusRETURN, reasonadminRETURN, createdateRETURN, idbarangRETURN, customerRETURN, qtybarangRETURN');
		$this->db->select('addressORDER, zipORDER');
	    $this->db->from('return_barang');
	    $this->db->join('order', 'order.kodeORDER = return_barang.kodeorderRETURN');
	    $this->db->where('customerRETURN', $id);
		return $this->db->get();
	}

    public function list_kodeorder_customer($id) {
		$this->db->select('kodeORDER');
		$this->db->from('order');
		$this->db->where('customerORDER',$id);
		$this->db->where('statusORDER',6);
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
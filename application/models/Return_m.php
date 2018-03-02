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

	public function list_return_customer($id=NULL, $idreturn=NULL){
		$this->db->select('idRETURN, kodeorderRETURN, reasonRETURN, statusRETURN, reasonadminRETURN, createdateRETURN, idbarangRETURN, customerRETURN, qtybarangRETURN, kodebarangRETURN');
		$this->db->select('addressORDER, zipORDER');
		$this->db->select('nameCUSTOMER, addressCUSTOMER, cityCUSTOMER, provinceCUSTOMER');
		$this->db->select('priceBARANG, nameBARANG');
	    $this->db->from('return_barang');
	    $this->db->join('order', 'order.kodeORDER = return_barang.kodeorderRETURN');
	    $this->db->join('customer', 'customer.idCUSTOMER = return_barang.customerRETURN');
	    $this->db->join('barang', 'barang.idBARANG = return_barang.idbarangRETURN');
	    if($id != NULL){
	    	$this->db->where('customerRETURN', $id);
	    }
	    if($idreturn != NULL){
	    	$this->db->where('idRETURN', $idreturn);
	    }
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

	public function get_barang_qty_from_id($id){
		$this->db->select('stockBARANG');
		$this->db->from('barang');
		$this->db->where('idBARANG',$id);
		return $this->db->get();
	}

}
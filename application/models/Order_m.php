<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_m extends MY_Model{
	
	protected $_table_name = 'zigzag_order';
	protected $_order_by = 'idORDER';
	protected $_primary_key = 'idORDER';

	public $rules_order = array(
		'nameORDER' => array(
			'field' => 'nameORDER', 
			'label' => 'Nama Order', 
			'rules' => 'trim|required'
		),
		'customerORDER' => array(
			'field' => 'customerORDER', 
			'label' => 'Customer Order', 
			'rules' => 'trim'
		),
		'descORDER' => array(
			'field' => 'descORDER', 
			'label' => 'Deskripsi Order', 
			'rules' => 'trim'
		),
		'emailORDER' => array(
			'field' => 'emailORDER', 
			'label' => 'Email Order', 
			'rules' => 'trim|required|valid_email'
		),
		'teleORDER' => array(
			'field' => 'teleORDER', 
			'label' => 'Telepon Order', 
			'rules' => 'trim|required|numeric'
		),
		'provinsi-checkout' => array(
			'field' => 'provinsi-checkout', 
			'label' => 'Provinsi Order', 
			'rules' => 'trim|required'
		),
		'city-checkout' => array(
			'field' => 'city-checkout', 
			'label' => 'Kota Order', 
			'rules' => 'trim|required'
		),
		'zipORDER' => array(
			'field' => 'zipORDER', 
			'label' => 'Kode Pos Order', 
			'rules' => 'trim|required'
		),
		'addressORDER' => array(
			'field' => 'addressORDER', 
			'label' => 'Alamat Order', 
			'rules' => 'trim|required'
		),
		'ekspedisiORDER' => array(
			'field' => 'ekspedisiORDER', 
			'label' => 'Ekspedisi Order', 
			'rules' => 'trim|required'
		)
	);

	public $rules_order_billing = array(
		'paymentORDER' => array(
			'field' => 'paymentORDER', 
			'label' => 'Payment Order', 
			'rules' => 'trim|required'
		)
	);

	function __construct (){
		parent::__construct();
	}

	public function selectall_order($id = NULL) {
		// $this->db->select('*');
		// $this->db->select('nameCATEGORY');
		// $this->db->from('barang');
		// $this->db->join('category_barang', 'category_barang.idCATEGORY = barang.idCATEGORY', 'left');
		// if ($id != NULL) {
		// 	$this->db->where('idBARANG',$id);
		// }
		// return $this->db->get();
	}

	public function checkkodeorder($kodeorder){
		$this->db->select('kodeORDER');
		$this->db->from('order');
		$this->db->where('kodeORDER', $kodeorder);
		return $this->db->get();
	}

	public function check_latest_data_order($id){
		$query = $this->db->query("SELECT idORDER, nameORDER FROM zigzag_order WHERE createdateORDER IN (SELECT MAX(createdateORDER) FROM zigzag_order WHERE customerORDER = ".$id." GROUP BY customerORDER) ORDER BY createdateORDER DESC");
		return $query->row();
	}

	public function check_latest_data_order_for_payment($id){
		$query = $this->db->query("SELECT ekspedisiORDER, addressORDER, paymentORDER FROM zigzag_order WHERE createdateORDER IN (SELECT MAX(createdateORDER) FROM zigzag_order WHERE customerORDER = ".$id." GROUP BY customerORDER) ORDER BY createdateORDER DESC");
		return $query->row();
	}
}
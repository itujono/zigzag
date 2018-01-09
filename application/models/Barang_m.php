<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_m extends MY_Model{
	
	protected $_table_name = 'zigzag_barang';
	protected $_order_by = 'idBARANG';
	protected $_primary_key = 'idBARANG';

	public $rules_barang = array(
		'nameBARANG' => array(
			'field' => 'nameBARANG', 
			'label' => 'Nama Barang', 
			'rules' => 'trim|required'
		),
		'priceBARANG' => array(
			'field' => 'priceBARANG', 
			'label' => 'Harga Barang', 
			'rules' => 'trim|required'
		),
		'descBARANG' => array(
			'field' => 'descBARANG', 
			'label' => 'Deskripsi Barang', 
			'rules' => 'trim|required'
		),
		'materialBARANG' => array(
			'field' => 'materialBARANG', 
			'label' => 'Material Barang', 
			'rules' => 'trim|required'
		),
		'dimensionBARANG' => array(
			'field' => 'dimensionBARANG', 
			'label' => 'Dimensi Barang', 
			'rules' => 'trim|required'
		),
		'weightBARANG' => array(
			'field' => 'weightBARANG', 
			'label' => 'Berat Barang', 
			'rules' => 'trim|required'
		),
		'stockBARANG' => array(
			'field' => 'stockBARANG', 
			'label' => 'Stok Barang', 
			'rules' => 'trim|required|numeric'
		),
		'codeBARANG' => array(
			'field' => 'codeBARANG', 
			'label' => 'Kode Barang', 
			'rules' => 'trim|required'
		),
		'colorBARANG' => array(
			'field' => 'colorBARANG', 
			'label' => 'Warna Barang', 
			'rules' => 'trim|required'
		)
	);

	function __construct (){
		parent::__construct();
	}
	
	public function get_new(){
		$barang = new stdClass();
		$barang->idBARANG = '';
		$barang->idCATEGORY = '';
		$barang->nameBARANG = '';
		$barang->priceBARANG = '';
		$barang->descBARANG = '';
		$barang->materialBARANG = '';
		$barang->dimensionBARANG = '';
		$barang->weightBARANG = '';
		$barang->stockBARANG = '';
		$barang->codeBARANG = '';
		$barang->colorBARANG = '';
		$barang->hotBARANG = '';

		return $barang;
	}

	public function selectall_barang($id = NULL) {
		$this->db->select('*');
		$this->db->select('nameCATEGORY');
		$this->db->from('barang');
		$this->db->join('category_barang', 'category_barang.idCATEGORY = barang.idCATEGORY', 'left');
		if ($id != NULL) {
			$this->db->where('idBARANG',$id);
		}
		return $this->db->get();
	}

	public function select_barang_promo() {
		$this->db->select('idBARANG, nameBARANG, priceBARANG, hotBARANG');
		$this->db->select('nameCATEGORY');
		$this->db->from('barang');
		$this->db->join('category_barang', 'category_barang.idCATEGORY = barang.idCATEGORY');
		$this->db->where('category_barang.idCATEGORY', 14);
		$this->db->or_where('category_barang.nameCATEGORY', 'Promo Discount');
		return $this->db->get();
	}

	public function select_updated_barang() {
		$this->db->select('idBARANG, nameBARANG, priceBARANG, hotBARANG');
		$this->db->select('nameCATEGORY');
		$this->db->from('barang');
		$this->db->join('category_barang', 'category_barang.idCATEGORY = barang.idCATEGORY');
		$this->db->order_by('idBARANG', 'desc');
		return $this->db->get();
	}
}
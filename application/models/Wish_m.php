<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wish_m extends MY_Model{
	
	protected $_table_name = 'zigzag_wish';
	protected $_order_by = 'idWISH';
	protected $_primary_key = 'idWISH';

	function __construct (){
		parent::__construct();
	}

	public function selectall_wish_customer($id, $id2) {
		$this->db->select('*');
		$this->db->select('barang.idBARANG, nameBARANG');
		$this->db->select('customer.idCUSTOMER, nameCUSTOMER');
		$this->db->from('wish');
		$this->db->join('barang', 'barang.idBARANG = wish.idBARANG');
		$this->db->join('customer', 'customer.idCUSTOMER = wish.idCUSTOMER');
		$this->db->where('barang.idBARANG',$id);
		$this->db->where('customer.idCUSTOMER',$id2);
		return $this->db->get();
	}

	public function selectall_wish_by_customer($id) {
		$this->db->select('wish.idWISH, wish.idBARANG, wish.idCUSTOMER');
		$this->db->select('barang.idBARANG, nameBARANG,priceBARANG, descBARANG, slugBARANG');
		$this->db->select('category_barang.idCATEGORY, nameCATEGORY');
		$this->db->select('customer.idCUSTOMER');
		$this->db->from('wish');
		$this->db->join('barang', 'barang.idBARANG = wish.idBARANG');
		$this->db->join('category_barang', 'category_barang.idCATEGORY = barang.idCATEGORY');
		$this->db->join('customer', 'customer.idCUSTOMER = wish.idCUSTOMER');
		$this->db->where('wish.idCUSTOMER',$id);
		return $this->db->get();
	}

	public function move_wish_list_to_cart($id){
        $this->db->where('idWISH', $id);
        $this->db->delete('wish');
	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_barang_m extends MY_Model{
	
	protected $_table_name = 'zigzag_category_barang';
	protected $_order_by = 'idCATEGORY';
	protected $_primary_key = 'idCATEGORY';

	public $rules_category = array(
		'nameCATEGORY' => array(
			'field' => 'nameCATEGORY', 
			'label' => 'Nama Kategori Barang', 
			'rules' => 'trim|required|is_unique[zigzag_category_barang.nameCATEGORY]'
		)
	);

	function __construct (){
		parent::__construct();
	}
	
	public function get_new(){
		$category = new stdClass();
		$category->idCATEGORY = '';
		$category->nameCATEGORY = '';
		$category->parentCATEGORY = '';
		return $category;
	}

	public function selectall_category_barang($id = NULL) {
		$this->db->select('*');
		$this->db->from('category_barang');
		if ($id != NULL) {
			$this->db->where('idCATEGORY',$id);
		}
		return $this->db->get();
	}

	public function select_category_barang_drop(){
        $this->db->select('idCATEGORY, nameCATEGORY');
        $this->db->from('category_barang');
        $ddown = array();
        foreach ($this->db->get()->result() as $value) {
            $ddown[0] = "Parent";
            $ddown[$value->idCATEGORY] = $value->nameCATEGORY;
        }
        return $ddown;
    }

    public function check_parent_category_barang($id = NULL) {
		$this->db->select('parentCATEGORY, nameCATEGORY');
		$this->db->from('category_barang');
		$this->db->where('parentCATEGORY',$id);
		return $this->db->get();
	}
}
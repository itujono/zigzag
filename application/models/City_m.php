<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City_m extends MY_Model{
	
	protected $_table_name = 'zigzag_city';
	protected $_order_by = 'idCITY';
	protected $_primary_key = 'idCITY';

	public $rules_city = array(
		'nameCITY' => array(
			'field' => 'nameCITY', 
			'label' => 'Nama Kota', 
			'rules' => 'trim|required|is_unique[zigzag_city.nameCITY]'
		)
	);

	function __construct (){
		parent::__construct();
	}
	
	public function get_new(){
		$slider = new stdClass();
		$slider->idCITY = '';
		$slider->idPROVINCE = '';
		$slider->nameCITY = '';
		return $slider;
	}

	public function selectall_city($id = NULL) {
		$this->db->select('city.idPROVINCE');
		$this->db->select('province.idPROVINCE');
		$this->db->from('city');
		$this->db->join('province', 'province.idPROVINCE = city.idPROVINCE');
		if ($id != NULL) {
			$this->db->where('idCITY',$id);
		}
		return $this->db->get();
	}

	public function get_city_by_province($id){
  		$this->db->select('idCITY, nameCITY');
  		$this->db->from('city');
  		$this->db->where('idPROVINCE',$id);

  		return $this->db->get();
 	}
}
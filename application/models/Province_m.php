<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Province_m extends MY_Model{
	
	protected $_table_name = 'zigzag_province';
	protected $_order_by = 'idPROVINCE';
	protected $_primary_key = 'idPROVINCE';

	public $rules_province = array(
		'namePROVINCE' => array(
			'field' => 'namePROVINCE', 
			'label' => 'Nama Provinsi', 
			'rules' => 'trim|required|is_unique[zigzag_province.namePROVINCE]'
		)
	);

	function __construct (){
		parent::__construct();
	}
	
	public function get_new(){
		$slider = new stdClass();
		$slider->idPROVINCE = '';
		$slider->namePROVINCE = '';
		return $slider;
	}

	public function selectall_province($id = NULL) {
		$this->db->select('*');
		$this->db->from('province');
		if ($id != NULL) {
			$this->db->where('idPROVINCE',$id);
		}
		return $this->db->get();
	}

	public function select_province_drop(){
        $this->db->select('idPROVINCE, namePROVINCE');
        $this->db->from('province');
        $ddown = array();
        foreach ($this->db->get()->result() as $value) {
            $ddown[$value->idPROVINCE] = $value->namePROVINCE;
        }
        return $ddown;
    }
}
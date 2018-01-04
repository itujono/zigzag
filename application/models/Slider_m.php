<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_m extends MY_Model{
	
	protected $_table_name = 'zigzag_slider';
	protected $_order_by = 'idSLIDER';
	protected $_primary_key = 'idSLIDER';

	public $rules_slider = array(
		'titleSLIDER' => array(
			'field' => 'titleSLIDER', 
			'label' => 'Judul Slider', 
			'rules' => 'trim|required'
		)
	);

	function __construct (){
		parent::__construct();
	}
	
	public function get_new(){
		$slider = new stdClass();
		$slider->idSLIDER = '';
		$slider->titleSLIDER = '';
		return $slider;
	}

	public function selectall_slider($id = NULL, $slider=NULL) {
		if($slider = NULL){
			$this->db->select('*');
		} else {
			$this->db->select('idSLIDER, titleSLIDER');
		}
		$this->db->from('slider');
		if ($id != NULL) {
			$this->db->where('idSLIDER',$id);
		}
		return $this->db->get();
	}
}
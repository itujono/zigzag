<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Social_customer_m extends MY_Model{
	
	protected $_table_name = 'zigzag_social_customer';
	protected $_order_by = 'idSOCIAL';
	protected $_primary_key = 'idSOCIAL';

	public $rules_social_customer = array(
		'facebooknameSOCIAL' => array(
			'field' => 'facebooknameSOCIAL', 
			'label' => 'ID Facebook', 
			'rules' => 'trim|required'
		),
		'instagramnameSOCIAL' => array(
			'field' => 'instagramnameSOCIAL', 
			'label' => 'ID Instagram', 
			'rules' => 'trim|required'
		),
	);

	function __construct (){
		parent::__construct();
	}

	public function update_data_social($data, $id){
		$this->db->where('idCUSTOMER', $id);
		$this->db->update('social_customer', $data);
		return $id;
	}

	public function selectall_social_customer($id = NULL) {
		$this->db->select('*');
		$this->db->select('customer.idCUSTOMER');
		$this->db->from('social_customer');
		$this->db->join('customer', 'customer.idCUSTOMER = social_customer.idCUSTOMER');
		if ($id != NULL) {
			$this->db->where('social_customer.idCUSTOMER',$id);
		}
		return $this->db->get();
	}

	public function check_social_customer($id) {
		$this->db->select('idCUSTOMER');
		$this->db->from('social_customer');
		$this->db->where('idCUSTOMER',$id);
		return $this->db->get();
	}
}
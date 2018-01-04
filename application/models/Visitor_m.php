<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor_m extends MY_Model{
	
	protected $_table_name = 'nyat_visitor';
	protected $_order_by = 'idVISITOR';
	protected $_primary_key = 'idVISITOR';

	function __construct (){
		parent::__construct();
	}

	public function checkvisitor($ip, $time){
		$this->db->select('*');
		$this->db->from('visitor');
		$this->db->where('ipVISITOR', $ip);
		$this->db->where('dateVISITOR', $time);
		$query = $this->db->get();
		return $query->num_rows();
	}
}
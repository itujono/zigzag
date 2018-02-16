<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_detail_m extends MY_Model{
	
	protected $_table_name = 'zigzag_detail_orders';
	protected $_order_by = 'iddetailORDER';
	protected $_primary_key = 'iddetailORDER';

	function __construct (){
		parent::__construct();
	}

	public function insert_batch_detail_order($data_detail_order)
	{
		$this->db->insert_batch('zigzag_detail_orders', $data_detail_order);
		if ($this->db->affected_rows() >= 1) {
            return TRUE;
        } else {
            return FALSE;
        } 
	}

	public function check_latest_data_order_for_process_payment($id){
		$query = $this->db->query("SELECT idORDER FROM zigzag_order WHERE createdateORDER IN (SELECT MAX(createdateORDER) FROM zigzag_order WHERE customerORDER = ".$id." GROUP BY customerORDER) ORDER BY createdateORDER DESC");
		return $query->row();
	}
}
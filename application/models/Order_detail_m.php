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

	public function get_qty_barang_from_id_barang($id_barang, $session_customer) {
		$this->db->select('SUM(qtydetailORDER) as qty_barang');
		$this->db->from('detail_orders');
		$this->db->join('order', 'order.idORDER = detail_orders.idORDER');
		$this->db->where('idproductdetailORDER',$id_barang);
		$this->db->where('order.customerORDER',$session_customer);
		
		return $this->db->get();
	}
}
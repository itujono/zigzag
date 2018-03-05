<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_m extends MY_Model{
	
	protected $_table_name = 'zigzag_order';
	protected $_order_by = 'idORDER';
	protected $_primary_key = 'idORDER';

	public $rules_order = array(
		'nameORDER' => array(
			'field' => 'nameORDER', 
			'label' => 'Nama Order', 
			'rules' => 'trim|required'
		),
		'customerORDER' => array(
			'field' => 'customerORDER', 
			'label' => 'Customer Order', 
			'rules' => 'trim'
		),
		'descORDER' => array(
			'field' => 'descORDER', 
			'label' => 'Deskripsi Order', 
			'rules' => 'trim'
		),
		'emailORDER' => array(
			'field' => 'emailORDER', 
			'label' => 'Email Order', 
			'rules' => 'trim|required|valid_email'
		),
		'teleORDER' => array(
			'field' => 'teleORDER', 
			'label' => 'Telepon Order', 
			'rules' => 'trim|required|numeric'
		),
		'provinsi-checkout' => array(
			'field' => 'provinsi-checkout', 
			'label' => 'Provinsi Order', 
			'rules' => 'trim|required'
		),
		'city-checkout' => array(
			'field' => 'city-checkout', 
			'label' => 'Kota Order', 
			'rules' => 'trim|required'
		),
		'zipORDER' => array(
			'field' => 'zipORDER', 
			'label' => 'Kode Pos Order', 
			'rules' => 'trim|required'
		),
		'addressORDER' => array(
			'field' => 'addressORDER', 
			'label' => 'Alamat Order', 
			'rules' => 'trim|required'
		),
		'ekspedisiORDER' => array(
			'field' => 'ekspedisiORDER', 
			'label' => 'Ekspedisi Order', 
			'rules' => 'trim|required'
		)
	);

	public $rules_order_default = array(
		'namedefaultORDER' => array(
			'field' => 'namedefaultORDER', 
			'label' => 'Nama Order', 
			'rules' => 'trim|required'
		),
		'descdefaultORDER' => array(
			'field' => 'descdefaultORDER', 
			'label' => 'Deskripsi Order', 
			'rules' => 'trim'
		),
		'emaildefaultORDER' => array(
			'field' => 'emaildefaultORDER', 
			'label' => 'Email Order', 
			'rules' => 'trim|required|valid_email'
		),
		'teledefaultORDER' => array(
			'field' => 'teledefaultORDER', 
			'label' => 'Telepon Order', 
			'rules' => 'trim|required|numeric'
		),
		'provinsi-checkout-default' => array(
			'field' => 'provinsi-checkout-default', 
			'label' => 'Provinsi Order', 
			'rules' => 'trim|required'
		),
		'city-checkout-default' => array(
			'field' => 'city-checkout-default', 
			'label' => 'Kota Order', 
			'rules' => 'trim|required'
		),
		'zipdefaultORDER' => array(
			'field' => 'zipdefaultORDER', 
			'label' => 'Kode Pos Order', 
			'rules' => 'trim|required'
		),
		'addressdefaultORDER' => array(
			'field' => 'addressdefaultORDER', 
			'label' => 'Alamat Order', 
			'rules' => 'trim|required'
		),
		'ekspedisiORDER' => array(
			'field' => 'ekspedisiORDER', 
			'label' => 'Ekspedisi Order', 
			'rules' => 'trim|required'
		)
	);

	public $rules_order_billing = array(
		'paymentORDER' => array(
			'field' => 'paymentORDER', 
			'label' => 'Payment Order', 
			'rules' => 'trim|required'
		)
	);

	public $rules_order_confirmation = array(
		'kodeCONFIRM' => array(
			'field' => 'kodeCONFIRM', 
			'label' => 'Kode Order', 
			'rules' => 'trim|required'
		),
		'bankCONFIRM' => array(
			'field' => 'bankCONFIRM', 
			'label' => 'Bank Pengirim', 
			'rules' => 'trim|required'
		),
		'namaCONFIRM' => array(
			'field' => 'namaCONFIRM', 
			'label' => 'Nama Pengirim', 
			'rules' => 'trim|required'
		),
		'rekeningCONFIRM' => array(
			'field' => 'rekeningCONFIRM', 
			'label' => 'Rekening Pengirim', 
			'rules' => 'trim|required'
		),
		'nominalCONFIRM' => array(
			'field' => 'nominalCONFIRM', 
			'label' => 'Nominal Transfer', 
			'rules' => 'trim|required|is_numeric'
		),
		'setujuCONFIRM' => array(
			'field' => 'setujuCONFIRM', 
			'label' => 'Nominal Transfer', 
			'rules' => 'trim|required|is_numeric'
		),
	);

	function __construct (){
		parent::__construct();
	}

	public function selectall_order($id = NULL) {
		$this->db->select('order.idORDER, kodeORDER, order.createdateORDER, order.totalekspedisiORDER, statusORDER, addressORDER, nameORDER, zipORDER, ekspedisiORDER, telehomeORDER, teleORDER, ketekspedisiORDER, cityORDER, provinceORDER');
		$this->db->select('nameCUSTOMER, emailCUSTOMER, teleCUSTOMER, addressCUSTOMER, cityCUSTOMER, provinceCUSTOMER');
		$this->db->select('SUM(qtydetailORDER * pricedetailORDER) as subtotal');
		$this->db->from('order');
		$this->db->join('customer', 'customer.idCUSTOMER = order.customerORDER');
		$this->db->join('detail_orders', 'detail_orders.idORDER = order.idORDER');
		if($id != NULL){
			$this->db->where('order.idORDER', $id);
		}
		return $this->db->get();
	}

	public function selectall_order_for_order_page() {
		$this->db->select('idORDER, kodeORDER, createdateORDER, statusORDER');
		$this->db->select('nameCUSTOMER');
		$this->db->from('order');
		$this->db->join('customer', 'customer.idCUSTOMER = order.customerORDER');
		
		$this->db->order_by('createdateORDER', 'desc');
		return $this->db->get();
	}

	public function checkkodeorder($kodeorder){
		$this->db->select('kodeORDER');
		$this->db->from('order');
		$this->db->where('kodeORDER', $kodeorder);
		return $this->db->get();
	}
	// gak pakai dulu
	// public function check_latest_data_order($id){
	// 	$query = $this->db->query("SELECT idORDER, nameORDER FROM zigzag_order WHERE createdateORDER IN (SELECT MAX(createdateORDER) FROM zigzag_order WHERE customerORDER = ".$id." GROUP BY customerORDER) ORDER BY createdateORDER DESC");
	// 	return $query->row();
	// }

	public function check_latest_data_order_for_shipping($id){
		$query = $this->db->query("SELECT idORDER, nameORDER, emailORDER, teleORDER, telehomeORDER, provinceORDER, cityORDER, zipORDER, addressORDER, dropshipperORDER, dropshippercompanyORDER FROM zigzag_order WHERE createdateORDER IN (SELECT MAX(createdateORDER) FROM zigzag_order WHERE customerORDER = ".$id." GROUP BY customerORDER) ORDER BY createdateORDER DESC");
		return $query->row();
	}

	public function check_latest_data_order_for_billing($id){
		$query = $this->db->query("SELECT idORDER, paymentORDER FROM zigzag_order WHERE createdateORDER IN (SELECT MAX(createdateORDER) FROM zigzag_order WHERE customerORDER = ".$id." GROUP BY customerORDER) ORDER BY createdateORDER DESC");
		return $query->row();
	}

	public function check_latest_data_order_for_payment($id){
		$query = $this->db->query("SELECT ekspedisiORDER, addressORDER, paymentORDER, totalekspedisiORDER, ketekspedisiORDER FROM zigzag_order WHERE createdateORDER IN (SELECT MAX(createdateORDER) FROM zigzag_order WHERE customerORDER = ".$id." GROUP BY customerORDER) ORDER BY createdateORDER DESC");
		return $query->row();
	}

	public function history_order_customer($id) {
		$this->db->select('order.idORDER, kodeORDER, order.createdateORDER, order.totalekspedisiORDER, statusORDER, addressORDER, nameORDER, zipORDER, ekspedisiORDER, telehomeORDER, teleORDER, cityORDER, provinceORDER');
		$this->db->select('SUM(qtydetailORDER * pricedetailORDER) as subtotal, productdetailORDER');
		$this->db->from('order');
		$this->db->join('detail_orders', 'detail_orders.idORDER = order.idORDER');
		$this->db->where('order.customerORDER',$id);
		$this->db->group_by('detail_orders.idORDER');
		$this->db->order_by('createdateORDER', 'desc');
		return $this->db->get();
	}

	public function success_order($id){

		$query = $this->db->query("SELECT zigzag_order.idORDER, ekspedisiORDER, cityORDER, provinceORDER, addressORDER, paymentORDER, totalekspedisiORDER, ketekspedisiORDER, kodeORDER, zipORDER, SUM(qtydetailORDER * pricedetailORDER) as subtotal FROM zigzag_order INNER JOIN zigzag_detail_orders ON zigzag_order.idORDER = zigzag_detail_orders.idORDER WHERE zigzag_order.createdateORDER IN (SELECT MAX(zigzag_order.createdateORDER) FROM zigzag_order WHERE customerORDER = ".$id." GROUP BY customerORDER) ORDER BY zigzag_order.createdateORDER DESC");
		return $query->row();
	}

	function counts($table=NULL,$filter=NULL){
        $fil = '';
        if($filter != ''){
            $fil="WHERE $filter";
        }
        $query = $this->db->query("SELECT statusORDER FROM $table $fil");
        return $query->num_rows();
    }

     public function list_kodeorder_customer($id) {
		$this->db->select('kodeORDER');
		$this->db->from('order');
		$this->db->where('customerORDER',$id);
		return $this->db->get();
	}

	public function get_all_product_customer_by_kodeorder($id){
		$this->db->select('codeBARANG, nameBARANG');
		$this->db->select('idproductdetailORDER');
		$this->db->from('barang');
		$this->db->join('detail_orders', 'detail_orders.idproductdetailORDER = barang.idBARANG');
		$this->db->where('detail_orders.idORDER',$id);
		return $this->db->get();
	}

	public function get_detail_order_customer_by_idorder($id){
		$this->db->select('idproductdetailORDER, productdetailORDER, pricedetailORDER, qtydetailORDER');
		$this->db->select('codeBARANG');
		$this->db->from('detail_orders');
		$this->db->join('barang', 'barang.idBARANG = detail_orders.idproductdetailORDER');
		$this->db->where('idORDER',$id);
		return $this->db->get();
	}

	public function get_order_customer_by_kodeorder($kode){
		$this->db->select('paymentORDER, totalekspedisiORDER, order.idORDER, statusORDER');
		$this->db->select('SUM(qtydetailORDER * pricedetailORDER) as subtotal');
		$this->db->from('order');
		$this->db->join('detail_orders', 'detail_orders.idORDER = order.idORDER');
		$this->db->where('kodeORDER',$kode);
		return $this->db->get();
	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_join_admin_m extends MY_Model{
	
	protected $_table_name = 'zigzag_menus_admin_join_users_admin';
	protected $_order_by = 'idMENUSJOINADMIN';
	protected $_primary_key = 'idMENUSJOINADMIN';

	function __construct (){
		parent::__construct();
	}

	public function checking_input($idadmin=NULL, $idmenu=NULL){
		$this->db->select('idADMIN, idMENU');
		$this->db->from('menus_admin_join_users_admin');
		$this->db->where('idADMIN', $idadmin);
		$this->db->where('idMENU', $idmenu);

		return $this->db->get();
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_m extends MY_Model{
	
	protected $_table_name = 'zigzag_menus_admin';
	protected $_order_by = 'idMENU';
	protected $_primary_key = 'idMENU';

	public $rules_menu= array(
		'namaMENU' => array(
			'field' => 'namaMENU', 
			'label' => 'Nama Menu', 
			'rules' => 'required'
		),
		'iconMENU' => array(
			'field' => 'iconMENU', 
			'label' => 'Ikon Menu', 
			'rules' => 'required'
		),
		'functionMENU' => array(
			'field' => 'functionMENU', 
			'label' => 'Fungsi Menu', 
			'rules' => 'required'
		)		  
	);

	function __construct (){
		parent::__construct();
	}

	public function get_new(){
		$menu = new stdClass();
		$menu->idMENU = '';
		$menu->namaMENU = '';
		$menu->iconMENU = '';
		$menu->functionMENU = '';
		$menu->parentMENU = '';
		$menu->statusMENU = '';
		return $menu;
	}

	public function selectall_menu($id=NULL){
        $this->db->select('*');
        $this->db->from('menus_admin');
        if($id != NULL){
        	$this->db->where('idMENU', $id);
        }
        return $this->db->get();
    }

    public function select_parents_drop(){
        $this->db->select('idMENU, namaMENU');
        $this->db->from('menus_admin');
        $this->db->where('parentMENU',0);
        $ddown = array();
        foreach ($this->db->get()->result() as $value) {
            $ddown[0] = "Parent";
            $ddown[$value->idMENU] = $value->namaMENU;
        }
        return $ddown;
    }
}
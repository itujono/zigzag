<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attempts_m extends MY_Model{
	
	protected $_table_name = 'zigzag_attempts';
	protected $_order_by = 'idATTEMPTS';
	protected $_primary_key = 'idATTEMPTS';

	function __construct (){
		parent::__construct();
	}

	public function selectallbrute_users(){
		$this->db->select('*');
		$this->db->select('customer.emailCUSTOMER');
		$this->db->from('attempts');
		$this->db->join('customer','customer.idCUSTOMER = attempts.idCUSTOMER');
		return $this->db->get();
	}

	public function checkingbrute_customer($idCUSTOMER = NULL, $valid_attempts = NULL){

		$query = $this->db->query("SELECT timeATTEMPTS FROM zigzag_attempts_customer WHERE idCUSTOMER = ".$idCUSTOMER." AND timeATTEMPTS > ".$valid_attempts." ");
        return $query->num_rows();
	}

	function deletedata_customer($id){
        $this->db->where('idCUSTOMER', $id);
        $this->db->delete('attempts');
    }

    function insertdatabrute_customer($data){
        $this->db->insert('attempts', $data);
    }

	// public function selectallbrute_admin(){
	// 	$this->db->select('*');
	// 	$this->db->select('users_admin.emailADMIN');
	// 	$this->db->from('loginattempts_admin');
	// 	$this->db->join('users_admin','users_admin.idADMIN = loginattempts_admin.idADMIN');
	// 	return $this->db->get();
	// }

	public function checkingbrute_admin($idADMIN = NULL, $valid_attempts = NULL){

		$query = $this->db->query("SELECT timeATTEMPTS FROM zigzag_attempts_admin WHERE idADMIN = ".$idADMIN." AND timeATTEMPTS > ".$valid_attempts." ");
        return $query->num_rows();
	}

	function deletedata_admin($id){
        $this->db->where('idUSER', $id);
        $this->db->delete('attempts_admin');
    }

    function insertdatabrute_admin($data){
        $this->db->insert('attempts_admin', $data);
    }
}
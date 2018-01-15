<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_m extends MY_Model{
	
	protected $_table_name = 'zigzag_customer';
	protected $_order_by = 'idCUSTOMER';
	protected $_primary_key = 'idCUSTOMER';

	public $rules_login_customer = array(
		'emailLogin' => array(
			'field' => 'emailLogin',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email'
			),
		'passwordLogin' => array(
			'field' => 'passwordLogin',
			'label' => 'Kata sandi',
			'rules' => 'trim|required|min_length[8]'
			),
	);

	public $rules_save_customer = array(
		'nameCUSTOMER' => array(
			'field' => 'nameCUSTOMER',
			'label' => 'Nama',
			'rules' => 'trim|required'
			),
		'emailCUSTOMER' => array(
			'field' => 'emailCUSTOMER',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email|is_unique[zigzag_customer.emailCUSTOMER]'
			),
		'passwordCUSTOMER' => array(
			'field' => 'passwordCUSTOMER',
			'label' => 'Kata sandi',
			'rules' => 'trim|required|min_length[8]'
			),
		'addressCUSTOMER' => array(
			'field' => 'addressCUSTOMER',
			'label' => 'Domisili',
			'rules' => 'trim|required|min_length[8]'
			),
		'cityCUSTOMER' => array(
			'field' => 'cityCUSTOMER',
			'label' => 'Kota',
			'rules' => 'trim|required'
			),
		'zipCUSTOMER' => array(
			'field' => 'zipCUSTOMER',
			'label' => 'Kota',
			'rules' => 'trim|required|min_length[5]|max_length[5]'
			),
		'teleCUSTOMER' => array(
			'field' => 'teleCUSTOMER',
			'label' => 'No. Telepon',
			'rules' => 'trim|required|is_unique[zigzag_customer.teleCUSTOMER]|is_numeric'
			),
		'skCUSTOMER' => array(
			'field' => 'skCUSTOMER',
			'label' => 'Syarat & Ketentuan',
			'rules' => 'required'
			)
	);

	public $rules_changepassword_customer = array(
		'passwordCUSTOMER' => array(
			'field' => 'passwordCUSTOMER',
			'label' => 'Kata sandi',
			'rules' => 'trim|required|min_length[8]'
			),
		'repasswordCUSTOMER' => array(
			'field' => 'repasswordCUSTOMER',
			'label' => 'Ulangi kata sandi',
			'rules' => 'trim|required|min_length[8]'
			)
		);

	function __construct (){
		parent::__construct();
	}

	public function hash ($string){
		return hash('sha512', $string . config_item('encryption_key'));
	}

	public function login($email, $pass){

		$datalog = array(
			'emailCUSTOMER' => $email,
			'passwordCUSTOMER' => $this->hash($pass)
		);

		$customer = $this->db->get_where('zigzag_customer',$datalog)->row();
		if(count($customer)){
			if($customer->statusCUSTOMER == 1){
				$data = array(
					'Email' => $customer->emailCUSTOMER,
					'idCUSTOMER' => $customer->idCUSTOMER,
					'Name' => $customer->nameCUSTOMER,
					'loggedin' => TRUE
				);
				$this->session->set_userdata($data);
				return "CUSTOMER";
			} else {
				return "NOT ACTIVE";
			}
			
		}
	}

	public function logout(){
		$this->session->sess_destroy();
	}

	public function selectall_customer($id=NULL){
		$this->db->select('*');
		$this->db->from('customer');
		if($id != NULL){
			$this->db->where('idCUSTOMER', $id);
		}
		return $this->db->get();
	}

	public function checkcustomer($email=NULL, $id=NULL){
		$this->db->select('idCUSTOMER, emailCUSTOMER');
		$this->db->from('customer');
		if($email != NULL){
			$this->db->where('emailCUSTOMER', $email);
		}
		if($id != NULL){
			$this->db->where('idCUSTOMER', $id);
		}
		$this->db->limit(1);
		return $this->db->get();
	}

	public function checkoldpassword($id){
		$this->db->select('idCUSTOMER, passwordCUSTOMER');
		$this->db->from('users');
		$this->db->where('idCUSTOMER', $id);
		$this->db->limit(1);
		return $this->db->get();
	}
}
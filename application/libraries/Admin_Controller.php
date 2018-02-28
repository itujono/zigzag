<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller{

	function __construct (){
		parent::__construct();
		$this->load->helper('codewell');

		$this->data['folBACKEND'] = $this->data['folder_admin'];
		$this->data['backendDIR'] = 'templates/backend/';
        $this->data['asback'] = 'assets/backend/templates/';
		$this->data['asbackbower'] = 'assets/backend/bower_components/';
		$this->data['rootDIR'] = 'templates/';
        $this->data['asfront'] = 'assets/frontend/';
        $this->data['emailadmin'] = '';
        
        if($this->session->userdata('loggedin') != TRUE || $this->session->userdata('is_admin') != 1) {
            $data = array(
                'title' => 'Warning',
                'type' => 'danger',
                'text' => 'You should login first!'
            );
            $this->session->set_flashdata('message',$data);
            redirect('login');
        }

        $url = $this->uri->segment(3);
        $idsession = $this->session->userdata('idADMIN');

        $find_menu_id = find_row__menu($url);
        if(!empty($find_menu_id)){
            $find_menu = find_menu_for_admin_user($idsession, $find_menu_id->idMENU);
            if(empty($find_menu)) {
                $data = array(
                    'title' => 'Warning',
                    'type' => 'danger',
                    'text' => 'You are not allowed to access that menu.'
                );
                $this->session->set_flashdata('message',$data);
                redirect('zigzagadmin/dashboard/index_dashboard');
            }
        }
	}

	function mail_config(){
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = ''; 
        $config['smtp_port'] = '587'; 
        $config['smtp_timeout'] = 30;
        $config['smtp_user'] = '';
        $config['smtp_pass'] = '';
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['validate'] = TRUE;
        $config['newline'] = "\r\n";
        return $config;
    }
}
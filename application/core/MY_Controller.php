<?php
class MY_Controller extends CI_Controller {
	
	public $data = array();
	public function __construct() {
		parent::__construct();
		$this->data['folder_admin'] = 'zigzagadmin/';
	}
	
}
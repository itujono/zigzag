<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notfound extends Frontend_Controller {

	public function index() {
        $this->load->view('notfound');
	}
}

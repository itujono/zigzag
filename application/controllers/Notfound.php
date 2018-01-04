<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notfound extends Frontend_Controller {

	public function index() {
		record_activity('Mengunjungi halaman yang di-request '.base_url(uri_string()));
        $this->load->view('notfound');
	}
}

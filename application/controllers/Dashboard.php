<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function index() {
        if ($this->require_group('employee')) {
			$data['page'] = 'dashboard';
			$data['page_title'] = 'Dashboard';
            $this->load->view('template/default/main',$data);
        }
    }
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Customer extends CI_Controller {
	public function index() {
		$this->grocery_crud->set_table('customer');

		$output = $this->grocery_crud->render();
		$output->page_title = 'Pelanggan';
		
		$this->load->view('template/default/main',$output);
	}
}

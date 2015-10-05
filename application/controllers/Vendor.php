<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Vendor extends CI_Controller {
	public function index() {
		$this->grocery_crud->set_table('vendor');

		$output = $this->grocery_crud->render();
		$output->page_title = 'Supplier';
		
		$this->load->view('template/default/main',$output);
	}
}

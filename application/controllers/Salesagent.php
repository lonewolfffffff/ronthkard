<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Salesagent extends CI_Controller {
	public function index() {
		$this->grocery_crud->set_table('sales_agent');

		$output = $this->grocery_crud->render();
		
		$output->page_title = 'Agen Penjualan';
		
		$this->load->view('template/default/main',$output);
	}
}

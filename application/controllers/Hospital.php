<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Hospital extends CI_Controller {
	public function index() {
		$this->grocery_crud->set_table('hospital');

		$output = $this->grocery_crud->render();
		$output->page_title = 'Rumah Sakit';
		
		$this->load->view('template/default/main',$output);
	}
}

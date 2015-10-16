<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Patient extends CI_Controller {
	public function index() {
		$this->grocery_crud->set_table('patient');

		$output = $this->grocery_crud->render();
		$output->page_title = 'Pasien';
		
		$this->load->view('template/default/main',$output);
	}
}

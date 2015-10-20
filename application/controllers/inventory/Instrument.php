<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Instrument extends MY_Controller {
	public function index() {
		if($this->require_min_level(1)) {
			$crud = new grocery_CRUD();
		
			$crud->set_table('instrument');
			$crud->set_subject('Instrumen');

			$crud->display_as('ref','Ref')
					->display_as('name','Nama')
					->display_as('unit','Satuan');

			$output = $crud->render();

			$output->page_title = 'Instrumen';

			$this->load->view('template/default/main',$output);
		}
	}
}
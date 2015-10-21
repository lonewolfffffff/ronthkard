<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Instrumentset extends MY_Controller {
	public function index() {
		if($this->require_min_level(1)) {
			$crud = new grocery_CRUD();
			
			$crud->set_subject('Set Instrumen');
			
			$crud->set_table('instrument_set');
			$crud->set_relation('category_id','product_category','name');
			$crud->set_relation('instrument_id','instrument','name');

			$output = $crud->render();

			$output->page_title = 'Set Instrumen';

			$this->load->view('template/default/main',$output);
		}
	}
}


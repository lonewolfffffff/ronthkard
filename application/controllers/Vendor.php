<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Vendor extends MY_Controller {
	public function index() {
		if($this->require_min_level(1)) {
			$crud = new grocery_CRUD();
		
			$crud->where('is_vendor',1);
			$crud->set_table('contact');
			$crud->set_subject('Supplier');
			$crud->columns('name','address','phone','email');

			$crud->add_fields('name','address','phone','email','is_vendor');
			$crud->field_type('is_vendor', 'hidden', 1);
			$crud->edit_fields('name','address','phone','email');
			$crud->required_fields('name','phone');
			
			$crud->display_as('name','Nama')
					->display_as('address','Alamat')
					->display_as('phone','Telpon')
					->display_as('email','Email');

			$output = $crud->render();

			$output->page_title = 'Supplier';

			$this->load->view('template/default/main',$output);
		}
	}
}

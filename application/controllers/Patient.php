<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Patient extends MY_Controller {
	public function index() {
		if($this->require_min_level(1)) {
			$crud = new grocery_CRUD();
		
			$crud->where('is_patient',1);
			$crud->set_table('contact');
			$crud->set_subject('Pasien');
			$crud->columns('name','address','birthdate','phone','email');

			$crud->add_fields('name','address','birthdate','phone','email','is_patient');
			$crud->field_type('is_patient', 'hidden', 1);
			$crud->edit_fields('name','address','birthdate','phone','email');
			$crud->required_fields('name','birthdate','phone');
			
			$crud->display_as('name','Nama')
					->display_as('address','Alamat')
					->display_as('birthdate','Tanggal Lahir')
					->display_as('phone','Telpon')
					->display_as('email','Email');

			$output = $crud->render();

			$output->page_title = 'Pasien';

			$this->load->view('template/default/main',$output);
		}
		
		
	}
}

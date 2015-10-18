<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Hospital extends MY_Controller {
	public function index() {
		if($this->require_min_level(1)) {
			$crud = new grocery_CRUD();

			$crud->where('is_hospital',1);
			$crud->set_table('contact');
			$crud->set_subject('Rumah Sakit');
			$crud->columns('name','address','hospital_contact_person','phone','email');

			$crud->add_fields('name','address','hospital_contact_person','phone','email','hospital_type','is_hospital','is_customer');
			$crud->edit_fields('name','address','hospital_contact_person','phone','email','hospital_type');
			$crud->display_as('name','Nama')
					->display_as('address','Alamat')
					->display_as('hospital_contact_person','Contact Person')
					->display_as('phone','Telpon')
					->display_as('email','Email')
					->display_as('hospital_type','Jenis');

			$crud->required_fields('name','hospital_contact_person','phone');
			$crud->field_type('is_hospital', 'hidden', 1);
			$crud->field_type('is_customer', 'hidden', 1);
			$output = $crud->render();
			$output->page_title = 'Rumah Sakit';

			$this->load->view('template/default/main',$output);
		}
	}
}

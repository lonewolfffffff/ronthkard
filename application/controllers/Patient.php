<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Patient extends CI_Controller {
	public function index() {
		if($this->require_min_level(1)) {
			$crud = new grocery_CRUD();
		
			$crud->where('is_patient',1);
			$crud->set_table('contact');
			$crud->set_subject('Pasien');
			$crud->columns('name','address','birthdate','phone','email');

			$crud->fields('name','address','birthdate','phone','email');
			$crud->display_as('name','Nama')
					->display_as('address','Alamat')
					->display_as('birthdate','Tanggal Lahir')
					->display_as('phone','Telpon')
					->display_as('email','Email');

			$output = $crud->render();

			$output->page_title = 'Tenaga Ahli Medis';

			$this->load->view('template/default/main',$output);
		}
		
		
	}
}

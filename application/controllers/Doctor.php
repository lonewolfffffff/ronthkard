<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Doctor extends MY_Controller {
	public function index() {
		if($this->require_min_level(1)) {
			$crud = new grocery_CRUD();

			$crud->where('is_doctor',1);
			$crud->set_table('contact');
			$crud->set_subject('Dokter');
			$crud->columns('degree','name','other_degree','phone','email','skill_level');

			$crud->add_fields('degree','name','other_degree','phone','email','skill_level','is_doctor','is_sales_agent','is_customer');
			$crud->edit_fields('degree','name','other_degree','phone','email','skill_level','is_doctor','is_sales_agent','is_customer');
			$crud->display_as('degree','Jabatan fungsional')
					->display_as('name','Nama')
					->display_as('other_degree','Sub-spesialis')
					->display_as('phone','Telpon')
					->display_as('skill_level','Tingkatan')
					->display_as('email','Email');

			$crud->callback_add_field('degree',array($this,'degree_field_callback'));
			$crud->callback_edit_field('degree',array($this,'degree_field_callback'));

			$crud->callback_field('name',array($this,'name_field_callback'));

			$crud->callback_field('other_degree',array($this,'other_degree_field_callback'));

			$crud->required_fields('name','phone');
			$crud->field_type('is_doctor', 'hidden', 1);
			$crud->field_type('is_sales_agent', 'hidden', 1);
			$crud->field_type('is_customer', 'hidden', 1);

			$output = $crud->render();

			$output->page_title = 'Dokter';

			$this->load->view('template/default/main',$output);
		}
	}
	
	public function degree_field_callback() {
		return '<input type="text" maxlength="10" name="degree" class="form-control" id="field-degree" placeholder="Prof. Dr.">';
	}
	
	public function name_field_callback($value) {
		return '<strong>dr.</strong><input type="text" maxlength="30" value="'.$value.'" name="name" class="form-control" id="field-name"> <strong>, Sp.OT</strong>';
	}
	
	public function other_degree_field_callback() {
		return '<input type="text" maxlength="10" name="degree" class="form-control" id="field-degree" placeholder="FICS">';
	}
}

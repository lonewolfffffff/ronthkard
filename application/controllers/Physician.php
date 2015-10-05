<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Physician extends CI_Controller {
	public function index() {
		$this->grocery_crud->set_table('physician');
		
		$this->grocery_crud->callback_add_field('degree',array($this,'degree_field_callback'));
		$this->grocery_crud->callback_edit_field('degree',array($this,'degree_field_callback'));
		
		$this->grocery_crud->callback_add_field('name',array($this,'name_field_callback'));
		$this->grocery_crud->callback_edit_field('name',array($this,'name_field_callback'));
		
		$this->grocery_crud->callback_add_field('other_degree',array($this,'other_degree_field_callback'));
		$this->grocery_crud->callback_edit_field('other_degree',array($this,'other_degree_field_callback'));

		$output = $this->grocery_crud->render();
		$output->page_title = 'Dokter';
		
		$this->load->view('template/default/main',$output);
	}
	
	public function degree_field_callback() {
		return '<input type="text" maxlength="10" value="" name="degree" class="form-control" id="field-degree" placeholder="Prof. Dr.">';
	}
	
	public function name_field_callback() {
		return '<input type="text" maxlength="30" value="" name="name" class="form-control" id="field-name"> <strong>,dr. Sp.OT</strong>';
	}
	
	public function other_degree_field_callback() {
		return '<input type="text" maxlength="10" value="" name="degree" class="form-control" id="field-degree" placeholder="FICS">';
	}
}

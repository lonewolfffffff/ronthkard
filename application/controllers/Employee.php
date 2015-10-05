<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Employee extends CI_Controller {
	public function index() {
		$this->grocery_crud->set_table('employee');
		$this->grocery_crud->fields('name','nick_name','gender','birthplace','birthdate','position','date_employed','image','email','address','phone');
		$this->grocery_crud->set_field_upload('image','assets/uploads/files');

		$output = $this->grocery_crud->render();
		$output->page_title = 'Pegawai';
		
		$this->load->view('template/default/main',$output);
	}
}
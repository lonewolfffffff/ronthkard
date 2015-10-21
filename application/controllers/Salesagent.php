<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Salesagent extends MY_Controller {
	public function index() {
		if($this->require_min_level(1)) {
			$crud = new grocery_CRUD();
		
			$crud->where('is_sales_agent',1);
			$crud->set_table('contact');
			$crud->set_subject('Agen Penjualan');
			$crud->columns('name','address','sales_agent_company','phone','email');

			$crud->add_fields('name','address','sales_agent_company','phone','email','is_sales_agent');
			$crud->field_type('is_sales_agent', 'hidden', 1);
			$crud->edit_fields('name','address','sales_agent_company','phone','email');
			$crud->required_fields('name','phone');
			
			$crud->display_as('name','Nama')
					->display_as('address','Alamat')
					->display_as('sales_agent_company','Perusahaan')
					->display_as('phone','Telpon')
					->display_as('email','Email');

			$output = $crud->render();

			$output->page_title = 'Agen Penjualan';

			$this->load->view('template/default/main',$output);
		}
		
		
	}
}

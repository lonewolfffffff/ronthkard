<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Salesagent extends MY_Controller {
	public function index() {
		if($this->require_min_level(1)) {
			$crud = new grocery_CRUD();
		
			$crud->where('is_sales_agent',1);
			$crud->set_table('contact');
			$crud->set_subject('Agen Penjualan');
			$crud->columns('name','address','sales_agent_company','phone','email');

			$crud->fields('name','address','sales_agent_company','phone','email');
			$crud->display_as('name','Nama')
					->display_as('address','Alamat')
					->display_as('sales_agent_company','Perusahaan')
					->display_as('phone','Telpon')
					->display_as('email','Email');

			$crud->unset_export();
			$crud->unset_print();
			$output = $crud->render();

			$output->page_title = 'Agen Penjualan';

			$this->load->view('template/default/main',$output);
		}
		
		
	}
}

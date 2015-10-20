<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Category extends MY_Controller {
	public function index() {
		if($this->require_min_level(1)) {
			$crud = new grocery_CRUD();
		
			$crud->set_table('product_category');
			$crud->set_subject('Kategori Produk');

			$crud->display_as('name','Nama')
					->display_as('description','Keterangan')
					->display_as('price','Harga');

			$output = $crud->render();

			$output->page_title = 'Kategori Produk';

			$this->load->view('template/default/main',$output);
		}
	}
}
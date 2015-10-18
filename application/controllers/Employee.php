<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Employee extends MY_Controller {
	public function index() {
		if($this->require_min_level(1)) {
			$crud = new grocery_CRUD();

			$crud->where('is_employee',1);
			$crud->set_table('contact');
			$crud->set_subject('Pegawai');
			$crud->columns('image','name','position','phone','email');

			$crud->add_fields('image','name','nick_name','position','address','phone','gender','birthplace','birthdate','date_employed','email','is_employee','is_sales_agent','user_id');
			$crud->edit_fields('image','name','nick_name','position','address','phone','gender','birthplace','birthdate','date_employed','date_resign','email','is_sales_agent','user_id');
			$crud->display_as('image','Foto')
					->display_as('name','Nama')
					->display_as('nick_name','Panggilan')
					->display_as('position','Jabatan')
					->display_as('address','Alamat')
					->display_as('phone','Telpon')
					->display_as('birthplace','Tempat lahir')
					->display_as('birthdate','Tanggal lahir')
					->display_as('date_employed','Mulai bekerja')
					->display_as('date_resign','Berhenti bekerja')
					->display_as('email','Email')
					->display_as('is_sales_agent','Agen Penjualan')
					->display_as('user_id','User');

			$crud->required_fields('name','phone');
			
			$crud->callback_field('is_sales_agent',array($this,'is_sales_agent_field_callback'));
			
			$crud->field_type('is_employee', 'hidden', 1);
			
			$crud->set_field_upload('image','assets/uploads/files');
			$crud->set_primary_key('user_id','app_user');
			$crud->set_relation('user_id','app_user','{user_name} ({user_email})');

			$output = $crud->render();

			$output->page_title = 'Pegawai';

			$this->load->view('template/default/main',$output);
		}
	}
	
	public function is_sales_agent_field_callback($value) {
		$data = array(
			'name'=>'is_sales_agent',
			'id'=>'field-is_sales_agent',
		);
		$component = form_radio($data,1,$value).form_label('Ya','field-is_sales_agent');
		
		$data['id'] = 'field-is_not_sales_agent';
		$data['style'] = 'margin-left:20px;';
		$component .= form_radio($data,0,$value!=1).form_label('Tidak','field-is_not_sales_agent');
		return $component;
	}
}
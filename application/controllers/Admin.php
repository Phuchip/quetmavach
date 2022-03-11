<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(['array','functions']);
		$this->load->model('Admin_model');
		$this->load->library('session');
		$this->load->library('pagination');
	}

	public function index()
	{
		$this->load->view('admin/login', FALSE);
	}
	public function admin_login(){
		$adminData = $this->input->post('adminData');
		if ($adminData) {
			$username = $adminData['username'];
			$password = $adminData['password'];

			$data_select = 'id, username, name, email, password, image, is_admin';
			$condition= array('username'  => $username, 'password' => md5($password));
			$getAdmin= $this->Admin_model->select_data('tbl_admin',$data_select,$condition,null,null, null, null,0);

			if ($getAdmin) {
				$this->session->set_userdata('admin',$getAdmin);

				$data=array('kq'=>true,'msg'=>"Đăng nhập thành công.", 'session'=> $_SESSION['admin']);
			}else if(!$getAdmin){
				if ($username != $getAdmin['username'] || md5($password) != $getAdmin['password']) {
					$data=array('kq'=>false,'msg'=>"Tên hoặc mật khẩu không đúng. Vui lòng nhập lại.");
				}
			}  
		}
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}
	public function list_account(){
		if ($this->session->userdata('admin')){
			$data['css'] =
				[ 
					'/assets/admin/dist/css/jquery.dataTables.min.css',
					'/assets/css/paginate.css'
				];
			$data['js'] = 
			[
				'/assets/admin/js/datatable.js',
				'/assets/admin/dist/js/jquery.dataTables.min.js'

			];

			$data_select = "username, name, email, password, id";
			$condition= array('is_admin !='  => 1);
			$orderBy = array('create_date'  => "DESC");
			$list_account = $this->Admin_model->select_data('tbl_admin',$data_select,$condition,null,$orderBy, null, null,1);

			
					
			$config['base_url'] = base_url()."admin/list_account";
			$config['total_rows'] = count($list_account);
			$config['per_page'] = 2;
			$config['uri_segment'] = 2;
			$config['num_links'] = 2;
			$config['use_page_numbers'] = true;
	        $config['page_query_string'] = true;
	        $config['query_string_segment'] = 'page';
			$config['full_tag_open'] = '<div class="t_paginate_group">';
			$config['full_tag_close'] = '</div>';
			$config['first_link'] = 'Đầu';
			$config['first_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['first_tag_close'] = '</button>';
	        $config['num_tag_open'] = '<button class="t_paginate_item">';
	        $config['num_tag_close']    = '</button>';
	        $config['last_link'] = "Cuối";
	        $config['last_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['last_tag_close'] = '</button>';
	        $config['prev_link'] = '<span class="t_paginate_icon t_paginate_pre"></span>';
	        $config['prev_tag_open'] = '<button class="t_paginate_item">';
	        $config['prev_tag_close'] = '</button>';
	        $config['next_link'] = '<span class="t_paginate_icon t_paginate_next"></span>';
	        $config['next_tag_open'] = '<button class="t_paginate_item">';
	        $config['next_tag_close'] = '</button>';

	        $config['cur_tag_open'] = '<button class="t_paginate_item t_paginate_active">';
	        $config['cur_tag_close'] = '</button>';
			
	        $this->pagination->initialize($config);
			$page = $this->input->get('page');  

			if($page > 1){
				$page = ($page - 1) * $config["per_page"];
			}else{
				$page = 0;
			}

			$data["links"] = $this->pagination->create_links();
	    	$datanews= $this->Admin_model->select_data('tbl_admin',$data_select,$condition,null,$orderBy, $config["per_page"], $page,1);
	    	$data['list_account'] = json_decode(json_encode($datanews),true);
			$data['content'] = 'admin/list_account';

			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function add_account()//
	{
		if ($this->session->userdata('admin')){
			$data['css'] =
			[ 
				'/assets/admin/dist/css/custom_style.css'
			];
			$data['js'] = 
			[
				'/assets/admin/js/account.js'

			];
			$condition = array('mod_id !='=> '11', 'mod_id <>'=>'12');
			$data['admin_module']= $this->Admin_model->select_data('modules','mod_id,mod_name', $condition,null,array('mod_order'=>'ASC'),null,null,1);

			$data['content'] = 'admin/add_account';

			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function ajax_add_account(){
		$result=['kq'=>false,'data'=>''];
		$formData = $this->input->post('formData');

		$condition= array('username'  => $formData['name']);
		$check_name = $this->Admin_model->select_data('tbl_admin','*',$condition,null,null, null, null,1);

		if ($check_name) {
			$result=['kq'=>false,'msg'=>"Tên đăng nhập đã tồn tại."];
		}else{
			$data_insert = [
				"username" => $formData['name'],
				"name"=> $formData['fullname'],
				"phone"=> $formData['phone'],
				"password"=> md5($formData['password']),
				"email"=> $formData['email'],
				"create_date"=> time()
			];
			$insert_admin = $this->Admin_model->insert_data('tbl_admin',$data_insert);
			$id_admin = $this->db->insert_id();

			if (isset($formData['modul'])) {
				$modul = $formData['modul'];
				$count = count($modul);

				for($i = 0; $i < $count;$i++){
					$data_right = [
						"adu_admin_id" => $id_admin,
						"adu_admin_module_id"=> $modul[$i]
					];
					$this->Admin_model->insert_data('admin_user_right', $data_right);	
				}
			}
			$result=['kq'=>true,'msg'=>"Thêm tài khoản thành công."];
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	public function edit_account($id)//
	{
		if ($this->session->userdata('admin')){
			$data['css'] =
			[ 
				'/assets/admin/dist/css/custom_style.css'
			];
			$data['js'] = 
			[
				'/assets/admin/js/account.js'

			];

			$data['info_admin']= $this->Admin_model->select_data('tbl_admin','*',array('id' => $id),null,null, null, null,0);
			$condition = array('mod_id !='=> '11', 'mod_id <>'=>'12');
			$data['admin_module']= $this->Admin_model->select_data('modules','mod_id,mod_name', $condition,null,array('mod_order'=>'ASC'),null,null,1);

			$data['content'] = 'admin/edit_account';

			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function ajax_edit_account(){
		$formData = $this->input->post('formData');
		$condition= array('username'  => $formData['name']);
		$check_name = $this->Admin_model->select_data('tbl_admin','*',$condition,null,null, null, null,1);

		if($formData['password'] != ''){
			$data_update = [
				"username" => $formData['name'],
				"name"=> $formData['fullname'],
				"phone"=> $formData['phone'],
				"password"=> md5($formData['password']),
				"email"=> $formData['email'],
				"create_date"=> time()
			];
        }else{
            $data_update = [
				"username" => $formData['name'],
				"name"=> $formData['fullname'],
				"phone"=> $formData['phone'],
				"email"=> $formData['email'],
				"create_date"=> time()
			];
        }
		$update_admin = $this->Admin_model->update_data('tbl_admin',$data_update,array('id' => $formData['id']));

		$delete_role= $this->Admin_model->delete_data('admin_user_right', array('adu_admin_id' => $formData['id']));
		if (isset($formData['modul'])) {
			$modul = $formData['modul'];
			$count = count($modul);
			for($i = 0; $i < $count;$i++){
				$data_right = [
					"adu_admin_id" => $formData['id'],
					"adu_admin_module_id"=> $modul[$i]
				];
				$this->Admin_model->insert_data('admin_user_right', $data_right);	
			}
		}
		$result=['kq'=>true,'msg'=>"Cập nhật tài khoản thành công."];
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	public function delete_account($id)
	{
		if ($this->session->userdata('admin')){

			$delete_account= $this->Admin_model->delete_data('tbl_admin',array('id' => $id));
			$delete_role= $this->Admin_model->delete_data('admin_user_right',array('adu_admin_id' => $id));

			redirect('/admin/list_account','refresh');
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function change_pass()
	{
		if ($this->session->userdata('admin')){
			$data['css'] =
			[ 
				'/assets/admin/dist/css/custom_style.css'
			];
			$data['js'] = 
			[
				'/assets/admin/js/account.js'

			];

			$data['content'] = 'admin/change_pass';
			$email = $this->session->userdata('admin');
			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function change_password_account()
	{
		if ($this->session->userdata('admin')) {
			$formPass = $this->input->post("formPass");
			if($formPass){
				$password_old = $formPass['password_old'];
				$password = $formPass['password'];

				$session = $this->session->userdata('admin');
				$get_pass = $this->Admin_model->select_data('tbl_admin','*',array('username' => $session['username']),null,null, null, null,0);;
				if ($get_pass['password'] != md5($password_old)) {
					$result=['kq'=>false,'msg'=>"Nhập mật khẩu cũ không đúng."];
				}else{
					$this->Admin_model->update_data('tbl_admin',array('password' => md5($password)), array('username' => $session['username']));
					$result=['kq'=>true,'msg'=>"Đổi mật khẩu thành công."];
				}
			}
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
		}else{
			redirect('/admin','refresh');
		}
	}
	public function list_manufacturer()
	{
		if ($this->session->userdata('admin')){
			$data['css'] =
				[ 
					'/assets/admin/dist/css/jquery.dataTables.min.css',
					'/assets/css/paginate.css'
				];
			$data['js'] = 
			[
				'/assets/admin/js/datatable.js',
				'/assets/admin/dist/js/jquery.dataTables.min.js'

			];
			$data_select = "id, name, created_time, modify_time, status";
			$list_manufacturer = $this->Admin_model->select_data('tbl_manufacturer',$data_select,null,null,array('id'  => "DESC"), null, null,1);

			$this->load->library('pagination');
					
			$config['base_url'] = base_url()."admin/list_manufacturer";
			$config['total_rows'] = count($list_manufacturer);
			$config['per_page'] = 10;
			$config['uri_segment'] = 2;
			$config['num_links'] = 2;
			$config['use_page_numbers'] = true;
	        $config['page_query_string'] = true;
	        $config['query_string_segment'] = 'page';
			$config['full_tag_open'] = '<div class="t_paginate_group">';
			$config['full_tag_close'] = '</div>';
			$config['first_link'] = 'Đầu';
			$config['first_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['first_tag_close'] = '</button>';
	        $config['num_tag_open'] = '<button class="t_paginate_item">';
	        $config['num_tag_close']    = '</button>';
	        $config['last_link'] = "Cuối";
	        $config['last_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['last_tag_close'] = '</button>';
	        $config['prev_link'] = '<span class="t_paginate_icon t_paginate_pre"></span>';
	        $config['prev_tag_open'] = '<button class="t_paginate_item">';
	        $config['prev_tag_close'] = '</button>';
	        $config['next_link'] = '<span class="t_paginate_icon t_paginate_next"></span>';
	        $config['next_tag_open'] = '<button class="t_paginate_item">';
	        $config['next_tag_close'] = '</button>';

	        $config['cur_tag_open'] = '<button class="t_paginate_item t_paginate_active">';
	        $config['cur_tag_close'] = '</button>';
			
	        $this->pagination->initialize($config);
			$page = $this->input->get('page');  

			if($page > 1){
				$page = ($page - 1) * $config["per_page"];
			}else{
				$page = 0;
			}
			$data["links"] = $this->pagination->create_links();
	    	$datanews= $this->Admin_model->select_data('tbl_manufacturer',$data_select,null,null,array('id'  => "DESC"),$config["per_page"], $page,1);
	    	$data['list_manufacturer'] = json_decode(json_encode($datanews),true);

			$data['content'] = 'admin/list_manufacturer';
			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function add_edit_manufacturer()
	{
		if ($this->session->userdata('admin')){
			$data['js'] = 
			[
				'/assets/admin/js/category.js'
			];
			$id = $this->input->get('id');
			if (isset($id) && $id != NULL) {
				$data['type'] = "edit";
				$data['manufacturer'] = $this->Admin_model->select_data('tbl_manufacturer','*',array('id'  => $id),null,null, null, null,0);
			}else{
				$data['type'] = "add";
			}
			$data['content'] = 'admin/add_edit_manufacturer';

			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function ajax_add_edit_manufacturer(){
		$result=['kq'=>false,'data'=>''];
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$status = $this->input->post('status');
		$submit = $this->input->post('submit');
		$date = strtotime(date('Y-m-d H:i:s'));
		$alias = changeToSlug($name);
		
		if ($submit == "add") {
			$check_name = $this->Admin_model->select_data('tbl_manufacturer','id',array('name'  => $name),null,null, null, null,1);
		}else if ($submit == "edit") {
			$check_name = $this->Admin_model->select_data('tbl_manufacturer','id',array('name'  => $name, 'id !=' => $id),null,null, null, null,1);
		}
		if ($check_name) {
			$result=['kq'=>false,'msg'=>"Tên hãng sản xuất đã tồn tại."];
		}else{
			if ($submit == "add"){
				$data_insert = [
					"name"=> $name,
					'alias'=> $alias,
					"created_time"=> $date,
					"status"=> $status
				];
				$is_up_manufacturer = $this->Admin_model->insert_data('tbl_manufacturer', $data_insert);
				$result=['kq'=>true,'msg'=>"Thêm mới thành công."];
			}else{
				$data_update = [
					"name"=> $name,
					"modify_time"=> $date,
					"status"=> $status
				];
				$condition = [
					"id"=> $id
				];
				$is_up_manufacturer = $this->Admin_model->update_data('tbl_manufacturer', $data_update, $condition);
				$result=['kq'=>true,'msg'=>"Cập nhật thành công."];
			}
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	public function delete_manufacturer($id)
	{
		if ($this->session->userdata('admin')){
			$condition = [
				"id"=> $id
			];
			$delete_manufacturer= $this->Admin_model->delete_data('tbl_manufacturer', $condition);
			redirect('/admin/list_manufacturer','refresh');
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function list_category()
	{
		if ($this->session->userdata('admin')){
			$data['css'] =
				[ 
					'/assets/admin/dist/css/jquery.dataTables.min.css',
					'/assets/css/paginate.css'
				];
			$data['js'] = 
			[
				'/assets/admin/js/datatable.js',
				'/assets/admin/dist/js/jquery.dataTables.min.js'

			];
			$data_select = "id, name, created_time, modify_time, status";
			$orderBy = array('id'  => "DESC");
			$list_category = $this->Admin_model->select_data('tbl_category',$data_select,null,null,$orderBy, null, null,1);

					
			$config['base_url'] = base_url()."admin/list_category";
			$config['total_rows'] = count($list_category);
			$config['per_page'] = 10;
			$config['uri_segment'] = 2;
			$config['num_links'] = 2;
			$config['use_page_numbers'] = true;
	        $config['page_query_string'] = true;
	        $config['query_string_segment'] = 'page';
			$config['full_tag_open'] = '<div class="t_paginate_group">';
			$config['full_tag_close'] = '</div>';
			$config['first_link'] = 'Đầu';
			$config['first_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['first_tag_close'] = '</button>';
	        $config['num_tag_open'] = '<button class="t_paginate_item">';
	        $config['num_tag_close']    = '</button>';
	        $config['last_link'] = "Cuối";
	        $config['last_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['last_tag_close'] = '</button>';
	        $config['prev_link'] = '<span class="t_paginate_icon t_paginate_pre"></span>';
	        $config['prev_tag_open'] = '<button class="t_paginate_item">';
	        $config['prev_tag_close'] = '</button>';
	        $config['next_link'] = '<span class="t_paginate_icon t_paginate_next"></span>';
	        $config['next_tag_open'] = '<button class="t_paginate_item">';
	        $config['next_tag_close'] = '</button>';

	        $config['cur_tag_open'] = '<button class="t_paginate_item t_paginate_active">';
	        $config['cur_tag_close'] = '</button>';
			
	        $this->pagination->initialize($config);
			$page = $this->input->get('page');  

			if($page > 1){
				$page = ($page - 1) * $config["per_page"];
			}else{
				$page = 0;
			}
			$data["links"] = $this->pagination->create_links();
	    	$datanews= $this->Admin_model->select_data('tbl_category',$data_select,null,null,$orderBy,$config["per_page"], $page,1);
	    	$data['list_category'] = json_decode(json_encode($datanews),true);

			$data['content'] = 'admin/list_category';
			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function delete_category($id)
	{
		if ($this->session->userdata('admin')){

			$condition = [
				"id"=> $id
			];
			$delete_category= $this->Admin_model->delete_data('tbl_category', $condition);
			redirect('/admin/list_category','refresh');
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function add_edit_category()
	{
		if ($this->session->userdata('admin')){
			$data['js'] = 
			[
				'/assets/admin/js/category.js'
			];
			$id = $this->input->get('id');
			if (isset($id) && $id != NULL) {
				$data['type'] = "edit";
				$data['category'] = $this->Admin_model->select_data('tbl_category','*',array('id'  => $id),null,null, null, null,0);
			}else{
				$data['type'] = "add";
			}
			$data['content'] = 'admin/add_edit_category';

			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function ajax_add_edit_category(){
		$result=['kq'=>false,'data'=>''];
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$status = $this->input->post('status');
		$submit = $this->input->post('submit');
		$date = strtotime(date('Y-m-d H:i:s'));
		
		if ($submit == "add") {
			$check_name = $this->Admin_model->select_data('tbl_category','id',array('name'  => $name),null,null, null, null,1);
		}else if ($submit == "edit") {
			$condition= array('name'  => $name, 'id !=' => $id);
			$check_name = $this->Admin_model->select_data('tbl_category','id',array('name'  => $name, 'id !=' => $id),null,null, null, null,1);
		}

		if ($check_name) {
			$result=['kq'=>false,'msg'=>"Tên hãng sản xuất đã tồn tại."];
		}else{
			if ($submit == "add"){
				$data_insert = [
					"name"=> $name,
					"created_time"=> $date,
					"status"=> $status
				];
				$is_up_manufacturer = $this->Admin_model->insert_data('tbl_category', $data_insert);
				$result=['kq'=>true,'msg'=>"Thêm mới thành công."];
			}else{
				$data_update = [
					"name"=> $name,
					"modify_time"=> $date,
					"status"=> $status
				];
				$condition = [
					"id"=> $id
				];
				$is_up_manufacturer = $this->Admin_model->update_data('tbl_category', $data_update, $condition);
				$result=['kq'=>true,'msg'=>"Cập nhật thành công."];
			}
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	public function list_ray_type()
	{
		if ($this->session->userdata('admin')){
			$data['css'] =
				[ 
					'/assets/admin/dist/css/jquery.dataTables.min.css',
					'/assets/css/paginate.css'
				];
			$data['js'] = 
			[
				'/assets/admin/js/datatable.js',
				'/assets/admin/dist/js/jquery.dataTables.min.js'

			];
			$data_select = "id, name, created_time, modify_time, status";
			$list_ray_type = $this->Admin_model->select_data('tbl_ray_type',$data_select,null,null,array('id'  => "DESC"), null, null,1);

			$this->load->library('pagination');
					
			$config['base_url'] = base_url()."admin/list_ray_type";
			$config['total_rows'] = count($list_ray_type);
			$config['per_page'] = 10;
			$config['uri_segment'] = 2;
			$config['num_links'] = 2;
			$config['use_page_numbers'] = true;
	        $config['page_query_string'] = true;
	        $config['query_string_segment'] = 'page';
			$config['full_tag_open'] = '<div class="t_paginate_group">';
			$config['full_tag_close'] = '</div>';
			$config['first_link'] = 'Đầu';
			$config['first_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['first_tag_close'] = '</button>';
	        $config['num_tag_open'] = '<button class="t_paginate_item">';
	        $config['num_tag_close']    = '</button>';
	        $config['last_link'] = "Cuối";
	        $config['last_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['last_tag_close'] = '</button>';
	        $config['prev_link'] = '<span class="t_paginate_icon t_paginate_pre"></span>';
	        $config['prev_tag_open'] = '<button class="t_paginate_item">';
	        $config['prev_tag_close'] = '</button>';
	        $config['next_link'] = '<span class="t_paginate_icon t_paginate_next"></span>';
	        $config['next_tag_open'] = '<button class="t_paginate_item">';
	        $config['next_tag_close'] = '</button>';

	        $config['cur_tag_open'] = '<button class="t_paginate_item t_paginate_active">';
	        $config['cur_tag_close'] = '</button>';
			
	        $this->pagination->initialize($config);
			$page = $this->input->get('page');  

			if($page > 1){
				$page = ($page - 1) * $config["per_page"];
			}else{
				$page = 0;
			}
			$data["links"] = $this->pagination->create_links();
	    	$datanews= $this->Admin_model->select_data('tbl_ray_type',$data_select,null,null,array('id'  => "DESC"),$config["per_page"], $page,1);
	    	$data['list_ray'] = json_decode(json_encode($datanews),true);

			$data['content'] = 'admin/list_ray_type';
			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function delete_ray($id)
	{
		if ($this->session->userdata('admin')){
			$condition = [
				"id"=> $id
			];
			$delete_ray= $this->Admin_model->delete_data('tbl_ray_type', $condition);
			redirect('/admin/list_ray_type','refresh');
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function add_edit_ray()
	{
		if ($this->session->userdata('admin')){
			$data['js'] = 
			[
				'/assets/admin/js/category.js'
			];
			$id = $this->input->get('id');
			if (isset($id) && $id != NULL) {
				$data['type'] = "edit";
				$data['category'] = $this->Admin_model->select_data('tbl_ray_type','*',array('id'  => $id),null,null, null, null,0);
			}else{
				$data['type'] = "add";
			}
			$data['content'] = 'admin/add_edit_ray';

			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function ajax_add_edit_ray(){
		$result=['kq'=>false,'data'=>''];
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$status = $this->input->post('status');
		$submit = $this->input->post('submit');
		$date = strtotime(date('Y-m-d H:i:s'));
		
		if ($submit == "add") {
			$check_name = $this->Admin_model->select_data('tbl_ray_type','id',array('name'  => $name),null,null, null, null,1);
		}else if ($submit == "edit") {
			$check_name = $this->Admin_model->select_data('tbl_ray_type','id',array('name'  => $name, 'id !=' => $id),null,null, null, null,1);
		}
		$check_name = $this->Admin_model->check_add_edit_ray($id, $name, $submit);

		if ($check_name) {
			$result=['kq'=>false,'msg'=>"Tên loại tia đã tồn tại."];
		}else{
			if ($submit == "add"){
				$data_insert = [
					"name"=> $name,
					"created_time"=> $date,
					"status"=> $status
				];
				$is_up_manufacturer = $this->Admin_model->insert_data('tbl_ray_type', $data_insert);
				$result=['kq'=>true,'msg'=>"Thêm mới thành công."];
			}else{
				$data_update = [
					"name"=> $name,
					"modify_time"=> $date,
					"status"=> $status
				];
				$condition = [
					"id"=> $id
				];
				$is_up_manufacturer = $this->Admin_model->update_data('tbl_ray_type', $data_update, $condition);
				$result=['kq'=>true,'msg'=>"Cập nhật thành công."];
			}
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	public function list_style()
	{
		if ($this->session->userdata('admin')){
			$data['css'] =
				[ 
					'/assets/admin/dist/css/jquery.dataTables.min.css',
					'/assets/css/paginate.css'
				];
			$data['js'] = 
			[
				'/assets/admin/js/datatable.js',
				'/assets/admin/dist/js/jquery.dataTables.min.js'

			];
			$data_select = "id, name, created_time, modify_time, status";
			$list_style = $this->Admin_model->select_data('tbl_style',$data_select,null,null,array('id'  => "DESC"), null, null,1);

			$this->load->library('pagination');
					
			$config['base_url'] = base_url()."admin/list_style";
			$config['total_rows'] = count($list_style);
			$config['per_page'] = 10;
			$config['uri_segment'] = 2;
			$config['num_links'] = 2;
			$config['use_page_numbers'] = true;
	        $config['page_query_string'] = true;
	        $config['query_string_segment'] = 'page';
			$config['full_tag_open'] = '<div class="t_paginate_group">';
			$config['full_tag_close'] = '</div>';
			$config['first_link'] = 'Đầu';
			$config['first_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['first_tag_close'] = '</button>';
	        $config['num_tag_open'] = '<button class="t_paginate_item">';
	        $config['num_tag_close']    = '</button>';
	        $config['last_link'] = "Cuối";
	        $config['last_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['last_tag_close'] = '</button>';
	        $config['prev_link'] = '<span class="t_paginate_icon t_paginate_pre"></span>';
	        $config['prev_tag_open'] = '<button class="t_paginate_item">';
	        $config['prev_tag_close'] = '</button>';
	        $config['next_link'] = '<span class="t_paginate_icon t_paginate_next"></span>';
	        $config['next_tag_open'] = '<button class="t_paginate_item">';
	        $config['next_tag_close'] = '</button>';

	        $config['cur_tag_open'] = '<button class="t_paginate_item t_paginate_active">';
	        $config['cur_tag_close'] = '</button>';
			
	        $this->pagination->initialize($config);
			$page = $this->input->get('page');  

			if($page > 1){
				$page = ($page - 1) * $config["per_page"];
			}else{
				$page = 0;
			}
			$data["links"] = $this->pagination->create_links();
	    	$datanews= $this->Admin_model->select_data('tbl_style',$data_select,null,null,array('id'  => "DESC"),$config["per_page"], $page,1);
	    	$data['list_style'] = json_decode(json_encode($datanews),true);

			$data['content'] = 'admin/list_style';
			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function delete_style($id)
	{
		if ($this->session->userdata('admin')){
			$condition = [
				"id"=> $id
			];
			$delete_style= $this->Admin_model->delete_data('tbl_style', $condition);
			redirect('/admin/list_style','refresh');
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function add_edit_style()
	{
		if ($this->session->userdata('admin')){
			$data['js'] = 
			[
				'/assets/admin/js/category.js'
			];
			$id = $this->input->get('id');
			if (isset($id) && $id != NULL) {
				$data['type'] = "edit";
				$data['style'] = $this->Admin_model->select_data('tbl_style','*',array('id'  => $id),null,null, null, null,0);
			}else{
				$data['type'] = "add";
			}
			$data['content'] = 'admin/add_edit_style';

			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function ajax_add_edit_style(){
		$result=['kq'=>false,'data'=>''];
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$status = $this->input->post('status');
		$submit = $this->input->post('submit');
		$date = strtotime(date('Y-m-d H:i:s'));
		
		if ($submit == "add") {
			$check_name = $this->Admin_model->select_data('tbl_style','id',array('name'  => $name),null,null, null, null,1);
		}else if ($submit == "edit") {
			$condition= array('name'  => $name, 'id !=' => $id);
			$check_name = $this->Admin_model->select_data('tbl_style','id',array('name'  => $name, 'id !=' => $id),null,null, null, null,1);
		}
		if ($check_name) {
			$result=['kq'=>false,'msg'=>"Tên kiểu dáng đã tồn tại."];
		}else{
			if ($submit == "add"){
				$data_insert = [
					"name"=> $name,
					"created_time"=> $date,
					"status"=> $status
				];
				$is_up_manufacturer = $this->Admin_model->insert_data('tbl_style', $data_insert);
				$result=['kq'=>true,'msg'=>"Thêm mới thành công."];
			}else{
				$data_update = [
					"name"=> $name,
					"modify_time"=> $date,
					"status"=> $status
				];
				$condition = [
					"id"=> $id
				];
				$is_up_manufacturer = $this->Admin_model->update_data('tbl_style', $data_update, $condition);
				$result=['kq'=>true,'msg'=>"Cập nhật thành công."];
			}
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	public function list_connector()
	{
		if ($this->session->userdata('admin')){
			$data['css'] =
				[ 
					'/assets/admin/dist/css/jquery.dataTables.min.css',
					'/assets/css/paginate.css'
				];
			$data['js'] = 
			[
				'/assets/admin/js/datatable.js',
				'/assets/admin/dist/js/jquery.dataTables.min.js'

			];
			$data_select = "id, name, created_time, modify_time, status";
			$list_connector = $this->Admin_model->select_data('tbl_connector',$data_select,null,null,array('id'  => "DESC"), null, null,1);

			$this->load->library('pagination');
					
			$config['base_url'] = base_url()."admin/list_connector";
			$config['total_rows'] = count($list_connector);
			$config['per_page'] = 10;
			$config['uri_segment'] = 2;
			$config['num_links'] = 2;
			$config['use_page_numbers'] = true;
	        $config['page_query_string'] = true;
	        $config['query_string_segment'] = 'page';
			$config['full_tag_open'] = '<div class="t_paginate_group">';
			$config['full_tag_close'] = '</div>';
			$config['first_link'] = 'Đầu';
			$config['first_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['first_tag_close'] = '</button>';
	        $config['num_tag_open'] = '<button class="t_paginate_item">';
	        $config['num_tag_close']    = '</button>';
	        $config['last_link'] = "Cuối";
	        $config['last_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['last_tag_close'] = '</button>';
	        $config['prev_link'] = '<span class="t_paginate_icon t_paginate_pre"></span>';
	        $config['prev_tag_open'] = '<button class="t_paginate_item">';
	        $config['prev_tag_close'] = '</button>';
	        $config['next_link'] = '<span class="t_paginate_icon t_paginate_next"></span>';
	        $config['next_tag_open'] = '<button class="t_paginate_item">';
	        $config['next_tag_close'] = '</button>';

	        $config['cur_tag_open'] = '<button class="t_paginate_item t_paginate_active">';
	        $config['cur_tag_close'] = '</button>';
			
	        $this->pagination->initialize($config);
			$page = $this->input->get('page');  

			if($page > 1){
				$page = ($page - 1) * $config["per_page"];
			}else{
				$page = 0;
			}
			$data["links"] = $this->pagination->create_links();
	    	$datanews= $this->Admin_model->select_data('tbl_connector',$data_select,null,null,array('id'  => "DESC"),$config["per_page"], $page,1);
	    	$data['list_connector'] = json_decode(json_encode($datanews),true);

			$data['content'] = 'admin/list_connector';
			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function delete_connector($id)
	{
		if ($this->session->userdata('admin')){
			$condition = [
				"id"=> $id
			];
			$delete_connector= $this->Admin_model->delete_data('tbl_connector', $condition);
			redirect('/admin/list_connector','refresh');
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function add_edit_connector()
	{
		if ($this->session->userdata('admin')){
			$data['js'] = 
			[
				'/assets/admin/js/category.js'
			];
			$id = $this->input->get('id');
			if (isset($id) && $id != NULL) {
				$data['type'] = "edit";
				$data['connector'] = $this->Admin_model->select_data('tbl_connector','*',array('id'  => $id),null,null, null, null,0);
			}else{
				$data['type'] = "add";
			}
			$data['content'] = 'admin/add_edit_connector';

			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function ajax_add_edit_connector(){
		$result=['kq'=>false,'data'=>''];
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$status = $this->input->post('status');
		$submit = $this->input->post('submit');
		$date = strtotime(date('Y-m-d H:i:s'));
		
		if ($submit == "add") {
			$check_name = $this->Admin_model->select_data('tbl_connector','id',array('name'  => $name),null,null, null, null,1);
		}else if ($submit == "edit") {
			$condition= array('name'  => $name, 'id !=' => $id);
			$check_name = $this->Admin_model->select_data('tbl_connector','id',array('name'  => $name, 'id !=' => $id),null,null, null, null,1);
		}

		if ($check_name) {
			$result=['kq'=>false,'msg'=>"Tên kết nối đã tồn tại."];
		}else{
			if ($submit == "add"){
				$data_insert = [
					"name"=> $name,
					"created_time"=> $date,
					"status"=> $status
				];
				$is_up_manufacturer = $this->Admin_model->insert_data('tbl_connector', $data_insert);
				$result=['kq'=>true,'msg'=>"Thêm mới thành công."];
			}else{
				$data_update = [
					"name"=> $name,
					"modify_time"=> $date,
					"status"=> $status
				];
				$condition = [
					"id"=> $id
				];
				$is_up_manufacturer = $this->Admin_model->update_data('tbl_connector', $data_update, $condition);
				$result=['kq'=>true,'msg'=>"Cập nhật thành công."];
			}
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	public function list_product()
	{
		if ($this->session->userdata('admin')){
			$data['css'] =
				[ 
					'/assets/admin/dist/css/jquery.dataTables.min.css',
					'/assets/css/paginate.css'
				];
			$data['js'] = 
			[
				'/assets/admin/js/datatable.js',
				'/assets/admin/js/category.js',
				'/assets/admin/dist/js/jquery.dataTables.min.js'

			];
			$orderBy = array('id'  => "DESC");
			$list_product = $this->Admin_model->select_data('tbl_product','*',null,null,$orderBy, null, null,1); 
			$this->load->library('pagination');
					
			$config['base_url'] = base_url()."admin/list_product";
			$config['total_rows'] = count($list_product);
			$config['per_page'] = 10;
			$config['uri_segment'] = 2;
			$config['num_links'] = 2;
			$config['use_page_numbers'] = true;
	        $config['page_query_string'] = true;
	        $config['query_string_segment'] = 'page';
			$config['full_tag_open'] = '<div class="t_paginate_group">';
			$config['full_tag_close'] = '</div>';
			$config['first_link'] = 'Đầu';
			$config['first_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['first_tag_close'] = '</button>';
	        $config['num_tag_open'] = '<button class="t_paginate_item">';
	        $config['num_tag_close']    = '</button>';
	        $config['last_link'] = "Cuối";
	        $config['last_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['last_tag_close'] = '</button>';
	        $config['prev_link'] = '<span class="t_paginate_icon t_paginate_pre"></span>';
	        $config['prev_tag_open'] = '<button class="t_paginate_item">';
	        $config['prev_tag_close'] = '</button>';
	        $config['next_link'] = '<span class="t_paginate_icon t_paginate_next"></span>';
	        $config['next_tag_open'] = '<button class="t_paginate_item">';
	        $config['next_tag_close'] = '</button>';

	        $config['cur_tag_open'] = '<button class="t_paginate_item t_paginate_active">';
	        $config['cur_tag_close'] = '</button>';
			
	        $this->pagination->initialize($config);
			$page = $this->input->get('page');  

			if($page > 1){
				$page = ($page - 1) * $config["per_page"];
			}else{
				$page = 0;
			}
			$data["links"] = $this->pagination->create_links();
	    	$datanews= $this->Admin_model->select_data('tbl_product','*',null,null,$orderBy,$config["per_page"], $page,1);
	    	$data['list_product'] = json_decode(json_encode($datanews),true);

			$data['content'] = 'admin/list_product';
			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function index_product(){
		$result=['kq'=>false,'data'=>''];
		$id = $this->input->post('id');
		$action = $this->input->post('action');

		if ($action == 'show') {
			$data_update = [
				"robots"=> 1
			];
			$condition= array('id'  => $id);
			$index_product = $this->Admin_model->update_data('tbl_product',$data_update, $condition);
			$result=['kq'=>true,'msg'=>"Cập nhật thành công."];
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	public function add_product(){
		if ($this->session->userdata('admin')){
			$data['js'] = 
			[
				'/assets/admin/js/product.js',
				'/ckeditor/ckeditor.js',
			];
			
			$data['manufacturer'] = $this->Admin_model->select_data('tbl_manufacturer','id,name',null,null,null,null,null,1);
			$data['tags'] = $this->Admin_model->select_data('tbl_tags','id,name',null,null,null,null,null,1);
			$data['content'] = 'admin/add_product';

			$this->load->view('admin/main', $data, FALSE);
		}else{	
			redirect('/admin','refresh');	
		}
	}
	public function ajax_add_product(){
		$result=['kq'=>false,'data'=>''];
		// $dataJson = json_decode($formData);
		// $data = object_to_array($dataJson);
		// $formData['alias'] = replaceTitle($formData['name']);
		$parameter = json_encode($this->input->post('parameter'));
	    $parameter = str_replace('\r\n', '|', $parameter);
	    $parameter = json_decode($parameter);
	    
		$data['code_product'] = $this->input->post('code_product');
        $data['name'] = $this->input->post('name');
        $data['status'] = $this->input->post('status');
        $data['category'] = $this->input->post('category');
        $data['ray_style'] = $this->input->post('ray_style');
        $data['manufacturer'] = $this->input->post('manufacturer');
        $data['style'] = $this->input->post('style');
        $data['connector'] = $this->input->post('connector');
        $data['price_old'] = $this->input->post('price_old');
        $data['quantity'] = $this->input->post('quantity');
        $data['discount'] = $this->input->post('discount');
        $data['parameter'] = $parameter;
        $data['thuong_hieu'] = $this->input->post('thuong_hieu');
        $data['do_phan_giai'] = $this->input->post('do_phan_giai');
        $data['model'] = $this->input->post('model');
        $data['do_ben'] = $this->input->post('do_ben');
        $data['cong_nghe_quet'] = $this->input->post('cong_nghe_quet');
        $data['goc_quet'] = $this->input->post('goc_quet');
        $data['do_tuong_phan'] = $this->input->post('do_tuong_phan');
        $data['trong_luong'] = $this->input->post('trong_luong');
        $data['doc_ma_vach'] = $this->input->post('doc_ma_vach');
        $data['kich_thuoc'] = $this->input->post('kich_thuoc');
        $data['chan_de'] = $this->input->post('chan_de');
        $data['mau_sac'] = $this->input->post('mau_sac');
        $data['dien_ap'] = $this->input->post('dien_ap');
        $data['phu_kien'] = $this->input->post('phu_kien');
        $data['bao_hanh'] = $this->input->post('bao_hanh');
        $data['xuat_xu'] = $this->input->post('xuat_xu');
        $data['cong_giao_tiep'] = $this->input->post('cong_giao_tiep');
        $data['review_product'] = $this->input->post('review_product');
        $data['tags'] = $this->input->post('tags');
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['keyword'] = $this->input->post('keyword');
        $data['price_new'] = $this->input->post('price_new');

        $alias = replaceTitle($this->input->post('name'));
        $data['alias'] = $alias;
        $image_sp = (isset($_FILES['image'])) ? $_FILES['image'] : "";
        $image_mt = (isset($_FILES['des_images'])) ? $_FILES['des_images'] : "";
        $arr = [];

        // var_dump($_FILES['des_images']); die;

        $maxSize = 5000000;
		if (isset($_FILES['image'])) {
			if ($image_sp['size'] < $maxSize) {
				$path = "images/item/";
	            $f_name = $path . "/" . $alias;
	            if (!file_exists($path)){
	            	mkdir($path, 0777,true);
	            }
	            if (!file_exists($f_name)){
	            	mkdir($f_name, 0777);
	            } 
	            $avatar_name = $f_name . "/" . $image_sp['name'];
	            if (move_uploaded_file($image_sp['tmp_name'], $avatar_name) && $image_sp['name'] != '') {
	                $new_avatar_name = $alias;
	                $full_path_avatar_new = $f_name . "/" . $new_avatar_name . ".png";
	                rename($avatar_name, $full_path_avatar_new);
	                $data['image'] = str_replace($path . "/", '', $full_path_avatar_new);

	                if (isset($_FILES['des_images'])) {
				          for ($i = 0; $i < count($image_mt['name']); $i++) {
				              $size = $image_mt['size'][$i];
				              if ($size < $maxSize) {
				                  $full_path = $f_name . "/" . $image_mt['name'][$i];
				                  if (move_uploaded_file($image_mt['tmp_name'][$i], $full_path) && $image_mt['name'][$i] != '') {
				                      $new_name = $alias . '-' . $i;
				                      $full_path_new = $f_name . "/" . $new_name . ".png";
				                      rename($full_path, $full_path_new);
				                      array_push($arr, str_replace($path . "/", '', $full_path_new));
				                  }
				              }else {
				              	$result=['kq'=>false,'msg'=>"Vui lòng chọn kích thước ảnh nhỏ hơn 5mb"];
				              }
				          }
				          $data['des_images'] = implode(',', $arr);
				          $get_alias= $this->Admin_model->select_data('tbl_product','id',array('alias'  => replaceTitle($data['name'])),null,null, null, null,1);
							if (count($get_alias) == 0) {
								$insert_sp = $this->Admin_model->insert_data('tbl_product',$data);
								$result=['kq'=>true,'msg'=>"Thêm sản phẩm thành công."];
							}else{
								$result=['kq'=>false,'msg'=>"Tên sản phẩm đã tồn tại."];
							}
			      	}else{
			      		$result=['kq'=>false,'msg'=>"Vui lòng chọn ảnh mô tả sản phẩm"];
			      	}
	            }
			}else{
				$result=['kq'=>false,'msg'=>"Vui lòng chọn ảnh đại diện kích thước ảnh nhỏ hơn 5mb"];
			}	
				
		}else{
			$result=['kq'=>false,'msg'=>"Vui lòng chọn ảnh sản phẩm"];
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	public function edit_product($id)
	{
		if ($this->session->userdata('admin')){
			$data['js'] = 
			[
				'/assets/admin/js/product.js',
				'/ckeditor/ckeditor.js',
			];
			$data['product'] = $this->Admin_model->select_data('tbl_product','*',array('id'=>$id),null,null,null,null,0);
			$data['manufacturer'] = $this->Admin_model->select_data('tbl_manufacturer','id,name',null,null,null,null,null,1);
			$data['tags'] = $this->Admin_model->select_data('tbl_tags','id,name',null,null,null,null,null,1);

			$data['content'] = 'admin/edit_product';

			$this->load->view('admin/main', $data, FALSE);
		}else{	
			redirect('/admin','refresh');	
		}
	}
	public function ajax_edit_product(){
		$result=['kq'=>false,'data'=>''];
		$parameter = json_encode($this->input->post('parameter'));
	    $parameter = str_replace('\r\n', '|', $parameter);
	    $parameter = json_decode($parameter);
	    
	    $id = $this->input->post('id');
		$data['code_product'] = $this->input->post('code_product');
        $data['name'] = $this->input->post('name');
        $data['status'] = $this->input->post('status');
        $data['category'] = $this->input->post('category');
        $data['ray_style'] = $this->input->post('ray_style');
        $data['manufacturer'] = $this->input->post('manufacturer');
        $data['style'] = $this->input->post('style');
        $data['connector'] = $this->input->post('connector');
        $data['price_old'] = $this->input->post('price_old');
        $data['quantity'] = $this->input->post('quantity');
        $data['discount'] = $this->input->post('discount');
        $data['parameter'] = $parameter;
        $data['thuong_hieu'] = $this->input->post('thuong_hieu');
        $data['do_phan_giai'] = $this->input->post('do_phan_giai');
        $data['model'] = $this->input->post('model');
        $data['do_ben'] = $this->input->post('do_ben');
        $data['cong_nghe_quet'] = $this->input->post('cong_nghe_quet');
        $data['goc_quet'] = $this->input->post('goc_quet');
        $data['do_tuong_phan'] = $this->input->post('do_tuong_phan');
        $data['trong_luong'] = $this->input->post('trong_luong');
        $data['doc_ma_vach'] = $this->input->post('doc_ma_vach');
        $data['kich_thuoc'] = $this->input->post('kich_thuoc');
        $data['chan_de'] = $this->input->post('chan_de');
        $data['mau_sac'] = $this->input->post('mau_sac');
        $data['dien_ap'] = $this->input->post('dien_ap');
        $data['phu_kien'] = $this->input->post('phu_kien');
        $data['bao_hanh'] = $this->input->post('bao_hanh');
        $data['xuat_xu'] = $this->input->post('xuat_xu');
        $data['cong_giao_tiep'] = $this->input->post('cong_giao_tiep');
        $data['review_product'] = $this->input->post('review_product');
        $data['tags'] = $this->input->post('tags');
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['keyword'] = $this->input->post('keyword');
        $data['price_new'] = $this->input->post('price_new');

        $alias = replaceTitle($this->input->post('name'));
        $image_sp = (isset($_FILES['image'])) ? $_FILES['image'] : "";
        $image_mt = (isset($_FILES['des_images'])) ? $_FILES['des_images'] : "";
        
        $sql_info_pr = $this->Admin_model->select_data('tbl_product','id, alias,image,des_images',array('id'=>$id),null,null, null, null,0);
	    $alias = $sql_info_pr['alias'];
	    $path = "images/item/";
	    $f_name = $path . "/" . $alias;
	    $image = $sql_info_pr['image'];
	    $list_images = $sql_info_pr['des_images'];
	    $arr=[];

        $maxSize = 5000000;
		if (isset($_FILES['image'])) {
			if ($image_sp['size'] < $maxSize) {
				$link_avatar = $path . '/' . $image;
	            unlink($link_avatar);
	            $avatar_name = $f_name . "/" . $image_sp['name'];
	            if (move_uploaded_file($image_sp['tmp_name'], $avatar_name) && $image_sp['name'] != '') {
	                $new_avatar_name = $alias;
	                $full_path_avatar_new = $f_name . "/" . $new_avatar_name . ".png";
	                rename($avatar_name, $full_path_avatar_new);
	                $data['image'] = str_replace($path . "/", '', $full_path_avatar_new);
	            }
			}else{
				$result=['kq'=>false,'msg'=>"Vui lòng chọn ảnh đại diện kích thước ảnh nhỏ hơn 5mb"];
			}	
		}
		if (isset($_FILES['des_images'])) {
			$list_images_old = explode(',', $list_images);
		        // var_dump($list_images_old); die;
	        foreach ($list_images_old as $key => $value) {
		        $link = $path . $value;
		        unlink($link);
	        }
	        for ($i = 0; $i < count($image_mt['name']); $i++) {
	        	$size = $image_mt['size'][$i];
		        if ($size < $maxSize) {
		            $full_path = $f_name . "/" . $image_mt['name'][$i];
		            if (move_uploaded_file($image_mt['tmp_name'][$i], $full_path) && $image_mt['name'][$i] != '') {
			            $new_name = $alias . '-' . $i;
			            $full_path_new = $f_name . "/" . $new_name . ".png";
			            rename($full_path, $full_path_new);
			            array_push($arr, str_replace($path . "/", '', $full_path_new)); /* Add item */
		            }
		        } else {
		            $result=['kq'=>false,'msg'=>"Vui lòng chọn ảnh đại diện kích thước ảnh nhỏ hơn 5mb"];
		        }
	        }
	        $data['des_images'] = implode(',', $arr);
      	}
      	$get_alias= $this->Admin_model->select_data('tbl_product','id',array('alias'  => replaceTitle($data['name']),'id !='=>$id),null,null, null, null,1);
		if (count($get_alias) != 0) {
			$result=['kq'=>false,'msg'=>"Tên sản phẩm đã tồn tại."];
		}else{
			$update_sp = $this->Admin_model->update_data('tbl_product',$data,array('id'=>$id));
			$result=['kq'=>true,'msg'=>"Sửa sản phẩm thành công."];
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	public function list_tags()
	{
		if ($this->session->userdata('admin')){
			$data['css'] =
				[ 
					'/assets/admin/dist/css/jquery.dataTables.min.css',
					'/assets/css/paginate.css'
				];
			$data['js'] = 
			[
				'/assets/admin/js/datatable.js',
				'/assets/admin/js/tag.js',
				'/assets/admin/dist/js/jquery.dataTables.min.js'

			];
			$data_select = "id, name, status, robots";
			$list_tags = $this->Admin_model->select_data('tbl_tags',$data_select,null,null,array('id'  => "DESC"), null, null,1);

			$this->load->library('pagination');
					
			$config['base_url'] = base_url()."admin/list_tags";
			$config['total_rows'] = count($list_tags);
			$config['per_page'] = 10;
			$config['uri_segment'] = 2;
			$config['num_links'] = 2;
			$config['use_page_numbers'] = true;
	        $config['page_query_string'] = true;
	        $config['query_string_segment'] = 'page';
			$config['full_tag_open'] = '<div class="t_paginate_group">';
			$config['full_tag_close'] = '</div>';
			$config['first_link'] = 'Đầu';
			$config['first_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['first_tag_close'] = '</button>';
	        $config['num_tag_open'] = '<button class="t_paginate_item">';
	        $config['num_tag_close']    = '</button>';
	        $config['last_link'] = "Cuối";
	        $config['last_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['last_tag_close'] = '</button>';
	        $config['prev_link'] = '<span class="t_paginate_icon t_paginate_pre"></span>';
	        $config['prev_tag_open'] = '<button class="t_paginate_item">';
	        $config['prev_tag_close'] = '</button>';
	        $config['next_link'] = '<span class="t_paginate_icon t_paginate_next"></span>';
	        $config['next_tag_open'] = '<button class="t_paginate_item">';
	        $config['next_tag_close'] = '</button>';

	        $config['cur_tag_open'] = '<button class="t_paginate_item t_paginate_active">';
	        $config['cur_tag_close'] = '</button>';
			
	        $this->pagination->initialize($config);
			$page = $this->input->get('page');  

			if($page > 1){
				$page = ($page - 1) * $config["per_page"];
			}else{
				$page = 0;
			}
			$data["links"] = $this->pagination->create_links();
	    	$datanews= $this->Admin_model->select_data('tbl_tags',$data_select,null,null,array('id'  => "DESC"),$config["per_page"], $page,1);
	    	$data['list_tags'] = json_decode(json_encode($datanews),true);

			$data['content'] = 'admin/list_tags';
			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function index_tag(){
		$result=['kq'=>false,'data'=>''];
		$id = $this->input->post('id');
		$action = $this->input->post('action');

		if ($action == 'show') {
			$data_update = [
				"robots"=> 1
			];
			$index_product = $this->Admin_model->update_data('tbl_tags',$data_update, array('id'  => $id));
			$result=['kq'=>true,'msg'=>"Cập nhật thành công."];
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	public function delete_tags($id)
	{
		if ($this->session->userdata('admin')){
			$delete_category= $this->Admin_model->delete_data('tbl_tags', array('id'  => $id));
			redirect('/admin/list_tags','refresh');
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function add_edit_tags()
	{
		if ($this->session->userdata('admin')){
			$data['js'] = 
			[
				'/assets/admin/js/tag.js',
			];
			$id = $this->input->get('id');
			if (isset($id) && $id != NULL) {
				$data['type'] = "edit";
				$data['tags'] = $this->Admin_model->select_data('tbl_tags','*',array('id'  => $id),null,null, null, null,0);
			}else{
				$data['type'] = "add";
			}
			$data['content'] = 'admin/add_edit_tags';

			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function ajax_add_edit_tags(){
		$result=['kq'=>false,'data'=>''];
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$alias = replaceTitle($name);
		$status = $this->input->post('status');
		$show_post= $this->input->post('show_post');
  		$content= $this->input->post('content');
      	$content_suggest= $this->input->post('content_suggest');
      	$title_suggest= $this->input->post('title_suggest');
  		$title= $this->input->post('title');
      	$description= $this->input->post('description');
      	$keyword= $this->input->post('keyword');

		$submit = $this->input->post('submit');
		$date = strtotime(date('Y-m-d H:i:s'));
		
		if ($submit == "add") {
			$check_name = $this->Admin_model->select_data('tbl_tags','id',array('alias'  => $alias),null,null, null, null,1);
		}else if ($submit == "edit") {
			$check_name = $this->Admin_model->select_data('tbl_tags','id',array('alias'  => $alias, 'id !=' => $id),null,null, null, null,1);
		}

		if ($check_name) {
			$result=['kq'=>false,'msg'=>"Tên tag đã tồn tại."];
		}else{
			if ($submit == "add"){
				$data_insert = [
					"name"=> $name,
					"alias"=> $alias,
					"show_post"=> $show_post,
					"content"=> $content,
					"content_suggest"=> $content_suggest,
					"title_suggest"=> $title_suggest,
					"title"=> $title,
					"description"=> $description,
					"keyword"=> $keyword,
					"created_time"=> $date,
					"status"=> $status
				];
				$is_up_manufacturer = $this->Admin_model->insert_data('tbl_tags', $data_insert);
				$result=['kq'=>true,'msg'=>"Thêm mới thành công."];
			}else{
				$data_update = [
					"name"=> $name,
					"alias"=> $alias,
					"show_post"=> $show_post,
					"content"=> $content,
					"content_suggest"=> $content_suggest,
					"title_suggest"=> $title_suggest,
					"title"=> $title,
					"description"=> $description,
					"keyword"=> $keyword,
					"modify_time"=> $date,
					"status"=> $status
				];
				$is_up_manufacturer = $this->Admin_model->update_data('tbl_tags', $data_update, array('id'  => $id));
				$result=['kq'=>true,'msg'=>"Cập nhật thành công."];
			}
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	public function list_order()
	{
		if ($this->session->userdata('admin')){
			$data['css'] =
				[ 
					'/assets/admin/dist/css/jquery.dataTables.min.css',
					'/assets/css/paginate.css'
				];
			$data['js'] = 
			[
				'/assets/admin/js/datatable.js',
				'/assets/admin/js/tag.js',
				'/assets/admin/dist/js/jquery.dataTables.min.js'

			];
			$data_select = "*";
			$list_order = $this->Admin_model->select_data('tbl_order',$data_select,null,null,array('id'  => "DESC"), null, null,1);

			$this->load->library('pagination');
					
			$config['base_url'] = base_url()."admin/list_order";
			$config['total_rows'] = count($list_order);
			$config['per_page'] = 10;
			$config['uri_segment'] = 2;
			$config['num_links'] = 2;
			$config['use_page_numbers'] = true;
	        $config['page_query_string'] = true;
	        $config['query_string_segment'] = 'page';
			$config['full_tag_open'] = '<div class="t_paginate_group">';
			$config['full_tag_close'] = '</div>';
			$config['first_link'] = 'Đầu';
			$config['first_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['first_tag_close'] = '</button>';
	        $config['num_tag_open'] = '<button class="t_paginate_item">';
	        $config['num_tag_close']    = '</button>';
	        $config['last_link'] = "Cuối";
	        $config['last_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['last_tag_close'] = '</button>';
	        $config['prev_link'] = '<span class="t_paginate_icon t_paginate_pre"></span>';
	        $config['prev_tag_open'] = '<button class="t_paginate_item">';
	        $config['prev_tag_close'] = '</button>';
	        $config['next_link'] = '<span class="t_paginate_icon t_paginate_next"></span>';
	        $config['next_tag_open'] = '<button class="t_paginate_item">';
	        $config['next_tag_close'] = '</button>';

	        $config['cur_tag_open'] = '<button class="t_paginate_item t_paginate_active">';
	        $config['cur_tag_close'] = '</button>';
			
	        $this->pagination->initialize($config);
			$page = $this->input->get('page');  

			if($page > 1){
				$page = ($page - 1) * $config["per_page"];
			}else{
				$page = 0;
			}
			$data["links"] = $this->pagination->create_links();
	    	$datanews= $this->Admin_model->select_data('tbl_order',$data_select,null,null,array('id'  => "DESC"),$config["per_page"], $page,1);
	    	$data['list_order'] = json_decode(json_encode($datanews),true);

			$data['content'] = 'admin/list_order';
			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function delete_order($id)
	{
		if ($this->session->userdata('admin')){
			$delete_order= $this->Admin_model->delete_data('tbl_order', array('id'  => $id));
			$delete_order_detail= $this->Admin_model->delete_data('tbl_detail_order', array('id_order'  => $id));
			redirect('/admin/list_order','refresh');
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function view_order($id)
	{
		if ($this->session->userdata('admin')){
			$data['js'] = 
			[
				// '/assets/admin/js/tag.js'
			];
			$data_select = "*";
			$data['order'] = $this->Admin_model->select_data('tbl_order',$data_select,array('id'=>$id),null,null, null, null,0);
			$data['detail_order'] = $this->Admin_model->select_data('tbl_product','tbl_product.id,tbl_product.name,tbl_product.alias,tbl_detail_order.quantity,tbl_detail_order.price',array('id_order'=>$id),array('tbl_detail_order'=>'ON tbl_product.id = tbl_detail_order.id_product'),null, null, null,1);
			$data['content'] = 'admin/view_order';

			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function update_status_order(){
		$result=['kq'=>false,'data'=>''];
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		if ($status == 3) {
			$select_complete= $this->Admin_model->select_data('tbl_order','complete',array('id'=> $id),null,null,null,null,0);

			if ($select_complete['complete'] == 0) {
				$update_stt = $this->Admin_model->update_data('tbl_order',array('status' => $status,'complete'=> 1,'modify_time'=>time()), array('id'=> $id));
				$query_order= $this->Admin_model->select_data('tbl_detail_order','id_product,quantity',array('id_order'=> $id),null,null,null,null,1);
				foreach ($query_order as $key => $value) {
					$update_pro = $this->Admin_model->update_quantity($value['id_product'], $value['quantity']);
				}
				$result=['kq'=>true,'data'=>''];
			}else{
				$update_stt = $this->Admin_model->update_data('tbl_order',array('status' => $status,'modify_time'=>time()), array('id'=> $id));
				$result=['kq'=>true,'data'=>''];
			}
		}else if($status == 1  || $status == 2){
			$update_stt = $this->Admin_model->update_data('tbl_order',array('status' => $status,'modify_time'=>time()), array('id'=> $id));
			$result=['kq'=>true,'data'=>''];
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	public function list_voucher()
	{
		if ($this->session->userdata('admin')){
			$data['css'] =
				[ 
					'/assets/admin/dist/css/jquery.dataTables.min.css',
					'/assets/css/paginate.css'
				];
			$data['js'] = 
			[
				'/assets/admin/js/datatable.js',
				'/assets/admin/js/tag.js',
				'/assets/admin/dist/js/jquery.dataTables.min.js'

			];
			$data_select = "*";
			$list_voucher = $this->Admin_model->select_data('tbl_voucher',$data_select,null,null,array('id'  => "DESC"), null, null,1);

			$this->load->library('pagination');
					
			$config['base_url'] = base_url()."admin/list_voucher";
			$config['total_rows'] = count($list_voucher);
			$config['per_page'] = 10;
			$config['uri_segment'] = 2;
			$config['num_links'] = 2;
			$config['use_page_numbers'] = true;
	        $config['page_query_string'] = true;
	        $config['query_string_segment'] = 'page';
			$config['full_tag_open'] = '<div class="t_paginate_group">';
			$config['full_tag_close'] = '</div>';
			$config['first_link'] = 'Đầu';
			$config['first_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['first_tag_close'] = '</button>';
	        $config['num_tag_open'] = '<button class="t_paginate_item">';
	        $config['num_tag_close']    = '</button>';
	        $config['last_link'] = "Cuối";
	        $config['last_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['last_tag_close'] = '</button>';
	        $config['prev_link'] = '<span class="t_paginate_icon t_paginate_pre"></span>';
	        $config['prev_tag_open'] = '<button class="t_paginate_item">';
	        $config['prev_tag_close'] = '</button>';
	        $config['next_link'] = '<span class="t_paginate_icon t_paginate_next"></span>';
	        $config['next_tag_open'] = '<button class="t_paginate_item">';
	        $config['next_tag_close'] = '</button>';

	        $config['cur_tag_open'] = '<button class="t_paginate_item t_paginate_active">';
	        $config['cur_tag_close'] = '</button>';
			
	        $this->pagination->initialize($config);
			$page = $this->input->get('page');  

			if($page > 1){
				$page = ($page - 1) * $config["per_page"];
			}else{
				$page = 0;
			}
			$data["links"] = $this->pagination->create_links();
	    	$datanews= $this->Admin_model->select_data('tbl_voucher',$data_select,null,null,array('id'  => "DESC"),$config["per_page"], $page,1);
	    	$data['list_voucher'] = json_decode(json_encode($datanews),true);

			$data['content'] = 'admin/list_voucher';
			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function add_edit_voucher()
	{
		if ($this->session->userdata('admin')){
			$data['js'] = 
			[
				'/assets/admin/js/tag.js'
			];
			$id = $this->input->get('id');
			if (isset($id) && $id != NULL) {
				$data['type'] = "edit";
				$data['voucher'] = $this->Admin_model->select_data('tbl_voucher','*',array('id'  => $id),null,null, null, null,0);
			}else{
				$data['type'] = "add";
			}
			$data['content'] = 'admin/add_edit_voucher';

			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function ajax_add_edit_voucher(){
		$result=['kq'=>false,'data'=>''];
		$id = $this->input->post('id');
		$code = $this->input->post('code');
		$price_discount = $this->input->post('price_discount');
		$start_day = $this->input->post('start_day');
		$end_day = $this->input->post('end_day');
		$status = $this->input->post('status');
		$type= $this->input->post('type');

		$submit = $this->input->post('submit');
		
		if ($type == 1) {
			$price = $price_discount;
			$discount = 0;
		}else if($type = 2){
			$price = 0;
			$discount = $price_discount;
		}
		if ($submit == "add") {
			$check_name = $this->Admin_model->select_data('tbl_voucher','id',array('code'  => $code),null,null, null, null,1);
		}else if ($submit == "edit") {
			$check_name = $this->Admin_model->select_data('tbl_voucher','id',array('code'  => $code, 'id !=' => $id),null,null, null, null,1);
		}

		if ($check_name) {
			$result=['kq'=>false,'msg'=>"Tên mã đã tồn tại."];
		}else{
			if (strtotime($start_day) > strtotime($end_day)) {
				$result=['kq'=>false,'msg'=>"Ngày bắt đầu phải nhỏ hơn ngày kết thúc."];
			}else{
				$data = [
					"code"=> $code,
					"type"=> $type,
					"start_day"=> strtotime($start_day),
					"end_day"=> strtotime($end_day),
					"price"=> $price,
					"discount"=> $discount,
					"status"=> $status
				];
				if ($submit == "add"){
					$is_up_voucher = $this->Admin_model->insert_data('tbl_voucher', $data);
					$result=['kq'=>true,'msg'=>"Thêm mới thành công."];
				}else{
					$is_up_voucher = $this->Admin_model->update_data('tbl_voucher', $data, array('id'  => $id));
					$result=['kq'=>true,'msg'=>"Cập nhật thành công."];
				}
			}
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	public function delete_voucher($id)
	{
		if ($this->session->userdata('admin')){
			$delete_voucher= $this->Admin_model->delete_data('tbl_voucher', array('id'  => $id));
			redirect('/admin/list_voucher','refresh');
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function list_comment()
	{
		if ($this->session->userdata('admin')){
			$data['css'] =
				[ 
					'/assets/admin/dist/css/jquery.dataTables.min.css',
					'/assets/css/paginate.css'
				];
			$data['js'] = 
			[
				'/assets/admin/js/datatable.js',
				'/assets/admin/js/tag.js',
				'/assets/admin/dist/js/jquery.dataTables.min.js'

			];
			$data_select = "tbl_comments.*, tbl_product.id as product_id,tbl_product.alias";
			$list_comment = $this->Admin_model->select_data('tbl_comments',$data_select,array('isAdmin' => '0'),array('tbl_product' => 'tbl_comments.id_product = tbl_product.id'),array('tbl_comments.id'  => "DESC"),null,null,1);

			$this->load->library('pagination');
					
			$config['base_url'] = base_url()."admin/list_comment";
			$config['total_rows'] = count($list_comment);
			$config['per_page'] = 10;
			$config['uri_segment'] = 2;
			$config['num_links'] = 2;
			$config['use_page_numbers'] = true;
	        $config['page_query_string'] = true;
	        $config['query_string_segment'] = 'page';
			$config['full_tag_open'] = '<div class="t_paginate_group">';
			$config['full_tag_close'] = '</div>';
			$config['first_link'] = 'Đầu';
			$config['first_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['first_tag_close'] = '</button>';
	        $config['num_tag_open'] = '<button class="t_paginate_item">';
	        $config['num_tag_close']    = '</button>';
	        $config['last_link'] = "Cuối";
	        $config['last_tag_open'] = '<button class="t_paginate_item t_paginate_item_big">';
	        $config['last_tag_close'] = '</button>';
	        $config['prev_link'] = '<span class="t_paginate_icon t_paginate_pre"></span>';
	        $config['prev_tag_open'] = '<button class="t_paginate_item">';
	        $config['prev_tag_close'] = '</button>';
	        $config['next_link'] = '<span class="t_paginate_icon t_paginate_next"></span>';
	        $config['next_tag_open'] = '<button class="t_paginate_item">';
	        $config['next_tag_close'] = '</button>';

	        $config['cur_tag_open'] = '<button class="t_paginate_item t_paginate_active">';
	        $config['cur_tag_close'] = '</button>';
			
	        $this->pagination->initialize($config);
			$page = $this->input->get('page');  

			if($page > 1){
				$page = ($page - 1) * $config["per_page"];
			}else{
				$page = 0;
			}
			$data["links"] = $this->pagination->create_links();
	    	$datanews= $this->Admin_model->select_data('tbl_comments',$data_select,array('isAdmin' => '0'),array('tbl_product' => 'tbl_comments.id_product = tbl_product.id'),array('tbl_comments.id'  => "DESC"),$config["per_page"], $page,1);
	    	$data['list_comment'] = json_decode(json_encode($datanews),true);

			$data['content'] = 'admin/list_comment';
			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function show_comment(){
		$id = $this->input->post('id');
		$action = $this->input->post('action');

		if($action == 'show'){
		    $data = array('status' => 1);
		}else{
		    $data = array('status' => 0);
		}
		$show_comment = $this->Admin_model->update_data('tbl_comments',$data, array('id'  => $id));
		$result=['kq'=>true,'msg'=>"Cập nhật thành công."];
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	public function delete_comment($id)
	{
		if ($this->session->userdata('admin')){
			$delete_cmt= $this->Admin_model->delete_data('tbl_comments', array('id'  => $id));
			$delete_cmt_p= $this->Admin_model->delete_data('tbl_comments', array('parent'  => $id));
			redirect('/admin/list_comment','refresh');
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function view_comment($id){
		if ($this->session->userdata('admin')){
			$data['js'] = 
			[
				'/assets/admin/js/tag.js'
			];
			
			$data['cmt'] = $this->Admin_model->select_data('tbl_comments','*',array('id' => $id),null,null,null,null,0);
			$data['cmt_parent'] = $this->Admin_model->select_data('tbl_comments','*',array('parent' => $id),null,array('created_time'=>'DESC'),null,null,1);

			$data['content'] = 'admin/view_comment';

			$this->load->view('admin/main', $data, FALSE);
		}else{
			redirect('/admin','refresh');	
		}
	}
	public function reply_comment(){
		$id_pro = $this->input->post('id_pro');
		$comment = $this->input->post('comment');
		$id_cmt = $this->input->post('id_cmt');

		$session = $this->session->userdata('admin');
		$data = array(
            'id_product' => $id_pro,
            'parent'    => $id_cmt,
            'isAdmin'   => $session["id"],
            'name'      => $session['name'],
            'email'     => '',
            'phone'     => '',
            'comment'   => $comment,
            'created_time'  => time(),
            'modify_time'  => time(),
            'status'        => 1,
        );
        $reply_comment = $this->Admin_model->insert_data('tbl_comments', $data);
        $result=['kq'=>true,'msg'=>"Cập nhật thành công."];
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	public function delete_cmt_parent($id)
	{
		if ($this->session->userdata('admin')){
			$delete_cmt_parent= $this->Admin_model->delete_data('tbl_comments', array('id'  => $id));
			redirect('/admin/list_comment','refresh');
		}else{
			redirect('/admin','refresh');	
		}
	}

	public function logout()
	{
		if ($this->session->userdata('admin')) {
			$this->session->unset_userdata('admin');
			redirect('/admin','refresh');
		}
		
	}
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
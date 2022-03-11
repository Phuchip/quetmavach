<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Site_model');
		$this->load->helper('function');
		$this->load->library('pagination');
		date_default_timezone_set('Asia/Ho_Chi_Minh');
	}

	public function index()
	{
		$str = ``;
		$data_select = 'id,name,image,alias,code_product,quantity,price_old,discount,status,robots';
		$condition = array(
			'delete'	=> 0,
			'status'	=> 1,
		);
		$order = array('modify_time','DESC');
		$data['data_new'] = $this->Site_model->limit_data('tbl_product',$data_select,$condition,null,$order,null, null,6,1);
		$top_sell = $this->db->query('SELECT id_product,sum(quantity) as quantity FROM tbl_detail_order GROUP BY id_product ORDER BY SUM(quantity) DESC') -> result_array();
		foreach ($top_sell as $value) {
			$str .= $value['id_product'] . ',';
		}
		$str = rtrim($str, ',');
		$str = explode(',', $str);
		$in = array('id'=>$str);
		$order_sell = array('discount'=>'DESC');
		$data['top_sell'] = $this->Site_model->limit_data('tbl_product',$data_select,$condition,null,$order_sell,$in ,null, 4,1);
		$order_cheap = array('discount'=>'DESC');
		$data['top_cheap'] = $this->Site_model->limit_data('tbl_product',$data_select,$condition,null,$order_cheap,null, null, 8,1);
		$data['array_manu'] = $this->Site_model->array_manu();
		$data['meta_title'] = 'Trang chủ';
		$data['meta_desc'] = 'meta_title';
		$data['meta_key'] = 'meta_key';
		$data['canonical'] = base_url();
		$data['meta_image'] = 'link_image';
		$data['content'] = 'site/home';
		$this->load->view('site/template',$data);
	}
	function pagination($url,$total)
	{
	    $config['base_url'] = $url;
	    $config['total_rows'] = $total;
	    $config['per_page'] = 2;
	    $config['uri_segment'] = 3;
	    $config['num_links'] = 3;
	    $config['full_tag_open'] = '<p>';
	    $config['full_tag_close'] = '</p>';
	    $config['first_link'] = 'First';
	    $config['first_tag_open'] = '<div>';
	    $config['first_tag_close'] = '</div>';
	    $config['last_link'] = 'Last';
	    $config['last_tag_open'] = '<div>';
	    $config['last_tag_close'] = '</div>';
	    $config['next_link'] = '&gt;';
	    $config['next_tag_open'] = '<div>';
	    $config['next_tag_close'] = '</div>';
	    $config['prev_link'] = '&lt;';
	    $config['prev_tag_open'] = '<div>';
	    $config['prev_tag_close'] = '</div>';
	    $config['cur_tag_open'] = '<b>';
	    $config['cur_tag_close'] = '</b>';
	    $this->pagination->initialize($config);
	    return  $this->pagination->create_links();
	}
	public function All_Item()
	{
		$data_select = 'id,name,image,alias,code_product,quantity,price_old,discount,status,robots';
		$condition = array(
			'delete'	=> 0,
			'status'	=> 1,
		);
		$order = array('modify_time','DESC');
		$data['data_new'] = $this->Site_model->limit_data('tbl_product',$data_select,$condition,null,$order, null,6,1);
		$data['array_manu'] = $this->Site_model->array_manu();
		$data['css'] = '/assets/css/search.css';
		$data['meta_title'] = 'Tất cả máy quét mã vạch';
		$data['meta_desc'] = 'meta_title';
		$data['meta_key'] = 'meta_key';
		$data['canonical'] = base_url();
		$data['meta_image'] = 'link_image';
		$data['content'] = 'site/filter';
		$this->load->view('site/template',$data);
	}
	public function detailProduct($alias,$id)
	{
		$data_select = '*';
		$condition = array('parent' => 0, 'status' => 1 , 'id_product' => $id);
		$data['comment'] = $this->Site_model->select_data('tbl_comments',$data_select,$condition,null,null, null, null,1);
		$data['id']	= $id;
		$condition_item = array('id'=>$id,'delete' => 0 , 'status' => 1);
		$data['data'] = $this->Site_model->select_data('tbl_product',$data_select,$condition_item,null,null, null, null,0);
		$select_relate = 'id,name,image,alias,code_product,quantity,price_old,discount,status,robots';
		$condition_relate = array(
			'delete'	=> 0,
			'status'	=> 1,
		);
		$order = array('modify_time'=>'DESC');
		$data['data_relate'] = $this->Site_model->limit_data('tbl_product',$select_relate,$condition_relate,null,$order, null,4,1);
		$data['css'] = '/assets/css/detail.css';
		$data['js'] = '/assets/js/detail.js';
		$data['meta_title'] = 'Chi tiết sản phẩm';
		$data['meta_desc'] = 'meta_title';
		$data['meta_key'] = 'meta_key';
		$data['canonical'] = base_url();
		$data['meta_image'] = 'link_image';
		$data['content'] = 'site/detail';
		$this->load->view('site/template',$data);
	}
	function addComment()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$comment = $this->input->post('comment');
		$id_product = $this->input->post('id_product');
		$parent = $this->input->post('id_parent');
		$timeaway = time();
		if ($name == '') {
		    set_error('Vui lòng nhập họ và tên');
		}
		if ($comment == '') {
		    set_error('Vui lòng nhập nội dung bình luận');
		}
		$data = array(
		    'id_product' => $id_product,
		    'parent'    => $parent,
		    'name'      => $name,
		    'email'     => $email,
		    'phone'     => $phone,
		    'comment'   => $comment,
		    'created_time'  => time(),
		    'status'        => 1,
		);
		$this->Site_model->insert_data('tbl_comments',$data);
		$id_comment = $this->db->insert_id();
		$output = array(
			'id'	=> $id_comment,
			'date'	=> dayDate(time()),
		    'day'  => date('d/m/Y',time()),
		    'time'  => date('H:i',time()),
		);
		echo json_encode($output);
	}
	function actionCart()
	{
		$id = $this->input->post('id');
		$quantity = $this->input->post('quantity');
		$action = $this->input->post('action');
		$num = 0;
		$total = 0;
		$into = 0;
		if ($action == 'add') {
			$check_num = $this->Site_model->check_quantity('tbl_product',$id)->row();
		    if ($check_num->quantity < $quantity) {
		        set_error('Số lượng trong kho không đủ xin vui lòng nhập lại');
		    }
		    if (isset($id) && $id != 0) {
		        if (isset($_SESSION['cart'])) {
		            $is_available = 0;
		            foreach ($_SESSION['cart'] as $key => $value) {
		                if ($value['id'] == $id) {
		                    $is_available++;
		                    $_SESSION['cart'][$key]['quantity'] = $value['quantity'] + $quantity;
		                }
		            }
		            if ($is_available == 0) {
		                $item_array = array(
		                    'id'    => $id,
		                    'name'  => $check_num->name,
		                    'alias' => $check_num->alias,
		                    'quantity'  => $quantity,
		                    'price_old'	=> $check_num->price_old,
		                    'price' => price($check_num->price_old, $check_num->discount),
		                    'image' => $check_num->image
		                );
		                $_SESSION['cart'][] = $item_array;
		            }
		        } else {
		            $item_array = array(
		                'id'    => $id,
	                    'name'  => $check_num->name,
	                    'alias' => $check_num->alias,
	                    'quantity'  => $quantity,
	                    'price_old'	=> $check_num->price_old,
	                    'price' => price($check_num->price_old, $check_num->discount),
	                    'image' => $check_num->image
		            );
		            $_SESSION['cart'][] = $item_array;
		        }
		    }
		    success('Thêm giỏ hàng thành công');
		}elseif($action == 'update'){
		    foreach($_SESSION['cart'] as $key => $value){
		        if($value['id'] == $id){
		            $_SESSION['cart'][$key]['quantity'] =  $quantity;
		            $item = $_SESSION['cart'][$key]['price'] * $quantity;
		        }
		        $num += $_SESSION['cart'][$key]['quantity'];
		        $total += $_SESSION['cart'][$key]['price'] * $_SESSION['cart'][$key]['quantity'];
		    }

		    $item = formatPrice($item);
		    if (isset($_SESSION['discount'])) {
				$into = $total - $_SESSION['discount']['discount'];
			}else {
				$into = $total;
			}
			$total = formatPrice($total);
			$into = formatPrice($into);
		    $data = array('num' => $num,'total'=> $total,'into'=>$into,'item'=>$item);
		    echo json_encode($data);
		}elseif($action == 'delete'){
		    foreach($_SESSION['cart'] as $key => $value){
		        if($value['id'] == $id){
		            unset($_SESSION['cart'][$key]);
		        }else{
		            $num += $_SESSION['cart'][$key]['quantity'];
		            $total += $_SESSION['cart'][$key]['price'] * $_SESSION['cart'][$key]['quantity'];
		        }
		    }
		    if (isset($_SESSION['discount'])) {
				$into = $total - $_SESSION['discount']['discount'];
			}else {
				$into = $total;
			}
			$total = formatPrice($total);
			$into = formatPrice($into);
		    $data = array('num' => $num,'total'=> $total,'into'=>$into);
		    echo json_encode($data);
		}elseif($action == 'delete_list'){
			$list_id = explode(',', $id);
			foreach ($list_id as $val) {
				foreach($_SESSION['cart'] as $key => $value){
			        if($value['id'] == $val){
			            unset($_SESSION['cart'][$key]);
			        }else{
			            $num += $_SESSION['cart'][$key]['quantity'];
			            $total += $_SESSION['cart'][$key]['price'] * $_SESSION['cart'][$key]['quantity'];
			        }
			    }
			}
			$this->checkCart();
			if (isset($_SESSION['discount'])) {
				$into = $total - $_SESSION['discount']['discount'];
			}else {
				$into = $total;
			}
			$total = formatPrice($total);
			$into = formatPrice($into);
		    $data = array('num' => $num,'total'=> $total,'into'=>$into);
		    echo json_encode($data);
		}
		elseif($action == 'delete_all'){
			unset($_SESSION['cart']);
		    $data = array('num' => $num,'total'=> $total,'into'=>$total);
		    echo json_encode($data);
		}
	}
	function checkCart()
	{
		if(isset($_SESSION['cart']) AND count($_SESSION['cart']) == 0){
			unset($_SESSION['cart']);
		}
	}
	function getProduct()
	{
		$data_select = 'id,name,alias,price_old,discount,image';
		$condition = array('delete' => 0,'status' => 1);
		$query = $this->Site_model->select_data('tbl_product',$data_select,$condition,null,null, null, null,1);
		foreach ($query as $key => $value) {
		    $data[$value['id']] = array(
		    	'id'	=> $value['id'],
		    	'name'	=> 'Máy quét mã vạch '.$value['name'],
		    	'link'	=> rewrite_url($value['id'],$value['alias']),
		    	'image'	=> $value['image'],
		    	'price_new'	=> price_new($value['price_old'],$value['discount']),
		    	'price_old'	=> formatPrice($value['price_old']),
		    	'discount'	=> $value['discount'],
		    );
		}
		echo json_encode($data);
	}
	function getTag()
	{
		$data_select = '*';
		$query = $this->Site_model->select_data('tbl_tags',$data_select,null,null,null, null, null,1);
		foreach ($query as $key => $value) {
		    $data[$value['id']] = array(
		    	'name'	=> $value['name'],
		    	'link'	=> '/'.$value['alias'].'-ID-'.$value['id'].'.html',
		    );
		}
		echo json_encode($data);
	}
	function filter_ajax()
	{
		$loai_may = $this->input->post('cate');
		$loai_tia = $this->input->post('ray_type');
		$kieu_dang = $this->input->post('style');
		$ket_noi = $this->input->post('connect');
		$where = filter_where($loai_may,$loai_tia,$kieu_dang,$ket_noi);
		$limit = 'LIMIT 6';
		$query = $this->Site_model->get_data_page($where,'',$limit);
		$output ='';
		if (count($query) > 0) {
			foreach ($query as $key => $value) {
				$output .= '<div class="item">
								<div class="item-image">
									<a href="'.rewrite_url($value['id'],$value['alias']).'">
										<img class="lazyload" src="/images/loading.gif" data-src="/images/item/'.$value['image'] .'" alt="'.rewrite_title($value['name']) .'">
									</a>
								</div>
								<div class="item-body">
									<div class="item-code">
										<p>Mã sản phẩm :</p>
										<p>'.$value['code_product'] .'</p>
									</div>
									<p class="item-title">
										<a href="'.rewrite_url($value['id'],$value['alias']).'">'.rewrite_title($value['name']) .'</a>
									</p>
									<div class="item-gift">
										<i class="icon-presents"></i>
			                            <p>Tặng kèm phần mềm quản lý bán hàng <span class="color-red">miễn phí trọn đời</span></p>
									</div>
									<div class="item-price">
										<div class="price">
											<p class="price-old">'.formatPrice($value['price_old']).'đ</p>
											<p class="price-new">'.price_new($value['price_old'],$value['discount']).'đ</p>
										</div>';
										if ($value['discount'] > 0) {
										$output .= '<div class="item-discount">
											<img class="lazyload" src="/images/loading.gif" data-src="/images/icon/discount.svg" alt="discount">
											<p>Giảm '.$value['discount'] .'%</p>
										</div>';
										}
									$output .= '</div>
								</div>
								<div class="item-footer">
									<button class="item-contact">
										<i class="icon-contact"></i>
										<p>Liên hệ tư vấn ngay </p>
									</button>
									<button class="add-to-cart" data-id="'.$value['id'].'">
										<i class="icon-cart"></i>
									</button>
								</div>
							</div>';
			}
			$data = [
			    'result' => true,
			    'output' => $output,
			];
		}else {
			$output .= '<div class="no-found">
			    <img src="../images/no-products-found.png" alt="Không có kết quả">
			    <p>Không tìm thấy sản phẩm nào phù hợp</p>
			</div>';
			$data = [
			    'result' => false,
			    'output' => $output,
			];
		}
		echo json_encode($data);
	}
	public function search()
	{
		unset($_SESSION['price']);
		$action = $this->input->get('action');
		$loai_may = $this->input->get('cate');
		$loai_tia = $this->input->get('ray_type');
		$kieu_dang = $this->input->get('style');
		$ket_noi = $this->input->get('connect');
		$data['sort'] = $sort = $this->input->get('sort');
		$data['filter'] = $filter = $this->input->get('filter');
		$min = $this->input->get('min');
		$max = $this->input->get('max');
		$where = '';
		$order = '';
		if (isset($action) && $action == 'filter') {
			if ($min == '') {
				$min = 0;
			}
			$where = filter_where($loai_may,$loai_tia,$kieu_dang,$ket_noi,$min,$max);
			$order = filter_order($sort,$filter);
		}
	    $key = $this->input->get('keyword');
	    if ($key == '') {
	        $key = $_SESSION['search'];
	    }
	    $_SESSION['search'] = $key;
        $str = ' AND `name` LIKE "%'.$_SESSION['search'].'%"';
        $count_total = $this->Site_model->get_data_page($where,$order,null,$str);
        $page  = $this->input->get('page');

        $page  = intval(@$page);
		if ($page == 0) {
		    $page = 1;
		}
		$curentPage = 2;
		$pageab = abs($page - 1);
		$start = $pageab * $curentPage;
		$start = intval(@$start);
		$start = abs($start);

		$total_records = count($count_total);
		$total_page = ceil($total_records / $curentPage);
		if ($page > $total_page) {
		    $page = $total_page;
		}
		$pagination = "LIMIT " . $start . "," . $curentPage;
		$data['pagination'] = pagination($page,$total_page);
		$data['data'] = $this->Site_model->get_data_page($where,$order,$pagination,$str);
	    $data['array_manu'] = $this->Site_model->array_manu();

	    $data['cate'] = explode(',', $loai_may);
		$data['ray_type'] = explode(',', $loai_tia);
		$data['style'] = explode(',', $kieu_dang);
		$data['connect'] = explode(',', $ket_noi);

		$data['css'] = '/assets/css/search.css';
		$data['js'] = '/assets/js/filter.js';
		$data['meta_title'] = 'Tìm kiếm';
		$data['meta_desc'] = 'meta_title';
		$data['meta_key'] = 'meta_key';
		$data['canonical'] = base_url();
		$data['meta_image'] = 'link_image';
		$data['content'] = 'site/search';
		$this->load->view('site/template',$data);
	}
	function redirect_search()
	{
		$key = $this->input->post('key');
		$error = 1;
		$data_select = '*';
		$query = $this->Site_model->select_data('tbl_tags',$data_select,null,null,null, null, null,1);
		if($key != ''){
		    foreach($query as $value){
		        if($key == mb_convert_case($value['name'], MB_CASE_LOWER, "UTF-8")){
		            $link = '/'.$value['alias'].'-ID-'.$value['id'].'.html';
		            $error = 0;
		        }
		    }
		}
		if($error == 1){
		    $data = array('result' => false,'link' =>'/tim-kiem.html?keyword='.$key );
		}else{
		    $data = array('result' => true,'link'=>$link );
		}
		echo json_encode($data);	
	}
	public function tag($alias,$id)
	{
		unset($_SESSION['price']);
		$action = $this->input->get('action');
		$loai_may = $this->input->get('cate');
		$loai_tia = $this->input->get('ray_type');
		$kieu_dang = $this->input->get('style');
		$ket_noi = $this->input->get('connect');
		$data['sort'] = $sort = $this->input->get('sort');
		$data['filter'] = $filter = $this->input->get('filter');
		$min = $this->input->get('min');
		$max = $this->input->get('max');
		$where = '';
		$order = '';
		if (isset($action) && $action == 'filter') {
			if ($min == '') {
				$min = 0;
			}
			$where = filter_where($loai_may,$loai_tia,$kieu_dang,$ket_noi,$min,$max);
			$order = filter_order($sort,$filter);
		}
		$data_select = '*';
		$condition = array('status'=>1,'id'=>$id);
		$row = $this->Site_model->select_data('tbl_tags',$data_select,$condition,null,null, null, null,0);

	    if (count($row) > 0) {
	        $link = rewrite_manu($row['id'],$row['alias']);
	    } else {
	        redirect_301(404);
	    }
	    $_SESSION['search'] = $row['name'];
        $str = ' AND tags = '.$id;
        $count_total = $this->Site_model->get_data_page($where,$order,null,$str);
        $page  = $this->input->get('page');

        $page  = intval(@$page);
		if ($page == 0) {
		    $page = 1;
		}
		$curentPage = 2;
		$pageab = abs($page - 1);
		$start = $pageab * $curentPage;
		$start = intval(@$start);
		$start = abs($start);

		$total_records = count($count_total);
		$total_page = ceil($total_records / $curentPage);
		if ($page > $total_page) {
		    $page = $total_page;
		}
		$pagination = "LIMIT " . $start . "," . $curentPage;
		$data['pagination'] = pagination($page,$total_page);
		$data['data'] = $this->Site_model->get_data_page($where,$order,$pagination,$str);

	    $data['array_manu'] = $this->Site_model->array_manu();

	    $data['cate'] = explode(',', $loai_may);
		$data['ray_type'] = explode(',', $loai_tia);
		$data['style'] = explode(',', $kieu_dang);
		$data['connect'] = explode(',', $ket_noi);

		$data['css'] = '/assets/css/search.css';
		$data['js'] = '/assets/js/filter.js';
		$data['meta_title'] = 'tag';
		$data['meta_desc'] = 'meta_title';
		$data['meta_key'] = 'meta_key';
		$data['canonical'] = base_url().$link;
		$data['meta_image'] = 'link_image';
		$data['content'] = 'site/tag';
		$this->load->view('site/template',$data);
	}
	public function manufacturer($alias,$id)
	{
		unset($_SESSION['price']);
		$action = $this->input->get('action');
		$loai_may = $this->input->get('cate');
		$loai_tia = $this->input->get('ray_type');
		$kieu_dang = $this->input->get('style');
		$ket_noi = $this->input->get('connect');
		$data['sort'] = $sort = $this->input->get('sort');
		$data['filter'] = $filter = $this->input->get('filter');
		$min = $this->input->get('min');
		$max = $this->input->get('max');
		$where = '';
		$order = '';
		if (isset($action) && $action == 'filter') {
			if ($min == '') {
				$min = 0;
			}
			$where = filter_where($loai_may,$loai_tia,$kieu_dang,$ket_noi,$min,$max);
			$order = filter_order($sort,$filter);
		}
		$data_select = '*';
		$condition = array('status'=>1,'id'=>$id);
		$row = $this->Site_model->select_data('tbl_manufacturer',$data_select,$condition,null,null, null, null,0);

	    if (count($row) > 0) {
	        $link = rewrite_manu($row['id'],$row['alias']);
	    } else {
	        redirect_301(404);
	    }
	    $_SESSION['search'] = $row['name'];
        $str = ' AND manufacturer = '.$id;
        $count_total = $this->Site_model->get_data_page($where,$order,null,$str);
        $page  = $this->input->get('page');

        $page  = intval(@$page);
		if ($page == 0) {
		    $page = 1;
		}
		$curentPage = 2;
		$pageab = abs($page - 1);
		$start = $pageab * $curentPage;
		$start = intval(@$start);
		$start = abs($start);

		$total_records = count($count_total);
		$total_page = ceil($total_records / $curentPage);
		if ($page > $total_page) {
		    $page = $total_page;
		}
		$pagination = "LIMIT " . $start . "," . $curentPage;
		$data['pagination'] = pagination($page,$total_page);
		$data['data'] = $this->Site_model->get_data_page($where,$order,$pagination,$str);

	    $data['array_manu'] = $this->Site_model->array_manu();

	    $data['cate'] = explode(',', $loai_may);
		$data['ray_type'] = explode(',', $loai_tia);
		$data['style'] = explode(',', $kieu_dang);
		$data['connect'] = explode(',', $ket_noi);

		$data['css'] = '/assets/css/search.css';
		$data['js'] = '/assets/js/filter.js';
		$data['meta_title'] = 'Hãng sản xuất';
		$data['meta_desc'] = 'meta_title';
		$data['meta_key'] = 'meta_key';
		$data['canonical'] = base_url().$link;
		$data['meta_image'] = 'link_image';
		$data['content'] = 'site/manufacturer';
		$this->load->view('site/template',$data);
	}
	public function cart()
	{
		$data['js'] = '/assets/js/cart.js';
		$data['css'] = '/assets/css/cart.css';
		$data['meta_title'] = 'Giỏ hàng';
		$data['meta_desc'] = 'meta_title';
		$data['meta_key'] = 'meta_key';
		$data['canonical'] = base_url();
		$data['meta_image'] = 'link_image';
		$data['content'] = 'site/cart';
		$this->load->view('site/template',$data);
	}
	function discount()
	{
		$code = $this->input->post('discount');
		$time = time();
		$select = '*';
		$condition = [
		    'code' => $code,
		];
		$row = $this->Site_model->select_data('tbl_voucher',$select,$condition,null,null, null, null,0);
		if (count($row) > 0) {
		    $total = 0;
		    $discount = 0;
		    if (isset($_SESSION['cart']) ) {
		    	if ($row['status'] == 1) {
		    		if ($time >= $row['start_day'] && $time <= $row['end_day'] ) {
			    		foreach($_SESSION['cart'] as $key => $value){
					        $total += $_SESSION['cart'][$key]['price'] * $_SESSION['cart'][$key]['quantity'];
					    }
					    if ($row['type'] == 1) {
					    	$discount = $total * ($row['discount']/100);
					    	$total = $total * ((100-$row['discount'])/100);
					    }elseif($row['type'] == 2) {
					    	$total = $total - $row['price'];
					    	$discount = $row['price'];
					    }
					    $_SESSION['discount'] = array('code'=>$code,'discount'=>$discount);
					    $total = formatPrice($total);
					    $discount = formatPrice($discount);
					    $data = array('result' => true,'mes'=>'Áp dụng mã giảm giá thành công !','total'=> $total,'discount'=>$discount);
					    echo json_encode($data);
			    	}else {
			    		set_error('Mã giảm giá không chính xác !');
			    	}
		    	}else {
		    		set_error('Mã giảm giá không chính xác !');
		    	}
		    }else {
		    	set_error('Vui lòng thêm sản phẩm vào giỏ hàng !');
		    }
		}else {
			set_error('Mã giảm giá không chính xác !');
		}
	}
	public function payment()
	{
		$total = 0;
		$num = 0;
		if (isset($_SESSION['cart'])) {
			foreach ($_SESSION['cart'] as $key => $value) {
				$item = $value['price'] * $value['quantity'];
				$num += $_SESSION['cart'][$key]['quantity'];
				$total += $item; 
			}
		}
		if (isset($_SESSION['discount'])) {
			$total = $total - $_SESSION['discount']['discount'];
		}
		$data['total'] = formatPrice($total);
		$data['num'] = $num;
		$data['css'] = '/assets/css/payment.css';
		$data['js'] = '/assets/js/payment.js';
		$data['meta_title'] = 'Thanh toán';
		$data['meta_desc'] = 'meta_title';
		$data['meta_key'] = 'meta_key';
		$data['canonical'] = base_url();
		$data['meta_image'] = 'link_image';
		$data['content'] = 'site/payment';
		$this->load->view('site/template',$data);
	}
	function order()
	{
		$name = $this->input->post('name');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$address = $this->input->post('address');
		$ship_name = $this->input->post('ship_name');
		$ship_phone = $this->input->post('ship_phone');
		$ship_address = $this->input->post('ship_address');
		$ship_note = $this->input->post('ship_note');
		$total = 0;
		$num = 0;
		if (isset($_SESSION['cart'])) {
			foreach ($_SESSION['cart'] as $key => $value) {
				$item = $value['price'] * $value['quantity'];
				$num += $_SESSION['cart'][$key]['quantity'];
				$total += $item;
			}
			if (isset($_SESSION['discount'])) {
				$total = $total - $_SESSION['discount']['discount'];
			}
		}
		if($num > 0){
		    foreach($_SESSION['cart'] as $key => $value){
		    	$data_select = 'id,name,quantity';
		    	$condition = array('id'=>$value['id']);
		        $data_check = $this->Site_model->select_data('tbl_product',$data_select,$condition,null,null, null, null,0);
		        if($data_check['quantity'] < $value['quantity']){
		            set_error("Sản phẩm ".$data_check['name']." có số lượng không đủ xin vui lòng thử lại!");
		        }
		    }
		    $data = array(
		        'name' => $name, 
		        'phone' => $phone, 
		        'email' => $email, 
		        'address' => $address, 
		        'ship_name' => $ship_name,
		        'ship_phone' => $ship_phone,
		        'ship_address' => $ship_address,
		        'note' => $ship_note,
		        'quantity'  => $num,
		        'code'		=> (isset($_SESSION['discount']))?$_SESSION['discount']['code']:'',
		        'discount'		=> (isset($_SESSION['discount']))?$_SESSION['discount']['discount']:'',
		        'total'     => $total,
		        'created_time'=> time(),
		        'modify_time'   => time(),
		    );
		    if($this->Site_model->insert_data('tbl_order',$data)){
		        set_error("Có lỗi xảy ra xin vui lòng thử lại");
		    }
		    $id = $this->db->insert_id();
		    $array = '';
		    foreach($_SESSION['cart'] as $key => $value){
		        $array .= "('".$id."','".$value['id']."','".$value['quantity']."','".$value['price']."','".time()."','".time()."'),";
		    }
		    $array = rtrim($array,',');
		    $sql = "INSERT INTO `tbl_detail_order` (`id_order`, `id_product`, `quantity`, `price`, `created_time`, `modify_time`) VALUES ".$array;
		    $this->db->query($sql);
		    unset($_SESSION['cart']);
		    unset($_SESSION['discount']);
		    success('Đặt hàng thành công !!');
		}else{
		    set_error('Vui lòng thêm sản phẩm vào giỏ hàng để tiến hành thanh toán');
		}
	}
}

/* End of file Site.php */
/* Location: ./application/controllers/Site.php */
<?php 
function rewrite_url($id,$alias){
    $url = 'may-quet-ma-vach-'.$alias.'-id-'.$id.'.html';
    return $url;
}
function rewrite_title($name=''){
    $title = 'Máy quét mã vạch '.$name;
    return $title;
}
function rewrite_manu($id,$alias)
{
    $url = 'hang-san-xuat-'.$alias.'-ID-'.$id.'.html';
    return $url;
}
function price_new($price_old,$discount=0){
    if ($discount == 0) {
        $price_new = $price_old;
    } else {
        $price_new = $price_old*(100 - $discount)/100;
    }
    return number_format($price_new);
}
function dayDate($date) {
    $date = date('Y-m-d',$date);
    $days = array('Chủ Nhật','Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm','Thứ Sáu','Thứ Bảy');
    $day = date('w',strtotime($date));
    $scheduled_day = $days[$day];
    return $scheduled_day;
}
function price($price_old,$discount=0)
{
    if ($discount == 0) {
        $price_new = $price_old;
    } else {
        $price_new = $price_old*(100 - $discount)/100;
    }
    return $price_new;
}
function formatPrice($price)
{
	return number_format($price);
}
function set_error($mes){
    $data = array('result' => false,'mes' => $mes );
    echo json_encode($data);
    exit();
}
function success($mes,$output=''){
    $data = array('result' => true,'mes' => $mes,'output'=>$output);
    echo json_encode($data);
    exit();
}

function redirect_301($link){
    header("HTTP/1.1 301 Moved Permanently"); 
    header("Location: $link"); 
    exit();
}
function pagination($current_page,$total_page){
    $output = '';
    if ($total_page > 0) {
        $output .= '<ul class="pagination">';
        if ($current_page > 1 && $total_page > 1){
            $output .= '<li class="page page_prev" value="'.($current_page-1).'"><p rel="prev"><i class="icon-page-prev"></i></p></li>';
        }else{
            $output .= '<li class="page page_prev"><p rel="prev"><i class="icon-page-prev"></i></p></li>';
        }
        for ($i = 1; $i <= $total_page; $i++){
            if ($i == $current_page){
                $output .= '<li class="active"><p>'.$i.'</p></li>';
            }
            else{
                $output .= '<li class="page-li" value='.$i.'><p>'.$i.'</p></li>';
            }
        }
        if ($current_page < $total_page && $total_page > 1){
            $output .= '<li class="page page_next page-li" value='.($current_page+1).'><p rel="next"><i class="icon-page-next"></i></p></li>';
        }else{
            $output .= '<li class="page page_next"><p rel="next"><i class="icon-page-next"></i></p></li>';
        }
        $output .= '</ul>';
    }else {
        $output .= '
        <div class="no-found">
            <img src="../images/no-products-found.png" alt="Không có kết quả">
            <p>Không tìm thấy sản phẩm nào phù hợp</p>
        </div>';
    }
    return $output;
}
function array_cate()
{
    $arr_cate = array(
        '0' => array('id' => 1,'name'=>'Đọc mã vạch 1D','value'=>'1'),
        '2' => array('id' => 2,'name'=>'Đọc mã vạch 2D','value'=>'2'),
    );
    return $arr_cate;
}
function array_ray()
{
    $arr_cate = array(
        '0' => array('id' => 1,'name'=>'Đơn tia','value'=>'1'),
        '2' => array('id' => 2,'name'=>'Đơn tia','value'=>'2'),
    );
    return $arr_cate;
}
function array_style()
{
    $arr_cate = array(
        '0' => array('id' => 1,'name'=>'Để bàn','value'=>'1'),
        '2' => array('id' => 2,'name'=>'Cầm tay','value'=>'2'),
    );
    return $arr_cate;
}
function array_connect()
{
    $arr_cate = array(
        '0' => array('id' => 1,'name'=>'Có dây','value'=>'1'),
        '2' => array('id' => 2,'name'=>'Không dây','value'=>'2'),
    );
    return $arr_cate;
}
function array_sort()
{
    $array_filter = array(
        '0' => array('id' => 1,'name'  => 'Hàng mới','value'  => 'new'),
        '1' => array('id' => 2,'name'  => 'Xem nhiều','value'  => 'view'),
        '2' => array('id' => 3,'name'  => 'Giá giảm nhiều','value'  => 'price-off'),
        '3' => array('id' => 4,'name'  => 'Giá tăng dần','value'  => 'price-asc'),
        '4' => array('id' => 5,'name'  => 'Giá giảm dần','value'  => 'price-desc'),
    );
    return $array_filter;
}
function filter_where($loai_may='',$loai_tia='',$kieu_dang='',$ket_noi='',$min=0,$max=1)
{
    $where = '';
    if($loai_may != ''){
        $where .= " AND category in (".$loai_may.")";
    }
    if($loai_tia != ''){
        $where .= " AND ray_style in (".$loai_tia.")";
    }
    if($kieu_dang != ''){
        $where .= " AND style in (".$kieu_dang.")";
    }
    if($ket_noi != ''){
        $where .= " AND connector in (".$ket_noi.")";
    }
    if ($min != '' && $max != '') {
        $price = array('min' => $min,'max' => $max);
        $_SESSION['price'] = $price;
        $where .= "AND price_new BETWEEN '" . $min . "' AND '" . $max . "' ";
    }
    return $where;
}
function filter_order($list_filter='',$filter_product='')
{
    $order = '';
    if($list_filter != ''){
        if($list_filter == 'new'){
            $order .= ',created_time DESC ';
        }elseif($list_filter == 'view'){
            $order .= ',view DESC ';
        }elseif($list_filter == 'price-off'){
            $order .= ',discount DESC ';
        }elseif($list_filter == 'price-asc'){
            $order .= ',price_new ASC ';
        }elseif($list_filter == 'price-desc'){
            $order .= ',price_new DESC ';
        }
    }elseif($filter_product != ''){
        if($filter_product == 'rate'){
            $order .= ',rate DESC ';
        }elseif($filter_product == 'name'){
            $order .= ',name DESC ';
        }
    }
    return $order;
}
?>
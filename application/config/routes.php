<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Bộ lọc - Tất cả danh sách sản phẩm
$route['tat-ca-may-quet-ma-vach.html'] = 'site/All_Item';
// Chi tiết sản phẩm
$route['(:any)-id-(:num).html'] = 'site/detailProduct/$1/$2';
// Giỏ hàng
$route['gio-hang.html'] = 'site/cart';
// Thanh toán
$route['thanh-toan.html'] = 'site/payment';
// Tìm kiếm
$route['tim-kiem.html'] = 'site/search/$1';
// Hãng sản xuất
$route['hang-san-xuat-(:any)-ID-(:num).html'] = 'site/manufacturer/$1/$2';
// Tag
$route['(:any)-ID-(:num).html'] = 'site/tag/$1/$2';

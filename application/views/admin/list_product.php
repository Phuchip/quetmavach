<?php   
$CI=&get_instance();
$CI->load->model('Admin_model');
 ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Danh sách sản phẩm
            <small>Danh mục sản phẩm</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i>Danh sách sản phẩm</a></li>
            <li><a href="">Danh mục sản phẩm</a></li>
        </ol>
    </section>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body ">
                    <div class="input-group " style="display: flex;width: 100%;justify-content: flex-end;">
                        <div class="input-group-append ml-2" style="margin-left: 1.5rem!important;">
                            <button style="margin-bottom: 15px;border: 1px solid #979797;background: linear-gradient(to bottom, white 0%, #dcdcdc 100%);border-radius: 5px;"><a href="/admin/add_product">Thêm mới</a></button>
                        </div>
                    </div>
                    <div class="content_search">
                        <table data-toolbar="#toolbar" data-toggle="table" class="table table-hover" id="list_account">
                            <thead style="background: #f1f4f7;">
                            <tr>
                                <th data-field="stt" data-sortable="true">ID</th>
                                <th data-field="uname" data-sortable="true">Tên sản phẩm</th>
                                <th data-field="account" data-sortable="true">Mã sản phẩm</th>
                                <th data-field="name" data-sortable="true">Giá bán</th>
                                <th data-field="role" data-sortable="true">Giảm giá</th>
                                <th data-field="role1" data-sortable="true">Số lượng</th>
                                <th data-field="role2" data-sortable="true">Kho hàng</th>
                                <th data-field="role3" data-sortable="true">Hiển thị</th>
                                <th data-field="role4" data-sortable="true">Mở index</th> 
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody class="">
                            <?php if(!empty($list_product)){
                                foreach($list_product as $list){ $i = 0;?> 
                                    <tr>
                                        <td class="td-count" scope="row"><?= $list['id']; ?></td>
                                        <td> <?=$list['name']?></td>
                                        <td><?=$list['code_product'];?></td>
                                        <td><?=$list['price_old'];?>đ</td>
                                        <td><?=$list['discount']?>%</td>
                                        <td><?=$list['quantity']?>%</td>
                                        <td>
                                            <?php if ($list['quantity'] == 0) {?>
                                                <img src="/assets/admin/dist/img/Ellipse_88.png" alt="">
                                            <?}else{?>
                                                <img src="/assets/admin/dist/img/Ellipse30.png" alt="">
                                            <?} ?>
                                        </td>
                                        <td>
                                            <?php if ($list['status'] == 1) {?>
                                                <img src="/assets/admin/dist/img/Ellipse30.png" alt="">
                                            <?}else if($list['status'] == 0){?>
                                                <img src="/assets/admin/dist/img/Ellipse_88.png" alt="">
                                            <?} ?>
                                        </td>
                                        <td><input type="checkbox" class="check-show" <?=$list['robots'] == 1 ? 'disabled' : ''?> value="<?= $list['id'] ?>" <?= ($list['robots'] == 1)?'checked':'' ?>></td>
                                        <td class="form-group">
                                            <a href="edit_product/<? echo $list['id'] ?>" class="btn btn-primary" style="padding: 4px 6px;"><i
                                                        class="glyphicon glyphicon-pencil"></i></a>
                                        </td>
                                    </tr>
                                <?} 
                            }?> 
                            </tbody>
                        </table>
                        <div class="t_paginate">
                            <div class="t_paginate_group">  
                                    <?=$links; ?>          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
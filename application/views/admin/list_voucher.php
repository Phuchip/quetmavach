<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Danh sách mã giảm giá
            <small>Danh mục sản phẩm</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i>Danh sách mã giảm giá</a></li>
            <li><a href=""> Danh mục sản phẩm</a></li>
        </ol>
    </section>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body ">
                    <div class="input-group " style="display: flex;width: 100%;justify-content: flex-end;">
                        <div class="input-group-append ml-2" style="margin-left: 1.5rem!important;">
                            <button style="margin-bottom: 15px;border: 1px solid #979797;background: linear-gradient(to bottom, white 0%, #dcdcdc 100%);border-radius: 5px;"><a href="/admin/add_edit_voucher">Thêm mới</a></button>
                        </div>
                    </div>
                    <div class="content_search">
                        <table data-toolbar="#toolbar" data-toggle="table" class="table table-hover" id="list_tag">
                            <thead style="background: #f1f4f7;">
                                <tr>
                                    <th data-field="stt" data-sortable="true">ID</th>
                                    <th data-field="account1" data-sortable="true">Mã</th>
                                    <th data-field="account" data-sortable="true">Loại giảm giá</th>
                                    <th data-field="account2" data-sortable="true">Giảm giá</th>
                                    <th data-field="account4" data-sortable="true">Ngày bắt đầu</th>
                                    <th data-field="account5" data-sortable="true">Ngày kết thúc</th>
                                    <th data-field="account6" data-sortable="true">Áp dụng</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody class="">
                            <?php if(!empty($list_voucher)){
                                foreach($list_voucher as $list){ ?> 
                                    <tr>
                                        <td> <?=$list['id']?></td>
                                        <td><?= $list['code'] ?></td>
                                         <td>
                                            <?php if ($list['type'] == 1) {
                                                echo "Theo tiền";
                                            }else{
                                                echo "Theo phần trăm";
                                            } ?>
                                         </td>
                                        <td>
                                            <?php if ($list['type'] == 1) {
                                                echo number_format($list['price']).'đ';
                                            }else{
                                                echo $list['discount'].'%';
                                            } ?>
                                        </td>
                                        <td><?= format_date($list['start_day']) ?></td>
                                        <td><?= format_date($list['end_day']) ?></td>
                                        <td>
                                            <?php if ($list['status'] == 1) {?>
                                                <img src="/assets/admin/dist/img/Ellipse30.png" alt="">
                                            <?}else if($list['status'] == 0){?>
                                                <img src="/assets/admin/dist/img/Ellipse_88.png" alt="">
                                            <?} ?>
                                        </td>
                                        <td class="form-group">
                                            <a href="add_edit_voucher?id=<? echo $list['id'] ?>" class="btn btn-primary" style="padding: 4px 6px;"><i
                                                        class="glyphicon glyphicon-pencil"></i></a>
                                            <a href="delete_voucher/<? echo $list['id'] ?>" class="btn btn-danger" style="padding: 4px 6px;" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i
                                                        class="glyphicon glyphicon-trash"></i></a>
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


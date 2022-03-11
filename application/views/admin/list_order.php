<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Danh sách Đơn hàng
            <small>Danh mục sản phẩm</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i>Danh sách Đơn hàng</a></li>
            <li><a href=""> Danh mục sản phẩm</a></li>
        </ol>
    </section>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body ">
                    <div class="input-group " style="display: flex;width: 100%;justify-content: flex-end;">
                        <div class="input-group-append ml-2" style="margin-left: 1.5rem!important;">
                            <button style="margin-bottom: 15px;border: 1px solid #979797;background: linear-gradient(to bottom, white 0%, #dcdcdc 100%);border-radius: 5px;"><a href="/admin/add_edit_tags">Thêm mới</a></button>
                        </div>
                    </div>
                    <div class="content_search">
                        <table data-toolbar="#toolbar" data-toggle="table" class="table table-hover" id="list_tag">
                            <thead style="background: #f1f4f7;">
                                <tr>
                                    <th data-field="stt" data-sortable="true">ID</th>
                                    <th data-field="account1" data-sortable="true">Tên khách hàng</th>
                                    <th data-field="account" data-sortable="true">Số điện thoại</th>
                                    <th data-field="account2" data-sortable="true">Địa chỉ</th>
                                    <th data-field="account3" data-sortable="true">Số sản phẩm</th>
                                    <th data-field="account4" data-sortable="true">Tổng tiền</th>
                                    <th data-field="account5" data-sortable="true">Trạng thái</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody class="">
                            <?php if(!empty($list_order)){
                                foreach($list_order as $list){ ?> 
                                    <tr>
                                        <td> <?=$list['id']?></td>
                                        <td><a href="view_order/<?= $list['id'] ?>"><?= $list['name'] ?></a></td>
                                         <td><?= $list['phone'] ?></td>
                                        <td><?= $list['address'] ?></td>
                                        <td><?= $list['quantity'] ?></td>
                                        <td><?= $list['total'] ?> đ</td>
                                        <td>
                                            <?php if ($list['status'] == 3) {?>
                                                <select name="status" data-id="<?= $list['id'] ?>" class="status_order form-control" disabled="disabled">
                                                    <option>Hoàn thành</option>
                                                </select>
                                            <?} else {?>
                                                <select name="status" data-id="<?= $list['id'] ?>" class="status_order form-control">
                                                    <option <?= ($list['status'] == 1 )?'selected':'' ?> value="1">Chờ xác nhận</option>
                                                    <option <?= ($list['status'] == 2 )?'selected':'' ?> value="2">Tư vấn</option>
                                                    <option <?= ($list['status'] == 3 )?'selected':'' ?> value="3">Hoàn thành</option>
                                                </select>
                                            <?}?>
                                        </td>
                                        <td class="form-group">
                                            <a href="delete_order/<? echo $list['id'] ?>" class="btn btn-danger" style="padding: 4px 6px;" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i
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


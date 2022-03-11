<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Danh sách Tags
            <small>Danh mục sản phẩm</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i>Danh sách Tags</a></li>
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
                                    <th data-field="account1" data-sortable="true">Tên</th>
                                    <th data-field="account" data-sortable="true">Hiển thị</th>
                                    <th data-field="account2" data-sortable="true">Mở index</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody class="">
                            <?php if(!empty($list_tags)){
                                foreach($list_tags as $list){ ?> 
                                    <tr>
                                        <td> <?=$list['id']?></td>
                                        <td><?php echo $list['name'] ?></td>
                                        <td>
                                            <?php if ($list['status'] == 1) {?>
                                                <img src="/assets/admin/dist/img/Ellipse30.png" alt="">
                                            <?}else if($list['status'] == 0){?>
                                                <img src="/assets/admin/dist/img/Ellipse_88.png" alt="">
                                            <?} ?>
                                        </td>
                                        <td><input type="checkbox" class="check-show-tag" <?=$list['robots'] == 1 ? 'disabled' : ''?> value="<?= $list['id'] ?>" <?= ($list['robots'] == 1)?'checked':'' ?>></td>
                                        <td class="form-group">
                                            <a href="add_edit_tags?id=<? echo $list['id'] ?>" class="btn btn-primary" style="padding: 4px 6px;"><i
                                                        class="glyphicon glyphicon-pencil"></i></a>
                                            <a href="delete_tags/<? echo $list['id'] ?>" class="btn btn-danger" style="padding: 4px 6px;" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i
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


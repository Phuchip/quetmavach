<?php   
$CI=&get_instance();
$CI->load->model('Admin_model');
 ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Danh sách Bình luận
            <small>Danh mục sản phẩm</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i>Danh sách Bình luận</a></li>
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
                                    <th data-field="stt" data-sortable="true">Mã bình luận</th>
                                    <th data-field="account1" data-sortable="true">Tên khách hàng</th>
                                    <th data-field="account" data-sortable="true">Nội dung</th>
                                    <th data-field="account2" data-sortable="true">Thời gian</th>
                                    <th data-field="account3" data-sortable="true">Bình luận con</th>
                                    <th data-field="account4" data-sortable="true">Trả lời</th>
                                    <th data-field="account5" data-sortable="true">Hiển thị</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody class="">
                            <?php if(!empty($list_comment)){
                                foreach($list_comment as $list){ ?> 
                                    <tr>
                                        <?php 
                                        $check_rep = $this->Admin_model->select_data('tbl_comments','*',array('parent'=>$list['id'],'isAdmin !='=> 0),null,array('created_time'  => "DESC"),null,null,1);
                                         ?>
                                        <td> <?=$list['id']?></td>
                                        <td><a href="view_comment/<?= $list['id'] ?>"><?= $list['name'] ?></a></td>
                                         <td><?= $list['comment'] ?></td>
                                        <td><?= date('H:i d/m/Y',$list['created_time']) ?></td>
                                        <td>
                                            <a href="<?= '/'.$list['alias'].'-id-'.$list['product_id'].'.html' ?>"><?= ($list['parent'] == 0)?'':$list['parent'] ?></a>
                                        </td>
                                        <td style="color: #1cc88a;"><?= (count($check_rep) > 0)?'<i class="fa fa-check color-check"></i>':''  ?></td>
                                        <td>
                                            <input type="checkbox" class="check-show-coment" value="<?= $list['id'] ?>" <?= ($list['status'] == 1)?'checked':'' ?>>
                                        </td>
                                        <td class="form-group">
                                            <a href="delete_comment/<? echo $list['id'] ?>" class="btn btn-danger" style="padding: 4px 6px;" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i
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


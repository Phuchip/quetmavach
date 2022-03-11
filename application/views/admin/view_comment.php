<style type="text/css">
    .show-comment .show-reply {
        background: #dfe7e7;
        border-radius: 5px;
        padding: 13px 17px;
        width: 60%;
        display: flex;
        justify-content: space-between;
    }.show-reply {
        margin-bottom: 15px;
    }   .show-reply .show-reply-left {
        display: flex;
    }.show-reply .reply-avt {
        margin-right: 13px;
    }.show-reply .reply-cmt .reply-cmt-name {
        font-weight: 500;
        font-size: 14px;
        line-height: 16px;
        color: #2767A5;
    }.show-reply .reply-cmt .reply-cmt-content {
        font-size: 14px;
        line-height: 16px;
        color: #211D1E;
    }.show-comment p {
        margin-bottom: 1rem;
    }.reply-cmt p {
        color: #211D1E;
    }.show-comment .cmt-date-time {
        font-size: 14px;
        line-height: 16px;
        color: #909090;
    }.info-cmt a {
        font-size: 14px;
        line-height: 16px;
        color: #2767A5;
        text-decoration: none;
    }.show-comment {
        display: flex;
        padding: 17px;
        border-top: 0.635036px dashed #D5D5D5;
    }   

</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
           Bình luận
            <small>Danh mục sản phẩm</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i>Bình luận</a></li>
            <li><a href=""> Danh mục sản phẩm</a></li>
        </ol>
    </section>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body ">
                    <div class="content_search">
                        <table class="table table-bordered" id="list_tag">
                            <thead style="background: #f1f4f7;">
                                <tr>
                                    <td class="text-left" colspan="2"><h4>Chi tiết bình luận</h4></td>
                                </tr>
                            </thead>
                             <tbody>
                                <tr>
                                    <td class="text-left" style="width: 50%;">
                                        <b>Mã sản phẩm:</b> #<?= $cmt['id_product'] ?><br>
                                        <b>Thời gian:</b> <?= date("H:i d/m/Y", $cmt['created_time']) ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered ">
                            <thead style="background: #f1f4f7;">
                                <tr>
                                    <td class="text-left">Thông tin khách hàng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <table style="width:100%" class="table table-bordered">
                                            <thead>
                                                <td style="width:40%">Tên khách hàng</td>
                                                <td style="width:20%">Số điện thoại</td>
                                                <td style="width:30%">Email</td>
                                            </thead>
                                            <tbody>
                                                <th><?= $cmt['name'] ?></th>
                                                <th><?= ($cmt['phone'] != '')?$cmt['phone']:'Chưa cập nhật' ?></th>
                                                <th><?= ($cmt['email'] != '')?$cmt['email']:'Chưa cập nhật' ?></th>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h4>Bình luận</h4>
                        <div class="show-comment">
                            <div class="col-md-3 info-user" style="text-align: center;">
                                <div class="cmt-avatar">
                                    <img class=" lazyloaded" src="/assets/admin/dist/img/Ellipse_83.png" data-src="/assets/admin/dist/img/Ellipse_83.png" alt="Avtar user">
                                </div>
                                <div class="name-date-cmt-mobile">
                                    <p class="cmt-name"><?= $cmt['name'] ?></p>
                                    <div class="cmt-date-time">
                                        <span class="cmt-date"><?= date('d/m/Y',$cmt['created_time']) ?></span>
                                        <span class="cmt-time"><?= date('H:i',$cmt['created_time']) ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 info-cmt">
                                <p class="cmt-content"> <?= $cmt['comment'] ?></p>
                                <a href="" class="reply" data-toggle="modal" data-target="#quickModal">Trả lời</a>
                                <?php if(!empty($cmt_parent)){
                                    foreach($cmt_parent as $row){ ?> 
                                    <div class="show-reply d-flex">
                                        <div class="show-reply-left">
                                            <div class="reply-avt">
                                                <img class=" lazyloaded" src="/assets/admin/dist/img/Ellipse_84.png" data-src="/assets/admin/dist/img/Ellipse_84.png">
                                            </div>
                                            <div class="reply-cmt">
                                                <p class="reply-cmt-name"><?= $row['name'] ?></p>
                                                <p class="reply-cmt-content"><?= $row['comment'] ?></p>
                                                <div class="cmt-date-time">
                                                    <span class="cmt-date"><?= date('d/m/Y',$row['created_time']) ?></span>
                                                    <span class="cmt-time"><?= date('H:i',$row['created_time']) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="delete">
                                            <a href="../delete_cmt_parent/<?= $row['id']?>"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>  
                                <? }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal reply -->
<div class="modal fade" id="quickModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content container-modal-form">
            <div class="modal-header">
                <h4 class="modal-title-form">Trả lời bình luận</h4>
                <button type="button" class="close modal-close-btn ml-auto" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>
          <div class="modal-body">
                <form method="">
                    <div class="form-group">
                        <textarea name="comment" type="text" id="comment" required class="form-control"></textarea>
                    </div>
                    <input type="hidden" name="" id="id_cmt" value="<?php echo $cmt['id'] ?>">
                    <button type="submit" name="submit" id="reply_cmt" value="<?= $cmt['id_product'] ?>" class="btn btn-info">Bình luận</button>
                </form>
            </div>
      </div>
  </div>
</div>
<script src="/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
  CKEDITOR.replace('comment');
</script>

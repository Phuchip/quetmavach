<style type="text/css">
    .user-img .avt{border-radius:50%;}
    .error {color: red;}
</style>
<?php
    if ($type == "add") {
        $title = "Thêm mới";
        $submit = "add";
    }else if($type == "edit"){
        $title = "Cập nhật";
        $submit = "edit";
    }
?>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title ?> tags 
        <small>Danh mục sản phẩm</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Danh mục sản phẩm</a></li>
        <li><a href="#"><?php echo $title ?> tags</a></li>
      </ol>
    </section>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form" id="add_edit_tags">
                        <input type="hidden" name="" id="id" value="<?= (isset($tags)) ? $tags['id'] : '' ?>">
                        <input type="hidden" name="" id="submit" value="<?php echo $submit ?>">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Tên tags <span>*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập nôi dung" value="<?= (isset($tags)) ? $tags['name'] : '' ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Hiển thị<span>*</span></label>
                                    <select name="status" id="status" class="form-control">
                                       <option value="1"  <? if ($type == "edit") {if($tags['status'] == '1' ) echo "selected";}?>>Bật</option>
                                        <option value="0"  <? if ($type == "edit") {if($tags['status'] == '0' ) echo "selected";}?>>Tắt</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Hiển thị bài viết<span>*</span></label>
                                    <select name="show_post" id="show_post" class="form-control">
                                       <option value="1"  <? if ($type == "edit") {if($tags['show_post'] == '1' ) echo "selected";}?>>Bật</option>
                                        <option value="0"  <? if ($type == "edit") {if($tags['show_post'] == '0' ) echo "selected";}?>>Tắt</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nội dung tag <span>*</span></label>
                                    <textarea name="content" type="text" id="content" class="form-control"><?= (isset($tags)) ? $tags['content'] : '' ?></textarea>
                                </div>
                            </div>
                        </div>
                        <h3>Gợi ý</h3>
                        <div class="row">
                             <div class="form-group">
                                <div class="col-md-8">
                                    <label>Tiêu đề gợi ý</label>
                                    <input name="title_suggest" type="text" id="title_suggest" class="form-control" value="<?= (isset($tags)) ? $tags['title_suggest'] : '' ?>">
                                </div>
                                <div class="col-md-12">
                                    <label>Nội dung gợi ý</label>
                                    <textarea name="content_suggest" type="text" id="content_suggest" class="form-control"><?= (isset($tags)) ? $tags['content_suggest'] : '' ?></textarea>
                                </div>
                            </div>
                        </div>
                        <h3>SEO</h3>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Title : </label>
                                    <input name="title" type="text" id="title" class="form-control" value="<?= (isset($tags)) ? $tags['title'] : '' ?>">
                                </div>
                                <div class="col-md-12">
                                    <label>Description (tối đa 160 ký tự): </label>
                                    <input name="description" maxlength="160" id="description" type="text" class="form-control" value="<?= (isset($tags)) ? $tags['description'] : '' ?>">
                                </div>
                                <div class="col-md-12">
                                    <label>Keyword : </label>
                                    <input name="keyword" type="text" id="keyword" class="form-control" value="<?= (isset($tags)) ? $tags['keyword'] : '' ?>">
                                </div>
                            </div>
                        </div>
                         <div class="infor-tt text-center">
                            <button class="btn btn_reg1 click_add_tutor" type="submit" name=""><?php echo $title ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'content' );
    CKEDITOR.replace( 'content_suggest');
</script>
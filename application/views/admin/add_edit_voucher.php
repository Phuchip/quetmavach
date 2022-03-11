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
        <?php echo $title ?> mã giảm giá 
        <small>Danh mục sản phẩm</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Danh mục sản phẩm</a></li>
        <li><a href="#"><?php echo $title ?> mã giảm giá</a></li>
      </ol>
    </section>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form" id="add_edit_voucher">
                        <input type="hidden" name="" id="id" value="<?= (isset($voucher)) ? $voucher['id'] : '' ?>">
                        <input type="hidden" name="" id="submit" value="<?php echo $submit ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Mã giảm giá <span>*</span></label>
                                    <input type="text" class="form-control" id="code" name="code" placeholder="Nhập nôi dung" value="<?= (isset($voucher)) ? $voucher['code'] : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Loại giảm giá<span>*</span></label>
                                    <select name="type" id="type" class="form-control">
                                       <option value="">Chọn loại giảm giá</option>
                                       <option value="1"  <? if ($type == "edit") {if($voucher['type'] == '1' ) echo "selected";}?>>Theo tiền</option>
                                        <option value="2"  <? if ($type == "edit") {if($voucher['type'] == '2' ) echo "selected";}?>>Theo phần trăm</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Ngày bắt đầu <span>*</span></label>
                                    <input type="date" class="form-control" id="start_day" name="start_day" placeholder="Nhập nôi dung" value="<? if(isset($voucher)){echo date('Y-m-d',$voucher['start_day']);}  ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Áp dụng<span>*</span></label>
                                    <select name="status" id="status" class="form-control">
                                       <option value="1"  <? if ($type == "edit") {if($voucher['status'] == '1' ) echo "selected";}?>>Bật</option>
                                        <option value="0"  <? if ($type == "edit") {if($voucher['status'] == '0' ) echo "selected";}?>>Tắt</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Giảm giá<span>*</span></label>
                                    <?php 
                                    if (isset($voucher)) {
                                    	if ($voucher['type'] == '1') {?>
                                    		<input type="text" class="form-control" id="price_discount" name="price_discount" placeholder="Nhập nôi dung" value="<?= (isset($voucher)) ? $voucher['price'] : '' ?>">
                                    	<?}else{?>
                                    		<input type="text" class="form-control" id="price_discount" name="price_discount" placeholder="Nhập nôi dung" value="<?= (isset($voucher)) ? $voucher['discount'] : '' ?>">
                                    	<?}
                                    }else{?>
                                		<input type="text" class="form-control" id="price_discount" name="price_discount" placeholder="Nhập nôi dung" value="<?= (isset($voucher)) ? $voucher['price'] : '' ?>">
                                    <?}?>
                                </div>
                                <div class="form-group">
                                    <label for="">Ngày kết thúc<span>*</span></label>
                                    <input type="date" class="form-control" id="end_day" name="end_day" placeholder="Nhập nôi dung" value="<? if(isset($voucher)){echo date('Y-m-d',$voucher['end_day']);}  ?>">
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
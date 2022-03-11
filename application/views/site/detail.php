<main class="container-fluid content">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb pt-4">
            <li class="breadcrumb-item"><a class="breadcrumb-home" href="/"><i class="icon-home"></i>Trang chủ</a></li>
            <li class="breadcrumb-item"><a class="breadcrumb-home" href="/tat-ca-may-quet-ma-vach.html">Máy quét mã vạch</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= rewrite_title($data['name']); ?></li>
        </ol>
    </nav>
    <div class="item-content">
        <div class="content-left">
            <div class="info-item">
                <div class="image-item" id="gallery">
                    <div class="main-image">
                        <div class="gallery-slide">
                            <img class="lazyload" src="/images/loading.gif" data-src="/images/item/<?= $data['image'] ?>" alt="<?= rewrite_title($data['name']); ?>">
                        </div>
                        <?php $lib_image = explode(',', $data['des_images']); ?>
                        <?php foreach ($lib_image as $key => $value) { ?>
                            <div class="gallery-slide">
                                <img class="lazyload" src="/images/loading.gif" data-src="/images/item/<?= $value ?>" alt="ảnh sản phẩm <?= $key ?>">
                            </div>
                        <? } ?>
                    </div>
                    <div class="gallery-list">
                        <div class="column active">
                            <img class="demo cursor lazyload" src="/images/loading.gif" data-src="/images/item/<?= $data['image'] ?>" onclick="currentSlide(1)" alt="<?= rewrite_title($data['name']); ?>">
                        </div>
                        <?php $i = 2;foreach ($lib_image as $key => $value) { ?>
                            <div class="column">
                                <img class="demo cursor lazyload" src="/images/loading.gif" data-src="/images/item/<?= $value ?>" onclick="currentSlide(<?= $i ?>)" alt="Mô tả <?= $i ?>">
                            </div>
                        <?php $i++; } ?>
                    </div>
                </div>
                <div class="info-item-content">
                    <p class="info-item-title"><?= rewrite_title($data['name']); ?></p>
                    <div class="code-item">
                        <p>Mã sản phẩm: </p>
                        <p><?= $data['code_product'] ?></p>
                    </div>
                    <div class="para-item">
                        <p class="para-title">Thông số sản phẩm</p>
                        <ul class="para-content">
                            <?php $para = explode('|', $data['parameter']);foreach ($para as $key => $value) { ?>
                            <li>
                                <i class="icon-check-circle"></i><?= $value ?>
                            </li>
                            <? } ?>
                        </ul>
                    </div>
                    <div class="detail-price">
                        <div class="price">
                            <div class="item-price-old">
                                <p>Giá cũ</p>
                                <p class="price-old"><?= formatPrice($data['price_old']) ?>đ</p>
                            </div>
                            <div class="item-price-new">
                                <p>Giá mới</p>
                                <p class="price-new"><?= price_new($data['price_old'],$data['discount']) ?>đ</p>
                            </div>
                        </div>
                        <div class="item-discount">
                            <img class="lazyload" src="/images/loading.gif" data-src="/images/icon/discount.svg" alt="discount">
                            <p>Giảm <?= $data['discount'] ?>%</p>
                        </div>
                    </div>
                    <div class="special-discount">
                        <div class="sd-title db-768"><p>Khuyến mã đặc biệt</p></div>
                        <div class="sd-content db-768">
                            <div class="sd-gift">
                                <i class="icon-presents"></i>
                                <p>Tặng kèm phần mềm quản lý bán hàng <span class="color-red">miễn phí trọn đời</span></p>
                            </div>
                        </div>
                        <img class="lazyload" src="/images/loading.gif" data-src="/images/banner/Group_gift.png" alt="Khuyến mại đặc biệt">
                    </div>
                    <div class="item-quantity">
                        <div class="quantity">
                            <p>Số lượng</p>
                            <div class="btn-quantity">
                                <button class="plus">+</button><input type="number" data-id="<?= $data['id'] ?>" value="1" placeholder="1" class="input-quantity"><button class="minus">-</button>
                            </div>
                        </div>
                        <div class="add-cart">
                            <input type="hidden" id="id_product" name="id_product" value="<?= $data['id'] ?>">
                            <button class="btn-add-cart"><i class="icon-cart"></i> Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                    <div class="order-now">
                        <button class="btn-order-now">Đặt hàng ngay</button>
                    </div>
                </div>
            </div>
            <div class="info-buy db-1024">
                <div class="ib-left">
                    <img class="lazyload" src="/images/loading.gif" data-src="/images/banner/detail-right.png" alt="banner right">
                </div>
                <div class="ib-right">
                    <div class="commit-ship">
                        <div class="cs-title">
                            <p>Yên tâm mua hàng</p>
                        </div>
                        <ul class="cs-content">
                            <li>
                                <i class="icon-check-circle"></i>Uy tín 20 năm xây dựng và phát triển
                            </li>
                            <li>
                                <i class="icon-check-circle"></i>Sản phẩm chính hãng 100%
                            </li>
                            <li>
                                <i class="icon-check-circle"></i>Trả góp lãi suất 0% toàn bộ giỏ hàng
                            </li>
                            <li>
                                <i class="icon-check-circle"></i>Trả bảo hành tận nơi sử dụng

                            </li>
                            <li>
                                <i class="icon-check-circle"></i>Bảo hành tận nơi cho doanh nghiệp
                            </li>
                        </ul>
                    </div>
                    <div class="commit-ship">
                        <div class="cs-title">
                            <p>Miễn phí giao hàng</p>
                        </div>
                        <ul class="cs-content">
                            <li>
                                <i class="icon-check-circle"></i>Giao hàng siêu tốc trong 2h
                            </li>
                            <li>
                                <i class="icon-check-circle"></i>Giao hàng miễn phí toàn quốc
                            </li>
                            <li>
                                <i class="icon-check-circle"></i>Nhận hàng và thanh toán tại nhà (ship COD)
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="review-product">
                <div class="rp-title">
                    <p>Đánh giá <?= rewrite_title($data['name']); ?></p>
                </div>
                <div class="rp-content">
                    <?= $data['review_product'] ?>
                </div>
            </div>
            <div class="para-detail db-1024">
                <div class="pd-title">
                    <p>Thông số kỹ thuật</p>
                </div>
                <div class="pd-content">
                    <p class="pd-content-title">Thông tin cơ bản</p>
                    <?php $this->load->view('include/thong_so'); ?>
                </div>
            </div>
            <div class="comment-area">
                <div class="comment-title">
                    <p>Nhận xét</p>
                </div>
                <form onsubmit="return false" class="form-comment">
                    <textarea name="comment" cols="30" rows="10" class="input-comment" placeholder="Mời bạn để lại bình luận . . ."></textarea>
                    <div class="form-footer">
                        <div class="form-info">
                            <div class="input-form cmt-name">
                                <input class="comment-name" type="text" name="name" placeholder="Nhập tên">
                            </div>
                            <div class="input-form cmt-email">
                                <input class="comment-email" type="text" name="email" placeholder="Nhập email">
                            </div>
                            <div class="input-form cmt-phone">
                                <input class="comment-phone" type="text" name="phone" placeholder="Nhập số điện thoại">
                            </div>
                        </div>
                        <div class="comment-submit">
                            <input class="id_parent" type="hidden" name="parent" value="0">
                            <button class="btn-comment send-comment">Gửi bình luận</button>
                        </div>
                    </div>
                </form>
                
                <div class="list-comment">
                    <?php if (count($comment) > 0) {
                    foreach ($comment as $key => $value) { ?>
                    <div class="show-comment">
                        <div class="info-comment">
                            <div class="user">
                                <img class="lazyload" src="/images/loading.gif" data-src="/pictures/user/no-avatar.png" alt="avt user">
                                <p class="name-user"><?= $value['name'] ?></p>
                            </div>
                            <div class="info-comment-detail">
                                <p class="name-user db-375"><?= $value['name'] ?></p>
                                <div class="date-time-comment">
                                    <p class="date-comment"><?= dayDate($value['created_time']) ?>, <?=date('d/m/Y',$value['created_time'])?> </p>
                                    <p class="time-comment"><?=date('H:i',$value['created_time'])?></p>
                                </div>
                                <div class="comment-content">
                                    <p><?= $value['comment'] ?></p>
                                </div>
                                <a href="javascript:void(0)" class="reply-comment" id="<?=$value['id']?>">Trả lời</a>
                                <?php 
                                    $data_select = '*';
                                    $condition = array(
                                        'parent'    => $value['id'],
                                        'status'    => 1,
                                        'id_product'=> $id,
                                    );
                                    $order = array('created_time','DESC');
                                    $data_reply = $this->Site_model->select_data('tbl_comments',$data_select,$condition,null,$order, null, null,1);
                                    if(count($data_reply) > 0){
                                        foreach ($data_reply as $key2 => $value2) { ?>
                                <div class="info-reply-comment">
                                    <i class="icon-reply"></i>
                                    <div class="user-reply">
                                        <img class="lazyload" src="/images/loading.gif" data-src="/pictures/user/timviec365.png" alt="avt user reply">
                                    </div>
                                    <div class="info-comment-reply">
                                        <div class="name-user-reply"><p><?= $value2['name'] ?></p></div>
                                        <div class="reply-content">
                                            <p><?= $value2['comment'] ?></p>
                                        </div>
                                        <div class="date-time-comment">
                                            <p class="date-comment"><?= dayDate($value2['created_time']) ?>, <?=date('d/m/Y',$value2['created_time'])?> </p>
                                            <p class="time-comment"><?=date('H:i',$value2['created_time'])?></p>
                                        </div>
                                    </div>
                                </div>
                                <? } }?>
                            </div>
                        </div>
                    </div> 
                    <? } }?>
                </div>
            </div>
        </div>
        <div class="content-right">
            <div class="image-right">
                <img class="lazyload" src="/images/loading.gif" data-src="/images/banner/detail-right.png" alt="banner right">
            </div>
            <div class="commit-ship">
                <div class="cs-title">
                    <p>Yên tâm mua hàng</p>
                </div>
                <ul class="cs-content">
                    <li>
                        <i class="icon-check-circle"></i>Uy tín 20 năm xây dựng và phát triển
                    </li>
                    <li>
                        <i class="icon-check-circle"></i>Sản phẩm chính hãng 100%
                    </li>
                    <li>
                        <i class="icon-check-circle"></i>Trả góp lãi suất 0% toàn bộ giỏ hàng
                    </li>
                    <li>
                        <i class="icon-check-circle"></i>Trả bảo hành tận nơi sử dụng

                    </li>
                    <li>
                        <i class="icon-check-circle"></i>Bảo hành tận nơi cho doanh nghiệp
                    </li>
                </ul>
            </div>
            <div class="commit-ship">
                <div class="cs-title">
                    <p>Miễn phí giao hàng</p>
                </div>
                <ul class="cs-content">
                    <li>
                        <i class="icon-check-circle"></i>Giao hàng siêu tốc trong 2h
                    </li>
                    <li>
                        <i class="icon-check-circle"></i>Giao hàng miễn phí toàn quốc
                    </li>
                    <li>
                        <i class="icon-check-circle"></i>Nhận hàng và thanh toán tại nhà (ship COD)
                    </li>
                </ul>
            </div>
            <div class="para-detail">
                <div class="pd-title">
                    <p>Thông số kỹ thuật</p>
                </div>
                <div class="pd-content">
                    <p class="pd-content-title">Thông tin cơ bản</p>
                    <?php $this->load->view('include/thong_so'); ?>
                </div>
            </div>
            <div class="image-right-bottom">
                <img class="lazyload" src="/images/loading.gif" data-src="/images/banner/detail-right-bottom.png" alt="banner right">
            </div>
        </div>
    </div>
    <div class="home-slide banner-detail db-1024">
        <img class="pd-0 lazyload" src="/images/loading.gif" data-src="/images/banner/slide.png" alt="">
    </div>
    <div class="product-relate">
        <div class="pr-head">
            <p class="pr-title">Sản phẩm tương tự</p>
        </div>
        <div class="pr-item list-item">
            <?php if(count($data_relate) > 0){
                foreach ($data_relate as $key => $value) { ?>
                <div class="item">
                    <div class="item-image">
                        <a href="<?= rewrite_url($value['id'],$value['alias']); ?>">
                            <img class="lazyload" src="/images/loading.gif" data-src="/images/item/<?= $value['image'] ?>" alt="<?= rewrite_title($value['name']) ?>">
                        </a>
                    </div>
                    <div class="item-body">
                        <div class="item-code">
                            <p>Mã sản phẩm :</p>
                            <p><?= $value['code_product'] ?></p>
                        </div>
                        <p class="item-title">
                            <a href="<?= rewrite_url($value['id'],$value['alias']); ?>"><?= rewrite_title($value['name']) ?></a>
                        </p>
                        <div class="item-gift">
                            <i class="icon-presents"></i>
                            <p>Tặng kèm phần mềm quản lý bán hàng <span class="color-red">miễn phí trọn đời</span></p>
                        </div>
                        <div class="item-price">
                            <div class="price">
                                <p class="price-old"><?= formatPrice($value['price_old']); ?>đ</p>
                                <p class="price-new"><?= price_new($value['price_old'],$value['discount']); ?>đ</p>
                            </div>
                            <?php if ($value['discount'] > 0) { ?>
                            <div class="item-discount">
                                <img class="lazyload" src="/images/loading.gif" data-src="/images/icon/discount.svg" alt="discount">
                                <p>Giảm <?= $value['discount'] ?>%</p>
                            </div>
                            <? } ?>
                        </div>
                    </div>
                    <div class="item-footer">
                        <button class="item-contact">
                            <i class="icon-contact"></i>
                            <p>Liên hệ tư vấn ngay </p>
                        </button>
                        <button class="add-to-cart" data-id="<?= $value['id'] ?>">
                            <i class="icon-cart"></i>
                        </button>
                    </div>
                </div>
            <?  }
            } ?>
            <div class="seemore-475">
                <a href="/tat-ca-may-quet-ma-vach.html" class="seemore">Xem tất cả</a>
            </div>
        </div>
    </div>
</main>
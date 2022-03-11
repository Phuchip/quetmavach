<main class="container-fluid content">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb pt-4">
			<li class="breadcrumb-item"><a class="breadcrumb-home" href="/"><i class="icon-home"></i>Trang chủ</a></li>
			<li class="breadcrumb-item active" aria-current="page">Máy quét mã vạch</li>
		</ol>
	</nav>
	<div class="home-filter">
		<div class="row justify-content-between">
			<div class="hf-left">
				<div class="hf-left-top"><p>Danh mục</p></div>
				<?php $this->load->view('include/filter'); ?>
			</div>
			<div class="hf-right search-right">
				<div class="search-filter">
					<div class="are-filter">
						<?php $this->load->view('include/list_filter'); ?>
					</div>
				</div>
				<div class="search-title">
					<div class="filter-tablet">
						<button class="btn-filter">Danh mục sản phẩm</button>
						<div class="hf-left-body">
                            <ul class="manufacturer">
                                <?php foreach ($array_manu as $key => $value) { if($value['quantity'] > 0){ ?>
                                    <li><a href="<?= rewrite_manu($value['id'],$value['alias']) ?>"><?= $value['name'] ?> ( <?= $value['quantity'] ?> )</a></li>
                                <? }} ?>
                            </ul>
                            <ul class="category">
                                <p>Loại đầu đọc mã vạch</p>
                                <?php $array_cate = array_cate();$array_ray = array_ray();$array_style = array_style();$array_connect = array_connect(); ?>
                                <?php foreach ($array_cate as $value) { ?>
                                <li>
                                    <input class="ft-mb" type="checkbox" value="<?= $value['id'] ?>" <?= (in_array($value['id'], $cate)) ? 'checked' : '' ?>>
                                    <label><?= $value['name'] ?></label>
                                </li>
                                <? } ?>
                                
                            </ul>
                            <ul class="ray-types">
                                <p>Loại tia</p>
                                <?php foreach ($array_ray as $value) { ?>
                                <li>
                                    <input class="ft-mb" type="checkbox" value="<?= $value['id'] ?>" <?= (in_array($value['id'], $ray_type)) ? 'checked' : '' ?>>
                                    <label><?= $value['name'] ?></label>
                                </li>
                                <? } ?>
                            </ul>
                            <ul class="item-style">
                                <p>Kiểu dáng</p>
                                <?php foreach ($array_style as $value) { ?>
                                <li>
                                    <input class="ft-mb" type="checkbox" value="<?= $value['id'] ?>" <?= (in_array($value['id'], $style)) ? 'checked' : '' ?>>
                                    <label><?= $value['name'] ?></label>
                                </li>
                                <? } ?>
                            </ul>
                            <ul class="connector">
                                <p>Kết nối</p>
                                <?php foreach ($array_connect as $value) { ?>
                                <li>
                                    <input class="ft-mb" type="checkbox" value="<?= $value['id'] ?>" <?= (in_array($value['id'], $connect)) ? 'checked' : '' ?>>
                                    <label><?= $value['name'] ?></label>
                                </li>
                                <? } ?>
                            </ul>
                        </div>
					</div>
					<p class="search-title-content">Máy quét mã vạch</p>
				</div>
				<div class="hf-right-content list-item">
					<?php if(count($data) > 0){
						foreach ($data as $key => $value) { ?>
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
					<?	}
					} ?>
				</div>
				<div class="pagination-item">
					<?= (isset($pagination) && $pagination != '')?$pagination:'' ?>
				</div>
			</div>
		</div>
	</div>
	<div class="home-slide row">
		<img class="pd-0 lazyload" src="/images/loading.gif" data-src="/images/banner/slide.png" alt="banner">
	</div>
	<div class="more-item row">
		<div class="list-more-item list-item">
			<?php for ($i = 0; $i < 12; $i++) { ?>
				<div class="item">
					<div class="item-image">
						<a href="">
							<img class="lazyload" src="/images/loading.gif" data-src="/images/product/item.png" alt="ảnh sản phẩm">
						</a>
					</div>
					<div class="item-body">
						<div class="item-code">
							<p>Mã sản phẩm :</p>
							<p>023</p>
						</div>
						<p class="item-title">
							<a href="">Máy quét mã vạch cầm tay có dây 1D SC-760S</a>
						</p>
						<div class="item-gift">
							<i class="icon-presents"></i>
							<p>Tặng kèm phần mềm quản lý bán hàng <span class="color-red">miễn phí trọn đời</span></p>
						</div>
						<div class="item-price">
							<div class="price">
								<p class="price-old">3.000.000đ</p>
								<p class="price-new">1.500.000đ</p>
							</div>
							<div class="item-discount">
								<img class="lazyload" src="/images/loading.gif" data-src="/images/icon/discount.svg" alt="discount">
								<p>Giảm 50%</p>
							</div>
						</div>
					</div>
					<div class="item-footer">
						<button class="item-contact">
							<i class="icon-contact"></i>
							<p>Liên hệ tư vấn ngay </p>
						</button>
						<button class="add-to-cart">
							<i class="icon-cart"></i>
						</button>
					</div>
				</div>
			<? } ?>
		</div>
		
	</div>
</main>
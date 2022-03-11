<main>
	<div class="banner">
		<img class="lazyload" src="/images/loading.gif" data-src="/images/banner/banner.png" alt="banner">
	</div>
	<div class="container-fluid content">
		<div class="home-filter">
			<div class="row justify-content-between">
				<div class="hf-left">
					<div class="hf-left-top"><p>Danh mục</p></div>
					<?php $this->load->view('include/filter_pc'); ?>
				</div>
				<div class="hf-right">
					<div class="hf-title">
						<p class="hf-title-content">Máy quét mã vạch</p>
						<div class="filter-tablet">
							<button class="btn-filter">Danh mục</button>
							<?php $this->load->view('include/filter_tablet'); ?>
						</div>
						<p class="hf-title-desc">Sản phẩm mới</p>
					</div>
					<div class="hf-right-content list-item">
						<?php if(count($data_new) > 0){
							foreach ($data_new as $key => $value) { ?>
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
				</div>
			</div>
		</div>
		<div class="top-sell row">
			<div class="ts-header">
				<p class="ts-header-title">Sản phẩm bán chạy</p>
				<a href="/tat-ca-may-quet-ma-vach.html" class="seemore dn-475">Xem tất cả</a>
			</div>
			<div class="ts-body list-item">
				<?php if(count($top_sell) > 0){
					foreach ($top_sell as $key => $value) { ?>
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
				}else { ?>
					<?php if(count($data_new) > 0){
						foreach ($data_new as $key => $value) { ?>
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
				<? } ?>
				<div class="seemore-475">
					<a href="/tat-ca-may-quet-ma-vach.html" class="seemore">Xem tất cả</a>
				</div>
			</div>
		</div>
		<div class="home-slide row">
			<img class="pd-0 lazyload" src="/images/loading.gif" data-src="/images/banner/slide.png" alt="banner">
		</div>
		<div class="cheap-item row">
			<div class="ci-header">
				<p class="ci-header-title">Sản phẩm giá rẻ</p>
				<a href="/tat-ca-may-quet-ma-vach.html" class="seemore dn-475">Xem tất cả</a>
			</div>
			<div class="ci-body list-item">
				<?php if(count($data_new) > 0){
					foreach ($data_new as $key => $value) { ?>
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
				<div class="seemore-475">
					<a href="/tat-ca-may-quet-ma-vach.html" class="seemore">Xem tất cả</a>
				</div>
			</div>
		</div>
	</div>
</main>
<?php $this->load->view('include/modal_form'); ?>
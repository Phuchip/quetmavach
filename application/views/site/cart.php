<main class="container-fluid content">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb pt-4">
			<li class="breadcrumb-item"><a class="breadcrumb-home" href="/"><i class="icon-home"></i>Trang chủ</a></li>
			<li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
		</ol>
	</nav>
	<div class="cart">
		<div class="cart-info dn-375">
			<ul class="table-cart">
				<li class="cart-info-head">
					<p class="all-checkbox"><input type="checkbox" id="check-all"></p>
					<p class="item-name">Sản phẩm</p>
					<p class="item-price">Đơn giá</p>
					<p class="item-quantity">Số lượng</p>
					<p class="item-total">Thành tiền</p>
					<p class="delete delete-all"><i class="icon-trash-white"></i></p>
				</li>
				<?php $total = 0;if (isset($_SESSION['cart'])) {
					foreach ($_SESSION['cart'] as $key => $value) { ?>
					<?php $item = $value['price'] * $value['quantity'];$total += $item;  ?>
					<li class="list-item-cart item-cart-<?= $value['id'] ?>" data-id="<?= $value['id'] ?>">
						<p class="all-checkbox"><input type="checkbox" class="item-checkbox" data-id="<?= $value['id'] ?>"></p>
						<p class="item-name"><a href="/may-quet-ma-vach-id-1.html">Máy quét mã vạch <?= $value['name'] ?></a></p>
						<p class="item-price">
							<span class="price-old"><?= formatPrice($value['price_old']) ?>đ</span>
							<span class="price-new"><?= formatPrice($value['price']) ?>đ</span>
						</p>
						<p class="item-quantity">
							<button class="plus">+</button><input type="number" data-id="<?= $value['id'] ?>" value="<?= $value['quantity'] ?>" placeholder="1" class="input-quantity"><button class="minus">-</button>
						</p>
						<p class="item-total total-item<?= $value['id'] ?>"><?= formatPrice($item) ?>đ</p>
						<p class="delete delete-item" data-id="<?= $value['id'] ?>"><i class="icon-trash-grey"></i></p>
					</li>
				<? }} else{?>
				<li class="no-item-cart">Bạn đang không có sản phẩm nào trong giỏ hàng</li>
				<? } ?>
			</ul>
		</div>
		<div class="cart-info cart-info-m db-375">
			<?php if (isset($_SESSION['cart'])) {
					foreach ($_SESSION['cart'] as $key => $value) { ?>
			<div class="item-cart item-cart-m-<?= $value['id'] ?>">
				<div class="item-image">
					<img class="lazyload" src="/images/loading.gif" data-src="/images/items/<?= $value['image'] ?>" alt="Ảnh sản phẩm">
					<i class="icon-trash-grey delete-item-m" data-id="<?= $value['id'] ?>"></i>
				</div>
				<div class="item-name">
					<p class="item-name-cart"><a href="/may-quet-ma-vach-id-1.html">Máy quét mã vạch <?= $value['name'] ?></a></p>
				</div>
				<div class="item-gift">
					<i class="icon-presents"></i>
                    <p>Tặng kèm phần mềm quản lý bán hàng <span class="color-red">miễn phí trọn đời</span></p>
				</div>
				<div class="item-cart-footer">
					<div class="item-price">
						<span class="price-old"><?= formatPrice($value['price_old']) ?>đ</span>
						<span class="price-new"><?= formatPrice($value['price']) ?>đ</span>
					</div>
					<div class="btn-quantity item-quantity">
						<button class="plus">+</button><input type="number" data-id="<?= $value['id'] ?>" value="<?= $value['quantity'] ?>" placeholder="1" class="input-quantity"><button class="minus">-</button>
					</div>
				</div>
			</div>
			<? }} else{?>
				<li class="no-item-cart">Bạn đang không có sản phẩm nào trong giỏ hàng</li>
			<? } ?>
		</div>
		<div class="cart-payment">
			<form class="input-code" onsubmit="return false">
				<div class="code-discount">
					<input class="input-discount" type="text" placeholder="Mã giảm giá" value="<?= (isset($_SESSION['discount'])) ? $_SESSION['discount']['code'] : '' ?>">
					<button>Áp dụng</button>
				</div>
			</form>
			<div class="info-payment">
				<div class="ip-content">
					<p>Giá tiền</p>
					<p class="total-cart"><?= (isset($_SESSION['cart'])) ? formatPrice($total) : '0' ?>đ</p>
				</div>
				<div class="ip-content">
					<p>Mã giảm giá</p>
					<p class="discount-code"><?= (isset($_SESSION['discount'])) ? '-'.formatPrice($_SESSION['discount']['discount']).'đ' : '0' ?></p>
				</div>
				<div class="ip-content">
					<p>Tổng tiền</p>
					<p class="into-cart"><?php if (isset($_SESSION['cart'])) {
						if (isset($_SESSION['discount'])) {
							echo formatPrice($total - $_SESSION['discount']['discount']);
						}else {
							echo formatPrice($total);
						}
					}else {
						echo '0';
					} ?>đ</p>
				</div>
			</div>
			<a href="<?= (isset($_SESSION['cart'])) ? '/thanh-toan.html' : 'javascript:void(0)' ?>"><button class="btn-cart-submit">Đặt hàng ngay</button></a>
		</div>
	</div>
	<div class="home-slide row">
		<img class="pd-0 lazyload" src="/images/loading.gif" data-src="/images/banner/slide.png" alt="banner">
	</div>
	
</main>
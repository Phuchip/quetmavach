<header>
	<div class="row">
		<nav class="navbar navbar-expand-lg navbar-light">
			<div class="container-fluid p-md-0">
				<div class="navbar-logo">
					<a class="navbar-brand" href="/"><img class="lazyload" src="/images/loading.gif" data-src="/images/logo.png" alt="Máy quét mã vạch"></a>
				</div>
				<div class="form-search">
					<form onsubmit="return false" class="d-flex form-seach-submit" method="GET">
						<div class="group-search">
							<input id="search-box dropdown show" name="keyword" required class="search-box" type="text" placeholder="Nhập tên sản phẩm, hãng sản phẩm, mã sản phẩm,..." aria-label="Search" autocomplete="off" onkeydown="searchdropdown()">
							<button class="btn btn-search" type="submit"><i class="icon-search"></i></button>
						</div>
					</form>
					<!--dropdown-->
					<div id="suggestion-box" class="dropdown-content suggestion-box">
						<div class="icon-top-result">
							<i class="icon-result-search"></i>
						</div>
						<div class="result-search">
							<div class="bg-gray">
								<p class="suggestion-title">Có phải bạn muốn tìm</p>
							</div>
							<div class="suggestion-body sugget_tag_pc">
							</div>
							<div class="bg-gray">
								<p class="suggestion-title">Sản phẩm gợi ý</p>
							</div>
							<div class="list-item-suggest suggest_pc">
							</div>
						</div>
					</div>
				</div>

				<div class="collapse navbar-collapse" id="navbar-menu">
					<ul class=" navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item dn-tablet">
							<a class="nav-link active" href="/"><i class="icon-home"></i>Trang chủ</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="javascript:void(0)"><i class="icon-barcode"></i>Máy quét mã vạch</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="javascript:void(0)"><i class="icon-contact"></i>Liên hệ tư vấn</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/gio-hang.html"><i class="icon-cart"></i>Giỏ hàng</a>
						</li>
					</ul>
				</div>
				<div class="nav-item show-tablet">
					<a class="nav-link active" href="/"><i class="icon-home"></i>Trang chủ</a>
				</div>
				<button class="btn-navbar" type="button" id="button-navbar-menu">
					<i class="icon-menu"></i>
				</button>
			</div>
		</nav>
	</div>
</header>
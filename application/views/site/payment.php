<main class="container-fluid content">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb pt-4">
			<li class="breadcrumb-item"><a class="breadcrumb-home" href="/"><i class="icon-home"></i>Trang chủ</a></li>
			<li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
		</ol>
	</nav>
	<div class="cart">
		<div class="cart-info">
			<form method="POST" onsubmit="return false" id="validate_form" novalidate="novalidate">
                <div class="cart-left-body">
                    <div class="clb-top">
                        <div class="clb-top-left">
                            <p>Thông tin khách hàng</p>
                        </div>
                    </div>
                    <div class="clb-body">
                        <div class="clb-body-form">
                            <div class="form-first">
                                <label>Họ và tên <i class="compulsory"></i></label>
                                <div class="form-check-info">
                                    <input type="text" name="name" id="name" required="" placeholder="Nhập tên khách hàng">
                                </div>
                            </div>
                            
                            <div class="form-first">
                                <label>Địa chỉ email <i class="compulsory"></i></label>
                                <div class="form-check-info">
                                <input type="text" name="email" id="email" required="" placeholder="Nhập email"></div>
                            </div>
                            <div class="form-first">
                                <label>Số điện thoại <i class="compulsory"></i></label>
                                <div class="form-check-info">
                                <input type="text" name="phone" id="phone" required="" placeholder="Nhập số điện thoại">
                                </div>
                            </div>
                            <div class="form-first">
                                <label>Địa chỉ thường trú <i class="compulsory"></i></label>
                                <div class="form-check-info">
                                <input type="text" name="address" id="address" required="" placeholder="Nhập địa chỉ"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cart-left-second">
                    <div class="clb-top">
                        <div class="clb-top-left">
                            <p>Thông tin giao hàng</p>
                        </div>
                    </div>
                    <div class="clb-checkbox">
                        <input id="check_box" type="checkbox" name="check_box"><label>Sử dụng thông tin khách hàng để giao hàng</label>
                    </div>
                    <div class="clb-body">
                        <div class="form_second">
                            <div class="form-second">
                                <label>Họ và tên <i class="compulsory"></i></label>
                                <div class="form-check-info">
                                <input type="text" name="ship_name" id="ship_name" placeholder="Nhập tên khách hàng"></div>
                            </div>
                            <div class="form-second">
                                <label>Số điện thoại <i class="compulsory"></i></label>
                                <div class="form-check-info">
                                <input type="text" name="ship_phone" id="ship_phone" placeholder="Nhập số điện thoại"></div>
                            </div>
                            <div class="form-second">
                                <label>Địa chỉ giao nhận <i class="compulsory"></i></label>
                                <div class="form-check-info">
                                <input type="text" name="ship_address" id="ship_address" placeholder="Nhập địa chỉ giao hàng"></div>
                            </div>
                            <div class="dp-flex">
                                <label>Ghi chú</label>
                                <div class="form-check-info">
                                <textarea id="ship_note" name="ship_note" cols="30" rows="4" placeholder="Nhập ghi chú"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-submit">
                        <button class="btn-submit-form active" value="order"> Đặt ngay</button>
                    </div>
                </div>
            </form>
            <div class="info-payment dn-1024">
                <div class="info-payment-first">
                    <h2 class="ipf-title">Thông tin liên hệ</h2>
                    <div class="ipf-content">
                        <p>Hotline : <span>0971.335.869 | 024 36.36.66.99 </span></p>
                        <p>Email hỗ trợ: <span>Timviec365com@gmail.com</span></p>
                        <p>Địa chỉ: <span>Số 206 Định Công Hạ , Phường Định Công, Quận Hoàng Mai, Thành phố Hà Nội, Việt Nam</span></p>
                    </div>
                </div>
                <div class="info-payment-last">
                    <p class="ipl-title">Cách thức thanh toán</p>
                    <p class="ipl-content"><i class="ic-dot-black"></i>Thanh toán bằng chuyển khoản</p>
                    <table>
                        <tbody><tr>
                            <td>
                                <div class="payment-bank">
                                    <img class=" lazyloaded" src="../images/brands/vietcombank.png" data-src="../images/brands/vietcombank.png" alt="Viecombank">
                                </div>
                                <div class="payment-content">
                                    <p>Ngân hàng Viecombank</p>
                                    <p>Chủ tài khoản: <span>TRƯƠNG VĂN TRẮC</span></p>
                                    <p>Số tài khoản: <span>1023780714</span> </p>
                                    <p>Chi tiết: <span>PGD Định Công - Chi nhánh Hoàn Kiếm</span></p>
                                </div>
                            </td>
                            <td>
                                <div class="payment-bank">
                                    <img class=" lazyloaded" src="../images/brands/mbbank.png" data-src="../images/brands/mbbank.png" alt="Mb Bank">
                                </div>
                                <div class="payment-content">
                                    <p>Ngân hàng MBbank</p>
                                    <p>Chủ tài khoản: <span>TRƯƠNG VĂN TRẮC</span></p>
                                    <p>Số tài khoản: <span>0680114396002</span> </p>
                                    <p>Chi tiết: <span>Hà Nội</span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="payment-bank">
                                    <img class=" lazyloaded" src="../images/brands/vietinbank.png" data-src="../images/brands/vietinbank.png" alt="Vietinbank">
                                </div>
                                <div class="payment-content">
                                    <p>Ngân hàng Vietinbank</p>
                                    <p>Chủ tài khoản: <span>TRƯƠNG VĂN TRẮC</span></p>
                                    <p>Số tài khoản: <span>100874190609</span> </p>
                                    <p>Chi tiết: <span>Thanh Xuân - Hà Nội</span></p>
                                </div>
                            </td>
                            <td>
                                <div class="payment-bank">
                                    <img class=" lazyloaded" src="../images/brands/bidv.png" data-src="../images/brands/bidv.png" alt="BIDV">
                                </div>
                                <div class="payment-content">
                                    <p>Ngân hàng BIDV</p>
                                    <p>Chủ tài khoản: <span>TRƯƠNG VĂN TRẮC</span></p>
                                    <p>Số tài khoản: <span>21610000775434</span> </p>
                                    <p>Chi tiết: <span>Hoàng Mai, Hà Nội</span></p>
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                </div>
            </div>
		</div>
		<div class="cart-payment">
			<div class="info-payment-right">
				<div class="ipr-title"><p>Thông tin đơn hàng</p></div>
				<div class="ipr-content">
					<p>Số lượng sản phẩm</p>
					<p><?= (isset($num))?$num:'0' ?></p>
				</div>
				<div class="ipr-content">
					<p>Tổng tiền</p>
					<p><?= (isset($total))?$total:'0' ?>đ</p>
				</div>
			</div>
			<button class="btn-contact-submit">Liên hệ ngay</button>
		</div>
	</div>
	<div class="home-slide row">
		<img class="pd-0 lazyload" src="/images/loading.gif" data-src="/images/banner/slide.png" alt="">
	</div>
	
</main>
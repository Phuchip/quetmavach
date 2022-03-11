<!-- Modal -->
<div class="modal fade" id="form-modal" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content container-modal-form">
            <img class="bg-modal-gift lazyload" src="/images/loading.gif" data-src="/images/icon/modal-gift.svg" alt="image gift">
            <div class="modal-header">
                <p class="text-uppercase">Liên hệ tư vấn</p>
                <span>Vui lòng điền đầy đủ thông tin để được nhân viên liên hệ tư vấn sớm nhất</span>
            </div>
            <div class="modal-body">
                <form onsubmit="return false">
                    <div class="input_form_txt">
                        <label> Họ và tên</label>
                        <input type="text" name="name" placeholder="Nhập Họ và tên">
                    </div>
                    <div class="input_form_txt">
                        <label>Số điện thoại</label>
                        <input type="text" name="phone" placeholder="Nhập Số điện thoại">
                    </div>
                    <div class="input_form_txt">
                        <label>Email</label>
                        <input type="text" name="email" placeholder="Nhập Email">
                    </div>
                    <div class="input_form_txt">
                        <label>Địa chỉ</label>
                        <textarea name="address"cols="30" rows="10" placeholder="Nhập Địa chỉ"></textarea>
                    </div>
                    <input type="hidden" name="id_product">
                    <div class="btn-form-modal">
                        <button class="btn-modal-confirm">Xác nhận</button>
                        <button class="btn-modal-close">Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('include/modal_confirm'); ?>
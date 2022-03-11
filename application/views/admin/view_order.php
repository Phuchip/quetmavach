<div class="content-wrapper">
    <section class="content-header">
        <h1>
           Đơn hàng
            <small>Danh mục sản phẩm</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i>Đơn hàng</a></li>
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
                                    <td class="text-left" colspan="2"><h4>Chi tiết đơn hàng</h4></td>
                                </tr>
                            </thead>
                             <tbody>
                                <tr>
                                    <td class="text-left" style="width: 50%;">
                                        <b>Mã đơn hàng:</b> #<?= $order['id'] ?><br>
                                        <b>Ngày tạo:</b> <?= date("H:i d/m/Y", $order['created_time']) ?>
                                    </td>
                                    <td class="text-left" style="width: 50%;">
                                        <b>Phương thức thanh toán:</b> Thanh toán khi nhận hàng<br>
                                        <b>Phương thức vận chuyển:</b> Chưa có
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered ">
                            <thead style="background: #f1f4f7;">
                                <tr>
                                    <td class="text-left"><h4>Thông tin đặt hàng</h4></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <table style="width:100%" class="table table-bordered ">
                                            <thead>
                                                <td style="width:20%">Tên khách hàng</td>
                                                <td style="width:20%">Số điện thoại</td>
                                                <td style="width:30%">Email</td>
                                                <td style="width:30%">Địa chỉ</td>
                                            </thead>
                                            <tbody>
                                                <th><?= $order['name'] ?></th>
                                                <th><?= $order['phone'] ?></th>
                                                <th><?= $order['email'] ?></th>
                                                <th><?= $order['address'] ?></th>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered ">
                            <thead style="background: #f1f4f7;">
                                <tr>
                                    <td class="text-left"><h4>Thông tin giao hàng</h4></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <table style="width:100%" class="table table-bordered ">
                                            <thead>
                                                <td style="width:20%">Tên người nhận</td>
                                                <td style="width:20%">Số điện thoại</td>
                                                <td style="width:30%">Địa chỉ</td>
                                                <td style="width:30%">Ghi chú</td>
                                            </thead>
                                            <tbody>
                                                <th><?= $order['ship_name'] ?></th>
                                                <th><?= $order['ship_phone'] ?></th>
                                                <th><?= $order['ship_address'] ?></th>
                                                <th><?= $order['note'] ?></th>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered">
                            <thead style="background: #f1f4f7;">
                                <tr>
                                    <td class="text-left">Mã sản phẩm</td>
                                    <td class="text-left">Tên sản phẩm</td>
                                    <td class="text-right">Số lượng</td>
                                    <td class="text-right">Đơn giá</td>
                                    <td class="text-right">Tổng cộng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $subTotal = 0;
                                foreach($detail_order as $value){?>
                                    <tr>
                                        <td class="text-left"><?= $value['id']; ?>
                                        </td>
                                        <td class="text-left"><?= $value['name']; ?></td>
                                        <td class="text-right"><?= $value['quantity']; ?></td>
                                        <td class="text-right"><?= number_format($value['price']); ?> đ</td>
                                        <td class="text-right"><?=  number_format($value['price'] * $value['quantity']); ?> đ</td>
                                    </tr>
                                <?} $subTotal += $value['price'] * $value['quantity']; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-right"><b>Thành tiền</b></td>
                                    <td class="text-right"><?=number_format( $subTotal) ?> đ</td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-right"><b>Phí vận chuyển</b></td>
                                    <td class="text-right" style="color: green"><i>Miễn phí</i></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-right"><b>Tổng tiền</b></td>
                                    <td class="text-right"><?= $order['total'] ?> đ</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


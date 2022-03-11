<ul>
                        <li>
                            <p>Thương hiệu</p>
                            <p><?= $data['thuong_hieu'] ?></p>
                        </li>
                        <li>
                            <p>Model</p>
                            <p><?= $data['model'] ?></p>
                        </li>
                    </ul>
                    <p class="pd-content-title">Thông tin chi tiết</p>
                    <ul>
                        <li>
                            <p>Công nghệ quét</p>
                            <p><?= $data['cong_nghe_quet'] ?></p>
                        </li>
                        <li>
                            <p>Độ tương phản</p>
                            <p><?= $data['do_tuong_phan'] ?></p>
                        </li>
                        <li>
                            <p>Đọc mã vạch</p>
                            <p><?= $data['doc_ma_vach'] ?></p>
                        </li>
                        <li>
                            <p>Cổng giao tiếp</p>
                            <p><?= $data['cong_giao_tiep'] ?></p>
                        </li>
                        <li>
                            <p>Chân đế</p>
                            <p><?= ($data['chan_de'] == 1)?'Có':'Không';?></p>
                        </li>
                        <li>
                            <p>Điện áp đầu vào</p>
                            <p><?= $data['dien_ap'] ?></p>
                        </li>
                        <li>
                            <p>Độ phân giải (max)</p>
                            <p><?= $data['do_phan_giai'] ?></p>
                        </li>
                        <li>
                            <p>Độ bền, chuẩn IP</p>
                            <p><?= $data['do_ben'] ?></p>
                        </li>
                        <li>
                            <p>Góc quét</p>
                            <p><?= $data['goc_quet'] ?></p>
                        </li>
                        <li>
                            <p>Trọng lượng</p>
                            <p><?= $data['trong_luong'] ?></p>
                        </li>
                        <li>
                            <p>Kích thước</p>
                            <p><?= $data['kich_thuoc'] ?></p>
                        </li>
                        <li>
                            <p>Màu sắc</p>
                            <p><?= $data['mau_sac'] ?></p>
                        </li>
                        <li>
                            <p>Phụ kiện đi kèm</p>
                            <p><?= $data['phu_kien'] ?></p>
                        </li>
                    </ul>
                    <p class="pd-content-title">Thông số khác</p>
                    <ul>
                        <li>
                            <p>Xuất xứ</p>
                            <p><?= $data['xuat_xu'] ?></p>
                        </li>
                        <li>
                            <p>Bảo hành</p>
                            <p><?= $data['bao_hanh'] ?></p>
                        </li>
                    </ul>
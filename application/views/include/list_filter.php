<div class="are-filter-top">
							<div class="filter-tablet">
							<button class="btn-filter">Danh mục</button>
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
	                                        <input class="ft-tablet" type="checkbox" value="<?= $value['id'] ?>" <?= (in_array($value['id'], $cate)) ? 'checked' : '' ?>>
	                                        <label><?= $value['name'] ?></label>
	                                    </li>
	                                    <? } ?>
	                                    
	                                </ul>
	                                <ul class="ray-types">
	                                    <p>Loại tia</p>
	                                    <?php foreach ($array_ray as $value) { ?>
	                                    <li>
	                                        <input class="ft-tablet" type="checkbox" value="<?= $value['id'] ?>" <?= (in_array($value['id'], $ray_type)) ? 'checked' : '' ?>>
	                                        <label><?= $value['name'] ?></label>
	                                    </li>
	                                    <? } ?>
	                                </ul>
	                                <ul class="item-style">
	                                    <p>Kiểu dáng</p>
	                                    <?php foreach ($array_style as $value) { ?>
	                                    <li>
	                                        <input class="ft-tablet" type="checkbox" value="<?= $value['id'] ?>" <?= (in_array($value['id'], $style)) ? 'checked' : '' ?>>
	                                        <label><?= $value['name'] ?></label>
	                                    </li>
	                                    <? } ?>
	                                </ul>
	                                <ul class="connector">
	                                    <p>Kết nối</p>
	                                    <?php foreach ($array_connect as $value) { ?>
	                                    <li>
	                                        <input class="ft-tablet" type="checkbox" value="<?= $value['id'] ?>" <?= (in_array($value['id'], $connect)) ? 'checked' : '' ?>>
	                                        <label><?= $value['name'] ?></label>
	                                    </li>
	                                    <? } ?>
	                                </ul>
	                            </div>
							</div>
							<div class="filter-first">
								<label>Theo giá tiền</label>
								<div class="input-price">
									<input type="text" class="price-first" placeholder="666.666 đ" value="<?= (isset($_SESSION['price']))?$_SESSION['price']['min']:'666666' ?>">
									<span>-</span>
									<input type="text" class="price-second" placeholder="88.888.888 đ" value="<?= (isset($_SESSION['price']))?$_SESSION['price']['max']:'8888888' ?>">
									<button class="btn-filter-price <?= (isset($_SESSION['price']))?'active':'' ?>">Lọc</button>
								</div>
							</div>
						</div>
						<div class="filter-second">
							<div class="list-filter">
								<?php $array_filter = array_sort();foreach ($array_filter as $value) { ?>
									<button class="button-filter btn-sort <?= (isset($sort) && $sort == $value['value']) ? 'active' : '' ?>" value="<?= $value['value'] ?>"><?= $value['name'] ?></button>
								<? } ?>
							</div>
							<div class="list-filter-tablet custom-filter">
								<select name="list-filter">
									<option value="0">Phổ biến</option>
									<?php foreach ($array_filter as $value) { ?>
										<option value="<?= $value['value'] ?>" <?= (isset($sort) && $sort == $value['value']) ? 'selected' : '' ?> class="option-sort" value="new"><?= $value['name'] ?></option>
									<? } ?>
								</select>
							</div>
							<div class="custom-filter">
								<select name="custom-filter" class="filter-option">
									<option value="0">Lọc sản phẩm theo</option>
									<option value="name" class="option-filter" <?= (isset($filter) && $filter == 'name') ? 'selected' : '' ?>>Sắp xếp theo tên</option>
									<option value="rate" class="option-filter"  <?= (isset($filter) && $filter == 'rate') ? 'selected' : '' ?>>Đánh giá</option>
								</select>
							</div>
						</div>
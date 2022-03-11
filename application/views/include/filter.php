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
                                        <input class="ft-pc" type="checkbox" value="<?= $value['id'] ?>" <?= (in_array($value['id'], $cate)) ? 'checked' : '' ?>>
                                        <label><?= $value['name'] ?></label>
                                    </li>
                                    <? } ?>
                                    
                                </ul>
                                <ul class="ray-types">
                                    <p>Loại tia</p>
                                    <?php foreach ($array_ray as $value) { ?>
                                    <li>
                                        <input class="ft-pc" type="checkbox" value="<?= $value['id'] ?>" <?= (in_array($value['id'], $ray_type)) ? 'checked' : '' ?>>
                                        <label><?= $value['name'] ?></label>
                                    </li>
                                    <? } ?>
                                </ul>
                                <ul class="item-style">
                                    <p>Kiểu dáng</p>
                                    <?php foreach ($array_style as $value) { ?>
                                    <li>
                                        <input class="ft-pc" type="checkbox" value="<?= $value['id'] ?>" <?= (in_array($value['id'], $style)) ? 'checked' : '' ?>>
                                        <label><?= $value['name'] ?></label>
                                    </li>
                                    <? } ?>
                                </ul>
                                <ul class="connector">
                                    <p>Kết nối</p>
                                    <?php foreach ($array_connect as $value) { ?>
                                    <li>
                                        <input class="ft-pc" type="checkbox" value="<?= $value['id'] ?>" <?= (in_array($value['id'], $connect)) ? 'checked' : '' ?>>
                                        <label><?= $value['name'] ?></label>
                                    </li>
                                    <? } ?>
                                </ul>
                            </div>
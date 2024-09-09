<section>
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="left-sidebar">
                    <h2 class="mb-4">Danh mục</h2>
                    <div class="list-group">
                        <?php foreach ($category as $key => $cate) { ?>
                            <a href="<?php echo base_url('danh-muc/' . $cate->category_id . '/' . $cate->slug) ?>" class="list-group-item list-group-item-action">
                                <?php echo $cate->title ?>
                            </a>
                        <?php } ?>
                    </div>

                    <h2 class="mt-5 mb-4">Bộ sưu tập</h2>
                    <div class="list-group">
                        <?php foreach ($brand as $key => $bra) { ?>
                            <a href="<?php echo base_url('thuong-hieu/' . $bra->brand_id . '/' . $bra->slug) ?>" class="list-group-item list-group-item-action">
                                <?php echo $bra->title ?>
                            </a>
                        <?php } ?>
                    </div>

                    <h2 class="mt-5 mb-4">Khoảng giá</h2>
                    <div class="price-range">
                        <div class="well text-center">
                            <input type="text" class="slider" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2">
                            <br />
                            <b class="float-start">$ 0</b> <b class="float-end">$ 600</b>
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <img src="images/home/shipping.jpg" alt="" class="img-fluid rounded shadow-sm">
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="features_items">
                    <h2 class="title text-center mb-5">Sản phẩm nổi bật</h2>
                    <div class="row">
                        <?php foreach ($allproduct as $key => $pro) {?>
                            <div class="col-md-4 mb-4">
                                <div class="product-image-wrapper card h-100 shadow-sm">
                                    <form action="<?php echo base_url('add-to-cart') ?>" method="POST">
                                        <input type="hidden" value="<?php echo $pro->product_id ?>" name="product_id">
                                        <input type="hidden" min="1" value="1" name="quantity" />
                                        <div class="single-products text-center p-3 d-flex flex-column shadow p-3 mb-5 bg-body rounded">
                                            <div class="image-container mb-3">
                                                <img src="<?php echo base_url('uploads/product/' . $pro->image) ?>" alt="<?php echo $pro->title ?>" class="img-fluid">
                                            </div>
                                            <h2 class="text-danger"><?php echo number_format($pro->price, 0, ',', '.') ?> VND</h2>
                                            <p><?php echo $pro->title ?></p>
                                            
                                            <!-- Hiển thị kích thước -->
                                            <?php if (isset($pro->sizes) && !empty($pro->sizes)): ?>
                                                <div class="product-sizes mb-2">
                                                    <label>Chọn kích thước:</label>
                                                    <div class="size-options">
                                                    <?php 
                                                        // Chia nhỏ chuỗi sizes thành mảng
                                                        $sizes = explode(',', $pro->sizes); 
                                                        foreach ($sizes as $size): ?>
                                                            <div class="size-option">
                                                                <input type="radio" name="size" id="size_<?php echo $size; ?>" value="<?php echo $size; ?>" class="size-radio">
                                                                <label for="size_<?php echo $size; ?>" class="size-button"><?php echo $size; ?></label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (isset($pro->colors) && !empty($pro->colors)): ?>
                                                <div class="product-colors mb-2">
                                                <?php 
                                                     // Chia nhỏ chuỗi colors thành mảng
                                                    $colors = explode(',', $pro->colors); 
                                                    foreach ($colors as $color): ?>
                                                        <div class="color-option">
                                                            <input class="color-radio" type="radio" name="color[<?php echo $pro->product_id; ?>]" id="color_<?php echo $pro->product_id; ?>_<?php echo $color; ?>" value="<?php echo $color; ?>">
                                                            <label class="color-label" for="color_<?php echo $pro->product_id; ?>_<?php echo $color; ?>" title="<?php echo $color; ?>">
                                                                <span class="color-dot" style="background-color: <?php echo $color; ?>"></span>
                                                                <span class="color-name"><?php echo $color; ?></span>
                                                            </label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>

                                            <div class="mt-5">
                                                <a href="<?php echo base_url('san-pham/' . $pro->product_id . '/' . $pro->slug) ?>" class="btn btn-outline-primary mb-2">
                                                    <i class="fa fa-eye"></i> Xem chi tiết
                                                </a>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-shopping-cart"></i> &nbsp; Thêm giỏ hàng
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <style>
                .size-options {
                        display: flex;
                        justify-content: center; /* Sử dụng Flexbox để xếp hàng ngang */
                        gap: 10px;
                    }

                    .size-option {
                        display: flex;
                        align-items: center;
                    }

                    .size-radio {
                        display: none; /* Ẩn nút radio mặc định */
                    }

                    .size-button {
                        display: flex; /* Đảm bảo nút bấm có thể căn giữa nội dung */
                        justify-content: center; /* Căn giữa nội dung */
                        align-items: center; /* Căn giữa nội dung theo chiều dọc */
                        border: 2px solid #ddd;
                        border-radius: 5px;
                        cursor: pointer;
                        transition: background-color 0.3s, color 0.3s;
                        text-align: center; /* Căn giữa chữ */
                        width: 30px;
                    }

                    .size-radio:checked + .size-button {
                        background-color: #007bff; /* Màu nền khi được chọn */
                        color: white; /* Màu chữ khi được chọn */
                        border-color: #007bff; /* Đổi màu viền khi được chọn */
                    }

                    .size-button:hover {
                        background-color: #0056b3; /* Màu nền khi hover */
                        color: white; /* Màu chữ khi hover */
                    }
                    .product-colors {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }

    .color-option {
        position: relative;
    }

    .color-radio {
        display: none; /* Ẩn nút radio mặc định */
    }

    .color-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        cursor: pointer;
    }

    .color-dot {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        border: 2px solid #ddd;
        transition: border-color 0.3s;
    }

    .color-name {
        position: absolute;
        top: 30px; /* Đặt tooltip phía trên */
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 2px 5px;
        border-radius: 3px;
        font-size: 12px;
        opacity: 0; /* Ẩn tooltip mặc định */
        transition: opacity 0.3s;
        white-space: nowrap;
    }

    .color-radio:checked + .color-label .color-dot {
        border-color: #000;
    }

    .color-label:hover .color-name {
        opacity: 1; /* Hiện tooltip khi hover vào label */
    }
                .equal-height-item {
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    height: 100%;
                    padding: 15px;
                    box-sizing: border-box;
                }

                .image-container {
                    width: 100%;
                    height: 200px;
                    overflow: hidden;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 15px;
                }

                .image-container img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

                .single-products {
                    flex-grow: 1;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                }
                .btn.btn-primary {
                    background: #0f62f9;
                    border: 0 none;
                    border-radius: 0;
                    margin-top: -2px;
                    margin-left: 0px;
                    margin-bottom: 12px;
                }
            </style>
        </div>
    </div>
</section>
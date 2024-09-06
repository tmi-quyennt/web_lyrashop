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
                        <?php foreach ($allproduct as $key => $pro) { ?>
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
                                            <div class="mt-auto">
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
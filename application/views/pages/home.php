<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Danh mục</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->

                        <?php
                        foreach ($category as $key => $cate) {
                        ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="<?php echo base_url('danh-muc/' . $cate->category_id . '/' . $cate->slug) ?>"><?php echo $cate->title ?></a></h4>
                                </div>
                            </div>
                        <?php } ?>
                    </div><!--/category-products-->

                    <div class="brands_products"><!--brands_products-->
                        <h2>Bộ sưu tập</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                <?php
                                foreach ($brand as $key => $bra) {
                                ?>
                                    <li><a href="<?php echo base_url('thuong-hieu/' . $bra->brand_id . '/' . $bra->slug) ?>"> <?php echo $bra->title ?></a></li>
                                <?php } ?>

                            </ul>
                        </div>
                    </div><!--/brands_products-->

                    <div class="price-range"><!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well text-center">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
                            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div><!--/price-range-->

                    <div class="shipping text-center"><!--shipping-->
                        <img src="images/home/shipping.jpg" alt="" />
                    </div><!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Features Items</h2>
                    <div class="row">
                        <?php
                        foreach ($allproduct as $key => $pro) {
                        ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper equal-height-item">
                                    <form action="<?php echo base_url('add-to-cart') ?>" method="POST">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <input type="hidden" value="<?php echo $pro->product_id ?>" name="product_id">
                                                <input type="hidden" min="1" value="1" name="quantity" />
                                                <div class="image-container">
                                                    <img src="<?php echo base_url('uploads/product/' . $pro->image) ?>" alt="<?php echo $pro->title ?>" class="img-responsive center-block" />
                                                </div>
                                                <h2><?php echo number_format($pro->price, 0, ',', '.') ?> VND</h2>
                                                <p><?php echo $pro->title ?></p>
                                                <a href="<?php echo base_url('san-pham/' . $pro->product_id . '/' . $pro->slug) ?>" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i> Details</a>
                                                <button type="submit" class="btn btn-fefault cart">
                                                    <i class="fa fa-shopping-cart"></i> Thêm giỏ hàng
                                                </button>
                                                
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div><!--features_items-->
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
                    /* Chiều cao cố định để đảm bảo hình ảnh có tỷ lệ bằng nhau */
                    overflow: hidden;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 15px;
                }

                .image-container img {
                    max-height: 100%;
                    max-width: 100%;
                    object-fit: cover;
                    /* Cắt ảnh sao cho phù hợp với khung */
                }

                .productinfo {
                    flex-grow: 1;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                }
            </style>

        </div>
    </div>
</section>
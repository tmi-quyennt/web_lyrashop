<section>
		<div class="container">
			<div class="row">
			<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh mục</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->

							<?php
								foreach($category as $key => $cate){
							?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="<?php echo base_url('danh-muc/'.$cate->category_id.'/'.$cate->slug) ?>"><?php echo $cate->title ?></a></h4>
								</div>
							</div>
							<?php } ?>
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Bộ sưu tập</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
								<?php
								foreach($brand as $key => $bra){
								?>
									<li><a href="<?php echo base_url('thuong-hieu/'.$bra->brand_id.'/'.$bra->slug) ?>"> <?php echo $bra->title ?></a></li>
								<?php } ?>

								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
                    <?php
                    foreach($product_details as $key => $pro){
                    ?>
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="<?php echo base_url('uploads/product/'.$pro->image) ?>" alt="<?php echo $pro->title ?>" />
							</div>

						</div>
                        <form action="<?php echo base_url('add-to-cart') ?>" method="POST">

						<div class="col-sm-7">
						<?php
						if($this->session->flashdata('success')){
						?>
						<div class = 'alert alert-success'> <?php echo $this->session->flashdata('success') ?> </div>
						<?php
							}elseif($this->session->flashdata('error')){
						?>
						<div class = 'alert alert-danger'> <?php echo $this->session->flashdata('error') ?> </div>
						<?php
							}
						?> 
						
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2><?php echo $pro->title ?></h2>
                                <input type="hidden" value="<?php echo $pro->product_id ?>" name="product_id">
							
								<!--  show information size and colors from database -->
								<div class="size-color">
									<div class="size">
										<label>Kích thước</label>
										<select name="size" class="form-control" style="width: 60%;">
											<option value="" disabled selected>Chọn kích thước</option>
											<?php foreach ($sizes as $size): ?>
												<option value="<?php echo $size->size_name; ?>"><?php echo $size->size_name; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="color">
									<div class="product-colors mb-2">
 
								</div>
								<div>
									<?php if (isset($colors) && !empty($colors)): ?>
										<div class="product-colors" style="margin: 10px;">
											<label>Chọn màu sắc:</label>
											<div class="color-options">
												<?php foreach ($colors as $color): ?>
													<div class="color-option">
														<input class="color-radio" type="radio" name="color[<?php echo $pro->product_id; ?>]" id="color_<?php echo $color->color_name; ?>" value="<?php echo $color->color_name; ?>">
														<label class="color-label" for="color_<?php echo $color->color_name; ?>" title="<?php echo $color->color_name; ?>">
															<span class="color-dot" style="background-color: <?php echo $color->color_name; ?>"></span>
															<span class="color-name"><?php echo $color->color_name; ?></span>
														</label>
													</div>
												<?php endforeach; ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
								</div>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span><?php echo number_format($pro->price,0,',','.') ?>VND</span><br/>
									<label>Số lượng: <?php echo $pro->quantity ?></label>
									<input type="number" min="1" value="1" name="quantity" />
									<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Thêm giỏ hàng
									</button>
								</span>
								<p><b>Tồn kho:</b> Còn hàng</p>
								<p><b>Trạng thái:</b> New</p>
								<p><b>Bộ sưu tập:</b> <?php echo $pro->tenthuonghieu ?></p>
                                <p><b>Danh mục:</b> <?php echo $pro->tendanhmuc ?></p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
                        </form>


					</div><!--/product-details-->
					<?php } ?>
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Chi tiết</a></li>
								<!-- <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
								<li><a href="#tag" data-toggle="tab">Tag</a></li> -->
								<li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<!-- <div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="tag" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div> -->
							</div>
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>Quyên User</a></li>
										<div class="text-muted small mb-2">
												<i class="fa fa-clock-o"></i> 12:41 AM
												<i class="fa fa-calendar-o ml-2"></i> 30 AUG 2024
											</div>
									</ul>
									<p>Áo baby tee phối ren thêu tim của LYRA thật sự rất xinh! Chất liệu cotton mềm mại, thoáng khí, rất thoải mái khi mặc. Phần ren và thêu tim ở cổ áo tạo điểm nhấn rất đáng yêu. Tôi hoàn toàn hài lòng và chắc chắn sẽ mua thêm các màu khác.</p>
									<div class="review-form-box p-4 bg-white rounded shadow-sm">
										<h4 class="mb-3 mt-5">Viết đánh giá của bạn</h4>
										<form action="#">
											<div class="form-row">
												<div class="form-group col-md-6">
													<input type="text" class="form-control" placeholder="Họ và tên"/>
												</div>
												<div class="form-group col-md-6">
													<input type="email" class="form-control" placeholder="Địa chỉ email"/>
												</div>
											</div>
											<div class="form-group">
												<textarea class="form-control" rows="4" placeholder="Nhập đánh giá của bạn"></textarea>
											</div>
											<div class="form-group">
												<label class="mr-2"><b>Đánh giá:</b></label>
												<img src="images/product-details/rating.png" alt="rating" />
											</div>
											<button type="submit" class="btn btn-primary">Gửi đánh giá</button>
										</form>
									</div>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="item">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>
	<style>
	.color-options {
        display: flex;
		gap: 10px;
    }
    .product-colors {
        display: flex;
        flex-wrap: wrap;
        justify-content: start;
        gap: 10px;
    }

    .color-option {
        position: relative;
    }

    .color-radio {
        display: none;
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
        top: 50%;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 2px 5px;
        border-radius: 3px;
        font-size: 12px;
        opacity: 0;
        transition: opacity 0.3s;
        white-space: nowrap;
    }

    .color-radio:checked + .color-label .color-dot {
        border-color: #000;
    }

    .color-label:hover .color-name {
        opacity: 1;
    }
</style>
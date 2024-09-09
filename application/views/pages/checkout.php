<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Đặt hàng</li>
			</ol>
		</div>
		<div class="table-responsive cart_info">
			<?php
			if ($this->cart->contents()) {
			?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">

							<td class="description">Hình ảnh</td>
							<td class="image">Sản phẩm</td>
							<td class="price">Giá tiền</td>
							<td class="quantity">Số lượng</td>
							<td class="color">Màu sắc</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
						$subtotal = 0;
						$total = 0;
						foreach ($this->cart->contents() as $items) {
							$subtotal = $items['qty'] * $items['price'];
							$total += $subtotal;
						?>
							<tr>
								<td class="cart_product">
									<a href=""><img src="<?php echo base_url('uploads/product/' . $items['options']['image']) ?>" width="150" height="150" alt="<?php echo $items['name'] ?>"></a>
								</td>
								<td class="cart_description">
									<h4><a href=""><?php echo $items['name'] ?></a></h4>
								</td>
								<td class="cart_price">
									<p><?php echo number_format($items['price'], 0, ',', '.') ?>VND</p>
								</td>
								<td class="cart_quantity">
									<form action="<?php echo base_url('update-cart-item') ?>" method="POST">


										<div class="cart_quantity_button">
											<input type="hidden" value="<?php echo $items['rowid'] ?>" name="rowid">
											<input class="cart_quantity_input" type="number" min="1" name="quantity" value="<?php echo $items['qty'] ?>" autocomplete="off" size="2">
											<input type="submit" name="capnhat" class="btn btn-primary" value="Cập Nhật"></a>

										</div>
									</form>
								</td>
								<td class="cart_color">
									<?php if (isset($items['options']['colors']) && !empty($items['options']['colors'])): ?>
										<?php 
										$selected_color = isset($items['options']['selected_color']) ? $items['options']['selected_color'] : '';
										$color_name = 'Chưa chọn màu';
										foreach ($items['options']['colors'] as $color) {
											if ($color->id == $selected_color) {
												$color_name = $color->name;
												break;
											}
										}
										echo $color_name;
										?>
									<?php else: ?>
										Không có thông tin màu sắc
									<?php endif; ?>
								</td>
								<td class="cart_total">
									<p class="cart_total_price"><?php echo number_format($subtotal, 0, ',', '.') ?>VND</p>
								</td>

							</tr>
						<?php
						}
						?>
						<tr>
							<td colspan="5">Tổng Tiền<p class="cart_total_price"> <?php echo number_format($total, 0, ',', '.') ?>VND </p>
							</td>
						</tr>
						<td><a href="<?php echo base_url('checkout') ?>" class="btn btn-danger">Đặt Hàng</a></td>

					</tbody>
				</table>
			<?php
			} else {
				echo '<span class="text text-danger">Làm ơn thêm sản phẩm vào trong giỏ hàng</span>';
			}
			?>
		</div>
		<section><!--form-->
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-form"><!--login form-->
							<h2>Điền thông tin thanh toán</h2>
							<?php
							if ($this->session->flashdata('success')) {
							?>
								<div class='alert alert-success'> <?php echo $this->session->flashdata('success') ?> </div>
							<?php
							} elseif ($this->session->flashdata('error')) {
							?>
								<div class='alert alert-danger'> <?php echo $this->session->flashdata('error') ?> </div>
							<?php
							}
							?>
							<form onsubmit="return confirm('Xác nhận đặt hàng')" method="POST" action="<?php echo base_url('online-checkout') ?>">
								<label>Name</label>
								<input type="text" name="name" placeholder="Name" value="<?php echo set_value('name'); ?>" />
								<div class="error-message"><?php echo form_error('name'); ?></div>

								<label>Address</label>
								<input type="text" name="address" placeholder="Address" value="<?php echo set_value('address'); ?>" />
								<div class="error-message"><?php echo form_error('address'); ?></div>

								<label>Phone</label>
								<input type="text" name="phone" placeholder="Phone" value="<?php echo set_value('phone'); ?>" />
								<div class="error-message"><?php echo form_error('phone'); ?></div>

								<label>Email</label>
								<input type="text" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" />
								<div class="error-message"><?php echo form_error('email'); ?></div>

								<label>Hình thức thanh toán</label>

								<button type="submit" name="cod" class="btn btn-default">Thanh toán COD</button>
								<button type="submit" name="payUrl" class="btn btn-danger">Thanh toán Momo</button>
								<button type="submit" name="vnpay" class="btn btn-success">Thanh toán VnPay</button>
							</form>
						</div><!--/login form-->
					</div>
				</div>
			</div>
			<style>
				.error-message {
					color: red;
					font-size: 14px;
					margin-top: 5px;
				}
			</style>
		</section><!--/form-->
	</div>
</section> <!--/#cart_items-->
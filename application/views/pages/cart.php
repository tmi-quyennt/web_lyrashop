<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Giỏ hàng</li>
            </ol>
        </div>

        <div class="table-responsive cart_info">
            <?php if ($this->cart->contents()): ?>
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="description">Hình ảnh</td>
                                <td class="image">Sản phẩm</td>
                                <td class="price">Giá tiền</td>
                                <td class="quantity">Số lượng</td>
                                <td class="quantity">Tồn kho</td>
								<td class="size">Kích thước</td>
                                <td class="color">Màu sắc</td>
                                <td class="total">Tổng tiền</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $subtotal = 0;
                            $total = 0;
                            foreach ($this->cart->contents() as $items):
                                $subtotal = $items['qty'] * $items['price'];
                                $total += $subtotal;
                            ?>
                                <tr>
                                    <td class="cart_product">
                                        <a href=""><img src="<?php echo base_url('uploads/product/' . $items['options']['image']) ?>" width="150" height="150" alt="<?php echo $items['name'] ?>"></a>
                                    </td>
                                    <td class="cart_description">
                                        <b><a href="" ><?php echo $items['name'] ?></a></b>
                                    </td>
                                    <td class="cart_price">
										<!-- font size small -->
                                        <h5 class="fs-2"><?php echo number_format($items['price'], 0, ',', '.') ?>VND</h5>
                                    </td>
                                    <td class="cart_quantity">
                                    <form action="<?php echo base_url('update-cart-item') ?>" method="POST" class="update-cart-form">
                                        <div class="cart_quantity_button">
                                            <input type="hidden" value="<?php echo $items['rowid'] ?>" name="rowid">
                                            <input class="cart_quantity_input" style="width: 50px !important;" type="number" min="1" name="quantity" value="<?php echo $items['qty'] ?>" autocomplete="off" size="2" onchange="updateCart(this)">
                                        </div>
                                    </form>
                                    </td>
                                    <td class="cart_description">
                                        <h5><?php echo $items['options']['in_stock'] ?></h5>
                                    </td>
	       							 <!-- Hiển thị kích thước -->
                                        <td>
                                            <?php if (isset($items['options']['size_name']) && !empty($items['options']['size_name'])): ?>
                                                <select name="size[<?php echo $items['rowid']; ?>]" class="form-control" style="max-width: 100px !important;" onchange="updateCartSize(this)">
                                                    <?php 
                                                    // Chia nhỏ chuỗi sizes thành mảng nếu cần
                                                    $sizes = explode(',', $items['options']['size_name']); 
                                                    foreach ($sizes as $size): ?>
                                                        <option value="<?php echo $size; ?>" <?php echo (isset($items['options']['size_name']) && $items['options']['size_name'] == $size) ? 'selected' : ''; ?>>
                                                            <?php echo $size; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php else: ?>
                                                Không có size
                                            <?php endif; ?>
                                        </td>

                                        <td class="cart_color">
                                            <?php if (isset($items['options']['color_name']) && !empty($items['options']['color_name'])): ?>
                                                <select name="color[<?php echo $items['rowid']; ?>]" class="form-control" style="max-width: 100px !important;" onchange="updateCartColor(this)">
                                                    <option value="" disabled>Chọn màu sắc</option>
                                                    <?php 
                                                    // Chia nhỏ chuỗi colors thành mảng nếu cần
                                                    $colors = explode(',', $items['options']['color_name']); 
                                                    foreach ($colors as $color): ?>
                                                        <option value="<?php echo $color; ?>" <?php echo (isset($items['options']['color_name']) && $items['options']['color_name'] == $color) ? 'selected' : ''; ?>>
                                                            <?php echo $color; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php else: ?>
                                                Không có color
                                            <?php endif; ?>
                                        </td>
                                    <td class="cart_total">
                                        <h6 class="cart_total_price" id="total_<?php echo $items['rowid']; ?>">
                                            <?php echo number_format($subtotal, 0, ',', '.') ?>VND
                                        </h6>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" href="<?php echo base_url('delete-item/' . $items['rowid']) ?>"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="5">Tổng Tiền
                                    <h5 class="cart_total_price"> <?php echo number_format($total, 0, ',', '.') ?>VND</h5>
                                </td>
                                <td><a href="<?php echo base_url('delete-all-cart') ?>" class="btn btn-danger">Xóa tất cả</a></td>
                            </tr>

                        </tbody>
                    </table>
                    
                    <!-- Form nhập địa chỉ -->
				<section><!--form-->
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-form"><!--login form-->
							<h2>Điền thông tin thanh toán</h2>
							<?php
							if ($this->session->flashdata('success')) {
							?>
								<div id="toast" class="toast toast-success">
                                    <div class="toast-body">
                                        <?php echo $this->session->flashdata('success'); ?>
                                    </div>
                                </div>
							<?php
							} elseif ($this->session->flashdata('error')) {
							?>
								<div id="toast" class="toast toast-danger">
                                    <div class="toast-body">
                                        <?php echo $this->session->flashdata('error'); ?>
                                    </div>
                                </div>
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

								<div style="display: flex; gap: 10px; padding: 20px">
                                    <button type="submit" name="cod" class="btn btn-default">Thanh toán COD</button>
                                    <button type="submit" name="payUrl" class="btn btn-danger">Thanh toán Momo</button>
                                    <button type="submit" name="stripeToken" class="btn btn-success" id="checkout-button">Thanh toán bằng thẻ ngân hàng</button>
                                </div>
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
                .cart_info table tr td {
                    margin-right: 0px;
                }
			</style>
		</section><!--/form-->
            <?php else: ?>
                <span class="text text-danger">Làm ơn thêm sản phẩm vào trong giỏ hàng</span>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        function updateCart(input) {
            var form = input.closest('.update-cart-form');
            var formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật tổng tiền hoặc thông báo thành công nếu cần
                    location.reload();
                    // Có thể thêm logic để cập nhật tổng tiền ở đây
                } else {
                    alert('Cập nhật không thành công: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function updateCartSize(select) {
            var rowid = select.name.match(/\[(.*?)\]/)[1]; // Lấy rowid từ tên của select
            var sizeSelect = document.querySelector('select[name="size[' + rowid + ']"]');
            
            // Kiểm tra sự tồn tại của size và color
            var size = sizeSelect ? sizeSelect.value : null; // Nếu tồn tại, lấy giá trị kích thước
            var formData = new FormData();
            formData.append('rowid', rowid);
            formData.append('size', size);

            fetch('<?php echo base_url('update_cart_size_color'); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Cập nhật không thành công: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        function updateCartColor(select) {
            var rowid = select.name.match(/\[(.*?)\]/)[1]; // Lấy rowid từ tên của select
            var colorSelect = document.querySelector('select[name="color[' + rowid + ']"]');
            
            var color = colorSelect ? colorSelect.value : null; // Nếu tồn tại, lấy giá trị màu sắc

            var formData = new FormData();
            formData.append('rowid', rowid);
            formData.append('color', color);

            fetch('<?php echo base_url('update_cart_size_color'); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Cập nhật không thành công: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }


        var stripe = Stripe('pk_test_51Pkc6WRw8xguDrzhSg2nRvjZCQMfObBC1wISqSupyZfBHxHfkzrZJODaDLzkOcKAGSYK1L0pdlsA0v80PrlH5bjk00KumbpBDJ'); // Sử dụng Publishable key

        var checkoutButton = document.getElementById('checkout-button');

        checkoutButton.addEventListener('click', function() {
            fetch('<?php echo base_url('online-checkout'); ?>', {
                method: 'POST',
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(session) {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(function(result) {
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
        });
    </script>
</section>

<div class ='container'>
    <div class="card">
    <div class="card-header">
        Danh sách đơn hàng 
    </div>
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
    <div class="card-body">
            <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Mã đơn hàng</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Giá tiền</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($order_details as $key => $ord){
            ?>
            <tr>
            <th scope="row"><?php echo $key ?></th>
            <td><?php echo $ord->order_code ?></td>
            <td><?php echo $ord->title ?></td>
            <td><img src = "<?php echo base_url("uploads/product/". $ord->image) ?>" width = "150" height="150"></td>
            <td><?php  echo number_format($ord->price,0,',','.') ?></td>
            <td><?php echo $ord->qty ?></td>


            <td>
                <?php
                echo number_format($ord->qty * $ord->price,0,',','.') ;
                ?>
            </td>
            <td>

            </td>
            
            </tr>
            <?php
            } 
            ?>
            <tr>
                <td>
                    <select class="xulydonhang form-control">
                        <?php
                        if($ord->order_status==1){
                        ?>
                        <option selected id="<?php echo $ord->order_code ?> "value="0">----Xử lý đơn hàng-----</option>
                        <option id="<?php echo $ord->order_code ?> "value="2">Đơn hàng đã được xử lý - Đang giao</option>
                        <option id="<?php echo $ord->order_code ?> "value="3">Huỷ đơn</option>
                        <?php
                        }else if($ord->order_status==2){
                        ?>
                        <option id="<?php echo $ord->order_code ?> "value="0">----Xử lý đơn hàng-----</option>
                        <option selected id="<?php echo $ord->order_code ?> "value="2">Đơn hàng đã được xử lý - Đang giao</option>
                        <option id="<?php echo $ord->order_code ?> "value="3">Huỷ đơn</option>
                        <?php
                        }else{
                        ?>
                        <option id="<?php echo $ord->order_code ?> "value="0">----Xử lý đơn hàng-----</option>
                        <option id="<?php echo $ord->order_code ?> "value="2">Đơn hàng đã được xử lý - Đang giao</option>
                        <option selected id="<?php echo $ord->order_code ?> "value="3">Huỷ đơn</option>
                        <?php
                        }
                        ?>

                        
                    </select>
                </td>
            </tr>
            
        </tbody>
        </table>
    </div>
    </div>
</div>
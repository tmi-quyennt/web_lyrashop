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
            <th scope="col">Tên </th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Địa chỉ</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Quản lý</th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach($order as $key => $ord){
            ?>
            <tr>
            <th scope="row"><?php echo $key ?></th>
            <td><?php echo $ord->order_code ?></td>
            <td><?php echo $ord->name ?></td>
            <td><?php echo $ord->phone ?></td>
            <td><?php echo $ord->address ?></td>


            <td>
                <?php
                if($ord->status==1){
                    echo '<span class="text text-primary">Đang chờ xử lý</span>';
                }else if($ord->status==2){
                    echo '<span class="text text-success">Đã xử lý</span>';
                }else{
                    echo '<span class="text text-danger">Đã hủy</span>';
                }
                ?>
            </td>
            <td>
                <a onclick="return confirm('Are u sure?')" href="<?php echo base_url("order/delete/". $ord->order_code) ?>" class="btn btn-danger" href="" >Xóa</a>
                <a class="btn btn-warning" href="<?php echo base_url("order/view/". $ord->order_code) ?>" >Xem</a>
            </td>
            
            </tr>
            <?php
            } 
            ?>
            
        </tbody>
        </table>
    </div>
    </div>
</div>
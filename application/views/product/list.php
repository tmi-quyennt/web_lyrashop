<div class ='container'>
    <div class="card">
    <div class="card-header">
        Danh sách sản phẩm Product
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
        <a href="<?php echo base_url('product/create') ?>" class="btn btn-primary">Thêm sản phẩm </a>
            <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên</th>
            <th scope="col">Giá tiền</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Danh mục</th>
            <th scope="col">Bộ sưu tập</th>
            <!-- <th scope="col">Slug</th>
            <th scope="col">Description</th> -->
            <th scope="col">Hình ảnh</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Quản lý </th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($product as $key => $pro){
            ?>
            <tr>
            <th scope="row"><?php echo $key ?></th>
            <td><?php echo $pro->title ?></td>
            <td><?php echo number_format($pro->price,0,',','.') ?>VND</td>
            <td><?php echo $pro->quantity ?></td>
            <td><?php echo $pro->tendanhmuc ?></td>
            <td><?php echo $pro->tenthuonghieu ?></td>
            <!-- <td><?php echo $pro->slug ?></td>
            <td><?php echo $pro->description ?></td> -->
            <td>
                <img src = "<?php echo base_url("uploads/product/". $pro->image) ?>" width = "150" height="150">
            </td>
            <td>
                <?php
                if($pro->status==1){
                    echo 'Active';
                }else{
                    echo 'Inactive';
                }
                ?>
            </td>
            <td>
                <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="<?php echo base_url("product/delete/". $pro->product_id) ?>" class="btn btn-danger" href="" >Xóa</a>
                <a class="btn btn-warning" href="<?php echo base_url("product/edit/". $pro->product_id) ?>" >Sửa</a>
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
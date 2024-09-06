<div class ='container'>
    <div class="card">
    <div class="card-header">
        Danh sách bộ sưu tập 
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
        <a href="<?php echo base_url('brand/create') ?>" class="btn btn-primary">Thêm bộ sưu tập </a>
            <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên</th>
            <th scope="col">Slug</th>
            <th scope="col">Mô tả</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Quản lý</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($brand as $key => $bra){
            ?>
            <tr>
            <th scope="row"><?php echo $key ?></th>
            <td><?php echo $bra->title ?></td>
            <td><?php echo $bra->slug ?></td>
            <td><?php echo $bra->description ?></td>
            <td>
                <img src = "<?php echo base_url("uploads/brand/". $bra->image) ?>" width = "150" height="150">
            </td>
            <td>
                <?php
                if($bra->status==1){
                    echo 'Active';
                }else{
                    echo 'Inactive';
                }
                ?>
            </td>
            <td>
                <a onclick="return confirm('Are u sure?')" href="<?php echo base_url("brand/delete/". $bra->brand_id) ?>" class="btn btn-danger" href="" >Xóa</a>
                <a class="btn btn-warning" href="<?php echo base_url("brand/edit/". $bra->brand_id) ?>" >Sửa</a>
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
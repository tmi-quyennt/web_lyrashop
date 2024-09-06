<div class ='mx-auto pb-4' style="width: 1440px;">
    <div class="card">
    <div class="card-header">
        Danh sách danh mục 
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
        <a href="<?php echo base_url('category/create') ?>" class="btn btn-primary mb-2">Thêm danh mục </a>
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
            foreach($category as $key => $cate){
            ?>
            <tr>
            <th scope="row"><?php echo $key ?></th>
            <td><?php echo $cate->title ?></td>
            <td><?php echo $cate->slug ?></td>
            <td><?php echo $cate->description ?></td>
            <td>
                <img src = "<?php echo base_url("uploads/category/". $cate->image) ?>" width = "150" height="150">
            </td>
            <td>
                <?php
                if($cate->status==1){
                    echo 'Active';
                }else{
                    echo 'Inactive';
                }
                ?>
            </td>
            <td>
                <a onclick="return confirm('Are u sure?')" href="<?php echo base_url("category/delete/". $cate->category_id) ?>" class="btn btn-danger" href="" >Xóa</a>
                <a class="btn btn-warning" href="<?php echo base_url("category/edit/". $cate->category_id) ?>" >Sửa</a>
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
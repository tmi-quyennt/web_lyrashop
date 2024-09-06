<div class ='container'>
    <div class="card">
    <div class="card-header">
        Sửa bộ sưu tập
    </div>
    <div class="card-body">
    <a href="<?php echo base_url('brand/create') ?>" class="btn btn-primary">Thêm bộ sưu tập </a>
    <a href="<?php echo base_url('brand/list') ?>" class="btn btn-primary">Danh sách bộ sưu tập </a>


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
        <form action="<?php echo base_url('brand/update/'.$brand->brand_id) ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Tên</label>
            <input type="text" name = 'title' class="form-control" onkeyup="ChangeToSlug();" value = "<?php echo $brand->title ?>" id="slug" aria-describedby="emailHelp">
            <?php echo form_error('title'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Slug</label>
            <input type="text" name = 'slug' class="form-control" value = "<?php echo $brand->slug ?>" id="convert_slug" aria-describedby="emailHelp">
            <?php echo form_error('slug'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Mô tả</label>
            <input type="text" class="form-control" value = "<?php echo $brand->description ?>" name = 'description' id="exampleInputPassword1">
            <?php echo form_error('description'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Hình ảnh</label>
            <input type="file" class="form-control-file" name = 'image' id="exampleInputPassword1">
            <img src = "<?php echo base_url("uploads/brand/". $brand->image) ?>" width = "150" height="150">
            <small><?php if(isset($error)){ echo $error; } ?></small>
        </div>
        
        <div class="form-group">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Trạng thái</label>
                <select class="form-control" name = 'status' id="exampleFormControlSelect1">
                    <?php
                    if($brand->status == 1){
                    ?>
                <option selected value = '1'>Active</option>
                <option value = '0'>Inactive</option>
                <?php 
                }
                else{
                ?>
                <option  value = '1'>Active</option>
                <option selected value = '0'>Inactive</option>
                <?php
                }
                ?>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
    </div>
</div>
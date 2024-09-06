<div class ='container'>
    <div class="card">
    <div class="card-header">
        Thêm danh mục 
    </div>
    <div class="card-body">
    <a href="<?php echo base_url('category/list') ?>" class="btn btn-primary">Danh sách danh mục</a>

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
        <form action="<?php echo base_url('category/store') ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Tên</label>
            <input type="text" name = 'title' class="form-control" id="slug" onkeyup="ChangeToSlug();" aria-describedby="emailHelp">
            <?php echo form_error('title'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Slug</label>
            <input type="text" name = 'slug' class="form-control" id="convert_slug" aria-describedby="emailHelp">
            <?php echo form_error('slug'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Mô tả</label>
            <input type="text" class="form-control" name = 'description' id="exampleInputPassword1">
            <?php echo form_error('description'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Hình ảnh</label>
            <input type="file" class="form-control-file" name = 'image' id="exampleInputPassword1">
            <small><?php if(isset($error)){ echo $error; } ?></small>
        </div>
        
        <div class="form-group">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Trạng thái</label>
                <select class="form-control" name = 'status' id="exampleFormControlSelect1">
                <option value = '1'>Active</option>
                <option value = '0'>Inactive</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
    </div>
</div>
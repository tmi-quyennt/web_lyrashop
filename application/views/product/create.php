<div class ='mx-auto pb-4' style="width: 1440px;">
    <div class="card">
    <div class="card-header">
        Thêm sản phẩm 
    </div>
    <div class="card-body">
    <a href="<?php echo base_url('product/list') ?>" class="btn btn-primary">Danh sách sản phẩm </a>

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
        <form action="<?php echo base_url('product/store') ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Tên</label>
            <input type="text" name = 'title' class="form-control" id="slug" onkeyup="ChangeToSlug();" aria-describedby="emailHelp">
            <?php echo form_error('title'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Giá tiền</label>
            <input type="text" name = 'price' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <?php echo form_error('price'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Số lượng</label>
            <input type="text" name = 'quantity' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <?php echo form_error('quantity'); ?>
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
        
        <!-- <div class="form-group">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Size</label>
                <select class="form-control" name = 'size' id="exampleFormControlSelect1">
                <option value = '2'>L</option>
                <option value = '1'>M</option>
                <option value = '0'>S</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Color</label>
                <select class="form-control" name = 'color' id="exampleFormControlSelect1">
                <option value = '2'>Xanh</option>
                <option value = '1'>Đen</option>
                <option value = '0'>Vàng</option>
                </select>
            </div>
        </div> -->

        <div class="form-group">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Trạng thái</label>
                <select class="form-control" name = 'status' id="exampleFormControlSelect1">
                <option value = '1'>Active</option>
                <option value = '0'>Inactive</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Danh mục</label>
                <select class="form-control" name = 'category_id' id="exampleFormControlSelect1">
                    <?php
                    foreach($category as $key => $cate){
                    ?>
                <option value = "<?php echo $cate->category_id ?>"><?php echo $cate->title ?></option>
                    <?php 
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Bộ sưu tập</label>
                <select class="form-control" name = 'brand_id' id="exampleFormControlSelect1">
                <?php
                    foreach($brand as $key => $bra){
                    ?>
                <option value = "<?php echo $bra->brand_id ?>"><?php echo $bra->title ?></option>
                    <?php 
                    }
                    ?>
                    </select>
            </div>
        </div>

        <div class="d-flex">
            <div class="form-group" style="margin-right: 20px;">
                <label for="exampleFormControlSelect1">Kích thước</label>
                <div id="size-container" style="margin-bottom: 10px;">
                    <div class="size-input" style="margin-bottom: 10px;">
                        <input type="text" name="sizes[]" class="form-control" placeholder="Nhập kích thước">
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" id="add-size">Thêm kích thước</button>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Màu sắc</label>
                <div id="color-container" style="margin-bottom: 10px;">
                    <div class="color-input" style="margin-bottom: 10px;">
                        <input type="text" name="colors[]" class="form-control" placeholder="Nhập màu sắc">
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" id="add-color">Thêm màu sắc</button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
    </div>
</div>
<script>
    document.getElementById('add-size').addEventListener('click', function() {
        var sizeContainer = document.getElementById('size-container');
        var newSizeInput = document.createElement('div');
        newSizeInput.className = 'size-input';
        newSizeInput.innerHTML = '<input type="text" name="sizes[]" class="form-control" placeholder="Nhập kích thước" style="margin-bottom: 10px;">';
        sizeContainer.appendChild(newSizeInput);
    });

    document.getElementById('add-color').addEventListener('click', function() {
        var colorContainer = document.getElementById('color-container');
        var newColorInput = document.createElement('div');
        newColorInput.className = 'color-input';
        newColorInput.innerHTML = '<input type="text" name="colors[]" class="form-control" placeholder="Nhập màu sắc" style="margin-bottom: 10px;">';
        colorContainer.appendChild(newColorInput);
    });
</script>
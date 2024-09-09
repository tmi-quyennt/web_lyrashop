<div class ='mx-auto pb-4' style="width: 1440px;">
    <div class="card">
    <div class="card-header">
        Add User
    </div>
    <div class="card-body">
    <a href="<?php echo base_url('user/list') ?>" class="btn btn-primary mb-2">List User</a>

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
        <form action="<?php echo base_url('user/store') ?>" method="POST"  enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" name = 'username' class="form-control" id="exampleInputPassword1" aria-describedby="emailHelp">
            <?php echo form_error('username'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="text" name = 'email' class="form-control" id="exampleInputPassword1"  aria-describedby="emailHelp">
            <?php echo form_error('email'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="text" class="form-control" name = 'password' id="exampleInputPassword1">
            <?php echo form_error('password'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Image</label>
            <input type="file" class="form-control-file" name = 'image' id="exampleInputPassword1">
            <small><?php if(isset($error)){ echo $error; } ?></small>
        </div>
        
        <div class="form-group">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Status</label>
                <select class="form-control" name = 'status' id="exampleFormControlSelect1">
                <option value = '1'>Active</option>
                <option value = '0'>Inactive</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" name="role" id="role">
                <option value="1">Admin</option>
                <option value="0">Nhân viên</option>
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
    </div>
</div>
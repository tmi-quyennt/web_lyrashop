<div class ='container'>
    <div class="card">
    <div class="card-header">
        Edit User
    </div>
    <div class="card-body">
    <a href="<?php echo base_url('user/create') ?>" class="btn btn-primary">Add User</a>
    <a href="<?php echo base_url('user/list') ?>" class="btn btn-primary">List User</a>


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
        <form action="<?php echo base_url('user/update/'.$user->id) ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" name = 'username' class="form-control" onkeyup="ChangeToSlug();" value = "<?php echo $user->username ?>"  aria-describedby="emailHelp">
            <?php echo form_error('user'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="text" name = 'email' class="form-control" value = "<?php echo $user->email ?>"  aria-describedby="emailHelp">
            <?php echo form_error('email'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="text" class="form-control" value = "<?php echo $user->password ?>" name = 'password' id="exampleInputPassword1">
            <?php echo form_error('password'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Image</label>
            <input type="file" class="form-control-file" name = 'image' id="exampleInputPassword1">
            <img src = "<?php echo base_url("uploads/user/". $user->image) ?>" width = "150" height="150">
            <small><?php if(isset($error)){ echo $error; } ?></small>
        </div>
        
        <div class="form-group">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Status</label>
                <select class="form-control" name = 'status' id="exampleFormControlSelect1">
                <?php
                if($user->status == 1){
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

        <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    </div>
</div>
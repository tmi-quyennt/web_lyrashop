<div class ='container'>
    <div class="card">
    <div class="card-header">
        List User
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
        <a href="<?php echo base_url('user/create') ?>" class="btn btn-primary">Add User</a>
            <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">UserName</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
            <!-- <th scope="col">Image</th> -->
            <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($user as $key => $u){
            ?>
            <tr>
            <th scope="row"><?php echo $key ?></th>
            <td><?php echo $u->username ?></td>
            <td><?php echo $u->email ?></td>
            <td><?php echo $u->password ?></td>
            <!-- <td>
                <img src = "<?php echo base_url("uploads/user/". $u->image) ?>" width = "150" height="150">
            </td> -->
            <td>
                <?php
                if($u->status==1){
                    echo 'Active';
                }else{
                    echo 'Inactive';
                }
                ?>
            </td>
            <td>
                <a onclick="return confirm('Are u sure?')" href="<?php echo base_url("user/delete/". $u->id) ?>" class="btn btn-danger" href="" >Delete</a>
                <a class="btn btn-warning" href="<?php echo base_url("user/edit/". $u->id) ?>" >Edit</a>
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
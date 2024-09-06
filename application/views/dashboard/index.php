<div class ='container'>
    <div class="card">
    <div class="card-header">
        Thống kê
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
            
        </thead>
        <tbody>
            
            
        </tbody>
        </table>
    </div>
    </div>
</div>
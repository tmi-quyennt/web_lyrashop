<section id="form"><!--form-->
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-1">
            <div class="login-form"><!--login form-->
                <h2>Login to your account</h2>
                <?php if($this->session->flashdata('success')): ?>
                    <div class='alert alert-success'><?php echo $this->session->flashdata('success'); ?></div>
                <?php elseif($this->session->flashdata('error')): ?>
                    <div class='alert alert-danger'><?php echo $this->session->flashdata('error'); ?></div>
                <?php endif; ?> 
                
                <form action="<?php echo base_url('login-customer'); ?>" method="POST">
                    <input type="hidden" name="form_type" value="login">
                    
                    <input type="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" />
                    <?php if (form_error('email') && $this->input->post('form_type') === 'login'): ?>
                        <div class="error-message"><?php echo form_error('email'); ?></div>
                    <?php endif; ?>

                    <input type="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" />
                    <?php if (form_error('password') && $this->input->post('form_type') === 'login'): ?>
                        <div class="error-message"><?php echo form_error('password'); ?></div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-default">Login</button>
                </form>
            </div><!--/login form-->
        </div>

        <div class="col-sm-1">
            <h2 class="or">OR</h2>
        </div>

        <div class="col-sm-4">
            <div class="signup-form"><!--sign up form-->
                <h2>New User Signup!</h2>
                <form action="<?php echo base_url('dang-ky'); ?>" method="POST">
                    <input type="hidden" name="form_type" value="signup">
                    
                    <input type="text" name="name" placeholder="Name" value="<?php echo set_value('name'); ?>" />
                    <?php if (form_error('name') && $this->input->post('form_type') === 'signup'): ?>
                        <div class="error-message"><?php echo form_error('name'); ?></div>
                    <?php endif; ?>

                    <input type="text" name="phone" placeholder="Phone" value="<?php echo set_value('phone'); ?>" />
                    <?php if (form_error('phone') && $this->input->post('form_type') === 'signup'): ?>
                        <div class="error-message"><?php echo form_error('phone'); ?></div>
                    <?php endif; ?>

                    <input type="text" name="address" placeholder="Address" value="<?php echo set_value('address'); ?>" />
                    <?php if (form_error('address') && $this->input->post('form_type') === 'signup'): ?>
                        <div class="error-message"><?php echo form_error('address'); ?></div>
                    <?php endif; ?>

                    <input type="email" name="email" placeholder="Email Address" value="<?php echo set_value('email'); ?>" />
                    <?php if (form_error('email') && $this->input->post('form_type') === 'signup'): ?>
                        <div class="error-message"><?php echo form_error('email'); ?></div>
                    <?php endif; ?>

                    <input type="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" />
                    <?php if (form_error('password') && $this->input->post('form_type') === 'signup'): ?>
                        <div class="error-message"><?php echo form_error('password'); ?></div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-default">Signup</button>
                </form>
            </div><!--/sign up form-->
        </div>
    </div>
</div>

		<style>
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }
</style>
	</section><!--/form-->
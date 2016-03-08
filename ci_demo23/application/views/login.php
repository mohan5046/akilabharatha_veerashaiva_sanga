<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<div class="container-fluid">
<div class="col-md-5 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Log-In Form</h3>
        </div>
        <div class="panel-body">
        <?php echo form_open("boot/check_login");?>

            <div class="form-group">
                <label for="email">Email ID</label>
                <input class="form-control" name="email" placeholder="Email-ID" type="text" value="<?php echo set_value('email'); ?>" />
                <span class="text-danger"><?php echo form_error('email'); ?></span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" name="password" placeholder="Password" type="password" value="<?php echo set_value('password'); ?>" />
                <span class="text-danger"><?php echo form_error('password'); ?></span>
            </div>

            <div class="form-group">
                <button name="submit" type="submit" class="btn btn-success">Submit</button>
                <button name="cancel" type="reset" class="btn btn-danger">Cancel</button>
            </div>

        	Forget Password? <a href="<?php echo base_url("boot/forget_password"); ?>">Click Here</a>

            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('msg'); ?>
            <?php echo $this->session->flashdata('verify_msg'); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-5 col-md-offset-3 text-center">    
        New User? <a href="<?php echo base_url("boot/register"); ?>">Sign Up Here</a>
    </div>
</div>

</div>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
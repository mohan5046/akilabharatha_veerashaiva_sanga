<br/>
<div class="container-fluid">
<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Registration Form</h3>
        </div>
        <div class="panel-body">
        <?php echo form_open("boot/add_user");?>

            <div class="form-group">
                <label for="fname">First Name</label>
                <input class="form-control" name="fname" placeholder="First Name" type="text" value="<?php echo set_value('fname'); ?>" />
                <span class="text-danger"><?php echo form_error('fname'); ?></span>
            </div>

            <div class="form-group">
                <label for="lname">Last Name</label>
                <input class="form-control" name="lname" placeholder="Your Full Name" type="text" value="<?php echo set_value('lname'); ?>" />
                <span class="text-danger"><?php echo form_error('lname'); ?></span>
            </div>
            
            <div class="form-group">
                <label for="ph_no">Ph No</label>
                <input class="form-control" name="ph_no" placeholder="Ph No" type="text" value="<?php echo set_value('ph_no'); ?>" />
                <span class="text-danger"><?php echo form_error('ph_no'); ?></span>
            </div>

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
                <label for="cpassword">Conform Password</label>
                <input class="form-control" name="cpassword" placeholder="Conform Password" type="password" value="<?php echo set_value('cpassword'); ?>" />
                <span class="text-danger"><?php echo form_error('cpassword'); ?></span>
            </div>

            <div class="form-group">
                <button name="submit" type="submit" class="btn btn-success">Submit</button>
                <button name="cancel" type="reset" class="btn btn-danger">Cancel</button>
            </div>
            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('msg'); ?>
            <?php echo $this->session->flashdata('verify_msg'); ?>
        </div>
    </div>
</div>

<div class="row">
        <div class="col-md-5 col-md-offset-3 text-center">    
        Already Register? <a href="<?php echo base_url("boot/login"); ?>">Login Here</a>
        </div>
    </div>

</div>
<br/>
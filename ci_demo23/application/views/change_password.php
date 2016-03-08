<br/>
<br/>
<br/>
<div class="container-fluid">
<div class="col-md-5 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Password Recovery Form</h3>
        </div>
        <div class="panel-body">
        <?php echo form_open("boot/update_password");?>

            <div class="form-group">
                <label for="password">New Password</label>
                <input class="form-control" name="password" placeholder="New Password" type="password"/>
                <span class="text-danger"><?php echo form_error('password'); ?></span>
            </div>

            <div class="form-group">
                <label for="cpassword">Conform Password</label>
                <input class="form-control" name="cpassword" placeholder="Conform Password" type="password"/>
                <span class="text-danger"><?php echo form_error('cpassword'); ?></span>
            </div>

            <input class="form-control" name="hash" type="hidden" value="<?php echo $hash; ?>"/>

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
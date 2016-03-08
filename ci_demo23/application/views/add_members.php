<br/>
<div class="container-fluid">
<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Add Member Details</h3>
        </div>
        <div class="panel-body">
        <?php echo form_open_multipart("main/add_member_db");?>

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
                <label for="date">Date of Birth</label>
                <input class="form-control" name="date" type="date"/>
                <span class="text-danger"><?php echo form_error('date'); ?></span>
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
                <label for="relationship">Relationship</label> <br/>
                 <?php
                    $options=array('family' => 'family','others' => 'others');
                    echo form_dropdown('relationship', $options, 'family', 'class="dropdown_box1"');
                 ?>
                <span class="text-danger"><?php echo form_error('relationship'); ?></span>
            </div>

            <div class="form-group">
                <label for="userfile">Select image to upload</label>
                <input type="file" name="userfile" size="3000" />
                <span class="text-danger"><?php echo form_error('userfile'); ?></span>
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

</div>
<br/>
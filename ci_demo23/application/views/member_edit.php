<br/>
<div class="container-fluid">
<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Display Pic</h3>
        </div>
        <div class="panel-body">
        <?php echo form_open_multipart("main/edit_member_img");?>

        <img src="<?php echo base_url($memlist[0]->image); ?>" alt="No Img" width="103" height="113">

            <div class="form-group">
                <label for="userfile">Want to change image?? Browse and upload..!</label>
                <input type="file" name="userfile" size="3000" />
                <span class="text-danger"><?php echo form_error('userfile'); ?></span>
            </div>

            <input class="form-control" name="m_id" type="hidden" value="<?php echo $memlist[0]->m_id; ?>"/>

            <div class="form-group">
                <button name="submit" type="submit" class="btn btn-success">Upload</button>
            </div>

            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('msg'); ?>
            <?php echo $this->session->flashdata('verify_msg'); ?>
        </div>
    </div>
</div>

</div>






<br/>
<div class="container-fluid">
<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Member Details</h3>
        </div>
        <div class="panel-body">
        <?php echo form_open("main/member_update");?>

            <div class="form-group">
                <label for="fname">First Name</label>
                <input class="form-control" name="fname" placeholder="First Name" type="text" value="<?php echo $memlist[0]->fname; ?>" />
                <span class="text-danger"><?php echo form_error('fname'); ?></span>
            </div>

            <div class="form-group">
                <label for="lname">Last Name</label>
                <input class="form-control" name="lname" placeholder="First Name" type="text" value="<?php echo $memlist[0]->lname; ?>" />
                <span class="text-danger"><?php echo form_error('lname'); ?></span>
            </div>
            
            <div class="form-group">
                <label for="ph_no">Ph No</label>
                <input class="form-control" name="ph_no" placeholder="First Name" type="text" value="<?php echo $memlist[0]->ph_no; ?>" />
                <span class="text-danger"><?php echo form_error('ph_no'); ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email ID</label>
                <input class="form-control" name="email" placeholder="First Name" type="text" value="<?php echo $memlist[0]->email; ?>" />
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

            
            <input class="form-control" name="m_id" type="hidden" value="<?php echo $memlist[0]->m_id; ?>"/>

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
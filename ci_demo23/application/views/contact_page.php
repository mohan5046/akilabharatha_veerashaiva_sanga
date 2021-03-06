<?php echo anchor('contactform/index', 'Home', 'title="Home"'); ?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeIgniter Contact Form Example</title>
    <link href="<?php echo base_url("assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Contact Form</h3>
        </div>
        <div class="panel-body">
        <?php $attributes = array("name" => "contactform");
            echo form_open("contactform/add_contact", $attributes);?>
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" name="name" placeholder="Your Full Name" type="text" value="<?php echo set_value('name'); ?>" />
                <span class="text-danger"><?php echo form_error('name'); ?></span>
            </div>
            
            <div class="form-group">
                <label for="ph_no">Ph No</label>
                <input class="form-control" name="ph_no" placeholder="Ph No" type="text" value="<?php echo set_value('email'); ?>" />
                <span class="text-danger"><?php echo form_error('email'); ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email ID</label>
                <input class="form-control" name="email" placeholder="Email-ID" type="text" value="<?php echo set_value('email'); ?>" />
                <span class="text-danger"><?php echo form_error('email'); ?></span>
            </div>

            <div class="form-group">
                <button name="submit" type="submit" class="btn btn-success">Submit</button>
            </div>
            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('msg'); ?>
        </div>
    </div>
</div>
</body>
</html>
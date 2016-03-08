<!DOCTYPE html>
<html lang="en">
<head>

  <link rel="shortcut icon" href="<?php echo base_url("assets/images/basaveshvara4.jpg"); ?>" />
  <title>Sample Application</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }

    .dropdown_box1{
      width:300px;
      height:30px;
      margin-top:-5px;
      font-size: 16px;
      font-family: cursive;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">
      <img src="<?php echo base_url("assets/images/basaveshvara3.jpg"); ?>" alt="icon" width="38" height="33">
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><?php echo anchor('main/home', 'Home', 'title="Home"'); ?></li>
        <li><?php echo anchor('main/members', 'Members', 'title="Members"'); ?></li>
        <li><a href="<?php echo base_url("main/add_member"); ?>"><span class="glyphicon glyphicon-user"></span>Add Members</a></li>
        <li><?php echo anchor('main/contact', 'Contact Us', 'title="Contact"'); ?></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo $usr; ?></a></li>
        <li><a href="<?php echo base_url("main/logout"); ?>"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php $active=""; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Offer Admin panel </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/lib/select2/select2.css"/>
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/lib/select2/select2-bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/lib/alertify/alertify.min.css"/>
     <link href="<?php echo base_url() ?>asset/lib/css/style.css" rel="stylesheet" type="text/css"/>
     
       <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/dist/css/skins/_all-skins.min.css">
     <link rel="stylesheet" href="<?php echo base_url() ?>asset/lib/jquery_ui/jquery-ui.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/lib/jquery_ui/jquery-ui.theme.min.css"/>

	  <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url() ?>asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
     <script src="<?php echo base_url() ?>asset/lib/jquery_ui/jquery-ui.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
  </head>

      <?php /*?>  <div class="container" style="background: #f5f5f5; height: 40px;">
            <div row>
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active"><a href="<?php echo base_url() ?>">Home</a></li>
                        <li><a href="#"><?php echo $this->uri->segment(1)?></a></li>
                        <li class="pull-right"><a class="btn btn-sm btn-info" href="#" onclick="javascript: window.history.back()">Back</a></li>
                    </ol>
                </div>
            </div>
        </div><?php */?>
        
        
 <body class="hold-transition skin-blue sidebar-mini">
 	<div id="loaderkender" style=""><div><button class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i>&nbsp;&nbsp;Loading...</button></div></div>
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url()?>admin" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>O</b>FF</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>OFFER</b>ADMIN</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">4</span>
                </a>
               
              </li>
               
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url()?>asset/images/profile-dummy.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs">Administrator</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url()?>asset/images/profile-dummy.jpg" class="img-circle" alt="User Image">
                    <p>
                      Admin
                    </p>
                  </li>
                  <!-- Menu Body -->
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                   <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Change Password</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url()?>auth/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              
            </ul>
          </div>
        </nav>
      </header>

	  










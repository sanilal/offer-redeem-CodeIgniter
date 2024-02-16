<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Admin Panel reset Password </title>

<?php $this->load->view('public/includes/head'); ?>
<link rel="stylesheet" id="woocommerce-layout-css"  href="<?php echo base_url() ?>asset/css/woocommerce-layout.css?ver=2.6.9" type="text/css" media="all" />
<link rel="stylesheet" id="woocommerce-general-css"  href="<?php echo base_url() ?>asset/css/woocommerce.css?ver=2.6.9" type="text/css" media="all" />
</head>
<body class="page page-template page-template-page-tpl_my_profile page-template-page-tpl_my_profile-php logged-in admin-bar customize-support woocommerce-account woocommerce-page">
<?php $this->load->view('public/includes/header'); ?>
<section class="page-title">
        <div class="container">
            <div class="clearfix">
                 <div class="pull-left">
                    
                </div>
                <div class="pull-right">
                    <ul class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>admin">Home</a></li>
                    <li>Reset Password</li>
                    </ul>			
               </div>
               
            </div>
        </div>
    </section>
    
<section>
<div class="container" >
    
     <div class="row">
      <div class="col-md-4">
    			<?php $this->load->view('admin/includes/sidebar'); ?>
    
                </div>

            <div class="col-md-8">
                <div class="white-block">
                    
                    <div class="white-block-content">
                        <div class="page-content clearfix">
                            <div class="woocommerce">
    <div class="row clear_fix">
        <div class="col-md-6 col-md-offset-3"  style="position: relative">
            <p class="alert alert-danger  login-form text-center" id="response"><b>Your new password has been set.</b></p>
        </div>
    </div>
            <div class="row clear_fix">
                <div class="col-md-6 col-md-offset-3 login-form"  style="position: relative">
                    <style>
                        #response{display: none}
                    </style>
                    
                    <form id="frm_reset" role="form" action="<?php echo base_url() ?>auth/resetProcess" method="POST">
                        <div class="form-group">
                          <label for="">New password for admin login:</label>
                         
                          <hr/>
                          <label>New Password</label>
                          <input type="password" id="pass" class="form-control" name="pass"  placeholder="">
                          <label>Confirm Password</label>
                          <input type="password" id="cpass" class="form-control" name="cpass"  placeholder="">
                        </div>
                        <input type="hidden" value="<?php echo $this->session->userdata('username'); ?>" name="hiddenid"/>
                        <button class="btn btn-info btn-block">Update</button>
                      </form>
                      <br/>
                </div>
            </div>
        </div>
       </div>
       </div>
       </div>
       </div>
       </div>
       </div>
   </section>
   <?php $this->load->view('admin/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>
        <script>
        jQuery(document).ready(function (){
            jQuery("#frm_reset").submit(function (e){
                e.preventDefault();
                var url = jQuery(this).attr('action');
                var method = jQuery(this).attr('method');
                var data = jQuery(this).serialize();
                
                jQuery.ajax({
                   url:url,
                   type:method,
                   data:data
                }).done(function(data){
                        jQuery("#response").text(data);
                        jQuery("#response").slideDown('fast');
                        jQuery('#frm_reset')[0].reset();
                        setTimeout(function (){
                            jQuery("#response").slideUp('fast');
                        },3000);
                    });
                     
                });
            });
        
        </script>

</body>
</html>

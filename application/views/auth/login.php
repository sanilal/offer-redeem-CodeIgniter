<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Login to Admin Paenl</title>

<?php $this->load->view('public/includes/head'); ?>
<link rel="stylesheet" id="woocommerce-layout-css"  href="<?php echo base_url() ?>asset/css/woocommerce-layout.css?ver=2.6.9" type="text/css" media="all" />
<link rel="stylesheet" id="woocommerce-general-css"  href="<?php echo base_url() ?>asset/css/woocommerce.css?ver=2.6.9" type="text/css" media="all" />
</head>
<body class="page page-id-473 page-template page-template-page-tpl_full_width page-template-page-tpl_full_width-php woocommerce-account woocommerce-page">
<?php $this->load->view('public/includes/header'); ?>

<section class="page-title">
        <div class="container">
            <div class="clearfix">
                <div class="pull-left">
                    <h1>
                        Login to Admin Paenl		</h1>
                </div>
               
            </div>
        </div>
    </section>
    
<section>
	<div class="container" >
    
     <div class="row">

            <div class="col-md-12">
                <div class="white-block">
                    
                    <div class="white-block-content">
                        <div class="page-content clearfix">
                            <div class="woocommerce">
                            		<h2 align="center">Admin Login</h2>
                                    <br>
                                    <div class="row clear_fix">
                                        <div class="col-md-4 col-md-offset-4"style="position: relative">
                                            <p class="alert alert-danger text-center  login-form" id="response">INVALID USER NAME OR PASSWORD</p>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row clear_fix">
                                        <div class="col-md-4 col-md-offset-4 login-form"  style="position: relative">
                                            <style>
                                                #response{display: none}
                                            </style>
                                            <form id="frm_login" role="form" action="<?php echo base_url() ?>auth/login" method="POST" class="login">
                                                <div class="form-group">
                                                  <label for="">User name</label>
                                                  <input type="text" class="form-control" name="username"  placeholder="User name">
                                                </div>
                                                <div class="form-group">
                                                  <label for="">Password</label>
                                                  <input type="password" class="form-control" name="password"  placeholder="Password">
                                                </div>
                                                <input type="submit" class="btn btn-info btn-block" value="Login">
                                              </form>
                                            <a href="<?php echo base_url()?>forgetPass" class="">Forget password</a>                    
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
            document.cookie = "login = false";
            jQuery("#frm_login").submit(function (e){
                e.preventDefault();
                var url = jQuery(this).attr('action');
                var method = jQuery(this).attr('method');
                var data = jQuery(this).serialize();
                jQuery.ajax({
                   url:url,
                   type:method,
                   data:data
                }).done(function(data){
                   if(data =='false')
                    {
                        jQuery("#response").slideDown('fast');
                        jQuery('#frm_login')[0].reset();
                        setTimeout(function (){
                            jQuery("#response").slideUp('fast');
                        },3000);
                    }
                    else if(data =='true')
                    {
                    document.cookie = "login = true";
                    window.location.href='<?php echo base_url() ?>admin/';
                    throw new Error('go');
                    } 
                });
            });
        });
        </script>
</body>
</html>
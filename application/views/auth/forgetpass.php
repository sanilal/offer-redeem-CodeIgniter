<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Admin Panel Forget Password </title>

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
                        Forgot Passord? Enter your email id
                    </h1>
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
                            		
    <div class="row clear_fix">
        <div class="col-md-6 col-md-offset-3"  style="position: relative">
            <p class="alert alert-danger  login-form text-center" id="response">This Email address is not registered with us.</p>
        </div>
    </div>
            <div class="row clear_fix">
                <div class="col-md-6 col-md-offset-3 login-form"  style="position: relative">
                    <style>
                        #response{display: none}
                    </style>
                    
                    <form id="frm_forget" role="form" action="<?php echo base_url() ?>auth/forgetpass" method="POST">
                        <div class="form-group">
                          <label for="">Enter your registered email address!</label>
                          <input type="text" id="useremail" class="form-control" name="email"  placeholder="Email">
                        </div>
                        <button class="btn btn-info btn-block">Reset</button>
                      </form>
                      <br/>
                    <a href="<?php echo base_url()?>auth" class="btn-block">login</a>                    
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
             jQuery("#frm_forget").submit(function (e){
                e.preventDefault();
                var url =  jQuery(this).attr('action');
                var method =  jQuery(this).attr('method');
                var data =  jQuery(this).serialize();
                
                 jQuery.ajax({
                   url:url,
                   type:method,
                   data:data
                }).done(function(data){
                    console.log(data);
                   if(data =='false')
                    {
                         jQuery("#response").slideDown('fast');
                         jQuery('#frm_forget')[0].reset();
                        setTimeout(function (){
                             jQuery("#response").slideUp('fast');
                        },3000);
                    }
                    else if(data == 'true')
                    {
                    window.location.href='<?php echo base_url() ?>resettrue/'+ jQuery('#useremail').val();
                    throw new Error('go');
                    } 
                });
            });
        });
        </script>

</body>
</html>
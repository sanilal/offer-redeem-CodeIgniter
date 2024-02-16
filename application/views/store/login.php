<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Offerredeem - Store Login</title>

<?php $this->load->view('public/includes/head'); ?>

</head>
<body class="home page page-id-3274 page-template page-template-page-tpl_home_page page-template-page-tpl_home_page-php">
<?php $this->load->view('public/includes/header'); ?>


  
                                
                                
    <section class="search-bar clearfix">
        <div class="container">
        	<div class="row">
				<div class="col-xs-6">       
            		<h4> Login to your account</h4>
                    <?php
            $error  = $this->session->flashdata('error');
            if(isset($error)){
                echo $error;
            }
            ?>
                        <form class="form-login" method="post" action="<?php echo base_url() ?>store/login_check">
                            <div class="checkbox col-lg-6">
                                <input type="checkbox" name="login-store" id="login-store" checked />
                                <label for="login-store">Store Account</label>
                            </div>
                            <?php /*?><div class="checkbox col-lg-6 mt0">    
                                <input type="checkbox" name="login-user" id="login-user" />
                                <label for="login-user">User Account</label>
                            </div><?php */?>
                            <div class="clearfix"></div>
                                <label for="login-username">Username</label>
                                <input type="text" name="username" id="login-username" class="form-control" />
            
                                <label for="login-password">Password</label>
                                <input type="password" name="password" id="login-password" class="form-control" />
        
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="checkbox checkbox-inline">
                                        <input type="checkbox" name="login-remember" id="login-remember" />
                                        <label for="login-remember">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <a href="javascript:;" class="forgot-password" data-dismiss="modal">Forgot Password?</a>
                                </div>
                            </div>
        
                            <button type="submit" class="btn ">LOGIN</button>
                             or 					<a href="<?php echo base_url() ?>store/register" class="register-close-login" data-dismiss="modal">register here</a>
                            <input type="hidden" name="action" value="login">
                            <div class="ajax-response"></div>
                        </form>
                    </div>
               </div>
        </div>    
        
  </section>
		

<?php $this->load->view('public/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>

</body>
</html>
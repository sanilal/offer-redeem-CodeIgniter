<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Offerredeem - User Login</title>

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
                        My Account				</h1>
                </div>
                <div class="pull-right">
                    <ul class="breadcrumb"><li><a href="<?php echo base_url() ?>">Home</a></li><li>My Account</li></ul>			
                </div>
            </div>
        </div>
    </section>
  
  
  <section>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="white-block">
                    
                    <div class="white-block-content">
                        <div class="page-content clearfix">
                            <div class="woocommerce">



<div class="u-columns col2-set" id="customer_login">
<div align="center">
	 <?php
            $error  = $this->session->flashdata('error');
            if(isset($error)){
                echo $error;
            }
            ?>
</div>

	<div class="u-column1 col-1">


		<h2>Login</h2>
        <div class="apsl-login-networks theme-4 clearfix">
   				<span class="apsl-login-new-text"></span>
                 
            <?php
            require_once APPPATH.'../asset/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
			$fb = new Facebook\Facebook([
			  'app_id' => '1364443700312845',
			  'app_secret' => '2bbd79281252def07e0f877340112c77',
			  'default_graph_version' => 'v2.5',
			]);
			$helper = $fb->getRedirectLoginHelper();
			$permissions = ['email']; // Optional permissions
			$loginUrl = $helper->getLoginUrl(base_url().'public_home/fb_login', $permissions);
			
			//echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
			?>
                <div class="social-networks">
                    <a href="<?php echo htmlspecialchars($loginUrl); ?>" title="Login with facebook" >
                        <div class="apsl-icon-block icon-facebook clearfix">
                            <i class="fa fa-facebook"></i>
                            <span class="apsl-login-text">Login</span>
                            <span class="apsl-long-login-text">Login with facebook</span>
                        </div>
                    </a>
               </div>
			</div>

		<form method="post" class="login" action="<?php echo base_url() ?>public_home/login_check">

			
			<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<label for="username">Username or email address <span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="" />
			</p>
			<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<label for="password">Password <span class="required">*</span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
			</p>

			
			<p class="form-row">
							<input type="submit" class="woocommerce-Button button" name="login" value="Login" />
				<?php /*?><label for="rememberme" class="inline">
					<input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember me				</label><?php */?>
			</p>
			<p class="woocommerce-LostPassword lost_password">
				<a href="#">Lost your password?</a>
			</p>

			
		</form>


	</div>

	<div class="u-column2 col-2">

		<h2>Register</h2>

		<form method="post" class="register" action="<?php echo base_url() ?>public_home/register">

			
			<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<label for="reg_name">Name <span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="name" id="reg_name" value="" />
			</p>
            
			<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<label for="reg_email">Email address <span class="required">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="" />
			</p>

			
				<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
					<label for="reg_password">Password <span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
				</p>
                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
					<label for="conf_password"> Confirm Password <span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="conf_password" id="conf_password" />
				</p>

			
		

			
			<p class="woocomerce-FormRow form-row">
							
                <input type="submit" class="woocommerce-Button button" name="register" value="Register" />
			</p>
		</form>
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
		

<?php $this->load->view('public/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>

</body>
</html>
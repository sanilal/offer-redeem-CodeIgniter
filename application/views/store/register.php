<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Offerredeem - Store Register</title>

<?php $this->load->view('public/includes/head'); ?>

</head>
<body class="home page page-id-3274 page-template page-template-page-tpl_home_page page-template-page-tpl_home_page-php">
<?php $this->load->view('public/includes/header'); ?>


  
                                
                                
    <section class="search-bar clearfix">
        <div class="container">
        	<div class="row">
				<div class="col-xs-6">       
            		<h4> Register store </h4>
                    <?php
            $error  = $this->session->flashdata('error');
            if(isset($error)){
                echo $error;
            }
			$success=$this->session->flashdata('success');
			if($success!=""){
				echo $success;
			}
			else{
            ?>
                       	<form class="form-register" action="<?php echo base_url() ?>store/addstore" method="post">
					<div class="checkbox col-lg-6">
                        <input type="checkbox" name="reg-store" id="reg-store" checked />
                        <label for="reg-store">Store Account</label>
                    </div>
                   
                   	<div class="clearfix"></div>
					<div class="row">
                    	<div class="col-md-6">
							<label for="register-businessname">Store Name</label>
							<input type="text" name="name" id="register-businessname" class="form-control" />						
						</div>
                        <div class="col-md-6">
							<label for="register-contactperson">Contact Person</label>
							<input type="text" name="contactperson" id="register-contactperson" class="form-control" />						
						</div>
                         <div class="col-md-6">
							<label for="register-contactnumber">Contact Number</label>
							<input type="text" name="phone1" id="register-contactnumber" class="form-control" />						
						</div>
                        <div class="col-md-6">
							<label for="register-loction">City</label>
							<input type="text" name="city" id="register-loction" class="form-control" />						
						</div>
						<div class="col-md-6">
							<label for="register-username">Co-ordinates</label>
							<input type="text" name="cord" id="register-cord" class="form-control" />						
						</div>
						<div class="col-md-6">
							<label for="register-email">Email (Login id)</label>
							<input type="email" name="email" id="register-email" class="form-control" />						
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<label for="register-password">Password</label>
							<input type="password" name="password" id="register-password" class="form-control" />							
						</div>					
						<div class="col-md-6">
							<label for="register-password-repeat">Repeat Password</label>
							<input type="password" name="password-repeat" id="register-password-repeat" class="form-control" />							
						</div>
					</div>
					<div> &nbsp;</div>
					<button type="submit" class="btn">REGISTER</button>
					 or 					<a href="<?php echo base_url() ?>store/login" class="register-close-login" >login here</a>					
					<input type="hidden" name="action" value="register">

                    					
				</form>
                <?php } ?>
                    </div>
               </div>
        </div>    
        
  </section>
		

<?php $this->load->view('public/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>

</body>
</html>
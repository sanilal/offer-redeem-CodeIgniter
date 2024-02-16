<section class="clients-bar">
		<div class="container">
						<div class="clients-owl">
									<div class="client">
						<a href="#" title="">
							<img width="500" height="188" src="<?php echo base_url() ?>asset/images/carrefour.png" class="attachment-full size-full wp-post-image" alt="carrefour" srcset="<?php echo base_url() ?>asset/images/carrefour.png 500w, assets/images/carrefour-300x113.png 300w" sizes="(max-width: 500px) 100vw, 500px" />						</a>
					</div>
										<div class="client">
						<a href="#" title="">
							<img width="189" height="43" src="<?php echo base_url() ?>asset/images/sharafdg.png" class="attachment-full size-full wp-post-image" alt="sharafdg" />						</a>
					</div>
										<div class="client">
						<a href="#" title="">
							<img width="400" height="162" src="<?php echo base_url() ?>asset/images/mamis-illam-logo-2.png" class="attachment-full size-full wp-post-image" alt="mamis-illam-logo" srcset="<?php echo base_url() ?>asset/images/mamis-illam-logo-2.png 400w, assets/images/mamis-illam-logo-2-300x122.png 300w" sizes="(max-width: 400px) 100vw, 400px" />						</a>
					</div>
										<div class="client">
						<a href="#" title="">
							<img width="400" height="153" src="<?php echo base_url() ?>asset/images/splash.png" class="attachment-full size-full wp-post-image" alt="splash" srcset="<?php echo base_url() ?>asset/images/splash.png 400w, assets/images/splash-300x115.png 300w" sizes="(max-width: 400px) 100vw, 400px" />						</a>
					</div>
								</div>
					</div>
	</section>
	

		<section class="subscribe-bar">
		<div class="container">
										<h2>Receive the best offers</h2>
			
										<p>Stay in touch with us and we&#039;ll notify you about best offers</p>
			
			<form class="subscribe-box" method="post" action="<?php echo base_url() ?>subscribe">
				<div class="subscribe-input-wrap">
					<i class="fa fa-envelope"></i>
					<input type="text" class="form-control" placeholder="Type your email here..." name="email">
				</div>
				<a href="javascript:;" class="footer-subscribe btn subscribe_btn">Subscribe</a>
				<input type="hidden" name="action" value="subscribe">
				<div class="ajax-response"></div>
			</form>
		</div>
	</section>
	
	<section class="widget-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="widget white-block widget_classifieds_logo_text">
                        <div class="widget-social">
                            <img src="<?php echo base_url() ?>asset/images/offer-logo3-4.png" alt="">
                            <p>
                            	Best Special offers available in your city. &nbsp; Placing offers has never been easier!
                            	
                            </p>
                        </div>
                    </div>                
                </div>

                <div class="col-md-3 pull-right">
                    <div class="widget white-block widget_classifieds_follow_us">
                    	<h4>Follow Us</h4>
                        <div class="widget-social">
                            <a href="#" target="_blank" class="btn"><span class="fa fa-facebook"></span></a>
                            <a href="#" target="_blank" class="btn"><span class="fa fa-twitter"></span></a>
                            <a href="#" target="_blank" class="btn"><span class="fa fa-linkedin"></span></a>
                            <a href="#" target="_blank" class="btn"><span class="fa fa-google-plus"></span></a>
                        </div>
                    </div>                
                </div>
                <?php /*?><div class="col-md-3">
                    <div class="widget white-block widget_classifieds_payments">
                    	<h4>Payments</h4>
                        <ul class="list-unstyled list-inline">
                        	<li><a href="#"><img src="<?php echo base_url() ?>asset/classifieds/images/small-skrill.png" width="32" height="22" alt="skrill"></a></li>
                            <li><a href="#"><img src="<?php echo base_url() ?>asset/classifieds/images/small-paypal.png" width="32" height="22" alt="paypal"></a></li>
                            <li><a href="#"><img src="<?php echo base_url() ?>asset/classifieds/images/small-ideal.png" width="32" height="22" alt="ideal"></a></li>
                            <li><a href="#"><img src="<?php echo base_url() ?>asset/classifieds/images/small-stripe.png" width="32" height="22" alt="stripe"></a></li>
                            <li><a href="#"><img src="<?php echo base_url() ?>asset/classifieds/images/small-bank.png" width="32" height="22" alt="bank"></a></li>
                            <li><a href="#"><img src="<?php echo base_url() ?>asset/classifieds/images/small-payu.png" width="32" height="22" alt="payu"></a></li>
                        </ul>
                    </div>                
                </div>  <?php */?>              
            </div>
        </div>
    </section>

    <section class="footer">
        <div class="container"> © &nbsp; <a href="http://offerredeem.com">Offer Redeem</a>. &nbsp;&nbsp;  All rights reserved 2017. </div>
    </section>
	

<!-- modal -->
<div class="modal fade in" id="login" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
				<h4>Login</h4>		
					
				<form class="form-login">
                	<div class="checkbox col-lg-6">
                        <input type="checkbox" name="login-store" id="login-store" />
                        <label for="login-store">Store Account</label>
                    </div>
                    <div class="checkbox col-lg-6 mt0">    
                        <input type="checkbox" name="login-user" id="login-user" />
                        <label for="login-user">User Account</label>
                    </div>
                   	<div class="clearfix"></div>
					<div class="row">
                        <label for="login-username">Username</label>
                        <input type="text" name="login-username" id="login-username" class="form-control" />
    
                        <label for="login-password">Password</label>
                        <input type="password" name="login-password" id="login-password" class="form-control" />
                    </div>	

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

					<a href="javascript:;" class="btn submit-form-ajax">LOGIN</a>
					 or 					<a href="javascript:;" class="register-close-login" data-dismiss="modal">register here</a>
					<input type="hidden" name="action" value="login">
					<div class="ajax-response"></div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- .modal -->
<!-- modal -->
<div class="modal fade in" id="register" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
				<h4>Register</h4>
				<form class="form-register">
					<div class="checkbox col-lg-6">
                        <input type="checkbox" name="reg-store" id="reg-store" />
                        <label for="reg-store">Store Account</label>
                    </div>
                    <div class="checkbox col-lg-6 mt0">    
                        <input type="checkbox" name="reg-user" id="reg-user" />
                        <label for="reg-user">User Account</label>
                    </div>
                   	<div class="clearfix"></div>
					<div class="row">
                    	<div class="col-md-6">
							<label for="register-businessname">Business Name</label>
							<input type="text" name="register-businessname" id="register-businessname" class="form-control" />						
						</div>
                        <div class="col-md-6">
							<label for="register-contactperson">Contact Person</label>
							<input type="text" name="register-contactperson" id="register-contactperson" class="form-control" />						
						</div>
                         <div class="col-md-6">
							<label for="register-contactnumber">Contact Number</label>
							<input type="text" name="register-contactnumber" id="register-contactnumber" class="form-control" />						
						</div>
                        <div class="col-md-6">
							<label for="register-loction">Location</label>
							<input type="text" name="register-loction" id="register-loction" class="form-control" />						
						</div>
						<div class="col-md-6">
							<label for="register-username">Username</label>
							<input type="text" name="register-username" id="register-username" class="form-control" />						
						</div>
						<div class="col-md-6">
							<label for="register-email">Email</label>
							<input type="text" name="register-email" id="register-email" class="form-control" />						
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<label for="register-password">Password</label>
							<input type="password" name="register-password" id="register-password" class="form-control" />							
						</div>					
						<div class="col-md-6">
							<label for="register-password-repeat">Repeat Password</label>
							<input type="password" name="register-password-repeat" id="register-password-repeat" class="form-control" />							
						</div>
					</div>

					<a href="javascript:;" class="btn submit-form-ajax">REGISTER</a>
					 or 					<a href="javascript:;" class="register-close-login" data-dismiss="modal">login here</a>					
					<input type="hidden" name="action" value="register">
					<div class="ajax-response"></div>

                    					
				</form>
			</div>
		</div>
	</div>
</div>
<!-- .modal -->

<div class="modal fade in" id="recover" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
				<h4>Recover Password &amp; Username</h4>
				<form class="form-login">
					<label for="recover-email">Email</label>
					<input type="text" name="recover-email" id="recover-email" class="form-control" />


					<a href="javascript:;" class="btn submit-form-ajax">RECOVER</a>
					<input type="hidden" name="action" value="recover">
					<div class="ajax-response"></div>
					
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade in" id="filters" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
				<div class="filters-modal-holder">
									</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fadein" id="payUAdditional" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content showCode-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
				<div class="payu-content-modal">
				</div>
			</div>
		</div>
	</div>
</div>
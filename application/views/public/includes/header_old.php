<section class="navigation"
         data-enable_sticky="yes">
	<div class="container">
		<div class="clearfix">
        <?php if(!isset($menu_active)){$menu_active="home";} ?>
			<div class="pull-left">
             	<a href="<?php echo base_url() ?>index.php" class="site-logo">
                	<img src="<?php echo base_url() ?>asset/images/offer-logo3-4.png" title="" alt="" width="180" height="70">
				</a>
			</div>
			<div class="pull-right">
				<button class="navigation-toggle">
					<i class="fa fa-bars"></i>
				</button>
                
				<div class="navbar navbar-default" role="navigation">
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav clearfix">
                            <li id="menu-item-3289" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3289"><a href="#">How It Works?</a></li>
                            <li id="menu-item-3364" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3364 <?php if($menu_active=="offers"){ echo 'current-menu-item current_page_item';} ?>"><a href="<?php echo base_url()?>offers">Offers</a></li>
                            <li id="menu-item-3365" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3365"><a href="#">Add Points</a></li>
                            <li id="menu-item-3366" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3366"><a href="#">Redeem Points</a></li>
                            
                            <?php
							$store_name=$this->session->userdata('storename');
							if($store_name!=""){ $href_page="store";} 
							else if($this->session->userdata('role')=="admin"){ $href_page="admin"; }
							else {$href_page="user";}
							 ?>
                             <?php $username=$this->session->userdata('user_name');  ?>
                            <li id="menu-item-3356" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3356 <?php if($menu_active=="account"){ echo 'current-menu-item current_page_item';} ?>"><a href="<?php echo base_url().$href_page; ?>">My Account</a></li>
                            <?php if($store_name!=""){ ?>
                            <li><a href="<?php echo base_url() ?>store/logout" ><i class="fa fa-power-off" title="logout"></i> Logout</a></li>
                            <?php } else if($username!=""){ ?>
                            <li><a href="<?php echo base_url() ?>public_home/logout" ><i class="fa fa-power-off" title="logout"></i> Logout</a></li>
                            <?php } 
							else if($href_page=="admin"){ ?>
                            <li><a href="<?php echo base_url()?>auth/logout" ><i class="fa fa-power-off" title="logout"></i> Logout</a></li>
							<?php } else { ?>
                            <li><a href="<?php echo base_url() ?>user/login"  class="login-action"> <i class="fa fa-user-plus" title="Login"></i> Login</a></li>
                            <?php } ?>
                            <li class="submit-add"><a href="<?php echo base_url() ?>offer/create" class="btn">SUBMIT OFFER</a></li>
						</ul>					
                    </div>
				</div>
			</div>
		</div>
	</div>
</section>
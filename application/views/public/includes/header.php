<section class="navigation"
         data-enable_sticky="yes">
	<div class="container">
		<div class="clearfix">
        <?php if(!isset($menu_active)){$menu_active="home";} ?>
        
        <div class="col-md-2 col-sm-12 col-xs-12">
			<div class="pull-left" style="margin-top: 13px;">
             	<a href="<?php echo base_url() ?>index.php" class="site-logo">
                	<img src="<?php echo base_url() ?>asset/images/offer-logo3-4.png" title="" alt="" width="180" height="70">
				</a>
			</div>
         </div>
         
         <div class="col-md-8 col-sm-12 col-xs-12">	
			<div class="pull-right">
				<button class="navigation-toggle">
					<i class="fa fa-bars"></i>
				</button>
                
				<div class="navbar navbar-default" role="navigation">
					<div class="collapse navbar-collapse" style="padding-right:0;">
						<ul class="nav navbar-nav clearfix">
                            <li id="menu-item-3289" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3289 <?php if($menu_active=="how_to"){ echo 'current-menu-item current_page_item';} ?>" style="margin-left:20px;"><a href="<?php echo base_url()?>how_it_works">How It Works?</a></li>
                            <li id="menu-item-3364" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3364 <?php if($menu_active=="offers"){ echo 'current-menu-item current_page_item';} ?>"><a href="<?php echo base_url()?>offers">Offers</a></li>
                            <li id="menu-item-3365" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3365 <?php if($menu_active=="add-point"){ echo 'current-menu-item current_page_item';} ?>"><a href="<?php echo base_url()?>user/add-point">Add Points</a></li>
                            <li id="menu-item-3366" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3366 <?php if($menu_active=="redeem-point"){ echo 'current-menu-item current_page_item';} ?>"><a href="<?php echo base_url()?>user/redeem-point">Redeem Points</a></li>
                            
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
                            <?php /*?><li class="submit-add"><a href="<?php echo base_url() ?>offer/create" class="btn">SUBMIT OFFER</a></li><?php */?>
						</ul>					
                    </div>
				</div>
			</div>
          </div>
          
          <div class="col-md-2 col-sm-12 col-xs-12">
				
					<div class="navadd">
					 <div class="addhead">For Stores</div>
							<div class="addbtn" style="margin-bottom:5px;">
                                    <a href="<?php echo base_url() ?>offer/create"  class="btn submit-add">SUBMIT OFFER</a>
							</div>
							
							<div class="addbtn">
                                    <a href="<?php echo base_url() ?>store/points"  class="btn submit-add">ADD POINT</a>
							</div>
					</div>
				</div>
          
		</div>
	</div>
</section>
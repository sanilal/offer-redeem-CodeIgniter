    <div class="widget white-block">
                        <h4><i class="fa fa-pencil"></i> Dashboard</h4>
                    
    
                        <div class="media">
            <a class="pull-left" href="#">
            		<?php if($this->session->userdata('user_fb_id')!=""){ ?>
						
						<img src="https://graph.facebook.com/<?php echo $this->session->userdata('user_fb_id'); ?>/picture?type=large" class="img-responsive" alt="author" width="90"/>
					<?php	} else{ ?>
                        <img src="http://2.gravatar.com/avatar/e56993fd6579ea2f8aa11763817254c5?s=90&d=mm&r=g" class="img-responsive" alt="author"/>
                     <?php } ?>
                    <i class="fa fa-check verified" title="Verified User"></i>	</a>
        <div class="media-body">
            <ul class="list-unstyled">
                <li>
                    <i class="fa fa-user"></i> 
                    <a href="#">
                     <?php $username=$this->session->userdata('user_name'); echo $username; ?>
                    </a>
                </li>
              </ul>
        </div>
    </div>
                        
                        <ul class="list-unstyled">
                            <li <?php if($active=="dash"){echo  'class="active"'; } ?>>
                                <a href="<?php echo base_url() ?>user">
                                    <h4>Dashboard</h4>
                                </a>
                            </li>
                             <li <?php if($active=="add-point"){echo  'class="active"'; } ?>>
                                <a href="<?php echo base_url() ?>user/add-point">
                                    <h4>Add Points</h4>
                                </a>
                            </li>
                             <li <?php if($active=="redeem-point"){echo  'class="active"'; } ?>>
                                <a href="<?php echo base_url() ?>user/redeem-point">
                                    <h4>Redeem Points</h4>
                                </a>
                            </li>
                            <li <?php if($active=="profile"){echo  'class="active"'; } ?>>
                                <a href="<?php echo base_url() ?>user/profile">
                                    <h4>My Profile</h4>
                                </a>
                            </li>
                            <li <?php if($active=="order-history"){echo  'class="active"'; } ?>>
                                <a href="<?php echo base_url() ?>user/history">
                                    <h4>Point History</h4>
                                </a>
                            </li>
                        </ul>
                        <a href="<?php echo base_url() ?>public_home/logout" class="logout">
                            Log Out                    </a>
                    </div>
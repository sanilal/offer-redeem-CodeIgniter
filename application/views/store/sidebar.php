    <div class="widget white-block">
                        <h4><i class="fa fa-pencil"></i> Dashboard</h4>
                    
    
                        <div class="media">
            <a class="pull-left" href="#">
                        <img src="http://2.gravatar.com/avatar/e56993fd6579ea2f8aa11763817254c5?s=90&d=mm&r=g" class="img-responsive" alt="author"/>
                    <i class="fa fa-check verified" title="Verified User"></i>	</a>
        <div class="media-body">
            <ul class="list-unstyled">
                <li>
                    <i class="fa fa-user"></i> 
                    <a href="#">
                    <?php $row=$data->result(); $row=$row[0]; ?>
                        <?php echo $row->contact_person ?> <?php /*?><span title="Posted Ads">(26)</span><?php */?> 
                    </a>
                </li>
              </ul>
        </div>
    </div>
                        
                        <ul class="list-unstyled">
                            <li <?php if($active=="offers"){echo  'class="active"'; } ?>>
                                <a href="<?php echo base_url() ?>store">
                                    <h4>My Offers</h4>
                                </a>
                            </li>
                            <li <?php if($active=="profile"){echo  'class="active"'; } ?>>
                                <a href="<?php echo base_url() ?>store/profile">
                                    <h4>My Profile</h4>
                                </a>
                            </li>
                            <li <?php if($active=="add_offer"){echo  'class="active"'; } ?>>
                                <a href="<?php echo base_url() ?>offer/create">
                                    <h4>Submit Offer</h4>
                                </a>
                            </li>
                             <li <?php if($active=="points"){echo  'class="active"'; } ?>>
                                <a href="<?php echo base_url() ?>store/points">
                                    <h4>Points</h4>
                                </a>
                            </li>
                        </ul>
                        <a href="<?php echo base_url() ?>store/logout" class="logout">
                            Log Out                    </a>
                    </div>
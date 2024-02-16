    <div class="widget white-block">
                        <h4> Dashboard</h4>
                    
    
                        <div class="media" align="center">
            <a class="pull-left" href="<?php echo base_url()?>admin/resetpass">
                        <img src="<?php echo base_url()?>asset/images/profile-dummy.jpg" class="img-responsive" alt="author" width="100"/>
                    <i class="fa fa-check verified" title="Verified User"></i>	</a>
                    <a href="<?php echo base_url()?>admin/resetpass" ><span class="pull-right"><b>Administrator</b></span></a>
             <br/>
        <div class="media-body">
            
        </div>
    </div>
                        
                        <ul class="list-unstyled">
                           <li <?php if($active=="dash" || $active==""){echo 'class="active"';} ?>>
                           		<a href="<?php echo base_url()?>alert">
                                    <h4>Dashboard</h4>
                                </a>
                           </li>
                            <li <?php if($active=="offer"){echo  'class="active"'; } ?>>
                                <a href="<?php echo base_url() ?>admin/offerList">
                                    <h4>Offers</h4>
                                </a>
                            </li>
                            <li <?php if($active=="store"){echo  'class="active"'; } ?>>
                                <a href="<?php echo base_url()?>storeList">
                                    <h4>Stores</h4>
                                </a>
                            </li>
                            <li <?php if($active=="store_points"){echo 'class="active"';} ?>>
                                <a href="<?php echo base_url()?>admin/storePointList">
                                    <h4>Store Points</h4>
                                </a>
                            </li>
                            <li <?php if($active=="member"){echo 'class="active"';} ?>>
                                <a href="<?php echo base_url()?>memberList">
                                    <h4>Users</h4>
                                </a>
                            </li>
                            <li <?php if($active=="category"){echo 'class="active"';} ?>>
                                <a href="<?php echo base_url()?>admin/categoryList">
                                    <h4>Categories</h4>
                                </a>
                            </li>
                            <li <?php if($active=="location"){echo 'class="active"';} ?>>
                                <a href="<?php echo base_url()?>admin/locationList">
                                    <h4>Locations</h4>
                                </a>
                            </li>
                            
                        </ul>
                        <a href="<?php echo base_url()?>auth/logout" class="logout">
                            Log Out                    
                        </a>
                    </div>
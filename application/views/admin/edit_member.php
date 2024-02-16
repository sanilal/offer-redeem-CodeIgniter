
                        <form id="frm_update_member" action="<?php echo base_url()?>admin/memberUpdate" method="post" class="form">   
                        <legend>Personal Information</legend>
                            <div class="row">
                                <div class="col-xs-6 col-md-6">
                                    <label class="required">First name</label>
                                    <input type="text" name="firstname" value="<?php echo $row->fname?>" class="form-control input-sm" placeholder="First Name"  />
                                </div>
                                
                                <div class="col-xs-6 col-md-6">
                                    <label >Last name</label>
                                    <input type="text" name="lastname" value="<?php echo $row->lname?>" class="form-control input-sm" placeholder="Last Name"  />
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <label class="required">Email</label>
                                    <input type="text" name="email" value="<?php echo $row->user_email?>" class="form-control input-sm" placeholder="Email"  />
                                </div>
                            </div>
                            <label>Gender : </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" checked="checked" value="<?php echo $row->gender ;?>" id=male />                        
                                <?php echo $cg =  ($row->gender == 'M')? 'Male' :'Female' ;?>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" value="<?php  echo  ($cg == 'Male') ? 'F':'M';?>" id=female />                        
                                <?php echo $g =  ($row->gender == 'M')? 'Female' :'Male' ;?>
                            </label>
                            <br>
                            <label>Address</label>
                            <textarea class="form-control input-sm" name="address" rows="3" placeholder="Address"><?php echo $row->address ;?></textarea>
                            <label >Area/Town/City</label>
                            <input type="text" name="area" value="<?php echo $row->area ;?>" class="form-control input-sm"/>
                            <label class="required">Phone</label>
                            <input type="text" name="telephone" value="<?php echo $row->telephone ;?>" class="form-control input-sm"/>
                            <div style="display:none">
                            <label>Telephone 2</label>
                            <input type="text" name="telephone2" value="<?php echo $row->telephone2 ?>" class="form-control input-sm"/>
                            </div>
                            <br/>
                        
                    
                            
                     
                           
                            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                           
                         </form> 
                   
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Admin Panel - Users List </title>

<?php $this->load->view('public/includes/head'); ?>

</head>
<body class="page  page-template page-template-page-tpl_my_profile page-template-page-tpl_my_profile-php logged-in admin-bar customize-support">
<?php $this->load->view('public/includes/header'); ?>
<style type="text/css">
        ul>li, a{cursor: pointer;}
</style>
<section class="page-title">
        <div class="container">
            <div class="clearfix">
                <div class="pull-left">
                    
                </div>
                <div class="pull-right">
                    <ul class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>admin">Home</a></li>
                    <li>Users List</li>
                    </ul>			
               </div>
            </div>
        </div>
</section>

<section> 
 <style type="text/css">
.btndelete, .btnedit{ display:inline-block; color:#fff !important;}
</style>

<div class="container" >
    <div class="row">
       <div class="col-md-4">
    			<?php $this->load->view('admin/includes/sidebar'); ?>
    
                </div>
    
                <div class="col-md-8"> 
                    <div class="white-block">
                        <div class="white-block-content">
            <h1 class="text-center text-uppercase">Users</h1>
            <a href="#registerUser" data-toggle="modal" class="login-action btn" > <i class="fa fa-user-plus" title="Login"></i> Create User</a>
            <?php
            $delete  = $this->session->flashdata('delete');
            if(isset($delete)){
                echo $delete;
            }
            ?>
            <br/>
            <div class="ajaxResponse" id="adminajaxresponse"> </div>
            <br/>
            <div class="" ng-app="App1">

                <div class="tab-pane active" id="tab_default_1" ng-controller="gridController">
                    <div class="row clearfix">
                        <div class="col-md-12 column">
                            <div class="row">
                               
                                <div class="col-md-12">
                                    <div class="thumbnail">
                                        <div ng-show="filteredItems > 0">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                <th>Name&nbsp;</th>
                                                <th>Email&nbsp;</th>
                                                <th>Phone&nbsp;</th>
                                                <th>Created&nbsp;</th>
                                                <th>Action&nbsp;</th>
                                                </thead>
                                               <tbody id="ajaxlistplan">

                            					</tbody>
                                            </table>
                                        </div>

                                       
                                       
                                    </div>
                                </div>
                            </div>
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

<?php $this->load->view('admin/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>

<script>

        jQuery(document).ready(function () {
    //        call plan list method for populate table
            userList();

    //        plan craete form submit code
            jQuery('#frm_create_member').submit(function (e) {
                e.preventDefault();
                var self = jQuery(this);
                var type = self.attr('method');
                var url = self.attr('action');
                var data = self.serialize();
                jQuery.ajax({
                    url: url,
                    type: type,
                    data: data
                }).done(function (html) {
                    jQuery('#ajaxresponseUser').html(html);
                    //jQuery('#frm_admin_create')[0].reset();
                    userList();
                });
				setTimeout(function (){
						jQuery(".ajaxResponse").html('');
					},3000);
            });


    //        submit update modal

            //
							 jQuery('#submitEditModal').on('click', function (e) {
								e.preventDefault();
								jQuery.ajax({
									url: jQuery("#frm_update_member").attr('action'),
									type: jQuery("#frm_update_member").attr('method'),
									data: jQuery("#frm_update_member").serialize()
								}).done(function (html) {
									//alert(html);
									jQuery('#ajaxupdateUser').html(html);
									userList();
								});
								setTimeout(function (){
						jQuery(".ajaxResponse").html('');
					},3000);
							});
							//


        });
        var userList = function () {
            jQuery.ajax({
                url: '<?php echo base_url() ?>admin/memberListData',
                type: 'GET'
            }).done(function (html) {
                jQuery('#ajaxlistplan').html(html);
                var btnedit = jQuery('.btnedit');
                var btndelete = jQuery('.btndelete');

                //    open edit  modal as external edit page code
                btnedit.on('click', function (e) {
                    e.preventDefault();
                    jQuery.ajax({
                        url: jQuery(this).attr('data-url'),
                        type: 'GET',
                        data: 'id=' + jQuery(this).attr('data-id')
                    }).done(function (html) {
						//alert(html);
                        jQuery('#updateUser .modal-body').html(html);
                    });
                });

    //                delete plan entry
                btndelete.on('click', function (e) {
                    e.preventDefault();
					var conf=confirm("Are you sure want to delete this item?")
					if(conf){
						jQuery.ajax({
							url: jQuery(this).attr('data-url'),
							type: 'GET',
							data: 'id=' + jQuery(this).attr('data-id')
						}).done(function (html) {
							jQuery('#adminajaxresponse').html(html);
							userList();
							
						});
					}
					setTimeout(function (){
						jQuery(".ajaxResponse").html('');
					},3000);
			    });

            });
        };


    </script>
    
    <!-- modal -->
<div class="modal fade in" id="registerUser" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Add User</h3>
        <div id="updateajaxresponse"></div>
      </div>
			<div class="modal-body">
				<div class="ajaxResponse" id="ajaxresponseUser">
                </div>
            <div class="row" style="padding: 0px 5px;">
                <div class="col-md-12">
                    <div class="thumbnail  familycol">
                        <form id="frm_create_member" action="<?php echo base_url()?>admin/memberCreate" method="post" class="form">   <legend>User Information</legend>
                            <div class="row">
                            
                                <div class="col-xs-6 col-md-6">
                                    <label class="required">First name</label>
                                    <input type="text" name="firstname" value="" class="form-control input-sm" placeholder="First Name"  />
                                </div>
                                
                                <div class="col-xs-6 col-md-6">
                                    <label >Last name</label>
                                    <input type="text" name="lastname" value="" class="form-control input-sm" placeholder="Last Name"  />
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <label class="required">Email</label>
                                    <input type="text" name="email" value="" class="form-control input-sm" placeholder="Email"  />
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-md-6">
                                <label class="required">Password</label>
                                <input type="password" name="password" class="form-control">
								</div>
                               <div class="col-xs-6 col-md-6">
                                <label class="required">Confirm Password</label>
                                <input type="password" name="cpassword" class="form-control">
                                </div>
                            </div>
                            <label>Gender : </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" value="M" id=male />                        
                                Male
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" value="F" id=female />                        
                                Female
                            </label>
                            <br>
                            <label>Address</label>
                            <textarea class="form-control input-sm" name="address" rows="3" placeholder="Address"></textarea>
                            <label >Area/Town/City</label>
                            <input type="text" name="area" value="" class="form-control input-sm"/>
                            <label class="required">Telephone</label>
                            <input type="text" name="telephone" value="" class="form-control input-sm"/>
                            <div style="display:none">
                            <label>Telephone 2</label>
                            <input type="text" name="telephone2" value="" class="form-control input-sm"/>
                            </div>
                            <br/>
                        
                    </div>
                
                           
                            <div class="row"><div class="col-md-12" id="ajaxnotes"></div></div>
                            <input type="hidden" name="desc" id="desc" />
                           
                          
                             
                           
                            <button class="btn btn-lg btn-primary btn-block signup-btn" type="submit">
                                Create New user account</button>
                         </form> 

				</div>
            </div>
			</div>
		</div>
	</div>
</div>
<!-- .modal -->
    <!-- edit  modal -->
<div class="modal fade in" id="updateUser" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
        	<div class="modal-header">
         		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        	<div class="ajaxResponse" id="ajaxupdateUser">
                </div>
			<div class="modal-body">
				
            
			</div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitEditModal">Save changes</button>
           </div>
		</div>
	</div>
</div>

</body>
</html>

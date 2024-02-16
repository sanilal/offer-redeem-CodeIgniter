<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Offerredeem - Welcome to user page</title>
<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>
<?php $this->load->view('public/includes/head'); ?>

</head>
<body class="page page-id-558 page-template page-template-page-tpl_my_profile page-template-page-tpl_my_profile-php logged-in admin-bar customize-support">
<?php $this->load->view('public/includes/header'); ?>

 <section class="page-title">
        <div class="container">
            <div class="clearfix">
                <div class="pull-left">
                    <h1> <?php $username=$this->session->userdata('user_name'); echo $username; ?>
                   </h1>
                </div>
                <div class="pull-right">
                    <ul class="breadcrumb">
                    <li><a href="<?php echo base_url()?>user">Home</a></li>
                    <li>Profile</li>
                    </ul>			
               </div>
            </div>
        </div>
    </section>
    <div class="ajax-response ad-manage"> 
    <?php
            $error  = $this->session->flashdata('error');
            if(isset($error)){
                echo $error;
            }
			$success=$this->session->flashdata('success');
			if($success!=""){
				echo $success;
			}
			?>
            </div>
        <section>
        <div class="container">
            <div class="row">
    
                <div class="col-md-4">
    			<?php $this->load->view('public/sidebar'); ?>
    
                </div>
    
                <div class="col-md-8"> 
                    <div class="white-block">
        <div class="white-block-content">
            <div class="clearfix">
                <div class="pull-left">
                    <h4><i class="fa fa-pencil"></i>Dashboard</h4>
                </div>
                
            </div>
        </div>
    </div>
    <?php $row=$data->result(); $row=$row[0]; ?>
    <div class="payment-return-info">
        </div>

          <ul class="nav nav-tabs profile-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">
                            Basic        </a>
                    </li>
                    <li role="presentation">
                        <a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">
                            Contact        </a>
                    </li>
                   <?php if($row->fb_id==""){ ?>
                    <li role="presentation">
                        <a href="#password" aria-controls="password" role="tab" data-toggle="tab">
                            Password        </a>
                    </li> 
                    <?php } ?>   
                </ul>
				
				<!-- Tab panes -->
                 <form method="post" class="profile-form" action="#">
                    <div class="white-block">
                        <div class="white-block-content">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="basic">
                
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="first_name">First Name</label>
                                            <input type="text" name="firstname" id="first_name"  class="form-control" value="<?php echo $row->fname; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" name="lastname" id="last_name"  class="form-control" value="<?php echo $row->lname; ?>">
                                        </div>
                                    </div>
                
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="email">Your Email</label>
                                            <input type="text" name="email" id="email"  class="form-control" value="<?php echo $row->user_email ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label >Gender</label> <br/>
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" value="M" id=male <?php if($row->gender=="M"){ echo 'checked="checked"';} ?> />                                                Male
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" value="F" id=female <?php if($row->gender=="F"){ echo 'checked="checked"';} ?> />                                                Female
                                            </label>
                                        </div>
                                    </div>
                
                                    <a href="javascript:;" class="submit-form">
                                        SAVE CHANGES                    </a>
                
                                </div>
                                <div role="tabpanel" class="tab-pane" id="contact">
                
                                    <div class="row">
                                    	<div class="col-md-6">
                                            <label>Address</label>
                                            <textarea class="form-control input-sm" name="address" rows="3" placeholder="Address"><?php echo $row->area; ?></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label >Area/Town/City</label>
                                            <input type="text" name="area" value="<?php echo $row->area; ?>" class="form-control input-sm"/>
                           				</div>
                                        <div class="col-md-6">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="text" name="telephone" id="phone_number" class="form-control" value="<?php echo $row->telephone; ?>" />
                                        </div>
                                    </div>
                
                                    <a href="javascript:;" class="submit-form">
                                        SAVE CHANGES                    
                                    </a>        
                                </div>
                             <?php if($row->fb_id==""){ ?>
                                <div role="tabpanel" class="tab-pane" id="password">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="new_password">New Password</label>
                                            <input type="password" name="new_password" id="new_password" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="new_password_repeat">New Password Repeat</label>
                                            <input type="password" name="new_password_repeat" id="new_password_repeat" class="form-control">
                                        </div>                
                                    </div>
                
                                    <a href="javascript:;" class="submit-form">
                                        SAVE CHANGES                    </a>   
                
                                </div>  
                              <?php } ?>      
                            </div>
                
                            <input type="hidden" name="fb_id" value="<?php echo $row->fb_id; ?>">
                        </div>
                    </div>
                </form> 
        
      </div>
    
            </div>
        </div>
    </section>
		

<?php $this->load->view('public/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>

</body>
</html>
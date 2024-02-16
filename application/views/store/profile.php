<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Offerredeem - Store profile page</title>
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
                    <h1> <?php $store_name=$this->session->userdata('storename'); echo $store_name; ?>
                   </h1>
                </div>
                <div class="pull-right">
                    <ul class="breadcrumb">
                    <li><a href="<?php echo base_url()?>store/index">Home</a></li>
                    <li>Profile</li>
                    </ul>			
               </div>
            </div>
        </div>
    </section>
        <section>
        <div class="container">
            <div class="row">
    
                <div class="col-md-4">
    			<?php $this->load->view('store/sidebar'); ?>
    
                </div>
    
         <div class="col-md-8"> 
                
                <div class="white-block">
                    <div class="white-block-content">
                        <h4><i class="fa fa-pencil"></i> My Profile</h4>
                    </div>
                </div>



                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">
                            Basic        </a>
                    </li>
                    <li role="presentation">
                        <a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">
                            Contact        </a>
                    </li>
                    <li role="presentation">
                        <a href="#about" aria-controls="about" role="tab" data-toggle="tab">
                            About        </a>
                    </li>
                    <li role="presentation">
                        <a href="#social" aria-controls="social" role="tab" data-toggle="tab">
                            Social        </a>
                    </li>
                    <li role="presentation">
                        <a href="#password" aria-controls="password" role="tab" data-toggle="tab">
                            Password        </a>
                    </li>    
                </ul>
				<?php $row=$data->result(); $row=$row[0]; ?>
				<!-- Tab panes -->
                <form method="post" class="profile-form" action="#basic">
                    <div class="white-block">
                        <div class="white-block-content">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="basic">
                
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="first_name">Store Name</label>
                                            <input type="text" name="store_name" id="first_name"  class="form-control" value="<?php echo $row->store_name ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="last_name">Contact Person</label>
                                            <input type="text" name="contact_person" id="last_name"  class="form-control" value="<?php echo $row->contact_person; ?>">
                                        </div>
                                    </div>
                
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="city">Your City</label>
                                            <input type="text" name="city" id="city" class="form-control" value="<?php echo $row->store_city ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email">Your Email</label>
                                            <input type="text" name="email" id="email"  class="form-control" value="<?php echo $row->store_email ?>">
                                        </div>
                                    </div>
                
                                    <a href="javascript:;" class="submit-form">
                                        SAVE CHANGES                    </a>
                
                                </div>
                                <div role="tabpanel" class="tab-pane" id="contact">
                
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control" value="<?php echo $row->phone1 ?>" />
                                        </div>
                                    </div>
                
                                    <a href="javascript:;" class="submit-form">
                                        SAVE CHANGES                    
                                    </a>        
                                </div>
                                <div role="tabpanel" class="tab-pane" id="about">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Cover Image</label>
                                            <div class="image-wrap">
                                                                            </div>
                                            <a href="javascript:;" class="btn set-image">CHANGE COVER</a>
                                            <input type="hidden" name="cover_image" id="cover_image" value="" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Avatar</label>
                                            <div class="image-wrap">
                                                                            </div>
                                            <a href="javascript:;" class="btn set-image">CHANGE AVATAR</a>
                                            <input type="hidden" name="avatar" id="avatar" value="" class="form-control">
                                        </div>                
                                    </div>
                
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                
                                    <a href="javascript:;" class="submit-form">
                                        SAVE CHANGES                    </a>
                                    
                                </div>
                                <div role="tabpanel" class="tab-pane" id="social">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="twitter">Twitter</label>
                                            <input type="text" name="twitter" id="twitter" value="" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="linkedin">Linkedin</label>
                                            <input type="text" name="linkedin" id="linkedin" value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="instagram">Instagram</label>
                                            <input type="text" name="instagram" id="instagram" value="" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="facebook">Facebook</label>
                                            <input type="text" name="facebook" id="facebook" value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="google">Google+</label>
                                            <input type="text" name="google" id="google" value="" class="form-control">
                                        </div>
                                    </div>            
                                    <a href="javascript:;" class="submit-form">
                                        SAVE CHANGES                    
                                    </a>
                                </div>
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
                            </div>
                
                            <input type="hidden" name="update_profile" value="1">
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
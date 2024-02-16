<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Offerredeem - Add Order Point</title>
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
                    <li>Add Points</li>
                    </ul>			
               </div>
            </div>
        </div>
    </section>
    
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
                                    <h4><i class="fa fa-pencil"></i>Add Point</h4>
                                </div>
                                
                            </div>
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
                        </div>
                    </div>
    
    <div class="payment-return-info">
        </div>

            
        <div class="white-block">
        	<div class="white-block-content">
				<form method="post" class="profile-form" action="<?php echo base_url()?>public_home/submit_point" enctype="multipart/form-data">
                 <div class="row">
                      <div class="col-md-12">
                          <label for="">Select Store</label>
                          <select name="store" class="form-control require" id="store">
                            <option value="">- Select -</option>
                            <?php foreach($stores->result() as $store){ ?>
                            <option value="<?php echo $store->store_id; ?>"><?php echo $store->store_name; ?></option>
                            <?php } ?>
                                            
                       </select>
                          <br/>
                      </div>
                      <div class="col-md-12">
                          <label for="">Total Amount</label>
                          <input type="text" name="amount" id=""  class="form-control" >
                          <br/>
                      </div>
                      <div class="col-md-12">
                          <label for="">Bill Photo</label>
                          <div>
                           <a href="javascript:;" class="btn set-image" onClick="jQuery(this).next().click();">Add Bill</a>
                            <input type="file" name="bill_image" id="bill_image"  class="form-control" style="display:none" />
                            </div>
                            <br/>
                      </div>
                      <div class="col-md-12">
                          <label for="">Store Confirmation</label>
                          <div class="checkbox" style="margin-left:20px;">
                            <input type="checkbox" name="store_conf" id="store_conf" value="1">
                            <label for="store_conf">Store Confirmed</label>
                         </div>
                      </div>
                      <div class="col-md-12">
                      <br/>
                      	<input type="submit" name="Addpoint" value="Add Point" class="btn" />
                      </div>

                  </div>
                </form>
           </div>
        </div>
      </div>
    
            </div>
        </div>
    </section>
		

<?php $this->load->view('public/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>

</body>
</html>
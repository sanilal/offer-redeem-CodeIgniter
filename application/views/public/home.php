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
                    <li></li>
                    </ul>			
               </div>
            </div>
        </div>
    </section>
    <div class="ajax-response ad-manage" style="text-align:center"> 
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
    
    <div class="payment-return-info">
        
     </div>

            
        <div class="text-center white-block">
        	<div class="white-block-content">
        			<div class="redeemPoints">
             		<h4>OfferRedeem Points</h4>
                     <div class="pointBox redeem pull-left">
                   		<p class="lead">Offer Points</p>
                        <?php 
						$points_res=0; $redeem_res=0;
						foreach($points->result() as $point){ 
							$points_res=$points_res+$point->order_points;
						}
						foreach($redeem->result() as $red){ 
							$redeem_res=$redeem_res+$red->points;
						}
						$points_res=$points_res-$redeem_res;
						?>
                        	<h3><?php echo $points_res; ?></h3>
                       
                   </div>
                    <div class="pointBox pull-right">
                   		<p class="lead">Redeemed Points</p>
                        <h3><?php echo $redeem_res; ?></h3>
                   </div> 
                   
                   
                  
                </div>
                <br/>
                <div>
                	<div class="pointBox redeem pull-left">
                   		<p class="lead">Point Value</p>
                        <h3>AED <?php echo $points_res*(10/100);  ?></h3>
                   </div>
                   <div class="pointBox pull-right">
                   	 <a href="<?php echo base_url()?>user/redeem-point"><div class="redeemNow">Redeem Now</div></a>
                   </div>
                </div>
                <p style="clear:both">&nbsp;</p> 
                         
                
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
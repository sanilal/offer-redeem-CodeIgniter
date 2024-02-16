<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Offerredeem - Redeem Point</title>
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
.form-inline{ display:inline-block;}
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
                    <li>Redeem Points</li>
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
                                    <h4><i class="fa fa-pencil"></i>Redeem Point</h4>
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
				<form method="post" class="profile-form" action="<?php echo base_url()?>public_home/redeem_point" >
                	<div class="redeemcontainer row">
                	<div class="col-md-4"> 
                    	<div class="pointBox redeem " style="width:100%">
                            <p class="lead">Total Points</p>
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
                        <div class="pointBox redeem " style="width:100%">
                            <p class="lead">Point Value</p>
                            <h3>AED <?php echo $points_res*(10/100);  ?></h3>
                       </div>
                    </div>
                    <div class="col-md-8">
                    <form action="#" method="post">
                    	<div class="form-inline">
                            <label for="store">Select Store</label><br>
                            <select name="store">
                                <option value="">- Select -</option>
								<?php foreach($stores->result() as $store){
									if($store->redeem_partner=="1"){
									 ?>
                                <option value="<?php echo $store->store_id; ?>"><?php echo $store->store_name; ?></option>
                                <?php } } ?>
                                </select>
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-inline">
                        	<label for="points">Points</label><br>
                            <input type="number" min="1" max="<?php echo $points_res; ?>" name="points" id="points"  />
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-inline">
                        <br/>
                        <input type="submit" value="Redeem Now" class="redeemNow" />
                        </div>
                    </form>
                    </div>
                </div>
                </form>
                <p> &nbsp;</p>
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
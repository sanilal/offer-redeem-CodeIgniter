<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Offerredeem - Point History</title>
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
<link rel="stylesheet" id="woocommerce-layout-css"  href="<?php echo base_url() ?>asset/css/woocommerce-layout.css?ver=2.6.9" type="text/css" media="all" />
<link rel="stylesheet" id="woocommerce-general-css"  href="<?php echo base_url() ?>asset/css/woocommerce.css?ver=2.6.9" type="text/css" media="all" />
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
                    <li>History</li>
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
                                    <h4><i class="fa fa-pencil"></i>Point History</h4>
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
        	<div class="white-block-content woocommerce">
			
                    
            <div class="woocommerce-MyAccount-content">
                
            
                <table class="woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table" cellpadding="0" cellspacing="0" border="0" width="100%">
                    <thead>
                        <tr>
                                                <th class="order-date"><span class="nobr">Date</span></th>
                                                <th class="order-status"><span class="nobr">Store</span></th>
                                                <th class="order-total"><span class="nobr">Total</span></th>
                                                <th class="order-actions"><span class="nobr">&nbsp;</span></th>
                                        </tr>
                    </thead>
            
                    <tbody>
                    <?php 
                            $i=0; $j=0;
							$store="";
							
                            foreach($points->result() as $point){                            
							?>
                        <tr class="order">
                              <td class="order-date" data-title="Date">
                                  <?php echo $point->created; ?>
                               </td>
                              <td class="order-status" data-title="Status">
                              <?php
                              		foreach($stores->result() as $store_res){
										if($store_res->store_id==$point->order_store){
											$store=$store_res->store_name; break;
										}
								}
								?>
								
                                    <?php echo $store; ?>
                               </td>
                              <td class="order-total" data-title="Total">
                                        AED <?php echo $point->order_amount; ?> (<?php echo $point->order_points; ?> Points)
                               </td>
                              <td class="order-actions" data-title="&nbsp;">
                                    <a href="#" class="button view">View Bill</a>													
                               </td>
                             </tr>
                         <?php } ?>
                </tbody>
                </table>
            
                
                
            
            </div>
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
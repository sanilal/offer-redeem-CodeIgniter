<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Offerredeem - Store Points</title>
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
                    <li>Points</li>
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
            <div class="clearfix">
                <div class="pull-left">
                    <h4><i class="fa fa-pencil"></i> Store Points</h4>
                </div>
               
            </div>
            <?php 
			$points_res=0; $amount_res=0;
			foreach($points->result() as $point){
				if($point->status==1){
					$points_res=$points_res+$point->points;
					$amount_res=$amount_res+$point->amount;
				}
			}
			?>
            <div class="pointBox redeem pull-left " >
                <p class="lead">Total Points</p>
                <h3><?php echo $points_res; ?></h3>
            </div>
            <div class="pointBox redeem pull-left " >
                <p class="lead">Amount Paid</p>
                <h3>AED <?php echo $amount_res; ?></h3>
           </div>
           <div style="clear:both">&nbsp;</div>
        </div>
    </div>
    
    <div class="payment-return-info">
        </div>

            
         		<ul class="nav nav-tabs tab-disable" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">
                            Add Points        </a>
                    </li>
                    <li role="presentation">
                        <a href="#confirm" aria-controls="confirm" role="tab" data-toggle="" class="confirm_tab">
                            Confirm       </a>
                    </li>
                     
                </ul>
                 <form method="post" class="profile-form" action="<?php echo base_url()?>store/add_point">
                    <div class="white-block">
                        <div class="white-block-content">
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
                            
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="basic">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="points">Add Points</label>
                                            <input type="text" name="points" id="points"  class="form-control require" />
                                        </div>
                                        
                                    </div>
                					
                                      <div class="next-prev-tab text-right">
                                       
                                        <a href="javascript:;" class="btn next-tab">
                                            CLICK TO SUBMIT &gt;&gt;      </a>
                                        <p class="next-prev-error hidden">
                                            You have to add points 
                                         </p>
                                    </div>
                                </div>
                                
                                <div role="tabpanel" class="tab-pane" id="confirm">
                                    <div class="alert alert-info">
                                        <p>You have to pay 10% AED of the selected points.</p>
                                        <hr />
                                        <p class="clearfix">
                                            <span class="pull-left">For 10 points:</span>
                                            <span class="pull-right">AED 1</span>
                                        </p>
                                        <p class="clearfix featured-info ">
                                            <span class="pull-left ">Selected Points:</span>
                                            <span class="pull-right points_text"></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="pull-left">Total:</span>
                                            <span class="pull-right total-aed" ></span>
                                        </p>                    	
                                    </div>
            
                                    <div class="checkbox">
                                        <input type="checkbox" name="confirm" id="ad_featured" value="1" class="require">
                                        <label for="ad_featured">Confirm</label>
                                     </div>
                                     	
                                         
                                        
                                <div class="next-prev-tab text-right">
                                    <a href="javascript:;" class="btn prev-tab disabled">
                                       &lt;&lt; PREVIOUS        </a>
                                       <a href="javascript:;" class="btn next-tab next_submit">SUBMIT
                                         </a>
                                        <button type="submit" class="btn hidden ">
                                            SUBMIT                            
                                        </button>
                                   
                                    <p class="next-prev-error hidden">
                                        You have to confirm before submit       </p>
                                </div>
                                </div>
                                
                             </div>
                          </div>
                       </div>
                       </form>
      </div>
    
            </div>
        </div>
    </section>
		

<?php $this->load->view('public/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>
<script type="text/javascript">
jQuery(function(){
	jQuery(".next-tab").click(function(){
		update_price();
	})
	jQuery(".confirm_tab").click(function(){
		update_price();
	})
	jQuery(".next_submit").click(function(){
		if(jQuery("#ad_featured").prop("checked") == true){
			jQuery(this).next().click();
		}
	})
})
function update_price(){
	var points=jQuery("#points").val()
	jQuery(".points_text").html(points);
	jQuery(".total-aed").html("AED "+points*(10/100));
	
}
</script>

</body>
</html>
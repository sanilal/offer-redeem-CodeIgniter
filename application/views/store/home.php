<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Offerredeem - Welcome to Store page</title>
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
                    <li>Offers</li>
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
                    <h4><i class="fa fa-pencil"></i> Store Offers</h4>
                </div>
               
            </div>
        </div>
    </div>
    
    <div class="payment-return-info">
        </div>
    <?php foreach($offers->result() as $offer_row){ ?>
            <div class="white-block ad-box ad-box-alt ">
                <div class="media">
                    <a class="pull-left" href="<?php echo base_url() ?>offerDetails/<?php echo $offer_row->offer_id; ?>" >
                        <img width="150" height="150" src="<?php echo base_url()?>image_upload/<?php echo $offer_row->main_img; ?>" class="img-responsive wp-post-image" alt="c700x420[1]" sizes="(max-width: 150px) 100vw, 150px" />					
                       <?php /*?> <div class="ad-views">
                            <i class="fa fa-eye"></i>
                            23				
                        </div><?php */?>
                    </a>
                    <div class="media-body">
                        <a href="<?php echo base_url() ?>offerDetails/<?php echo $offer_row->offer_id; ?>" >
                            <h5><?php echo $offer_row->title; ?></h5>
                        </a>
    					 
                        <p>
                        	<?php echo implode(' ', array_slice(str_word_count(strip_tags($offer_row->offer_desc), 2), 0, 20)); ?>...
                             <?php if($offer_row->offer_points!=""){ ?>
                             <br/>
                                 <span class="offer-points">
                                      Earn <?php echo $offer_row->offer_points;  ?> Points
                                  </span>
                              <?php } ?>
    					</p>
                        <p><?php if($offer_row->price!="" && $offer_row->off_price!="") {?>
                        Upto <?php echo round((($offer_row->price-$offer_row->off_price)/$offer_row->price)*100); ?>% OFF<br />
                        <?php } ?>
                        
                        </p>
                        
                        <a href="<?php echo base_url() ?>offer/edit/<?php echo $offer_row->offer_id; ?>">
                            Edit <i class="fa fa-long-arrow-right"></i>
                        </a>
    					<?php 
							$phpdate = strtotime( $offer_row->created);
							?>
                        <div class="expire-badge time-badge">
                            <?php echo date( 'M d,Y', $phpdate ); ?>					
                        </div>
                        
                    </div>
                </div>
            </div>
           <?php } ?>         

            
        <div class="text-center">
         
        </div>
      </div>
    
            </div>
        </div>
    </section>
		

<?php $this->load->view('public/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>

</body>
</html>
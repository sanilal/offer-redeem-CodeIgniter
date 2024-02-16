<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Offerredeem</title>

<?php $this->load->view('public/includes/head'); ?>

</head>
<body class="home page page-id-3274 page-template page-template-page-tpl_home_page page-template-page-tpl_home_page-php">
<?php $this->load->view('public/includes/header'); ?>



<section class="header-map">
	<div id="map" class="big_map"></div>
</section>
    <div class="markers hidden">
    
    <?php foreach($offers->result() as $row){ ?>
    <?php $location=explode(",",$row->location); ?>
        <div class="marker" data-longitude="<?php echo $location[0]; ?>" data-latitude="<?php echo $location[1]; ?>" data-marker-icon="<?php echo base_url() ?>asset/images/markers/offer.png">
            <div class="info-window clearfix">
            
                <div class="info-price">
                    <div class="price-block">
                        <div class="ad-pricing">
                        <?php if($row->price!="" && $row->off_price!="") {?>
                            Upto <?php echo round((($row->price-$row->off_price)/$row->price)*100); ?>% OFF<br />
                           <?php } ?>  
                            <span class="free-price"><?php echo $row->title; ?></span>			
                        </div>
                     
                    </div>
                </div>
        
                <div class="info-image">
                    <a href="<?php echo base_url() ?>offerDetails/<?php echo $row->offer_id; ?>" >
                        <img width="80" height="80" src="<?php echo base_url()?>image_upload/<?php echo $row->main_img; ?>" class="attachment-classifieds-map size-classifieds-map wp-post-image" alt="<?php echo $row->title; ?>"  sizes="(max-width: 80px) 100vw, 80px" />
                    </a>
                </div>
                <div class="info-details">
                    <a href="<?php echo base_url() ?>offerDetails/<?php echo $row->offer_id; ?>" >
					<?php echo implode(' ', array_slice(str_word_count(strip_tags($row->offer_desc), 2), 0, 15)); ?>
                    </a>
                    
                </div>
            </div>
         </div>
      <?php } ?>

    </div>    
                                
                                
    <section class="search-bar clearfix">
        <div class="container">            
            <form method="post" class="search-form " action="<?php echo base_url()?>offer/search">
                    <input type="hidden" class="view" name="view" value="grid">
                    <input type="hidden" class="sortby" name="sortby" value="">
                    <ul class="list-unstyled list-inline">
                        <li>
                            <select class="form-control select2 category" name="category" data-placeholder="Category">
                                <option value="">&nbsp;</option>
                                <?php foreach ($categories->result() as $cat){ ?> 
                                <option value="<?php echo $cat->category_id; ?>"><?php echo $cat->cat_name; ?></option>  
                                <?php } ?>
                             </select>
                            <i class="fa fa-bars"></i>                    
                        </li>
                        <li>
                            <input type="text" class="form-control keyword" name="keyword" value="" placeholder="Keyword">
                            <a href="javascript:;" class="clear-input hidden"></a>                        <i class="fa fa-search"></i>
                        </li>
                        <li>
                            <select name="location" class="form-control select2 require" data-placeholder="Location">
                            <option value="">&nbsp;</option>
                            <?php foreach($locations->result() as $loc) { ?>
                            <option value="<?php echo $loc->location_id; ?>"><?php echo $loc->location_name; ?></option>
                            <?php } ?>
                        </select>              
                            <i class="fa fa-map-marker"></i>
                        </li>
                        
                        <li>
                            <a href="javascript:;" class="btn submit-form">
                                Search                        </a>
                        </li>
                                        </ul>
                    <div class="filters-holder hidden"></div>
                </form>
        </div>    
        
        </section>
        
		<p class="pspace">&nbsp;</p>
        <style type="text/css">
		.cat-ads{ margin-right: -15px; margin-left: -15px}
		</style>
        <section class="section FWrvVYAszZ">
			<style scoped>
                .FWrvVYAszZ{
                    padding: 60px 0px 80px 0px;
                }
            </style>
                <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 style="text-align: center;">Best Special offers available in your city</h3>
                            </div>
                        </div>
            
                       <?php
					   	foreach($categories->result() as $cat){
							if($cat->featured==1){
					   ?>
                       		<h4><?php echo $cat->cat_name; ?></h4>
                                <div class="row"  style="overflow:auto" >
                                    <?php $counter=1;  foreach ( $offers->result() as $last_row){ 
									if($counter<=4){
										if($last_row->off_category==$cat->category_id){
										 ?>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="white-block ad-box">
                                                <div class="white-block-media">
                                                   <div class="ad-badges">
													<?php if($last_row->featured==1 ){ ?>
                                                        <i class="fa fa-star featured" title="Featured Ad"> </i>
                                                    <?php } ?>
                                                    </div>			
                                                    <a href="<?php echo base_url() ?>offerDetails/<?php echo $last_row->offer_id; ?>">
                                                       <img width="263" height="172" src="<?php echo base_url()?>image_upload/<?php echo $last_row->main_img; ?>" class="attachment-classifieds-ad-box size-classifieds-ad-box wp-post-image offer-img" alt="<?php echo $last_row->title; ?>" sizes="(max-width: 263px) 100vw, 263px" />		
                                                   </a>
                                                </div>
                                                <div class="white-block-content">
                                                    <a href="<?php echo base_url() ?>offerDetails/<?php echo $last_row->offer_id; ?>">
                                                        <h5><?php echo $last_row->title; ?></h5>
                                                    </a>
                                                    
                                                    <p>
                                                    <?php if($last_row->price!="" && $last_row->off_price!="") {?>
                                                    Upto <?php echo round((($last_row->price-$last_row->off_price)/$last_row->price)*100); ?>% OFF <br />
                                                    <?php } ?>
                                                    <span class="free-price"><?php echo implode(' ', array_slice(str_word_count(strip_tags($last_row->offer_desc), 2), 0, 15)); ?></span>	
                                                   </p>
                                                   <?php if($last_row->offer_points!=""){ ?>
                                                   <div class="offer-points">
                                                		Earn <?php echo $last_row->offer_points;  ?> Points
                                                	</div>
                                                <?php } ?>
                                                   
                                                </div>
                                            </div>
                                    </div>
                                    <?php $counter++; } }  } ?>
                                   
                        
                           
                        </div>
                     <?php } } ?> 

            	<div class="text-center all-ads"><a href="offers" class="btn">SEE ALL OFFERS</a></div>
           </div>
       </section>
		<section style="background-image: url( asset/images/how_it_works_banner.jpg )" class="section-banner">
			<div class="container">
				<div class="banner-content"><h3>Placing offers has never been easier!</h3><a href="#" class="btn">HOW IT WORKS?</a></div>
			</div>
		</section>
<?php $this->load->view('public/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>

</body>
</html>
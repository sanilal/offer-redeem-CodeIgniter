<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->
<?php $offer_row=$offer->result()[0]; ?>
	<title>Offerredeem - <?php echo $offer_row->title; ?> </title>

<?php $this->load->view('public/includes/head'); ?>

</head>
<body class="single single-cad postid-3353 logged-in admin-bar no-customize-support">
<?php $this->load->view('public/includes/header'); ?>




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
                        <a href="javascript:;" class="clear-input hidden"></a>                        
                        <i class="fa fa-search"></i>
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
 
 <?php
 if($store->num_rows > 0){
	 //var_dump($store);
  	$store_row=$store->result()[0];
 }
 ?>
<section class="page-title">
	<div class="container">
		<ul class="breadcrumb">
        	<li><a href="<?php echo base_url()?>">Home</a></li>
            <li><a href="<?php echo base_url()?>offers">Offers</a></li>
            <li><?php echo $offer_row->title; ?></li>
        </ul>	
   </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            	<div class="row">
            		<div class="col-md-8 col-sm-8">
                        <div class="images-list">
                        	<?php if($offer_row->main_img!=""){ ?>
                			 <a class="single-ad-image item-0"  href="<?php echo base_url()?>image_upload/<?php echo $offer_row->main_img; ?>">
                             	<img src="<?php echo base_url()?>image_upload/<?php echo $offer_row->main_img; ?>" width="500" height="400" alt="">
                             </a>
                             <?php } ?>
                             <?php $off_img_arr=explode(",",$offer_row->off_imgs); $cnt=1; foreach($off_img_arr as $med_img){ if($med_img!=""){ ?>
                             <a class="single-ad-image hidden item-<?php echo $cnt ?>"  href="<?php echo base_url()?>image_upload/<?php echo $med_img; ?>">
                             	<img src="<?php echo base_url()?>image_upload/<?php echo $med_img; ?>" width="500" height="400" alt="">
                            </a>
                            <?php $cnt++; }}?>
                            <?php $vid_arr=explode(",",$offer_row->off_videos); foreach($vid_arr as $vid){ if($vid!=""){ 
preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $vid, $vid_id);

							?>
                            <a class="video single-ad-image hidden item-<?php echo $cnt ?>"  href="<?php echo $vid ?>">
                            	<img src="https://img.youtube.com/vi/<?php echo $vid_id[1]; ?>/maxresdefault.jpg" width="500" height="400" alt="">
                            </a>
                            <?php $cnt++; } }?>                 
                      	</div>
            		</div>
            		<div class="col-md-4 col-sm-4">
                    <div class="ad-single-thumbs">
                    <div>
                    <?php $p_count=1; if($offer_row->main_img!=""){ ?>
                        <div class="img-owl-wrap">
                        	<img width="100" height="100" src="<?php echo base_url()?>image_upload/<?php echo $offer_row->main_img; ?>" class="single-ad-thumb wp-post-image" alt="c700x420[1]" data-item="0"  sizes="(max-width: 100px) 100vw, 100px" />
                        </div>
                    <?php $p_count++; } ?>
                    <?php   $cnt=1; foreach($off_img_arr as $med_img){ if($med_img!=""){ ?>
                        <div class="img-owl-wrap">
                        	<img width="100" height="100" src="<?php echo base_url()?>image_upload/<?php echo $med_img; ?>" class="single-ad-thumb" alt="c700x420[1]" data-item="<?php echo $cnt ?>"  sizes="(max-width: 100px) 100vw, 100px" />
                        </div>
                    <?php if($p_count%3==0){ echo '</div><div>';} $cnt++; $p_count++; }  }?>
                 <?php  foreach($vid_arr as $vid){ if($vid!=""){ 
preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $vid, $vid_id);
				?>
                     <div class="img-owl-wrap">
                        <img src="https://img.youtube.com/vi/<?php echo $vid_id[1]; ?>/maxresdefault.jpg" alt="" width="100" height="100" class="classifieds-ad-owl-thumb single-ad-thumb" data-item="<?php echo $cnt ?>">
                     </div>
                 <?php if($p_count%3==0){ echo '</div><div>';} $cnt++; $p_count++;}  } ?>
                 </div>  
            	</div>          		
            </div>
            	</div>            	
                <div class="white-block">
                    <div class="white-block-content">
                    <?php if($offer_row->featured==1){ ?>
              <i class="fa fa-star featured" title="Featured Ad"></i> 
              <?php } ?>                       
                        	<div class="top-meta">
                            <?php 
							$phpdate = strtotime( $offer_row->created);
							?>
                            Posted  <?php echo date( 'M d,Y', $phpdate ); ?> by <?php if($store->num_rows > 0){ echo $store_row->store_name;} ?>                                                       
                        	</div>
							<p style="color: #e7a119;">
                            <?php if($offer_row->price!="" && $offer_row->off_price!="") {?>
                                    Upto <?php echo round((($offer_row->price-$offer_row->off_price)/$offer_row->price)*100); ?>% OFF<br />
                                    <?php } ?>
                            </p>
                        	<h3 class="blog-title"><?php echo $offer_row->title; ?></h3>
                             <?php if($offer_row->offer_points!=""){ ?>
                                 <div class="offer-points">
                                      Earn <?php echo $offer_row->offer_points;  ?> Points
                                  </div>
                                  <br/>
                              <?php } ?>
                            <div>
                            <?php echo $offer_row->offer_desc; ?>
                            </div>
                        

                                                 
                    </div>

                </div>
              

            </div>

            <div class="col-md-4">
            
            	<div class="widget white-block single-ad-author">
            		<h4><i class="fa fa-pencil"></i> Posted by</h4>
                    <div class="media">
						<a class="pull-left" href="#">
							<img src="http://2.gravatar.com/avatar/e56993fd6579ea2f8aa11763817254c5?s=90&#038;d=mm&#038;r=g" class="img-responsive" alt="author" width="90" height="90"/>
							<i class="fa fa-check verified" title="Verified User"></i>	
                        </a>
                        <div class="media-body">
                            <ul class="list-unstyled">
                                <li>
                                    <i class="fa fa-user"></i> 
                                    <a href="#">
                                        <?php if($store->num_rows > 0){ echo $store_row->store_name; } ?> <?php /*?><span title="Posted Ads">(26)</span><?php */?> 
                                    </a>
                                </li>
                            </ul>
                        </div>
					</div>
					<div class="ad-actions">
						<ul class="list-inline list-unstyled">
							<li><a href="javascript:;" class="share-ad" data-toggle="modal" data-target="#share"><i class="fa fa-share-alt"></i>Share Ad</a></li>
							<li><a href="javascript:;" class="ask-question" data-toggle="modal" data-target="#question"><i class="fa fa-question-circle"></i>Ask Question</a></li>
							<li><a href="javascript:;" class="print-ad"><i class="fa fa-print"></i>Print</a></li>
							<li><a href="javascript:;" class="report-ad" data-toggle="modal" data-target="#report"><i class="fa fa-flag"></i>Report Ad</a></li>
						</ul>
					</div>

                    <div class="price-block">
                        <div class="ad-pricing">
                          <?php /*?>  Upto 40% OFF<br /><span class="free-price">Earn 10 Offerredeem points when you purchase for AED. 100</span>			<!--<span>$500.00</span>--><?php */?>
			                        </div>
                    </div>
            	</div>

                
            		            	<div class="widget white-block">
	            		<h4><i class="fa fa-map-marker"></i> On map</h4>

	            		<div id="single-map">
	            			<div class="hidden">
                            <?php $location=explode(",",$offer_row->location); ?>
	            				<?php echo $location[1]; ?>|<?php echo $location[0]; ?>|<?php echo base_url() ?>asset/images/markers/offer.png	            			</div>
	            		</div>
	            	</div>
				
                
                                        <div class="widget white-block">
                            <h4><i class="fa fa-circle-o"></i> Similar Offers</h4>
                            
                            <ul class="list-unstyled similar-ads">
                            
                            <?php
							//var_dump($rel_offers->result()); exit;
							foreach($rel_offers->result() as $rel_offer){
								if($rel_offer->offer_id!=$offer_row->offer_id){
							?>
                                                                <li>
                                        <div class="white-block ad-box ad-box-alt">
                                            <div class="media">
                                                <a href="<?php echo base_url() ?>offerDetails/<?php echo $rel_offer->offer_id; ?>" class="pull-left">
                                                    <img width="100" src="<?php echo base_url()?>image_upload/<?php echo $rel_offer->main_img; ?>" class="attachment-classifieds-similar-ads size-classifieds-similar-ads wp-post-image" alt="<?php echo $rel_offer->title; ?>"  />                                                </a>
                                                <div class="media-body">
                                                    <a href="<?php echo base_url() ?>offerDetails/<?php echo $rel_offer->offer_id; ?>">
                                                        <h5><?php echo $rel_offer->title; ?></h5>
                                                    </a>
                                                    <p></p>
                                                    <p>
                                                    <?php if($rel_offer->price!="" && $rel_offer->off_price!="") {?>
                                                    Upto <?php echo round((($rel_offer->price-$rel_offer->off_price)/$rel_offer->price)*100); ?>% OFF<br />
                                                  <?php } ?>
                                                    <br /><span class="free-price">
                                                    <?php echo implode(' ', array_slice(str_word_count(strip_tags($rel_offer->offer_desc), 2), 0, 15)); ?>
                                                    </span>			<!--<span>$100.00</span>-->
			</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <?php } } ?>
                                    
                                    </ul>
                        </div>                        
                        
                
            </div>

        </div>
    </div>
</section>
       
       
	
<?php $this->load->view('public/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>

</body>
</html>
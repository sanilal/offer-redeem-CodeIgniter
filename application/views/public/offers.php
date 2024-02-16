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
                                
   <section class="search-page style-left">
    <div class="container-fluid">
        <div class="row">

                            <div class="col-sm-5 map-size">
                    <div class="header-map">
                        <div id="map" class="big_map"></div>
                    </div>
                </div>
            
            <div class="col-sm-7 map-left-content">
                    <div class="search-bar clearfix">
                    <form method="post" class="search-form advanced-search" action="<?php echo base_url()?>offer/search">
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
                                            <li class="advanced-filter-wrap">
                            <a href="#filters" data-toggle="modal" class="btn disabled advanced-filters" data-filtered="Change Filters" data-default="Advanced Filters">
                                Advanced Filters                            </a>
                        </li>
                                    </ul>
                <div class="filters-holder hidden"></div>
            </form>
            </div>
                <div class="white-block search-block">
                    <div class="white-block-content">
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                Showing 1 - 9 of 9 total  ads found                                </p>
                            </div>
                            <div class="col-md-3">
                                 <select class="change_sort">
                                    <option value="" selected="selected">Select</option>
                                    <option value="date-desc"  >Newest First</option>
                                    <option value="date-asc"  >Oldest First</option>
                                    <option value="free"  >Free</option>
                                    <option value="call"  >Call For Info</option>
                                    <option value="discount"  >Discounted</option>
                                </select>
                            </div>
                            <div class="col-md-3 text-right">
                                <a href="javascript:;" class="reset-search">
                                    <i class="fa fa-times-circle"></i> RESET                                </a>                        
                            </div>
                        </div>
                    </div>
                </div>

                <div class="search-organizer">
                    <div class="clearfix">
                        <div class="pull-left">
                           
                        </div>
                        <?php /*?><div class="pull-right">
                            <a href="javascript:;" class="change_view " data-value="list">
                                <i class="fa fa-th-list fa-fw"></i>
                            </a>
                            <a href="javascript:;" class="change_view active" data-value="grid">
                                <i class="fa fa-th-large fa-fw"></i>
                            </a>                    
                        </div><?php */?>
                    </div>
                </div>
                <div class="search-results">
                    <div class="row">
                    
                     <?php $counter=1;  foreach( $offers->result()  as $search_row) { ?>
                        <div class="col-sm-6 col-md-4">
                             <div class="white-block ad-box">
                                <div class="white-block-media">
                                    <div class="ad-badges">
                                    <?php if($search_row->featured==1 ){ ?>
                                        <i class="fa fa-star featured" title="Featured Ad"></i>
                                        <?php /*?><i class="fa fa-check verified" title="Verified User"></i><?php */?>
                                    <?php } ?>
                                    </div>		
                                    <a href="<?php echo base_url() ?>offerDetails/<?php echo $search_row->offer_id; ?>">
                                        <img width="525" height="343" src="<?php echo base_url()?>image_upload/<?php echo $search_row->main_img; ?>" class="attachment-classifieds-ad-box-bug size-classifieds-ad-box-bug wp-post-image offer-img" alt="c700x420[1]"  sizes="(max-width: 525px) 100vw, 525px" />		
                                     </a>
                                </div>
                                <div class="white-block-content">
                                    <a href="<?php echo base_url() ?>offerDetails/<?php echo $search_row->offer_id; ?>">
                                        <h5><?php echo $search_row->title; ?></h5>
                                    </a>
                                    <p>
                                     <?php if($search_row->price!="" && $search_row->off_price!="") {?>
                                    Upto <?php echo round((($search_row->price-$search_row->off_price)/$search_row->price)*100); ?>% OFF<br />
                                    <?php } ?>
                                        <span class="free-price">
										<?php echo implode(' ', array_slice(str_word_count(strip_tags($search_row->offer_desc), 2), 0, 15)); ?>
                                        </span>
                                    </p>
                                     <?php if($search_row->offer_points!=""){ ?>
                                         <div class="offer-points">
                                              Earn <?php echo $search_row->offer_points;  ?> Points
                                          </div>
                                      <?php } ?>
                                </div>
                            </div>                                
                        </div>
                                                                
                       <?php if($counter%3==0){ ?>
                                  </div><div class="row">
                                  <?php } $counter++;  } ?>                          
                     
                    
                    </div>
  
   </div>
</div>
        </div>
    </div>
</section>  
	
<?php //$this->load->view('public/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>

</body>
</html>
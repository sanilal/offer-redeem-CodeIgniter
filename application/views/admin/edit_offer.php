<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Admin Panel - Update Offer </title>

<?php $this->load->view('public/includes/head'); ?>
<link rel='stylesheet' id='buttons-css'  href='<?php echo base_url() ?>asset/css/buttons.min.css?ver=4.6.3' type='text/css' media='all' />
<link rel='stylesheet' id='mediaelement-css'  href='<?php echo base_url() ?>asset/js/mediaelement/mediaelementplayer.min.css?ver=2.22.0' type='text/css' media='all' />
<link rel='stylesheet' id='wp-mediaelement-css'  href='<?php echo base_url() ?>asset/js/mediaelement/wp-mediaelement.min.css?ver=4.6.3' type='text/css' media='all' />
<link rel='stylesheet' id='media-views-css'  href='<?php echo base_url() ?>asset/css/media-views.min.css?ver=4.6.3' type='text/css' media='all' />
<link rel='stylesheet' id='imgareaselect-css'  href='<?php echo base_url() ?>asset/js/imgareaselect/imgareaselect.css?ver=0.9.8' type='text/css' media='all' />

</head>
<body class="page  page-template page-template-page-tpl_my_profile page-template-page-tpl_my_profile-php logged-in admin-bar customize-support">
<?php $this->load->view('public/includes/header'); ?>
<style type="text/css">
        ul>li, a{cursor: pointer;}
		 .page-template-page-tpl_my_profile .tab-content .tab-pane label, .archive.author .tab-content .tab-pane label{ margin-bottom:0;}
</style>
<section class="page-title">
        <div class="container">
            <div class="clearfix">
                <div class="pull-left">
                    
                </div>
                <div class="pull-right">
                    <ul class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>admin">Home</a></li>
                    <li>Edit Offer</li>
                    </ul>			
               </div>
            </div>
        </div>
</section>
<style type="text/css">
        ul>li, a{cursor: pointer;}
</style>

<section>
<div class="container" >
<div class="row">
     <div class="col-md-4">
	  <?php $this->load->view('admin/includes/sidebar'); ?>

      </div>

      <div class="col-md-8"> 
         <div class="white-block">
            <div class="white-block-content">
                <h4><i class="fa fa-pencil"></i> 
                Update Offer</h4>
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

<!-- Nav tabs -->
<ul class="nav nav-tabs tab-disable" role="tablist">
    <li role="presentation" class="active">
        <a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">
            1. Basic        </a>
    </li>
    <li role="presentation">
        <a href="#location" aria-controls="location" role="tab" data-toggle="">
            2. Location        
        </a>
    </li>
    <li role="presentation">
        <a href="#category" aria-controls="category" role="tab" data-toggle="">
            3. Category & Store      
        </a>
    </li>
    <li role="presentation">
        <a href="#media" aria-controls="media" role="tab" data-toggle="">
            4. Media        
        </a>
    </li>
               
       <li role="presentation">
	        <a href="#final" aria-controls="final" role="tab" data-toggle="">
            	5. Final        	</a>
    	</li>    	
   	</ul>
    <?php $offer_result=$offer_data->result();   $offer_row=$offer_result[0]; ?>
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/updateOffer">
        <div class="white-block">
        <div class="white-block-content">
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="basic">

                  
                    <div class="row">
                        <div class="col-md-6">
                            <label for="ad_title">Offer Title <span class="required">*</span></label>
                            <p class="description">Input title of the offer which must be unique</p>
                            <input type="text" name="ad_title" id="ad_title" value="<?php echo $offer_row->title; ?>" class="form-control require">
                            
                        </div>
                        <div class="col-md-6">
                            <label>Offer thumbnail Image</label>
                            <p class="description">Select main image for the offer</p>
                            <div class="image-wrap">
                             <?php if($offer_row->main_img!=""){ ?> <img src="<?php echo base_url() ?>image_upload/<?php echo $offer_row->main_img; ?>" width="100"/> <?php } ?>
                            </div>
                            <input type="hidden" name="old_img" value="<?php echo $offer_row->main_img; ?>" />
                            <a href="javascript:;" class="btn set-image" onClick="jQuery(this).next().click();">FEATURED IMAGE</a>
                            <input type="file" name="main_image" id="featured_image"  class="form-control" style="display:none" />
                            
                        </div>
                    </div>

                    <label for="offerdesc">Offer Description <span class="required">*</span></label>
                    <p class="description">Add desciption of the offer</p>
                    <div id="wp-ad_description-wrap" class="wp-core-ui wp-editor-wrap tmce-active">

<div id="wp-ad_description-editor-container" class="wp-editor-container"><div id="qt_ad_description_toolbar" class="quicktags-toolbar"></div><textarea class="wp-editor-area" style="height: 200px" autocomplete="off" cols="40" name="ad_description" id="offerdesc"><?php echo $offer_row->offer_desc; ?></textarea></div>
</div>

 
                    <br/>
					<label for="ad_points">Offerredeem points </label>
                    <p class="description">Add points gained per purchase in % </p>
                    <input type="text" name="ad_points" id="ad_points" value="<?php echo $offer_row->offer_points; ?>" class="form-control"> 
                    <br/>
                    <label for="ad_tags">Tags / Keywords</label>
                    <p class="description">Input comma separated tags</p>
                    <input type="text" name="ad_tags" id="ad_tags" value="<?php echo $offer_row->tags; ?>" class="form-control">                            
                    

                	<div class="row">
                		<div class="col-md-6">
                            <label for="ad_price">Price</label>
                            <p class="description">Input price of the product / service you are offering (number only). Put 0 for free</p>
                            <input type="text" name="ad_price" id="ad_price" value="<?php echo $offer_row->price; ?>" class="form-control">
                            
                		</div>
                		<div class="col-md-6">
                            <label for="ad_discounted_price">Discounted Price</label>
                            <p class="description">Input discounted price of the product / service you are offering, if it exists (number only)</p>
                            <input type="text" name="ad_off_price" id="ad_discounted_price" value="<?php echo $offer_row->off_price; ?>" class="form-control">                			
                           
                		</div>
                	</div>             	
                    <div class="row">
                        <div class="col-md-6">
                            <div class="checkbox">
                                <input type="checkbox" name="ad_call_for_price" id="ad_call_for_price" value="1" <?php if($offer_row->call_price==1){echo 'checked="checked"';} ?>>
                                <label for="ad_call_for_price" style="margin-bottom:20px;">Call For Info </label>
                                <p class="description">If this is checked then Call For Info text will be displayed instead of price</p>
                            </div>
                        </div>                    
                        <div class="col-md-6">
                            <label for="ad_phone">Offer Phone</label>
                            <p class="description">Input phone number specific for this ad or leave empty to use the one from your profile</p>
                            <input type="text" name="ad_phone" id="ad_phone" value="<?php echo $offer_row->offer_phone; ?>" class="form-control">
                            
                        </div>
                    </div> 

                        <div class="next-prev-tab text-right">
        <a href="javascript:;" class="btn prev-tab disabled">
            PREVIOUS        </a>
        <a href="javascript:;" class="btn next-tab">
            NEXT        </a>
        <p class="next-prev-error hidden">
        	You have to populate all required fields. Required fields are marked with *        </p>
    </div>
    
                </div>

                <div role="tabpanel" class="tab-pane" id="location">
                <div style="margin-bottom:20px">
                <label for="set_location">Select Location</label>
                <select name="set_location" class="form-control require" id="set_location">
                	<option value="">Select</option>
                     <?php foreach($locations->result() as $loc) { ?>
                    <option value="<?php echo $loc->location_id; ?>" <?php if($offer_row->location_id==$loc->location_id){ echo 'selected';} ?>><?php echo $loc->location_name; ?></option>
                    <?php } ?>
                </select>
                </div>
                    <div class="gmap">
                        <label for="gmap_input">Location <span class="required">*</span></label>
                        <input type="text" name="gmap_input" id="gmap_input" value="" class="form-control gmap_input">
                        <div id="map"></div>
                        <p class="description">Set location of the ad</p>
                        <?php $location=explode(",",$offer_row->location); ?>
                        <input type="hidden" name="ad_gmap_longitude" value="<?php echo $location[0]; ?>" class="longitude require">
                        <input type="hidden" name="ad_gmap_latitude" value="<?php echo $location[1]; ?>" class="latitude require">
                    </div>

                        <div class="next-prev-tab text-right">
        <a href="javascript:;" class="btn prev-tab disabled">
            PREVIOUS        </a>
        <a href="javascript:;" class="btn next-tab">
            NEXT        </a>
        <p class="next-prev-error hidden">
        	You have to populate all required fields. Required fields are marked with *        </p>
    </div>
    
                </div>

                <div role="tabpanel" class="tab-pane" id="category">
                	<label for="ad_category">Offer Category<span class="required">*</span></label>
                	<select name="ad_category" class="form-control require" id="ad_category">
                		<option value="">- Select -</option>
                		<?php foreach ($categories->result() as $cat){ ?> 
                        <option value="<?php echo $cat->category_id; ?>" <?php if($offer_row->off_category==$cat->category_id){echo 'selected="selected"';} ?>><?php echo $cat->cat_name; ?></option>  
                        <?php } ?>   
                   </select>
                    <p class="description">Select category of the ad</p>
                	<div class="custom-fields-holder"></div>
                    <label for="store">Select Store<span class="required">*</span></label>
                	<select name="store" class="form-control require" id="store">
                		<option value="">- Select -</option>
                        <?php foreach($stores->result() as $store){ ?>
                        <option value="<?php echo $store->store_id; ?>" <?php if($offer_row->store_id==$store->store_id){echo 'selected="selected"';} ?> ><?php echo $store->store_name; ?></option>
						<?php } ?>
                		             	
                   </select>

                        <div class="next-prev-tab text-right">
                            <a href="javascript:;" class="btn prev-tab disabled">
                                PREVIOUS        </a>
                            <a href="javascript:;" class="btn next-tab">
                                NEXT        </a>
                            <p class="next-prev-error hidden">
                                You have to populate all required fields. Required fields are marked with *        
                            </p>
                        </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="media">
                    <label for="ad_images">
                        Ad Images                        ( Max 12 images )                         
                    </label>
                    <div class="ad-images-wrap">
                    <?php $off_img_arr=explode(",",$offer_row->off_imgs);  $cnt=0; foreach($off_img_arr as $med_img){ if($med_img!=""){ ?>
                     <img width="80" src="<?php echo base_url()?>image_upload/<?php echo $med_img; ?>" />
                     <a href="javascript:;" class="remove-img" style=" display:inline-block" onClick="jQuery(this).next().remove(); jQuery(this).prev().remove(); jQuery(this).hide();">X</a>
                     <input type="hidden" name="old_off_imgs[]" value="<?php echo $med_img; ?>" />
                     <?php $cnt++; } }?>
                     </div>
                    <a href="javascript:;" class="btn ad-images" onClick="jQuery(this).next().click();">SELECT IMAGES</a>
                    <input type="file" name="media_imgs[]" id="media_images"  class="form-control" style="display:none" multiple />
                    <p class="description">Select additional images for the ad</p>
                    <p>&nbsp;</p>
                    <label>
                        Ad Videos                        ( Max 3 videos ) 
                    </label>
                    <?php $vid_arr=explode(",",$offer_row->off_videos); foreach($vid_arr as $vid){ if($vid!=""){ ?>
                    <div class="ad-video-wrap">
                        <div class="ad-video-field-wrap" style="position:relative">
                            <input type="text" class="form-control" name="ad_videos[]" value="<?php echo $vid; ?>" style="width:90%; position:relative">
                            <a href="javascript:;" class="remove-video" style="position: absolute; right: 0;bottom: 1px; padding: 12px 22px;">X</a>
                        </div>
                        <p class="description">Youtube or vimeo links</p>
                    </div>  
					<?php } }?>
                    <div class="ad-video-wrap hidden">
                        <div class="ad-video-field-wrap">
                            <input type="text" class="form-control" name="ad_videos[]" value="">
                            <a href="javascript:;" class="remove-video">X</a>
                        </div>
                        <p class="description">Youtube or vimeo links</p>
                    </div>                    
                    <div class="ad-media-wrap">
                                            </div>
                    <a href="javascript:;" class="btn ad-videos">ADD VIDEOS</a>
                    <p class="description">Select additional videos for the ad</p>

                        <div class="next-prev-tab text-right">
        <a href="javascript:;" class="btn prev-tab disabled">
            PREVIOUS        </a>
        <a href="javascript:;" class="btn next-tab">
            NEXT        </a>
        <p class="next-prev-error hidden">
        	You have to populate all required fields. Required fields are marked with *        
        </p>
    </div>
    
                </div>

                

                                    <div role="tabpanel" class="tab-pane" id="final">

                    	<div class="alert alert-info">
                    		<p>Each ad will last for 30 days.</p>
                            <hr />
                    		<p class="clearfix">
                                <span class="pull-left">Basic ad:</span>
                                <span class="pull-right">$0.00</span>
                            </p>
                            <p class="clearfix featured-info hidden">
                                <span class="pull-left">Featured ad:</span>
                                <span class="pull-right">$5.00</span>
                            </p>
                            <p class="clearfix">
                                <span class="pull-left">Total:</span>
                                <span class="pull-right total-amount" data-basic="$0.00" data-featured="$5.00">$0.00</span>
                            </p>                    	
                        </div>

                    	<div class="checkbox">
                            <input type="checkbox" name="ad_featured" id="ad_featured" value="1" <?php if($offer_row->featured=="1"){echo 'checked="checked"';} ?>>
                            <label for="ad_featured">Make ad featured</label>
                         </div>
                         <input type="hidden" name="offer_id" value="<?php echo $offer_row->offer_id; ?>" />
                            <button type="submit" class="btn ">
                                UPDATE OFFER                            
                            </button>
    <div class="next-prev-tab text-right">
        <a href="javascript:;" class="btn prev-tab disabled">
            PREVIOUS        </a>
        <a href="javascript:;" class="btn next-tab">
            NEXT        </a>
        <p class="next-prev-error hidden">
        	You have to populate all required fields. Required fields are marked with *        </p>
    </div>
</div>
                
            </div>
            <input type="hidden" name="post_id" value="0">
            <input type="hidden" name="ad_views" value="0">
            <input type="hidden" value="update_ad" name="action">

                          

        </div>
    </div>
</form> 
        
        
        
      </div>
    </div>
</div>
</section>

<?php $this->load->view('admin/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>

<script type='text/javascript' src='<?php echo base_url() ?>asset/js/underscore.min.js?ver=1.8.3'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/shortcode.min.js?ver=4.6.3'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/backbone.min.js?ver=1.2.3'></script>

<script type='text/javascript' src='<?php echo base_url() ?>asset/js/wp-util.min.js?ver=4.6.3'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/wp-backbone.min.js?ver=4.6.3'></script>


<script type='text/javascript' src='<?php echo base_url() ?>asset/js/jquery/ui/core.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/jquery/ui/widget.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/jquery/ui/mouse.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/jquery/ui/sortable.min.js?ver=1.11.4'></script>

<script type='text/javascript' src='<?php echo base_url() ?>asset/classifieds/js/image-uploader.js?ver=4.6.3'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/classifieds/js/gmap.js?ver=4.6.3'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/classifieds/js/custom-fields.js?ver=4.6.3'></script>

<script type='text/javascript' src='<?php echo base_url() ?>asset/js/quicktags.min.js?ver=4.6.3'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/wp-a11y.min.js?ver=4.6.3'></script>

<script type='text/javascript' src='<?php echo base_url() ?>asset/js/wplink.min.js?ver=4.6.3'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/jquery/ui/position.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/jquery/ui/menu.min.js?ver=1.11.4'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var uiAutocompleteL10n = {"noResults":"No search results.","oneResult":"1 result found. Use up and down arrow keys to navigate.","manyResults":"%d results found. Use up and down arrow keys to navigate."};
/* ]]> */
</script>
<script type='text/javascript' src='<?php echo base_url() ?>asset/js/jquery/ui/autocomplete.min.js?ver=1.11.4'></script>

<script type='text/javascript' src='<?php echo base_url() ?>asset/js/thickbox/thickbox.js?ver=3.1-20121105'></script>

<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
jQuery(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('offerdesc');
  });
</script>




</body>
</html>
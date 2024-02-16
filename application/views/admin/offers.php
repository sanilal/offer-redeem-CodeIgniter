<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Admin Panel - Offers List </title>

<?php $this->load->view('public/includes/head'); ?>

</head>
<body class="page  page-template page-template-page-tpl_my_profile page-template-page-tpl_my_profile-php logged-in admin-bar customize-support">
<?php $this->load->view('public/includes/header'); ?>
<style type="text/css">
        ul>li, a{cursor: pointer;}
</style>
<section class="page-title">
        <div class="container">
            <div class="clearfix">
                <div class="pull-left">
                    
                </div>
                <div class="pull-right">
                    <ul class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>admin">Home</a></li>
                    <li>Offer List</li>
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
                                <h1 class="text-center text-uppercase">Offers</h1>
                                <a href="<?php echo base_url() ?>admin/addOffer" class=" btn" > Create Offer</a>
                                <div align="center">
                                <?php
                                $delete  = $this->session->flashdata('delete');
                                if(isset($delete)){
                                    echo $delete;
                                }
                                ?>
                                </div>
                                 <br/>
                                <div class="ajaxResponse" id="adminajaxresponse"> </div>
                                
                         </div>
                    </div>
                    <div class="white-block">
                         <div class="white-block-content">
                                Filter by Category: <select name="ad_category" class="form-control require" id="ad_category">
                		<option value="">- Select Category -</option>
                		<?php
						$cat_arr=$categories->result();
						 foreach ($cat_arr as $cat){ ?> 
                        <option value="<?php echo $cat->category_id; ?>"><?php echo $cat->cat_name; ?></option>  
                        <?php } ?>            	
                   </select>    Store: <select name="store" class="form-control require" id="store">
                		<option value="">- Select Store -</option>
                        <?php
						$store_arr=$stores->result();
						 foreach($store_arr as $store){ ?>
                        <option value="<?php echo $store->store_id; ?>"><?php echo $store->store_name; ?></option>
						<?php } ?>
                		             	
                   </select>
                                
                         </div>
                    </div>
                      <?php
					  
					   foreach($offers->result() as $offer_row){ 
					  
					  //$key=array_search($offer_row->store_id, array_column($store_arr,'store_id'));
					  //var_dump($store_arr);
					  $finder_val=$offer_row->store_id;
					  $find_cat=$offer_row->off_category;
					  //var_dump($finder_val);
					  $neededObjects = array_filter(
							$store_arr,
							function ($e)  use ($finder_val) {
								return (($e->store_id) == $finder_val);
							}
						);
					  //var_dump($neededObjects);
					  ?>
                      
            <div class="white-block ad-box ad-box-alt ">
                <div class="media">
                    <a class="pull-left" href="<?php echo base_url() ?>offerDetails/<?php echo $offer_row->offer_id; ?>" >
                        <img width="150" height="150" src="<?php echo base_url()?>image_upload/<?php echo $offer_row->main_img; ?>" class="img-responsive wp-post-image" alt="c700x420[1]" sizes="(max-width: 150px) 100vw, 150px" />					
                       <?php /*?> <div class="ad-views">
                            <i class="fa fa-eye"></i>
                            23				
                        </div><?php */?>
                    </a>
                    <div class="pull-left" style="clear:both; margin-top:15px;">
                    Store : <?php echo current($neededObjects)->store_name; ?>
                    <br/>
                    <br/>
                    
                   <?php
						$neededCats = array_filter(
							$cat_arr,
							function ($e)  use ($find_cat) {
								return (($e->category_id) == $find_cat);
							}
						);
						echo current($neededCats)->cat_name;
					?>
                    </div>
                    <div class="media-body">
                        <a href="<?php echo base_url() ?>offerDetails/<?php echo $offer_row->offer_id; ?>" >
                            <h5><?php echo $offer_row->title; ?></h5>
                        </a>
    					 
                        <p>
                            <?php echo implode(' ', array_slice(str_word_count(strip_tags($offer_row->offer_desc), 2), 0, 20)); ?>... <br/>
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
                        <a data-url="<?php echo base_url() ?>admin/deleteOffer" data-id="<?php echo $offer_row->offer_id; ?>" class=' btn-sm btn-info btndelete'>
                            Delete <i class="fa fa-trash"></i>
                        </a>
                        <a href="<?php echo base_url() ?>admin/editOffer/<?php echo $offer_row->offer_id; ?>" class=' btn-sm btn-info btnedit'>
                            <b>Edit <i class="fa fa-long-arrow-right"></i></b>
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
        </div>
    </div>
</div>
</section>

<?php $this->load->view('admin/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>
<script type="text/javascript">
jQuery(function(){
	var btndelete= jQuery('.btndelete');
	  btndelete.on('click', function (e){
			e.preventDefault();
			var conf=confirm("Are you sure want to delete this item?")
			if(conf){
				jQuery.ajax({
					url:jQuery(this).attr('data-url'),
					type:'GET',
					data:'id='+jQuery(this).attr('data-id')
				}).done(function (html){
					jQuery('#adminajaxresponse').html(html);
				   //storeList();
				   window.location.reload();
				});
			}
		});
})
</script>


</body>
</html>
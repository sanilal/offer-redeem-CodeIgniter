<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Admin Panel - Offer Categories </title>

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
                    <li>Categories</li>
                    </ul>			
               </div>
            </div>
        </div>
</section>
<style type="text/css">
        ul>li, a{cursor: pointer;}
</style>
<style type="text/css">
.btndelete, .btnedit{ display:inline-block; color:#fff !important;}
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
            <h1 class="text-center text-uppercase">Categories</h1>
            <br/>
            <a href="#registerStore" data-toggle="modal" class="login-action btn" > Create Category</a>
            <br/>
            <?php
            $delete  = $this->session->flashdata('delete');
            if(isset($delete)){
                echo $delete;
            }
            ?>
             <br/>
            <div class="ajaxResponse" id="adminajaxresponse"> </div>
            <br/>
            <div class="" ng-app="App1">

                <div class="tab-pane active" >
                    <div class="row clearfix">
                        <div class="col-md-12 column">
                               
                                <div class="ajaxResponse"><input type="hidden" name="ajaxResponse"></div>
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                <th>Category name &nbsp;</th>
                                                <th>Parent Category &nbsp;</th>
                                                <th>Action&nbsp;</th>
                                                </thead>
                                                <tbody id="ajaxstoreList">
                                                    
                                                </tbody>
                                            </table>

                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>
</section>

<?php $this->load->view('admin/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>

<!-- modal -->
<div class="modal fade in" id="registerStore" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Create Category</h3>
      </div>
			<div class="modal-body">
				<div class="ajaxResponse" id="ajaxresponseStore">
                </div>
            <div class="row" style="padding: 0px 5px;">
                <div class="col-md-12">
                    <div class="thumbnail  familycol">
                       <form class="" action="<?php echo base_url() ?>admin/addCategory" method="post" id="frm_create_store">
					<legend>Category Information</legend>
                   
                   	<div class="clearfix"></div>
					<div class="row">
                    	<div class="col-md-6">
							<label for="register-businessname">Category Name</label>
							<input type="text" name="name" id="register-businessname" class="form-control" />						
						</div>
                        <div class="col-md-6" id="ajaxParentCat">
							<label for="register-contactperson">Parent Category</label>
							<select name="cat_parent" id="register-contactperson" class="form-control" >
                            	<option value="">Select</option>
                                <option value="0">Default Parent</option>
                                <?php foreach ($categories->result() as $cat) { ?>
                                <option value="<?php echo $cat->category_id; ?>"><?php echo $cat->cat_name; ?></option>
                                <?php } ?>
                            </select>						
						</div>
                         <div class="col-md-6">
							<label for="register-contactnumber">Category Description</label>
							<textarea name="cat_desc" id="register-contactnumber" class="form-control" ></textarea>						
						</div>
                        <div class="col-md-6">
							<label for="register-loction">Featured</label>
							<select name="featured" id="register-loction" class="form-control" >
                            	<option value="0">Not Featured</option>
                            	<option value="1">Featured</option>
                                
                            </select>						
						</div>
						
					</div>

					
					<div> &nbsp;</div>
					<button type="submit" class="btn">Add Category</button>
										
					<input type="hidden" name="action" value="register">

                    					
				</form>

				</div>
            </div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- .modal -->
 <!-- Modal edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Edit Category</h3>
        <div id="updateajaxresponse" class="ajaxResponse"></div>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitEditModal">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function (){
//        call store list method for populate table
        storeList();
		//
		jQuery('#submitEditModal').on('click',function (e){
        e.preventDefault();
        jQuery.ajax({
            url:jQuery("#frm_store_update").attr('action'),
            type:jQuery("#frm_store_update").attr('method'),
            data:jQuery("#frm_store_update").serialize()
        }).done(function (html){
            jQuery('#updateajaxresponse').html(html);
            storeList();
        });
		ajaxparentCat();
		setTimeout(function (){
						jQuery(".ajaxResponse").html('');
					},3000);
    });
	//
	jQuery('#frm_create_store').submit(function (e) {
                e.preventDefault();
                var self = jQuery(this);
                var type = self.attr('method');
                var url = self.attr('action');
                var data = self.serialize();
                jQuery.ajax({
                    url: url,
                    type: type,
                    data: data
                }).done(function (html) {
                    jQuery('#ajaxresponseStore').html(html);
                    //jQuery('#frm_admin_create')[0].reset();
                    storeList();
					//window.location.reload();
                });
				ajaxparentCat();
				setTimeout(function (){
						jQuery(".ajaxResponse").html('');
					},3000);
            });

});
  var storeList = function (){
         jQuery.ajax({
               url:'<?php echo base_url()?>admin/catListData',
               type:'GET'
            }).done(function (html){
                jQuery('#ajaxstoreList').html(html);
                var btnedit= jQuery('.btnedit');
                var btndelete= jQuery('.btndelete');
                
                //    open edit  modal as external edit page code
                btnedit.on('click', function (e){
                    e.preventDefault();
                    jQuery.ajax({
                        url:jQuery(this).attr('data-url'),
                        type:'GET',
                        data:'id='+jQuery(this).attr('data-id')
                    }).done(function (html){
                        jQuery('#editModal .modal-body').html(html);
						storeList();
                    });
					
                });
                
//                delete plan entry
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
						   storeList();
						   
						});
					}
					ajaxparentCat();
					setTimeout(function (){
						jQuery(".ajaxResponse").html('');
					},3000);
                });
                
            });
    };
	function ajaxparentCat(){
		//alert("ok")
		jQuery.ajax({
			url: '<?php echo base_url()?>admin/ajaxcategoryList',
		}).done(function (html) {
			jQuery('#ajaxParentCat').html(html);
		});
	}
</script>
</body>
</html>
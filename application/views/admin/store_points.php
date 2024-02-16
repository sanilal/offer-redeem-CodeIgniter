<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Admin Panel - Store Points </title>

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
                    <li>Store Points</li>
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
            <h1 class="text-center text-uppercase">Store Points - Requests</h1>
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
                                                <th>Store name &nbsp;</th>
                                                <th>Points &nbsp;</th>
                                                <th>Amount &nbsp;</th>
                                                <th>Status &nbsp;</th>
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


<!-- .modal -->
 <!-- Modal edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Edit Location</h3>
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
        storePointList();
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
		
		setTimeout(function (){
						jQuery(".ajaxResponse").html('');
					},3000);
    });
	//

});
  var storePointList = function (){
         jQuery.ajax({
               url:'<?php echo base_url()?>admin/storePointData',
               type:'GET'
            }).done(function (html){
                jQuery('#ajaxstoreList').html(html);
                var btnedit= jQuery('.btnedit');
                var btndelete= jQuery('.btndelete');
                
                //    open edit  modal as external edit page code
                btnedit.on('click', function (e){
                    e.preventDefault();
                    var conf=confirm("Are you sure want to update this item?")
					if(conf){
						jQuery.ajax({
							url:jQuery(this).attr('data-url'),
							type:'GET',
							data:{id:jQuery(this).attr('data-id'), status:jQuery(this).attr('data-status')}
						}).done(function (html){
							jQuery('#adminajaxresponse').html(html);
						   storePointList();
						   
						});
					}
					
					setTimeout(function (){
						jQuery(".ajaxResponse").html('');
					},3000);
					
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
						   storePointList();
						   
						});
					}
					
					setTimeout(function (){
						jQuery(".ajaxResponse").html('');
					},3000);
                });
                
            });
    };
	
</script>
</body>
</html>
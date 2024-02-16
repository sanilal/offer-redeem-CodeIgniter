<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- Favicon -->

	<title>Admin Panel Dashboard </title>

<?php $this->load->view('public/includes/head'); ?>
<style type="text/css">
.btn-sm{ cursor:pointer}
</style>
</head>
<body class="page  page-template page-template-page-tpl_my_profile page-template-page-tpl_my_profile-php logged-in admin-bar customize-support">
<?php $this->load->view('public/includes/header'); ?>
<section class="page-title">
        <div class="container">
            <div class="clearfix">
                <div class="pull-left">
                    
                </div>
                <div class="pull-right">
                    <ul class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>admin">Home</a></li>
                    <li>Welcome Admin</li>
                    </ul>			
               </div>
            </div>
        </div>
    </section>
  </section>
        <section>
        <div class="container">
            <div class="row">
    
                <div class="col-md-4">
    			<?php $this->load->view('admin/includes/sidebar'); ?>
    
                </div>
    
                <div class="col-md-8"> 
                    <div class="white-block">
                        <div class="white-block-content">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4> Admin Home</h4>
                                </div>
                                <div class="pull-right">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                       <div class="white-block">
                        <div class="white-block-content">
            <h5 class="text-center text-uppercase">User Order Points - Requests</h5>
            <?php
            $delete  = $this->session->flashdata('delete');
            if(isset($delete)){
                echo $delete;
            }
            ?>
            <div class="ajaxResponse" id="adminajaxresponse"> </div>
            <br/>
            <div class="" ng-app="App1">

                <div class="tab-pane active" >
                    <div class="row clearfix">
                        <div class="col-md-12 column">
                               
                                <div class="ajaxResponse"><input type="hidden" name="ajaxResponse"></div>
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                <th>User &nbsp;</th>
                                                <th>Store &nbsp;</th>
                                                 <th>Bill &nbsp;</th>
                                                <th>Amount &nbsp;</th>
                                                <th>Status &nbsp;</th>
                                                <th>Action&nbsp;</th>
                                                </thead>
                                                <tbody id="ajaxUserPoints">
                                                    
                                                </tbody>
                                            </table>

                        </div>
                        
                    </div>
                    <p></p>
                     <h5 class="text-center text-uppercase">Store Points - Requests</h5>
                    <div class="row">
                    	<table class="table table-striped table-bordered">
                                                <thead>
                                                <th>Store name &nbsp;</th>
                                                <th>Points &nbsp;</th>
                                                <th>Amount &nbsp;</th>
                                                <th>Status &nbsp;</th>
                                                <th>Action&nbsp;</th>
                                                </thead>
                                                <tbody >
                                                    <?php
													if ($store_points->num_rows() > 0) {
            $sr = 0;
            $urldelete = base_url() . 'admin/deleteStorPoint/';
            $urledit = base_url() . 'admin/approveStorPoint/';
			
            foreach ($store_points->result() as $row) {
                $sr = $sr + 1;
				$status="New"; $status_edit=1; $approve_text="Approve";
				if($row->status==1){$status="Approved"; $status_edit=0; $approve_text="Cancel Approve";}
                echo"<tr><td>" . $row->store_name . "</td><td>" . $row->points . "</td><td>AED " . $row->amount . "</td><td>" . $status . "</td><td>
				<a data-url='$urledit' class=' btn-sm btn-info btnedit'  data-id='$row->point_id' data-status='$status_edit' title='edit'>
				<i class='glyphicon glyphicon-pencil' title='edit'></i>$approve_text</a>&nbsp;&nbsp;&nbsp;&nbsp;<a data-url='$urldelete' class=' btn-sm btn-info btndelete' data-id='$row->point_id' title='delete'><i class='glyphicon glyphicon-remove'></i>Delete</a></td>"
                . "</tr>";
            }
        } else {
            echo'<tr><td colspan = 4 class="text-info">No Request.</td></tr>';
        }
													?>
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
    </section>
 <?php $this->load->view('admin/includes/footer'); ?>
<?php $this->load->view('public/includes/footer-js'); ?>
<?php /*?><script>
    
    var ED = function (){
    jQuery.ajax({
        type:'GET',
        url:'<?php echo base_url()?>admin/alertExpire'
    }).done(function (data){
        jQuery("#exp_res").html(data);
        jQuery.each(jQuery("#exp_res tr"), function (i , val){
           var val = parseInt(jQuery("#exp_res tr td").eq(1).text());
           if(isNaN(val)){
               jQuery("#exp_res tr").addClass('bg-danger');
           }
           else if(val >=0){
               jQuery("#exp_res tr").addClass('bg-danger');
           }
           
        });
    });
    };
    
    var EM = function (){
    
    jQuery.ajax({
        type:'GET',
        url:'<?php echo base_url()?>admin/alertCompleteExpire'
    }).done(function (data){
        jQuery("#memexp_res").html(data);
//        jQuery.each(jQuery("#exp_res tr"), function (i , val){
//           var val = parseInt(jQuery("#exp_res tr td").eq(1).text());
//           if(isNaN(val)){
//               jQuery("#exp_res tr").addClass('bg-danger');
//           }
//           else if(val >=0){
//               jQuery("#exp_res tr").addClass('bg-danger');
//           }
//           
//        });
    });
        
    };
    
    var DI = function (){
        jQuery.ajax({
        type:'GET',
        url:'<?php echo base_url()?>admin/alertInstallment'
    }).done(function (data){
        jQuery("#ins_res").html(data);
        jQuery.each(jQuery("#ins_res tr"), function (i , val){
           var val = parseInt(jQuery("#ins_res tr td").eq(1).text());
           if(isNaN(val)){
               jQuery("#ins_res tr").addClass('bg-danger');
           }
           else if(val >=0 || val == -1){
               jQuery("#ins_res tr").addClass('bg-danger');
           }
        });
    });
    };
    
    
    
    $(document).ready(function (){
        ED();
        
        jQuery(".ed").on('click', function (){
           ED();
        });
        
        jQuery(".di").on('click', function (){
           DI();
        });
        
        jQuery(".em").on('click', function (){
           EM();
        });
    });
</script><?php */?>
 <!-- Modal edit -->
<div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Order Bill</h3>
        <div id="updateajaxresponse" class="ajaxResponse"></div>
      </div>
      <div class="modal-body">
      <img src="" id="bill_img" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function (){
//        call store list method for populate table
        userPointList();
		//
		jQuery('#submitEditModal').on('click',function (e){
        e.preventDefault();
        jQuery.ajax({
            url:jQuery("#frm_store_update").attr('action'),
            type:jQuery("#frm_store_update").attr('method'),
            data:jQuery("#frm_store_update").serialize()
        }).done(function (html){
            jQuery('#updateajaxresponse').html(html);
            userPointList();
        });
		
		setTimeout(function (){
						jQuery(".ajaxResponse").html('');
					},3000);
    });
	//
	

});
  var userPointList = function (){
         jQuery.ajax({
               url:'<?php echo base_url()?>admin/userPointData',
               type:'GET'
            }).done(function (html){
                jQuery('#ajaxUserPoints').html(html);
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
						   userPointList();
						   
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
						   userPointList();
						   
						});
					}
					
					setTimeout(function (){
						jQuery(".ajaxResponse").html('');
					},3000);
                });
				jQuery(".pop_bill").on("click", function() {
				  //alert(jQuery(this).attr('data-url'));
				 jQuery('#bill_img').attr('src', jQuery(this).attr('data-url')); 
			  });
                
            });
    };
	
</script>

</body>
</html>
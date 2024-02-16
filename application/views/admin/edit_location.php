<?php 
	$obj_data=$data->result();
	$row=$obj_data[0];
 ?>
<form class="" action="<?php echo base_url() ?>admin/updateLocation" method="post" id="frm_store_update">
					<legend>Location Information</legend>
                   	<div class="clearfix"></div>
					<div class="row">
                    	<div class="col-md-6">
							<label for="register-businessname">Location Name</label>
							<input type="text" name="name" id="register-businessname" class="form-control" value="<?php echo $row->location_name; ?>" />						
						</div>
                        
                         <div class="col-md-6" style="display:none">
							<label for="register-contactnumber">Location Cordinates</label>
							<input type="text" name="cord" id="register-contactnumber" class="form-control" value="<?php echo $row->location_cord; ?>" />						
						</div>						
					</div>

					
					<div> &nbsp;</div>

										
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
                    					
				</form>

<?php exit;
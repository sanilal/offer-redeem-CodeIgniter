<?php 
	$obj_data=$data->result();
	$row=$obj_data[0];
 ?>
<form class="" action="<?php echo base_url() ?>admin/updateCategory" method="post" id="frm_store_update">
					<legend>Category Information</legend>
                   
                   	<div class="clearfix"></div>
					<div class="row">
                    	<div class="col-md-6">
							<label for="register-businessname">Category Name</label>
							<input type="text" name="name" id="register-businessname" class="form-control" value="<?php echo $row->cat_name; ?>" />						
						</div>
                        <div class="col-md-6">
							<label for="register-contactperson">Parent Category</label>
							<select name="cat_parent" id="register-contactperson" class="form-control" >
                            	<option value="">Select</option>
                                <option value="0" <?php if($row->parent_cat=="0"){ echo 'selected';} ?>>Default Parent</option>
                                <?php foreach ($categories->result() as $cat) { 
								if($cat->category_id!=$row->category_id){
									$select="";
									if($row->parent_cat==$cat->category_id){ $select='selected="selected"';}
									?>
									<option value="<?php echo $cat->category_id; ?>" <?php echo $select; ?> ><?php echo $cat->cat_name; ?></option>
                                <?php } } ?>
                            </select>						
						</div>
                         <div class="col-md-6">
							<label for="register-contactnumber">Category Description</label>
							<textarea name="cat_desc" id="register-contactnumber" class="form-control" ><?php echo $row->cat_desc; ?></textarea>						
						</div>
                        <div class="col-md-6">
							<label for="register-loction">Featured</label>
							<select name="featured" id="register-loction" class="form-control" >
                            	<option value="0" <?php if($row->featured=="0"){ echo 'selected';} ?>>Not Featured</option>
                            	<option value="1" <?php if($row->featured=="0"){ echo 'selected';} ?>>Featured</option>
                                
                            </select>						
						</div>
						
					</div>

					
					<div> &nbsp;</div>
										
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
                    					
				</form>

<?php exit;
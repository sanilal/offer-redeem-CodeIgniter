<form id="frm_store_update" class="form" action="<?php echo base_url() ?>admin/storeUpdate" method="POST">
    <?php foreach ($data->result() as $row): ?>
    <div class="row">
    <div class="col-md-6">
        <label for="register-businessname">Store Name</label>
        <input type="text" name="name" id="register-businessname" class="form-control" value="<?php echo $row->store_name; ?>" />						
    </div>
    <div class="col-md-6">
        <label for="register-contactperson">Contact Person</label>
        <input type="text" name="contactperson" id="register-contactperson" class="form-control" value="<?php echo $row->contact_person; ?>" />						
    </div>
     <div class="col-md-6">
        <label for="register-contactnumber">Contact Number</label>
        <input type="text" name="phone1" id="register-contactnumber" class="form-control" value="<?php echo $row->phone1; ?>"  />						
    </div>
    <div class="col-md-6">
        <label for="register-loction">City</label>
        <input type="text" name="city" id="register-loction" class="form-control" value="<?php echo $row->store_city; ?>" />						
    </div>
    <div class="col-md-6" style="display:none">
        <label for="register-username">Co-ordinates</label>
        <input type="text" name="cord" id="register-cord" class="form-control" value="<?php echo $row->store_cord; ?>" />						
    </div>
    <div class="col-md-6">
        <label for="register-email">Email (Login id)</label>
        <input type="email" name="email" id="register-email" class="form-control"  value="<?php echo $row->store_email; ?>" />						
    </div>
     <div class="col-md-6">
          <label for="partner">Redeem Partner</label>
          <select name="partner" id="partner" class="form-control" >
              <option value="0" <?php if($row->redeem_partner==0){echo 'selected="selected"';}?>>No</option>
              <option value="1" <?php if($row->redeem_partner==1){echo 'selected="selected"';}?>>Yes</option>
              
          </select>						
      </div>
    <div class="col-md-6">
        <label class="required">Status</label>
        <select name="status" class="form-control">
            <option value="0" <?php if($row->store_status==0){echo 'selected="selected"';}?>>Unpublished</option>
            <option value="1" <?php if($row->store_status==1){echo 'selected="selected"';}?>>Published</option>
        </select>
    </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $id?>">
    <?php endforeach; ?>
</form>

<?php exit;
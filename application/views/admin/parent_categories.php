<label for="register-contactperson">Parent Category</label>
<select name="cat_parent" id="register-contactperson" class="form-control" >
    <option value="">Select</option>
    <option value="0">Default Parent</option>
    <?php foreach ($categories->result() as $cat) {  ?>
        <option value="<?php echo $cat->category_id; ?>" ><?php echo $cat->cat_name; ?></option>
    <?php  } ?>
</select>					
<?php exit;
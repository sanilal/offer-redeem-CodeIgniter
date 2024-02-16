<?php $this->load->view('admin/header'); ?>
  <?php $this->load->view('admin/sidebar'); ?>
<div class="container" >
    <div class="row">
        
        <div class="col-md-12">
            <div class="ajaxResponse"><input type="hidden" name="ajaxResponse"></div>
            <div class="row" style="padding: 0px 5px;">
                <div class="col-md-10 col-md-offset-1 familycol bg-primary">
                    <h4 class="text-center"> Member information</h4>

                    <hr/>
                    <div class="row">
                        <div class="col-md-4"><label>Member ID</label></div>
                        <div class="col-md-8"><label><?php echo 'A'. strtoupper($row->id)?></label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label>Name:</label></div>
                        <div class="col-md-8"><label><?php echo strtoupper($row->fname).' '.strtoupper($row->lname)?></label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label>Email:</label></div>
                        <div class="col-md-8"><label><?php echo strtoupper($row->user_email); ?></label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label>Gender:</label></div>
                        <div class="col-md-8"><label><?php echo strtoupper ($row->gender =='M')?'MALE':'FEMALE'?></label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label>Address:</label></div>
                        <div class="col-md-8"><label><?php echo strtoupper($row->address)?></label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label>Residential area:</label></div>
                        <div class="col-md-8"><label><?php echo strtoupper($row->area)?></label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label>Mobile:</label></div>
                        <div class="col-md-8"><label><?php echo strtoupper($row->telephone)?></label></div>
                    </div>
                    <div class="row" style="display:none">
                        <div class="col-md-4"><label>Mobile 2:</label></div>
                        <div class="col-md-8"><label><?php echo strtoupper($row->telephone2)?></label></div>
                    </div>
                   
                    
                    
                    
                </div>
              
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function (){
        $.ajax({
            url:'<?php echo base_url()?>'+'admin/viewPlan',
            type:'GET',
            data:'id='+<?php echo $row->package_type ;?>
        }).done(function (html){
            $('#gp').html(html);
            
        });
        
        $.ajax({
            url:'<?php echo base_url()?>'+'admin/viewPeriod',
            type:'GET',
            data:'id='+<?php echo $row->package_period ;?>
        }).done(function (html){
            $('#pp').html(html);
            
        });
        
    });
</script>


<?php
$this->load->view('admin/footer');

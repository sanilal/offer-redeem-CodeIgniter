<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="container" style="border-top: 1px solid #D14B54; background: #f5f5f5f5">
    <div class="row">
       
        <div class=" col-sm-12">
            <div class="ajaxResponse"><input type="hidden" name="ajaxResponse"></div>
            <div class="row" style="padding: 0px 5px;">
                <div class="col-md-12 ">
                    <h3 class="text-center">Here you can manage site settings</h3>
                    <hr>
                </div>
                
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <a href="<?php echo base_url()?>#">
                                <h2>Settings 1</h2>
                            </a>
                        </div>
                        <div class="col-md-6 text-center">
                            <a href="<?php echo base_url()?>#">
                                
                                <h2>Settings 2</h2>
                            </a>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<?php
$this->load->view('admin/footer');

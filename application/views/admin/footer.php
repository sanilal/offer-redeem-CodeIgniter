</div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
        </div>
        <strong>Copyright &copy; 2017 </strong> All rights reserved.
      </footer>
 </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url() ?>asset/bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url() ?>asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() ?>asset/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>asset/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url() ?>asset/dist/js/demo.js"></script>
    
    
    <script src="<?php echo base_url() ?>asset/ng/angular.min.js"></script>
<script src="<?php echo base_url() ?>asset/ng/ui-bootstrap-tpls.min.js"></script>
<script src="<?php echo base_url() ?>asset/ng/angular-route.min.js"></script>
<script src="<?php echo base_url() ?>asset/ng/app.js"></script>
    <script src="<?php echo base_url() ?>asset/lib/select2/select2.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/lib/alertify/alertify.min.js"/>
    <script>
        
            if(getCookie("login") == 'false'){
                window.location.href = window.location.protocol + "//" + window.location.host + "/gym/auth";
            }
        
    </script>
    </body>
</html>

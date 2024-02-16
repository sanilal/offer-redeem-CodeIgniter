<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url()?>asset/images/profile-dummy.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Admin Panel</p>
            </div>
          </div>
      
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li <?php if($active=="dash" || $active==""){echo 'class="active"';} ?>>
              <a href="<?php echo base_url()?>alert">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
             
            </li>
            
            <li class="treeview <?php if($active=="member"){echo 'active';} ?>" >
              <a href="#">
                <i class="fa fa-user"></i> <span>Users</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url()?>memberList"><i class="fa fa-circle-o"></i> List User</a></li>
                <?php $role =  $this->session->userdata('role');  if($role == 'admin'): ?>
                <li><a href="<?php echo base_url() ?>register"><i class="fa fa-circle-o"></i> Add User</a></li>
                <?php endif; ?>
                
              </ul>
            </li>
            
             <li class="treeview <?php if($active=="store"){echo 'active';} ?>" >
              <a href="#">
                <i class="fa fa-user"></i> <span>Stores</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url()?>storeList"><i class="fa fa-circle-o"></i> List Stores</a></li>
                <?php /*?><?php $role =  $this->session->userdata('role');  if($role == 'admin'): ?>
                <li><a href="<?php echo base_url() ?>register"><i class="fa fa-circle-o"></i> Add Store</a></li>
                <?php endif; ?><?php */?>
                
              </ul>
            </li>
            
            <?php $role =  $this->session->userdata('role');  if($role == 'admin'): ?>
            <li <?php if($active=="settings"){echo 'class="active"';} ?>>
              <a href="<?php echo base_url()?>schema">
                <i class="fa fa-th"></i> <span>Settings</span>
              </a>
            </li>
            <?php endif; ?>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
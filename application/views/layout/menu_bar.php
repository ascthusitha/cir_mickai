<?php
  $base_link = $this->config->item('base_url').$this->config->item('index_page');
  $permissionData = $this->session->userdata['permissionData'];
  $menu = $this->session->userdata['menu'];
  $menu_open = $this->session->userdata['menu_open'];
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-orange elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo $base_link; ?>dashboard/" class="brand-link">
    <img src="<?php echo base_url(); ?>assets/dist/img/MickaiLogo.png" alt="AdminLTE Logo" class="brand-image " style="opacity: .8">
    <span class="brand-text font-weight-light">3.0</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $this->session->userdata('user_name'); ?></a>
      </div>
    </div>
<?php if(!isset($permissionData)){
    $this->session->sess_destroy();
     redirect('/', 'location', '301');
}else{?>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <?php if (in_array(1, $permissionData)) { ?>
          <li class="nav-item">
            <a href="<?php echo $base_link; ?>dashboard/" class="nav-link <?php echo $menu[1];?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
        <?php } ?>

        <?php if (in_array(17, $permissionData)) { ?>
          <li class="nav-item">
            <a href="<?php echo $base_link; ?>calendar/" class="nav-link <?php echo $menu[17];?>">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>Calendar</p>
            </a>
          </li>
        <?php } ?>

        <?php if (in_array(8, $permissionData)) { ?>
          <li class="nav-item <?php echo $menu_open[8];?>">
            <a href="#" class="nav-link <?php echo $menu[8];?>">
              <i class="nav-icon fa fa-book"></i>
              <p>Activities <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (in_array(9, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>phone_call" class="nav-link <?php echo $menu[9];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Phone Calls</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(10, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>phone_call/add" class="nav-link <?php echo $menu[10];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Schedule Phone Calls</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(11, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>sales_call" class="nav-link <?php echo $menu[11];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Meeting</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(12, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>sales_call/add" class="nav-link <?php echo $menu[12];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Schedule Meeting</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(13, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>task_detail" class="nav-link <?php echo $menu[13];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Task</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(14, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>task_detail/add" class="nav-link <?php echo $menu[14];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Schedule Task</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(15, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>opportunity" class="nav-link <?php echo $menu[15];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Opportunity</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(16, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>opportunity/add" class="nav-link <?php echo $menu[16];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Schedule Opportunity</p>
                  </a>
                </li>
              <?php } ?>
                    <?php if (in_array(50, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>mapplication" class="nav-link <?php echo $menu[50];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Application List</p>
                  </a>
                </li>
              <?php } ?>
                        <?php if (in_array(51, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>mapplication/add" class="nav-link <?php echo $menu[51];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Application</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>

        <?php if (in_array(21, $permissionData)) { ?>
          <li class="nav-item <?php echo $menu_open[21];?>">
            <a href="#" class="nav-link <?php echo $menu[21];?>">
              <i class="nav-icon fa fa-dot-circle"></i>
              <p>Account <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (in_array(22, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>account" class="nav-link <?php echo $menu[22];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Account list</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(23, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>account/add" class="nav-link <?php echo $menu[23];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Account Add</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>

        <?php if (in_array(24, $permissionData)) { ?>
          <li class="nav-item <?php echo $menu_open[24];?>">
            <a href="#" class="nav-link <?php echo $menu[24];?>">
              <i class="nav-icon fa fa-calendar-alt"></i>
              <p>Contact <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (in_array(25, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>contact" class="nav-link <?php echo $menu[25];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Contact list</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(26, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>contact/add" class="nav-link <?php echo $menu[26];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Contact Add</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>
    
          <li class="nav-item">
            <a href="<?php echo $base_link; ?>invoice/" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>Invoice</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>My Drive</p>
            </a>
          </li>

        <li class="nav-header">Administration</li>

        <?php if (in_array(27, $permissionData)) { ?>
          <li class="nav-item <?php echo $menu_open[19];?>">
            <a href="#" class="nav-link <?php echo $menu[19];?>">
              <i class="nav-icon fa fa-plus-square"></i>
              <p>Reports <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (in_array(20, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>administration_reports/activities" class="nav-link <?php echo $menu[20];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Activity Report</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(20, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>administration_reports/activities" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Account information</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>
        <?php if (in_array(2, $permissionData)) { ?>
          <li class="nav-item <?php echo $menu_open[2];?>">
            <a href="#" class="nav-link <?php echo $menu[2];?>">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Admin <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (in_array(3, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>Financial_year/view" class="nav-link <?php echo $menu[3];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Financial year</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(4, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>user_group" class="nav-link <?php echo $menu[4];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>User Group</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(5, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>user_group_permission" class="nav-link <?php echo $menu[5];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>User Group Permission</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(6, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>user/listing" class="nav-link <?php echo $menu[6];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>User List</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(7, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="#" class="nav-link <?php echo $menu[7];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sales Target</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>

        <?php if (in_array(28, $permissionData)) { ?>
          <li class="nav-item <?php echo $menu_open[28];?>">
            <a href="#" class="nav-link <?php echo $menu[28];?>">
              <i class="nav-icon fa fa-plus-square"></i>
              <p>Manage Value <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (in_array(29, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>currency" class="nav-link <?php echo $menu[29];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Currency</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(30, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>country" class="nav-link <?php echo $menu[30];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Country</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(31, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>company/view" class="nav-link <?php echo $menu[31];?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Company Info</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>

      </ul>
    </nav>
            <?php } ?>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<?php
  $base_link = $this->config->item('base_url').$this->config->item('index_page');
  $permissionData = $this->session->userdata['permissionData'];
  $menu = $this->session->userdata['menu'];
  $menu_open = $this->session->userdata['menu_open'];
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-green elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo $base_link; ?>dashboard/" class="brand-link">
    <img src="<?php echo base_url(); ?>assets/dist/img/<?php echo $this->config->item('logo');?>" alt="<?php echo $this->config->item('logo_alt');?>" class="brand-image " style="<?php echo $this->config->item('logo_style');?>">
    <span class="brand-text font-weight-light"><?php echo $this->config->item('logo_brand_text');?></span>
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
              <i class="nav-icon fas fa-handshake"></i>
              <p>Activities <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (in_array(10, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>phone_call/add" class="nav-link <?php echo $menu[10];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-calendar-plus nav-icon"></i>
                    <p>Schedule Doctor Appoinment</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(9, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>phone_call" class="nav-link <?php echo $menu[9];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-list nav-icon"></i>
                    <p>Doctor Appoinments</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(12, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>sales_call/add" class="nav-link <?php echo $menu[12];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-calendar-plus nav-icon"></i>
                    <p>Schedule External Appointment</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(11, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>sales_call" class="nav-link <?php echo $menu[11];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-list nav-icon"></i>
                    <p>External Appointments</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(14, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>task_detail/add" class="nav-link <?php echo $menu[14];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-calendar-plus nav-icon"></i>
                    <p>Schedule Alert/Reminder</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(13, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>task_detail" class="nav-link <?php echo $menu[13];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-list nav-icon"></i>
                    <p>Alert/Reminders</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(16, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>opportunity/add" class="nav-link <?php echo $menu[16];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-calendar-plus nav-icon"></i>
                    <p>Schedule Opportunity</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(15, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>opportunity" class="nav-link <?php echo $menu[15];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-list nav-icon"></i>
                    <p>Opportunities</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(36, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>time_sheet/add" class="nav-link <?php echo $menu[36];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-calendar-plus nav-icon"></i>
                    <p>Add Time Sheet</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(37, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>time_sheet" class="nav-link <?php echo $menu[37];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-list nav-icon"></i>
                    <p>Time Sheets</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>

        <?php if (in_array(21, $permissionData)) { ?>
          <li class="nav-item <?php echo $menu_open[21];?>">
            <a href="#" class="nav-link <?php echo $menu[21];?>">
              <i class="nav-icon fas fa-book"></i>
              <p>Physician <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (in_array(23, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>account/add" class="nav-link <?php echo $menu[23];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-plus-circle nav-icon"></i>
                    <p>Add Physician</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(22, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>account" class="nav-link <?php echo $menu[22];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-list nav-icon"></i>
                    <p>Physician list</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>

        <?php if (in_array(24, $permissionData)) { ?>
          <li class="nav-item <?php echo $menu_open[24];?>">
            <a href="#" class="nav-link <?php echo $menu[24];?>">
              <i class="nav-icon fas fa-address-book"></i>
              <p>Patients <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (in_array(26, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>contact/add" class="nav-link <?php echo $menu[26];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-plus-circle nav-icon"></i>
                    <p>Add Patients</p>
                  </a>
                </li>
                 <li class="nav-item">
                  <a href="<?php echo $base_link; ?>attendance/add" class="nav-link <?php echo $menu[26];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-plus-circle nav-icon"></i>
                    <p>Add Patients</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(25, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>contact" class="nav-link <?php echo $menu[25];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-list nav-icon"></i>
                    <p>Patients list</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>
    
        <?php if (in_array(39, $permissionData)) { ?>
          <li class="nav-item">
            <a href="<?php echo $base_link; ?>invoice/" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>Invoice</p>
            </a>
          </li>
        <?php } ?>
        <?php if (in_array(38, $permissionData)) { ?>
          <li class="nav-header">My Drive</li>
          <li class="nav-item">
            <a href="<?php echo $base_link; ?>my_drive" class="nav-link <?php echo $menu[38];?>">
              <i class="nav-icon fas fa-hdd"></i>
              <p>Home</p>
            </a>
          </li>
        <?php } ?>

        <li class="nav-header">Reports</li>

        <?php if (in_array(27, $permissionData)) { ?>
          <li class="nav-item <?php echo $menu_open[19];?>">
            <a href="#" class="nav-link <?php echo $menu[19];?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>General Reports <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (in_array(20, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>administration_reports/activities" class="nav-link <?php echo $menu[20];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-poll-h nav-icon"></i>
                    <p>Activity Report</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(20, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>administration_reports/activities" class="nav-link">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-poll-h nav-icon"></i>
                    <p>Physician information</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>

        <li class="nav-header">Administration</li>
        <?php if (in_array(2, $permissionData)) { ?>
          <li class="nav-item <?php echo $menu_open[2];?>">
            <a href="#" class="nav-link <?php echo $menu[2];?>">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>Users <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (in_array(4, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>user_group" class="nav-link <?php echo $menu[4];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fas fa-user-tag"></i>&nbsp;&nbsp;
                    <p>User Groups</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(5, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>user_group_permission" class="nav-link <?php echo $menu[5];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-user-lock nav-icon"></i>
                    <p>User Group Permission</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(6, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>user/listing" class="nav-link <?php echo $menu[6];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-users nav-icon"></i>
                    <p>User List</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>
        <?php if (in_array(32, $permissionData)) { ?>
          <li class="nav-item <?php echo $menu_open[32];?>">
            <a href="#" class="nav-link <?php echo $menu[32];?>">
              <i class="nav-icon fas fa-funnel-dollar"></i>
              <p>Set Targets <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (in_array(3, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>Financial_year/view" class="nav-link <?php echo $menu[3];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                    <p>Financial year</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(7, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="#" class="nav-link <?php echo $menu[7];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
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
              <i class="nav-icon fas fa-cogs"></i>
              <p>Manage Values <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (in_array(29, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>currency" class="nav-link <?php echo $menu[29];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                    <p>Currency</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(30, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>country" class="nav-link <?php echo $menu[30];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                    <p>Country</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(33, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>car" class="nav-link <?php echo $menu[33];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                    <p>Car</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(34, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>market" class="nav-link <?php echo $menu[34];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                    <p>Market</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(35, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>region" class="nav-link <?php echo $menu[35];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                    <p>Region</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(38, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>item" class="nav-link <?php echo $menu[33];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                    <p>Item</p>
                  </a>
                </li>
              <?php } ?>
              <?php if (in_array(31, $permissionData)) { ?>
                <li class="nav-item">
                  <a href="<?php echo $base_link; ?>company/view" class="nav-link <?php echo $menu[31];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
                    <p>Company Info</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>

        <li class="nav-header">
          <i class="fas fa-barcode"></i><i class="fas fa-barcode"></i><i class="fas fa-barcode"></i>
          <i class="fas fa-barcode"></i><i class="fas fa-barcode"></i><i class="fas fa-barcode"></i><i class="fas fa-barcode"></i>
          <i class="fas fa-barcode"></i><i class="fas fa-barcode"></i><i class="fas fa-barcode"></i><i class="fas fa-barcode"></i>
          <i class="fas fa-barcode"></i><i class="fas fa-barcode"></i><i class="fas fa-barcode"></i>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
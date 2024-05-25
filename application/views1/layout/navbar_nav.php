<?php
  $base_link = $this->config->item('base_url').$this->config->item('index_page');
  $permissionData = $this->session->userdata['permissionData'];
?>
<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>

    <?php if (in_array(1, $permissionData)) { ?>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $base_link; ?>dashboard/" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    </li>
    <?php } ?>

    <?php if (in_array(17, $permissionData)) { ?>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $base_link; ?>calendar/" class="nav-link"><i class="far fa-calendar-alt"></i> Calendar</a>
    </li>
    <?php } ?>

    <?php if (in_array(24, $permissionData)) { ?>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $base_link; ?>contact/" class="nav-link"><i class="fas fa-address-book"></i> Patients</a>
    </li>
    <?php } ?>

    <?php if (in_array(21, $permissionData)) { ?>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $base_link; ?>contact/" class="nav-link"><i class="fas fa-book"></i> Physicians</a>
    </li>
    <?php } ?>

    <?php if (in_array(38, $permissionData)) { ?>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $base_link; ?>my_drive/" class="nav-link"><i class="fas fa-hdd"></i> My Drive</a>
    </li>
    <?php } ?>

</ul>
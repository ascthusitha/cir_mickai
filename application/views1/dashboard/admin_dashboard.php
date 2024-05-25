<?php
  $base_link = $this->config->item('base_url').$this->config->item('index_page');
  $permissionData = $this->session->userdata['permissionData'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <?php $this->load->view('dashboard/dash_top_section'); ?>
      <!-- Main row -->
      <div class="row">
        <?php $this->load->view('dashboard/dash_card_1',$dash); ?>
        <?php $this->load->view('dashboard/dash_card_2',$dash); ?>
        <?php $this->load->view('dashboard/dash_card_3',$dash); ?>
        <?php $this->load->view('dashboard/dash_card_4',$dash); ?>
      </div>
    </div><!-- /.container-fluid -->
  </section>
</div>

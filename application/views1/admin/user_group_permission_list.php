<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?=$title;?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Manage</a></li>
            <li class="breadcrumb-item active"><?=$title;?></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-body">
        <table class="table table-striped table-bordered">
          <tr>
            <th>ID</th>
            <th>User Group</th> 
            <th>Permission</th>
            <th>&nbsp; </th>
          </tr>
          <?php
            if (count($user_groups)) {
              $i = 1;
              foreach ($user_groups as $user_group) {
          ?>
          <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $user_group->user_group_name;?></td>
            <td></td>
            <td style="width:70px;">
              <a href='<?php echo $base_link; ?>user_group_permission/view/<?php echo $user_group->user_group_id;?>' class='text-muted'><span class='fa fa-edit'></span></a>&nbsp;&nbsp;
            </td>
          </tr>
          <?php
                $i++;
              }
            }
          ?>
        </table>
      <!-- /.card-body -->
      </div>
    <!-- /.card -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
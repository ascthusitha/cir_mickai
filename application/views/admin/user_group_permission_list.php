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
        <div class="card-header">
          <h3 class="card-title"><?=$title;?> List</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
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

                                echo "<tr>";
                                echo "<td>" . $i . "</td>";
                                echo "<td>" . anchor('user_group_permission/view/' . $user_group->user_group_id, $user_group->user_group_name) . "</td>";
                                echo "<td></td>";
                                echo "<td>" . anchor('user_group_permission/delete/' . $user_group->user_group_id, '<span class="icon-trash"', array('class' => 'danger', 'onclick' => "return confirm('Are you sure want to delete this user group permission?')")) . "</td>";
                                echo "</tr>";
                                $i++;
                            }
                        }
                        ?>
                    </table>
 <!-- /.card-body -->


      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
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
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
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
<?php echo anchor('user/add/', 'add new', array('class' => 'btn btn-success')); ?>
                <br><br>
                    <table class="table table-striped table-bordered" id="user_table">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Code</th>
                                <th>Name</th>   
                                <th>Username</th> 
                                <th>Mobile </th>
                                <th>Email </th>
                                <th>User Group </th>
                                <th>Availability </th>
                                <th>&nbsp; </th>
                            </tr>
                        </thead><tbody>
                            <?php
                            if (count($users)) {
                                $i = 1;
                                foreach ($users as $user) {
                                    echo "<tr>";
                                    echo "<td>" . $i. "</td>";
                                    echo "<td>" . anchor('user/view/' . $user->user_id, $user->user_code) . "</td>";
                                    echo "<td>" . $user->user_fname . "</td>";
                                    echo "<td>" . $user->user_username . "</td>";
                                    echo "<td>" . $user->user_mobile . "</td>";
                                    echo "<td>" . $user->user_email . "</td>";
                                    echo "<td>" . $user->user_group_name . "</td>";
                                    $avail = ($user->user_status == 0) ? 'Available' : 'Not available';
                                    echo "<td>" . $avail . "</td>";
                                    echo "<td><a href='javascript:void(0)' onclick='deleteUser($user->user_id)' role='button' class='btn btn-primary btn-medium pull-right'  ><span class='fa fa-trash-alt'></span></a></td>";

                                    echo "</tr>";
                                    $i++;
                                }
                            }
                            ?></tbody>
                    </table>
                          </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#user_table').DataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 5,
        });


    });

    function deleteUser(user_id) {
        var val = confirm('Are you sure want to delete this User ?');
        var base_url = "<?php echo base_url(); ?>";
        if (val) {
            $.ajax({
                type: 'POST',
                url: base_url + 'user/delete/',
                data: {user_id: user_id},
                success: function (data) {

                    if (data == 'Success') {
                        alert("User Successfully Removed");
                        location.reload();
                    } else {
                        alert(data);
                    }
                    //$('#transport_table').html(data);     
                }
            });
        } else {
            return false;
        }
    }

    $("#p6").addClass('active');
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sales Activity Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Reports</a></li>
              <li class="breadcrumb-item active">Sales Activity Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Subject</th>
                    <th>Contact</th>
                    <th>Account</th>
                    <th>Start On</th>
                    <th>End On</th>
                    <th>Activity Type</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    foreach ($activities as $activity) {
                  ?>
                    <tr>
                      <td><?php echo $activity['subject'];?></td>
                      <td><?php echo $activity['contact_name'];?></td>
                      <td><?php echo $activity['acc_name'];?></td>
                      <td><?php echo $activity['start_date'].' '.$activity['start_time'];?></td>
                      <td><?php echo $activity['end_date'].' '.$activity['end_time'];?></td>
                      <td><?php echo $activity['activity_type'];?></td>
                      <td><?php echo $activity['status'];?></td>
                      <td><?php echo $activity['assigned_user_fname'];?></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Subject</th>
                    <th>Contact</th>
                    <th>Account</th>
                    <th>Start On</th>
                    <th>End On</th>
                    <th>Activity Type</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
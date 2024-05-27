<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-3">
          <h1><?=$title;?></h1>
        </div>
        <div class="col-sm-9">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><i class="nav-icon fas fa-handshake"></i> Activities </li>
            <li class="breadcrumb-item"><a href="#"><?=$title;?></a></li>
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
        <div class="card-tools">
          <a href="<?php echo $base_link; ?>phone_call/add" type="button" class="btn btn-primary btn-block"><i class="fas fa-plus-circle"></i> Add New</a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-striped table-bordered" width="100%"  id="account_table">
          <thead>
            <tr>
              <th>#</th>
              <th>Subject</th>
              <th>Patient</th> 
              <th>Physician</th> 
              <th>Start Date</th>
              <th>Start Time </th>
              <th>Status </th>
              <th>Assign To </th>
              <th>Location</th>
              <th>Created by</th>
              <th>&nbsp; </th>
            </tr>
          </thead>
          <tbody>
            <?php
              if (count($phone_call)) {
                $i=1;
                foreach ($phone_call as $g) {
            ?>
            <tr id="tr_<?php echo $g->pc_id;?>">
              <td><?php echo $i;?></td>
              <td><strong><i><?php echo $g->pc_subject;?></i></strong></td>
              <td><?php echo $g->contact_name;?></td>
              <td><?php echo $g->acc_name;?></td>
              <td><?php echo $g->start_date;?></td>
              <td><?php echo $g->start_time;?></td>
              <td><?php echo $g->pc_status;?></td>
              <td><?php echo $g->assign_to;?></td>
              <td><?php echo $g->location;?></td>
              <td><?php echo $g->cr_user;?></td>
              <td style="width:70px;">
                <a href='<?php echo $base_link; ?>phone_call/view/<?php echo $g->pc_id;?>' class='text-muted'><span class='fa fa-edit'></span></a>&nbsp;&nbsp;
                <button type="button" class="btn del-mod" data-id="<?php echo $g->pc_id;?>" data-toggle="modal" data-target="#modal-del"><span class='fa fa-trash-alt'></span></button>
              </td>
            </tr>
            <?php
                  $i++;
                }
              }
            ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-del">
  <div class="modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 class="modal-title">Are you sure</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure want to delete this  Doctor Appointment ?</p>
      </div>
      <input type="hidden" id="delId" name="delId" value="">
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-outline-light" id="del-yes">&nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  $( ".del-mod" ).click(function() {
    var id = $(this).attr("data-id");
    $('#delId').val(id);
  });

  $( "#del-yes" ).click(function() {
    var id = $('#delId').val();
    var base_url = "<?php echo $base_link; ?>";
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    $.ajax({
      type: 'POST',
      url: base_url + 'phone_call/delete/',
      data: {pc_id: id},
      success: function (data) {
        if ($.trim(data) == 'Success') {
          $('#tr_'+id).hide();
          $('#modal-del').modal('toggle');
          Toast.fire({
            icon: 'success',
            title: ' Doctor Appointment Successfully Removed'
          });
        } else {
          $('#modal-del').modal('toggle');
          Toast.fire({
            icon: 'success',
            title: ' Not Removed'
          });
        }
      }
    });
  });

  $(document).ready(function () {
    $('#account_table').DataTable({
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bInfo": false,
      "bAutoWidth": false,
      "sPaginationType": "full_numbers",
      "iDisplayLength": 5,
    });
  });
</script>

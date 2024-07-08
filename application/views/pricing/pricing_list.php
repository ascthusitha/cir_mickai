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
            <li class="breadcrumb-item"><a href="#"><i class="nav-icon fas fa-cogs"></i> Manage Values</a></li>
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
        <div class="card-tools">
          <?php if ($this->session->userdata('cur_add') == 1) { ?>
          <a href="<?php echo $base_link; ?>alert_price/add" type="button" class="btn btn-primary btn-block"><i class="fas fa-plus-circle"></i> Add New</a>
          <?php }?>
        </div>
      </div>
      <div class="card-body">
        <table id='price_table' class="table table-striped table-bordered">
          <thead>
            <tr>  
              <th>Start Date</th>
              <th>End Date</th>
              <th>SMS Rate</th>
              <th>Email Rate</th>
              <th>Voice Rate</th>
<!--              <th>Created By</th>-->
              <th>Created On</th>
              <th>&nbsp; </th>
            </tr>
          </thead>
          <tbody>
            <?php
              if (count($alert_prices)) {
                foreach ($alert_prices as $alert_price) {
            ?>
            <tr id="tr_<?php echo $alert_price->ar_id;?>">
              <td><?php echo  $alert_price->start_date;?></td>
              <td><?php echo $alert_price->end_date;?></td>
              <td><?php echo $alert_price->sms_rate;?></td>
              <td><?php echo $alert_price->email_rate;?></td>
              <td><?php echo $alert_price->voice_rate;?></td>
<!--              <td><?php echo $alert_price->created_user;?></td>-->
              <td><?php echo $alert_price->created_date;?></td>
              <td><?php echo anchor('alert_price/view/' . $alert_price->ar_id, "<span class='fa fa-edit'></span>");?><button type="button" class="btn del-mod" data-id="<?php echo $alert_price->ar_id;?>" data-toggle="modal" data-target="#modal-del"><span class='fa fa-trash-alt'></span></button></td>
            </tr>
            <?php
                }
              }
            ?>
          </tbody>
        </table>
      </div>
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
        <p>Are you sure want to delete this Alert Price ?</p>
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
      url: base_url + 'alert_price/delete/',
      data: {ar_id: id},
      success: function (data) {
        if ($.trim(data) == 'Success') {
          $('#tr_'+id).hide();
          $('#modal-del').modal('toggle');
          Toast.fire({
            icon: 'success',
            title: ' Alert Price Successfully Removed'
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
    $('#price_table').DataTable({
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

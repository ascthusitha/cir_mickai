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
    <div class="card">
      <div class="card-header border-0">

        <div class="card-tools">
          <a href="<?php echo $base_link; ?>time_sheet/add" type="button" class="btn btn-primary btn-block"><i class="fas fa-plus-circle"></i> Add New</a>
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle" id="account_table">
          <thead>
            <tr>
              <th>Project Name</th>
              <th>Physician</th>
              <th>Project Progress</th>
              <th>Time Spent</th>
              <th>Status</th>
              <th>Product</th>
              <th>Assign To</th>
              <th>Description</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php
              if (count($time_sheets)) {
                foreach ($time_sheets as $g) {
                  if($g->progress == ''){
                    $progress = 0;
                  }else{
                    $progress = $g->progress;
                  }

                  $active_timer_style = 'style="display: none;"';
                  $fixed_time_style = 'style="display: none;"';
                  if($g->timer){
                      $from_time = new DateTime($g->timer_started);
                      $from_time->setTimezone(new DateTimeZone('Asia/Colombo'));
                      $to_time = new DateTime();
                      $to_time->setTimezone(new DateTimeZone('Asia/Colombo'));
                      $time_diff = $from_time->diff($to_time);
                      $temp_timer_h = intval($time_diff->format('%h'));
                      $temp_timer_m = intval($time_diff->format('%i'));
                      $temp_timer_s = intval($time_diff->format('%s'));
                      $correct_timer_s = intval($g->timer_s)+$temp_timer_s;
                      $timer_s_temp = $correct_timer_s % 60;
                      $timer_s = str_pad($timer_s_temp, 2, '0', STR_PAD_LEFT);
                      $timer_m_temp = floor(($correct_timer_s / 60) % 60)+intval($g->timer_m)+$temp_timer_m;
                      $timer_m_temp2 = $timer_m_temp % 60;
                      $timer_m = str_pad($timer_m_temp2, 2, '0', STR_PAD_LEFT);
                      $timer_h_temp = floor(($timer_m_temp / 60) % 60)+intval($g->timer_h)+$temp_timer_h;
                      $timer_h = str_pad($timer_h_temp, 2, '0', STR_PAD_LEFT);
                      $timer_style = 'bg-lime';
                  }else{
                      $timer_h = str_pad($g->timer_h, 2, '0', STR_PAD_LEFT);
                      $timer_m = str_pad($g->timer_m, 2, '0', STR_PAD_LEFT);
                      $timer_s = str_pad($g->timer_s, 2, '0', STR_PAD_LEFT);
                      $timer_style = 'bg-gray';
                  }
            ?>
              <tr id="tr_<?php echo $g->ts_id;?>">
                <td><strong><i><?php echo $g->ts_name;?></i></strong></td>
                <td><?php echo $g->acc_name;?></td>
                <td class="project_progress">
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?php echo $progress;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress;?>%"> </div>
                  </div>
                  <small><?php echo $progress;?>% Complete</small>
                </td>
                <td>
                  <div class="<?php echo $timer_style;?>">
                    <span class="time">&nbsp;&nbsp;<i class="fas fa-clock"></i>&nbsp;&nbsp;<?php echo $timer_h.':'.$timer_m.':'.$timer_s;?></span>
                  </div>
                  <small>Hours:Minutes:Seconds</small>
                </td>
                <td><?php echo $g->cstat;?></td>
                <td><?php echo $g->product;?></td>
                <td><?php echo $g->assign_to;?></td>
                <td><?php echo $g->description;?></td>
                <td style="width:70px;">
                  <a href='<?php echo $base_link; ?>time_sheet/view/<?php echo $g->ts_id;?>' class='text-muted'><span class='fa fa-edit'></span></a>&nbsp;&nbsp;
                  <button type="button" class="btn del-mod" data-id="<?php echo $g->ts_id;?>" data-toggle="modal" data-target="#modal-del"><span class='fa fa-trash-alt'></span></button>
                </td>
              </tr>
            <?php
                }
              }
            ?>
                  
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

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
        <p>Are you sure want to delete this Time Sheet ?</p>
      </div>
      <input type="hidden" id="delId" name="delId" value="">
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">&nbsp;&nbsp;&nbsp;&nbsp;NO&nbsp;&nbsp;&nbsp;&nbsp;</button>
        <button type="button" class="btn btn-outline-light" id="del-yes">&nbsp;&nbsp;&nbsp;&nbsp;YES&nbsp;&nbsp;&nbsp;&nbsp;</button>
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
      url: base_url + 'time_sheet/delete/',
      data: {ts_id: id},
      success: function (data) {
        if ($.trim(data) == 'Success') {
          $('#tr_'+id).hide();
          $('#modal-del').modal('toggle');
          Toast.fire({
            icon: 'success',
            title: ' Time Sheet Successfully Removed'
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
      "iDisplayLength": 10,
    });
  });
</script>

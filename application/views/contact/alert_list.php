

        <table id='car_table' class="table table-striped table-bordered">
          <thead>
            <tr>  
              <th>Task Date</th>
              <th> Time</th>
              <th>Type</th>
              <th>Destination</th>
              <th>Message</th>
              <th>Status</th>
              <th>&nbsp; </th>
            </tr>
          </thead>
          <tbody>
            <?php
              if (count($alerts)) {
                foreach ($alerts as $alert) {
                    if($alert->alert_type==1){
                        $type='E-Mail';
                    }else if($alert->alert_type==2){
                    $type='SMS';
                    }else{
                      $type='Voice';  
                    }
            ?>
            <tr id="tr_<?php echo $alert->alertd_id;?>">
              <td><?php echo $alert->alert_date;?></td>
              <td><?php echo date('h:i:s A', strtotime($alert->alert_time. " -10 hours"));?></td>
              <td><?php echo $alert->alert_type?></td>
              <td><?php echo $alert->contact_value;?></td>
              <td><?php echo $alert->message;?></td>
              <td>Delivered</td>
              <td><button type="button" class="btn del-mod" data-id="<?php //echo $car->car_id;?>" data-toggle="modal" data-target="#modal-del"><span class='fa fa-trash-alt'></span></button></td>
            </tr>
            <?php
                }
              }
            ?>
          </tbody>
        </table>

   


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
        <p>Are you sure want to delete this Car ?</p>
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
      url: base_url + 'car/delete/',
      data: {car_id: id},
      success: function (data) {
        if ($.trim(data) == 'Success') {
          $('#tr_'+id).hide();
          $('#modal-del').modal('toggle');
          Toast.fire({
            icon: 'success',
            title: ' Car Successfully Removed'
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
    $('#car_table').DataTable({
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

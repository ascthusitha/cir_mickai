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
          <div class="col-sm-1">
             <a href="<?php echo $base_link; ?>task_detail/add" class="btn btn-block bg-gradient-success btn-flat">Add New</a>
            
          </div>
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?=$title;?></a></li>
              <!-- <li class="breadcrumb-item active">Blank Page</li> -->
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
          <h3 class="card-title"><?=$title?></h3>

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
           <table class="table table-striped table-bordered" width="100%"  id="account_table">
                        <thead><tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Contact</th> 
                                <th>Account</th> 
                                <th>Start Date</th>
                                <th>Start Time </th>
                                <th>Status </th>
                                <th>Assign To </th>
                                <th>Created by</th>
                                <th>&nbsp; </th>
                            </tr></thead>
                        <tbody>
                            <?php
                            if (count($tasks)) {
                                $i=1;
                              
                                foreach ($tasks as $g) {
                                     $status=($g->current_status==1)?'Completed':'Scheduled';
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . anchor('task_detail/view/' . $g->td_id, $g->subject) . "</td>";
                                    echo "<td> " . $g->contact_name ." </td>";
                                    echo "<td>" . $g->acc_name . "</td>";
                                    echo "<td>" . $g->start_date . "</td>";
                                    echo "<td>" . $g->start_time . "</td>";
                                    echo "<td>" . $status . "</td>";
                                     echo "<td>" . $g->assign_to . "</td>";
                                    // echo "<td>" . $g->o_city . "</td>";
                                    echo "<td>" . $g->user_fname . "</td>";
                                    echo "<td><a href='javascript:void(0)' onclick='deleteSC($g->sc_id)' ><span class='fa fa-trash-alt'></span></a></td>";
                                    echo "</tr>";
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                   
 <!-- /.card-body -->

        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
                   

<script type="text/javascript">
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
        function deleteSC(sc_id) {
        var val = confirm('Are you sure want to delete this Task Detials ?');
        var base_url = "<?php echo base_url(); ?>";
        if (val) {
            $.ajax({
                type: 'POST',
                url: base_url + 'task_detail/delete/',
                data: {sc_id: sc_id},
                success: function (data) {

                    if ($.trim(data) == 'Success') {
                        alert(" Task Detials Successfully Removed");
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
</script>


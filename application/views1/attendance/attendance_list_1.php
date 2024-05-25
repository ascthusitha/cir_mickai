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
             <a href="<?php echo base_url(); ?>account/add" class="btn btn-block bg-gradient-success btn-flat">Add New</a>
            
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
                                <th>Student Name</th>
                                <th>In - Time</th>  
                                <th>Out - TIme</th>
                                
                                <th>Parent/Guardian </th>
                                <th>Mobile </th>
                                <th>Address</th>
                                <th>Checked by</th>
                                <th>&nbsp; </th>
                            </tr></thead>
                        <tbody>
                            <?php
                            if (count($attendance)) {
                                $i=1;
                              
                                foreach ($attendance as $g) {
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td> " . $g->contact_id ."</td>";
                                    echo "<td>" . $g->in_date . " ".$g->in_time ."</td>";
                                    echo "<td>" . $g->out_date . " ".$g->out_time ."</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>" . $g->user_fname . "</td>";
                                    echo "<td>" . anchor('attendance/edit/' . $g->attendance_id, '<span class="glyphicon glyphicon-trash"', array('class' => 'danger', 'onclick' => "return confirm('Are you sure want to Check-out this student?')")) . "</td>";
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
        $('#table').DataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 10,
        });


    });

    $("#p2").addClass('active');
</script>
<script>
    function load_collections() {

        var img_path = "<?php echo base_url() ?>assets/img/loading.gif";
        var base_url = "<?php echo base_url(); ?>";

        var acc_code = $('#acc_code').val();
        var acc_name = $('#acc_name').val();
        var id_no = $('#id_no').val();
        var user_id=$('#user_id').val();

        try {
            $.ajax({
                type: "POST",
                url: base_url + 'account/get_account_details/',
                data: {acc_code: acc_code, acc_name: acc_name, user_id: user_id,id_no:id_no},
                beforeSend: function () {
                    $('#acc_list').html("<div align='center' class='col-md-4 col-md-offset-4'> <img src= " + img_path + "></div>");
                },
                success: function (data) {

                    $('#acc_list').html(data);

                }
            });
        }
        catch (err) {
            //  alert("err.message");
        }


    }


</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#account_table').DataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth":
            "sPaginationType": "full_numbers",
            "iDisplayLength": 5,
        });


    });
</script>

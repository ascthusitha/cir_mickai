 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Account</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Account</a></li>
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
          <h3 class="card-title">Account</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">  <div class="col-md-12  alert alert-default">
                                <div class="col-md-3">
                                    <label for="cus_code">Customer Code</label>
                                    <input type="text" class="form_control" name="cus_code" id="cus_code" value="" /> 
                                </div>
                                <div class="col-md-3">
                                    <label for="date_to">First Name</label>
                                    <input type="text" class="form_control" name="f_name" id="f_name" value="" /> 
                                </div>
                                <div class="col-md-3">
                                    <label for="id_no">ID Number</label>
                                  <input type="text" class="form_control" name="id_no" id="id_no" value="" />    
                                </div>
                                
                                 <div class="col-md-2">
                                    <label for="user_id">User</label>
                                  <?php echo form_dropdown('user_id', $users, $this->session->userdata('user_id'), "id='user_id'  class='form-control'"); ?>     
                                </div>
                                <div class="col-md-2"><br>
                                    <button type="button" onclick="load_collections()" class="btn btn-success" >Find  <span class="glyphicon icon-search"></span></button>
                                </div>
                            </div>
          <div id="cus_list" class="col-md-12">
                    <table class="table table-striped table-bordered" width="100%" id="table">
                        <thead><tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>  
                                <th>Mobile</th>
                                <th>ID number </th>
                                <th>Address</th>
                                <th>Added by</th>
                                <th>&nbsp; </th>
                            </tr></thead>
                        <tbody>
                            <?php
                            if (count($customer)) {
                                $i=1;
                                foreach ($customer as $g) {
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . anchor('customer/view/' . $g->cus_id, $g->cus_code) . "</td>";

                                    echo "<td>" . $g->title . " " . $g->cus_fname . " " . $g->cus_lname . "</td>";
                                    echo "<td>" . $g->mobile . "</td>";
                                                                        echo "<td>" . $g->id_number . "</td>";
                                    echo "<td>" . $g->address . "," . $g->city . "</td>";
                                    echo "<td>" . $g->user_fname . "</td>";
                                    echo "<td>" . anchor('customer/delete/' . $g->cus_id, '<span class="glyphicon glyphicon-trash"', array('class' => 'danger', 'onclick' => "return confirm('Are you sure want to delete this Customer?')")) . "</td>";
                                    echo "</tr>";
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
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

        var cus_code = $('#cus_code').val();
        var f_name = $('#f_name').val();
        var id_no = $('#id_no').val();
        var user_id=$('#user_id').val();

        //alert(arriva_date);
        // alert(departure_date);

        try {
            $.ajax({
                type: "POST",
                url: base_url + 'customer/get_customer_details/',
                data: {cus_code: cus_code, f_name: f_name, user_id: user_id,id_no:id_no},
                beforeSend: function () {
                    $('#cus_list').html("<div align='center' class='col-md-4 col-md-offset-4'> <img src= " + img_path + "></div>");
                },
                success: function (data) {

                    $('#cus_list').html(data);

                }
            });
        }
        catch (err) {
            //  alert("err.message");
        }


    }


</script>
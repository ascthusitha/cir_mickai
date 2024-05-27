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
<?php 
           if ($this->session->userdata('cur_add') == 1) { 
                    echo anchor('currency/add/', 'add new', array('class' => 'btn btn-success'));
           }?>
                <br><br>
                    <table id='currency_table' class="table table-striped table-bordered">
                        <thead>
                            <tr>  
                                <th>Currency</th>
                                 <th>Code</th>
                                <th>&nbsp; </th>
                            </tr></thead><tbody>
                            <?php
                            if (count($currencies)) {
                                foreach ($currencies as $currency) {
                                    echo "<tr>";
                                    echo "<td>" . anchor('currency/view/' . $currency->currency_id, $currency->currency_name) . "</td>";
                                    echo "<td>". $currency->currency_code . "</td>";
                                    echo "<td><a href='javascript:void(0)' onclick='deleteUserGroup($currency->currency_id)' role='button' class='btn btn-danger btn-medium pull-right'  ><span class='fa fa-trash-alt'></span></a></td>";
                                    echo "</tr>";
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
        $('#currency_table').DataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 5,
        });
    });

    function deleteUserGroup(currency_id) {
        var val = confirm('Are you sure want to delete this  Currency ?');
        var base_url = "<?php echo base_url(); ?>";
        if (val) {
            $.ajax({
                type: 'POST',
                url: base_url + 'currency/delete/',
                data: {currency_id: currency_id},
                success: function (data) {

                    if (data == 'Success') {
                        alert(" Currency Successfully Removed");
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
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
           if ($this->session->userdata('manage') == 1) { 
                    echo anchor('tier/add/', 'add new', array('class' => 'btn btn-success'));
           }?>
                <br><br>
                    <table id='tier_table' class="table table-striped table-bordered">
                        <thead>
                            <tr>  
                                <th>Tier</th>
                                 <th>Markup</th>
                                 <th>Discount</th>
                                 <th>Description</th>
                                <th>&nbsp; </th>
                            </tr></thead><tbody>
                            <?php
                            if (count($tiers)) {
                                foreach ($tiers as $tier) {
                                    echo "<tr>";
                                    echo "<td>" . anchor('tier/view/' . $tier->tier_id, $tier->tier_name) . "</td>";
                                    echo "<td>". $tier->markup . "</td>";
                                    echo "<td>". $tier->discount . "</td>";
                                    echo "<td>". $tier->description . "</td>";
                                    echo "<td><a href='javascript:void(0)' onclick='deleteTier($tier->tier_id)' role='button' class='btn btn-danger btn-medium pull-right'  ><span class='fa fa-trash-alt'></span></a></td>";
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
        $('#tier_table').DataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 5,
        });
    });

    function deleteTier(tier_id) {
        var val = confirm('Are you sure want to delete this  tier ?');
        var base_url = "<?php echo base_url(); ?>";
        if (val) {
            $.ajax({
                type: 'POST',
                url: base_url + 'tier/delete/',
                data: {tier_id: tier_id},
                success: function (data) {

                    if (data == 'Success') {
                        alert(" Tier Successfully Removed");
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
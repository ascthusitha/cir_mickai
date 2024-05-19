 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Supplier List
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Master Details</a></li>
        
        <li class="active">Supplier list</li>
      </ol>
    </section>
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
 <!--            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
             /.box-header -->
            <div class="box-body">
        <div class="page-header text-info">
            
            <h3><?php
            if ($this->session->userdata('sup_add') == 1) { 
                echo anchor('supplier/add/', 'add new', array('class' => 'btn btn-success'));
            }?>
            </h3> </div>
        
                <table class="table table-striped table-bordered" id="supplier_table">
                    <thead>  <tr>

                            <th>Supplier code</th>   
                            <th>Supplier Name </th> 
                            <th>email</th>   
                            <th>mobile </th> 
                            
                            <th>Address </th>
                            <th>&nbsp; </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($suppliers)) {
                            foreach ($suppliers as $supplier) {
                                echo "<tr>";

                                echo "<td>" . anchor('supplier/view/' . $supplier->supplier_id, $supplier->supplier_code) . "</td>";
                                echo "<td>" . $supplier->supplier_name . "</td>";
                                echo "<td>" . $supplier->supplier_email . "</td>";
                                echo "<td>" . $supplier->supplier_mobile . "</td>";
                             
                                echo "<td>" . $supplier->supplier_address . "</td>";
                                echo "<td>" . anchor('supplier/delete/' . $supplier->supplier_id, '<span class="glyphicon glyphicon-trash"', array('class' => 'danger', 'onclick' => "return confirm('Are you sure want to remove this supplier?')")) . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
                           </div>
       <!--       /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#supplier_table').DataTable({
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
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
                    echo anchor('Product/add/', 'Add new', array('class' => 'btn btn-success'));
           }?>
                <br><br>
    <table class="table table-striped table-bordered" id="product_list_table">
        <thead>  <tr>

                <th>Product Name </th> 
            
                <th>&nbsp;# </th>
            </tr></thead> 
        <tbody>
            <?php
            if (count($products)) {
                foreach ($products as $product) {
                    echo "<tr>";

                    echo "<td>" . anchor('product/view/' . $product->product_id, $product->name) . "</td>";

                    echo "<td><a href='javascript:void(0)' onclick='deleteProduct($product->id)' ><i class='fas fa-trash-alt' style='font-size:18px;color:red'></i></a></td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>

<div id="product_error"></div>
                           </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#product_list_table').DataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 5,
        });


    });
      function deleteProduct(product_id) {
        var val = confirm('Are you sure want to delete this  Product ?');
        var base_url = "<?php echo base_url(); ?>";
        if (val) {
            $.ajax({
                type: 'POST',
                url: base_url + 'product/delete/',
                data: {product_id: product_id},
                success: function (data) {

                    if (data == 'Success') {
                        alert(" Product Successfully Removed");
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
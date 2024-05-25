 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Item List
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Item</a></li>
        
        <li class="active">Item list</li>
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

                    <table class="table table-striped table-bordered" id="item_table">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item Code</th>
                                <th>Item Name</th>   
                                <th>Availability </th>
                                <th>&nbsp; </th>
                            </tr>
                        </thead><tbody>
                            <?php
                            if (count($items)) {
                                $i = 1;
                                foreach ($items as $item) {
                                    echo "<tr>";
                                    echo "<td>" . $i. "</td>";
                                    echo "<td>" . anchor('item/view/' . $item->item_id, $item->item_code) . "</td>";
                                    echo "<td>" . $item->item_name . "</td>";

                                    $avail = ($item->item_status == 1) ? 'Available' : 'Not available';
                                    echo "<td>" . $avail . "</td>";
                                    echo "<td><a href='javascript:void(0)' onclick='delete_item($item->item_id)' role='button' class='btn btn-primary btn-medium pull-right'  ><span class='glyphicon glyphicon-trash'></span></a></td>";

                                    echo "</tr>";
                                    $i++;
                                }
                            }
                            ?></tbody>
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
        $('#item_table').DataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 5,
        });


    });

    function delete_item(c_id) {
        var val = confirm('Are you sure want to delete this item ?');
        var base_url = "<?php echo base_url(); ?>";
        if (val) {
            $.ajax({
                type: 'POST',
                url: base_url + 'item/delete/',
                data: {c_id: c_id},
                success: function (data) {

                    if (data == 'Success') {
                        alert("Item Successfully Removed");
                        location.reload();
                    } else {
                        alert(data);
                    }
                }
            });
        } else {
            return false;
        }
    }

    $("#p6").addClass('active');
</script>
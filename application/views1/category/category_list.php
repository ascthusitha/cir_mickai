 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category List
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Category</a></li>
        
        <li class="active">Category list</li>
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

                    <table class="table table-striped table-bordered" id="category_table">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Code</th>
                                <th>Category Name</th>   
                                <th>Availability </th>
                                <th>&nbsp; </th>
                            </tr>
                        </thead><tbody>
                            <?php
                            if (count($categories)) {
                                $i = 1;
                                foreach ($categories as $category) {
                                    echo "<tr>";
                                    echo "<td>" . $i. "</td>";
                                    echo "<td>" . anchor('category/view/' . $category->category_id, $category->category_code) . "</td>";
                                    echo "<td>" . $category->category_name . "</td>";

                                    $avail = ($category->category_status == 1) ? 'Available' : 'Not available';
                                    echo "<td>" . $avail . "</td>";
                                    echo "<td><a href='javascript:void(0)' onclick='delete_category($category->category_id)' role='button' class='btn btn-primary btn-medium pull-right'  ><span class='glyphicon glyphicon-trash'></span></a></td>";

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
        $('#category_table').DataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 5,
        });


    });

    function delete_category(c_id) {
        var val = confirm('Are you sure want to delete this category ?');
        var base_url = "<?php echo base_url(); ?>";
        if (val) {
            $.ajax({
                type: 'POST',
                url: base_url + 'category/delete/',
                data: {c_id: c_id},
                success: function (data) {

                    if (data == 'Success') {
                        alert("Category Successfully Removed");
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
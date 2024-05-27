<div id="page-wrapper">
    <div class="container-fluid">
        <div class="page-header text-info">
            <h3> Promotion details list &nbsp;      <?php echo anchor('promotion_details/add/', 'add new', array('class' => 'btn btn-success')); ?>
            </h3> </div>
        <table class="table table-striped table-bordered" id="table">
            <thead> <tr>

<!--	    <th>Promotion</th>-->
                    <th>Promotion Name </th>
                    <th>Supplier </th>
                    <th>member Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Amount</th>
                    <th>&nbsp; </th>
                </tr> </thead><tbody>
                <?php
                if (count($promotion_datas)) {
                    foreach ($promotion_datas as $promotion_data) {
                        echo "<tr>";

                        echo "<td>" . anchor('promotion_details/view/' . $promotion_data->promotion_details_id, $promotion_data->promotion_name) . "</td>";
                        echo "<td>" . $promotion_data->supplier_name . "</td>";
                        echo "<td>" . $promotion_data->member_type_name . "</td>";
                        echo "<td>" . $promotion_data->start_date . "</td>";
                        echo "<td>" . $promotion_data->end_date . "</td>";
                        echo "<td>" . $promotion_data->amount . "</td>";
                        echo "<td>" . anchor('promotion_details/delete/' . $promotion_data->promotion_details_id, '<span class="glyphicon glyphicon-trash"', array('class' => 'danger', 'onclick' => "return confirm('Are you sure want to delete this ?')")) . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody></table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#table').DataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 7,
            "order": [[2, "asc"]]
        });


    });
</script>
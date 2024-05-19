<div id="page-wrapper">
    <div class="container-fluid">
        <div class="page-header text-info">
            <h3> Promotion list &nbsp;      <?php echo anchor('promotion/add/', 'add new', array('class' => 'btn btn-success')); ?>
            </h3> </div>
        <table class="table table-striped table-bordered" id="table">
            <thead> <tr>

<!--	    <th>Promotion</th>-->
                    <th>Promotion Name </th>
                    <th>Supplier </th>
                    <th>Description</th>
                    <th>&nbsp; </th>
                </tr> </thead><tbody>
                <?php
                if (count($promotions)) {
                    foreach ($promotions as $promotion) {
                        echo "<tr>";

                        echo "<td>" . anchor('promotion/view/' . $promotion->promotion_id, $promotion->promotion_name) . "</td>";
                        echo "<td>" . $promotion->supplier_name . "</td>";
                        echo "<td>" . $promotion->description . "</td>";
                        echo "<td>" . anchor('promotion/delete/' . $promotion->promotion_id, '<span class="glyphicon glyphicon-trash"', array('class' => 'danger', 'onclick' => "return confirm('Are you sure want to delete this promotion?')")) . "</td>";
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
            "iDisplayLength": 5,
            "order": [[2, "asc"]]
        });


    });
</script>
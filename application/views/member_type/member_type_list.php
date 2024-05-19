<div id="page-wrapper">
    <div class="container-fluid">
        <div class="page-header text-info">
            <h3> Member Type list &nbsp;      <?php echo anchor('member_type/add/', 'add new', array('class' => 'btn btn-success')); ?>
            </h3> </div>
        <table class="table table-striped table-bordered" id="table">
            <thead> <tr>

                    <th>Member Type</th>
        <!--            <th>Discount (%) </th>-->
                    <th>Description</th>
                    <th>&nbsp; </th>
                </tr> </thead><tbody>
                <?php
                if (count($member_types)) {
                    foreach ($member_types as $member_type) {
                        echo "<tr>";

                        echo "<td>" . anchor('member_type/view/' . $member_type->member_type_id, $member_type->member_type_name) . "</td>";
                        // echo "<td>". $member_type->discount ."</td>";
                        echo "<td>" . $member_type->description . "</td>";
                        echo "<td>" . anchor('member_type/delete/' . $member_type->member_type_id, '<span class="glyphicon glyphicon-trash"', array('class' => 'danger', 'onclick' => "return confirm('Are you sure want to delete this member type?')")) . "</td>";
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
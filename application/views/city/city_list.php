<div class="container">
    <div class="page-header text-info">
        <h3> City List &nbsp;<?php echo anchor('city/add/', 'add new', array('class' => 'btn btn-success')); ?>
        </h3> </div>
    <table class="table table-striped table-bordered" id="city_list_table">
        <thead>  <tr>

                <th>City Name </th> 
                <th>Description</th> 
                <th>Country </th> 
                <th>&nbsp; </th>
            </tr></thead> 
        <tbody>
            <?php
            if (count($cities)) {
                foreach ($cities as $city) {
                    echo "<tr>";

                    echo "<td>" . anchor('city/view/' . $city->city_id, $city->city_name) . "</td>";
                    echo "<td>" . $city->city_description . "</td>";
                    echo "<td>" . $city->country_name . "</td>";
                    echo "<td>" . anchor('city/delete/' . $city->city_id, '<span class="glyphicon glyphicon-trash"', array('class' => 'danger', 'onclick' => "return confirm('Are you sure want to delete this City?')")) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>

</div>
<div id="city_error"></div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#city_list_table').DataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 5,
        });


    });
</script>
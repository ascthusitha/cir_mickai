
           <table class="table table-striped table-bordered" width="100%"  id="customer_table">
                        <thead><tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>  
                                <th>Mobile</th>
                                
                                <th>ID number </th>
                                <th>Address</th>
                                <th>Added by</th>
                                <th>&nbsp; </th>
                            </tr></thead>
                        <tbody>
                            <?php
                            if (count($customer)) {
                                $i=1;
                                if($g->cus_lname==0){
                                    $l_name="";
                                }
                                foreach ($customer as $g) {
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . anchor('customer/view/' . $g->cus_id, $g->cus_code) . "</td>";

                                    // echo "<td>" . $g->title . " " . $g->cus_fname . " " . $g->cus_lname . "</td>";
                                    echo "<td> " . $g->cus_fname . " " . $l_name . "</td>";
                                    echo "<td>" . $g->mobile . "</td>";
                                    
                                    echo "<td>" . $g->id_number . "</td>";
                                    echo "<td>" . $g->address . "," . $g->city . "</td>";
                                    echo "<td>" . $g->user_fname . "</td>";
                                    echo "<td>" . anchor('customer/delete/' . $g->cus_id, '<span class="glyphicon glyphicon-trash"', array('class' => 'danger', 'onclick' => "return confirm('Are you sure want to delete this Customer?')")) . "</td>";
                                    echo "</tr>";
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                   

<script type="text/javascript">
    $(document).ready(function () {
        $('#customer_table').DataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth":
            "sPaginationType": "full_numbers",
            "iDisplayLength": 5,
        });


    });
</script>


           <table class="table table-striped table-bordered" width="100%"  id="att_table">
                        <thead><tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>In - Time</th>  
                                <th>Out - TIme</th>
                                
                                <th>Parent/Guardian </th>
                                <th>Mobile </th>
                              
                                <th>Checked by</th>
                                <th>&nbsp; </th>
                            </tr></thead>
                        <tbody>
                            <?php
                            if (count($attendance)) {
                                $i=1;
                              
                                foreach ($attendance as $g) {
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td> " . $g->contact_name ."</td>";
                                    echo "<td>" . date_format(date_create($g->in_date),config_item('php_date_format')). " --- ".$g->in_time ."</td>";
                                    echo "<td>" . $g->out_date . " ".$g->out_time ."</td>";
                                    echo "<td>" . $g->f_fname . " ".$g->f_lname ."</td>";
                          echo "<td>" . $g->f_mobile . "</td>";
                                    echo "<td>" . $g->user_fname . "</td>";
                                    $dis='';
                                    if($g->out_date >0){
                                        $dis="disabled";
                                    }
                                    // echo "<td>" . anchor('account/view/' . $g->acc_id, $g->acc_code) . "</td>";
                                    echo "<td><button $dis type='button' onclick='student_out($g->att_id)' class='btn btn-block btn-danger btn-lg'><i class='fas fa-angle-double-down'  ></i> Out</button></td>";
                                    echo "</tr>";
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>





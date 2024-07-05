

 <table class="table table-striped table-bordered" width="100%"  id="contact_table">
                        <thead><tr>
                                <th>#</th>
                                <th> Name</th>
                                 
                                <th>Address</th>
                                <th>Other Phone </th>
                                <th>Mobile</th>
                                
                                <th>Email </th>
                                <th>Date of Birth</th>
                                <th>Created by</th>
                                <th>&nbsp; </th>
                            </tr></thead>
                        <tbody>
                            <?php
                            if (count($s_contacts)) {
                                $i=1;
                              
                                foreach ($s_contacts as $g) {
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . $g->first_name." ".$g->last_name . "</td>";
                                    echo "<td> " . $g->address ." </td>";
                                    echo "<td>" . $g->phone_no . "</td>";
                                    echo "<td>" . $g->mobile . "</td>";
                                 
                                    echo "<td>" . $g->email . "</td>";
                                    echo "<td>" . $g->dob . "</td>";
                                    echo "<td>" . $g->user_fname . "</td>";
                                    echo "<td><a href='javascript:void(0)' onclick='editOContact($g->co_id)' ><span class='fa fa-edit' style='font-size:18px;'></span></a>&nbsp;&nbsp;<a href='javascript:void(0)' onclick='deleteOContact($g->co_id)' ><i class='fas fa-trash-alt' style='font-size:18px;color:red'></i></a></td>";
                                    echo "</tr>";
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
<div class="container">
    <div col-md-6 >
     <form action="<?php echo base_url(); ?>contact_other/save" id="co-form"  method="post">
                <fieldset>
                    <div class="col-sm-12">

                        <div class="col-sm-4">
                            <label class="control-label" for="first_name">First Name</label>

                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo isset($other_contact['first_name']) ? $other_contact['first_name'] : set_value(''); ?>">
                            <input type="hidden" class="form-control" name="co_id" id="co_id" value="<?php echo $other_contact['co_id']; ?>">
<input type="hidden" class="form-control" name="contact_id1" id="contact_id1" value="<?php echo $contact_id; ?>">
                        </div>
                                                <div class="col-sm-4">
                            <label class="control-label" for="first_name">Last Name</label>

                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo isset($other_contact['last_name']) ? $other_contact['last_name'] : set_value(''); ?>">
                            

                        </div>
                        <div class="col-sm-4">
                            <label class="control-label" for="phone_no">Phone No</label>

                            <input type="text" class="form-control" name="phone_no" id="phone_no" value="<?php echo isset($other_contact['phone_no']) ? $other_contact['phone_no'] : set_value(''); ?>">
                            
                        </div>
                                     <div class="col-sm-4">
                            <label class="control-label" for="mobile">Mobile</label>

                            <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo isset($other_contact['mobile']) ? $other_contact['mobile'] : set_value(''); ?>">
                            
                        </div>
                                <div class="col-sm-4">
                            <label class="control-label" for="address">Address</label>

                            <textarea  class="form-control" name="address" id="address" ><?php echo isset($other_contact['address']) ? $country['address'] : set_value(''); ?>
                            </textarea>
                        </div>
                               <div class="col-sm-4">
                            <label class="control-label" for="mobile">Date of Birth</label>

                            <input type="text" class="form-control" name="dob" id="dob" value="<?php echo isset($other_contact['dob']) ? $other_contact['dob'] : set_value(''); ?>">
                            
                        </div>
                    </div>
                    <div class="col-sm-12">

                        <div class="col-sm-4">
                            <br>
                            <input type="submit" class="btn btn-success" value="<?php echo isset($btn_value) ? $btn_value : 'Save'; ?>">
                        </div>
                    </div>
                </fieldset>
            </form>
    </div>
                   <div id="results"></div>

</div>
<script type="text/javascript">
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";


        $('#co-form').validate({
            rules: {
                first_name: {
                    required: true
                },contact_id1: {
                    required: true
                }
            }, messages: {
                first_name: {
                    required: "Please enter first name",
                },contact_id1: {
                    required: "Please Create Primary Contact Before Adding the secondary Contacts",
                }
            },
           
            submitHandler: function (form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    success: function (data)
                    {
                        if (data == "success") {
                            $('#results').removeClass('alert alert-danger');
                            $('#results').addClass('alert alert-success');
                            $('#results').html('secondary contact successfully saved');
                            var URL = "<?php echo base_url(); ?>contact/view/<?php echo $contact_id; ?>";
                            setTimeout(function () {
                                window.location = URL;
                            }, 1000);
                        } else {
                            $('#results').addClass('alert alert-danger');
                            $('#results').html(data);
                        }

                    }
                });

                return false; // required to block normal submit since you used ajax
            }

        });
        
    }); // end document.ready
    function editOContact(co_id) {
         var base_url = "<?php echo base_url(); ?>";
        $.ajax({
                type: 'POST',
                url: base_url + 'contact_other/edit/',
                data: {co_id: co_id},
                success: function (data) {

               var arr=JSON.parse(data);
                    $('#first_name').val(arr.first_name);    
                    $('#last_name').val(arr.last_name);
                    $('#phone_no').val(arr.phone_no);
                    $('#mobile').val(arr.mobile);
                    $('#dob').val(arr.dob);
                    $('#address').html(arr.address);
                    $('#co_id').val(arr.co_id);
                }
            });
    }
    function deleteOContact(co_id) {
        var val = confirm('Are you sure want to remove this  other Contact ?');
        var base_url = "<?php echo base_url(); ?>";
        if (val) {
            $.ajax({
                type: 'POST',
                url: base_url + 'contact_other/delete/',
                data: {co_id: co_id},
                success: function (data) {

                    if ($.trim(data) == 'success') {
                        alert(" Secondary Contact Successfully Removed");
                         var URL = "<?php echo base_url(); ?>contact/view/<?php echo $contact_id; ?>";
                            setTimeout(function () {
                                window.location = URL;
                            }, 1000);
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


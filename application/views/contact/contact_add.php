<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contact Add</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Contact</a></li>
                        <li class="breadcrumb-item active">Contact Add</li>
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
                <h3 class="card-title"><?= $title ?></h3>

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
                <form class="well form-horizontal" action="<?php echo base_url(); ?>contact/save" method="post"  id="acc_form">
                    <fieldset>




                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Contact Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" id="contact_name" name="contact_name" class="form-control" placeholder="Enter ..." value="<?= $contact['contact_name']; ?>">
                                            <input type="hidden" id="contact_id" name="contact_id" class="form-control" placeholder="Enter ..." value="<?= $contact['contact_id']; ?>">
                                        </div>
                                        
                                    </div>
                                     <div class="col-sm-6">
                                        <label >Last Name</label>
                                         <input type="text" id="contact_lname" name="contact_lname" class="form-control" value="<?= $contact['contact_lname']; ?>" placeholder="Enter ...">
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                        <label >Account</label>                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  +
</button>
                                        <?php echo form_dropdown('acc_id', $accounts, isset($contact['acc_id']) ? $contact['acc_id'] : '0', 'id="acc_id" class="form-control"'); ?> 
         </div>
                                    <div class="col-sm-6">
                                        <label >Business Name</label>
                                         <input type="text" id="b_name" name="b_name" class="form-control" value="<?= $contact['b_name']; ?>" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Office Phone</label>
                                            <input type="text" id="office_phone" name="office_phone" class="form-control" value="<?= $contact['office_phone']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input type="text" id="mobile" name="mobile" class="form-control" value="<?= $contact['mobile']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                   <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Home Phone</label>
                                            <input type="text" id="home_phone" name="home_phone" class="form-control" value="<?= $contact['home_phone']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Alternate  Phone</label>
                                            <input type="text" id="alternate_phone" name="alternate_phone" class="form-control" value="<?= $contact['alternate_phone']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" id="email" name="email" class="form-control" value="<?= $contact['email']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Fax</label>
                                            <input type="text" id="fax" name="fax" class="form-control" value="<?= $contact['fax']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                   <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Department</label>
                                            <input type="text" id="department" name="department" class="form-control" value="<?= $contact['department']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input type="text" id="designation" name="designation" class="form-control" value="<?= $contact['designation']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label >CAR</label>
                                        <?php echo form_dropdown('car_id', $cars, isset($contact['car_id']) ? $contact['car_id'] : '0', 'id="car_id" class="form-control"'); ?> 
                                    </div>
                                    <div class="col-sm-6">
                                        <label >CRR</label>
                                        <?php echo form_dropdown('crr_id', $crrs, isset($contact['crr_id']) ? $contact['crr_id'] : '0', 'id="crr_id" class="form-control"'); ?> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Contact Level</label>
                                            <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" checked="">
                          <label class="form-check-label">Primary</label>
                          <input class="form-check-input" type="radio" name="radio1" checked="">
                          <label class="form-check-label">Primary</label>
                          <input class="form-check-input" type="radio" name="radio1" checked="">
                          <label class="form-check-label">Primary</label>
                        </div>
<!--                                            <input type="radio" id="c_level" name="c_level" class="form-control" value="<?= $contact['c_level']; ?>" >Secondary
                                            <input type="radio" id="c_level" name="c_level" class="form-control" value="<?= $contact['c_level']; ?>" >Normal-->
                                        </div>
                                    </div>
 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Assign To</label>
                                            <?php echo form_dropdown('assign_to', $users, isset($contact['assign_to']) ? $contact['assign_to'] : '0', 'id="assign_to" class="form-control"'); ?> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Assistant</label>
                                            <input type="text" id="assistant" name="assistant" class="form-control" value="<?= $contact['assistant']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                      <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Assistant Phone</label>
                                            <input type="text" id="assistant_phone" name="assistant_phone" class="form-control" value="<?= $contact['assistant_phone']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                   
                                   
                                </div> <label style="text-align: center">Address Information</label><br>
                                                     <div class="progress progress-xs">
                  <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    <span class="sr-only"></span>
                  </div> <br>
                </div>
                                <div class="row">
               
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Primary Address</label>
                                            <textarea id="primary_address" name="primary_address" class="form-control" placeholder="Enter ..." rows="5" cols="10"><?= $contact['primary_address']; ?></textarea>
                                        </div>
                                    </div>
                                    <?php
                                    if(isset($contact['primary_address'])){
                                    $address_arr=explode(',',$contact['primary_address']);
                                     
                                    }
                                    ?>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Other Address</label>
                                            <textarea id="other_address" name="other_address" class="form-control" placeholder="Enter ..." rows="5" cols="10"><?= $contact['other_address']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Office City</label>
                                            <input type="text" id="primary_city" name="primary_city" class="form-control" value="<?= isset($contact['primary_city']) ? $contact['primary_city'] : $address_arr[1]; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Other City</label>
                                            <input type="text" id="other_city" name="other_city" class="form-control" value="<?= $contact['other_city']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Office Province</label>
                                            <input type="text" id="primary_state" name="primary_state" class="form-control" value="<?= isset($contact['primary_state']) ? $contact['primary_state'] : $address_arr[2]; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Other Province</label>
                                            <input type="text" id="other_state" name="other_state" class="form-control" value="<?= $contact['other_state']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Office Postal Code</label>
                                            <input type="text" id="p_post" name="p_post" class="form-control" value="<?= isset($contact['primary_postal_code']) ? $contact['primary_postal_code'] : $address_arr[3]; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Other Postal Code</label>
                                            <input type="text" id="o_post" name="o_post" class="form-control" value="<?= $contact['other_postal_code']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                  <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Office Country</label>
                                            <?php echo form_dropdown('primary_country', $countries, isset($contact['primary_country']) ? $contact['primary_country'] : '1', 'id="primary_country" class="form-control"'); ?> 
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Other Country</label>
                                            <?php echo form_dropdown('other_country', $countries, isset($contact['other_country']) ? $contact['other_country'] : '1', 'id="other_country" class="form-control"'); ?> 
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>


                            <!-- /.card-body -->
                            <!-- Text area -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" id="description" placeholder="Description"><?php echo $contact['description'] ?></textarea>


                                        </div>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label></label>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success" ><?= $btn_value ? $btn_value : 'Save'; ?> </button>
                                            <button type="reset" class="btn btn-default" >Clear </button>
                                        </div>
                                    </div>
                                </div>
                            </div>                           


                        </div> 







                    </fieldset>
                </form>
                <div class="row"><div class="col-sm-10">
                        <div class="alert "  role="alert" id="results"> </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <!-- Success message -->

  <div class="row">
                    <div class="col-md-12">
                         <h3  align='center'>Alert Details</h3>
                         <?php if(isset($contact['contact_id'])){?>
                        <div class="alert "  role="alert" id="results"><?php  require_once 'alert_list.php'; ?> </div>
                         <?php } ?>
                    </div>
                </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Account Create</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 <form id="quick_account">
       <div class="row">
                                    <div class="col-sm-12">
    <label for="staticEmail" class="col-sm-4 col-form-label">Account Name</label>
    <div class="col-sm-8">
      <input type="text"  class="form-control" id="account_name" name="account_name">
    </div>
  </div>
</div>
</form>
    <div id="bw-message"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="acc_save" class="btn btn-primary" >Save </button>
      </div>
  
    </div>
  </div>
</div>
<!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";

        $('#acc_form').validate({
            rules: {
                contact_name: {
                    minlength: 2,
                    required: true
                },contact_lname: {
                    minlength: 2,
                    required: true
                },acc_id: {
                    required: true
                },
//                billing_address: {
//                    required: true,
//                }
            }, messages: {
                contact_name: {
                    required: "Please enter Contact Name",
                    minlength: "Contact Name must consist of at least 3 characters"
                },contact_lname: {
                    required: "Please enter Last Name",
                    minlength: "Last Name must consist of at least 3 characters"
                }, acc_id: {
                    required: "Please Select Account",
                    
                }
            },
            highlight: function (element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },

            submitHandler: function (form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    success: function (data)
                    {
                        //$("#company-form").hide('slow');
                        if ($.trim(data) == "success") {
                            $('#results').addClass('alert alert-success');
                            $('#results').html('Contact successfully saved');
                        } else {
                            $('#results').addClass('alert alert-danger');
                            $('#results').html('error');
                        }
                        var URL = "<?php echo base_url(); ?>contact/";
                        setTimeout(function () {
                            window.location = URL;
                        }, 1000);
                    }
                });

                return false; // required to block normal submit since you used ajax
            }

        });
    }); // end document.ready
    

    
    $('#acc_save').on('click', function(e) {
  e.preventDefault();
  $.ajax({
        url: "<?php echo base_url(); ?>account/quick_save",
        type: "POST",
        dataType: "json",
        data: {
            
            account_name: $('#account_name').val(),
           
        }
    }).done(function(msg) {
        
        $('#acc_id').append('<option value="' + msg.id + '">' + msg.name+ '</option>');
        $('#acc_id').val(msg.id);
        $('#bw-message').attr('style', 'display: initial;');
        $('#bw-msg').html(msg.msg);
        $('#exampleModal').modal('hide');
    }).fail(function(msg) {
        $('#bw-message').attr('style', 'display: initial;');
        $('#bw-msg').html(msg.msg);
    });
});
</script>
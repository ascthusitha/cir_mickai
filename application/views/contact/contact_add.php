<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');?>
<div class="content-wrapper">
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
        </div>
    </section>

    <section class="content">
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
                <form class="well form-horizontal" action="<?php echo $base_link; ?>contact/save" method="post"  id="contact_form">
                    <fieldset>
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Contact Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" id="contact_name" name="contact_name" class="form-control" placeholder="Enter ..." value="<?= isset($contact['contact_name'])?$contact['contact_name']:''; ?>">
                                            <input type="hidden" id="contact_id" name="contact_id" class="form-control" placeholder="Enter ..." value="<?= isset($contact['contact_id'])?$contact['contact_id']:''; ?>">
                                        </div>
                                    </div>
                                   <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" id="contact_lname" name="contact_lname" class="form-control" placeholder="Enter ..." value="<?= isset($contact['contact_lname'])?$contact['contact_lname']:''; ?>">
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                        <label >Account</label>
                                        <?php echo form_dropdown('acc_id', $accounts, isset($contact['acc_id']) ? $contact['acc_id'] : '0', 'id="acc_id" class="form-control"'); ?> 
                                    </div>
                                    <div class="col-sm-6">
                                        <label >Business Name</label>
                                        <input type="text" id="bussiness_name" name="bussiness_name" class="form-control" value="<?= isset($contact['bussiness_name'])?$contact['bussiness_name']:''; ?>" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Office Phone</label>
                                            <input type="text" id="office_phone" name="office_phone" class="form-control" value="<?= isset($contact['office_phone'])?$contact['office_phone']:''; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input type="text" id="mobile" name="mobile" class="form-control" value="<?= isset($contact['mobile'])?$contact['mobile']:''; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                   <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Home Phone</label>
                                            <input type="text" id="home_phone" name="home_phone" class="form-control" value="<?= isset($contact['home_phone'])?$contact['home_phone']:''; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Alternate  Phone</label>
                                            <input type="text" id="alternate_phone" name="alternate_phone" class="form-control" value="<?= isset($contact['alternate_phone'])?$contact['alternate_phone']:''; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" id="email" name="email" class="form-control" value="<?= isset($contact['email'])?$contact['email']:''; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Fax</label>
                                            <input type="text" id="fax" name="fax" class="form-control" value="<?= isset($contact['fax'])?$contact['fax']:''; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                   <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Department</label>
                                            <input type="text" id="department" name="department" class="form-control" value="<?= isset($contact['department'])?$contact['department']:''; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input type="text" id="designation" name="designation" class="form-control" value="<?= isset($contact['designation'])?$contact['designation']:'';; ?>" placeholder="Enter ...">
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
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Contact Level</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioPrimary1" name="c_level" value="1" <?php if(isset($contact['c_level'])==1) echo "checked";?>>
                                                <label for="radioPrimary1">Primary&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioPrimary2" name="c_level" value="2" <?php if(isset($contact['c_level'])==2) echo "checked";?>>
                                                <label for="radioPrimary2">Secondary&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioPrimary3" name="c_level" value="3" <?php if(isset($contact['c_level'])==3) echo "checked";?>>
                                                <label for="radioPrimary3">Normal</label>
                                            </div>
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
                                        <div class="form-group">
                                            <label>Assistant</label>
                                            <input type="text" id="assistant" name="assistant" class="form-control" value="<?= isset($contact['assistant'])?$contact['assistant']:''; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Assistant Phone</label>
                                            <input type="text" id="assistant_phone" name="assistant_phone" class="form-control" value="<?= isset($contact['assistant_phone'])?$contact['assistant_phone']:''; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>

                                <label style="text-align: center">Address Information</label><br>
                                <div class="progress progress-xs">
                                    <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        <span class="sr-only"></span>
                                    </div>
                                    <br>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Primary Address</label>
                                            <textarea id="primary_address" name="primary_address" class="form-control" placeholder="Enter ..." rows="5" cols="10"><?= isset($contact['primary_address'])?$contact['primary_address']:''; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Other Address</label>
                                            <textarea id="other_address" name="other_address" class="form-control" placeholder="Enter ..." rows="5" cols="10"><?= isset($contact['other_address'])?$contact['other_address']:''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Office City</label>
                                            <input type="text" id="primary_city" name="primary_city" class="form-control" value="<?= isset($contact['primary_city'])?$contact['primary_city']:''; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Other City</label>
                                            <input type="text" id="other_city" name="other_city" class="form-control" value="<?= isset($contact['other_city'])?$contact['other_city']:''; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Office state</label>
                                            <input type="text" id="primary_state" name="primary_state" class="form-control" value="<?= isset($contact['primary_state'])?$contact['primary_state']:''; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Other State</label>
                                            <input type="text" id="other_state" name="other_state" class="form-control" value="<?= isset($contact['other_state'])?$contact['other_state']:''; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Office Postal Code</label>
                                            <input type="text" id="p_post" name="p_post" class="form-control" value="<?= isset($contact['primary_postal_code'])?$contact['primary_postal_code']:''; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Other Postal Code</label>
                                            <input type="text" id="o_post" name="o_post" class="form-control" value="<?= isset($contact['other_postal_code'] )?$contact['other_postal_code']:''?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                  <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Office Country</label>
                                            <?php echo form_dropdown('primary_country', $countries, isset($contact['primary_country']) ? $contact['primary_country'] : '0', 'id="primary_country" class="form-control"'); ?> 
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Other Country</label>
                                            <?php echo form_dropdown('other_country', $countries, isset($contact['other_country']) ? $contact['other_country'] : '0', 'id="other_country" class="form-control"'); ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" id="description" placeholder="Description"><?php echo isset($contact['description'])?$contact['description']:''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label></label>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success" ><?= isset($btn_value) ? $btn_value : 'Save'; ?> </button>
                                            <button type="reset" class="btn btn-default" >Clear </button>
                                        </div>
                                    </div>
                                </div>
                            </div>                           
                        </div>
                    </fieldset>
                </form>
                <div class="row">
                    <div class="col-sm-10">
                        <div class="alert "  role="alert" id="results"> </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function () {
        var base_url = "<?php echo $base_link; ?>";

        $('#contact_form').validate({
            rules: {
                contact_name: {
                    minlength: 2,
                    required: true
                },acc_id: {
                    required: {
                        depends: function (element) {
                            return $("#acc_id").val()==" ";
                        }
                    }
                },
//                billing_address: {
//                    required: true,
//                }
            }, messages: {
                contact_name: {
                    required: "Please enter a First Name",
                    minlength: "First Name must consist of at least 3 characters"
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
                        var URL = "<?php echo $base_link; ?>contact/";
                        setTimeout(function () {
                            window.location = URL;
                        }, 1000);
                    }
                });

                return false; // required to block normal submit since you used ajax
            }

        });
    }); // end document.ready
</script>
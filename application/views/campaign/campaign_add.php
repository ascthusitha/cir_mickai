<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?=$title;?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Manage</a></li>
                        <li class="breadcrumb-item active"><?=$title;?></li>
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
                <h3 class="card-title"><?=$title;?></h3>

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
                <form action="<?php echo base_url(); ?>campaign/save" id="campaign-form" method="post">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="col-sm-6">
                                    <label class="control-label" for="campaign_name">Campaign Name</label>

                                    <input type="text" class="form-control" name="campaign_name" id="campaign_name"
                                        value="<?php echo isset($campaign['campaign_name']) ? $campaign['campaign_name'] : set_value(''); ?>">
                                    <input type="hidden" class="form-control" name="campaign_id" id="campaign_id"
                                        value="<?php echo $campaign['campaign_id']; ?>">

                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label" for="campaign_type">Campaign Type</label>

                                    <?php $campaign_types=['email'=>'email', 'sms'=>'sms'];
																echo form_dropdown('campaign_type', $campaign_types, isset($campaign['campaign_type']) ? $campaign['campaign_type'] : '0', 'id="campaign_type" class="form-control"'); ?>

                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label" for="message_type">Message Type</label>
                                    <?php $message_types=['daily'=>'daily', 'once'=>'once'];
																echo form_dropdown('message_type', $message_types, isset($campaign['message_type']) ? $campaign['message_type'] : '0', 'id="message_type" class="form-control"'); ?>

                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label" for="start_date">Start Date</label>
                                    <input type="text" class="form-control datepicker" name="start_date" id="start_date"
                                        value="<?php echo isset($campaign['start_date']) ? $campaign['start_date'] : set_value(''); ?>"
                                        autocomplete="off">
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label" for="end_date">End Date</label>

                                    <input type="text" class="form-control datepicker" name="end_date" id="end_date"
                                        value="<?php echo isset($campaign['end_date']) ? $campaign['end_date'] : set_value(''); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label" for="status">Status</label>
                                    <?php $status=['active'=>'Active', 'inactive'=>'Inactive', ];
																echo form_dropdown('status', $status, isset($campaign['status']) ? $campaign['status'] : '0', 'id="status" class="form-control"'); ?>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-sm-6">
                                    <label class="control-label" for="message">Message</label>
                                    <textarea class="form-control" name="message" id="message1" rows="10" cols="6"
                                        required>
                                        <?php echo isset($campaign['message']) ? $campaign['message'] : set_value(''); ?></textarea>


                                </div>
                            </div>
                            <div class="col-sm-12">

                                <div class="col-sm-4">
                                    <br>
                                    <input type="submit" class="btn btn-success"
                                        value="<?php echo isset($btn_value) ? $btn_value : 'Save'; ?>">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <!--  results  here -->
                <br>
                <div id="results"></div>
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
$(document).ready(function() {
    var base_url = "<?php echo base_url(); ?>";

    $('#campaign-form').validate({
        rules: {
            campaign_name: {
                required: true
            },
            start_date: {
                required: true
            },
            end_date: {
                required: true
            },
            message: {
                required: true,
                minlength: 5
            },
        },
        messages: {
            campaign_name: {
                required: "Please enter campaign name",
            },
            start_date: {
                required: "Please Select Start Date",
            },
            end_date: {
                required: "Please Select End Date",
            },
            message: {
                required: "Please Enter Message",
            },
        },

        submitHandler: function(form) {
            $.ajax({
                type: $(form).attr('method'),
                url: $(form).attr('action'),
                data: $(form).serialize(),
                success: function(data) {
                    //$("#user-form").hide('slow');
                    if (data == "success") {
                        $('#results').removeClass('alert alert-danger');
                        $('#results').addClass('alert alert-success');
                        $('#results').html('campaign successfully saved');
                        var URL = "<?php echo base_url(); ?>campaign/";
                        setTimeout(function() {
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



    //startdate 
    $("#start_date").datepicker({
        //defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,

        numberOfMonths: 1,
        dateFormat: 'dd-M-y',
        beforeShow: function() {
            $(".ui-datepicker").css('font-size', 12)
        }
    });

    //enddate 
    $("#end_date").datepicker({
        //defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,

        numberOfMonths: 1,
        dateFormat: 'dd-M-y',
        beforeShow: function() {
            $(".ui-datepicker").css('font-size', 12)
        }
    });
}); // end document.ready
</script>
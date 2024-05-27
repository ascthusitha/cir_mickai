<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?=$title1;?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Activities</a></li>
                        <li class="breadcrumb-item active"><?=$title1;?></li>
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
                <form class="well form-horizontal" action="<?php echo $base_link; ?>sales_call/save" method="post"  id="sales_call_form">
                    <fieldset>




                        <div class="card card-secondary">
                          
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter ..." value="<?= $sales_call['subject']; ?>">
                                            <input type="hidden" id="sc_id" name="sc_id" class="form-control" placeholder="Enter ..." value="<?= $sales_call['sc_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Account Name</label>
                                            <?php echo form_dropdown('acc_id', $accounts, isset($sales_call['acc_id']) ? $sales_call['acc_id'] : '0', 'id="acc_id" class="form-control"'); ?> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="text" id="start_date" name="start_date" class="form-control datepicker" value="<?= $sales_call['start_date']; ?>" placeholder="Enter ..." autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <input type="text" id="start_time" name="start_time" class="form-control timepicker" value="<?= $sales_call['start_time']; ?>" placeholder="Enter ..." autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label >Product 1</label>
                                        <?php echo form_dropdown('product_id1', $products, isset($sales_call['product_id1']) ? $sales_call['product_id1'] : '0', 'id="product_id1" class="form-control"'); ?> 
                                    </div>
                                    <div class="col-sm-6">
                                        <label >Product 2</label>
                                        <?php echo form_dropdown('product_id2', $products, isset($sales_call['product_id2']) ? $sales_call['product_id2'] : '0', 'id="product_id2" class="form-control"'); ?> 
                                    </div>
                                </div>
                             
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Assign To</label>
                                            <?php echo form_dropdown('assign_to', $users, isset($sales_call['assign_to']) ? $sales_call['assign_to'] : '0', 'id="assign_to" class="form-control"'); ?> 
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Contact</label>
                                            <?php echo form_dropdown('contact_id', $contacts, isset($sales_call['contact_id']) ? $sales_call['contact_id'] : '0', 'id="contact_id" class="form-control"'); ?> 
                                        </div>
                                    </div>
                                </div>
                                
                                
                                </div>
                                <!-- /.card-body -->
                   


                            <!-- /.card-body -->
                            <!-- Text area -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" id="description" placeholder="Description"><?php echo $sales_call['description'] ?></textarea>


                                        </div>
                                    </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                    
 <?php $status_list=['Scheduled','Completed'];echo form_dropdown('current_status', $status_list, isset($sales_call['current_status']) ? $sales_call['current_status'] : '0', 'id="current_status" class="form-control"'); ?> 

                                        </div>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="row">
                                    <div class="col-sm-6">
                                
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


        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";

        $('#sales_call_form').validate({
            rules: {
                subject: {
                    minlength: 2,
                    required: true
                },acc_id: {
                    required: true
                }, start_date: {
                    
                    required: true
                },
//                billing_address: {
//                    required: true,
//                }
            }, messages: {
                subject: {
                    required: "Please enter a Subject",
                    
                }, acc_id: {
                    required: "Please Select Account",
                    
                }, start_date: {
                    required: "Please enter a Start Date",
                    
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
                            $('#results').html('Meeting successfully schedued');
                        } else {
                            $('#results').addClass('alert alert-danger');
                            $('#results').html('error');
                        }
                        var URL = "<?php echo base_url(); ?>sales_call/";
                        setTimeout(function () {
                            window.location = URL;
                        }, 1000);
                    }
                });

                return false; // required to block normal submit since you used ajax
            }

        });

        //date 
        $("#start_date").datepicker({
            //defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            
            numberOfMonths: 1,
            dateFormat: 'dd-M-y',
            beforeShow: function () {
                $(".ui-datepicker").css('font-size', 12)
            }
        });

        $('#start_time').timepicker({
            timeFormat: 'h:mm p',
            interval: 15,
            minTime: '10',
            maxTime: '6:00pm',
            defaultTime: '11',
            startTime: '10:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    }); // end document.ready
</script>
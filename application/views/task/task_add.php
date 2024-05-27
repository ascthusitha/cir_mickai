<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Task Schedule</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Activities</a></li>
                        <li class="breadcrumb-item active">Task Schedule</li>
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
                <form class="well form-horizontal" action="<?php echo $base_link; ?>task_detail/save" method="post"  id="task_form">
                    <fieldset>




                        <div class="card card-secondary">
                          
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Task</label>
                                            <?php //echo form_dropdown('task_id', $tasks, isset($task['task_id']) ? $task['task_id'] : '0', 'id="task_id" class="form-control"'); ?> 
                                             <input type="text" id="task_id" name="task_id" class="form-control" placeholder="Enter ..." value="<?= $task['task_id']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter ..." value="<?= $task['subject']; ?>">
                                            <input type="hidden" id="td_id" name="td_id" class="form-control" placeholder="Enter ..." value="<?= $task['td_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Account Name</label>
                                            <?php echo form_dropdown('acc_id', $accounts, isset($task['acc_id']) ? $task['acc_id'] : '0', 'id="acc_id" class="form-control"'); ?> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="text" id="start_date" name="start_date" class="form-control datepicker" value="<?= $task['start_date']; ?>" placeholder="Enter ..." autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <input type="text" id="start_time" name="start_time" class="form-control timepicker" value="<?= $task['start_time']; ?>" placeholder="Enter ..." autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="text" id="end_date" name="end_date" class="form-control datepicker" value="<?= $task['end_date']; ?>" placeholder="Enter ..." autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <input type="text" id="end_time" name="end_time" class="form-control timepicker" value="<?= $task['end_time']; ?>" placeholder="Enter ..." autocomplete="off">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label >Product 1</label>
                                        <?php echo form_dropdown('product_id1', $products, isset($task['product_id1']) ? $task['product_id1'] : '0', 'id="product_id1" class="form-control"'); ?> 
                                    </div>
                                    <div class="col-sm-6">
                                        <label >Product 2</label>
                                        <?php echo form_dropdown('product_id2', $products, isset($task['product_id2']) ? $task['product_id2'] : '0', 'id="product_id2" class="form-control"'); ?> 
                                    </div>
                                </div>
                             
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Assign To</label>
                                            <?php echo form_dropdown('assign_to', $users, isset($task['assign_to']) ? $task['assign_to'] : '0', 'id="assign_to" class="form-control"'); ?> 
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Contact</label>
                                            <?php echo form_dropdown('contact_id', $contacts, isset($task['contact_id']) ? $task['contact_id'] : '0', 'id="contact_id" class="form-control"'); ?> 
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
                                            <textarea class="form-control" name="description" id="description" placeholder="Description"><?php echo $task['description'] ?></textarea>


                                        </div>
                                    </div>
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                    
 <?php $status_list=['Scheduled','Completed'];echo form_dropdown('current_status', $status_list, isset($task['current_status']) ? $task['current_status'] : '0', 'id="current_status" class="form-control"'); ?> 

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

        $('#task_form').validate({
            rules: {
                subject: {
                    minlength: 2,
                    required: true
                },task_id: {
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
                    
                },task_id: {
                    required: "Please enter task",
                    
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
                            $('#results').html('Task successfully scheduled');
                        } else {
                            $('#results').addClass('alert alert-danger');
                            $('#results').html('error');
                        }
                        var URL = "<?php echo base_url(); ?>task_detail/";
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
        $("#end_date").datepicker({
            //defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            
            numberOfMonths: 1,
            dateFormat: 'dd-M-y',
            beforeShow: function () {
                $(".ui-datepicker").css('font-size', 12)
            }
        });
        $('#start_time,#end_time').timepicker({
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
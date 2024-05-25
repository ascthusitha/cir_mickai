<?php
  $base_link = $this->config->item('base_url').$this->config->item('index_page');
  $permissionData = $this->session->userdata['permissionData'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Alert/Reminder Schedule</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Activities</a></li>
                        <li class="breadcrumb-item active">Alert/Reminder Schedule</li>
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
                                        <label >Product</label>
                                        <select id="product_id" name="product_id" class="chosen-select form-control text-tip" title="Product">
                                            <option value="0"> [ Please Select ] </option>
                                            <?php
                                                foreach ($products as $product) {
                                                    if($product->id == $task['product_id']){
                                                        echo "<option value='".$product->id."' selected='selected'>".$product->name."</option>";
                                                    }else{
                                                        echo "<option value='".$product->id."'>".$product->name."</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Physician Name</label>
                                            <select id="acc_id" name="acc_id" class="chosen-select form-control text-tip" title="Account Name">
                                                <option value=""> [ Please Select ] </option>
                                                <?php
                                                    foreach ($accounts as $key=>$account) {
                                                        if($key == $task['acc_id']){
                                                            echo "<option value='".$key."' selected='selected'>".$account."</option>";
                                                        }else{
                                                            echo "<option value='".$key."'>".$account."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Alert/Reminder</label>
                                            <select id="task_id" name="task_id" class="chosen-select form-control text-tip" title="Task">
                                                <option value=""> [ Please Select ] </option>
                                                <?php
                                                    foreach ($subjects as $subject) {
                                                        if($subject->id == $task['task_id']){
                                                            echo "<option value='".$subject->id."' selected='selected'>".$subject->name."</option>";
                                                        }else{
                                                            echo "<option value='".$subject->id."'>".$subject->name."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <input type="hidden" id="td_id" name="td_id" class="form-control" placeholder="Enter ..." value="<?= isset($task['td_id'])? $task['td_id']:''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select id="current_status" name="current_status" class="chosen-select form-control text-tip" title="Status">
                                                <option value=""> [ Please Select ] </option>
                                                <?php
                                                    foreach ($stats as $stat) {
                                                        if($stat->id == $task['current_status']){
                                                            echo "<option value='".$stat->id."' selected='selected'>".$stat->name."</option>";
                                                        }else{
                                                            echo "<option value='".$stat->id."'>".$stat->name."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="text" id="start_date" name="start_date" class="form-control datepicker" value="<?= isset($task['start_date'])?$task['start_date']:''; ?>" placeholder="Enter ..." autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <input type="text" id="start_time" name="start_time" class="form-control timepicker" value="<?= isset($task['start_time'])?$task['start_time']:''; ?>" placeholder="Enter ..." autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="text" id="end_date" name="end_date" class="form-control datepicker" value="<?= isset($task['end_date'])?$task['end_date']:''; ?>" placeholder="Enter ..." autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <input type="text" id="end_time" name="end_time" class="form-control timepicker" value="<?= isset($task['end_time'])?$task['end_time']:''; ?>" placeholder="Enter ..." autocomplete="off">
                                        </div>

                                    </div>
                                </div>
                             
                                <div class="row">
                                    <?php if (in_array(40, $permissionData)) { ?>
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Assign To</label>
                                            <select id="assign_to" name="assign_to" class="chosen-select form-control text-tip" title="Assign To">
                                                <option value=""> [ Please Select ] </option>
                                                <?php
                                                    foreach ($users as $key=>$user) {
                                                        if($key == $task['assign_to']){
                                                            echo "<option value='".$key."' selected='selected'>".$user."</option>";
                                                        }else{
                                                            echo "<option value='".$key."'>".$user."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Patient</label>
                                            <select id="contact_id" name="contact_id" class="chosen-select form-control text-tip" title="Contact">
                                                <option value=""> [ Please Select ] </option>
                                                <?php
                                                    foreach ($contacts as $key=>$contact) {
                                                        if($key == $task['contact_id']){
                                                            echo "<option value='".$key."' selected='selected'>".$contact."</option>";
                                                        }else{
                                                            echo "<option value='".$key."'>".$contact."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
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
                                            <textarea class="form-control" name="description" id="description" placeholder="Description"><?php echo isset($task['description'])?$task['description']:''; ?></textarea>


                                        </div>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="row">
                                    <div class="col-sm-6">
                                
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
<script>
  $(function () {
    var base_url = "<?php echo $base_link; ?>";
    $( "#acc_id" ).change(function() {
        acc_id = this.value;
        $("#contact_id").html('');
        $.ajax({
            type: 'POST',
            url: base_url + 'contact/get_contact_dropdown/',
            data: {acc_id: acc_id},
            success: function (response) {
                $("#contact_id").append("<option value='' > [ Please Select ] </option>");
                var obj = jQuery.parseJSON(response);
                $.each(obj, function(key,value) {
                    $("#contact_id").append("<option value="+key+">"+value+"</option>");
                }); 
            }
        });
    });
  })
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";

        $('#task_form').validate({
            rules: {
                subject: {
                    minlength: 2,
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
                            $('#results').html('Alert/Reminder successfully schedued');
                        } else {
                            $('#results').addClass('alert alert-danger');
                            $('#results').html('error');
                        }
                        var URL = "<?php echo $base_link; ?>task_detail/";
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
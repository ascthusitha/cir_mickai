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
                    <h1>External Appointment Schedule</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Activities</a></li>
                        <li class="breadcrumb-item active">External Appointment Schedule</li>
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
                                            <select id="subject" name="subject" class="chosen-select form-control text-tip" title="Subject">
                                                <option value=""> [ Please Select ] </option>
                                                <?php
                                                    foreach ($subjects as $subject) {
                                                        if($subject->id == $sales_call['subject']){
                                                            echo "<option value='".$subject->id."' selected='selected'>".$subject->name."</option>";
                                                        }else{
                                                            echo "<option value='".$subject->id."'>".$subject->name."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <input type="hidden" id="sc_id" name="sc_id" class="form-control" placeholder="Enter ..." value="<?= isset($sales_call['sc_id'])?$sales_call['sc_id']:''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Account Name</label>
                                            <select id="acc_id" name="acc_id" class="chosen-select form-control text-tip" title="Account Name">
                                                <option value=""> [ Please Select ] </option>
                                                <?php
                                                    foreach ($accounts as $key=>$account) {
                                                        if($key == $sales_call['acc_id']){
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
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="text" id="start_date" name="start_date" class="form-control datepicker" value="<?= isset($sales_call['start_date'])?$sales_call['start_date']:''; ?>" placeholder="Enter ..." autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <input type="text" id="start_time" name="start_time" class="form-control timepicker" value="<?= isset($sales_call['start_time'])?$sales_call['start_time']:''; ?>" placeholder="Enter ..." autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="text" id="end_date" name="end_date" class="form-control datepicker" value="<?= isset($sales_call['end_date'])?$sales_call['end_date']:''; ?>" placeholder="Enter ..." autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <input type="text" id="end_time" name="end_time" class="form-control timepicker" value="<?= isset($sales_call['end_time'])?$sales_call['end_time']:''; ?>" placeholder="Enter ..." autocomplete="off">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Location</label>
                                            <input type="text" id="location" name="location" class="form-control datepicker" value="<?= isset($sales_call['location'])?$sales_call['location']:''; ?>" placeholder="Enter ..." autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select id="current_status" name="current_status" class="chosen-select form-control text-tip" title="Status">
                                                <option value=""> [ Please Select ] </option>
                                                <?php
                                                    foreach ($stats as $stat) {
                                                        if($stat->id == $sales_call['current_status']){
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
                                        <label >Product 1</label>
                                        <select id="product_id1" name="product_id1" class="chosen-select form-control text-tip" title="Product 1">
                                            <option value="0"> [ Please Select ] </option>
                                            <?php
                                                foreach ($products as $product) {
                                                    if($product->id == $sales_call['product_id1']){
                                                        echo "<option value='".$product->id."' selected='selected'>".$product->name."</option>";
                                                    }else{
                                                        echo "<option value='".$product->id."'>".$product->name."</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label >Product 2</label>
                                        <select id="product_id2" name="product_id2" class="chosen-select form-control text-tip" title="Product 2">
                                            <option value="0"> [ Please Select ] </option>
                                            <?php
                                                foreach ($products as $product) {
                                                    if($product->id == $sales_call['product_id2']){
                                                        echo "<option value='".$product->id."' selected='selected'>".$product->name."</option>";
                                                    }else{
                                                        echo "<option value='".$product->id."'>".$product->name."</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
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
                                                        if($key == $sales_call['assign_to']){
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
                                            <label>Contact</label>
                                            <select id="contact_id" name="contact_id" class="chosen-select form-control text-tip" title="Contact">
                                                <option value=""> [ Please Select ] </option>
                                                <?php
                                                    foreach ($contacts as $key=>$contact) {
                                                        if($key == $sales_call['contact_id']){
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
                                            <textarea class="form-control" name="description" id="description" placeholder="Description"><?php echo isset($sales_call['description'])?$sales_call['description']:'' ?></textarea>


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

        $('#sales_call_form').validate({
            rules: {
                subject: {
                    required: true
                }, start_date: {
                    required: true
                }
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
                            $('#results').html('External Appointment successfully schedued');
                        } else {
                            $('#results').addClass('alert alert-danger');
                            $('#results').html('error');
                        }
                        var URL = "<?php echo $base_link; ?>sales_call/";
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
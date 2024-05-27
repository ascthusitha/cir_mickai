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
                    <h1>Time Sheet</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Activities</a></li>
                        <li class="breadcrumb-item active">Time Sheet</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <form class="well form-horizontal" action="<?php echo $base_link; ?>time_sheet/save" method="post"  id="timesheet_form">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" id="ts_name" name="ts_name" class="form-control" placeholder="Enter ..." value="<?= isset($time_sheet['ts_name'])?$time_sheet['ts_name']:''; ?>">
                            </div>
                            <div class="form-group">
                                <label>Physician Name</label>
                                <select id="acc_id" name="acc_id" class="chosen-select form-control text-tip" title="Account Name">
                                    <option value=""> [ Please Select ] </option>
                                    <?php
                                        foreach ($accounts as $key=>$account) {
                                            if($key == $time_sheet['acc_id']){
                                                echo "<option value='".$key."' selected='selected'>".$account."</option>";
                                            }else{
                                                echo "<option value='".$key."'>".$account."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <input type="hidden" id="ts_id" name="ts_id" value="<?= isset($time_sheet['ts_id'])?$time_sheet['ts_id']:''; ?>">
                            <input type="hidden" id="tt_id" name="tt_id" value="<?= isset($time_sheet['timer'])?$time_sheet['timer']:''; ?>">
                            <div class="form-group">
                                <label >Product</label>
                                <select id="product_id" name="product_id" class="chosen-select form-control text-tip" title="Product">
                                    <option value="0"> [ Please Select ] </option>
                                    <?php
                                        foreach ($products as $product) {
                                            if($product->id == $time_sheet['product_id']){
                                                echo "<option value='".$product->id."' selected='selected'>".$product->name."</option>";
                                            }else{
                                                echo "<option value='".$product->id."'>".$product->name."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Patient Name</label>
                                <select id="contact_id" name="contact_id" class="chosen-select form-control text-tip" title="Contact">
                                    <option value=""> [ Please Select ] </option>
                                    <?php
                                        foreach ($contacts as $key=>$contact) {
                                            if($key == $time_sheet['contact_id']){
                                                echo "<option value='".$key."' selected='selected'>".$contact."</option>";
                                            }else{
                                                echo "<option value='".$key."'>".$contact."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select id="current_status" name="current_status" class="chosen-select form-control text-tip" title="Status">
                                    <option value=""> [ Please Select ] </option>
                                    <?php
                                        foreach ($stats as $stat) {
                                            if($stat->id == $time_sheet['current_status']){
                                                echo "<option value='".$stat->id."' selected='selected'>".$stat->name."</option>";
                                            }else{
                                                echo "<option value='".$stat->id."'>".$stat->name."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <?php if (in_array(40, $permissionData)) { ?>
                            <div class="form-group">
                                <label>Assign To</label>
                                <select id="assign_to" name="assign_to" class="chosen-select form-control text-tip" title="Assign To">
                                    <option value=""> [ Please Select ] </option>
                                    <?php
                                        foreach ($users as $key=>$user) {
                                            if($key == $time_sheet['assign_to']){
                                                echo "<option value='".$key."' selected='selected'>".$user."</option>";
                                            }else{
                                                echo "<option value='".$key."'>".$user."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Description"><?php echo isset($time_sheet['description'])?$time_sheet['description']:'' ?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <label>Project Progress</label>
                                    <input id="progress" type="text" name="progress" value="<?php echo isset($time_sheet['progress'])?$time_sheet['progress']:'';?>">
                                </div>
                            </div>
                            <?php
                                if(!empty($time_sheet)){
                                    $this->load->view('time_sheet/time_tracker');
                                    $this->load->view('time_sheet/time_history');
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success" ><?= isset($btn_value) ? $btn_value : 'Save'; ?> </button>
                    <button type="reset" class="btn btn-default" >Clear </button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-primary" style="z-index: 2000;">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus"></i> Add Time</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="text" id="start_date" name="start_date" class="form-control datepicker" value="" placeholder="Enter ..." autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Start Time</label>
                            <input type="text" id="start_time" name="start_time" class="form-control timepicker" value="" placeholder="Enter ..." autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="text" id="end_date" name="end_date" class="form-control datepicker" value="" placeholder="Enter ..." autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>End Time</label>
                            <input type="text" id="end_time" name="end_time" class="form-control timepicker" value="" placeholder="Enter ..." autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-light" id="btn_save_time">Save</button>
            </div>
        </div>
    </div>
</div>

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
        $(".ui-timepicker-standard").css("z-index", "999999999 !important");
        var base_url = "<?php echo base_url(); ?>";
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('#timesheet_form').validate({
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
                    success: function (data) {
                        if ($.trim(data) != "error") {
                            Toast.fire({
                                icon: 'success',
                                title: ' Time Sheet successfully updated'
                            });
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: ' Time Sheet Error'
                            });
                        }
                        var URL = "<?php echo $base_link; ?>time_sheet/view/"+data;
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
            dateFormat: 'yy-mm-dd',
            beforeShow: function () {
                $(".ui-datepicker").css('font-size', 12)
            }
        });
        $("#end_date").datepicker({
            //defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd',
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
            scrollbar: true,
            beforeShow: function () {
                $(".ui-timepicker-standard").css("z-index", "999999999 !important");
            }
        });
   
    }); // end document.ready





</script>

<script>
  $(function () {

    $('#progress').ionRangeSlider({
      min     : 0,
      max     : 100,
      type    : 'single',
      step    : 1,
      postfix : ' %',
      prettify: false,
      hasGrid : true
    })
  
  })

  $( document ).ready(function() {

    $( "#btn_save_time" ).click(function() {
        var base_url = "<?php echo $base_link; ?>";
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        var ts_id = $('#ts_id').val();
        var start_date = jQuery('#start_date').val();
        var start_time = jQuery('#start_time').val();
        var end_date = jQuery('#end_date').val();
        var end_time = jQuery('#end_time').val();
        var source = '1';
        $.ajax({
            type: 'POST',
            url: base_url + 'time_sheet/add_manual_time/',
            data: {'ts_id': ts_id,'start_date':start_date,'start_time':start_time,'end_date':end_date,'end_time':end_time,'source':source},
            success: function (response) {
                $('#tt_id').val(response);
                Toast.fire({
                    icon: 'success',
                    title: ' Time Added'
                });
                var URL = "<?php echo $base_link; ?>time_sheet/view/"+ts_id;
                setTimeout(function () {
                    window.location = URL;
                }, 1000);
            }
        });
    });
    
    $( "#btn_stop" ).click(function() {
        var hours = jQuery('#countdown #hour').html();
        var min = jQuery('#countdown #min').html();
        var sec = jQuery('#countdown #sec').html();
        stop_time(hours,min,sec);
        if((hours + '').length == 1){
            hours = '0' + hours;
        }
        if((min + '').length == 1){
            min = '0' + min;
        }
        if((sec + '').length == 1){
            sec = '0' + sec;
        }
        jQuery('#countdown_x #hour_x').html(hours);
        jQuery('#countdown_x #min_x').html(min);
        jQuery('#countdown_x #sec_x').html(sec);
        $(".active_timer").hide();
        $(".fixed_time").show();
    });

    $( "#btn_start" ).click(function() {
        var hours = jQuery('#countdown_x #hour_x').html();
        var min = jQuery('#countdown_x #min_x').html();
        var sec = jQuery('#countdown_x #sec_x').html();
        start_time();
        if((hours + '').length == 1){
            hours = '0' + hours;
        }
        if((min + '').length == 1){
            min = '0' + min;
        }
        if((sec + '').length == 1){
            sec = '0' + sec;
        }
        jQuery('#countdown #hour').html(hours);
        jQuery('#countdown #min').html(min);
        jQuery('#countdown #sec').html(sec);
        $(".fixed_time").hide();
        $(".active_timer").show();
    });

    function start_time(){
        var base_url = "<?php echo $base_link; ?>";
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        var ts_id = $('#ts_id').val();
        var user_id = $('#user_id').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'time_sheet/start_time/',
            data: {'ts_id': ts_id},
            success: function (response) {
                $('#tt_id').val(response);
                Toast.fire({
                    icon: 'success',
                    title: ' Time Tracker Started'
                });
                var URL = "<?php echo $base_link; ?>time_sheet/view/"+ts_id;
                setTimeout(function () {
                    window.location = URL;
                }, 1000);
            }
        });
    }

    function stop_time(hours,min,sec){
        var base_url = "<?php echo $base_link; ?>";
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        var ts_id = $('#ts_id').val();
        var tt_id = $('#tt_id').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'time_sheet/stop_time/',
            data: {'ts_id': ts_id,'tt_id':tt_id, 'hours': hours, 'min': min, 'sec': sec},
            success: function (response) {
                $('#tt_id').val(0);
                Toast.fire({
                    icon: 'success',
                    title: ' Time Tracker Stopped'
                });
                var URL = "<?php echo $base_link; ?>time_sheet/view/"+ts_id;
                setTimeout(function () {
                    window.location = URL;
                }, 1000);
            }
        });
    }

    setInterval(function time(){
        var hours = parseInt(jQuery('#countdown #hour').html());
        var min = parseInt(jQuery('#countdown #min').html());
        var sec = parseInt(jQuery('#countdown #sec').html())+1;
        if(sec==60){
            sec = 0;
            min = min+1;
        }
        if(min==60){
            min = 0;
            hours = hours+1;
        }
        if((hours + '').length == 1){
            hours = '0' + hours;
        }
        if((min + '').length == 1){
            min = '0' + min;
        }
        if((sec + '').length == 1){
            sec = '0' + sec;
        }
        jQuery('#countdown #hour').html(hours);
        jQuery('#countdown #min').html(min);
        jQuery('#countdown #sec').html(sec);
    }, 1000); });
</script>


<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">My Profile</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="card card-solid">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-8 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">User Name: <?php echo $my_profile['user_username'];?></div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b><?php echo $my_profile['user_fname'].' '.$my_profile['user_lname'];?></b></h2>
                                        <p class="text-muted text-sm"><b>Date of Birth: </b> <?php echo $my_profile['dob'];?> </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: <?php echo $my_profile['user_email'];?></li>
                                            <hr>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mobile-alt"></i></span> Mobile #: <?php echo $my_profile['user_mobile'];?></li>
                                            <hr>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: <?php echo $my_profile['user_phone'];?></li>
                                            <hr>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $my_profile['user_address'];?></li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                    <p class="text-muted text-sm"><b>User Code: </b> <?php echo $my_profile['user_code'];?> </p>
                                        <img src="<?php echo base_url(); ?>assets/dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="<?php echo $base_link.'settings/edit_profile';?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Edit Profile
                                    </a>
                                    <a href="<?php echo $base_link.'settings/change_password';?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-key"></i> Change Password
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                            $('#results').html('Sales call successfully schedued');
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
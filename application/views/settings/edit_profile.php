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
        <div class="card">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-4 d-flex align-items-stretch flex-column text-center">
                        <div class="card bg-light d-flex">
                            <div class="card-header text-muted border-bottom-0">User Name: <?php echo $my_profile['user_username'];?></div>
                            <div class="card-body pt-0">
                                <img src="<?php echo base_url(); ?>assets/dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
                                <p class="text-muted text-sm"><b>User Code: </b> <?php echo $my_profile['user_code'];?> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-8 col-md-8">
                        <form action="<?php echo $base_link; ?>settings/updateUser" id="user-form"  method="post">
                            <div class="card">
                                <div class="card-body pt-0">
                                    <fieldset>
                                        <div class="col-sm-12">
                                            <div class="col-sm-6">
                                                <label for="fname" class="wb-inv">First Name</label>
                                                <input type="text" class="form-control" name="fname" id="fname" value="<?php echo isset($my_profile['user_fname']) ? $my_profile['user_fname'] : set_value('user_fname'); ?>">
                                                <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $my_profile['user_id']; ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="lname" class="wb-inv">Last Name</label>
                                                <input type="text" class="form-control" name="lname" id="lname" value="<?php echo isset($my_profile['user_lname']) ? $my_profile['user_lname'] : set_value('user_lname'); ?>">
                                            </div>

                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-6">
                                                <label class="wb-inv" for="email">Email Address</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="email" id="email" value="<?php echo isset($my_profile['user_email']) ? $my_profile['user_email'] : set_value('user_email'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="wb-inv" for="dob">Date of Birth</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="dob" id="dob" value="<?php echo isset($my_profile['dob']) ? $my_profile['dob'] : set_value('dob'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    
                                        
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">

                                                <label class="control-label" for="mobile">Mobile</label>

                                                <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo isset($my_profile['user_mobile']) ? $my_profile['user_mobile'] : set_value('user_mobile'); ?>">

                                            </div>
                                            <div class="col-sm-3">
                                                <label class="wb-inv" for="telephone">Telephone</label>

                                                <input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo isset($my_profile['user_telephone']) ? $my_profile['user_telephone'] : set_value('user_telephone'); ?>">

                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="col-sm-6">
                                                <label class="wb-inv" for="address">Address</label>

                                                <textarea class="form-control" name="address" id="address" rows="3" value=""><?php echo isset($my_profile['user_address']) ? $my_profile['user_address'] : set_value('user_address'); ?></textarea>

                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-6"><br>

                                                
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <input type="submit" class="btn btn-sm btn-primary" value="<?php echo isset($btn_value) ? $btn_value : 'Update'; ?>">
                                    </div>
                                </div>
                            </div>
                        </form>
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
        var base_url = "<?php echo $base_link; ?>";

        $('#user-form').validate({
            rules: {
                fname: {
                    minlength: 2,
                    required: true
                },
                lname: {
                    minlength: 2,
                    required: true
                },
                email: {
                    required: true,
                    email: true
                }
            }, messages: {
                email: "Please enter a valid email address",
            },
            highlight: function (element) {
                $(element).closest('.form-control').removeClass('success').addClass('error');
            },
            success: function (element) {
                element.text('').addClass('valid').closest('.form-control').removeClass('error').addClass('success');
            },
            submitHandler: function (form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    success: function (data)
                    {
                        //$("#user-form").hide('slow');
                        if ($.trim(data) == "success") {
                            $('#results').removeClass('alert alert-danger');
                            $('#results').addClass('alert alert-success');
                            $('#results').html('User successfully saved');
                            var URL = "<?php echo $base_link; ?>settings/profile";
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
        $("#dob").datepicker({
            //defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd',
            beforeShow: function () {
                $(".ui-datepicker").css('font-size', 12)
            }
        });


    }); // end document.ready
</script>

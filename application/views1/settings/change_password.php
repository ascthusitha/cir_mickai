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
                            <h2 class="card-header text-muted border-bottom-0 lead"><b><?php echo $my_profile['user_fname'].' '.$my_profile['user_lname'];?></b></h2>
                            <div class="card-body pt-0">
                                <img src="<?php echo base_url(); ?>assets/dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
                                <div class="card-header text-muted border-bottom-0">User Name: <?php echo $my_profile['user_username'];?></div>
                                <p class="text-muted text-sm"><b>User Code: </b> <?php echo $my_profile['user_code'];?> </p>
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
                        </div>
                    </div>
                    <div class="col-12 col-sm-8 col-md-8">
                        <form action="<?php echo $base_link; ?>settings/updatePassword" id="user-form"  method="post">
                            <div class="card">
                                <div class="card-body pt-0">
                                    <fieldset>
                                        <div class="col-sm-12">
                                            <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $my_profile['user_id']; ?>">
                                            <div class="col-sm-4">
                                                <label class="wb-inv" for="password">Password</label>
                                                <input type="password" class="form-control" name="password" id="password" value="">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="wb-inv" for="cpassword">Confirm Password</label>
                                                <input type="password" class="form-control" name="cpassword" id="cpassword" value="">
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
                password: {
                    minlength: 2,
                    required: <?php echo empty($agent['user_password']) ? 'true' : 'false'; ?>
                },
                cpassword: {
                    equalTo: "#password",
                    minlength: 2,
                    required: <?php echo empty($agent['user_password']) ? 'true' : 'false'; ?>
                }
            }, messages: {
                password: {
                    required: "Please enter a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                cpassword: {
                    required: "Please enter a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Confrim password not matched with password"
                },
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
    }); // end document.ready
</script>

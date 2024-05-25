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
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
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
          <h3 class="card-title"><?=$title;?> List</h3>

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
                    <form action="<?php echo base_url(); ?>user/saveUser" id="user-form"  method="post">
                        <fieldset>
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label class="wb-inv" for="u_code">User Code</label>
                                    <input type="text" class="form-control" name="u_code" id="u_code" value="<?php echo isset($user1['user_code']) ? $user1['user_code'] : $u_code; ?>">
                                </div>
                            </div>
                            <div class="col-sm-12">

                                <div class="col-sm-4">
                                    <label class="control-label" for="user_group">User Group</label>
                                    <?php 
                                    $disable='disabled"=""';
                                    echo form_dropdown('user_group', $user_groups, isset($user1['user_group_id']) ? $user1['user_group_id'] : '1', 'id="user_group" class="form-control"'); ?> 
                                    <input type="hidden" name="user_group_id" id="user_group_id" value="<?php echo $user1['user_group_id']; ?>">

                                </div>

                            </div>

                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label for="fname" class="wb-inv">First Name</label>
                                    <input type="text" class="form-control" name="fname" id="fname" value="<?php echo isset($user1['user_fname']) ? $user1['user_fname'] : set_value('user_fname'); ?>">
                                    <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $user1['user_id']; ?>">
                                </div>
                                <div class="col-sm-4">
                                    <label for="lname" class="wb-inv">Last Name</label>
                                    <input type="text" class="form-control" name="lname" id="lname" value="<?php echo isset($user1['user_lname']) ? $user1['user_lname'] : set_value('user_lname'); ?>">
                                </div>

                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label class="wb-inv" for="email">Email Address</label>
                                    <div class="controls">
                                        <input type="text" class="form-control" name="email" id="email" value="<?php echo isset($user1['user_email']) ? $user1['user_email'] : set_value('user_email'); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="wb-inv" for="dob">Date of Birth</label>
                                    <div class="controls">
                                        <input type="text" class="form-control" name="dob" id="dob" value="<?php echo isset($user1['dob']) ? $user1['dob'] : set_value('dob'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label class="wb-inv" for="username">Username</label>
                                    <div class="controls">
                                        <input type="text" class="form-control" name="username" id="username" value="<?php echo isset($user1['user_username']) ? $user1['user_username'] : set_value('user_username'); ?>">
                                        <span id="user-result"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-4">

                                    <label class="wb-inv" for="password">Password</label>

                                    <input type="password" class="form-control" name="password" id="password" value="">

                                </div>
                                <div class="col-sm-4">
                                    <label class="wb-inv" for="cpassword">Confirm Password</label>

                                    <input type="password" class="form-control" name="cpassword" id="cpassword" value="">

                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-4">

                                    <label class="control-label" for="mobile">Mobile</label>

                                    <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo isset($user1['user_mobile']) ? $user1['user_mobile'] : set_value('user_mobile'); ?>">

                                </div>
                                <div class="col-sm-4">
                                    <label class="wb-inv" for="telephone">Telephone</label>

                                    <input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo isset($user1['user_telephone']) ? $user1['user_telephone'] : set_value('user_telephone'); ?>">

                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <label class="wb-inv" for="address">Address</label>

                                    <textarea class="form-control" name="address" id="address" rows="3" value=""><?php echo isset($user1['user_address']) ? $user1['user_address'] : set_value('user_address'); ?></textarea>

                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-6"><br>

                                    <input type="submit" class="btn btn-success " value="<?php echo isset($btn_value) ? $btn_value : 'Save'; ?>">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <br>
                    <div id="results"></div>
                    
                                                      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";

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
                },
                username: {
                    minlength: 2,
                    required: true
                },
                password: {
                    minlength: 2,
                    required: <?php echo empty($agent['user_password']) ? 'true' : 'false'; ?>
                },
                cpassword: {
                    equalTo: "#password",
                    minlength: 2,
                    required: <?php echo empty($agent['user_password']) ? 'true' : 'false'; ?>
                },
                u_group: {
                    required: {
                        depends: function (element) {
                            return $("#u_group").val() == "";
                        }
                    }
                }
            }, messages: {
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 3 characters"
                },
                password: {
                    required: "Please enter a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                cpassword: {
                    required: "Please enter a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Confrim password not matched with password"
                },
                u_group: {
                    required: "Please select an option from the list",
                },
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
                            var URL = "<?php echo base_url(); ?>index.php/user/listing";
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
            dateFormat: 'dd-M-y',
            beforeShow: function () {
                $(".ui-datepicker").css('font-size', 12)
            }
        });


    }); // end document.ready
</script>
<script type="text/javascript">

    $(document).ready(function () {
        var x_timer;
        $("#username").keyup(function (e) {
            clearTimeout(x_timer);
            var user_name = $(this).val();
            var user_id = $('#user_id').val();
            x_timer = setTimeout(function () {
                check_username_ajax(user_name, user_id);
            }, 1000);
        });

        function check_username_ajax(username, user_id) {
            $("#user-result").html('<img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" width="35px" height="35px" />');
            var url = "<?php echo base_url(); ?>index.php/user/checkUserName";
            $.post(url, {'username': username, 'userid': user_id}, function (data) {
                if (data == "Ok") {
                    $("#user-result").html('<img src="<?php echo base_url(); ?>assets/img/ok.png">');
                } else {
                    $("#user-result").html('<img src="<?php echo base_url(); ?>assets/img/wrong.png">');
                }
            });
        }
    });

    $("#p6").addClass('active');
</script>



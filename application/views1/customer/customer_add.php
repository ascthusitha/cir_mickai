 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Customer Add
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Customer </a></li>
        
        <li class="active">Customer Add</li>
      </ol>
    </section>
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
 <!--            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
             /.box-header -->
            <div class="box-body">
                    
                    <form class="well form-horizontal" action="<?php echo base_url(); ?>customer/save" method="post"  id="cus_form">
                        <fieldset>



                            <!-- Select Basic -->


                            <div class="form-group"> 
                                <label class="col-md-4 control-label">Title</label>
                                <div class="col-md-4 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>

                                        <?php $customers = ['Mr.' => 'Mr.', 'Miss.' => 'Miss', 'Mrs.' => 'Mrs.', 'Ven.' => 'Ven.'];
                                        echo form_dropdown('title', $customers, isset($customer['title']) ? $customer['title'] : '', "id='title' class='form-control selectpicker'");
                                        ?> 
                                    </div>
                                </div>
                            </div>
                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label">First Name</label>  
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input  name="cus_id" id="cus_id" placeholder="" class="form-control" value="<?php echo $customer['cus_id'] ?>"  type="hidden">
                                        <input  name="f_name" placeholder="First Name" class="form-control" value="<?php echo $customer['cus_fname'] ?>"  type="text">
                                    </div>
                                </div>
                            </div>

                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label" >Last Name</label> 
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input name="l_name" placeholder="Last Name" class="form-control" value="<?php echo $customer['cus_lname'] ?>"  type="text">
                                    </div>
                                </div>
                            </div>
                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label" >ID Number</label> 
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input name="id_number" placeholder="ID Number" class="form-control" value="<?php echo $customer['id_number'] ?>" type="text">
                                    </div>
                                </div>
                            </div>
                            <!-- Text input-->
                            <!--       <div class="form-group">
                              <label class="col-md-4 control-label">E-Mail</label>  
                                <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                              <input name="email" placeholder="E-Mail Address" class="form-control"  type="text">
                                </div>
                              </div>
                            </div>-->

                            <!-- Text area -->

                            <div class="form-group">
                                <label class="col-md-4 control-label">Address</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                        <textarea class="form-control" name="address" placeholder="address"><?php echo $customer['address'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label">City</label>  
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                        <input name="city" placeholder="city" class="form-control" value="<?php echo $customer['city'] ?>" type="text">
                                    </div>
                                </div>
                            </div>
                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label">Phone #</label>  
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        <input name="phone" placeholder="0372221111" class="form-control" value="<?php echo $customer['telephone'] ?>" type="text">
                                    </div>
                                </div>
                            </div>
                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label">Mobile #</label>  
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        <input name="mobile" placeholder="0772221111" class="form-control" value="<?php echo $customer['mobile'] ?>" type="text">
                                    </div>
                                </div>
                            </div>
                            <!-- radio checks -->
                            <!-- <div class="form-group">
                                <label class="col-md-4 control-label">Residence</label>
                                <div class="col-md-4">
                                    <div class="radio">

                                        <label >Permanent</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="residence" id="1" value="1"  <?php echo set_value('residence', $customer['residence_type']) == 1 ? "checked=checked" : ""; ?> />
                                    </div>
                                    <div class="radio">

                                        <label >Temporarily</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="residence" id="0" value="0"  <?php echo set_value('residence', $customer['residence_type']) == 0 ? "checked=checked" : ""; ?> />
                                    </div>
                                </div>
                            </div> -->
                            <!-- Text input-->

                            <!--<div class="form-group">
                              <label class="col-md-4 control-label">Address</label>  
                                <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                              <input name="address" placeholder="Address" class="form-control" type="text">
                                </div>
                              </div>
                            </div>-->

                            <!-- Text input-->

                            <!--<div class="form-group">
                              <label class="col-md-4 control-label">Zip Code</label>  
                                <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                              <input name="zip" placeholder="Zip Code" class="form-control"  type="text">
                                </div>
                            </div>
                            </div>
                            
                             Text input
                            <div class="form-group">
                              <label class="col-md-4 control-label">Website or domain name</label>  
                               <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                              <input name="website" placeholder="Website or domain name" class="form-control" type="text">
                                </div>
                              </div>
                            </div>-->





                            <!-- Success message -->
                            <div class="alert "  role="alert" id="message"> </div>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success" >ADD <span class="glyphicon glyphicon-user"></span></button>
                                    <button type="reset" class="btn btn-default" >Clear <span class="glyphicon glyphicon-brush"></span></button>
                                </div>
                            </div>

                        </fieldset>
                    </form>

       <!--       /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
    $(document).ready(function () {
        $('#cus_form').bootstrapValidator({
            
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                f_name: {
                    validators: {
                        stringLength: {
                            min: 2,
                        },
                        notEmpty: {
                            message: 'Please supply your first name'
                        }
                    }
                },
                l_name: {
                    validators: {
                        stringLength: {
                            min: 2,
                        },
                        notEmpty: {
                            message: 'Please supply your last name'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Please supply your email address'
                        },
                        emailAddress: {
                            message: 'Please supply a valid email address'
                        }
                    }
                },
                id_number: {
                    validators: {
                        
                        notEmpty: {
                            message: 'Please supply your ID number'
                        },
                        stringLength: {
                            min: 10,
                            max: 10,
                            message: 'Please enter correct ID number'
                        },
                        remote: {
                           
                           
                        type: 'POST',
                        url: '<?php echo base_url(); ?>customer/customer_id/',
                        data: function(validator) {
                            
                            return {
                                cus_id: validator.getFieldElements('cus_id').val()
                            };
                        },
                        message: 'This id number is already added'
                    }
                    }
                },
                phone1: {
                    validators: {
                        notEmpty: {
                            message: 'Please supply your phone number'
                        },
                        phone: {
                            message: 'Please supply a vaild phone number with area code'
                        }
                    }
                },
                mobile: {
                    validators: {
                        notEmpty: {
                            message: 'Please supply your mobile number'
                        },
                        phone: {
                            country: 'US',
                            message: 'Please supply a vaild mobile number '
                        }
                    }
                },
                address: {
                    validators: {
                        stringLength: {
                            min: 8,
                        },
                        notEmpty: {
                            message: 'Please supply your  address'
                        }
                    }
                },
                city: {
                    validators: {
                        stringLength: {
                            min: 4,
                        },
                        notEmpty: {
                            message: 'Please supply your city'
                        }
                    }
                },
                state: {
                    validators: {
                        notEmpty: {
                            message: 'Please select your state'
                        }
                    }
                },
                zip: {
                    validators: {
                        notEmpty: {
                            message: 'Please supply your zip code'
                        },
                        zipCode: {
                            country: 'US',
                            message: 'Please supply a vaild zip code'
                        }
                    }
                },
                comment: {
                    validators: {
                        stringLength: {
                            min: 10,
                            max: 200,
                            message: 'Please enter at least 10 characters and no more than 200'
                        },
                        notEmpty: {
                            message: 'Please supply a description of your project'
                        }
                    }
                }
            }
        })
                .on('success.form.bv', function (e) {
                    $('#success_message').slideDown({opacity: "show"}, "slow") // Do something ...
                    $('#cus_form').data('bootstrapValidator').resetForm();

                    // Prevent form submission
                    e.preventDefault();

                    // Get the form instance
                    var $form = $(e.target);

                    // Get the BootstrapValidator instance
                    var bv = $form.data('bootstrapValidator');

                    // Use Ajax to submit form data
//            $.post($form.attr('action'), $form.serialize(), function(result) {
//                $('#success_message').val(result);
//            });
                    $.ajax({
                        type: $form.attr('method'),
                        url: $form.attr('action'),
                        data: $form.serialize(),
                        success: function (data) {
                            if ($.trim(data) == "success") {
                                $('#message').removeClass('alert alert-danger');
                                $('#message').addClass('alert alert-success');
                                $('#message').html('<i class="glyphicon glyphicon-thumbs-up"></i> ' + data);
                            } else {
                                $('#message').addClass('label-warning');
                                $('#message').html('<i class="glyphicon glyphicon-thumbs-down"></i> ' + data);
                            }
                            var URL = "<?php echo base_url(); ?>customer";
                            setTimeout(function () {
                                window.location = URL;
                            }, 1000);
                        }
                    })
                    e.preventDefault();
                });
    });

    $("#p2").addClass('active');
</script>

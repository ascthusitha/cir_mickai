<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Account Add</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Account</a></li>
                        <li class="breadcrumb-item active">Account Add</li>
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
                <form class="well form-horizontal" action="<?php echo base_url(); ?>account/save" method="post"  id="acc_form">
                    <fieldset>




                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Account Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Account Name</label>
                                            <input type="text" id="f_fname" name="acc_name" class="form-control" placeholder="Enter ..." value="<?= $account['acc_name']; ?>">
                                            <input type="hidden" id="acc_id" name="acc_id" class="form-control" placeholder="Enter ..." value="<?= $account['acc_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Business Name</label>
                                            <input type="text" id="b_name" name="b_name" class="form-control" value="<?= $account['b_name']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Office Phone</label>
                                            <input type="text" id="mobile" name="mobile" class="form-control" value="<?= $account['office_phone']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Alternate  Phone</label>
                                            <input type="text" id="telephone" name="telephone" class="form-control" value="<?= $account['alternate_phone']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" id="email" name="email" class="form-control" value="<?= $account['email']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Fax</label>
                                            <input type="text" id="fax" name="fax" class="form-control" value="<?= $account['fax']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label >Region</label>
                                        <?php echo form_dropdown('region_id', $regions, isset($account['region_id']) ? $account['region_id'] : '0', 'id="region_id" class="form-control"'); ?> 
                                    </div>
                                    <div class="col-sm-6">
                                        <label >Market</label>
                                        <?php echo form_dropdown('market_id', $markets, isset($account['market_id']) ? $account['market_id'] : '0', 'id="market_id" class="form-control"'); ?> 
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                        <label >Product Specialist</label>
                                        <?php echo form_dropdown('ps_id', $users, isset($account['p_user']) ? $account['p_user'] : '0', 'id="ps_id" class="form-control"'); ?> 
                                    </div>
                                    <div class="col-sm-6">
                                        <label >Instrument Specialist</label>
                                        <?php echo form_dropdown('is_id', $users, isset($account['i_user']) ? $account['i_user'] : '0', 'id="is_id" class="form-control"'); ?> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>VAT No</label>
                                            <input type="text" id="vat_no" name="vat_no" class="form-control" value="<?= $account['vat_no']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Office Address</label>
                                            <textarea id="o_address" name="o_address" class="form-control" placeholder="Enter ..." rows="5" cols="10"><?= $account['o_address']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Shipping Address</label>
                                            <textarea id="s_address" name="s_address" class="form-control" placeholder="Enter ..." rows="5" cols="10"><?= $account['s_address']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Office City</label>
                                            <input type="text" id="o_city" name="o_city" class="form-control" value="<?= $account['o_city']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Shipping City</label>
                                            <input type="text" id="s_city" name="s_city" class="form-control" value="<?= $account['s_city']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Office Province</label>
                                            <input type="text" id="o_province" name="o_province" class="form-control" value="<?= $account['o_province']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Shipping Province</label>
                                            <input type="text" id="s_province" name="s_province" class="form-control" value="<?= $account['s_province']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Office Postal Code</label>
                                            <input type="text" id="o_post" name="o_post" class="form-control" value="<?= $account['o_post']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Shipping Postal Code</label>
                                            <input type="text" id="s_post" name="s_post" class="form-control" value="<?= $account['s_postal_code']; ?>" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                  <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Office Country</label>
                                            <?php echo form_dropdown('o_country', $countries, isset($account['o_country']) ? $account['o_country'] : '0', 'id="o_country" class="form-control"'); ?> 
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Shipping Country</label>
                                            <?php echo form_dropdown('s_country', $countries, isset($account['s_country']) ? $account['s_country'] : '0', 'id="s_country" class="form-control"'); ?> 
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>


                            <!-- /.card-body -->
                            <!-- Text area -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" id="description" placeholder="Description"><?php echo $account['description'] ?></textarea>


                                        </div>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label></label>
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

        $('#acc_form').validate({
            rules: {
                acc_name: {
                    minlength: 2,
                    required: true
                }, b_name: {
                    minlength: 2,
                    required: true
                },
//                billing_address: {
//                    required: true,
//                }
            }, messages: {
                acc_name: {
                    required: "Please enter a Account Name",
                    minlength: "Account Name must consist of at least 3 characters"
                }, b_name: {
                    required: "Please enter a Business Name",
                    minlength: "Business Name must consist of at least 3 characters"
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
                            $('#results').html('Account successfully saved');
                        } else {
                            $('#results').addClass('alert alert-danger');
                            $('#results').html('error');
                        }
                        var URL = "<?php echo base_url(); ?>account/";
                        setTimeout(function () {
                            window.location = URL;
                        }, 1000);
                    }
                });

                return false; // required to block normal submit since you used ajax
            }

        });
    }); // end document.ready
</script>
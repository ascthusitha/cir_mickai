<style type="text/css">
    label.valid {
        width: 24px;
        height: 24px;
        /*background: url(../img/valid.png) center center no-repeat;*/
        display: inline-block;
        text-indent: -9999px;
    }
    label.error {
        font-weight: bold;
        padding: 2px 8px;
        margin-top: 2px;
    }
</style>


<div class="container-fluid">
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url();
echo "/" . $this->uri->segment(1); ?>/listing" >
<?php echo ucfirst(str_replace("_", " ", $this->uri->segment(1))); ?>
            </a> 
            <span class="divider">/</span>
        </li>

        <li class="active">
            <a href="#"><?php
                if ($this->uri->segment(2) == 'add') {
                    echo 'New';
                } else {
                    echo 'Update';
                }
                ?></a>
        </li>
    </ul>
    <div class="page-header text-success">
        <h3><?php echo $title; ?></h3>
    </div>
    <div class="row-fluid">
        <div class="offset3 span6">
            <form action="<?php echo base_url(); ?>company_bank/saveBank" id="bank-form" class="well" method="post">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="country">Company</label>
                        <div class="controls">
<?php echo form_dropdown('company', $companies, isset($bank['company_id']) ? $bank['company_id'] : '1'); ?> 
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="company_name">Beneficiary Name  </label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" name="ben_name" id="ben_name" value="<?php echo isset($bank['ben_name']) ? $bank['ben_name'] : set_value('ben_name'); ?>">
                            <input type="hidden" class="input-xlarge" name="bank_id" id="bank_id" value="<?php echo $bank['bank_details_id']; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="telephone">Bank Name</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" name="bank_name" id="bank_name" value="<?php echo isset($bank['bank_name']) ? $bank['bank_name'] : set_value('bank_name'); ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="address">Bank Address</label>
                        <div class="controls">
                            <textarea class="input-xlarge" name="b_address" id="b_address" rows="3" value=""><?php echo isset($bank['bank_address']) ? $bank['bank_address'] : set_value('b_address'); ?></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="website">Account No</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" name="acc_no" id="acc_no" value="<?php echo isset($bank['account_no']) ? $bank['account_no'] : set_value('acc_no'); ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="country">Current Account Type</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" name="acc_type" id="acc_type" value="<?php echo isset($bank['current_acc_type']) ? $bank['current_acc_type'] : set_value('acc_type'); ?>">
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="website">Swift Code </label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" name="swift_code" id="swift_code" value="<?php echo isset($bank['swift_code']) ? $bank['swift_code'] : set_value('swift_code'); ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <input type="submit" class="btn btn-primary" value="<?php echo isset($btn_value) ? $btn_value : 'Save'; ?>">
                        </div>
                    </div>
                </fieldset>
            </form>
            <!--  results  here -->
            <div id="results"></div>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";

        $('#bank-form').validate({
            rules: {
                company: {
                    required: true
                }

            }, messages: {
                company: {
                    required: "Please Select a Company"

                }
            },
            highlight: function (element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function (element) {
                element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
            },
            submitHandler: function (form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    success: function (data)
                    {
                        //$("#company-form").hide('slow');
                        if (data == "success") {
                            $('#results').addClass('alert alert-success');
                            $('#results').html('Bank details successfully saved');
                        } else {
                            $('#results').addClass('alert alert-danger');
                            $('#results').html('error');
                        }
                        var URL = "<?php echo base_url(); ?>company_bank/view/1";
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
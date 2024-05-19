<div id="page-wrapper">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo site_url();
echo $this->uri->segment(1); ?>/" >
<?php echo ucfirst(str_replace("_", " ", $this->uri->segment(1))); ?>
                </a> 

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
                <form action="<?php echo base_url(); ?>promotion_details/save_promotion_dt" id="promotion-form" class="well" method="post">
                    <fieldset>
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <label class="control-label" for="promotion_name">Promotion Name</label>

                                <?php
                                $x = 'id="promotion_id" class="form-control"';
                                echo form_dropdown('promotion_id', $promotions, isset($promotion_dt['promotion_id']) ? $promotion_dt['promotion_id'] : '0', $x);
                                ?> 
                                <input type="hidden" class="form-control" name="promotion_dt_id" id="promotion_dt_id" value="<?php echo $promotion_dt['promotion_details_id']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <label class="control-label" for="mem_type">Member Type</label>
<?php
$x = 'id="mem_type" class="form-control"';
echo form_dropdown('mem_type', $mem_types, isset($promotion_dt['member_type']) ? $promotion_dt['member_type'] : '0', $x);
?> 
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <label class="control-label" for="s_date">Start Date</label>

                                <input type="text" class="form-control" name="s_date" id="s_date" value="<?php echo isset($promotion_dt['start_date']) ? $promotion_dt['start_date'] : set_value('s_date'); ?>">
                            </div>
                            <div class="col-sm-4">
                                <label class="control-label" for="s_date">End Date</label>

                                <input type="text" class="form-control" name="e_date" id="e_date" value="<?php echo isset($promotion_dt['end_date']) ? $promotion_dt['end_date'] : set_value('e_date'); ?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <label class="control-label" for="amount">Discount (%) </label>
                                <input type="text" class="form-control" name="amount" id="amount" value="<?php echo isset($promotion_dt['amount']) ? $promotion_dt['amount'] : set_value('amount'); ?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4"><br>
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

</div>
<script type="text/javascript">
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";
        function validateDonotSelect(value, element, param)
        {
            if (value == param)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        jQuery.validator.addMethod("do_not_select", validateDonotSelect, "Please select an option");
        $('#promotion-form').validate({
            rules: {
                promotion_id: {do_not_select: '0'},
                mem_type: {do_not_select: '0'},
                amount: {required: true, number: true},
                s_date: {required: true},
                e_date: {required: true},
            },
            messages: {
                promotion_id: {
                    required: "Please select a promotion"
                },
                discount: {
                    required: "Please enter a discount"
                },
            },
            highlight: function (element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function (element) {
                element.text('').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
            },
            submitHandler: function (form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    success: function (data)
                    {

                        //$("#supplier_rating_type-form").hide('slow');
                        if ($.trim(data) == 'success') {
                            $('#results').addClass('alert alert-success');
                            $('#results').html('Promotion Details successfully saved');
                        } else {
                            $('#results').addClass('alert alert-danger');
                            $('#results').html('error');
                        }
                        var URL = "<?php echo base_url(); ?>promotion_details";
                        setTimeout(function () {
                            window.location = URL;
                        }, 1000);
                    }
                });

                return false; // required to block normal submit since you used ajax
            }

        });
        $("#s_date").datepicker({
           // defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd',
            beforeShow: function () {
                $(".ui-datepicker").css('font-size', 12)
            }
        });
        $("#e_date").datepicker({
           // defaultDate: "+1w",
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

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
<?php
$base_link = $this->config->item('base_url') . $this->config->item('index_page');
$permissionData = $this->session->userdata['permissionData'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Administration</a></li>
                        <li class="breadcrumb-item active">Payment</li>
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

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5">

                            <label class='control-label'>Usage Details</label>


                            <?php $anual_rate = 0;
                            $in_id = '';
                            if (count($anual_inv) > 0) {
                                $anual_rate = $anual_inv[0]->amount; ?>
                                <div class="alert alert-default border ">System
                                    Annual fee <br> period ( <?= $anual_inv[0]->s_date . " - " . $anual_inv[0]->e_date ?> )
                                    <label id="sys_amount" class="radio-inline float-right"> <input class="check1"
                                                                                                    type="checkbox" id="check1" name="rate" class="check1"
                                                                                                    value="<?php $anual_rate = $anual_inv[0]->amount;
                                $anual_ratex = $anual_inv[0]->amount . "," . $anual_inv[0]->inv_id;
                                echo $anual_ratex; ?>" checked>
                                        CAD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $anual_rate; ?></label>
                                    <input type="hidden" name="inv_id" id="inv_id" value="<?php $in_id = $anual_inv[0]->inv_id;
                                echo $in_id; ?>">
                                </div>
<?php } ?>

                            <div class="alert alert-default border ">Transaction Fee Deposit
                                <label id="sys_amount" class="radio-inline float-right"> <input class="check1"
                                                                                                type="checkbox" id="drate" name="rate"
                                                                                                value="50,0" >
                                    CAD <input type="text" name="d_amount" size="4" id="d_amount" value="50.00"></label>

                            </div>

                            <div class="alert alert-default border ">
                                Weekly Charges for alert<br>

                                <label id="alert_pay" class="radio-inline float-right  "><input
                                        class="check1 " type="checkbox" id="check2" name="rate"
                                        value="<?= $alert_ratex; ?>" >
                                    CAD
<?= $alert_rate; ?>
                                </label>
                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th>Invoice No</th>
                                            <th>Invoice Date Range</th>
                                            <th>Details</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($week_inv) > 0) {
                                            foreach ($week_inv as $week) {
                                                $from = $week->s_date;
                                                $end = $week->e_date;
                                                $sms = $this->alert_sms_model->get_alert_count('2', $from, $end);
                                                $email = $this->alert_sms_model->get_alert_count('1', $from, $end);
                                                $voice = $this->alert_sms_model->get_alert_count('3', $from, $end);
                                                ?>
                                                <tr>
                                                    <td><?= $week->inv_code; ?></td>
                                                    <td><?= $from . " to " . $end; ?></td>
                                                    <td>Sms&nbsp;&nbsp;&nbsp;&nbsp;- <?= $sms ?><br>Email&nbsp;&nbsp;- <?= $email ?><br>Voice&nbsp;&nbsp;- <?= $voice ?><br></td>
                                                    <td>CAD <?= $week->amount; ?></td>
                                                </tr>
    <?php }
} ?>
                                    </tbody>
                                </table>
                                <div class="alert alert-default border ">Transaction Fee Balance
                                    <label id="sys_amount" class="radio-inline float-right">
                                        CAD <?= $balanced ?></label>

                                </div>
                            </div>

                            <label class='control-label'>Total Payable</label>
                            <div class="alert alert-default border ">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p>Subtotal</p>
                                    <p>CAD <label id="sub_tot">
<?php $total = $anual_rate + $alert_rate;
echo number_format(($total), 2);
?>
                                        </label>
                                    </p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p class="fw-bold">Total</p>
                                    <p class="fw-bold">CAD
                                        <label id="total"><?= number_format(($total), 2); ?></label>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="offset-3">

                                <label class='control-label'>Payment Details</label>



                                <div class="panel panel-default">
                                    <div class="panel-body">
<?php if ($this->session->flashdata('success')) { ?>
                                            <div class="alert alert-success text-center">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                                <p><?php echo $this->session->flashdata('success'); ?></p>
                                            </div>
<?php } ?>
                                        <form role="form"
                                              action="<?php echo base_url(); ?>StripePaymentController/handlePayment"
                                              method="post" class="form-validation" data-cc-on-file="false"
                                              data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>"
                                              id="payment-form">
                                            <div class='form-row row'>
                                                <div class='col-xs-12 form-group required'>
                                                    <label class='control-label'>Email</label>
                                                    <input class='form-control' size='4' type='text' name='email'
                                                           id='email'>
                                                </div>
                                            </div>
                                            <div class='form-row row'>
                                                <div class='col-xs-12 form-group required'>
                                                    <label class='control-label'>Name on Card</label>
                                                    <input class='form-control' size='4' type='text' name='cname'
                                                           id='cname'>
                                                </div>
                                            </div>
                                            <div class='form-row row'>
                                                <div class='col-xs-12 form-group card required'>
                                                    <label class='control-label'>Card Number</label>
                                                    <input autocomplete='off' class='form-control card-number' size='20'
                                                           type='text' name='card_no' id=card_no'>
                                                </div>
                                            </div>
                                            <div class=' form-row row'>
                                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                    <label class='control-label'>CVC</label>
                                                    <input autocomplete='off' class='form-control card-cvc'
                                                           placeholder='ex. 311' size='4' type='text' name='card_v'
                                                           id='card_v'>
                                                </div>
                                                <div class=' col-xs-12 col-md-4 form-group expiration required'>
                                                    <label class='control-label'>Expiration
                                                        Month</label>
                                                    <input class='form-control card-expiry-month' placeholder='MM'
                                                           size='2' type='text' name='card_expire_m' id='card_expire_m'>
                                                </div>
                                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                    <label class='control-label'>Expiration Year</label>
                                                    <input class='form-control card-expiry-year' placeholder='YYYY'
                                                           size='4' type='text' name='card_expire_y' id='card_expire_y'>
                                                </div>
                                            </div>

                                            <div class="alert alert-default border">
                                                <h4>Billing Details</h4>
                                                <div class=' form-row row'>
                                                    <div class='col-xs-12 col-md-6 form-group  required'>
                                                        <label class='control-label'>Address</label>
                                                        <input autocomplete='off' class='form-control b-address'
                                                               placeholder='Address'  type='text' name='address'
                                                               id='address'>
                                                    </div> 
                                                    <div class=' col-xs-12 col-md-6 form-group city required'>
                                                        <label class='control-label'>City
                                                        </label>
                                                        <input class='form-control ' placeholder=''
                                                               type='text'  id='b_city' name='b_city' >
                                                    </div>

                                                </div>
                                                <div class=' form-row row'>
                                                    <div class='col-xs-12 col-md-6 form-group  required'>
                                                        <label class='control-label'>Province</label>
                                                        <input autocomplete='off' class='form-control b_province'
                                                               placeholder=''  type='text' name='b_province'
                                                               id='b_province'>
                                                    </div>
                                                    <div class=' col-xs-12 col-md-6 form-group b_postal required'>
                                                        <label class='control-label'>Postal Code
                                                        </label>
                                                        <input class='form-control ' placeholder=''
                                                               type='text' name='b_postal' id='b_postal'>
                                                    </div>

                                                </div>
                                                <div class=' form-row row'>
                                                    <div class='col-xs-12 col-md-6 form-group  required'>
                                                        <label class='control-label'>Country</label>
                                                        <input autocomplete='off' class='form-control b_country'
                                                               placeholder=''  type='text' name='b_country'
                                                               id='b_country'>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='form-row row'>
                                                <div class='col-md-12 error form-group hide'>
                                                    <div class='alert-danger alert'>Error occured while
                                                        making the payment.</div>
                                                </div>
                                            </div>
                                            <div class=" row">
                                                <div class="col-xs-12">
                                                    <input type="hidden" name="pay_amount" id="pay_amount"
                                                           value="<?= $total ?>">
                                                    <input type="hidden" name="id_list" id="id_list"
                                                           value="<?= $in_id; ?>">
                                                    <input type="hidden" name="deposit" id="deposit"
                                                           value="0">
                                                    <button class="btn btn-primary btn-lg btn-block" type="submit">
                                                        Pay Now ( CAD <label id="total1">
<?= number_format(($total), 2); ?></label>
                                                        )</button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

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
<script>
    $(".check1").click(function () {
        let total = 0;
        let inv_id = [];
        let new_id = '';
        let  aa = 0;
        let checkboxes = document.querySelectorAll('input[name="rate"]:checked');

        checkboxes.forEach((checkbox) => {
            const myArray = checkbox.value.split(",");

            total = total + parseFloat(myArray[0]);

            inv_id.push(myArray[1]);//+','+inv_id;
            //alert(inv_id);
            if (myArray[1] == 0) {
                aa = parseFloat($('#d_amount').val());

            }
        });
        $('#deposit').val(aa.toFixed(2));
        $('#id_list').val(inv_id);
        $('#sub_tot').html(total.toFixed(2));
        $('#total').html(total.toFixed(2));
        $('#total1').html(total.toFixed(2));
        $('#pay_amount').val(total.toFixed(2));
    });
</script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function () {
        $("#d_amount").blur(function () {
            $('#drate').val(this.value + ',0');
        });
        var $stripeForm = $(".form-validation");
        $('form.form-validation').bind('submit', function (e) {
            var $stripeForm = $(".form-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $stripeForm.find('.required').find(inputSelector),
                    $errorMessage = $stripeForm.find('div.error'),
                    valid = true;
            $errorMessage.addClass('hide');
            $('.has-error').removeClass('has-error');
            $inputs.each(function (i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });
            if (!$stripeForm.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($stripeForm.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val(),
//                    address_city: 'abc',
//                    address_country: 'canada',
//                    address_line1: 'no 123',
//                    address_zip:'1111',
//                   address_state: '3333',
                }, stripeResponseHandler);
            }
        });

        function stripeResponseHandler(status, res) {
            if (res.error) {
                $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(res.error.message);
            } else {
                var token = res['id'];
                $stripeForm.find('input[type=text]').empty();
                $stripeForm.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $stripeForm.get(0).submit();
            }
        }
    });
</script>
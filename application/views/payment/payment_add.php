<?php
$base_link = $this->config->item('base_url') . $this->config->item('index_page');
$permissionData = $this->session->userdata['permissionData'];
?>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.0.0/jquery.creditCardValidator.js"></script>
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
                                                $sms = $week->sms;//$this->alert_sms_model->get_alert_count('2', $from, $end);
                                                $email = $week->email;//$this->alert_sms_model->get_alert_count('1', $from, $end);
                                                $voice = $week->call;//$this->alert_sms_model->get_alert_count('3', $from, $end);

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
<?php 
//echo $total." = ".$anual_rate." + ".$alert_rate;
$total = (floatval($anual_rate)+floatval($alert_rate));
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

               
                           

		<?php 
		if(isset($_SESSION["message"]) && $_SESSION["message"] && $_SESSION["message"] == 'failed') {
		?>			
			<div class="alert alert-danger">
			  <?php 
			  echo "Error : Payment failed!"; 
			  $_SESSION["message"] = '';
			  ?>
			</div>
		<?php 
		} elseif(isset($_SESSION["message"]) && $_SESSION["message"]) {
		?>
			<div class="alert alert-success">
			  <?php 
			  echo $_SESSION["message"]; 
			  $_SESSION["message"] = '';
			  ?>
			</div>
		<?php } ?>
		<div class="panel panel-default">			

			<div class="panel-body">
                            <?php if ($this->session->flashdata('success')) { ?>
                                            <div class="alert alert-success text-center">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                                <p><?php echo $this->session->flashdata('success'); ?></p>
                                            </div>
<?php } ?>
				<form action="<?php echo base_url(); ?>StripePaymentController/handlePayment" method="POST" id="paymentForm">	
					<div class="row">
						<div class="col-md-12" style="border-left:1px solid #ddd;">
							<h4 align="center">Customer Details</h4>
							<div class="form-group">
								<label><b>Card Holder Name <span class="text-danger">*</span></b></label>
								<input type="text" name="customerName" id="customerName" class="form-control" value="">
								<span id="errorCustomerName" class="text-danger"></span>
							</div>
							<div class="form-group">
								<label><b>Email Address <span class="text-danger">*</span></b></label>
								<input type="text" name="emailAddress" id="emailAddress" class="form-control" value="">
								<span id="errorEmailAddress" class="text-danger"></span>
							</div>
							<div class="form-group">
								<label><b>Address <span class="text-danger">*</span></b></label>
								<textarea name="customerAddress" id="customerAddress" class="form-control"></textarea>
								<span id="errorCustomerAddress" class="text-danger"></span>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label><b>City <span class="text-danger">*</span></b></label>
										<input type="text" name="customerCity" id="customerCity" class="form-control" value="">
										<span id="errorCustomerCity" class="text-danger"></span>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label><b>Zip <span class="text-danger">*</span></b></label>
										<input type="text" name="customerZipcode" id="customerZipcode" class="form-control" value="">
										<span id="errorCustomerZipcode" class="text-danger"></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label><b>State </b></label>
										<input type="text" name="customerState" id="customerState" class="form-control" value="">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label><b>Country <span class="text-danger">*</span></b></label>
										<input type="text" name="customerCountry" id="customerCountry" class="form-control">
										<span id="errorCustomerCountry" class="text-danger"></span>
									</div>
								</div>
							</div>
							<hr>
							<h4 align="center">Card Details</h4>
                                                        		<div class="form-group" style="text-align: center;">
								<label class="text-info">We accept all major credit cards. Your card details will be saved securely for future transactions. Please note that the credit card deduction will appear on your statement as Ascensor Partners. 
If you have any questions please send an email to info@ascensorpartners.com.</label>
							<img src="<?php echo base_url(); ?>assets/dist/img/card1.jpg" class="img-fluid1" height="50%" width="50%">
							</div>
							<div class="form-group">
								<label>Card Number <span class="text-danger">*</span></label>
								<input type="text" name="cardNumber" id="cardNumber" class="form-control" placeholder="1234 5678 9012 3456" maxlength="20" onkeypress="">
								<span id="errorCardNumber" class="text-danger"></span>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Expiry Month</label>
										<input type="text" name="cardExpMonth" id="cardExpMonth" class="form-control" placeholder="MM" maxlength="2" onkeypress="return validateNumber(event);">
										<span id="errorCardExpMonth" class="text-danger"></span>
									</div>
									<div class="col-md-4">
										<label>Expiry Year</label>
										<input type="text" name="cardExpYear" id="cardExpYear" class="form-control" placeholder="YYYY" maxlength="4" onkeypress="return validateNumber(event);">
										<span id="errorCardExpYear" class="text-danger"></span>
									</div>
									<div class="col-md-4">
										<label>CVC</label>
										<input type="text" name="cardCVC" id="cardCVC" class="form-control" placeholder="123" maxlength="4" onkeypress="return validateNumber(event);">
										<span id="errorCardCvc" class="text-danger"></span>
									</div>
								</div>
							</div>


							<br>
							<div align="center">
                                                             <input type="hidden" name="pay_amount" id="pay_amount"
                                                           value="<?= $total ?>">
                                                    <input type="hidden" name="id_list" id="id_list"
                                                           value="<?= $in_id; ?>">
                                                    <input type="hidden" name="deposit" id="deposit"
                                                           value="0">
                                                    

							     <button class="btn btn-success btn-sm" id="payNow" name="payNow" onclick="stripePay(event)" type="button">
                                                        Pay Now ( CAD <label id="total1">
<?= number_format(($total), 2); ?></label>
                                                        )</button>
							</div>
							<br>
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
    </section>
</div>
   <!-- Modal -->
<div class="modal fade" id="termModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Future Terms & Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Confirm</button>
      </div>
    </div>
  </div>
</div>
<script>
Stripe.setPublishableKey('<?=$this->config->item('stripe_key');?>');
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
      $("#d_amount").blur(function () {
            $('#drate').val(this.value + ',0');
        });
function stripePay(event) {
    event.preventDefault(); 
    if($('#pay_amount').val()>0){
    if(validateForm() == true) {
     $('#payNow').attr('disabled', 'disabled');
     $('#payNow').html('Payment Processing....');
     Stripe.createToken({
      number:$('#cardNumber').val(),
      cvc:$('#cardCVC').val(),
      exp_month : $('#cardExpMonth').val(),
      exp_year : $('#cardExpYear').val()
     }, stripeResponseHandler);
     return false;
    }
    }else{
        alert('You must select an amount before pay!!!');
    }
}

function stripeResponseHandler(status, response) {
 if(response.error) {
  $('#payNow').attr('disabled', false);
  $('#message').html(response.error.message).show();
 } else {
  var stripeToken = response['id'];
  $('#paymentForm').append("<input type='hidden' name='stripeToken' value='" + stripeToken + "' />");

  $('#paymentForm').submit();
 }
}

function validateForm() {
 var validCard = 0;
 var valid = false;
 var cardCVC = $('#cardCVC').val();
 var cardExpMonth = $('#cardExpMonth').val();
 var cardExpYear = $('#cardExpYear').val();
 var cardNumber = $('#cardNumber').val();
 var emailAddress = $('#emailAddress').val();
 var customerName = $('#customerName').val();
 var customerAddress = $('#customerAddress').val();
 var customerCity = $('#customerCity').val();
 var customerZipcode = $('#customerZipcode').val();
 var customerCountry = $('#customerCountry').val();
 var customerCountry = $('#customerCountry').val();
 var validateName = /^[a-z ,.'-]+$/i;
 var validateEmail = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/;
 var validateMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
 var validateYear = /^2017|2018|2019|2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
 var cvv_expression = /^[0-9]{3,3}$/;

 $('#cardNumber').validateCreditCard(function(result){
  if(result.valid) {
   $('#cardNumber').removeClass('require');
   $('#errorCardNumber').text('');
   validCard = 1;
  } else {
   $('#cardNumber').addClass('require');
   $('#errorCardNumber').text('Invalid Card Number');
   validCard = 0;
  }
 });

 if(validCard == 1) {
  if(!validateMonth.test(cardExpMonth)){
   $('#cardExpMonth').addClass('require');
   $('#errorCardExpMonth').text('Invalid Data');
   valid = false;
  } else { 
   $('#cardExpMonth').removeClass('require');
   $('#errorCardExpMonth').text('');
   valid = true;
  }

  if(!validateYear.test(cardExpYear)){
   $('#cardExpYear').addClass('require');
   $('#errorCardExpYear').text('Invalid Data');
   valid = false;
  } else {
   $('#cardExpYear').removeClass('require');
   $('#errorCardExpYear').text('');
   valid = true;
  }

  if(!cvv_expression.test(cardCVC)) {
   $('#cardCVC').addClass('require');
   $('#errorCardCvc').text('Invalid Data');
   valid = false;
  } else {
   $('#cardCVC').removeClass('require');
   $('#errorCardCvc').text('');
   valid = true;
  }
  
  if(!validateName.test(customerName)) {
   $('#customerName').addClass('require');
   $('#errorCustomerName').text('Invalid Name');
   valid = false;
  } else {
   $('#customerName').removeClass('require');
   $('#errorCustomerName').text('');
   valid = true;
  }

  if(!validateEmail.test(emailAddress)) {
   $('#emailAddress').addClass('require');
   $('#errorEmailAddress').text('Invalid Email Address');
   valid = false;
  } else {
   $('#emailAddress').removeClass('require');
   $('#errorEmailAddress').text('');
   valid = true;
  }

  if(customerAddress == '') {
   $('#customerAddress').addClass('require');
   $('#errorCustomerAddress').text('Enter Address Detail');
   valid = false;
  } else {
   $('#customerAddress').removeClass('require');
   $('#errorCustomerAddress').text('');
   valid = true;
  }

  if(customerCity == ''){
   $('#customerCity').addClass('require');
   $('#errorCustomerCity').text('Enter City');
   valid = false;
  } else {
   $('#customerCity').removeClass('require');
   $('#errorCustomerCity').text('');
   valid = true;
  }

  if(customerZipcode == ''){
   $('#customerZipcode').addClass('require');
   $('#errorCustomerZipcode').text('Enter Zip code');
   valid = false;
  } else {
   $('#customerZipcode').removeClass('require');
   $('#errorCustomerZipcode').text('');
   valid = true;
  }

  if(customerCountry == '') {
   $('#customerCountry').addClass('require');
   $('#errorCustomerCountry').text('Enter Country Detail');
   valid = false;
  } else {
   $('#customerCountry').removeClass('require');
   $('#errorCustomerCountry').text('');
   valid = true;
  }  
 }
 return valid;
}

function validateNumber(event) {
 var charCode = (event.which) ? event.which : event.keyCode;
 if (charCode != 32 && charCode > 31 && (charCode < 48 || charCode > 57)){
  return false;
 }
 return true;
}
</script>
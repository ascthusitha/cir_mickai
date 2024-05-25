  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Company Setting</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Administration</a></li>
              <li class="breadcrumb-item active">Company</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">Company Form</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo base_url(); ?>company/saveCompany" id="company-form" class="" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input type="text" name="company_name" class="form-control" id="company_name" placeholder="Enter Company Name" value="<?php echo isset($company['company_name']) ? $company['company_name'] : set_value('company_name'); ?>">
                    <input type="hidden" class="form-control" name="company_id" id="company_id" value="<?php echo $company['company_id']; ?>">
                  </div>
                   <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" name="address" id="address" rows="3" value=""><?php echo isset($company['company_address']) ? $company['company_address'] : set_value('address'); ?></textarea>
                  </div>
                   <div class="form-group">
                    <label for="telephone">Telephone</label>
                    <input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo isset($company['company_telephone']) ? $company['company_telephone'] : set_value('telephone'); ?>">
                  </div>
                  <div class="form-group">
                        <label class="wb-inv" for="website">Website</label>
                        
                            <input type="text" class="form-control" name="website" id="website" value="<?php echo isset($company['company_website']) ? $company['company_website'] : set_value('website'); ?>">
                        </div>
                        <div class="col-sm-4">
                        <label class="wb-inv" for="country">Country</label>
                        
<?php echo form_dropdown('country', $countries, isset($company['country_id']) ? $company['country_id'] : '1', 'id="country" class="form-control"'); ?> 
                        </div>
                          <div class="col-sm-4">
                        <label class="wb-inv" for="currency">Currency</label>
                        
<?php echo form_dropdown('currency', $currencies, isset($company['base_currency_id']) ? $company['base_currency_id'] : '1', 'id="currency" class="form-control"'); ?> 
                        </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" value="<?php echo isset($btn_value) ? $btn_value : 'Save'; ?>">
                </div>
              </form><br>
          
            </div>
            <!-- /.card -->
                <!--  results  here -->
            <div id="results"></div>
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";

        $('#company-form').validate({
            rules: {
                company_name: {
                    minlength: 2,
                    required: true
                },
                address: {
                    required: true,
                }
            }, messages: {
                company_name: {
                    required: "Please enter a company name",
                    minlength: "Your company name must consist of at least 3 characters"
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
                            $('#results').html('Company successfully saved');
                        } else {
                            $('#results').addClass('alert alert-danger');
                            $('#results').html('error');
                        }
                        var URL = "<?php echo base_url(); ?>company/view/1";
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
<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');?>
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

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Company Form</h3>
            </div>
            <form action="<?php echo $base_link; ?>company/saveCompany" id="company-form" class="" method="post">
              <div class="card-body">
                <div class="form-group">
                  <label for="company_name">Company Name</label>
                  <input type="text" name="company_name" class="form-control" id="company_name" placeholder="Enter Company Name" value="<?php echo isset($company['company_name']) ? $company['company_name'] : set_value('company_name'); ?>">
                  <input type="hidden" class="form-control" name="company_id" id="company_id" value="<?php echo $company['company_id']; ?>">
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <label for="address">Address</label>
                    <textarea class="form-control" name="address" id="address" rows="4" value=""><?php echo isset($company['company_address']) ? $company['company_address'] : set_value('address'); ?></textarea>
                  </div>
                  <div class="col-sm-6">
                    <div class="row">
                      <div class="col-sm-12">
                        <label for="telephone">Telephone</label>
                        <input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo isset($company['company_telephone']) ? $company['company_telephone'] : set_value('telephone'); ?>">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <label class="wb-inv" for="website">Website</label>
                        <input type="text" class="form-control" name="website" id="website" value="<?php echo isset($company['company_website']) ? $company['company_website'] : set_value('website'); ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <label class="wb-inv" for="country">Country</label>
                    <?php echo form_dropdown('country', $countries, isset($company['country_id']) ? $company['country_id'] : '1', 'id="country" class="form-control"'); ?> 
                  </div>
                  <div class="col-sm-6">
                    <label class="wb-inv" for="currency">Currency</label>
                    <?php echo form_dropdown('currency', $currencies, isset($company['base_currency_id']) ? $company['base_currency_id'] : '1', 'id="currency" class="form-control"'); ?> 
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <input type="submit" class="btn btn-info" value="<?php echo isset($btn_value) ? $btn_value : 'Save'; ?>">
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
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('#company-form').validate({
      rules: {
        company_name: {
          minlength: 2,
          required: true
        }, address: {
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
    }, success: function (element) {
      element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
    }, submitHandler: function (form) {
      $.ajax({
        type: $(form).attr('method'),
        url: $(form).attr('action'),
        data: $(form).serialize(),
        success: function (data) {
          if (data == "success") {
            Toast.fire({
              icon: 'success',
              title: ' Company successfully saved'
            });
          } else {
            Toast.fire({
              icon: 'error',
              title: ' error'
            });
          }
          var URL = "<?php echo $base_link; ?>company/view/1";
          setTimeout(function () {
            window.location = URL;
          }, 1500);
        }
      });

      return false; // required to block normal submit since you used ajax
    }

  });
}); // end document.ready
</script>

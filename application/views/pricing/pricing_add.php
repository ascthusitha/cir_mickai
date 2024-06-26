<?php $base_link = $this->config->item('base_url') . $this->config->item('index_page'); ?>
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
              <li class="breadcrumb-item"><a href="#">Master Setting</a></li>
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
         <form action="<?php echo base_url(); ?>alert_price/save_price" id="price-form" class="well" method="post">
                    <fieldset>
   

                        <div class="row">
                      
                            <div class="col-md-4">
                                <label class="control-label" for="s_date">Start Date</label>
                                <input type="text" class="form-control" name="td_id" id="td_id" value="<?php echo isset($alert_price['td_id']) ? $alert_price['td_id'] : ''; ?>">
                                <input type="text" class="form-control" name="s_date" id="s_date" value="<?php echo isset($alert_price['start_date']) ? $alert_price['start_date'] : set_value('s_date'); ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label" for="s_date">End Date</label>

                                <input type="text" class="form-control" name="e_date" id="e_date" value="<?php echo isset($alert_price['end_date']) ? $alert_price['end_date'] : set_value('e_date'); ?>">
                            </div>
                     
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="control-label" for="sms_rate">SMS Rate </label>
                                <input type="text" class="form-control" name="sms_rate" id="sms_rate" value="<?php echo isset($alert_price['sms_rate']) ? $alert_price['sms_rate'] : set_value('sms_rate'); ?>">
                            </div>
                            <div class="col-sm-4">
                                <label class="control-label" for="email_rate">Email Rate </label>
                                <input type="text" class="form-control" name="email_rate" id="email_rate" value="<?php echo isset($alert_price['email_rate']) ? $alert_price['email_rate'] : set_value('email_rate'); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="control-label" for="voice_rate">Voice Rate </label>
                                <input type="text" class="form-control" name="voice_rate" id="voice_rate" value="<?php echo isset($alert_price['voice_rate']) ? $alert_price['voice_rate'] : set_value('voice_rate'); ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-sm-4"><br>
                                <input type="submit" class="btn btn-primary" value="<?php echo isset($btn_value) ? $btn_value : 'Save'; ?>">
                            </div>
                        </div>
                    </fieldset>
                </form>
                <!--  results  here -->
                <div id="results"></div>
        <!-- /.card-body -->
        
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
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

    $('#price-form').validate({
      rules: {
        s_date: {
          required: true
        },e_date: {
          required: true
        },
        sms_rate: {
          required: true
        },email_rate: {
          required: true
        },voice_rate: {
          required: true
        }
        
      }, messages: {
        sms_rate: {
          required: "Please enter SMS Rate",
      }, email_rate: {
          required: "Please enter Email Rate",
      }, voice_rate: {
          required: "Please enter Voice Rate",
      }, s_date: {
          required: "Please enter Start Date",
      }, e_date: {
          required: "Please enter End Date",
      }
    },

    submitHandler: function (form) {
      $.ajax({
        type: $(form).attr('method'),
        url: $(form).attr('action'),
        data: $(form).serialize(),
        success: function (data) {
            if (data == "success") {
              Toast.fire({
                icon: 'success',
                title: ' Alert Price successfully saved'
              });
              var URL = "<?php echo $base_link; ?>alert_price/";
                setTimeout(function () {
                  window.location = URL;
                }, 1500);
            } else {
              Toast.fire({
                icon: 'error',
                title: ' error'
              });
            }

          }
        });
        return false; // required to block normal submit since you used ajax
      }

    });
        $("#s_date").datepicker({
        //defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,

        numberOfMonths: 1,
        dateFormat: 'dd-M-y',
        beforeShow: function() {
            $(".ui-datepicker").css('font-size', 12)
        }
    });
        $("#e_date").datepicker({
        //defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,

        numberOfMonths: 1,
        dateFormat: 'dd-M-y',
        beforeShow: function() {
            $(".ui-datepicker").css('font-size', 12)
        }
    });
  }); // end document.ready
</script>
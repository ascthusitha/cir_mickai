<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');?>
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
            <li class="breadcrumb-item"><a href="#">Manage</a></li>
            <li class="breadcrumb-item active"><?=$title;?></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <!-- Default box -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title"><?=$title;?></h3>
              <div class="card-tools">
              </div>
            </div>
            <form action="<?php echo $base_link; ?>market/save" id="market-form"  method="post">
              <div class="card-body">
                <div class="col-sm-12">
                  <label class="control-label" for="market_name">Market Name</label>
                  <input type="text" class="form-control" name="market_name" id="market_name" value="<?php echo isset($market['market_name']) ? $market['market_name'] : set_value(''); ?>">
                  <input type="hidden" class="form-control" name="market_id" id="market_id" value="<?php echo $market['market_id']; ?>">
                </div>
              </div>
              <div class="card-footer">
                <input type="submit" class="btn btn-info" value="<?php echo isset($btn_value) ? $btn_value : 'Save'; ?>">
              </div>
            </form>
          <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function () {
    var base_url = "<?php echo $base_link; ?>";
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('#market-form').validate({
      rules: {
        market_name: {
          required: true
        }
      }, messages: {
        market_name: {
          required: "Please enter market name",
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
                title: ' Market successfully saved'
              });
              var URL = "<?php echo $base_link; ?>market/";
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
  }); // end document.ready
</script>
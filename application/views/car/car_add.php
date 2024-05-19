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
            <form action="<?php echo $base_link; ?>car/save" id="car-form"  method="post">
              <div class="card-body">
                <div class="col-sm-12">
                  <label class="control-label" for="car_name">Car Name</label>
                  <input type="text" class="form-control" name="car_name" id="car_name" value="<?php echo isset($car['car_name']) ? $car['car_name'] : set_value(''); ?>">
                  <input type="hidden" class="form-control" name="car_id" id="car_id" value="<?php echo $car['car_id']; ?>">
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

<script type="text/javascript">
  $(document).ready(function () {
    var base_url = "<?php echo $base_link; ?>";
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('#car-form').validate({
      rules: {
        car_name: {
          required: true
        }
      }, messages: {
        car_name: {
          required: "Please enter car name",
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
                title: ' Car successfully saved'
              });
              var URL = "<?php echo $base_link; ?>car/";
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
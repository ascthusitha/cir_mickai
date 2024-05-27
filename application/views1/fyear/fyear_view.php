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
            <li class="breadcrumb-item"><a href="#">Administration</a></li>
            <li class="breadcrumb-item"><a href="#">Set Targets</a></li>
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
        <div class="col-md-6">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Select <?=$title;?></h3>
            </div>
            <form action="<?php echo $base_link; ?>financial_year/save" id="fyear-form" class="" method="post">
              <div class="card-body">
                <div class="form-group clearfix">
                  <div class="icheck-primary">
                    <input type="radio" id="january" name="fyear" value="1" <?php if($f_year==1) echo "checked";?>>
                    <label for="january">January to December</label>
                  </div>
                  <div class="icheck-primary">
                    <input type="radio" id="april" name="fyear" value="2" <?php if($f_year==2) echo "checked";?>>
                    <label for="april">April to March</label>
                  </div>
                  <div class="icheck-primary">
                    <input type="radio" id="june" name="fyear" value="3" <?php if($f_year==3) echo "checked";?>>
                    <label for="june">June to May</label>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="button" class="btn btn-info" onClick="update_fyear()">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  function update_fyear() {
    var formData = new FormData($("#fyear-form")[0]);
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    $.ajax({
      url: '<?php echo $base_link;  ?>financial_year/save',
      type: 'POST',
      data: formData,
      async: false,
      success: function (data) {
        if ($.trim(data) == "success") {
          Toast.fire({
            icon: 'success',
            title: ' Financial year successfully Updated'
          });
        } else {
          Toast.fire({
            icon: 'error',
            title: ' error'
          });
        }
      },
      cache: false,
      contentType: false,
      processData: false
    });
    return false;
  }

  $(document).ready(function () {
    var base_url = "<?php echo $base_link; ?>";
      $('#fyear-form').validate({
        rules: {
          fyear: {
            required: true
          },
        }, messages: {
          guide_name: {
            required: "Financial year is required",
        },
      }, submitHandler: function (form) {
        update_fyear();
        return false; // required to block normal submit since you used ajax
      }
    });
  }); // end document.ready
</script>
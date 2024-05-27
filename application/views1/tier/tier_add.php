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

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><?=$title;?></h3>

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
            <form action="<?php echo base_url(); ?>tier/save" id="tier-form"  method="post">
                <fieldset>
                    <div class="row">

                        <div class="col-sm-6">
                               <div class="form-group">
                            <label>Tier Name</label>

                            <input type="text" class="form-control" name="tier_name" id="tier_name" value="<?php echo isset($tier['tier_name']) ? $tier['tier_name'] : set_value(''); ?>">
                            <input type="hidden" class="form-control" name="tier_id" id="tier_id" value="<?php echo $tier['tier_id']; ?>">
                        </div>
                        </div>
                       <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Discount</label>
                        <input type="text" class="form-control" name="discount" id="discount" value="<?php echo isset($tier['discount']) ? $tier['discount'] : set_value(''); ?>">
                      </div>
                    </div> 
                    </div>

                    <div class="row">
                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Markup</label>
<input type="text" class="form-control" name="markup" id="markup" value="<?php echo isset($tier['markup']) ? $tier['markup'] : set_value(''); ?>">                      </div>
                    </div>
                  </div>
                  <div class="row">
                   <div class="col-sm-6">
                            <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter ..."><?php echo isset($tier['description']) ? $tier['description'] : set_value(''); ?></textarea>
                      </div>
                        </div>
                  </div>
                    <div class="col-sm-12">

                        <div class="col-sm-4">
                            <br>
                            <input type="submit" class="btn btn-success" value="<?php echo isset($btn_value) ? $btn_value : 'Save'; ?>">
                        </div>
                    </div>
                </fieldset>
            </form>
                <!--  results  here -->
                <br><div id="results"></div>
 </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";

        $('#tier-form').validate({
            rules: {
                tier_name: {
                    required: true
                },
                discount: {
                    required: true
                }
            }, messages: {
                tier_name: {
                    required: "Please enter tier name",
                },
                discount: {
                    required: "Please enter discount",
                }
            },
           
            submitHandler: function (form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    success: function (data)
                    {
                        //$("#user-form").hide('slow');
                        if (data == "success") {
                            $('#results').removeClass('alert alert-danger');
                            $('#results').addClass('alert alert-success');
                            $('#results').html('tier successfully saved');
                            var URL = "<?php echo base_url(); ?>tier/";
                            setTimeout(function () {
                                window.location = URL;
                            }, 1000);
                        } else {
                            $('#results').addClass('alert alert-danger');
                            $('#results').html(data);
                        }

                    }
                });

                return false; // required to block normal submit since you used ajax
            }

        });
    }); // end document.ready
</script>
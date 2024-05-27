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
            <form action="<?php echo base_url(); ?>lead_source/save" id="lead_source-form"  method="post">
                <fieldset>
                    <div class="col-sm-12">

                        <div class="col-sm-4">
                            <label class="control-label" for="lead_source_name">Lead Source Name</label>

                            <input type="text" class="form-control" name="lead_source_name" id="lead_source_name" value="<?php echo isset($lead_source['lead_source_name']) ? $lead_source['lead_source_name'] : set_value(''); ?>">
                            <input type="hidden" class="form-control" name="ls_id" id="ls_id" value="<?php echo $lead_source['ls_id']; ?>">

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

        $('#lead_source-form').validate({
            rules: {
                lead_source_name: {
                    required: true
                }
            }, messages: {
                lead_source_name: {
                    required: "Please enter lead_source name",
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
                            $('#results').html('Lead Source successfully saved');
                            var URL = "<?php echo base_url(); ?>lead_source/";
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
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
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
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
          <h3 class="card-title">Select <?=$title;?></h3>

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
         <div class="col-sm-6">
            <form action="<?php echo base_url(); ?>financial_year/save" id="fyear-form" class="" method="post">
                      <!-- radio -->
                      <div class="form-group">
                        
                        <div class="form-check">
                          <input class="form-check-input fyear" type="radio" name="fyear" id="january" value="1" onChange="updateFynYear(this.checked ,this.value)">
                          <label class="form-check-label">January to December</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="fyear" id="april" value="2" >
                          <label class="form-check-label">April to March</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="fyear" id="june" value="3" >
                          <label class="form-check-label">June to May</label>
                        </div><br>
                        <div class="form-check col-sm-2">
                          <button type="button" class="btn btn-block btn-success btn-sm" onClick="update_fyear()">Update</button>
                        </div> 
                      </div>
                      </form>
                     
                    </div>
<div id="results"></div>
        </div>
        <!-- /.card-body -->
       </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    
    $(function() {
     $.getJSON("<?php echo base_url(); ?>financial_year/get_fyear", function(result){
          if(result.f_year==1){
              $('#january').prop('checked', true);
          }else if(result.f_year==2){
              $('#april').prop('checked', true);
          } else{
              $('#june').prop('checked', true);
          }
        });
    });

  
      function update_fyear() {
        var formData = new FormData($("#fyear-form")[0]);
        $('#results').removeClass('alert');
        $.ajax({
            url: '<?php echo base_url();  ?>financial_year/save',
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                if ($.trim(data) == "success") {
                    $('#results').addClass('alert alert-success');
                    $('#results').html('Financial year successfully Updated');
                } else {
                    $('#results').addClass('alert alert-danger');
                    $('#results').html('error');
                }
                
                 var element = document.getElementById('results');
                 element.style.display = "block";
  setTimeout(function() {
    element.style.display = "none";
  }, 2000).fadeOut('slow'); // 1000ms = 1 second
            },
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    }
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";

        $('#fyear-form').validate({
            rules: {
                fyear: {
                       required: true
                },
                               
            }, messages: {
                guide_name: {
                    required: "Financial year is required",
                    },
                },
            submitHandler: function (form) {
                update_fyear();
           
                

                return false; // required to block normal submit since you used ajax
            }

        });
    }); // end document.ready
  </script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$title?> </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?=$title?></a></li>
              <li class="breadcrumb-item active"><?=$title1?> </li>
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
          <h3 class="card-title"><?=$title1?></h3>

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
         <form class="well form-horizontal" action="<?php echo base_url(); ?>contact/save" method="post"  id="contact_form" enctype="multipart/form-data">
                        <fieldset>

<div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Student Name</label>
                        <input type="text" id="contact_name"  name="contact_name" class="form-control" placeholder="Enter ..." value="<?php echo $contact['contact_name']?>"  >
                        <input type="hidden" id="contact_id"  name="contact_id" class="form-control"  value="<?php echo $contact['contact_id']?>"  >
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Parent/Guardian</label>
                        <?php echo form_dropdown('acc_id', $accounts, isset($contact['acc_id']) ? $contact['acc_id'] : '1', 'id="acc_id" class="form-control"'); ?> 
                      </div>
                    </div>
                  </div>
<div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Register Number</label>
                        <input type="text" id="reg_num"  name="reg_num" class="form-control" placeholder="Enter ..." value="<?php echo $contact['reg_num']?>"  >
                      </div>
                    </div>

                    <div class="form-group">
                        <label>Student Picture</label>
 <input type="file" id="std_photo"  name="std_photo" class="form-control" placeholder="Enter ..." onchange="previewFile(this);"  >
 <input type="hidden" class="form-control"  value="<?php echo isset($contact['std_photo']) ? $contact['std_photo'] : set_value(''); ?>">
                      </div>
                    </div>
                  </div>
<div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                     <div class="col-sm-6">
                      <div class="form-group">
                        <label>Home Address</label>
                        <textarea id="address" name="address" class="form-control" placeholder="Enter ..." rows="5" cols="10"><?=$contact['address'];?></textarea>
                      </div>
                    </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label></label>
                        <img id='img-upload' height="200px" width="200px" src="<?php echo base_url();  ?>assets/img/student/<?php echo isset($contact['std_photo']) ? $contact['std_photo'] :'no_img.png'; ?>">
                        
                      </div>
                    </div>
                  </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Billing Address</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                        <textarea class="form-control" name="billing_address" placeholder="Billing Address"><?php echo $contact['address'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label">City</label>  
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                        <input name="city" placeholder="city" class="form-control" value="<?php echo $contact['city'] ?>" type="text">
                                    </div>
                                </div>
                            </div>
                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label">Phone #</label>  
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        <input name="alternate_phone" placeholder="0372221111" class="form-control" value="<?php echo $contact['alternate_phone'] ?>" type="text">
                                    </div>
                                </div>
                            </div>
                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label">Office Phone #</label>  
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        <input name="office_phone" placeholder="" class="form-control" value="<?php echo $contact['office_phone'] ?>" type="text">
                                    </div>
                                </div>
                            </div>
                           

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success" ><?=$btn_value?$btn_value:'Save';?> <span class="glyphicon glyphicon-user"></span></button>
                                    <button type="reset" class="btn btn-default" >Clear <span class="glyphicon glyphicon-brush"></span></button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
        </div>
          <div class="row">
              <div class="col-sm-12">
                  <!-- Success message -->
                            <div class="alert "  role="alert" id="results"> </div>
              </div>
          </div>
        <!-- /.card-body -->
     

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <!-- Page specific script -->
<script type="text/javascript">
    function save_contact() {
        var img_path = "<?php echo base_url() ?>assets/img/loading.gif";
        var formData = new FormData($("#contact_form")[0]);
        $.ajax({
            url: '<?php echo base_url();  ?>contact/save',
            type: 'POST',
            data: formData,
            async: false,
            beforeSend: function () {
                    $('#results').html("<div align='center' class='col-md-4 col-md-offset-4'> <img src= " + img_path + "></div>");
                },
            success: function (data) {
                if ($.trim(data) == "success") {
                    $('#results').addClass('alert alert-success');
                    $('#results').html('Student successfully saved');
                } else {
                    $('#results').addClass('alert alert-danger');
                    $('#results').html('error');
                }
                var URL = "<?php echo base_url();  ?>contact/";
              setTimeout(function(){ window.location = URL; }, 1000);
            },
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    }
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";

        $('#contact_form').validate({
            rules: {
                contact_name: {
                    minlength: 2,
                    required: true
                },
                acc_id: {
                    required: true,
                }
            }, messages: {
                contact_name: {
                    required: "Please enter a Student name",
                    minlength: "Your Student name must consist of at least 3 characters"
                }
            },
            highlight: function (element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function (element) {
                element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
            },
            submitHandler: function (form) {
                save_contact();
           
                

                return false; // required to block normal submit since you used ajax
            }

        });
    }); // end document.ready
    
    $(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#std_photo").change(function(){
		    readURL(this);
		}); 	
	});
</script>
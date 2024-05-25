<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$title?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?=$title?></a></li>
              <li class="breadcrumb-item active"><?=$title?> Add</li>
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
          <h3 class="card-title"><?=$title?> Add</h3>

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
         <form class="well form-horizontal" action="<?php echo base_url(); ?>attendance/save" method="post"  id="acc_form">
                        <fieldset>
<div class="row">
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                                <label>Student Name</label> 

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                      <?php echo form_dropdown('contact_id', $contacts, '', 'id="contact_id"  class="form-control"'); ?> 
                                    </div>
              
                            </div>
                    </div>    
    <div class="col-sm-2">
                      <!-- text input -->
                      <div class="form-group"><label></label> <br>
                                    <button type="submit" class="btn btn-app bg-success" ><i class="fas fa-angle-double-up"></i>IN </button>

                                </div>
                            </div>
    <div class="col-sm-4">
        <div class="form-group"><label></label> 
         <img id='img-upload' height="200px" width="200px" src="<?php echo base_url();  ?>assets/img/student/no_img.png">
         </div>
    </div><div class="col-sm-2">
                      <a class="btn btn-lg  bg-warning">
                  <span class="badge bg-success"></span>
                  <i class="fas fa-barcode"></i> Scanner
                </a>
    </div></div>
                        </fieldset>
                    </form>
       
        </div> 
        <!-- /.card-body -->
     <!-- Success message -->
                         
     <div class="row">
               
            
<div class="alert "  role="alert" id="results">  <?=require_once 'attendance_list.php';?></div>
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";

        $('#acc_form').validate({
            rules: {
                contact_id: {
                   
                    required: true
                },
               
            }, messages: {
                contact_id: {
                    required: "Please enter a Student name",
                   
                }
            },
            highlight: function (element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            
            submitHandler: function (form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    success: function (data)
                    {
 
                     
                            $('#results').html(data);
                   
                      
                    }
                });

                return false; // required to block normal submit since you used ajax
            }

        });
    }); // end document.ready
    

    $("#contact_id").change(function(){
       var img_path = "<?php echo base_url() ?>assets/img/loading.gif";
       var contact_id= $("#contact_id").val();
		   $.ajax({
            url: '<?php echo base_url();  ?>contact/load_img',
            type: 'POST',
            data: {contact_id:contact_id},
           beforeSend: function () {
                    $('#img-upload').html("<div align='center' class='col-md-4 col-md-offset-4'> <img src= " + img_path + "></div>");
                },
            success: function (data) {

if($.trim(data)==0){
    var url1='<?php echo base_url();  ?>assets/img/student/no_img.png';
    }else{
var url1='<?php echo base_url();  ?>assets/img/student/'+$.trim(data);
}
 $("#img-upload").attr("src",url1);
            }
           
        });
		});

</script>
<script>
    function student_out(att_id) {

        var base_url = "<?php echo base_url(); ?>";
var res=confirm('are you sure you want to checkout student?');
if(res){
            $.ajax({
                type: "POST",
                url: base_url + 'attendance/update_attendace/',
                data: {att_id: att_id},
                success: function (data) {

                    $('#results').html(data);
$('#att_table').DataTable();
                }
            });
        }
    }

    $(document).ready(function () {
        $('#att_table').DataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 10,
        });


    });





</script>
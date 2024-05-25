 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Supplier Add
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Master Details</a></li>
        
        <li class="active">Supplier Add</li>
      </ol>
    </section>
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
 <!--            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
             /.box-header -->
            <div class="box-body">
    <form action="" enctype="multipart/form-data" name="supplier-form" id="supplier-form" class="well" method="post">
<fieldset>
    <div class="col-sm-12">
    <div class="col-sm-4">
        <label class="control-label" for="supplier_code">Supplier Code</label>
        <input type="text" class="form-control" name="supplier_code" id="supplier_code" readonly="" value="<?php echo isset($supplier['supplier_code'])?$supplier['supplier_code']:$code; ?>">
    </div>
    </div>
        <div class="col-sm-12">
    <div class="col-sm-4">
        <label class="control-label" for="supplier_name">Supplier Name</label>
        
            <input type="text" class="form-control" name="supplier_name" id="supplier_name" value="<?php echo isset($supplier['supplier_name'])?$supplier['supplier_name']:set_value('supplier_name'); ?>">
            <input type="hidden" class="form-control" name="supplier_id" id="supplier_id" value="<?php echo $supplier['supplier_id']; ?>">
        </div>
       
    </div>
 <div class="col-sm-12">
    <div class="col-sm-4">
        <label class="control-label" for="address">Address</label>
        
            <textarea class="form-control" name="address" id="address" rows="3" value=""><?php echo isset($supplier['supplier_address'])?$supplier['supplier_address']:set_value('address'); ?></textarea>
        </div>
    </div>
  <div class="col-sm-12">
    <div class="col-sm-4">
        <label class="control-label" for="email">Email Address</label>

            <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($supplier['supplier_email'])?$supplier['supplier_email']:set_value('email'); ?>">
        </div>


 <div class="col-sm-4">

        <label class="control-label" for="supplier_mobile">Supplier Contact Name</label>
  
            <input type="text" class="form-control" name="supplier_contact" id="supplier_contact" value="<?php echo isset($supplier['contact_name'])?$supplier['contact_name']:set_value('contact_name'); ?>">
        </div>
    </div>
 <div class="col-sm-12">
    <div class="col-sm-4">
        <label class="control-label" for="supplier_mobile">Supplier Mobile</label>

            <input type="text" class="form-control" name="supplier_mobile" id="supplier_mobile" value="<?php echo isset($supplier['supplier_mobile'])?$supplier['supplier_mobile']:set_value('supplier_mobile'); ?>">
        </div>
 
     <div class="col-sm-4">
        <label class="control-label" for="supplier_telephone">Supplier Telephone</label>

            <input type="text" class="form-control" name="supplier_telephone" id="supplier_telephone" value="<?php echo isset($supplier['supplier_telephone'])?$supplier['supplier_telephone']:set_value('supplier_telephone'); ?>">
        </div>
    </div>
 <div class="col-sm-12">
    <div class="col-sm-4">
        <label class="control-label" for="supplier_website">Supplier Website</label>

            <input type="text" class="form-control" name="supplier_website" id="supplier_website" value="<?php echo isset($supplier['supplier_website'])?$supplier['supplier_website']:set_value('supplier_website'); ?>">
        </div>
    </div>

 <div class="col-sm-12">
    <div class="col-sm-4">
        <label class="control-label" for="image">Supplier images</label>
       
            <input type="file" name="image1"  id="image1">
            <input type="hidden"  id="old_img" name="old_img" value="<?php echo isset($supplier['supplier_image'])?$supplier['supplier_image']:set_value('old_img'); ?>" />
        
    </div>
     <div class="col-sm-4">
    <table  id="img1_table" name="presentation_table" ><tbody class="files"><tr><td><img class="img-thumbnail"  src="<?php echo base_url(); ?>assets/img/upload/supplier/<?=$supplier['supplier_image'] ?>" width="150px" height="150px"></td></tr></tbody></table>
     </div>
 </div>
 <div class="col-sm-12">
    <div class="col-sm-6"><br>
            <input type="submit" class="btn btn-primary" value="<?php echo isset($btn_value)?$btn_value:'Save'; ?>">
        </div>
    </div>
</fieldset>
</form>
<!--  results  here -->
<div id="results"></div>
                           </div>
       <!--       /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
    function saveSupplier() {
        var formData = new FormData($("#supplier-form")[0]);
        $.ajax({
            url: '<?php echo base_url();  ?>supplier/saveSupplier',
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                if (data.trim() == "success") {
                    $('#results').addClass('alert alert-success');
                    $('#results').html('Supplier successfully saved');
                } else {
                    $('#results').addClass('alert alert-danger');
                    $('#results').html('error');
                }
                var URL = "<?php echo base_url();  ?>supplier";
                setTimeout(function(){ window.location = URL; }, 1000);
            },
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    }
    $(document).ready(function() {
        var base_url="<?php echo base_url(); ?>";

      function validateDonotSelect(value,element,param)
        {
            if(value == param)
            {
              return false;
            }
            else
            {
                return true;
            }
        }
        jQuery.validator.addMethod("do_not_select",validateDonotSelect,"Please select an option");

     $('#supplier-form').validate({
      rules: {
       supplier_name: {
        required: true
       },

       city: {
              do_not_select:'0'
            },
    
      },messages:{
          supplier_code: {
                       required: "Please enter a Supplier code"
                       },
          supplier_name: {
                       required: "Please enter a Supplier Name"
                       },
          city: {
          required: "Please select an option from the list"
         }
          
        //  email: "Please enter a valid email address",
      },
      highlight: function(element) {
       $(element).closest('.control-group').removeClass('success').addClass('error');
      },
      success: function(element) {
       element.text('').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
      },
        submitHandler: function(form) {
            saveSupplier();
            return false;
        }
        });

    }); // end document.ready

 jQuery('#image1').change(function()
    {
        var files = $("#image1")[0].files; 

        // if(files && files[0]) for(var i=0; i<files.length; i++) readImage( files[i] );

        var reader = new FileReader();
        var image  = new Image();

        reader.readAsDataURL(files[0]);

        reader.onload = function(_file)
        {
            image.src    = _file.target.result;              // url.createObjectURL(file);
            image.onload = function() {
                var w = '150',
                    h = '150',
                    t = files[0].type,                           // ext only: // file.type.split('/')[1],
                    n = files[0].name,
                    s = ~~(files[0].size/1024) +'KB';
                 $("#img1_table tbody").empty();
                $('#img1_table tbody').html('<tr><td><img id="previewImage" src="'+ this.src +'" width="150" height="150"></td><td>'+n+'</td></tr>');
            };
            image.onerror= function() {
                alert('Invalid file type: '+ files[0].type);
            };      
        };
    }); 

</script>
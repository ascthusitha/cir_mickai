
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 902.8px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Item List
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Item</a></li>
        <li class="active">Item list</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-body">
            <form action="" id="item-form" class="" method="post" enctype="multipart/form-data">
                <fieldset>
                    <div class="col-sm-12"><div class="col-sm-4">
                        <label class="wb-inv" for="item_name">Item Name</label>
                        
                            <input type="text" class="form-control" name="item_name" id="item_name" value="<?php echo isset($item['item_name']) ? $item['item_name'] : set_value('item_name'); ?>">
                            <input type="hidden" class="form-control" name="item_id" id="item_id" value="<?php echo $item['item_id']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-12">

                                <div class="col-sm-4">
                                    <label class="control-label" for="category">Category</label>
                                    <?php echo form_dropdown('category', $categories, isset($item['category_id']) ? $item['category_id'] : '0', 'id="category" class="form-control"'); ?> 
                                    

                                </div>

                            </div>
                     <div class="col-sm-12">

                                <div class="col-sm-4">
                        <label class="wb-inv" for="c_code">Code</label>
                        
                            <input type="text" class="form-control" name="c_code" id="c_code" value="<?php echo isset($item['item_code']) ? $item['item_code'] : set_value('c_code'); ?>">
                        </div>
                    </div>
                    <div class="col-sm-12">

                       <div class="col-md-6">
    <div class="form-group">
        <label>Upload Image</label>
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Browse… <input type="file" id="img_item" name="img_item">
                </span>
            </span>
            <input type="text" class="form-control" readonly value="<?php echo isset($item['image']) ? $item['image'] : set_value(''); ?>">
        </div>
        <div><br><img id='img-upload' height="82px" width="82px" src="<?php echo base_url();  ?>assets/img/item/<?php echo isset($item['image']) ? $item['image'] :'no_img.png'; ?>"></div>
    </div>
</div>
                    </div>
<!--                    <div class="col-sm-12">

                                <div class="col-sm-4">
                                    <label class="control-label" for="user_group">Supplier</label>
                                    <?php echo form_dropdown('supplier', $suppliers, isset($item['supplier_id']) ? $item['supplier_id'] : '0', 'id="supplier" class="form-control"'); ?> 
                                    

                                </div>

                            </div>-->
                    <div class="col-sm-12">

                                <div class="col-sm-4">
                                    <label class="wb-inv" for="c_code">Status</label><br>
                            
                                    <input type="radio"  class="radio-inline" name="c_status" id="c_status1" value="1" <?php echo ($item['item_status']=='1')?'checked':'checked' ?>>
                                    <label class="radio-inline" for="c_status1">Active</label>
                                    <input type="radio"  class="radio-inline" name="c_status" id="c_status2" value="0" <?php echo ($item['item_status']=='0')?'checked':'' ?>>
                                    <label class="radio-inline" for="c_status2">De Active</label>
                        </div>
                    </div>
                    
                     <div class="col-sm-12">
                                <div class="col-sm-6"><br>
                            <input type="submit" class="btn btn-primary" value="<?php echo isset($btn_value) ? $btn_value : 'Save'; ?>">
                        </div>
                    </div>
                </fieldset>
            </form><br>
            <!--  results  here -->
            <div id="results"></div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
    function save_item() {
        var formData = new FormData($("#item-form")[0]);
        $.ajax({
            url: '<?php echo base_url();  ?>item/save_item',
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                if ($.trim(data) == "success") {
                    $('#results').addClass('alert alert-success');
                    $('#results').html('Item successfully saved');
                } else {
                    $('#results').addClass('alert alert-danger');
                    $('#results').html('error');
                }
                var URL = "<?php echo base_url();  ?>item/";
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

        $('#item-form').validate({
            rules: {
                item_name: {
                    minlength: 2,
                    required: true
                },
                c_code: {
                    required: true,
                }
            }, messages: {
                item_name: {
                    required: "Please enter a item name",
                    minlength: "Your item name must consist of at least 3 characters"
                }
            },
            highlight: function (element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function (element) {
                element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
            },
            submitHandler: function (form) {
                save_item();
           
                

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

		$("#img_item").change(function(){
		    readURL(this);
		}); 	
	});
</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 902.8px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category List
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Category</a></li>
        <li class="active">Category list</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-body">
            <form action="<?php echo base_url(); ?>category/save_category" id="category-form" class="" method="post">
                <fieldset>
                    <div class="col-sm-12"><div class="col-sm-4">
                        <label class="wb-inv" for="category_name">Category Name</label>
                        
                            <input type="text" class="form-control" name="category_name" id="category_name" value="<?php echo isset($category['category_name']) ? $category['category_name'] : set_value('category_name'); ?>">
                            <input type="hidden" class="form-control" name="category_id" id="category_id" value="<?php echo $category['category_id']; ?>">
                        </div>
                    </div>
                     <div class="col-sm-12">

                                <div class="col-sm-4">
                        <label class="wb-inv" for="c_code">Code</label>
                        
                            <input type="text" class="form-control" name="c_code" id="c_code" value="<?php echo isset($category['category_code']) ? $category['category_code'] : set_value('c_code'); ?>">
                        </div>
                    </div>
                    <div class="col-sm-12">

                                <div class="col-sm-4">
                                    <label class="wb-inv" for="c_code">Status</label><br>
                            
                                    <input type="radio"  class="radio-inline" name="c_status" id="c_status1" value="1" <?php echo ($category['category_status']=='1')?'checked':'checked' ?>>
                                    <label class="radio-inline" for="c_status1">Active</label>
                                    <input type="radio"  class="radio-inline" name="c_status" id="c_status2" value="0" <?php echo ($category['category_status']=='0')?'checked':'' ?>>
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
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";

        $('#category-form').validate({
            rules: {
                category_name: {
                    minlength: 2,
                    required: true
                },
                c_code: {
                    required: true,
                }
            }, messages: {
                category_name: {
                    required: "Please enter a category name",
                    minlength: "Your category name must consist of at least 3 characters"
                }
            },
            highlight: function (element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function (element) {
                element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
            },
            submitHandler: function (form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    success: function (data)
                    {
                        //$("#company-form").hide('slow');
                        if (data == "success") {
                            $('#results').addClass('alert alert-success');
                            $('#results').html('Category successfully saved');
                        } else {
                            $('#results').addClass('alert alert-danger');
                            $('#results').html('error');
                        }
                        var URL = "<?php echo base_url(); ?>category/";
                        setTimeout(function () {
                            window.location = URL;
                        }, 1000);
                    }
                });

                return false; // required to block normal submit since you used ajax
            }

        });
    }); // end document.ready
</script>
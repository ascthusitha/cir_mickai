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

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?=$title;?> List</h3>

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
                <form action="<?php echo $base_link; ?>user_group_permission/saveUserGroupPermission" id="user_group_permission-form"  method="post">
                    <fieldset>
                        <div class="card-header">
           
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="from-group ">
                                        <label>User Group</label>

                                        <?php echo form_dropdown('user_group', $user_groups, isset($user_group_permission['user_group_id']) ? $user_group_permission['user_group_id'] : '0', 'id="user_group" onchange="checkButton(this.value)" class="custom-select"'); ?> 
                                        <input type="hidden" name="user_group_id" id="user_group_id" value="<?php echo $user_group_permission['user_group_id']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-8">

                                    <span class="pull-right"><label class="checkbox">
                                        <input type="checkbox" id="select_all" name="select_all" /> All</label>
                                    </span>
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <?php foreach ($permission_categories as $permission_cat) { ?>
                                <div class="col-md-3">
                                    <div class="card <?php echo $permission_cat['card'];?>">
                                        <div class="card-header">
                                            <h3 class="card-title"><?php echo $permission_cat['name'];?></h3>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                                $pc_id = $permission_cat['id'];
                                                $p_array = $permission_links[$pc_id];
                                                if(!is_null($p_array)){
                                                foreach ($p_array as $p_link) {
                                                    if (in_array($p_link['id'], $user_group_permissions)) {
                                                        $chk = 'checked';
                                                    }else{
                                                        $chk = '';
                                                    }
                                            ?>
                                                <div class="checkbox anim-checkbox">
                                                    <input type="checkbox"  name="pchk[<?php echo $p_link['id']; ?>]" class="primary" id="pchk[<?php echo $p_link['id']; ?>]" value="1" <?php echo $chk; ?>/>
                                                    <label for="pchk[<?php echo $p_link['id']; ?>]"><?php echo $p_link['name'];?></label>
                                                </div>
                                            <?php }} ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row">  
                            <div class="divider" ></div>
                            <div class="controls col-sm-12 "><br>
                                <div class="controls">
                                    <input type="submit" name="user_permission_button" id="user_permission_button" class="btn btn-primary" value="<?php echo isset($btn_value) ? $btn_value : 'Save'; ?>">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            <br>
            <div id="results"></div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {

        $('#user_group').change(function () {
            var user_group = $(this).val();
            window.location = "<?php echo $base_link.'user_group_permission/view/';?>"+this.value;
        });


        var base_url = "<?php echo base_url(); ?>";

        $('#user_group_permission-form').validate({
            rules: {
                user_group: {
                    required: {
                        depends: function (element) {
                            return $("#user_group").val() == "";
                        }
                    }
                }
            }, messages: {
                user_group: {
                    required: "Please select an option from the list"
                },
            },
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('success').addClass('error');
            },
            success: function (element) {
                element.text('OK!').addClass('valid').closest('.form-group').removeClass('error').addClass('success');
            },
            submitHandler: function (form) {
//    var u_group=$('user_group').val();
//    var se_group=$('user_group_id').val();
//    if(u_group==se_group){
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    success: function (data)
                    {
                        //$("#agency-form").hide('slow');
                        if (data == "success") {
                            $('#results').addClass('alert alert-success');
                            $('#results').html('User group permission successfully saved');
                        } else {
                            $('#results').addClass('alert alert-danger');
                            $('#results').html('error');
                        }
                        var URL = "<?php echo base_url(); ?>index.php/user_group_permission/listing";
                        //setTimeout(function () {  window.location = URL;}, 1500);
                    }
                });

                return false; // required to block normal submit since you used ajax
            }

        }
//}else{
//            
//             alert('Please update selected user group permission' ); 
//} 
        );
    }); // end document.ready
    $(document).ready(function () {
        $('#select_all').click(function (event) {  //on click
            if (this.checked) { // check select status
                $(':checkbox').each(function () { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox1"              
                });
            } else {
                $(':checkbox').each(function () { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1"                      
                });
            }
        });

    });
    function checkButton(value) {

        var user_group_id = $('#user_group_id').val();
        if (user_group_id != value) {
            $('#user_permission_button').attr('disabled', 'disabled');
        } else {
            $('#user_permission_button').removeAttr('disabled', 'disabled');
        }
    }
</script>
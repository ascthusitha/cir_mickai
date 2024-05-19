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
                        ******
                        <div class="row">
 <div class="col-md-3">

            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Admin</h3>
              </div>
              <div class="card-body">
                 <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="master_details" class="primary" id="master_details" value="1" <?php echo ($user_group_permission['master_details'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="master_details">Default</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="company" class="primary" id="company" value="1" <?php echo ($user_group_permission['company'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="f_year">Financial Year</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="f_year" class="primary" id="f_year" value="1" <?php echo ($user_group_permission['f_year'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="g_rate">User Group</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="g_rate_add" class="primary" id="g_rate_add" value="1" <?php echo ($user_group_permission['g_rate_add'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="g_rate_add">User Permission</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="user_list" class="primary" id="user_list" value="1" <?php echo ($user_group_permission['u_list'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="user_add">User List</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="sales_target" class="primary" id="sales_target" value="1" <?php echo ($user_group_permission['u_list'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="user_list">Sales Target</label>
                                    </div>
                                   

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</div>
<div class="col-md-3">

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Activities</h3>
              </div>
              <div class="card-body">
                                    <div class="checkbox anim-checkbox">

                                        <input type="checkbox"  name="category" class="primary" id="category" value="1" <?php echo ($user_group_permission['activity'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="category">Default</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox"  name="phone_call" class="primary" id="phone_call" value="1" <?php echo ($user_group_permission['phone_call'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="phone_call">Phone Call</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox"  name="sales_call" class="primary" id="sales_call" value="1" <?php echo ($user_group_permission['sales_call'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="sales_call">Sales Call List</label>
                                    </div>
                                     <div class="checkbox anim-checkbox">
                                        <input type="checkbox"  name="meeting" class="primary" id="meeting" value="1" <?php echo ($user_group_permission['meeting'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="meeting">Meeting List</label>
                                    </div>
                                                </div>          </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
                  
<div class="col-md-3">

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Calender</h3>
              </div>
              <div class="card-body">
                                    <div class="checkbox anim-checkbox">

                                        <input type="checkbox"  name="load_user" class="primary" id="load_user" value="1" <?php echo ($user_group_permission['load_user'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="load_user">Load User</label>
                                    </div>
                                   

                             </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
                           </div>
 <div class="col-md-3">

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Customer</h3>
              </div>
              <div class="card-body">
                                    <div class="checkbox anim-checkbox">

                                        <input type="checkbox"  name="customer" class="primary" id="customer" value="1" <?php echo ($user_group_permission['customer'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="customer">Default</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox"  name="cus_add" class="primary" id="cus_add" value="1" <?php echo ($user_group_permission['cus_add'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="cus_add">Customer Add</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox"  name="cus_list" class="primary" id="cus_list" value="1" <?php echo ($user_group_permission['cus_list'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="cus_list">Customer List</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox"  name="cus_list_all" class="primary" id="cus_list_all" value="1" <?php echo ($user_group_permission['cus_list_all'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="cus_list_all">View All</label>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-2" style="display: block">

                                    <h4> Company </h4>
                                    <div class="checkbox anim-checkbox">

                                       <input type="checkbox"  name="collection_view" class="primary" id="collection_view" value="1" <?php echo ($user_group_permission['collection_view'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="collection_view">option1</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                       <input type="checkbox"  name="arius_view" class="primary" id="arius_view" value="1" <?php echo ($user_group_permission['arius_view'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="arius_view">option2</label>
                                    </div>
                                    
                                </div> -->
                                     </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
    
                              
<div class="col-md-3">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Report</h3>
              </div>
              <div class="card-body">
                <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="report" class="primary" id="report" value="1" <?php echo ($user_group_permission['report'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="report">Default</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="r_sales" class="primary" id="r_sales" value="1" <?php echo ($user_group_permission['r_sales'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="r_sales">Daily Sales Summary </label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="r_stock" class="primary" id="r_stock" value="1" <?php echo ($user_group_permission['r_stock'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="r_stock">Daily Stock Summary </label>
                                    </div>
                                    
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="r_stock_book" class="primary" id="r_stock_book" value="1" <?php echo ($user_group_permission['r_stock_book'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="r_stock_book"> Stock  Book</label>
                                    </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
                        
<div class="col-md-3">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Report</h3>
              </div>
              <div class="card-body">
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="hr_details" class="primary" id="hr_details" value="1" <?php echo ($user_group_permission['hr_details'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="hr_details">Default</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="salary" class="primary" id="salary" value="1" <?php echo ($user_group_permission['hr_salary'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="salary">Salary</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="u_leave" class="primary" id="u_leave" value="1" <?php echo ($user_group_permission['hr_leave'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="u_leave">Leave</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="m_grade" class="primary" id="m_grade" value="1" <?php echo ($user_group_permission['hr_m_grade'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="m_grade">Member Grade</label>
                                    </div>
          </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
                           </div>
                             <div class="col-md-3">

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Order</h3>
              </div>
              <div class="card-body">

                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox"  name="order" class="primary" id="order" value="1" <?php echo ($user_group_permission['order'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="order">Default</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="order_list" class="primary" id="order_list" value="1" <?php echo ($user_group_permission['order_list'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="order_list">Order List</label>
                                    </div>
                               </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
                           </div>
                     <div class="col-md-3">

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Item</h3>
              </div>
              <div class="card-body">
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox"  name="item" class="primary" id="item" value="1" <?php echo ($user_group_permission['item'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="item">Default</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="item_add" class="primary" id="item_add" value="1" <?php echo ($user_group_permission['item_add'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="loan_new">Item Add</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="item_list" class="primary" id="item_list" value="1" <?php echo ($user_group_permission['item_list'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="loan_list">Item List</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="import" class="primary" id="import" value="1" <?php echo ($user_group_permission['import'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="loan_approve">Import</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="bar_code" class="primary" id="bar_code" value="1" <?php echo ($user_group_permission['bar_code'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="loan_list_all">Bar code</label>
                                    </div>

                                            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
                           </div>
                                
<div class="col-md-3">

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Purchase</h3>
              </div>
              <div class="card-body">
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="inventory" class="primary" id="inventory" value="1" <?php echo ($user_group_permission['inventory'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="inventory">Default</label>
                                    </div>
                                    
                                    
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="inv_list" class="primary" id="inv_list" value="1" <?php echo ($user_group_permission['inv_list'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="inv_list">Inventory List</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="inv_purch" class="primary" id="inv_purch" value="1" <?php echo ($user_group_permission['inv_purch'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="inv_purch">Purchase Order List</label>
                                    </div>
                                    <div class="checkbox anim-checkbox">
                                        <input type="checkbox" name="inv_purch_add" class="primary" id="inv_purch_add" value="1" <?php echo ($user_group_permission['inv_purch_add'] == 1 ? 'checked' : ''); ?>/>
                                        <label for="inv_purch_add">Purchase Order Add</label>
                                    </div>
                                    
                               </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
                           </div>
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
                          <!-- /.card-body -->


      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {

        $('#user_group').change(function () {
            var user_group = $(this).val();

            $.ajax({
                url: "<?php echo $base_link; ?>user_group_permission/load_user_permission/" + user_group,
                secureuri: false,
                dataType: 'json',
                success: function (data) {

                    
                    // start pos
                    if (data.pos == 1) {
                        $('#pos').prop('checked', true);
                    } else {
                        $('#pos').prop('checked', false);
                    }
                    // end pos
                    // approval
                     if (data.approval == 1) {
                        $('#approval').prop('checked', true);
                    } else {
                        $('#approval').prop('checked', false);
                    }
                    if (data.approval_list == 1) {
                        $('#approval_list').prop('checked', true);
                    } else {
                        $('#approval_list').prop('checked', false);
                    }
                    if (data.approval_out == 1) {
                        $('#approval_out').prop('checked', true);
                    } else {
                        $('#approval_out').prop('checked', false);
                    }
                    // end approval
                    //start customer
                    if (data.customer == 1) {
                        $('#customer').prop('checked', true);
                    } else {
                        $('#customer').prop('checked', false);
                    }
                    if (data.cus_add == 1) {
                        $('#cus_add').prop('checked', true);
                    } else {
                        $('#cus_add').prop('checked', false);
                    }
                    if (data.cus_list == 1) {
                        $('#cus_list').prop('checked', true);
                    } else {
                        $('#cus_list').prop('checked', false);
                    }
                    if (data.cus_list_all == 1) {
                        $('#cus_list_all').prop('checked', true);
                    } else {
                        $('#cus_list_all').prop('checked', false);
                    }
                    //end customer
                    //order
                    if (data.order == 1) {
                        $('#order').prop('checked', true);
                    } else {
                        $('#order').prop('checked', false);
                    }
                    if (data.order_list == 1) {
                        $('#order_list').prop('checked', true);
                    } else {
                        $('#order_list').prop('checked', false);
                    }
                    //end order
                        //start item
                    if (data.item == 1) {
                        $('#item').prop('checked', true);
                    } else {
                        $('#item').prop('checked', false);
                    }
                    if (data.item_add == 1) {
                        $('#item_add').prop('checked', true);
                    } else {
                        $('#item_add').prop('checked', false);
                    }
                    if (data.item_list == 1) {
                        $('#item_list').prop('checked', true);
                    } else {
                        $('#item_list').prop('checked', false);
                    }
                    if (data.import == 1) {
                        $('#import').prop('checked', true);
                    } else {
                        $('#import').prop('checked', false);
                    }
                    if (data.bar_code == 1) {
                        $('#bar_code').prop('checked', true);
                    } else {
                        $('#bar_code').prop('checked', false);
                    }
                    //end item
                    //start inventory
                    if (data.inventory == 1) {
                        $('#inventory').prop('checked', true);
                    } else {
                        $('#inventory').prop('checked', false);
                    }
                    if (data.inv_purch == 1) {
                        $('#inv_purch').prop('checked', true);
                    } else {
                        $('#inv_purch').prop('checked', false);
                    }
                    if (data.inv_purch_add == 1) {
                        $('#inv_purch_add').prop('checked', true);
                    } else {
                        $('#inv_purch_add').prop('checked', false);
                    }
                    if (data.inv_list == 1) {
                        $('#inv_list').prop('checked', true);
                    } else {
                        $('#inv_list').prop('checked', false);
                    }if (data.sup_list == 1) {
                        $('#sup_list').prop('checked', true);
                    } else {
                        $('#sup_list').prop('checked', false);
                    }
                    if (data.sup_add == 1) {
                        $('#sup_add').prop('checked', true);
                    } else {
                        $('#sup_add').prop('checked', false);
                    }
                    //end inventory
                    //start category
                     if (data.category == 1) {
                        $('#category').prop('checked', true);
                    } else {
                        $('#category').prop('checked', false);
                    }
                    if (data.cat_add == 1) {
                        $('#cat_add').prop('checked', true);
                    } else {
                        $('#cat_add').prop('checked', false);
                    }
                    if (data.cat_list == 1) {
                        $('#cat_list').prop('checked', true);
                    } else {
                        $('#cat_list').prop('checked', false);
                    }
                    //end category
                    //start report
                    if (data.report == 1) {
                        $('#report').prop('checked', true);
                    } else {
                        $('#report').prop('checked', false);
                    }
                    if (data.r_sales == 1) {
                        $('#r_sales').prop('checked', true);
                    } else {
                        $('#r_sales').prop('checked', false);
                    }
                    if (data.r_stock_book == 1) {
                        $('#r_stock_book').prop('checked', true);
                    } else {
                        $('#r_stock_book').prop('checked', false);
                    }
                    if (data.r_stock == 1) {
                        $('#r_stock').prop('checked', true);
                    } else  {
                        $('#r_stock').prop('checked', true);
                    }
                    
                    //end report
                    if (data.collection_view == 1) {
                        $('#collection_view').prop('checked', true);
                    } else {
                        $('#collection_view').prop('checked', false);
                    }
                    if (data.arius_view == 1) {
                        $('#arius_view').prop('checked', true);
                    } else {
                        $('#arius_view').prop('checked', false);
                    }
                   
                    if (data.hr_m_grade == 1) {
                        $('#m_grade').prop('checked', true);
                    } else {
                        $('#m_grade').prop('checked', false);
                    }
                    if (data.master_details == 1) {
                        $('#master_details').prop('checked', true);
                    } else {
                        $('#master_details').prop('checked', false);
                    }
                    if (data.company == 1) {
                        $('#company').prop('checked', true);
                    } else {
                        $('#company').prop('checked', false);
                    }
                    if (data.g_rate == 1) {
                        $('#g_rate').prop('checked', true);
                    } else {
                        $('#g_rate').prop('checked', false);
                    }
                    if (data.g_rate_add == 1) {
                        $('#g_rate_add').prop('checked', true);
                    } else {
                        $('#g_rate_add').prop('checked', false);
                    }
                    if (data.user_add == 1) {
                        $('#user_add').prop('checked', true);
                    } else {
                        $('#user_add').prop('checked', false);
                    }
                    if (data.user_list == 1) {
                        $('#user_list').prop('checked', true);
                    } else {
                        $('#user_list').prop('checked', false);
                    }
                    if (data.u_group_add == 1) {
                        $('#u_group_add').prop('checked', true);
                    } else {
                        $('#u_group_add').prop('checked', false);
                    }
                    if (data.u_permission == 1) {
                        $('#u_permission').prop('checked', true);
                    } else {
                        $('#u_permission').prop('checked', false);
                    }

                    
                    
                }
            });
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
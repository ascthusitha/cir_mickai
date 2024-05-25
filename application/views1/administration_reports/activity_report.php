<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');
$this->load->helper("form");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Activity Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Reports</a></li>
              <li class="breadcrumb-item active">Activity Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php
      $activity_types = array(
                      "1" => "Sales Calls",
                      "2" => "Phone Calls",
                      "3" => "Tasks",
                      "4" => "Opportunities",
                      "5" => "Time Sheet"
                    );
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <form accept-charset="utf-8" class="well form-horizontal" action="<?php echo $base_link.$this->uri->uri_string();?>" method="post"  id="search_form">
                  <fieldset>
                    <div class="card card-secondary">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Account Name</label>
                              <select id="acc_id" name="acc_id" class="form-control" title="Account">
                                <option value=''>--All--</option>
                                <?php foreach ($accounts as $temp_acc_id => $temp_acc) {  if($acc_id_current == $temp_acc_id){ echo "<option value='".$temp_acc_id."' selected>".$temp_acc."</option>";  }else{ echo "<option value='".$temp_acc_id."'>".$temp_acc."</option>"; }} ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Assign To</label>
                              <select id="assign_to" name="assign_to" class="form-control" title="Assign TO">
                                <option value=''>--All--</option>
                                <?php foreach ($users as $temp_user_id => $temp_user) {  if($assign_to_current == $temp_user_id){ echo "<option value='".$temp_user_id."' selected>".$temp_user."</option>";  }else{ echo "<option value='".$temp_user_id."'>".$temp_user."</option>"; }} ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Activity Type</label>
                              <select id="activity_type" name="activity_type" class="form-control" title="Activity Type">
                                <option value=''>--All--</option>
                                <?php foreach ($activity_types as $temp_activity_id => $temp_activity) {  if($activity_id_current == $temp_activity_id){ echo "<option value='".$temp_activity_id."' selected>".$temp_activity."</option>";  }else{ echo "<option value='".$temp_activity_id."'>".$temp_activity."</option>"; }} ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Product</label>
                              <select id="product_id" name="product_id" class="chosen-select form-control text-tip" title="Product">
                                <option value="0"> [ Please Select ] </option>
                                <?php
                                  foreach ($products as $product) {
                                    if($product->id == $phone_call['product_id1']){
                                      echo "<option value='".$product->id."' selected='selected'>".$product->name."</option>";
                                    }else{
                                      echo "<option value='".$product->id."'>".$product->name."</option>";
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>From Date</label>
                              <input type="text" id="from_date" name="from_date" class="form-control datepicker" value="<?= $from_date; ?>" placeholder="Enter ..." autocomplete="off">
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>To Date</label>
                              <input type="text" id="to_date" name="to_date" class="form-control datepicker" value="<?= $to_date; ?>" placeholder="Enter ..." autocomplete="off">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group float-right">
                              <button type="submit" class="btn btn-info"><i class="fas fa-search"></i> Search</button>
                              <button type="reset" class="btn btn-default" >Clear </button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div> 
                  </fieldset>
                </form>
              </div>
              <!-- /.card-header -->
              <?php if($report_display){?>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Contact</th>
                    <th>Account</th>
                    <th>Product</th>
                    <th>Start On</th>
                    <th>End On</th>
                    <th>Activity Type</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    foreach ($activities as $activity) {
                  ?>
                    <tr>
                      <td><?php echo $activity->subject;?></td>
                      <td><?php echo $activity->description;?></td>
                      <td><?php echo $activity->contact_person;?></td>
                      <td><?php echo $activity->acc_name;?></td>
                      <td>
                        <?php 
                          if($activity->product1 != '' && $activity->product2 != ''){
                            echo $activity->product1.'<Br>';
                            echo $activity->product2;
                          }elseif($activity->product1 != ''){
                            echo $activity->product1;
                          }elseif($activity->product2 != ''){
                            echo $activity->product2;
                          }
                        ?>
                      </td>
                      <td><?php echo $activity->start_date.' '.$activity->start_time;?></td>
                      <td><?php echo $activity->end_date.' '.$activity->end_time;?></td>
                      <td><?php echo $activity->activity_type;?></td>
                      <td><?php echo $activity->status;?></td>
                      <td><?php echo $activity->assign_to;?></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Contact</th>
                    <th>Account</th>
                    <th>Product</th>
                    <th>Start On</th>
                    <th>End On</th>
                    <th>Activity Type</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <?php }?>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function () {

        $("#from_date").datepicker({
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd',
            beforeShow: function () {
                $(".ui-datepicker").css('font-size', 12)
            }
        });
        $("#to_date").datepicker({
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd',
            beforeShow: function () {
                $(".ui-datepicker").css('font-size', 12)
            }
        });
   
    }); // end document.ready
</script>

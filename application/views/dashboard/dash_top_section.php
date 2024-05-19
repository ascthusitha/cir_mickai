<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');?>
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $dash['phone_calls_count'];?></h3>
                <p>Doctor Appointment</p>
            </div>
            <div class="icon">
                <i class="fas fa-phone"></i>
            </div>
            <a href="<?php echo $base_link; ?>phone_call" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo $dash['sales_calls_count'];?><sup style="font-size: 20px"></sup></h3>
                <p>External Appointments</p>
            </div>
            <div class="icon">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <a href="<?php echo $base_link; ?>sales_call" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?php echo $dash['tasks_count'];?></h3>
                <p>Alert/Reminders</p>
            </div>
            <div class="icon">
                <i class="fas fa-tasks"></i>
            </div>
            <a href="<?php echo $base_link; ?>task_detail" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?php echo $dash['Opportunities_count'];?></h3>
                <p>Opportunities</p>
            </div>
            <div class="icon">
                <i class="fas fa-bullseye"></i>
            </div>
            <a href="<?php echo $base_link; ?>opportunity" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

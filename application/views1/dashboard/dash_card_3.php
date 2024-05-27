<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');?>
<section class="col-lg-6 connectedSortable">
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"><i class="fas fa-bars"></i> Alert/Reminders</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Physician</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dash['my_tasks'] as $task_temp) { ?>
                        <tr>
                            <td><?php echo $task_temp['subject'];?></td>
                            <td><?php echo $task_temp['acc_name'];?></td>
                            <td>
                                <a href="<?php echo $base_link; ?>task_detail/view/<?php echo $task_temp['td_id'];?>" class="text-muted">
                                    <i class="fas fa-search"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');?>
<section class="col-lg-6 connectedSortable">
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"><i class="fas fa-bars"></i> External Appointment</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Patient</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dash['my_sales_calls'] as $scall_temp) { ?>
                        <tr>
                            <td><?php echo $scall_temp['subject'];?></td>
                            <td><?php echo $scall_temp['contact_name'];?></td>
                            <td>
                                <a href="<?php echo $base_link; ?>sales_call/view/<?php echo $scall_temp['sc_id'];?>" class="text-muted">
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

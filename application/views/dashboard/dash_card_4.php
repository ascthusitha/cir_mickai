<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');?>
<section class="col-lg-6 connectedSortable">
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"><i class="fas fa-bars"></i> My Opportunities</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>Opportunity</th>
                        <th>Sales Stage</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dash['my_opportunities'] as $opp_temp) { ?>
                        <tr>
                            <td><?php echo $opp_temp['opp_name'];?></td>
                            <td><?php echo $opp_temp['sales_stage'];?></td>
                            <td>
                                <a href="<?php echo $base_link; ?>opportunity/view/<?php echo $opp_temp['opp_id'];?>" class="text-muted">
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

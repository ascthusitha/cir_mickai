<section class="col-lg-6 connectedSortable">
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"><i class="fas fa-bars"></i> My Sales Calls</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Contact</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dash['my_sales_calls'] as $scall_temp) { ?>
                        <tr>
                            <td><?php echo $scall_temp['subject'];?></td>
                            <td></td>
                            <td>
                                <a href="#" class="text-muted">
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

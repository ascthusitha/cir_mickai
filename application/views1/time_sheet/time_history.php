<div class="card small">
    <div class="card-header border-0 ui-sortable-handle">
        <h3 class="card-title"><i class="fas fa-th mr-1"></i> Time tracking list</h3>
        <?php
        if($time_sheet['timer']!=0){
            $btn_at = 'style="display: none;"';
        }else{
            $btn_at = '';
        }
        ?>
        <div class="card-tools">
            <button type="button" class="btn btn-outline-primary btn-block btn-sm" data-toggle="modal" data-target="#modal-primary" id="btn_add_time" <?php echo $btn_at;?>><i class="fa fa-plus"></i> Add Time</button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Time</th>
                        <th>Source</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($time_tracker as $g) {
                            $from_timer = new DateTime($g->start);
                            $from_timer->setTimezone(new DateTimeZone('Asia/Colombo'));
                            $to_timer = new DateTime($g->end);
                            $to_timer->setTimezone(new DateTimeZone('Asia/Colombo'));
                            $time_diffr = $from_timer->diff($to_timer);
                            $xtemp_d = intval($time_diffr->format('%d'));
                            $xtemp_d = 24*$xtemp_d;
                            $xtemp_h = intval($time_diffr->format('%h'))+$xtemp_d;
                            $xtemp_m = intval($time_diffr->format('%i'));
                            $xtemp_s = intval($time_diffr->format('%s'));
                            $temp_h  = str_pad($xtemp_h, 2, '0', STR_PAD_LEFT);
                            $temp_m  = str_pad($xtemp_m, 2, '0', STR_PAD_LEFT);
                            $temp_s  = str_pad($xtemp_s, 2, '0', STR_PAD_LEFT);
                            switch ($g->source) {
                                case 0:
                                    $source = '<small class="badge badge-primary">Time tracker</small>';
                                    break;
                                case 1:
                                    $source = '<small class="badge badge-warning">Manual</small>';
                                    break;
                                default:
                                    $source = '';
                            }


                    ?>
                    <tr>
                        <td><?php echo $g->ufname.' '.$g->ulname;?></td>
                        <td><?php echo $g->start;?></td>
                        <td><?php echo $g->end;?></td>
                        <td><?php echo $temp_h.':'.$temp_m.':'.$temp_s;?></td>
                        <td><?php echo $source;?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
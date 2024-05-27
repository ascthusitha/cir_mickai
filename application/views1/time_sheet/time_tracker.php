<div class="card bg-gradient-info col-sm-10">
    <div class="card-header border-0 ui-sortable-handle">
        <h3 class="card-title"> <i class="fas fa-stopwatch mr-1"></i> Project Time</h3>
    </div>
    <div class="card-body">
        <?php
            $active_timer_style = 'style="display: none;"';
            $fixed_time_style = 'style="display: none;"';
            if($time_sheet['timer']){
                $from_time = new DateTime($time_sheet['timer_started']);
                $from_time->setTimezone(new DateTimeZone('Asia/Colombo'));
                $to_time = new DateTime();
                $to_time->setTimezone(new DateTimeZone('Asia/Colombo'));
                $time_diff = $from_time->diff($to_time);
                $temp_timer_d = intval($time_diff->format('%d'));
                $temp_timer_d = 24*$temp_timer_d;
                $temp_timer_h = intval($time_diff->format('%h'))+$temp_timer_d;
                $temp_timer_m = intval($time_diff->format('%i'));
                $temp_timer_s = intval($time_diff->format('%s'));
                $correct_timer_s = intval($time_sheet['timer_s'])+$temp_timer_s;
                $timer_s = $correct_timer_s % 60;
                $timer_m_temp = floor(($correct_timer_s / 60) % 60)+intval($time_sheet['timer_m'])+$temp_timer_m;
                $timer_m = $timer_m_temp % 60;
                $timer_h_temp = floor(($timer_m_temp / 60) % 60)+intval($time_sheet['timer_h'])+$temp_timer_h;
                $timer_h = str_pad($timer_h_temp, 2, '0', STR_PAD_LEFT);
                $active_timer_style = '';
                $fixed_time_style = 'style="display: none;"';
            }else{
                $timer_h = str_pad($time_sheet['timer_h'], 2, '0', STR_PAD_LEFT);
                $timer_m = str_pad($time_sheet['timer_m'], 2, '0', STR_PAD_LEFT);
                $timer_s = str_pad($time_sheet['timer_s'], 2, '0', STR_PAD_LEFT);
                $active_timer_style = 'style="display: none;"';
                $fixed_time_style = '';
            }
        ?>
        <div class="row active_timer" <?php echo $active_timer_style;?>>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="info-box bg-gradient-warning">
                        <div class="info-box-content h3">
                            <div id="countdown" class="info-box-number">
                                <span id="hour" class="timer"><?php echo $timer_h;?></span>:
                                <span id="min" class="timer"><?php echo $timer_m;?></span>:
                                <span id="sec" class="timer"><?php echo $timer_s;?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 allign-right">
                <button type="button" class="btn btn-app" id="btn_stop" ><i class="fas fa-stop"></i> Stop</button>
            </div>
        </div>
        <div class="row fixed_time" <?php echo $fixed_time_style;?>>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="info-box bg-gradient-warning">
                        <div class="info-box-content h3">
                            <div id="countdown_x" class="info-box-number">
                                <span id="hour_x" class="timer"><?php echo $timer_h;?></span>:
                                <span id="min_x" class="timer"><?php echo $timer_m;?></span>:
                                <span id="sec_x" class="timer"><?php echo $timer_s;?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 allign-right">
                <button type="button" class="btn btn-app" id="btn_start" ><i class="fas fa-play"></i> Start</button>
            </div>
        </div>
    </div>
</div>
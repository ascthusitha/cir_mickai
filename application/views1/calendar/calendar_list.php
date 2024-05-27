<?php
  $base_link = $this->config->item('base_url').$this->config->item('index_page');
  $permissionData = $this->session->userdata['permissionData'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Calendar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calendar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="sticky-top mb-3">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Activities</h4>
                </div>
                <div class="card-body">
                  <!-- the events -->
                  <div id="external-events">
                    <div class="external-event bg-yellow">Doctor Appointment</div>
                    <div class="external-event bg-green">External Appointment</div>
                    <div class="external-event bg-lightblue">Alert/Reminders</div>
                    <div class="external-event bg-red">Opportunity</div>
                    <div class="external-event bg-lime">Time Sheet</div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <?php if (in_array(18, $permissionData)) { ?>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">User</h3>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <select name="assign_to" id="assign_to" class="form-control">
                      <?php
                        foreach ($users as $user_temp => $r) {
                          if($user_id == $user_temp){
                            echo "<option value='".$user_temp."' selected>".$r."</option>";
                          }else{
                            echo "<option value='".$user_temp."'>".$r."</option>";
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- Page specific script -->
<script>
  $(function () {

    $( "#assign_to" ).change(function() {
      window.location = "<?php echo $base_link.'Calendar/index/';?>"+this.value;
    });

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (https://fullcalendar.io/docs/event-object)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
        };
      }
    });

    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap',
      //Random default events
      events: [
        <?php
          $colour = array();
          $colour['red']        = "#f56954";
          $colour['yellow']     = "#f39c12";
          $colour['blue']       = "#0073b7";
          $colour['aqua']       = "#00c0ef";
          $colour['green']      = "#00a65a";
          $colour['light-blue'] = "#3c8dbc";
          $colour['lime']       = "#01ff70";

          foreach ($calendar_activities as $activity) {
            $tmp_title    = $activity->subject;
            $sdate = $stime = $edate = $etime = NULL;
            $tmp_start = $tmp_end = $tmp_url = "";
            if($activity->start_date){ 
              $sdate = str_replace("-","/",$activity->start_date); 
              $tmp_start = $sdate;
            }
            if($activity->start_time){ 
              $stime = date("H:i:s", strtotime($activity->start_time)); 
              $tmp_start = $tmp_start.' '.$stime;
            }
            if($activity->end_date){ 
              $edate = str_replace("-","/",$activity->end_date); 
              $tmp_end = $edate;
            }
            if($activity->end_time){ 
              $etime = date("H:i:s", strtotime($activity->end_time)); 
              $tmp_end = $tmp_end.' '.$etime;
            }
            if($sdate == NULL ||  $stime == NULL ||  $edate == NULL ||  $etime == NULL){
              $tmp_all_day  = 'true';
            }else{
              $tmp_all_day  = 'false';
            }
            if($activity->activity_type==1){
              $tmp_bg_color     = $colour['green'];
              $tmp_border_color = $colour['green'];
              $tmp_url = $base_link."sales_call/view/".$activity->activity_id;
            }else if($activity->activity_type==2){
              $tmp_bg_color     = $colour['yellow'];
              $tmp_border_color = $colour['yellow'];
              $tmp_url = $base_link."phone_call/view/".$activity->activity_id;
            }else if($activity->activity_type==3){
              $tmp_bg_color     = $colour['light-blue'];
              $tmp_border_color = $colour['light-blue'];
              $tmp_url = $base_link."task_detail/view/".$activity->activity_id;
            }else if($activity->activity_type==4){
              $tmp_bg_color     = $colour['red'];
              $tmp_border_color = $colour['red'];
              $tmp_url = $base_link."opportunity/view/".$activity->activity_id;
            }else if($activity->activity_type==5){
              $tmp_bg_color     = $colour['lime'];
              $tmp_border_color = $colour['lime'];
              $tmp_url = $base_link."timesheet/view/".$activity->activity_id;
            }else{
              $tmp_bg_color     = $colour['aqua'];
              $tmp_border_color = $colour['aqua'];
            }
        ?>
        {
          title          : '<?php echo $tmp_title?>',
          start          : new Date('<?php echo $tmp_start?>'),
          end            : new Date('<?php echo $tmp_end?>'),
          url            : '<?php echo $tmp_url?>',
          backgroundColor: '<?php echo $tmp_bg_color?>',
          borderColor    : '<?php echo $tmp_border_color?>',
          allDay         : <?php echo $tmp_all_day?>
        },
        <?php } ?>
      ],
      editable  : false,
      droppable : false, // this allows things to be dropped onto the calendar !!!
      drop      : function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      }
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      // Save color
      currColor = $(this).css('color')
      // Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
      })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      // Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      // Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.text(val)
      $('#external-events').prepend(event)

      // Add draggable funtionality
      ini_events(event)

      // Remove event from text input
      $('#new-event').val('')
    })
  })
</script>

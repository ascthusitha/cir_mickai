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

                <table id='alert_table' class="table table-striped table-bordered">
                    <thead>
                        <tr>
                           <th>Alert Type</th>
                           <th>Contact Name </th>
                            <th> Mobile</th>
                            <th style="width:30%">Message </th>
                            <th> Date</th>
                            <th>time</th>
                            <th>Status</th>
                           </tr>
                    </thead>
                    <tbody>
                        <?php
                       
                            if (count($alerts)) {
                                foreach ($alerts as $alert) {
                                    echo "<tr>";
                                    echo "<td>".$alert->alert_type."</td>";
                                    echo "<td>".$alert->contact_name." ".$alert->contact_lname."</td>";
                                    echo "<td>+1 ".$alert->contact_value."</td>";
                                    echo "<td>".$alert->message."</td>";
                                    echo "<td>".Date('M-d-Y', strtotime($alert->alert_date))."</td>";
                                    echo "<td>".$alert->alert_time."</td>";
                                    echo "<td>".$alert->sms_status."</td>";
                                    //echo "<td>" . anchor('campaign/view/' . $campaign->campaign_id, $campaign->campaign_name) . "</td>";
                                   echo "</tr>";
                                }
                            }
                            ?></tbody>
                </table>
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
$(document).ready(function() {
    $('#alert_table').DataTable({
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 5,
    });
});

function deleteCampaign(campaign_id) {
    var val = confirm('Are you sure want to delete this  campaign ?');
    var base_url = "<?php echo base_url(); ?>";
    if (val) {
        $.ajax({
            type: 'POST',
            url: base_url + 'campaign/delete/',
            data: {
                campaign_id: campaign_id
            },
            success: function(data) {

                if (data == 'Success') {
                    alert(" Campaign Successfully Removed");
                    location.reload();
                } else {
                    alert(data);
                }
                //$('#transport_table').html(data);     
            }
        });
    } else {
        return false;
    }
}

$("#p6").addClass('active');
</script>

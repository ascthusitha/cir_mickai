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
                <?php 
           if ($this->session->userdata('cur_add') == 1) { 
                    echo anchor('campaign/add/', 'add new', array('class' => 'btn btn-success'));
           }?>
                <br><br>
                <table id='campaign_table' class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Campaign</th>
                            <th>Type</th>
                            <th>Message</th>
                            <th>Message Type</th>
                            <th>Stard Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>&nbsp; </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (count($campaigns)) {
                                foreach ($campaigns as $campaign) {
                                    echo "<tr>";
                                    echo "<td>" . anchor('campaign/view/' . $campaign->campaign_id, $campaign->campaign_name) . "</td>";
                                    echo "<td>". $campaign->campaign_type . "</td>";
																		echo "<td>". $campaign->message . "</td>";
																		echo "<td>". $campaign->message_type . "</td>";
																		echo "<td>". $campaign->start_date . "</td>";
																		echo "<td>". $campaign->end_date . "</td>";
																				echo "<td>". $campaign->status . "</td>";
                                    echo "<td><a href='javascript:void(0)' onclick='deleteCampaign($campaign->campaign_id)' role='button' class=' pull-right'><i class='fa fa-user'></i></a></td>";
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
    $('#campaign_table').DataTable({
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

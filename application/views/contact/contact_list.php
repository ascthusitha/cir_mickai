 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-3">
            <h1><?=$title;?></h1>
          </div>
          <div class="col-sm-1">
             <a href="<?php echo base_url(); ?>contact/add" class="btn btn-block bg-gradient-success btn-flat">Add New</a>
            
          </div>
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?=$title;?></a></li>
              <!-- <li class="breadcrumb-item active">Blank Page</li> -->
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
          <h3 class="card-title"><?=$title?></h3>
          
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <span class="pull-right pr-5">Total Contacts : <?=count($contact)?></span>
        </div>
        <div class="card-body">
           
           <table class="table table-striped table-bordered" width="100%"  id="contact_table">
                        <thead><tr>
                                <th>#</th>
                                <th>Contact Name</th>
                                <th>Account</th> 
                                <th>Office Phone</th>
                                <th>Mobile</th>
                                <th>Alternate Phone </th>
                                <th>Email </th>
                                <th>City</th>
                                <th>Created by</th>
                                <th>&nbsp; </th>
                            </tr></thead>
                        <tbody>
                            <?php
                            if (count($contact)) {
                                $i=1;
                              
                                foreach ($contact as $g) {
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . anchor('contact/view/' . $g->contact_id, $g->contact_name." ".$g->contact_lname) . "</td>";
                                    echo "<td> " . $g->acc_name ." </td>";
                                    echo "<td>" . $g->office_phone . "</td>";
                                    echo "<td>" . $g->mobile . "</td>";
                                    echo "<td>" . $g->alternate_phone . "</td>";
                                    echo "<td>" . $g->email . "</td>";
                                    echo "<td>" . $g->o_city . "</td>";
                                    echo "<td>" . $g->user_fname . "</td>";
                                    echo "<td><a href='javascript:void(0)' onclick='deleteContact($g->contact_id)' ><i class='fas fa-trash-alt' style='font-size:16px;color:red'></i></a></td>";
                                    echo "</tr>";
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                   
 <!-- /.card-body -->

        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
                   

<script type="text/javascript">
        $(document).ready(function () {
        $('#contact_table').DataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 5,
        });
    });
        function deleteContact(contact_id) {
        var val = confirm('Are you sure want to delete this  Contact ?');
        var base_url = "<?php echo base_url(); ?>";
        if (val) {
            $.ajax({
                type: 'POST',
                url: base_url + 'contact/delete/',
                data: {contact_id: contact_id},
                success: function (data) {

                    if ($.trim(data) == 'success') {
                        alert(" Contact Successfully Removed");
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
</script>


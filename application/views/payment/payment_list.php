<?php $base_link = $this->config->item('base_url') . $this->config->item('index_page'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
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
                <div class="card-tools">

                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="payment_table">
                    <thead>
                        <tr>
                            <th>Invoice No </th>
                            <th>Paid Date </th>
                            
                            <th>Description</th>
                            <th>Payment date</th>
                            <th>Card</th>
                            <th>Email</th>
                            <th>Amount</th>

                            <th>Status </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($payments)) {
                            $i = 1;
                            foreach ($payments as $payment) {
                                $array = unserialize($payment->inv_id); 
                               $n_inv= explode(",",$array);
                    
                                // $avail = ($payment->payment_status == 0) ? 'Available' : 'Not available';
                        ?>
                        <tr>
                            <td><?php
                            $inv='';
                        if(count($n_inv)>0){   
foreach ($n_inv as $value) {
    if($value==0){
                                               echo "Transaction Fee Deposit";
                                        }else{
                                        $inv=$this->invoice_model->invoice_no($value);
                                        echo $inv."<br>";
                                        }
                                        
}
                        }else{
                            echo "Transaction Fee Deposit";
                        }
                   

                            ?></td>
                            <td></td>
                            <td></td>
                    
                            <td><?php echo $payment->created_date; ?></td>
                            <td>xxxx xxxx xxxx <?php echo $payment->card_suffix; ?></td>
                            <td><?php echo $payment->payer_email; ?></td>
                            <td><?php echo $payment->currency_code . " " . $payment->payment_gross; ?></td>

                            <td><?php echo $payment->status; ?></td>
                            <!-- <td style="width:70px;">
                                <a href='<?php echo $base_link; ?>payment/view/<?php echo $payment->payment_id; ?>'
                                    class='text-muted'><span class='fa fa-edit'></span></a>&nbsp;&nbsp;
                                <button type="button" class="btn del-mod" data-id="<?php echo $payment->payment_id; ?>"
                                    data-toggle="modal" data-target="#modal-del"><span
                                        class='fa fa-trash-alt'></span></button>
                            </td> -->
                        </tr>
                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-del">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Are you sure</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete this payment ?</p>
            </div>
            <input type="hidden" id="delId" name="delId" value="">
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light"
                    data-dismiss="modal">&nbsp;&nbsp;&nbsp;&nbsp;NO&nbsp;&nbsp;&nbsp;&nbsp;</button>
                <button type="button" class="btn btn-outline-light"
                    id="del-yes">&nbsp;&nbsp;&nbsp;&nbsp;YES&nbsp;&nbsp;&nbsp;&nbsp;</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
$(".del-mod").click(function() {
    var id = $(this).attr("data-id");
    $('#delId').val(id);
});

$("#del-yes").click(function() {
    var id = $('#delId').val();
    var base_url = "<?php echo $base_link; ?>";
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    $.ajax({
        type: 'POST',
        url: base_url + 'payment/delete/',
        data: {
            payment_id: id
        },
        success: function(data) {
            if ($.trim(data) == 'Success') {
                $('#tr_' + id).hide();
                $('#modal-del').modal('toggle');
                Toast.fire({
                    icon: 'success',
                    title: ' payment Successfully Removed'
                });
            } else {
                $('#modal-del').modal('toggle');
                Toast.fire({
                    icon: 'success',
                    title: ' Not Removed'
                });
            }
        }
    });
});

$(document).ready(function() {
    $('#payment_table').DataTable({
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 5,
    });
});
</script>
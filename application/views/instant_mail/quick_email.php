<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-3">
          <h1><?=$title;?></h1>
        </div>
        <div class="col-sm-9">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><i class="nav-icon fas fa-handshake"></i> Activities </li>
            <li class="breadcrumb-item"><a href="#"><?=$title;?></a></li>
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
      <div class="card-body">
 
         
            <form method="post" id="mailForm" action="<?=base_url('')?>" enctype="multipart/form-data">

          
                     
                                <div class="row">
            <div class="col-sm-6">
            <div class="form-group">
              <label >Alert Type</label>
              <select  id="alert_type" class="form-control" name="alert_type">
              <option value="email" >Email</option>
              <option value="sms">SMS</option>
            </select></div>
          </div></div>
          <div class="row">
          <div class="col-sm-6">
            <div class="form-group"><label id="al_email">Email</label><input type="email" id="to" name="to" placeholder="" class="form-control"></div></div></div>
            <div class="row"><div class="col-sm-6"> <div class="form-group"> <label >Subject</label>
                <input type="text" id="subject" name="subject" class="form-control" placeholder="">
</div></div></div> <div class="row"><div class="col-sm-6">
<div class="form-group">   <label >Message</label> <textarea rows="6" id="message" name="message" class="form-control" placeholder=" message here"> </textarea>
</div></div></div>
<div class="row"><div class="col-sm-6">
<div class="form-group"> <input type="button" id="mailSend" value="Send " /></div></div></div>
            </form>
</div>
        </div>

</div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  $(document).ready(function() {
$("#alert_type").change(function(){
  if(this.value=='sms'){
    $('#al_email').html('Phone Number');
  }else{
    $('#al_email').html('Email');
  }
});
});
$( "#mailSend" ).click(function() {
  
  var base_url = "<?php echo $base_link; ?>";
 var Toast = Swal.mixin({
   toast: true,
   position: 'top-end',
   showConfirmButton: false,
   timer: 3000
 });  
 let data = new FormData($("#mailForm")[0]);
  $.ajax({
   type: 'POST',
   url: base_url+'Send_mail/send',
   data: data,
    processData: false,
    contentType: false,
   success: function (data) {
     if ($.trim(data) == 'success') {
       //$('#tr_'+id).hide();
       $('#modal-del').modal('toggle');
       Toast.fire({
         icon: 'success',
         title: '  Your Email has successfully been sent.'
       });

     } else {
       $('#modal-del').modal('toggle');
       Toast.fire({
         icon: 'success',
         title: ' Not Sent'
       });
     }
 $('#to').val(''); $('#subject').val(''); $('#message').val('');
    }
  });
});</script>
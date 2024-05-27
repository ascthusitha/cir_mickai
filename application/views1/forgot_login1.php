<!DOCTYPE html>
<html>
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reset Password</title>
	
	<!-- Bootstrap -->
	    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body { 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  background-image: url("<?php echo base_url() ?>assets/img/bg_content.jpg") ;
    padding: 40px 0 20px;
        background-repeat: no-repeat;
  background-position: center center;
}

.panel-default {
opacity: 0.9;
margin-top:30px;
}
.form-group.last { margin-bottom:0px; }
    </style>


	

  </head>
<body>
<div class="container">
    <div class="row">
        <?php if($status)  {?>
          <div class="col-md-8 col-md-offset-4 alert">
            <div class="alert">
                
            <div  id="results" class="">
               
                <?php if($status)  {?>
                    <span class="alert alert-success fade in"><?php echo $msg ?></span>
                <?php } else { ?>
                    <span  class="alert alert-danger fade in">><?php echo $msg ?></span>
                <?php } ?>
           </div>
        
            </div></div><?php } ?>
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                 Reset Password</div>
                <div class="panel-body">
                    <form action="<?php echo base_url();?>user_authentication/forgottenPassword" id="reset-form" class="form-horizontal" role="form" method="post">
   
    <div class="login-wrap">
<!--        <img src="<?php echo base_url() ?>assets/template/blue/images/logo.png" class="login-img" alt="logo"/><br/>-->
        <div class="form-group">
            <label for="uname" class="col-sm-3 control-label">
                            Email : </label>
            <div class="col-sm-9">
                <input type="email" class="form-control logpadding" name="emailid" placeholder="email" required>
                <span style="color:red"><?php echo form_error('emailid');?></span>
                
            </div>
        </div>
        <div class="form-group last">
                        <div class="col-sm-offset-3 col-sm-9">
                        <button class="btn btn-success btn-sm" id="login" name="login" type="submit" onclick="">Submit</button>
                    </div>

                </div>
            
        </div>
                    </form>
      
    
                </div>
  </div>
              </div>
          </div>

</div>
<!-- End of Container  -->
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

var stat="<?=$status?>";
            if(stat){
              var URL="<?php echo base_url();  ?>user";
             //(function(){ window.location = URL; }, 5000);
         }

 });  
</script>
  </body>
</html>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

    <!-- BEGIN HEAD -->
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $this->config->item('company_name'); ?> | Reset Password Page</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!--[if IE]>
           <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
           <![endif]-->
        <!-- GLOBAL STYLES -->
        <!-- PAGE LEVEL STYLES -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/magic/magic.css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <!-- END HEAD -->
    <style>

        #footer {
            /*  margin-top: auto;
              text-align: center;
              
            */

            font-size:12px;
            position:absolute;
            color: white;
            bottom:0;
            width:100%;
            height:30px;   /* Height of the footer */
            background-color: green;
        }
        #footer p{
            padding: 10px 10px 10px 10px;
        }
        body{
            /* background-color: #c76e8f;
            background-image: url("./img/background.png");*/
        }
    </style>
    <!-- BEGIN BODY -->
    <body>
        <!-- PAGE CONTENT --> 
        <div class="container">
            <div class="text-center">
                <img src="<?php echo base_url(); ?>assets/img/logo.png" id="logoimg" alt=" Logo" />
            </div>
            <div class="tab-content">
                <div id="login" class="tab-pane active">
                    <?php echo form_open('user_authentication/changePassword', $attributes = array('class' => 'form-signin', 'id' => 'fm_forgot')); ?>

                    <input type="password" class="form-control" name="password" placeholder="password" required>
                    <input type="hidden" name="key" value="<?php echo $key ?>">
                    <input type="password" class="form-control" name="password_confirm" placeholder="password" required>
                    <span style="color:red"><?php echo form_error('password_confirm'); ?></span>


                    <button class="btn btn-primary" id="login" name="login" type="submit" onclick="">Submit</button>


                    <?php echo form_close(); ?>

                </div>

            </div>
            <!-- End of Login Wrap  -->

        </div>
        <!-- End of Container  -->


        <div  id="footer">
            <p><label class="col-md-4  center">&copy;  MicroCredit &nbsp;2017 &nbsp;</label><label class="col-md-4"></label>
                <label class="col-md-4 pull-right"> Solution by :<a  href="http://www.nextclap.com"  target="_blank" ><font size="2">Nextclap Solutions</font></a> </label></p>
        </div>
        <!--END PAGE CONTENT -->     
    </body>	      
    <!-- PAGE LEVEL SCRIPTS -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-2.0.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/login.js"></script>
</body>
</html>
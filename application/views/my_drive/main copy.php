<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-hdd"></i> My Drive</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-hdd"></i> My Drive</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-home"></i> <?= $path ?></h3>
                <div id="output"></div>
                <div class="card-tools">
                
                    <button id="open_btn" class="btn btn-primary"><i class="fas fa-upload"></i> UPLOAD FILE/S</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
        

                    <script src="/bower_components/jquery/jquery.min.js"></script>
                    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
                    <script src="/src/bootstrap.fd.js"></script>
                    <script type="text/javascript">
                    $("#open_btn").click(function() {
                        $.FileDialog({multiple: true}).on('files.bs.filedialog', function(ev) {
                            var files = ev.files;
                            var text = "";
                            files.forEach(function(f) {
                                text += f.name + "<br/>";
                            });
                            $("#output").html(text);
                        }).on('cancel.bs.filedialog', function(ev) {
                            $("#output").html("Cancelled!");
                        });
                    });
                    </script>


                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <ul id="treeview">
                            <?php 
                            echo $folders;
                            ?>
                            <li data-icon-cls="fa fa-trash">Trash
                            </li>
                            <li data-icon-cls="fa fa-calendar">Calendar
                                <ul>
                                    <li>Day</li>
                                    <li>Week</li>
                                    <li>Month</li>
                                </ul>
                            </li>
                            <li data-icon-cls="fa fa-user">Contacts
                                <ul>
                                    <li>Alexander Stein</li>
                                    <li>John Doe</li>
                                    <li>Paul Smith</li>
                                    <li>Steward Lynn</li>
                                </ul>
                            </li>
                            <li data-icon-cls="fa fa-folder">Folders
                                <ul>
                                    <li>Backup</li>
                                    <li>Deleted</li>
                                    <li>Projects</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- you need to include the ShieldUI CSS and JS assets in order for the TreeView widget to work -->
<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>

<!-- Page specific script -->
<script type="text/javascript">
    jQuery(function ($) {
        $("#treeview").shieldTreeView();
    });

    $("#open_btn").click(function() {
        $.FileDialog({//OPTIONS});
    });

    $.FileDialog({

// MIME type of accepted files, e. g. image/jpeg
accept: "*",

// cancel button
cancelButton: "Close",

// drop zone message
dragMessage: "Drop files here",

// the height of drop zone in pixels
dropheight: 400,

// error message
errorMessage: "An error occured while loading file",

// whether it is possible to choose multiple files or not.
multiple: true,

// OK button
okButton: "OK",

// file reading mode.
// BinaryString, Text, DataURL, ArrayBuffer
readAs: "DataURL",

// remove message
removeMessage: "Remove&nbsp;file",

// file dialog title
title: "Load file(s)"

});



// handle files choice when done
.on('files.bs.filedialog', function(ev) {
  var files_list = ev.files;
  // DO SOMETHING
});


// handle dialog cancelling
on('cancel.bs.filedialog', function(ev) {
  // DO SOMETHING
});

</script>



<link href="<?php echo base_url();?>assets/dist/bootstrap.fd.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/dist/bootstrap.fd.js"></script>


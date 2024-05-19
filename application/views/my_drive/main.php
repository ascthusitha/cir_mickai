<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/context.css">
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-hdd"></i> My Drive</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="<?php echo $base_link.'my_drive/';?>"><i class="fas fa-hdd"></i> Home</a><span id="folder_path"><?= $path ?></span>
                <div class="card-tools">
                    <?php if($parent_id){ ?>
                    <button id="rename_folder_btn" class="btn btn-tool" data-toggle="modal" data-target="#modal-rename-folder"><i class="fas fa-pen"></i> &nbsp;RENAME </button>
                    <?php } ?>
                </div>
            </div>
            <div class="card-header">
                <button id="create_folder_btn" class="btn btn-primary" data-toggle="modal" data-target="#modal-sm"><i class="fas fa-folder"></i> CREATE FOLDER</button>
                <button id="upload_file_btn" class="btn btn-primary" data-toggle="modal" data-target="#modal-upload-file"><i class="fas fa-upload"></i> UPLOAD FILE</button>
                <div class="card-tools">

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <ul id="treeview">
                            <?php echo $folders; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<input type='hidden' id='txt_type' value=''>
<input type='hidden' id='txt_id' value=''>
<input type='hidden' id='base_url' value='<?php echo base_url(); ?>'>
<input type='hidden' id='base_link' value='<?php echo $base_link; ?>'>
<input type="hidden" id="parent_id" name="parent_id" value="<?php echo $parent_id;?>">

<?php $this->load->view('my_drive/modal_create_folder'); ?>
<?php $this->load->view('my_drive/modal_rename_folder'); ?>
<?php $this->load->view('my_drive/modal_upload_file'); ?>
<?php $this->load->view('my_drive/modal_delete'); ?>

<div id="contextMenu" class="context-menu" style="display: none">
    <ul>
        <li><a href="#" data-toggle="modal" data-target="#modal-rename-folder"><i class="fas fa-pen"></i> RENAME</a></li>
        <li><a href="#" id="context_del"><i class="fas fa-trash"></i> DELETE</a></li>
    </ul>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/all.min.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/shieldui-all.min.js"></script>

<!-- Page specific script -->
<script type="text/javascript">
    jQuery(function ($) {
        $("#treeview").shieldTreeView();
    });
</script>
<script src="<?php echo base_url(); ?>assets/js/my-drive.js"></script>
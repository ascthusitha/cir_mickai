<div class="modal fade" id="modal-upload-file">
    <div class="modal-dialog modal-upload-file">
        <div class="modal-content">
            <form method="post" action="" enctype="multipart/form-data" id="myform">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-upload"></i> UPLOAD FILE</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="icon fas fa-hdd"></i>My Drive<span id="folder_path_upf"></span>/
                    </div>
                    <input type="file" id="file" name="file" />
                    <input type='hidden' value='' id='parent_id_temp'>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" value="Upload" id="but_upload">Upload</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
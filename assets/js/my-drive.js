    var base_link = $("#base_link").val();
    var base_url = $("#base_url").val();

    $( "#create_folder_btn" ).click(function() {
        var folder_path = $("#folder_path").html();
        $("#folder_path_crf").html(folder_path);
    });

    $( "#rename_folder_btn" ).click(function() {
        var folder_path = $("#folder_path").html();
        const myArray = folder_path.split("/");
        $("#directoryr").val(myArray[myArray.length - 1]);
    });

    $( "#upload_file_btn" ).click(function() {
        var folder_path = $("#folder_path").html();
        var parent_id = $("#parent_id").val();
        $("#parent_id_temp").val(parent_id);
        $("#folder_path_upf").html(folder_path);
    });

    $( "#directory_save" ).click(function() {
        var dname = $("#directory").val();
        var parent_id = $("#parent_id").val();
        jQuery.ajax({
            url:base_link+"my_drive/add_folder",
            type:'POST', async: false,
            data: { 'dname': dname, 'parent_id':parent_id },
            dataType:'json', 
            success:function(data){
                $('#modal-sm').hide();
                document.location.href=base_link+'my_drive/index/'+parent_id;
            }
        });
        return false;
    });

    $( "#directory_rename" ).click(function() {
        var dname = $("#directoryr").val();
        var parent_id = $("#parent_id").val();
        jQuery.ajax({
            url:base_link+"my_drive/rename_folder",
            type:'POST', async: false,
            data: { 'dname': dname, 'parent_id':parent_id },
            dataType:'json', 
            success:function(data){
                $('#modal-sm').hide();
                document.location.href=base_link+'my_drive/index/'+parent_id;
            }
        });
        return false;
    });



    $(document).ready(function(){

        $("div.sui-treeview-item-content").bind('contextmenu', function (e) {
            event.preventDefault();
            var total_href = $(this).find("a").attr("href");
            var right_href = total_href.replace(base_url,'');
            const hrefArray = right_href.split("/");
            var obj_type = '';
            var obj_id = '';
            if(hrefArray[0]=='upload'){
                obj_type = 'file';
                obj_id = hrefArray[1];
            }else{
                obj_type = 'folder';
                obj_id = hrefArray[3];
            }
            $("#txt_type").val(obj_type);
            $("#txt_id").val(obj_id);

            var top = e.pageY+5;
            var left = e.pageX;

            // Show contextmenu
            $(".context-menu").toggle(100).css({
                top: top + "px",
                left: left + "px"
            });
            
            // disable default context menu
            return false;
        });

        $(document).bind('contextmenu click',function(){
            $(".context-menu").hide();
            $("#txt_type").val("");
            $("#txt_id").val("");
        });

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $("#but_upload").click(function(){
            var fd = new FormData();
            var files = $('#file')[0].files[0];
            var parent_id = $("#parent_id_temp").val();
            fd.append('file',files);
            fd.append('parent_id',parent_id);

            $.ajax({
                url: base_link+'my_drive/upload_file',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response != 0){
                        $('#modal-upload-file').modal('toggle');
                        Toast.fire({
                            icon: 'success',
                            title: ' Successfully Uploaded.'
                        });
                    }else{
                        $('#modal-upload-file').modal('toggle');
                        Toast.fire({
                            icon: 'error',
                            title: ' Error : File not uploaded.'
                        });
                    }
                }
            });
        });

        $("#context_del").click(function(){
            var txt_type = $("#txt_type").val();
            var txt_id = $("#txt_id").val();
            $("#txt_type_tmp").val(txt_type);
            $("#txt_id_tmp").val(txt_id);
            $('#modal-delete').modal('toggle');
        });

        $("#context_del_btn").click(function(){
            var txt_type = $("#txt_type_tmp").val();
            var txt_id = $("#txt_id_tmp").val();
            if(txt_type=='folder'){
                deleteFolder(txt_id);
            }
            if(txt_type=='file'){
                deleteFile(txt_id);
            }
        });

        function deleteFolder(id){
            if (id!='') {
                $.ajax({
                    url: base_link+'my_drive/delete_folder',
                    type: 'post',
                    data: {'id':id},
                    success: function(response){
                        $('#modal-delete').modal('toggle');
                        document.location.href=base_link+'my_drive/index/';
                    }
                });
            }
        }

        function deleteFile(id){
            if (id!='') {
                $.ajax({
                    url: base_link+'my_drive/delete_file',
                    type: 'post',
                    data: {'id':id},
                    success: function(response){
                        $('#modal-delete').modal('toggle');
                        document.location.href=base_link+'my_drive/index/';
                    }
                });
            }
        }

        // Remove file
        $('.container').on('click','.content .delete',function(){
            var id = this.id;
            var split_id = id.split('_');
            var num = split_id[1];
            // Get image source
            var imgElement_src = $( '#content_'+num+' img' ).attr("src");
            var deleteFile = confirm("Do you really want to Delete?");
            if (deleteFile == true) {
                // AJAX request
                $.ajax({
                    url: 'addremove.php',
                    type: 'post',
                    data: {path: imgElement_src,request: 2},
                    success: function(response){
                        // Remove <div >
                        if(response == 1){
                            $('#content_'+num).remove();
                        }
                    }
                });
            }
        });

    });
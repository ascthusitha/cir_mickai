<div class="container-fluid">
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url();
echo $this->uri->segment(1); ?>/listing" >
<?php echo ucfirst($this->uri->segment(1)); ?>
            </a> 
            <span class="divider">/</span>
        </li>

        <li class="active">
            <a href="#"><?php
                if ($this->uri->segment(2) == 'add') {
                    echo 'New';
                } else {
                    echo 'Update';
                }
                ?></a>
        </li>
    </ul>
    <div class="page-header text-success">
        <h3><?php echo $title; ?></h3>
    </div>
    <div class="row-fluid">
        <div class="offset3 span6">

            <form action="" id="city-form" class="well" method="post" enctype="multipart/form-data">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="city_name">City Name</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" name="city_name" id="city_name" value="<?php echo isset($city['city_name']) ? $city['city_name'] : set_value('city_name'); ?>">
                            <input type="hidden" class="input-xlarge" name="city_id" id="city_id" value="<?php echo $city['city_id']; ?>">
                        </div>
                    </div>
                    <!--    <div class="control-group">
                            <label class="control-label" for="city_desc">Description</label>
                            <div class="controls">
                                <textarea class="input-xlarge" name="city_desc" id="city_desc" ><?php echo isset($city['city_description']) ? $city['city_description'] : set_value('city_desc'); ?></textarea>
                                
                            </div>
                        </div>-->
                    <div class="control-group">
                        <label class="control-label" for="country">Country</label>
                        <div class="controls">
<?php echo form_dropdown('country', $countries, isset($city['country_id']) ? $city['country_id'] : '0'); ?> 
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="latitude">Latitude</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" name="latitude" id="latitude" value="<?php echo isset($city['latitude']) ? $city['latitude'] : set_value('latitude'); ?>">

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="longitude">Longitude</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" name="longitude" id="longitude" value="<?php echo isset($city['longitude']) ? $city['longitude'] : set_value('longitude'); ?>">

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="image1">Image1 (Max 2Mb)</label>
                        <div class="controls"> 
                            <input type="file"  id="image1" name="image1"  />
                            <input type="hidden"  id="hd_image1" name="hd_image1" value="<?php echo isset($city['city_image1']) ? $city['city_image1'] : set_value('hd_image1'); ?>" />
                        </div><br>
                        <table  id="img1_table" name="presentation_table" ><tbody class="files"><tr><td><img class="img-thumbnail"  src="<?php echo base_url(); ?>assets/img/upload/city/<?= ucfirst($city['city_name']) ?>/<?= $city['city_image1'] ?>" width="150px" height="150px"></td></tr></tbody></table>

                    </div>

                    <div class="control-group">
                        <label class="control-label" for="image2">Image2 (Max 2Mb)</label>
                        <div class="controls"> 
                            <input type="file"  id="image2" name="image2" />
                            <input type="hidden"  id="hd_image2" name="hd_image2" value="<?php echo isset($city['city_image2']) ? $city['city_image2'] : set_value('hd_image2'); ?>" />
                        </div><br>
                        <table  id="img2_table" name="presentation_table" ><tbody class="files"><tr><td><img class="img-thumbnail"  src="<?php echo base_url(); ?>assets/img/upload/city/<?= ucfirst($city['city_name']) ?>/<?= $city['city_image2'] ?>" width="150px" height="150px"></td></tr></tbody></table>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="image3">Image3 (Max 2Mb)</label>
                        <div class="controls"> 
                            <input type="file"  id="image3" name="image3" />
                            <input type="hidden"  id="hd_image3" name="hd_image3" value="<?php echo isset($city['city_image3']) ? $city['city_image3'] : set_value('hd_image3'); ?>" />
                        </div><br>
                        <table  id="img3_table" name="presentation_table" ><tbody class="files"><tr><td><img class="img-thumbnail"  src="<?php echo base_url(); ?>assets/img/upload/city/<?= ucfirst($city['city_name']) ?>/<?= $city['city_image3'] ?>" width="150px" height="150px"></td></tr></tbody></table>
                    </div>


                    <!--        <div class="control-group">
                            <label class="control-label" for="image2">Image2</label>  
                            <div class="controls">
                                <input type="file" class="input-xlarge" name="image2" id="image2" >
                            </div>
                        </div>
                            <div class="control-group">
                            <label class="control-label" for="image3">Image3</label>
                            <div class="controls">
                                <input type="file" class="input-xlarge" name="image3" id="image3" >
                            </div>
                        </div> -->

                    <div class="control-group">
                        <div class="controls">
                            <input type="submit" class="btn btn-primary"  value="<?php echo isset($btn_value) ? $btn_value : 'Save'; ?>">
                        </div>
                    </div>
                </fieldset>
            </form>
            <!--  results  here -->
            <div id="results"><?php echo isset($result) ? $result : '' ?></div>
        </div>

    </div>
</div>

<div class="inner">
    <div class="container">
        <p class="right"><a href="#">Back to top</a><p></p></p>
    </div>
</div>

<script type="text/javascript">
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    });
    $(document).ready(function () {

        var base_url = "<?php echo base_url(); ?>";
// $('#city-form').submit(function(e) {


        $('#city-form').validate({
            rules:
                    {
                        city_name: {required: true},
                        country: {required: true},
                        image1: {required: false, filesize: 2097152},
                        image2: {required: false, filesize: 2097152},
                        image3: {required: false, filesize: 2097152}
                    },
            messages:
                    {
                        city_name: {required: "Please enter a City Name"},
                        country: {required: "Please select a country"},
                        image1: "File must be JPG, GIF or PNG, less than 2MB",
                        image2: "File must be JPG, GIF or PNG, less than 2MB",
                        image3: "File must be JPG, GIF or PNG, less than 2MB"
                    },
            highlight: function (element)
            {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function (element)
            {
                element.closest('.control-group').removeClass('error').addClass('success');
            },
            submitHandler: function (form)
            {
                var formData = new FormData($("#city-form")[0]);

                $.ajax({
                    url: base_url + 'index.php/city/saveCity/',
                    type: 'POST',
                    data: formData,
                    async: false,
                    success: function (data) {

                        if (trim(data) === 'success') {
                            $('#results').addClass('alert alert-danger');
                            $('#results').html('error');
                        } else {
                            $('#results').addClass('alert alert-success');
                            $('#results').html('City successfully saved');
                        }
                        var URL = "<?php echo base_url(); ?>index.php/city/listing";
                        setTimeout(function () {
                            window.location = URL;
                        }, 1000);
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }


        });


        // });

        jQuery('#image1').change(function ()
        {
            var files = $("#image1")[0].files;

            // if(files && files[0]) for(var i=0; i<files.length; i++) readImage( files[i] );

            var reader = new FileReader();
            var image = new Image();

            reader.readAsDataURL(files[0]);

            reader.onload = function (_file)
            {
                image.src = _file.target.result;              // url.createObjectURL(file);
                image.onload = function () {
                    var w = '150',
                            h = '150',
                            t = files[0].type, // ext only: // file.type.split('/')[1],
                            n = files[0].name,
                            s = ~~(files[0].size / 1024) + 'KB';
                    $("#img1_table tbody").empty();
                    $('#img1_table tbody').html('<tr><td><img id="previewImage" src="' + this.src + '" width="150" height="150"></td><td>' + n + '</td></tr>');
                };
                image.onerror = function () {
                    alert('Invalid file type: ' + files[0].type);
                };
            };
        });

        jQuery('#image2').change(function ()
        {
            var files = $("#image2")[0].files;

            // if(files && files[0]) for(var i=0; i<files.length; i++) readImage( files[i] );

            var reader = new FileReader();
            var image = new Image();

            reader.readAsDataURL(files[0]);

            reader.onload = function (_file)
            {
                image.src = _file.target.result;              // url.createObjectURL(file);
                image.onload = function () {
                    var w = '150',
                            h = '150',
                            t = files[0].type, // ext only: // file.type.split('/')[1],
                            n = files[0].name,
                            s = ~~(files[0].size / 1024) + 'KB';

                    $('#img2_table tbody').html('<tr><td><img id="previewImage" src="' + this.src + '" width="150" height="150"></td><td>' + n + '</td></tr>');
                };
                image.onerror = function () {
                    alert('Invalid file type: ' + files[0].type);
                };
            };
        });

        jQuery('#image3').change(function ()
        {
            var files = $("#image3")[0].files;

            // if(files && files[0]) for(var i=0; i<files.length; i++) readImage( files[i] );

            var reader = new FileReader();
            var image = new Image();

            reader.readAsDataURL(files[0]);

            reader.onload = function (_file)
            {
                image.src = _file.target.result;              // url.createObjectURL(file);
                image.onload = function () {
                    var w = '150',
                            h = '150',
                            t = files[0].type, // ext only: // file.type.split('/')[1],
                            n = files[0].name,
                            s = ~~(files[0].size / 1024) + 'KB';

                    $('#img3_table tbody').html('<tr><td><img id="previewImage" src="' + this.src + '" width="150" height="150"></td><td>' + n + '</td></tr>');
                };
                image.onerror = function () {
                    alert('Invalid file type: ' + files[0].type);
                };
            };
        });


        return false;
    }); // end document.ready
</script>
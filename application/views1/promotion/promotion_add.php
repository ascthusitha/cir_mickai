<div id="page-wrapper">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo site_url();
echo $this->uri->segment(1); ?>/" >
<?php echo ucfirst(str_replace("_", " ", $this->uri->segment(1))); ?>
                </a> 

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
                <form action="<?php echo base_url(); ?>promotion/save_promotion" id="promotion-form" class="well" method="post">
                    <fieldset>
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <label class="control-label" for="promotion_name">Promotion Name</label>

                                <input type="text" class="form-control" name="promotion_name" id="promotion_name" value="<?php echo isset($promotion['promotion_name']) ? $promotion['promotion_name'] : set_value('promotion_name'); ?>">
                                <input type="hidden" class="form-control" name="promotion_id" id="promotion_id" value="<?php echo $promotion['promotion_id']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <label class="control-label" for="supplier">Supplier</label>
                                <?php
                                $x = 'id="supplier" class="form-control"';
                                echo form_dropdown('supplier', $suppliers, isset($promotion['supplier_id']) ? $promotion['supplier_id'] : '0', $x);
                                ?> 
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <label class="control-label" for="description">Description</label>

                                <textarea class="form-control" name="desc" id="desc" rows="3" value=""><?php echo isset($promotion['description']) ? $promotion['description'] : set_value('desc'); ?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4"><br>
                                <input type="submit" class="btn btn-primary" value="<?php echo isset($btn_value) ? $btn_value : 'Save'; ?>">
                            </div>
                        </div>
                    </fieldset>
                </form>
                <!--  results  here -->
                <div id="results"></div>
            </div>

        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";

        $('#promotion-form').validate({
            rules: {
                promotion_name: {required: true},
                mem_type: {do_not_select: '0'},
            },
            messages: {
                promotion_name: {
                    required: "Please enter a member type"
                },
                discount: {
                    required: "Please enter a discount"
                },
            },
            highlight: function (element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function (element) {
                element.text('').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
            },
            submitHandler: function (form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    success: function (data)
                    {

                        //$("#supplier_rating_type-form").hide('slow');
                        if ($.trim(data) == 'success') {
                            $('#results').addClass('alert alert-success');
                            $('#results').html('Promotion successfully saved');
                        } else {
                            $('#results').addClass('alert alert-danger');
                            $('#results').html('error');
                        }
                        var URL = "<?php echo base_url(); ?>Promotion";
                        setTimeout(function () {
                            window.location = URL;
                        }, 1000);
                    }
                });

                return false; // required to block normal submit since you used ajax
            }

        });

    }); // end document.ready
</script>

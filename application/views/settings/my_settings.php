<?php $base_link = $this->config->item('base_url').$this->config->item('index_page');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">My Settings</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="card card-solid">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0"><b>Dashboard Settings</b></div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-12 col-sm-4 col-md-4">
                                        <p class="text-muted text-sm">My Phone Calls</p>
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-8">
                                        <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-4 col-md-4">
                                        <p class="text-muted text-sm">My Sales Calls</p>
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-8">
                                        <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-4 col-md-4">
                                        <p class="text-muted text-sm">My Tasks</p>
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-8">
                                        <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-4 col-md-4">
                                        <p class="text-muted text-sm">My Opportunities</p>
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-8">
                                        <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

<!-- Page specific script -->

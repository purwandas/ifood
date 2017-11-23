<style type="text/css">
</style>
<div class="row">
<?php if ($query->num_rows() == 0): ?>
    
        <div class="col-xs-12">
            <div class="mt-element-ribbon" style="background: white;">
                <div class=
                "ribbon ribbon-border-hor ribbon-clip ribbon-color-danger uppercase">
                <div class="ribbon-sub ribbon-clip"></div>Data Kosong
                </div>
                <p class="ribbon-content">Data Users Kosong</p>
            </div>
        </div>
<?php else: ?>
     <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase"> Data Users</span>
                                    </div>
                                    
                                </div>
                                <?php if ($this->session->userdata("akses")=="3"): ?>
                                    <?php else: ?>
                                    <div class="portlet-body">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="btn-group">
                                                <?php echo anchor('users/add', '<button  class="btn sbold green"> Add New
                                                    <i class="fa fa-plus"></i>
                                                </button>'); ?>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <div class="btn-group pull-right">
                                                <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-print"></i> Print </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <?php endif ?>
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="dataUsers">
                                        <thead>
                                            <tr>
                                                <th> NIK </th>
                                                <th> NAMA </th>
                                                <th> AKSES </th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
<?php endif ?>

        <div class="col-md-12" id="pageContent">
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th> No. </th>
                                                <th> Store id </th>
                                                <th> Nama Toko </th>
                                                <!-- <th> Target </th> -->
                                            </tr>
                                        </thead>
                                        <tbody id="dataShowToko">
                                            <!-- <tr></tr> -->
                                        </tbody>
                                    </table>
        </div>
</div>
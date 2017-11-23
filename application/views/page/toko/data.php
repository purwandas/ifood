    <div class="row" style="display:none;">
        <div class="col-xs-12">
            <div class="alert alert-danger" id="alert">
                <strong>Success!</strong> <?php echo $this->session->flashdata('msg'); ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> <?php echo $title ?></span>
                    
                </div>
                
            </div>
            <?php if ($this->session->userdata("akses")=="3"): ?>
            <?php else: ?>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <?php echo anchor('toko/add', '<button  class="btn sbold green"> Add New
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
                                <?php endif; ?>
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="dataToko">
                                    <thead>
                                        <tr>
                                            <th>
                                                No
                                            </th>
                                            <th> STORE ID </th>
                                            <th> KOTA </th>
                                            <th> NAMA TOKO </th>
                                            <th> TARGET </th>
                                            <th> Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                        <div class="col-md-12" id="pageContent">
                            <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <div class="alert alert-success" style="display: none;" id="status"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th> No. </th>
                                                <th> Tipe Target </th>
                                                <th> Target </th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataShowTarget">
                                            <!-- <tr></tr> -->
                                        </tbody>
                                    </table>
                                </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
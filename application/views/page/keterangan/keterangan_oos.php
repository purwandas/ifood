
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
                                <?php echo anchor('keterangan/form_keterangan', '<button  class="btn sbold green"> Add New
                                    <i class="fa fa-plus"></i>
                                </button>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="ket_oos">
                    <thead>
                        <tr>
                            <th>
                                No
                            </th>
                            <th> Keterangan </th>
                            <!-- <th> Target </th> -->
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
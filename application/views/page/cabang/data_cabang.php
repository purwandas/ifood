<?php if ($query->num_rows() == 0): ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="mt-element-ribbon" style="background: white;">
                <div class=
                "ribbon ribbon-border-hor ribbon-clip ribbon-color-danger uppercase">
                <div class="ribbon-sub ribbon-clip"></div>Data Kosong
                </div>
                <p class="ribbon-content">Data Cabang Kosong</p>
            </div>
        </div>
    </div>
<!-- <?php else: ?> -->
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
                                <?php echo anchor('cabang/add', '<button  class="btn sbold green"> Add New
                                    <i class="fa fa-plus"></i>
                                </button>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="dataCabang">
                    <thead>
                        <tr>
                            <th>
                                No
                            </th>
                            <th> Nama Cabang </th>
                            <!-- <th> Target </th> -->
                            <th> PIC </th>
                            <th> Email PIC </th>
                            <th> ASPM </th>
                            <th> Email ASPM </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- <?php endif ?>
<?php if ($query->num_rows() == 0): ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="mt-element-ribbon" style="background: white;">
                <div class=
                "ribbon ribbon-border-hor ribbon-clip ribbon-color-danger uppercase">
                <div class="ribbon-sub ribbon-clip"></div>Data Kosong
                </div>
                <p class="ribbon-content">Data Users Kosong</p>
            </div>
        </div>
    </div>
<?php else: ?>
     <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase"> <?php echo $title ?></span>
                                    </div>
                                    
                                </div>
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
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>
                                                    No    
                                                </th>
                                                <th> STORE ID </th>
                                                <th> CABANG </th>
                                                <th> NAMA </th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no =1 ; foreach ($query -> result() as $row): ?>
                                                
                                            
                                            <tr class="odd gradeX">
                                                <td>
                                                    <?php echo $no++ ?>
                                                </td>
                                                <td> 
                                                    <?php echo $row->store_id; ?> 
                                                </td>
                                                <td>
                                                   <?php echo $this->sada->_getNameCabang($row->id_cabang); ?>
                                                </td>
                                                <td>
                                                   <?php echo $row->nama; ?>
                                                </td>
                                               
                                                <td>
                                                    <div class="btn-group" >
                                                        <button  class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
                                                                    <?php echo anchor('users/edit/'.$row->id_user, '<i class="icon-pencil"></i>Edit', 'attributes'); ?>
                                                            </li>
                                                            <li>
                                                                    <?php echo anchor('users/delete/'.$row->id_user, '<i class="icon-trash"></i>Delete', 'onclick = "if (! confirm(\'Apakah Anda Yakin Untuk Menghapus '.$row->nama.'? Data Yang Sudah Di Hapus Tidak Bisa Di Kembalikan\')) { return false; }"'); ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            <?php endforeach ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
<?php endif ?>
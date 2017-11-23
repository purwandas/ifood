        <div class="row">
            <div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="fa fa-user-plus"></i>
                            <span class="caption-subject bold uppercase"> <?php echo $title ?></span>
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <form action="<?php echo site_url('users/targetUser'); ?>" id="editTarget" class="form-horizontal" method="post">
                            <div class="form-body">
                                <div class="form-group">
                                    <label id="nama">Nama user</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-plus-square-o"></i>
                                        </span>
                                        <input id="id_user" name="id_user" type="hidden" class="form-control" value="<?php echo $query_user_target->id_user; ?>"  placeholder="Nama SKU">
                                        <input id="user" value="<?php echo $query_user_target->nama_user; ?>" type="text" class="form-control" name="user" disabled placeholder="user"> </div>
                                </div>
                                <div class="form-group">
                                    <label id="nama">Nama Toko</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-plus-square-o"></i>
                                        </span>
                                        <input id="id_toko" name="id_toko" type="hidden" class="form-control" value="<?php echo $query_toko_target->id_toko; ?>"  placeholder="Nama SKU">
                                        <input id="nama" value="<?php echo $query_toko_target->nama_toko; ?>" type="text" class="form-control" name="nama" disabled placeholder="nama"> </div>
                                </div>
                                <div class="form-group">
                                        <label id="nik">Target</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                            <i class="fa fa-plus-square-o"></i>
                                        </span>
                                        <input id="id_target" type="hidden" value="<?php echo $id_target; ?>" class="form-control" name="id_target" placeholder="id_target"> 
                                        <input id="target" type="text" value="<?php echo $target; ?>" class="form-control" name="target" placeholder="target">
                                            <span id='errmsg' style="color:red;"></span>
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn sbold green">Submit</button>
                                        <button type="button" class="btn default">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END SAMPLE FORM PORTLET-->

                        <!-- END SAMPLE FORM PORTLET-->
                    </div>
                </div>

		<div class="row">
			<div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="fa fa-user-plus"></i>
                            <span class="caption-subject bold uppercase"> <?php echo $title ?></span>
                            <?php
                            // $q = "select id,nama from sada_kategori";
                            // if ($param_kategori->num_rows() > 0 ) {
                            //     foreach ($param_kategori->result() as $key => $value) {
                            //         $datas[] = $value->id_kategori;
                            //     }
                            //     $id_kat = join(',',$datas);
                            //     $q .= ' WHERE id NOT IN ('.$id_kat.')';
                            // }
                            // else{
                            //     $q .= '';
                            // }
                            // echo $q;
                            ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form action="#" id="addTargetToko" class="form-horizontal" method="post">
                            <div class="form-body"><div class="form-group">
                                <label id="nama">Nama Toko</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-plus-square-o"></i>
                                    </span>
                                    <input id="id_toko" name="id_toko" type="hidden" class="form-control" value="<?php echo $loopaddTarget->id_toko; ?>"  placeholder="Nama SKU">
                                    <input id="nama" value="<?php echo $loopaddTarget->nama; ?>" type="text" class="form-control" name="nama" disabled placeholder="nama"> </div>
                                </div>
                                <div class="form-group">
                                    <label id="nik">Tipe Target</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-plus-square-o"></i>
                                        </span>
                                        <select id="kategori_target" name="kategori_target" class="form-control">
                                            <option value="0">===PILIH===</option>
                                            <?php
                                            $q = "select id,nama from sada_kategori";
                                            if ($param_kategori->num_rows() > 0 ) {
                                                foreach ($param_kategori->result() as $key => $value) {
                                                    $datas[] = $value->id_kategori;
                                                }
                                                $id_kat = join(',',$datas);
                                                $q .= ' WHERE id NOT IN ('.$id_kat.')';
                                            }
                                            else{
                                                $q .= '';
                                            }

                                            $q_kategori = $this->db->query($q);
                                            foreach ($q_kategori->result() as $row): ?>
                                            <option value="<?php echo $row->id; ?>"
                                                ><?php echo $row->nama; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label id="nik">Target</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-plus-square-o"></i>
                                        </span>
                                        <input id="target" type="text" class="form-control" name="target" placeholder="target"> 
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

        <div class="row">
			<div class="col-md-12 ">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="fa fa-user-plus"></i>
                            <span class="caption-subject bold uppercase"> <?php echo $title ?></span>
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <form action="#" id="editToko" class="form-horizontal" method="post">
                        <div class="form-body">
                            <div class="form-group">
                                <label id="nama-sku">Store Id</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-plus-square-o"></i>
                                    </span>
                                    <input id="id_toko" name="id_toko" type="hidden" class="form-control" value="<?php echo $loopEditToko->id_toko; ?>"  placeholder="Nama SKU">
                                    <input id="store_id" name="store_id" type="text" class="form-control" value="<?php echo $loopEditToko->store_id; ?>"  placeholder="Nama SKU">
                                </div>
                            </div>
                            <div class="form-group">
                                <label id="nama-toko">Nama Toko</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-plus-square-o"></i>
                                    </span>
                                    <input id="nama" type="text" class="form-control" value="<?php echo $loopEditToko->nama; ?>" name="nama" placeholder="Nama SKU">
                                </div>
                            </div>
                            <div class="form-group">
                                <label id="nik">Kota</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-plus-square-o"></i>
                                    </span>
                                        <select id="kota_toko" name="kota" class="form-control">
                                            <option value="">===PILIH===</option>
                                        <?php $q_kota = $this->db->select("id_kota,nama_kota")->get("sada_kota"); foreach ($q_kota->result() as $row): ?>
                                            <option value="<?php echo $row->id_kota ?>"
                                                    <?php if ($loopEditToko->id_kota==$row->id_kota) {
                                                        echo "selected";
                                                    } ?>
                                                ><?php echo $row->nama_kota ?></option>
                                        <?php endforeach ?>
                                        </select>
                                 </div>
                            </div>
                    </div>
                    <div class="form-actions">
                                        <button type="submit" class="btn sbold green">Submit</button>
                        <a type="button" class="btn default" href="/toko">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->

        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>

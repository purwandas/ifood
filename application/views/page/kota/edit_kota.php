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
                    <?php echo form_open('kota/edit', 'role="form"'); ?>
                        <div class="form-body">
                            <div class="form-group">
                            <label id="nama-cabang">Nama Cabang</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-plus-square-o"></i>
                                        </span>
                                        <select id="inputCabang" name="cabang" class="select2">
                                        <?php  $data = $this->db->select("id_cabang,nama")->get("sada_cabang");
                                            foreach ($data->result() as $key => $value) {
                                                echo "<option value='".$value->id_cabang."'";
                                                if ($value->id_cabang==$loopEditKota->id_cabang) {
                                                    echo "selected";
                                                }
                                                echo ">".$value->nama."</option>";
                                            }
                                        ?>
                                    </select>
                                    </div>
                                <label id="nama-kota">Nama Kota</label>
                                <span class="error" id="errorkota">Harap Isi Nama Kota</span>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-plus-square-o"></i>
                                    </span>

                                    <input id="id_kota" type="hidden" class="form-control" value="<?php echo $loopEditKota->id_kota; ?>" name="id-kota" placeholder="Nama Kota">
                                    <input id="inputKota" type="text" class="form-control" value="<?php echo $loopEditKota->nama_kota; ?>" name="nama-kota" placeholder="Nama Kota">
                                </div>
                            </div>
                        </div>
                    <div class="form-actions">
                        <input id="submitGo"type="submit" value="submit" class="btn blue"></input>
                        <a type="button" class="btn default" href="/kota">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style media="screen">
  .error{
    colo:red;
  }
</style>

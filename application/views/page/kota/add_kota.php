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
                        <form action="#" id="addKota" class="form-horizontal" method="post">
                            <div class="form-body">
                                <div class="form-group">
                                    <label id="nama_cabang">Nama Cabang</label>
																		<span class="error" id="errorcabang">Harap isi Nama Cabang</span>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-plus-square-o"></i>
                                        </span>
                                        <select id="inputCabang" name="nama-cabang" class="form-control select2">
                                            <option value="0">Select..</option>
                                            <?php
                                                $data = $this->db->select('nama')->get('sada_cabang');
                                                foreach ($data->result() as $key => $value) {
                                                    echo "<option value='".$value->nama."'>".$value->nama."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label id="nama_kota">Nama Kota</label>
																		<span class="error" id="errorkota">Harap isi Nama Kota</span>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-plus-square-o"></i>
                                        </span>
                                        <input id="inputKota" type="text" class="form-control" name="nama-kota" placeholder="Nama Kota">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" id="submitGo" value="submit" class="btn blue"></input>
                                <a type="button" class="btn default" href="/kota">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END SAMPLE FORM PORTLET-->
            </div>
</div>
<style media="screen">
	.error{
		color:red;
	}
</style>

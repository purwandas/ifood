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
                        <form action="#" id="addToko" class="form-horizontal" method="post">
                            <div class="form-body">
                                <div class="form-group">
                                    <label id="store_id">store ID</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-plus-square-o"></i>
                                        </span>
                                        <input id="store_id" type="text" class="form-control" name="store_id" placeholder="store_id"> </div>
                                    </div>



                                    <div class="form-group">
                                        <label id="nik">Kota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-plus-square-o"></i>
                                            </span>
                                            <select id="kota_toko" name="kota" class="form-control">
                                                <option value="">===PILIH===</option>
                                                <?php foreach ($q_kota->result() as $row): ?>
                                                <option value="<?php echo $row->id_kota ?>"><?php echo $row->nama_kota ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label id="nama">Nama Toko</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-plus-square-o"></i>
                                        </span>
                                        <input id="nama" type="text" class="form-control" name="nama" placeholder="nama"> </div>
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

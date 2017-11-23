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
                                    <?php echo form_open('users/addAssignStore/'.$dataUser->id_user, 'role="form"'); ?>
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label id="nik">NIK</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-plus-square-o"></i>
                                                    </span>
                                                    <input id="nik" type="text" class="form-control" name="nik" placeholder="NIK" disabled="true" value=" <?php echo htmlentities($dataUser->nik, ENT_QUOTES, 'utf-8') ?>"> </div>
                                            </div>

                                            <div class="form-group">
                                                <label id="nama">Nama Lengkap</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-plus-square-o"></i>
                                                    </span>
                                                    <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama Lengkap" disabled="true" 
                                                    value=" <?php echo htmlentities($dataUser->nama, ENT_QUOTES, 'utf-8') ?>"> </div>
                                            </div>

                
                                             <div class="form-group">
                                                <label id="nama">Status BA</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-plus-square-o"></i>
                                                    </span>
                                                    <input id="nama" type="text" class="form-control" name="nama" placeholder="Status BA"
                                                    value="<?php 
                                                        if($dataUser->stay == "Y"){
                                                             echo htmlentities("Stay", ENT_QUOTES, 'utf-8');

                                                        }else{
                                                         echo htmlentities("Mobile", ENT_QUOTES, 'utf-8');
                                                        }
                                                     ?>"
                                                    disabled
                                                    > </div>
                                            </div> 

                                            <div id="row_toko" class="form-group">
                                                <label>Tambah Toko</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-plus-square-o"></i>
                                                    </span>
                                                    <select id="toko" name="toko[]" class="form-control" multiple="multiple">
                                                        <?php foreach ($query_toko as $row): ?>
                                                            <option value="<?php echo htmlentities($row->id_toko, ENT_QUOTES, 'utf-8') ?>"><?php echo htmlentities($row->nama, ENT_QUOTES, 'utf-8') ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                            </div>



                                        </div>
                                        <div class="form-actions">
                                            <input type="submit" value="submit" class="btn blue"></input>
                                            <button type="button" class="btn default">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END SAMPLE FORM PORTLET-->
                         
                            <!-- END SAMPLE FORM PORTLET-->
                        </div>
</div>


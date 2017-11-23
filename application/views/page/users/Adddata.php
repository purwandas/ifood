<style type="text/css">

    #container {

width:960px;

height:610px;

margin:50px auto

}

.error {

color:red;

font-size:13px;

margin-bottom:-15px

}



h1 {

text-align:center;

font-size:28px

}

hr {

border:0;

border-bottom:1.5px solid #ccc;

margin-top:-10px;

margin-bottom:30px

}

label {

font-size:17px

}

input {

padding:10px;

margin:6px 0 20px;

border:none;

box-shadow:0 0 5px

}

</style>



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

                                    <?php echo form_open('users/add', ['role' => 'form','id' => 'addNewUser']); ?>

                                        <div class="form-body">

                                            <div class="form-group">

                                                <label id="nik">NIK</label>

                                                <?php echo form_error('nik'); ?>

                                                <div class="input-group">

                                                    <span class="input-group-addon">

                                                        <i class="fa fa-plus-square-o"></i>

                                                    </span>

                                                    <input id="nik" type="text" class="form-control" name="nik" placeholder="NIK" > </div>

                                            </div>



                                            <div class="form-group">

                                                <label id="nama">Nama Lengkap</label>

                                                <?php echo form_error('nama'); ?>   

                                                <div class="input-group">

                                                    <span class="input-group-addon">

                                                        <i class="fa fa-plus-square-o"></i>

                                                    </span>

                                                    <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama Lengkap" > </div>

                                            </div>



                                             <div class="form-group">

                                                <label id="nama">Password</label>

                                                <?php echo form_error('password'); ?>   

                                                <div class="input-group">

                                                    <span class="input-group-addon">

                                                        <i class="fa fa-plus-square-o"></i>

                                                    </span>

                                                    <input id="nama" type="password" class="form-control" name="password" placeholder="Password" > </div>

                                            </div>



                                             <div class="form-group">

                                                <label id="nama">Akses</label>

                                                <?php echo form_error('akses'); ?>

                                                <div class="input-group">

                                                    <span class="input-group-addon">

                                                        <i class="fa fa-plus-square-o"></i>

                                                    </span>

                                                    <select id="akses" name="akses" class="form-control">

                                                        <option value="">-PILIH-</option>

                                                        <option value="0">TEAM LEADER</option>

                                                        <option value="1">BRAND AMBASADOR</option>

                                                        <option value="2">ADMINISTRATOR</option>

                                                        <option value="3">INDOFOOD</option>

                                                        <option value="4">KAS</option>

                                                    </select>

                                                </div>

                                            </div>



                                             <div id="row_status" class="form-group">

                                                <label id="nama">Status</label>

                                                 <?php echo form_error('status'); ?>

                                                <div class="input-group">

                                                    <span class="input-group-addon">

                                                        <i class="fa fa-plus-square-o"></i>

                                                    </span>

                                                    <select id="status" name="stay" class="form-control">

                                                        <option value="">===PILIH===</option>

                                                        <option value="N">Mobile</option>

                                                        <option value="Y">Stay</option>

                                                    </select>

                                                </div>

                                            </div>

                                            <div id="row_toko" class="form-group">

                                                <label>Toko</label>

                                                <?php echo form_error('toko'); ?>

                                                <div class="input-group">

                                                    <span class="input-group-addon">

                                                        <i class="fa fa-plus-square-o"></i>

                                                    </span>

                                                    <select id="toko" name="toko[]" multiple style="width: 100%;">

                                                        <?php foreach ($query_toko as $row): ?>

                                                            <option value="<?php echo htmlentities($row->id_toko, ENT_QUOTES, 'utf-8') ?>"><?php echo htmlentities($row->nama, ENT_QUOTES, 'utf-8') ?></option>

                                                        <?php endforeach ?>

                                                    </select>

                                            </div>

                                            </div>



                                            <div id="row_cabang" class="form-group">

                                                <label id="nama">Cabang</label>

                                                <?php echo form_error('cabang'); ?>

                                                <div class="input-group">

                                                    <span class="input-group-addon">

                                                        <i class="fa fa-plus-square-o"></i>

                                                    </span>

                                                    <select id="select_cabang" name="cabang[]" multiple style="width: 100%;">

                                                        <?php

                                                            $data = $this->db->select('id_cabang,nama')->get('sada_cabang');

                                                            foreach ($data->result() as $key => $value) {

                                                                echo "<option value='".$value->id_cabang."'>".$value->nama."</option>";

                                                            }

                                                        ?>

                                                    </select>

                                                </div>

                                            </div>

                                            <div id="row_kota" class="form-group">

                                                <label id="nama">Toko</label>

                                                <?php echo form_error('kota'); ?>

                                                <div class="input-group">

                                                    <span class="input-group-addon">

                                                        <i class="fa fa-plus-square-o"></i>

                                                    </span>

                                                    <select disabled id="select_kota" name="toko_tl[]" class="form-control" multiple style="width: 100%;">

                                                        <?php

                                                            $data = $this->db->select('id_cabang,nama_kota')->get('sada_kota');

                                                            foreach ($data->result() as $key => $value) {

                                                                echo "<option value='".$value->id_kota."'>".$value->nama_kota."(".$value->id_cabang.")</option>";

                                                            }

                                                        ?>

                                                    </select>

                                                </div>

                                            </div> 

                                        </div>

                                        <div class="form-actions">

                                            <input type="submit" value="submit" class="btn blue"></input>

                                            <a type="button" class="btn default" href="/Dashboard/dataUser">Cancel</a>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

</div>




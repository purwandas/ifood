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

                                    <?php echo form_open('user/edit', 'role="form"'); ?>

                                        <div class="form-body">

                                            <div class="form-group">

                                                <label id="nik">NIK</label>

                                                <div class="input-group">

                                                    <span class="input-group-addon">

                                                        <i class="fa fa-plus-square-o"></i>

                                                    </span>

                                                    <input id="id_us" type="hidden" value="<?php echo $paramId; ?>" class="form-control" name="id_us" placeholder="NIK"> 

                                                    <input id="nik" type="text" value="<?php echo $loopEditUser->nik; ?>" class="form-control" name="nik" placeholder="NIK"> </div>

                                            </div>



                                            <div class="form-group">

                                                <label id="nama">Nama Lengkap</label>   

                                                <div class="input-group">

                                                    <span class="input-group-addon">

                                                        <i class="fa fa-plus-square-o"></i>

                                                    </span>

                                                    <input id="nama" value="<?php echo $loopEditUser->nama; ?>" type="text" class="form-control" name="nama" placeholder="Nama Lengkap"> </div>

                                            </div>



                                             <div class="form-group">

                                                <label id="nama">Password</label>

                                                <div class="input-group">

                                                    <span class="input-group-addon">

                                                        <i class="fa fa-plus-square-o"></i>

                                                    </span>

                                                    <?php
                                                        if ($loopEditUser->akses==1) {
                                                            echo "<input type='text' class='form-control' name='password' value='".$loopEditUser->password."'> ";
                                                         }else{
                                                            echo "<input type='password' class='form-control' name='password' placeholder='Password'> ";
                                                         }
                                                    ?>

                                                </div>

                                                    <!-- <div style="padding-top: 10px;">

                                                        <div class="alert alert-warning">

                                                          <strong>Note!</strong> 

                                                          <br>

                                                          <ul>

                                                              <li><span>Password Lama akan terganti otomatis jika anda memasukan password baru.</span></li>

                                                          </ul>

                                                        </div>

                                                    </div> -->

                                            </div>



                                             <div class="form-group">

                                                <label id="nama">Akses</label>

                                                <div class="input-group">

                                                    <span class="input-group-addon">

                                                        <i class="fa fa-plus-square-o"></i>

                                                    </span>

                                                    <select id="akses" name="akses" class="form-control">

                                                        <?php if ($loopEditUser->akses==0) {

                                                            echo '<option value="0" selected>TEAM LEADER</option>';

                                                            echo '<option value="1">BRAND AMBASADOR</option>';

                                                            echo '<option value="2">ADMINISTRATOR</option>';

                                                            echo '<option value="3">INDOFOOD</option>';

                                                        }

                                                        elseif ($loopEditUser->akses==1) {

                                                            echo '<option value="0">TEAM LEADER</option>';

                                                            echo '<option value="1"selected>BRAND AMBASADOR</option>';

                                                            echo '<option value="2">ADMINISTRATOR</option>';

                                                            echo '<option value="3">INDOFOOD</option>';



                                                         }





                                                         elseif ($loopEditUser->akses==2) {

                                                            echo '<option value="0">TEAM LEADER</option>';

                                                            echo '<option value="1">BRAND AMBASADOR</option>';

                                                            echo '<option value="2"selected>ADMINISTRATOR</option>';

                                                             echo '<option value="3">INDOFOOD</option>';



                                                         }

                                                        elseif ($loopEditUser->akses==3) {

                                                            echo '<option value="0">TEAM LEADER</option>';

                                                            echo '<option value="1">BRAND AMBASADOR</option>';

                                                            echo '<option value="2">ADMINISTRATOR</option>';

                                                            echo '<option value="3" selected>INDOFOOD</option>';



                                                        }elseif ($loopEditUser->akses==4) {

                                                            echo '<option value="0">TEAM LEADER</option>';

                                                            echo '<option value="1">BRAND AMBASADOR</option>';

                                                            echo '<option value="2">ADMINISTRATOR</option>';

                                                            echo '<option value="3">INDOFOOD</option>';

                                                            echo '<option value="4" selected>KAS</option>';



                                                        } ?>

                                                        ?> 
                                                    </select>

                                                </div>

                                            </div>



                                             <div id="row_status" class="form-group">

                                                <label id="nama">Status</label>

                                                <div class="input-group">

                                                    <span class="input-group-addon">

                                                        <i class="fa fa-plus-square-o"></i>

                                                    </span>

                                                    <select id="status" name="stay" class="form-control">

                                                        <option value="">===PILIH===</option>

                                                        <?php if ($loopEditUser->stay=="Y"): ?>

                                                            <option value="N">Mobile</option>

                                                            <option value="Y" selected="">Stay</option>

                                                        <?php endif ?>

                                                            <?php if ($loopEditUser->stay=="N"): ?>

                                                            <option value="N" selected="">Mobile</option>

                                                            <option value="Y">Stay</option>

                                                        <?php endif ?>

                                                    </select>

                                                </div>

                                            </div> 



                                            <div id="row_toko" class="form-group">

                                                <label>Toko</label>

                                                <div class="input-group">

                                                    <span class="input-group-addon">

                                                        <i class="fa fa-plus-square-o"></i>

                                                    </span>

                                                    <select id="toko" name="toko[]" class="form-control" multiple style="width: 100%;">

                                                        <?php foreach ($query_toko as $row): ?>

                                                            <?php echo "<option value='".$row->id_toko."'"; ?>

                                                            <?php if ($loopEditUser->akses == 1): ?>

                                                                <?php if (in_array($row->id_toko, $id_toko)): ?>

                                                                    <?php echo "selected"; ?>

                                                                <?php endif ?>

                                                            <?php endif ?>

                                                            <?php echo ">".$row->nama."</option>"; ?>

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

                                                                echo "<option value='".$value->id_cabang."'";

                                                                if ($loopEditUser->akses == 0) {

                                                                    if (in_array($value->id_cabang, $id_cabang)) {

                                                                        echo "selected";

                                                                    }

                                                                }

                                                                echo ">".$value->nama."</option>";

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
                                                    <select id="select_kota" name="toko_tl[]" class="form-control" multiple style="width: 100%;">

                                                        <?php
                                                            if ($loopEditUser->akses == 2 || $loopEditUser->akses == 3) {
                                                            }
                                                            else{
                                                                foreach ($tokoa->result() as $tokos) {
                                                                $idtoko[] = $tokos->id_toko;
                                                                        $data = $this->db->select('nama,id_toko')->where('id_toko',$tokos->id_toko)->get('sada_toko');

                                                                        foreach ($data->result() as $l) {
                                                                            echo "<option selected value='".$l->id_toko."'>".$l->nama."</option>";
                                                                        }

                                                                }
                                                                $data = $this->db->select('sada_toko.*')
                                                                        ->join("sada_kota","sada_toko.id_kota = sada_kota.id_kota")
                                                                        ->join("sada_cabang","sada_cabang.id_cabang = sada_kota.id_cabang")
                                                                        ->where_in("sada_cabang.id_cabang",$id_cabang)
                                                                        ->where_not_in('id_toko',$idtoko)->get('sada_toko');

                                                                        foreach ($data->result() as $l) {
                                                                            echo "<option value='".$l->id_toko."'>".$l->nama."</option>";
                                                                }
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




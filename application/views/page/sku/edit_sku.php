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
                    <?php echo form_open('sku/edit', 'role="form"'); ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label id="nama-sku">Nama SKU</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-plus-square-o"></i>
                                </span>
                                <input id="id-sku" type="hidden" class="form-control" value="<?php echo $paramId; ?>" name="id-sku" placeholder="ID SKU">
                                <input id="nama-sku" type="text" class="form-control" value="<?php echo $loopEditSku->nama_produk; ?>" name="nama-sku" placeholder="Nama SKU">
                            </div>
                        </div>

                        <div class="form-group">
                            <label id="kategori-sku">Kategori SKU</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-plus-square-o"></i>
                                </span>
                                <select id="kategori-sku" type="text" class="form-control" name="kategori-sku" placeholder="Kategori SKU">
                                  <?php
                                  $data = $this->db->select('id,nama')->from('sada_kategori')->get();
                                  foreach ($data->result() as $key => $value) {
                                    echo "<option value='".$value->nama."'";
                                    if ($value->id == $loopEditSku->id_kategori) {
                                        echo "selected";
                                    }
                                    echo ">".$value->nama."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                        <!-- <div class="form-group">
                            <label id="kategori-sku">Toko</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-plus-square-o"></i>
                                </span>
                                <select id="kategori-store" type="text" class="form-control" name="kategori-store" placeholder="Kategori SKU">
                                    <option value="select">Select..</option>
                                    <?php
                                    $data = $this->db->select('id_toko,nama')->get('sada_toko');
                                    foreach ($data->result() as $key => $value) {
                                        echo "<option value='".$value->nama."'";
                                        if ($value->id_toko == $loopEditSku->id_store) {
                                            echo "selected";
                                        }
                                        echo ">".$value->nama."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> -->

                    </div>

                    <!-- <div class="form-group">
                        <label id="nik">Price</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-plus-square-o"></i>
                            </span>
                            <input id="price" type="text" value="<?php echo $loopEditSku->price; ?>" class="form-control" name="price" placeholder="price"> 
                            <span id='errmsg' style="color:red;"></span>
                        </div>
                    </div> -->
                </div>
                <div class="form-actions">
                    <input type="submit" value="submit" class="btn blue"></input>
                    <a type="button" class="btn default" href="/sku">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <!-- END SAMPLE FORM PORTLET-->

    <!-- END SAMPLE FORM PORTLET-->
</div>
</div>

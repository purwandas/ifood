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
            <?php echo form_open('sku/add', 'role="form"'); ?>
            <div class="form-body">
                <div class="form-group">
                    <label id="nama-sku">Nama SKU</label>
                    <?php echo form_error('nama-sku'); ?> 
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-plus-square-o"></i>
                        </span>
                        <input id="nama-sku" type="text" class="form-control" name="nama-sku" placeholder="Nama SKU">
                    </div>
                </div>

                <div class="form-group">
                    <label id="kategori-sku">Kategori SKU</label>
                    <?php echo form_error('kategori-sku'); ?> 
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-plus-square-o"></i>
                        </span>
                        <select id="kategori-sku" type="text" class="form-control" name="kategori-sku" placeholder="Kategori SKU">
                          <option value="">Select..</option>   
                          <?php
                          $data = $this->db->select('nama')->get('sada_kategori');
                          foreach ($data->result() as $key => $value) {
                            echo "<option value='".$value->nama."'>".$value->nama."</option>";
                        }
                        ?>
                    </select> 
                </div>
            </div>
            <!-- <div class="form-group">
                <label id="nik">Price</label>
                    <?php echo form_error('price'); ?>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-plus-square-o"></i>
                    </span>
                    <input id="price" type="text" value="<?php echo $loopEditPrice->price; ?>" class="form-control" name="price" placeholder="price">
                    <span id='errmsg' style="color:red;"></span>
                </div>
            </div>
        </div> -->
                                            <!-- <div class="form-group">
                                                <label id="kategori-sku">Toko</label>
                                                <?php echo form_error('kategori-store'); ?> 
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-plus-square-o"></i>
                                                    </span>
                                                    <select id="kategori-store" type="text" class="form-control" name="kategori-store" placeholder="Kategori SKU">
                                                        <option value="">Select..</option>   
                                                        <?php
                                                            $data = $this->db->select('nama')->get('sada_toko');
                                                            foreach ($data->result() as $key => $value) {
                                                                echo "<option value='".$value->nama."'>".$value->nama."</option>";
                                                            }
                                                        ?>
                                                    </select> 
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


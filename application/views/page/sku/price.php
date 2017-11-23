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
                        
                        <form action="#" id="priceInput" class="form-horizontal" method="post">
                            <div class="form-body"><div class="form-group">
                                    <label id="nama">SKU</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-plus-square-o"></i>
                                        </span>
                                        <input id="id_price" name="id_price" type="hidden" class="form-control" value="<?php echo $loopEditPrice->id_produk; ?>"  placeholder="Nama SKU">
                                        <input id="nama" value="<?php echo $loopEditPrice->nama_produk; ?>" type="text" class="form-control" name="nama" disabled placeholder="nama"> </div>
                                    </div>
                                <div class="form-group">
                                        <label id="nik">Kategori</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-plus-square-o"></i>
                                            </span>
                                            <select id="kategori_price" name="kategori_price" class="form-control"disabled>
                                                <option value="">===PILIH===</option>
                                                <?php 
                                                $q_kategori = $this->db->query("select id,nama from sada_kategori");
                                                foreach ($q_kategori->result() as $row): ?>
                                                <option value="<?php echo $row->id; ?>"
                                                    <?php if ($row->id == $loopEditPrice->id_kategori): ?>
                                                        selected 
                                                    <?php endif ?>
                                                ><?php echo $row->nama; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label id="nik">Price</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                            <i class="fa fa-plus-square-o"></i>
                                        </span>
                                        <input id="price" type="text" value="<?php echo $loopEditPrice->price; ?>" class="form-control" name="price" placeholder="price"> 
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

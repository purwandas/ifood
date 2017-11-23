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
            <?php echo form_open('', array()); ?>
            <div class="form-body">
                <div class="form-group">
                    <label id="cabang">Nama Cabang</label>
                    <?php echo form_error('nama-cabang'); ?>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-plus-square-o"></i>
                        </span>
                        <input id="id-cabang" type="hidden" class="form-control" value="<?php echo $loopEditCabang->id_cabang; ?>" name="id-cabang" placeholder="Nama Cabang">
                        <input id="nama-cabang" type="text" class="form-control" value="<?php echo $loopEditCabang->nama; ?>" name="nama-cabang" placeholder="Nama Cabang">

                    </div>
                </div>
                <!-- <div class="form-group">
                    <label id="nik">Target</label>
                    <?php echo form_error('target'); ?>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-plus-square-o"></i>
                        </span>
                        <input id="target" type="text" class="form-control" name="target" placeholder="target"> 
                        <span id='errmsg' style="color:red;"></span>
                    </div>
                </div> -->
                <!-- <div class="form-group">
                    <label id="nik">PIC</label>
                    <?php echo form_error('pic'); ?>
                    <div class="addpicdiv">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-plus-square-o"></i>
                            </span>
                                <input id="pic" type="text" class="form-control" name="pic[]" placeholder="PIC" style="width: 90%;"><span style="padding: 10px;"></span>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="form-group">
                    <label id="nik">Nama PIC</label>
                    <?php echo form_error('emailpic'); ?>
                    <div class="addemailtestdiv">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-plus-square-o"></i>
                            </span>
                                <input id="pic" type="text" class="form-control" value="<?php echo $loopEditCabang->pic; ?>" name="namapic[]" placeholder="Nama PIC" style="width: 90%;">
                                <span style="padding: 10px;"><a href="#" id="add_pic" class="btn btn-primary add_pic"><i class="glyphicon glyphicon-plus"></i></a></span>
                                <!-- <span style="padding: 10px;"><a href="#" id="add_pic" class="btn btn-primary add_email_pic"><i class="glyphicon glyphicon-plus"></i></a></span>
 -->                        </div>
                    </div>
                </div>
            <div class="form-group">
                    <label id="nik">Email PIC</label>
                    <?php echo form_error('emailpic'); ?>
                    <div class="addemaildiv">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-plus-square-o"></i>
                            </span>
                                <input id="pic" type="text" class="form-control" value="<?php echo $loopEditCabang->email_pic; ?>"  name="emailpic[]" placeholder="Email PIC" style="width: 90%;">
                                <!-- <span style="padding: 10px;"><a href="#" id="add_pic" class="btn btn-primary add_email_pic"><i class="glyphicon glyphicon-plus"></i></a></span>
 -->              </div>
                    </div>
                </div>
            </div> 

            <div class="form-group">
                    <label id="nik">ASPM</label>
                    <?php echo form_error('pic'); ?>
                    <div class="addaspmdiv">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-plus-square-o"></i>
                            </span>
                                <input id="pic" type="text" class="form-control" value="<?php echo $loopEditCabang->aspm; ?>" name="aspm[]" placeholder="ASPM" style="width: 90%;">
                        </div>
                    </div>
                </div>
            <div class="form-group">
                    <label id="nik">Email ASPM</label>
                    <?php echo form_error('emailpic'); ?>
                    <div class="addemailaspmdiv">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-plus-square-o"></i>
                            </span>
                                <input id="pic" type="text" class="form-control" value="<?php echo $loopEditCabang->email_aspm; ?>" name="emailaspm[]" placeholder="Email ASPM" style="width: 90%;">
                                <!-- <span style="padding: 10px;"><a href="#" id="add_pic" class="btn btn-primary add_email_pic"><i class="glyphicon glyphicon-plus"></i></a></span>
 -->                        </div>
                    </div>
                </div>
                
            <div class="form-actions">
                <input type="submit" value="submit" class="btn blue"></input>
                <a type="button" class="btn default" href="/cabang">Cancel</a>
            </div>
        </form>
    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->

<!-- END SAMPLE FORM PORTLET-->
</div>
</div>
</div>
</div>
</div>
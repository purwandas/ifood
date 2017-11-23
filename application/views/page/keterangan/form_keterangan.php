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
			<form action="#" id="form_keterangan" class="form-horizontal" method="post">
					<div class="form-body">
						<div class="form-group">
							<label id="cabang">Keterangan</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-plus-square-o"></i>
								</span>
								<input id="id_desc" type="hidden" class="form-control" name="id_desc" value="<?php echo $id_desc; ?>" placeholder="keterangan">
								<input id="keterangan" type="text" class="form-control" name="keterangan" value="<?php echo $desc; ?>" placeholder="keterangan">
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


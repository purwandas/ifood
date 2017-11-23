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
				<?php echo form_open('account/add', 'role="form"'); ?>
				<div class="form-body">
					<div id="row_toko" class="form-group">

						<label>Toko</label>

						<?php echo form_error('toko'); ?>

						<div class="input-group">

							<span class="input-group-addon">

								<i class="fa fa-plus-square-o"></i>

							</span>

							<select id="toko" name="toko[]" class="form-control" multiple style="width: 100%;">

								<?php foreach ($query_toko as $row): ?>

									<option value="<?php echo htmlentities($row->id_toko, ENT_QUOTES, 'utf-8') ?>"><?php echo htmlentities($row->nama, ENT_QUOTES, 'utf-8') ?></option>

								<?php endforeach ?>

							</select>

						</div>

					</div>
				</div>
				<div class="form-group">

					<label id="nama">Name Account</label>

					<?php echo form_error('nama_account'); ?>   

					<div class="input-group">

						<span class="input-group-addon">

							<i class="fa fa-plus-square-o"></i>

						</span>

						<input id="nama_account" type="text" class="form-control" name="nama_account" placeholder="Nama Account" > </div>

					</div>

					<div class="form-group">

					<!-- <label id="nama">Target</label>

					<?php echo form_error('target'); ?>    -->

					<!-- <div class="input-group">

						<span class="input-group-addon">

							<i class="fa fa-plus-square-o"></i>

						</span>

						<input id="target" type="text" class="form-control" name="target" placeholder="Target" > </div>

					</div> -->
					<div class="form-actions">
						<input type="submit" value="submit" class="btn blue"></input>
						<a type="button" class="btn default" href="/account">Cancel</a>
					</div>
				</form>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->

		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>


<style type="text/css">
.search-table-outter {overflow-x:scroll;}
</style>

<div class="row">



	<div class="col-xs-12">

		<div class="mt-element-ribbon" style="background: white;">

			<div class=

			"ribbon ribbon-border-hor ribbon-clip ribbon-color-danger uppercase">

			<div class="ribbon-sub ribbon-clip"></div>Data <?php echo $title; ?>



		</div>

	</div>

</div>
</div>

<div class="row">
	<div class="col-md-12">



		<!-- BEGIN EXAMPLE TABLE PORTLET-->

		<div class="portlet light bordered">

			<div class="portlet-title">

				<div class="caption font-dark">

					<i class="icon-settings font-dark"></i>

					<span class="caption-subject bold uppercase"> Data <?php echo $title; ?></span>

				</div>



			</div>

			<form action="#" id="top_cabang" class="form-horizontal" method="post">

				<div class="form-group">

					<div class="col-md-12">


					</div>

					<div class="col-md-8" style="margin-top:15px;margin-left:-15px">

						<div class="col-md-8" style="margin-top:15px;margin-left:-15px">

							<div class="col-md-3">

								<input type="text" class="bs-select form-control input-small date-picker" value="" name="startDate" placeholder="Start Date" data-width="13%">



							</div>

							<div class="col-md-3">

								<input type="text" class="bs-select form-control input-small date-picker" value="" name="endDate" placeholder="End Date" data-width="13%">

							</div>

							<div class="col-md-2">

								<button type="submit" class="btn sbold green">Show Report</button>

							</div>
						</div>


					</div>
					<div style="float: right;">
						<div class="col-md-12">
						<label>Sorting</label>
						<form id="descasc">
							<input type="checkbox" class="make-switch" id="ascdesc" data-size="small" data-on-color="success" data-off-color="warning">
						</form>
						</div>
					</div>
				</div>

			</form>

		</div>
	</div>


	<div class="row">
		<div class="col-md-12">
			<div class="portlet light bordered">

				<div class="table-toolbar">

					<div class="row">

						<div class="col-md-6">



						</div>

					</div>

					<div class="btn-group" style="float: right;">

						<!-- <a href="#" class="btn sbold green" id="excelreportprm">Download Excel</a> -->

					</div>

				</div>

                <div class="search-table-outter wrapper">
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="dataReportPromo">

					<thead>

						<tr>

							<th> No</th>
                            <th> PIC Cabang</th>
                            <th> Nama Cabang</th>
                            <th> Target </th>
                            <th> Value</th>
                            <th> Volume</th>
                            <th> Achievement</th>
                            <th> Trend</th>
                            <th> Jumlah BA Cabang</th>
                            <th> Jumlah Toko Cabang</th>

						</tr>

					</thead>

					<tbody id='resultCabang'>

						<tr>
	                        <td colspan="9" id="loading"></td>
	                    </tr>

					</tbody>

				</table>
			</div>

			</div>
		</div>
	</div>

</div>


 
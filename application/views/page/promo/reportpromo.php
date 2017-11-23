<style type="text/css">

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

			<form action="#" id="form_promo" class="form-horizontal" method="post">

				<!-- <div class="form-group">

					<div class="col-md-12">

						<select id="ba" name="ba" class="  form-control select2" data-width="18%"></select>

						<select id="toko" name="toko"  class=" form-control select2"  data-width="18%"></select>

						<select id="cabang" name="cabang"  class="select2 form-control"  data-width="18%"></select>

						<select id="kota" name="kota"  class="select2 form-control"  data-width="18%"></select>

					</div>

					<div class="col-md-8" style="margin-top:15px;margin-left:-15px">

						<div class="col-md-3">
                        <input id="startDate"type="text" class="bs-select form-control input-small date-picker" value="05/29/2016" name="startDate" placeholder="Start Date" data-width="13%">

                    </div>
                    <div class="col-md-3">
                        <input id="endDate" type="text" class="bs-select form-control input-small date-picker" name="endDate" value="<?php echo date("m/d/Y"); ?>" placeholder="End Date" data-width="13%">
                    </div>

						<div class="col-md-2">

							<button type="submit" class="btn sbold green">Filter</button>

						</div>

					</div>

				</div> -->
				<div class="form-group">
                    <div class="col-md-12">
                                <!-- <select id="tl" name="tl"  class=" form-control select2"></select> -->
                            <div class="col-md-3" style="padding:10px;">
                                <select id="ba" name="ba" class="  form-control select2"></select>
                            </div>
                            <div class="col-md-3" style="padding:10px;">    
                                <select id="toko" name="toko"  class=" form-control select2"></select>
                            </div>
                            <div class="col-md-3" style="padding:10px;">
                                <select id="cabang" name="cabang"  class="select2 form-control"></select>
                            </div>
                            <div class="col-md-3" style="padding:10px;">
                                <select id="kota" name="kota"  class="select2 form-control"></select>
                            </div>
                    </div>
                    <div class="col-md-8" style="margin-top:15px;margin-left:-15px">
                              <div class="col-md-3" style="padding-bottom:10px;">
                                <input type="text" class="bs-select form-control input-small date-picker" name="startDate" placeholder="Start Date" data-width="13%">
                            </div>
                            <div class="col-md-3" style="padding-bottom:10px;">
                                <input type="text" class="bs-select form-control input-small date-picker" name="endDate" placeholder="End Date" data-width="13%">
                            </div>
                            <div class="col-md-2" style="padding-bottom:10px;">
                              <button type="submit" class="btn sbold green">Filter</button>
                          </div>
                      </div>
                  </div>

			</form>
		</div>
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

                <a href="#" class="btn sbold green" id="excelreportprm">Download Excel</a>

            </div>

        </div>
	<table class="table table-striped table-bordered table-hover table-checkable order-column" id="dataReportPromo">

		<thead>

			<tr>

				<th> NO </th>

				<th> Cabang </th>

				<th> Kota </th>

				<th> Customer Code </th>

				<th> Nama Store </th>

				<th> Nama Ba </th>

				<th> Nama TL </th>

				<th> Tipe Promo </th>

				<th> Jenis Promo </th>

				<th> Keterangan Promina </th>

				<th> Keterangan Kompetitor </th>

				<th> Periode Mulai </th>

				<th> Periode Selesai </th>

				<th> Merk </th>

				<th> Tanggal Input</th>

				<th> Foto Promina </th>

				<th> Foto Kompetitor </th>

			</tr>

		</thead>

		<tbody>



		</tbody>

	</table>


    </div>
</div>
</div>

</div>
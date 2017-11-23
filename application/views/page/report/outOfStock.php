
<div class="table-toolbar">
    <div class="row">
        <div class="col-xs-12">

            <div class="mt-element-ribbon" style="background: white;">

                <div class="ribbon ribbon-border-hor ribbon-clip ribbon-color-danger uppercase">

                    <div class="ribbon-sub ribbon-clip"></div>Data <?php echo $title; ?>

                </div>

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">

                <div class="portlet-title">

                    <div class="caption font-dark">

                        <i class="icon-settings font-dark"></i>

                        <span class="caption-subject bold uppercase"> Data <?php echo $title; ?></span>

                    </div>
                <div class="form-group">
                  <form class="" id="oos" action="#" method="post">
                      <div class="col-md-12">
                        <!-- <select id="tl" name="tl"  class=" form-control select2"  data-width="18%"></select> -->
                        <select id="ba" name="ba" class="  form-control select2" data-width="18%"></select>
                        <select id="toko" name="toko"  class=" form-control select2"  data-width="18%"></select>
                        <select id="cabang" name="cabang"  class="select2 form-control"  data-width="18%"></select>
                        <select id="kota" name="kota"  class="select2 form-control"  data-width="18%"></select>
                    </div>
                    <div class="col-md-8" style="margin-top:15px;margin-left:-15px">
                      <div class="col-md-3">
                        <input id="startDate"type="text" class="bs-select form-control input-small date-picker" name="startDate" placeholder="Start Date" data-width="13%">

                    </div>
                    <div class="col-md-3">
                        <input id="endDate" type="text" class="bs-select form-control input-small date-picker" name="endDate" placeholder="End Date" data-width="13%">
                    </div>
                    <div class="col-md-2">
                      <button id="filter"  type="submit"name="filter" class="btn sbold green" type="button">Filter</button>
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
            <table class="table table-striped table-responsive table-bordered table-hover table-checkable order-column" id="outOfStockTable">
                <thead>
                    <tr>
                        <!-- <th> No. </th> -->
                        <th> OOS </th>
                        <th> Cabang </th>
                        <th> Kota </th>
                        <th> Customer Id </th>
                        <th> Nama Toko </th>
                        <th> Nama Ba </th>
                        <th> Tanggal </th>
                        <th style="width: 200px;">List Out Of Stock</th>
                        <th> Tipe </th>
                        <th>Keterangan</th>
                        <th>Time Elapsed</th>
                    </tr>
                </thead>
                <tbody id="hasilFilter">
                    <tr  class="odd gradeX"></tr>
                </tbody>
            </table>
<div class="btn-group" >
      <a class="btn sbold green" type="submit" id="excelDownload" href="#" target="_blank"> Download Excel </a>
  </div>


</div>
</div>
</div>

</div>
</div>
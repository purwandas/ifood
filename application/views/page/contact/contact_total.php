<style type="text/css"></style>
<form action="#" id="a" class="form-horizontal" method="post">
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
                          <div class="col-md-12">

                            <select id="ba" name="ba" class="  form-control select2" data-width="18%"></select>
                            <select id="toko" name="toko"  class=" form-control select2"  data-width="18%"></select>
                            <select id="cabang" name="cabang"  class="select2 form-control"  data-width="18%"></select>
                            <select id="kota" name="kota"  class="select2 form-control" data-width="18%"></select>
                        </div>
                        <div class="col-md-8" style="margin-top:15px;margin-left:-15px">
                          <div class="col-md-3">
                            <input type="text" class="bs-select form-control input-small date-picker" name="startDate" placeholder="Start Date" data-width="13%">

                        </div>
                        <div class="col-md-3">
                            <input type="text" class="bs-select form-control input-small date-picker" name="endDate" placeholder="End Date" data-width="13%">
                        </div>
                        <div class="col-md-2">
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
                <div class="btn-group" style="float: right;">

                    <a href="#" class="btn sbold green" id="excelCDetail">Download Excel</a>

                </div>
            </div>
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="dataContactTotal">
            <thead>
                <tr>
                    <th> No. </th>
                    <th> Cabang </th>
                    <th> Kota </th>
                    <th> Tanggal </th>
                    <th> Nama BA </th>
                    <th> Nama Toko </th>
                    <th> Nama Orang Tua </th>
                    <th> Nama Anak </th>
                    <th> No telp </th>
                    <th> Tgl Lahir Anak </th>
                    <th> Status </th>
                    <th> Beli/Tidak </th>
                    <th> Merk Sebelumnya </th>
                    <th> Sampling </th>
                    <th> Sampling Wet/Dry </th>
                    <th> Samping Segment </th>
                </tr>
            </thead>
            <tbody> 

            </tbody>
        </table>
            <!-- <div class="btn-group">
                <a href="#" class="btn sbold green" id="excelCDetail">Download Excel</a>
            </div> -->
        </div>

    </div>
</div>
</div>

</div>
</div>
 
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
          <form class="" id="form_sku" action="#" method="post">
          <div class="col-md-12">
                <!-- <select id="tl" name="tl"  class=" form-control select2" ></select> -->
            <div class="col-md-3" style="padding:10px;">
                <select id="ba" name="ba" class="  form-control select2"></select>
            </div>
            <div class="col-md-3" style="padding:10px;">
                <select id="toko" name="toko"  class=" form-control select2" ></select>
            </div>
            <div class="col-md-3" style="padding:10px;">
                
                <select id="cabang" name="cabang"  class="select2 form-control" ></select>
                
            </div>
            <div class="col-md-3" style="padding:10px;">
                <select id="kota" name="kota"  class="select2 form-control" ></select>
                
            </div>
            <div class="col-md-3" style="padding:10px;">
                <select id="sku_kat" name="sku_kat"  class="select2 form-control" ></select>
            </div>
       </div>
            <div class="col-md-8" style="margin-top:15px;">
              <div class="col-md-3" style="padding-bottom:10px;">
                <input id="startDate"type="text" class="bs-select form-control input-small date-picker" name="startDate" placeholder="Start Date" data-width="13%">

              </div>
              <div class="col-md-3" style="padding-bottom:10px;">
                <input id="endDate" type="text" class="bs-select form-control input-small date-picker" name="endDate" placeholder="End Date" data-width="13%">
              </div>
                <div class="col-md-2" style="padding-bottom:10px;">
                    <button type="submit" class="btn sbold green">Filter</button>
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
            Baru boss
<table style='white-space:nowrap;text-align:center;' class="table table-striped table-responsive table-bordered table-hover table-checkable order-column" id="skuDataTable">
    <thead align='center'>
        <tr id='headerSku'>

        </tr>
    </thead>
    <!-- <tbody id= "hasilFilter" >
        <tr  class="odd gradeX"></tr>
    </tbody> -->
</table>
<!-- <div class="btn-group" >
      <a class="btn sbold green" type="submit" id="excelDownload" href="#" target="_blank"> Download Excel </a>
</div> -->


</div>
</div>
</div>

</div>
</div>
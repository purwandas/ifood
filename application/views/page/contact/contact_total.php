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

            <form action="#" id="a" class="form-horizontal" method="post">

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

                <a href="#" target="__blank" class="btn sbold green" id="exceltotalcontact">Download Excel</a>

            </div>

        </div>
    <table class="table table-striped table-bordered table-hover table-checkable order-column display" cellspacing="0" width="100%" id="dataContactTotal">

        <thead>

            <tr align='center'>
                        <th rowspan="2" width='100'>Cabang</th>
                        <th rowspan="2">Nama BA</th>
                        <!-- <th rowspan="2">Nama TL</th> -->
                        <th rowspan="2">Status</th>
                        <th rowspan="2">Costumer Id</th>
                        <th rowspan="2">Nama Store</th>
                        <th rowspan="2">Tanggal Contact</th>
                        <th colspan="3">Contact</th>
                        <th colspan="5">Sampling</th>
                        <th colspan="5">Strike Sampling</th>
                    </tr>
                    <tr>
                        <td>Contact</td>
                        <td>Switching</td>
                        <td>New Recruit</td>

                        <td>BC</td>
                        <td>BTI</td>
                        <td>Rusk </td>
                        <td>Pudding</td>
                        <td>Others</td>
                        
                        <td>BC</td>
                        <td>BTI</td>
                        <td>Rusk </td>
                        <td>Pudding</td>
                        <td>Others</td>
                    </tr>
                   <!--  <tr id="sampling">
                        <td>Contact</td>
                        <td>Switching</td>
                        <td>New Recruit</td>

                        <td>BC</td>
                        <td>BTI</td>
                        <td>Rusk </td>
                        <td>Pudding</td>
                        <td>Others</td>
                        
                        <td>BC</td>
                        <td>BTI</td>
                        <td>Rusk </td>
                        <td>Pudding</td>
                        <td>Others</td>
                    </tr>
                    <tr> -->
                        
            </tr>

        </thead>

        <tbody>



        </tbody>

    </table>


    </div>
</div>
</div>

</div>
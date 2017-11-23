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

        <div class="portlet light bordered">

            <div class="portlet-title">

                <div class="caption font-dark">

                    <i class="icon-settings font-dark"></i>

                    <span class="caption-subject bold uppercase"> Data <?php echo $title; ?></span>

                </div>



            </div>

            <form action="#" id="oos" class="form-horizontal" method="post">

                <div class="form-group">

                    <div class="col-md-12">


                    </div>

                    <div class="col-md-8" style="margin-top:15px;margin-left:-15px">

                        <div class="col-md-12" style="margin-top:15px;margin-left:-15px">

                            <div class="col-md-3 ">
                                <input id="startDate" required='required' type="text" value=""  class="bs-select form-control input-small date-picker"
                                name="startDate" placeholder="Start Date" data-width="13%">
                            </div>
                            <div class="col-md-3 ">
                                <input id="endDate" required='required' type="text" value="" class="bs-select form-control input-small date-picker"
                                name="endDate" placeholder="End Date" data-width="13%">
                            </div>

                            <div class="col-md-3 ">
                                <select id="status" required='required' class="form-control "
                                name="endDate">
                                    <option value="" disabled selected>User Status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Pasif">Pasif</option>
                                </select>
                            </div>

                            <div class="col-md-2 col-md-offset-1">
                                <button id="topSku" type="submit" name="topSku" class="btn sbold green" type="button">
                                    Show Report
                                </button>
                            </div>
                            
                        </div>


                    </div>
                    <!-- <div style="float: right;">
                        <div class="col-md-12">
                            <label>Sorting</label>
                            <form id="descasc">
                                <input type="checkbox" class="make-switch" id="ascdesc" data-size="small" data-on-color="success" data-off-color="warning">
                            </form>
                        </div>
                    </div> -->
                </div>

            </form>

        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <p id="judul">
                    
                </p>
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
                            <th> NIK</th>
                            <th> Nama BA </th>
                            <th> Nama Toko (Store ID)</th>
                        </tr>

                    </thead>

                    <tbody id="userResult">
                        <tr>
                            <td colspan="4" id="loading"></td>
                        </tr>
                    </tbody>

                </table>
            </div>

            </div>
        </div>
    </div>

</div>
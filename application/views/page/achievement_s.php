<div class="row">
    <div class="col-md-12">
        <div class="portlet box bg-green-haze">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i> </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                        <a href="javascript:;" class="reload"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>

                <div class="portlet-body flip-scroll">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <form class="" id="form_sewa" action="<?php echo site_url('ach'); ?>" method="post">
                          <div class="col-md-12">
                            <div class="pull-left" style="padding-right:10px;">
                                <input type="date" name="startdate" class="form-control" id="startDate" placeholder="Start Date">
                            </div>
                            <div class="pull-left" style="padding-right:10px;">
                                <input type="date" name="enddate" class="form-control" id="endDate" placeholder="End Date">
                            </div>
                            <div class="pull-left" style="padding-right:10px;">
                                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Proses</button>
                            </div>
                          </div>
                        </form>
                        <thead class="flip-content">
                            <tr style="background: #548235;color: white;">
                                <th align="center" width="20%"> Compass </th>
                                <th align="center" width="20%"> Region </th>
                                <th align="center">  Area (Cabang) (Dijumlah per cabang)</th>
                                <th align="center" class="numeric"> BC </th>
                                <th align="center" class="numeric"> BTI </th>
                                <th align="center" class="numeric"> RUSK </th>
                                <th align="center" class="numeric"> PUDING </th>
                                <th align="center" class="numeric"> OTHERS </th>
                                <th align="center" class="numeric"> TOTAL </th>
                                <th align="center" class="numeric"> SWITCHING </th>
                                <th align="center" class="numeric"> NEW RECRUIT </th>
                            </tr>
                        </thead>

                    </div>
                </div>
            </div>

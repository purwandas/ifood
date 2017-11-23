
<div class="table-toolbar">
    <div class="row">
        <div class="form-group">
          <form class="" action="<?php echo base_url('report/absensiReport')?>" method="post">
          <div class="col-md-12">
                <select id="tl" name="tl"  class=" form-control select2"  data-width="18%"></select>
                <select id="ba" name="ba" class="  form-control select2" data-width="18%"></select>
                <select id="toko" name="toko"  class=" form-control select2"  data-width="18%"></select>
                <select id="cabang" name="cabang"  class="select2 form-control"  data-width="18%"></select>
                <select id="kota" name="kota"  class="select2 form-control"  data-width="18%"></select>
                <select id="month" name="month"  data-width="18%">
                  <option>
                    <?php 
                    echo date("n",mktime(0,0,0,0,0,2016));
                     ?>
                  </option>
                </select>
            </div>
            <div class="col-md-8" style="margin-top:15px;margin-left:-15px">
              <div class="col-md-3">
                <input id="startDate"type="text" class="bs-select form-control input-small date-pickrer" name="startDate" placeholder="Start Date" data-width="13%">

              </div>
              <div class="col-md-3">
                <input id="endDate" type="text" class="bs-select form-control input-small date-picker" name="endDate" placeholder="End Date" data-width="13%">
              </div>
                <div class="col-md-2">
                  <button id="filter"  type="submit"name="filter" class="btn blue-hoki pull-right" type="button">Filter</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<table class="table table-striped table-responsive table-bordered table-hover table-checkable order-column" id="absensiDataTable">
    <thead>
        <tr id='headerAbsensi'>
            
        </tr>
    </thead>
    <tbody id= "hasilFilter" >
        <tr  class="odd gradeX"></tr>
    </tbody>
</table>

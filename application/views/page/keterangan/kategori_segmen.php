
<div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="icon-settings font-dark"></i>
                <span class="caption-subject bold uppercase"> <?php echo $title ?></span>
            </div>
        </div>
        <?php if ($this->session->userdata("akses")=="3"): ?>
        <?php else: ?>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <div class="alert alert-success" style="display: none;" id="status"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <table class="table">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Kategori</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1; foreach ($this->db->get('sada_kategori')->result() as $key => $value) {
              echo '<tr class="odd">';
                
                    echo "<td>".$no++."</td>
                          <td>".$value->nama."</td>
                          <td id='price:".$value->id."' contenteditable='true'>".$value->price."</td>";
                echo "</tr>";
                } ?>
            </tr>
        </tbody>
    </table>
</div>
</div>
</div>
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
                        <tbody>
                            <?php 
                            foreach ($region->result() as $key => $reg) {
                                // echo $reg->region;
                                $dat = array();
                                $cab = $this->db->get_where("sada_cabang",array('id_region'=>$reg->id_region));
                                // echo "Jumlah".$cab->num_rows();
                                $compass = "";
                                if ($reg->region == "Sumatera") {
                                    $compass .= "West";
                                }
                                elseif ($reg->region == "Jabodetabek") {
                                    $compass .= "Central";
                                }
                                elseif ($reg->region == "Jawa Barat") {
                                    $compass .= "Central";
                                }
                                else{
                                    $compass .= "East";
                                }

                                echo "<tr>";
                                echo "<td rowspan='".$cab->num_rows()."'>".$compass."</td>";
                                echo "<td rowspan='".$cab->num_rows()."'>".$reg->region."</td>";
                                echo "";
                                foreach ($cab->result() as $cabang) {
                                    // echo $cabang->id_cabang;
                                    echo "<td>".$cabang->nama."</td>";
                                    $sql = "SELECT DISTINCT
    (
        SELECT
            SUM(sd_prj.qty)
        FROM
            sada_produk_terjual AS sd_prj
        LEFT JOIN sada_produk AS sd_prd ON sd_prd.id_produk = sd_prj.id_produk
        LEFT JOIN sada_kategori AS sd_kat ON sd_kat.id = sd_prd.id_kategori
        LEFT JOIN sada_toko AS sd_tok ON sd_tok.id_toko = sd_prj.id_toko
        LEFT JOIN sada_kota AS sd_kot ON sd_kot.id_kota = sd_tok.id_kota
        LEFT JOIN sada_cabang AS sd_cab ON sd_cab.id_cabang = sd_kot.id_cabang
        WHERE
            sd_kat.id = '1'
        AND sd_cab.id_cabang = sada_cabang.id_cabang
        
            LIMIT 1
    ) AS qty_BC,
    (
        SELECT
            SUM(sd_prj.qty)
        FROM
            sada_produk_terjual AS sd_prj
        LEFT JOIN sada_produk AS sd_prd ON sd_prd.id_produk = sd_prj.id_produk
        LEFT JOIN sada_kategori AS sd_kat ON sd_kat.id = sd_prd.id_kategori
        LEFT JOIN sada_toko AS sd_tok ON sd_tok.id_toko = sd_prj.id_toko
        LEFT JOIN sada_kota AS sd_kot ON sd_kot.id_kota = sd_tok.id_kota
        LEFT JOIN sada_cabang AS sd_cab ON sd_cab.id_cabang = sd_kot.id_cabang
        WHERE
            sd_kat.id = '2'
        AND sd_cab.id_cabang = sada_cabang.id_cabang

            LIMIT 1
    ) AS qty_BTI,
    (
        SELECT
            SUM(sd_prj.qty)
        FROM
            sada_produk_terjual AS sd_prj
        LEFT JOIN sada_produk AS sd_prd ON sd_prd.id_produk = sd_prj.id_produk
        LEFT JOIN sada_kategori AS sd_kat ON sd_kat.id = sd_prd.id_kategori
        LEFT JOIN sada_toko AS sd_tok ON sd_tok.id_toko = sd_prj.id_toko
        LEFT JOIN sada_kota AS sd_kot ON sd_kot.id_kota = sd_tok.id_kota
        LEFT JOIN sada_cabang AS sd_cab ON sd_cab.id_cabang = sd_kot.id_cabang
        WHERE
            sd_kat.id = '3'
        AND sd_cab.id_cabang = sada_cabang.id_cabang

            LIMIT 1
    ) AS qty_Rusk,
    (
        SELECT
            SUM(sd_prj.qty)
        FROM
            sada_produk_terjual AS sd_prj
        LEFT JOIN sada_produk AS sd_prd ON sd_prd.id_produk = sd_prj.id_produk
        LEFT JOIN sada_kategori AS sd_kat ON sd_kat.id = sd_prd.id_kategori
        LEFT JOIN sada_toko AS sd_tok ON sd_tok.id_toko = sd_prj.id_toko
        LEFT JOIN sada_kota AS sd_kot ON sd_kot.id_kota = sd_tok.id_kota
        LEFT JOIN sada_cabang AS sd_cab ON sd_cab.id_cabang = sd_kot.id_cabang
        WHERE
            sd_kat.id = '4'
        AND sd_cab.id_cabang = sada_cabang.id_cabang

            LIMIT 1
    ) AS qty_Pudding,
    (
        SELECT
            SUM(sd_prj.qty)
        FROM
            sada_produk_terjual AS sd_prj
        LEFT JOIN sada_produk AS sd_prd ON sd_prd.id_produk = sd_prj.id_produk
        LEFT JOIN sada_kategori AS sd_kat ON sd_kat.id = sd_prd.id_kategori
        LEFT JOIN sada_toko AS sd_tok ON sd_tok.id_toko = sd_prj.id_toko
        LEFT JOIN sada_kota AS sd_kot ON sd_kot.id_kota = sd_tok.id_kota
        LEFT JOIN sada_cabang AS sd_cab ON sd_cab.id_cabang = sd_kot.id_cabang
        WHERE
            sd_kat.id = '5'
        AND sd_cab.id_cabang = sada_cabang.id_cabang

            LIMIT 1
    ) AS qty_Others,




(
        SELECT
            SUM(sada_targ.target)
        FROM
            sada_target AS sada_targ
        LEFT JOIN sada_toko AS sd_tok ON sd_tok.id_toko = sada_targ.id_toko
        LEFT JOIN sada_kota AS sd_kot ON sd_kot.id_kota = sd_tok.id_kota
        LEFT JOIN sada_cabang AS sd_cab ON sd_cab.id_cabang = sd_kot.id_cabang

        LEFT JOIN sada_kategori AS sd_kat ON sada_targ.id_kategori=sd_kat.id
WHERE
            sd_kat.id = '1'
        AND sd_cab.id_cabang = sada_cabang.id_cabang

            LIMIT 1
    ) AS persen_BC,

(
        SELECT
            SUM(sada_targ.target)
            
        FROM
            sada_target AS sada_targ
        LEFT JOIN sada_toko AS sd_tok ON sd_tok.id_toko = sada_targ.id_toko
        LEFT JOIN sada_kota AS sd_kot ON sd_kot.id_kota = sd_tok.id_kota
        LEFT JOIN sada_cabang AS sd_cab ON sd_cab.id_cabang = sd_kot.id_cabang

        LEFT JOIN sada_kategori AS sd_kat ON sada_targ.id_kategori=sd_kat.id
WHERE
            sd_kat.id = '2'
        AND sd_cab.id_cabang = sada_cabang.id_cabang

            LIMIT 1
    ) AS persen_BTI,

(
        SELECT
            SUM(sada_targ.target)
            
        FROM
            sada_target AS sada_targ
        LEFT JOIN sada_toko AS sd_tok ON sd_tok.id_toko = sada_targ.id_toko
        LEFT JOIN sada_kota AS sd_kot ON sd_kot.id_kota = sd_tok.id_kota
        LEFT JOIN sada_cabang AS sd_cab ON sd_cab.id_cabang = sd_kot.id_cabang

        LEFT JOIN sada_kategori AS sd_kat ON sada_targ.id_kategori=sd_kat.id
WHERE
            sd_kat.id = '3'
        AND sd_cab.id_cabang = sada_cabang.id_cabang

            LIMIT 1
    ) AS persen_Rusk,
(
        SELECT
            SUM(sada_targ.target)
            
        FROM
            sada_target AS sada_targ
        LEFT JOIN sada_toko AS sd_tok ON sd_tok.id_toko = sada_targ.id_toko
        LEFT JOIN sada_kota AS sd_kot ON sd_kot.id_kota = sd_tok.id_kota
        LEFT JOIN sada_cabang AS sd_cab ON sd_cab.id_cabang = sd_kot.id_cabang

        LEFT JOIN sada_kategori AS sd_kat ON sada_targ.id_kategori=sd_kat.id
WHERE
            sd_kat.id = '4'
        AND sd_cab.id_cabang = sada_cabang.id_cabang

            LIMIT 1
    ) AS persen_Pudding,

(
        SELECT
            SUM(sada_targ.target)
            
        FROM
            sada_target AS sada_targ
        LEFT JOIN sada_toko AS sd_tok ON sd_tok.id_toko = sada_targ.id_toko
        LEFT JOIN sada_kota AS sd_kot ON sd_kot.id_kota = sd_tok.id_kota
        LEFT JOIN sada_cabang AS sd_cab ON sd_cab.id_cabang = sd_kot.id_cabang

        LEFT JOIN sada_kategori AS sd_kat ON sada_targ.id_kategori=sd_kat.id
WHERE
            sd_kat.id = '5'
        AND sd_cab.id_cabang = sada_cabang.id_cabang

            LIMIT 1
    ) AS persen_Others
FROM
    sada_cabang

            WHERE sada_cabang.id_cabang = '".$cabang->id_cabang."'
            LIMIT 1
                    ";
                                    $ach = $this->db->query($sql);

$data = $ach->row();
// echo $sql;
$x_qtyBC = $data->qty_BC * 100 / $data->persen_BC;
$x_qtyBTI = $data->qty_BTI * 100 / $data->persen_BTI;
$x_qtyRusk = $data->qty_Rusk * 100 / $data->persen_Rusk;
$x_qtyPudding = $data->qty_Pudding * 100 / $data->persen_Pudding;
$x_qtyOthers = $data->qty_Others * 100 / $data->persen_Others;

$jml_qty = $data->qty_BC+$data->qty_BTI+$data->qty_Rusk+$data->qty_Pudding+$data->qty_Others;
$jml_target = $data->persen_BC+$data->persen_BTI+$data->persen_Rusk+$data->persen_Pudding+$data->persen_Others;
// echo var_dump($data);
                                    // foreach ($ach->result() as $data) {
if ($data->qty_BC == null) {
    echo "<td align='center' style='background-color:red;color:white;'  style='background-color:red;color:white;'>0%</td>";
}
else{
    echo "<td align='center' style='background-color:";
    if ($x_qtyBC < 84) {
        echo "red;color:white;";
    }
    if ($x_qtyBC >= 84 && $x_qtyBC <= 89) {
        echo "yellow;";
    }
    if ($x_qtyBC > 89) {
        echo "green;color:white;";
    }
    echo "'>".round($x_qtyBC)."%";
}
if ($data->qty_BTI == null) {
    echo "<td align='center'  style='background-color:red;color:white;'>0%</td>";
}
else{
    echo "<td align='center' style='background-color:";
    if ($x_qtyBTI < 84) {
        echo "red;color:white;";
    }
    if ($x_qtyBTI >= 84 && $x_qtyBTI <= 89) {
        echo "yellow;";
    }
    if ($x_qtyBTI > 89) {
        echo "green;color:white;";
    }
    echo "'>".round($x_qtyBTI)."%";
}
if ($data->qty_Rusk == null) {
    echo "<td align='center'  style='background-color:red;color:white;'>0%</td>";
}
else{
    echo "<td align='center' style='background-color:";
    if ($x_qtyRusk < 84) {
        echo "red;color:white;";
    }
    if ($x_qtyRusk >= 84 && $x_qtyRusk <= 89) {
        echo "yellow;";
    }
    if ($x_qtyRusk > 89) {
        echo "green;color:white;";
    }
    echo "'>".round($x_qtyRusk)."%</td>";
}
if ($data->qty_Pudding == null) {
    echo "<td align='center'  style='background-color:red;color:white;'>0%</td>";
}
else{
    echo "<td align='center' style='background-color:";
    if ($x_qtyPudding < 84) {
        echo "red;color:white;";
    }
    if ($x_qtyPudding >= 84 && $x_qtyPudding <= 89) {
        echo "yellow;";
    }
    if ($x_qtyPudding > 89) {
        echo "green;color:white;";
    }
    echo "'>".round($x_qtyPudding)."%</td>";
}
if ($data->qty_Others == null) {
    echo "<td align='center'  style='background-color:red;color:white;'>0%</td>";
}
else{
    echo "<td align='center' style='background-color:";
    if ($x_qtyOthers < 84) {
        echo "red;color:white;";
    }
    if ($x_qtyOthers >= 84 && $x_qtyOthers <= 89) {
        echo "yellow;";
    }
    if ($x_qtyOthers > 89) {
        echo "green;color:white;";
    }
    echo "'>".round($x_qtyOthers)."%</td>";
}
$qry = "SELECT DISTINCT
    (
        SELECT
            COUNT(*)
        FROM
            sada_form_contact AS sd_f_c
        WHERE
            sd_f_c.tipe = 'switching'
        AND sd_f_c.store_id = sada_form_contact.store_id
    ) AS COUNT_SWITCHING,
    (
        SELECT
            COUNT(*)
        FROM
            sada_form_contact AS sd_f_c
        WHERE
            sd_f_c.tipe = 'newRecruit'
        AND sd_f_c.store_id = sada_form_contact.store_id
    ) AS COUNT_nRECRUIT
FROM
    sada_form_contact
LEFT JOIN sada_toko ON sada_toko.id_toko = sada_form_contact.store_id
LEFT JOIN sada_kota ON sada_kota.id_kota = sada_toko.id_kota
LEFT JOIN sada_cabang ON sada_cabang.id_cabang = sada_kota.id_cabang
WHERE
    sada_cabang.id_cabang = '".$cabang->id_cabang."'
            LIMIT 1

";
echo "<td align='center'>".round($jml_qty * 100 / $jml_target)."%</td>";
$data_q = $this->db->query($qry)->row();
$persen_switching = 70;
$persen_nrecruit = 20;
$switch = $data_q->COUNT_SWITCHING * 100 / $persen_switching;
$nRecruitment = $data_q->COUNT_nRECRUIT * 100 / $persen_nrecruit;
                                    echo "<td align='center' style='background-color:";
    if ($switch < 84) {
        echo "red;color:white;";
    }
    if ($switch >= 84 && $switch <= 89) {
        echo "yellow;";
    }
    if ($switch > 89) {
        echo "green;color:white;";
    }
    echo "'>".round($switch)."%</td>";
                                    echo "<td align='center' style='background-color:";
    if ($nRecruitment < 84) {
        echo "red;color:white;";
    }
    if ($nRecruitment >= 84 && $nRecruitment <= 89) {
        echo "yellow;";
    }
    if ($nRecruitment > 89) {
        echo "green;color:white;";
    }
    echo "'>".round($nRecruitment)."%</td>";

echo "</tr>";
    $datas['qty_bc_arr'] = $data->qty_BC;
    $datas['tar_bc_arr'] = $data->persen_BC;

    $datas['qty_bti_arr'] = $data->qty_BTI;
    $datas['tar_bti_arr'] = $data->persen_BTI;

    $datas['qty_rusk_arr'] = $data->qty_Rusk;
    $datas['tar_rusk_arr'] = $data->persen_Rusk;

    $datas['qty_pudding_arr'] = $data->qty_Pudding;
    $datas['tar_pudding_arr'] = $data->persen_Pudding;

    $datas['qty_others_arr'] = $data->qty_Others;
    $datas['tar_others_arr'] = $data->persen_Others;

    $dat[] = $datas;
    $tar_bcS[] = $data->persen_BC;

    $datas_q['sum_switching'] = $data_q->COUNT_SWITCHING;
    $datas_q['sum_newRecruit'] = $data_q->COUNT_nRECRUIT;

    $datas_q['tar_switching'] = $persen_switching;
    $datas_q['tar_nrecruit'] = $persen_nrecruit;
    $dats[] = $datas_q;

    $dat_BTI[] = $data->qty_BTI;
    $tar_BTI[] = $data->persen_BTI;
    $dat_BC[] = $data->qty_BC * 100 / $data->persen_BC;
    // $dat_BTI[] = $data->qty_BTI * 100 / $data->persen_BTI;
    $dat_Rusk[] = $data->qty_Rusk * 100 / $data->persen_Rusk;
    $dat_Pudding[] = $data->qty_Pudding * 100 / $data->persen_Pudding;
    $dat_Others[] = $data->qty_Others * 100 / $data->persen_Others;

    $dataz['jml_target'] = $jml_target;
    $dataz['jml_qty'] = $jml_qty;
    $dataz_target_qty[] = $dataz;


}
// echo json_encode($dats);
?>
<tr>
    <td style="" align="center"></td>
    <td style="background-color: #548235;color: white;" align="center">Total</td>
    <td style="" align="center">Total</td>
    <td style="" align="center">
    <!-- <?php print_r($dat) ?> -->
        <!-- <?php echo array_sum($dat['qty_bc_arr']) ?> + <?php echo array_sum($dat['tar_bc_arr']); ?> = <?php echo round(array_sum($dat['qty_bc_arr']) * 100 / array_sum($dat['tar_bc_arr'])); ?>% -->
        <?php 
        $sum_qty_bc = 0;
        $sum_tar_bc = 0;
        foreach ($dat as $val) {
            $sum_qty_bc += $val['qty_bc_arr'];
            $sum_tar_bc += $val['tar_bc_arr'];
        }
        echo round($sum_qty_bc * 100 / $sum_tar_bc)."%";
         ?>
    </td>
    <td style="" align="center">
        <?php 
        $sum_qty_bti = 0;
        $sum_tar_bti = 0;
        foreach ($dat as $val) {
            $sum_qty_bti += $val['qty_bti_arr'];
            $sum_tar_bti += $val['tar_bti_arr'];
        }
        echo round($sum_qty_bti * 100 / $sum_tar_bti)."%";
         ?>
    </td>
    <td style="" align="center">
        <?php 
        $sum_qty_rusk = 0;
        $sum_tar_rusk = 0;
        foreach ($dat as $val) {
            $sum_qty_rusk += $val['qty_rusk_arr'];
            $sum_tar_rusk += $val['tar_rusk_arr'];
        }
        echo round($sum_qty_rusk * 100 / $sum_tar_rusk)."%";
         ?>
    </td>
    <td style="" align="center">
        <?php 
        $sum_qty_pudding = 0;
        $sum_tar_pudding = 0;
        foreach ($dat as $val) {
            $sum_qty_pudding += $val['qty_pudding_arr'];
            $sum_tar_pudding += $val['tar_pudding_arr'];
        }
        echo round($sum_qty_pudding * 100 / $sum_tar_pudding)."%";
         ?>
    </td>
    <td style="" align="center">
        <?php 
        $sum_qty_others = 0;
        $sum_tar_others = 0;
        foreach ($dat as $val) {
            $sum_qty_others += $val['qty_others_arr'];
            $sum_tar_others += $val['tar_others_arr'];
        }
        echo round($sum_qty_others * 100 / $sum_tar_others)."%";
         ?>
    </td>
    
    <td style="" align="center">
        <?php 
        $sum_qty_all = 0;
        $sum_tar_all = 0;
        foreach ($dataz_target_qty as $val) {
            $sum_qty_all += $val['jml_qty'];
            $sum_tar_all += $val['jml_target'];
        }
        echo round($sum_qty_all * 100 / $sum_tar_all)."%";
         ?>
    </td>
    <td style="" align="center">
        <?php 
        $sum_switching = 0;
        $sum_tar_switching = 0;
        foreach ($dats as $val) {
            $sum_switching += $val['sum_switching'];
            $sum_tar_switching += $val['tar_switching'];
        }
        echo round($sum_switching * 100 / $sum_tar_switching)."%";
         ?>
    </td>
    <td style="" align="center">
        <?php 
        $sum_nrecruit = 0;
        $sum_tar_nrecruit = 0;
        foreach ($dats as $val) {
            $sum_nrecruit += $val['sum_newRecruit'];
            $sum_tar_nrecruit += $val['tar_nrecruit'];
        }
        echo round($sum_nrecruit * 100 / $sum_tar_nrecruit)."%";
         ?>
    </td>
</tr>
<?php } ?>
<tr>
    <td style="background-color: yellow;" align="center">Total</td>
    <td style="" align="center">Total</td>
    <td style="" align="center">Total</td>
    <td style="" align="center">Total</td>
    <td style="" align="center">Total</td>
    <td style="" align="center">Total</td>
    <td style="" align="center">Total</td>
    <td style="" align="center">Total</td>
    <td style="" align="center">Total</td>
    <td style="" align="center">Total</td>
</tr>
</tbody> 

</table>
</div>
</div>
<!-- END SAMPLE TABLE PORTLET-->
<!-- BEGIN SAMPLE TABLE PORTLET-->

<!-- END SAMPLE TABLE PORTLET-->
</div>


</div>
</div>
</div>

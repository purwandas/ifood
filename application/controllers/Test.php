<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Api extends CI_Controller{



  public function __construct()

  {

    parent::__construct();



      // if ($this->input->get("key")!="ganteng" OR $this->sada->_CekValidationProses()==TRUE)

      // {

      //     show_404();

      // }



    if ($this->input->get("key")!="ganteng" )

    {

      show_404();

    }

  }




  public function ChangeCabang()
  {
    $param = $this->input->post("id_cab");
    // echo $param;
    $q = $this->db->get_where("sada_kota",array('id_cabang'=>$param));
    foreach ($q->result() as $kota) {
      $data[] = $kota;
    }
    $this->output

    ->set_status_header(200)

    ->set_content_type('application/json', 'utf-8')

    ->set_output(json_encode($data, JSON_PRETTY_PRINT))

    ->_display();

    exit;
  }




  public function test($x='')

  {

    echo md5(base64_encode(sha1("password")));

  }



  public function getUser($page,$size)

  {



    if ($this->sada->getUser(($page - 1) * $size, $size)->num_rows()==0) {



      $response = array(

       'status' => false,

       'content' => "404",

       'totalPages' =>0);

      $this->output

      ->set_status_header(200)

      ->set_content_type('application/json', 'utf-8')

      ->set_output(json_encode($response, JSON_PRETTY_PRINT))

      ->_display();

      exit;





    } else {

      $response = array(

       'status' => true,

       'content' => $this->sada->getUser(($page - 1) * $size, $size)->result(),

       'totalPages' => ceil($this->sada->getCountUser() / $size));



      $this->output

      ->set_status_header(200)

      ->set_content_type('application/json', 'utf-8')

      ->set_output(json_encode($response, JSON_PRETTY_PRINT))

      ->_display();

      exit;

    }

  }

  public function getTopSku()
  {
    $startDate = date('Y-m-d H:i:s', strtotime($this->input->get('startDate')));
    $endDate = date('Y-m-d H:i:s', strtotime($this->input->get('endDate')));
    $monthAgo = new DateTime($startDate);
    $monthAgo->modify('-1 month');
    $monthAgoEnd = new DateTime($endDate);
    $monthAgoEnd->modify('-1 month');
    $startDateMonthAgo = $monthAgo->format('Y-m-d H:i:s');
    $endDateMonthAgo = $monthAgoEnd->format('Y-m-d H:i:s');
    $result = $this->sada->getTopSku(['startDate' => $startDate, 'endDate' => $endDate, 'startDateMonthAgo' => $startDateMonthAgo, 'endDateMonthAgo' => $endDateMonthAgo]);
    echo json_encode($result,JSON_PRETTY_PRINT);
//        var_dump($result);
//        echo $startDate;
  }

  public function UpdateUser($id)

  {

    $data = (array)json_decode(file_get_contents('php://input'));

    $this->sada->updateUser($data, $id);



    $response = array(

      'Success' => true,

      'Info' => 'Data Berhasil di update');



    $this->output

    ->set_status_header(200)

    ->set_content_type('application/json', 'utf-8')

    ->set_output(json_encode($response, JSON_PRETTY_PRINT))

    ->_display();

    exit;

  }

  public function dataSKU()

  {

    $data = $this->input->get();



    if (count($data)==0) {

     $response = array(

      'status' => false,

      'content' => "Data kosong");

     $this->output

     ->set_status_header(200)

     ->set_content_type('application/json', 'utf-8')

     ->set_output(json_encode($response, JSON_PRETTY_PRINT))

     ->_display();

     exit;

   }else{



    if ($this->input->get('id_user')) {



              // echo $datas;



      $response = array(

        'status' => true,

        'content' => $this->db->get_where("sada_produk",array("id_kategori"=>$this->input->get('id_kategori')))->result(),

        'id_user' => $this->input->get('id_user'),

        'totalPages' =>count($data)

        );

      $this->output

      ->set_status_header(200)

      ->set_content_type('application/json', 'utf-8')

      ->set_output(json_encode($response, JSON_PRETTY_PRINT))

      ->_display();

      exit;

    }else{

      $response = array(

        'status' => false,

        'content' => "data kosong");

      $this->output

      ->set_status_header(200)

      ->set_content_type('application/json', 'utf-8')

      ->set_output(json_encode($response, JSON_PRETTY_PRINT))

      ->_display();

      exit;

    }

  }

}

public function dataSKUss()

{

  $data = $this->input->get();



  if (count($data)==0) {

   $response = array(

    'status' => false,

    'content' => "Data kosong");

   $this->output

   ->set_status_header(200)

   ->set_content_type('application/json', 'utf-8')

   ->set_output(json_encode($response, JSON_PRETTY_PRINT))

   ->_display();

   exit;

 }else{



            // if ($this->input->get('id_kategori')) {



              // echo $datas;



  $response = array(

    'status' => true,

    'content' => $this->db->get_where("sada_produk",array("id_kategori"=>$this->input->get('id_kategori')))->result()

                  // 'id_user' => $this->input->get('id_user'),

                  // 'totalPages' =>count($data)

    );

  $this->output

  ->set_status_header(200)

  ->set_content_type('application/json', 'utf-8')

  ->set_output(json_encode($response, JSON_PRETTY_PRINT))

  ->_display();

  exit;

             // }else{

             //    $response = array(

             //      'status' => false,

             //      'content' => "data kosong");

             //    $this->output

             //      ->set_status_header(200)

             //      ->set_content_type('application/json', 'utf-8')

             //      ->set_output(json_encode($response, JSON_PRETTY_PRINT))

             //      ->_display();

             //      exit;

             // }





}

}

public function filterdetailcontact()

{

  $arr['tl'] = $this->input->post("tl");

  $arr['ba'] = $this->input->post("ba");

  $arr['toko'] = $this->input->post("toko");

  $arr['cabang'] = $this->input->post("cabang");

  $arr['kota'] = $this->input->post("kota");

  $arr['startDate'] = date('Y-m-d H:i:s', strtotime($this->input->post("startDate")));

  $arr['endDate'] = date('Y-m-d H:i:s', strtotime($this->input->post("endDate")));



  if ($this->input->post()) {

    $select = "SELECT sada_form_contact.namaibu,sada_form_contact.tgl_contact,sada_form_contact.ttl,sada_form_contact.telp,sada_form_contact.tipe,sada_form_contact.beli,sada_form_contact.oldProduct,sada_form_contact.sampling,sada_form_contact.segmen,

    (SELECT sada_kategori.nama FROM sada_kategori where sada_kategori.id=sada_form_contact.kategori_id) AS 'sada_kategori_label',

    (SELECT sada_kategori.id FROM sada_kategori where sada_kategori.id=sada_form_contact.kategori_id AND sada_form_contact.user_id=sada_user.id_user) AS 'count_sampling',

    (SELECT COUNT(*) FROM sada_form_contact WHERE sada_form_contact.user_id=sada_user.id_user AND sada_form_contact.store_id=toko.id_toko) AS 'contact_count',

    (SELECT COUNT(*) FROM sada_form_contact WHERE sada_form_contact.tipe='newRecruit' AND sada_form_contact.user_id=sada_user.id_user AND sada_form_contact.store_id=toko.id_toko) AS 'count_recruit',

    (SELECT COUNT(*) FROM sada_form_contact WHERE sada_form_contact.tipe='switching' AND sada_form_contact.user_id=sada_user.id_user AND sada_form_contact.store_id=toko.id_toko) AS 'count_switching',

    (SELECT COUNT(*) FROM sada_form_contact WHERE sada_form_contact.kategori_id='1' AND sada_form_contact.user_id=sada_user.id_user AND sada_form_contact.store_id=toko.id_toko) AS 'BC',

    (SELECT COUNT(*) FROM sada_form_contact WHERE sada_form_contact.kategori_id='2' AND sada_form_contact.user_id=sada_user.id_user AND sada_form_contact.store_id=toko.id_toko) AS 'BTI',

    (SELECT COUNT(*) FROM sada_form_contact WHERE sada_form_contact.kategori_id='3' AND sada_form_contact.user_id=sada_user.id_user AND sada_form_contact.store_id=toko.id_toko) AS 'Rusk',

    (SELECT COUNT(*) FROM sada_form_contact WHERE sada_form_contact.kategori_id='4' AND sada_form_contact.user_id=sada_user.id_user AND sada_form_contact.store_id=toko.id_toko) AS 'Pudding',

    (SELECT COUNT(*) FROM sada_form_contact WHERE sada_form_contact.kategori_id='5' AND sada_form_contact.user_id=sada_user.id_user AND sada_form_contact.store_id=toko.id_toko) AS 'Others',

    (SELECT COUNT(*) FROM sada_form_contact WHERE sada_form_contact.beli='Y' AND sada_form_contact.sampling='Y') AS 'strike_sampling',

    ";

    $select .= "toko.id_toko,

    toko.store_id,

    toko.id_kota,

    toko.nama AS 'nama_toko',

    sada_user.id_user AS 'id_user',

    sada_user.nama AS 'nama_user',

    sada_user.stay AS 'stay_user',";

    $where = "";

    if ($arr['startDate'] != "1970-01-01 07:00:00" && $arr['endDate'] != "1970-01-01 07:00:00") {

      $where = "WHERE sada_form_contact.tgl_contact BETWEEN '".$arr['startDate']."' and '".$arr['endDate']."'";

      if ($arr['tl'] != 0) {

        $where .= " AND sada_user.id_user='".$arr['tl']."'";

      }

      elseif ($arr['ba'] != 0) {

        $where .= " AND sada_user.id_user='".$arr['ba']."'";

      }

    }

    else{

     if ($arr['tl'] != 0) {

      $where = " WHERE sada_user.id_user='".$arr['tl']."'";

    }

    if ($arr['ba'] != 0) {

      $where = " WHERE sada_user.id_user='".$arr['ba']."'";

    }

  }

  $join = "";

  if ($arr['tl'] == 0) {

    if ($arr['ba'] !=0) {

      if ($arr['toko'] != 0) {

        $where .= " AND toko.id_toko='".$arr['toko']."'";

        if ($arr['cabang'] !=0) {

          if ($arr['kota'] !=0) {

            $where .= " AND cabang.id_cabang in (SELECT id_cabang FROM sada_kota WHERE id_cabang='".$arr['cabang']."')";

          }

          else{

            $where .= " AND cabang.id_cabang='".$arr['cabang']."'";

          }

        }

      }

      else{

        if ($arr['cabang'] != 0) {

         $where .= " AND cabang.id_cabang in (SELECT id_cabang FROM sada_kota WHERE id_cabang='".$arr['cabang']."')";

       }

     }

   }

 }

 else{

  if ($arr['ba']==0) {

    $select .= "                                                                               ";

  }

}



$join .= " LEFT JOIN sada_toko toko ON sada_form_contact.store_id=toko.id_toko";

$join .= " LEFT JOIN sada_kota kota ON toko.id_kota=kota.id_kota";

$join .= " LEFT JOIN sada_cabang cabang ON kota.id_cabang=cabang.id_cabang";



$select .= "

cabang.nama AS 'nama_cabang',

kota.nama_kota 'nama_kota'

FROM sada_form_contact LEFT JOIN sada_user ON sada_form_contact.user_id=sada_user.id_user ".$join." ".$where." ";

  // echo $select;

$data = $this->db->query($select);

$no = 0;

foreach ($data->result() as $key => $value) {

  $row = array();

  $row[] = $no++;

  $row[] = $value->nama_cabang;

  $row[] = $value->nama_kota;

  $row[] = $value->tgl_contact;

  $row[] = $value->nama_user;

  $row[] = $value->nama_toko;

  $row[] = $value->namaibu;

  $row[] = $value->telp;

  $row[] = $value->ttl;

  $row[] = $value->tipe;

  if ($value->beli == "Y") {

    $row[] = "Beli";

  }

  if ($value->beli == "N") {

    $row[] = "Tidak Beli";

  }

  $row[] = $value->oldProduct;

  $row[] = $value->sampling;

  $row[] = $value->segmen;

  $row[] = $value->sada_kategori_label;

  $datsa[] = $row;

    // echo $value->count_sampling;

    // $sel = "SELECT COUNT(*) AS 'coun_sampling' FROM sada_form_contact WHERE kategori_id='".$value->count_sampling."' AND user_id='".$value->id_user."'";

    // $selects = $this->db->query("SELECT SUM(DISTINCT kategori_id) AS 'coun_sampling' FROM sada_form_contact WHERE kategori_id='".$value->count_sampling."' AND user_id='".$value->id_user."'")->row();

    // foreach ($selects->result() as $key => $valuew) {

    //     echo $valuew->coun_sampling;

    // }

    // echo $selects->coun_sampling;

    // echo $sel;

}

if (count($datas) == 0) {

  $output = array(

    "success" => "1",

              // "draw" => $_POST['draw'],

              // "recordsTotal" => $this->datatable->count_all($table,$column,$odb),

              // "recordsFiltered" => $this->datatable->count_filtered($table,$column,$odb),

    "data" => $datsa,

    );

}

else{

  $output = array(

    "success"=>"0"

              // "draw" => $_POST['draw'],

              // "recordsTotal" => $this->datatable->count_all($table,$column,$odb),

              // "recordsFiltered" => $this->datatable->count_filtered($table,$column,$odb),

              // "data" => $data,

    );

}



echo json_encode($output);

}

else{

  $dataDas['title'] = "contact_detail contact_detail";

  $dataDas['desk'] = "App Retail";

  $dataDas['page'] = "contact/contact_detail";



  $dataDas['css'] = $this->sada->CssdataTable();

  $dataDas['js']  = $this->sada->JsdataTable();

  $dataDas['css'][]   = "assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css";

  $dataDas['css'][]   = "assets/global/plugins/select2/css/select2-bootstrap.min.css";

  $dataDas['css'][] = "assets/global/plugins/select2/css/select2.min.css";

  $dataDas['css'][] = "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css";

  $dataDas['css'][] = "assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css";

  $dataDas['css'][] = "assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css";

  $dataDas['js'][]  = "assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js";

  $dataDas['js'][]  = "assets/pages/scripts/components-bootstrap-select.min.js";

  $dataDas['js'][]  = "assets/custom/tagSelection.js";

  $dataDas['js'][]  = "assets/custom/tagDate.js";

  $dataDas['js'][]  = "assets/pages/scripts/components-select2.min.js";

  $dataDas['js'][]  = "assets/global/plugins/select2/js/select2.full.min.js";

  $dataDas['js'][]  = "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js";

  $dataDas['js'][]  = "assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js";

  $dataDas['js'][]  = "assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js";

  $dataDas['js'][]  = "assets/pages/scripts/components-date-time-pickers.min.js";

  $dataDas['js'][]  = "https://code.jquery.com/jquery-1.10.2.js";

  $dataDas['js'][] ="assets/custom/select2Filter.js";

  $dataDas['js'][] ="assets/custom/CountTotal.js";



  $dataDas['js'][]  = "assets/custom/rDetailContact.js";

  $this->load->view('view_awal', $dataDas, FALSE);

}

}

public function getTinuser()

{

  $user = $this->input->get("id_user");

  $sel_tokoinuser = $this->db->select("id_toko")->where("id_user",$user)->get("sada_tokoinuser")->row();

  $exp = explode(',', $sel_tokoinuser->id_toko);

  foreach ($exp as $key => $value) {

    $query = "SELECT sada_toko.id_kota,sada_kota.nama_kota FROM sada_toko LEFT JOIN sada_kota ON sada_toko.id_kota=sada_kota.id_kota WHERE id_toko='".$value."'";

    $toko = $this->db->query($query)->row();



    $s = $this->db->select('sada_cabang.id_cabang,sada_cabang.nama')->join('sada_kota', 'sada_kota.id_cabang = sada_cabang.id_cabang', 'inner')->where('sada_kota.id_kota',$toko->id_kota)->get('sada_cabang');

    foreach ($s->result() as $key => $value) {

      $response[]=[

      'id_cabang' => $value->id_cabang,

      'nama' => $value->nama,



      ];

    }

  }

  echo json_encode(array_unique($response, SORT_REGULAR));

}

public function dContactExcel()

{

  $filename = "excelfilename";

  header("Content-Type: application/xls");

  header("Content-Disposition: attachment; filename=$filename.xls");

  header("Pragma: no-cache");

  header("Expires: 0");



  $sep = "\t";

  $no = 1;

  echo "No.". "\t";

  echo "Cabang". "\t";

  echo "Kota". "\t";

  echo "Tanggal". "\t";

  echo "Nama BA". "\t";

  echo "Nama Toko". "\t";

  echo "Nama Orang Tua". "\t";

  echo "No telp". "\t";

  echo "Tgl Lahir Anak". "\t";

  echo "Status". "\t";

  echo "Beli/Tidak". "\t";

  echo "Merk Sebelumnya". "\t";

  echo "Sampling". "\t";

  echo "Sampling Wet/Dry". "\t";

  echo "Samping Segment". "\t";

  print("\n");

  $arr['tl'] = $this->input->get("tl");

  $arr['ba'] = $this->input->get("ba");

  $arr['toko'] = $this->input->get("toko");

  $arr['cabang'] = $this->input->get("cabang");

  $arr['kota'] = $this->input->get("kota");

  $arr['startDate'] = date('Y-m-d H:i:s', strtotime($this->input->get("startDate")));

  $arr['endDate'] = date('Y-m-d H:i:s', strtotime($this->input->get("endDate")));



  $select = "SELECT sada_form_contact.namaibu,sada_form_contact.tgl_contact,sada_form_contact.ttl,sada_form_contact.telp,sada_form_contact.tipe,sada_form_contact.beli,sada_form_contact.oldProduct,sada_form_contact.sampling,sada_form_contact.segmen,

  (SELECT sada_kategori.nama FROM sada_kategori where sada_kategori.id=sada_form_contact.kategori_id) AS 'sada_kategori_label',



  ";

  $where = "";

  if ($arr['startDate'] != "1970-01-01 07:00:00" && $arr['endDate'] != "1970-01-01 07:00:00") {

    $where = "WHERE sada_form_contact.tgl_contact BETWEEN '".$arr['startDate']."' and '".$arr['endDate']."'";

    if ($arr['tl'] != 0) {

      $where .= " AND sada_user.id_user='".$arr['tl']."'";

    }

    elseif ($arr['ba'] != 0) {

      $where .= " AND sada_user.id_user='".$arr['ba']."'";

    }

  }

  else{

   if ($arr['tl'] != 0) {

    $where = " WHERE sada_user.id_user='".$arr['tl']."'";

  }

  if ($arr['ba'] != 0) {

    $where = " WHERE sada_user.id_user='".$arr['ba']."'";

  }

}

$join = "";

if ($arr['tl'] == 0) {

  if ($arr['ba'] !=0) {

    $select .= "toko.id_toko,

    toko.store_id,

    toko.id_kota,

    toko.nama AS 'nama_toko',

    sada_user.nama AS 'nama_user',";

    if ($arr['toko'] != 0) {

      $where .= " AND toko.id_toko='".$arr['toko']."'";

      if ($arr['cabang'] !=0) {

        if ($arr['kota'] !=0) {

          $where .= " AND cabang.id_cabang in (SELECT id_cabang FROM sada_kota WHERE id_cabang='".$arr['cabang']."')";

        }

        else{

          $where .= " AND cabang.id_cabang='".$arr['cabang']."'";

        }

      }

    }

    else{

      if ($arr['cabang'] != 0) {

       $where .= " AND cabang.id_cabang nti (SELECT id_cabang FROM sada_kota WHERE id_cabang='".$arr['cabang']."')";

     }

   }

 }

}

else{

  if ($arr['ba']==0) {

    $select .= "                                                                               ";

  }

}



$join .= " LEFT JOIN sada_toko toko ON sada_form_contact.store_id=toko.id_toko";

$join .= " LEFT JOIN sada_kota kota ON toko.id_kota=kota.id_kota";

$join .= " LEFT JOIN sada_cabang cabang ON kota.id_cabang=cabang.id_cabang";

-

$select .= "

cabang.nama AS 'nama_cabang',

kota.nama_kota 'nama_kota'

FROM sada_form_contact LEFT JOIN sada_user ON sada_form_contact.user_id=sada_user.id_user ".$join." ".$where." ";

  // echo $select;

$data = $this->db->query($select);

foreach ($data->result() as $key => $value) {

    // $datas[] = $value;

  echo $no++."\t";

  echo $value->nama_cabang."\t";

  echo $value->nama_kota."\t";

  echo $value->tgl_contact."\t";

  echo $value->nama_user."\t";

  echo $value->nama_toko."\t";

  echo $value->namaibu."\t";

  echo $value->telp."\t";

  echo $value->ttl."\t";

  echo $value->tipe."\t";

  if ($value->beli == "N") {

    echo "Tidak"."\t";

  }

  if ($value->beli == "Y") {

    echo "Beli"."\t";

  }

  echo $value->oldProduct."\t";

  if ($value->sampling == "N") {

    echo "Tidak Sampling"."\t";

  }

  if ($value->sampling == "Y") {

    echo "Sampling"."\t";

  }

  echo $value->segmen."\t";

  echo $value->sada_kategori_label."\t";

  echo "\n";

}

}

public function CountTotalContact()

{

  $arr['tl'] = $this->input->post("tl");

  $arr['ba'] = $this->input->post("ba");

  $arr['toko'] = $this->input->post("toko");

  $arr['cabang'] = $this->input->post("cabang");

  $arr['kota'] = $this->input->post("kota");

  $arr['startDate'] = date('Y-m-d H:i:s', strtotime($this->input->post("startDate")));

  $arr['endDate'] = date('Y-m-d H:i:s', strtotime($this->input->post("endDate")));



  $select = "SELECT

  (SELECT sada_kategori.nama FROM sada_kategori where sada_kategori.id=sada_form_contact.kategori_id) AS 'sada_kategori_label',

  (SELECT sada_kategori.id FROM sada_kategori where sada_kategori.id=sada_form_contact.kategori_id AND sada_form_contact.user_id=sada_user.id_user) AS 'count_sampling',

  (SELECT COUNT(*) FROM sada_form_contact AS a WHERE a.user_id=sada_user.id_user AND a.store_id=toko.id_toko AND date(a.tgl_contact)=date(sada_form_contact.tgl_contact)) AS 'contact_count',

  (SELECT COUNT(*) FROM sada_form_contact AS a WHERE sada_form_contact.tipe='newRecruit' AND sada_form_contact.user_id=sada_user.id_user AND sada_form_contact.store_id=toko.id_toko AND date(a.tgl_contact)=date(sada_form_contact.tgl_contact)) AS 'count_recruit',

  (SELECT COUNT(*) FROM sada_form_contact AS a WHERE sada_form_contact.tipe='switching' AND sada_form_contact.user_id=sada_user.id_user AND sada_form_contact.store_id=toko.id_toko AND date(a.tgl_contact)=date(sada_form_contact.tgl_contact)) AS 'count_switching',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.kategori_id='1' AND a.user_id=sada_user.id_user AND a.store_id=toko.id_toko AND date(a.tgl_contact)=date(sada_form_contact.tgl_contact)) AS 'BC',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.kategori_id='2' AND a.user_id=sada_user.id_user AND a.store_id=toko.id_toko AND date(a.tgl_contact)=date(sada_form_contact.tgl_contact)) AS 'BTI',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.kategori_id='3' AND a.user_id=sada_user.id_user AND a.store_id=toko.id_toko AND date(a.tgl_contact)=date(sada_form_contact.tgl_contact)) AS 'Rusk',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.kategori_id='4' AND a.user_id=sada_user.id_user AND a.store_id=toko.id_toko AND date(a.tgl_contact)=date(sada_form_contact.tgl_contact)) AS 'Pudding',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.kategori_id='5' AND a.user_id=sada_user.id_user AND a.store_id=toko.id_toko AND date(a.tgl_contact)=date(sada_form_contact.tgl_contact)) AS 'Others',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.beli='Y' AND sada_form_contact.sampling='Y') AS 'strike_sampling',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.beli='Y' AND sada_form_contact.sampling='Y' AND a.kategori_id='1') AS 'strike_sampling_bc',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.beli='Y' AND sada_form_contact.sampling='Y' AND a.kategori_id='2') AS 'strike_sampling_bti',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.beli='Y' AND sada_form_contact.sampling='Y' AND a.kategori_id='3') AS 'strike_sampling_rusk',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.beli='Y' AND sada_form_contact.sampling='Y' AND a.kategori_id='4') AS 'strike_sampling_pudding',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.beli='Y' AND sada_form_contact.sampling='Y' AND a.kategori_id='5') AS 'strike_sampling_others',

  ";

  $select .= "toko.id_toko,

  toko.store_id,

  toko.id_kota,

  toko.nama AS 'nama_toko',

  sada_user.id_user AS 'id_user',

  sada_user.nama AS 'nama_user',

  sada_user.stay AS 'stay_user',";

  $where = "";

  if ($arr['startDate'] != "1970-01-01 07:00:00" && $arr['endDate'] != "1970-01-01 07:00:00") {

    $where = "WHERE sada_form_contact.tgl_contact BETWEEN '".$arr['startDate']."' and '".$arr['endDate']."'";

    if ($arr['tl'] != 0) {

      $where .= " AND sada_user.id_user='".$arr['tl']."'";

    }

    else{

      if ($arr['ba'] != 0) {

        $where .= " AND sada_user.id_user='".$arr['ba']."'";

        if ($arr['toko'] != 0) {

          $where .= " AND toko.id_toko='".$arr['toko']."'";

          if ($arr['cabang'] != 0) {

            $where .= " AND cabang.id_cabang='".$arr['cabang']."'";

            if ($arr['kota'] != 0) {

              $where .= " AND kota.id_kota='".$arr['kota']."'";

            }

          }

        }

      }

      else{

        if ($arr['toko'] != 0) {

          $where = " WHERE toko.id_toko='".$arr['toko']."'";

          if ($arr['cabang'] != 0) {

            $where = " AND cabang.id_cabang='".$arr['cabang']."'";

            if ($arr['kota'] != 0) {

              $where .= " AND kota.id_kota='".$arr['kota']."'";

            }

          }

        }

        else{

          if ($arr['cabang'] != 0) {

            $where = " WHERE cabang.id_cabang='".$arr['cabang']."'";

            if ($arr['kota'] != 0) {

              $where .= " AND kota.id_kota='".$arr['kota']."'";

            }

          }

        }

      }

    }

  }

  else{

   if ($arr['tl'] != 0) {

    $where = " WHERE sada_user.id_user='".$arr['tl']."'";

  }

  else{

    if ($arr['ba'] != 0) {

      $where = " WHERE sada_user.id_user='".$arr['ba']."'";

    }

    else{

      if ($arr['toko'] != 0) {

        $where = " WHERE toko.id_toko='".$arr['toko']."'";

      }

    }

  }



}

$join = "";

if ($arr['tl'] == 0) {

  if ($arr['ba'] !=0) {



    if ($arr['toko'] != 0) {

      $where .= " AND toko.id_toko='".$arr['toko']."'";

      if ($arr['cabang'] !=0) {

        if ($arr['kota'] !=0) {

          $where .= " AND cabang.id_cabang in (SELECT id_cabang FROM sada_kota WHERE id_cabang='".$arr['cabang']."')";

        }

        else{

          $where .= " AND cabang.id_cabang='".$arr['cabang']."'";

        }

      }

    }

    else{

      if ($arr['cabang'] != 0) {

       $where .= " AND cabang.id_cabang in (SELECT id_cabang FROM sada_kota WHERE id_cabang='".$arr['cabang']."')";

     }

   }

 }

}

else{

  if ($arr['ba']==0) {

    $select .= "                                                                               ";

  }

}



$join .= " LEFT JOIN sada_toko toko ON sada_form_contact.store_id=toko.id_toko";

$join .= " LEFT JOIN sada_kota kota ON toko.id_kota=kota.id_kota";

$join .= " LEFT JOIN sada_cabang cabang ON kota.id_cabang=cabang.id_cabang";



$select .= "

cabang.nama AS 'nama_cabang',

kota.nama_kota 'nama_kota'

FROM sada_form_contact LEFT JOIN sada_user ON sada_form_contact.user_id=sada_user.id_user ".$join." ".$where."  GROUP BY date(sada_form_contact.tgl_contact),sada_form_contact.user_id,sada_form_contact.store_id";

  // echo $select;

$data = $this->db->query($select);

foreach ($data->result() as $key => $value) {

  $datas[] = $value;

    // echo $value->count_sampling;

    // $sel = "SELECT COUNT(*) AS 'coun_sampling' FROM sada_form_contact WHERE kategori_id='".$value->count_sampling."' AND user_id='".$value->id_user."'";

    // $selects = $this->db->query("SELECT SUM(DISTINCT kategori_id) AS 'coun_sampling' FROM sada_form_contact WHERE kategori_id='".$value->count_sampling."' AND user_id='".$value->id_user."'")->row();

    // foreach ($selects->result() as $key => $valuew) {

    //     echo $valuew->coun_sampling;

    // }

    // echo $selects->coun_sampling;

    // echo $sel;

}

if (count($datas) == 0) {

  echo json_encode(array("status"=>false,"content"=>"data kosong"));

}

else{

  echo json_encode($datas,JSON_PRETTY_PRINT);

}

}



public function InputJualProduk()

{

  $data = $this->input->get();



  if (count($data)==0) {

   $response = array(

    'status' => false,

    'content' => "apaan yang lu insert?");

   $this->output

   ->set_status_header(200)

   ->set_content_type('application/json', 'utf-8')

   ->set_output(json_encode($response, JSON_PRETTY_PRINT))

   ->_display();

   exit;

 }else{



  if ($this->input->get('id_user')) {

   foreach ($data as $nama => $isi) {

     $dataInsert['id_user'] = $this->input->get('id_user');

     $dataInsert['id_produk'] =  $this->input->get('id_produk');

     $dataInsert['id_toko'] =  $this->input->get('id_toko');

     $dataInsert['tipe'] =  $this->input->get('tipe');

     $dataInsert['qty']       =  $this->input->get('qty');



   }

   $this->db->insert('sada_produk_terjual', $dataInsert);

   $response = array(

    'status' => true,

    'content' => json_encode($data,TRUE),

    'id_user' => $this->input->get('id_user'),

    'totalPages' =>count($data));

   $this->output

   ->set_status_header(200)

   ->set_content_type('application/json', 'utf-8')

   ->set_output(json_encode($response, JSON_PRETTY_PRINT))

   ->_display();

   exit;

 }else{

  $response = array(

    'status' => false,

    'content' => "apaan yang lu insert? id user nya belom ada");

  $this->output

  ->set_status_header(200)

  ->set_content_type('application/json', 'utf-8')

  ->set_output(json_encode($response, JSON_PRETTY_PRINT))

  ->_display();

  exit;

}





}







}



public function InputJualProdukOOO()

{

  $data = $this->input->get();



  if (count($data)==0) {

   $response = array(

    'status' => false,

    'content' => "apaan yang lu insert?");

   $this->output

   ->set_status_header(200)

   ->set_content_type('application/json', 'utf-8')

   ->set_output(json_encode($response, JSON_PRETTY_PRINT))

   ->_display();

   exit;

 }else{



  if ($this->input->get('id_user')) {

   foreach ($data as $nama => $isi) {

     $dataInsert['id_user'] = $this->input->get('id_user');

     $dataInsert['id_produk'] =  $this->input->get('id_produk');

     $dataInsert['id_toko'] =  $this->input->get('id_toko');

     $dataInsert['tipe'] =  $this->input->get('tipe');

     $dataInsert['qty']       =  $this->input->get('qty');



   }

   $this->db->insert('sada_produk_terjual', $dataInsert);

   $response = array(

    'status' => true,

    'content' => json_encode($data,TRUE),

    'id_user' => $this->input->get('id_user'),

    'totalPages' =>count($data));

   $this->output

   ->set_status_header(200)

   ->set_content_type('application/json', 'utf-8')

   ->set_output(json_encode($response, JSON_PRETTY_PRINT))

   ->_display();

   exit;

 }else{

  $response = array(

    'status' => false,

    'content' => "apaan yang lu insert? id user nya belom ada");

  $this->output

  ->set_status_header(200)

  ->set_content_type('application/json', 'utf-8')

  ->set_output(json_encode($response, JSON_PRETTY_PRINT))

  ->_display();

  exit;

}

}

}



public function inputAbsenStatus()

{

  $data = (array)json_decode(file_get_contents('php://input'));

  if (!isset($data['user_id']) || !isset($data['store_id']) || !isset($data['tipe'])){

    $response = array(

      'success' => false,

      'content' => 'Isi Semua Data');

    $this->output

    ->set_status_header(200)

    ->set_content_type('application/json', 'utf-8')

    ->set_output(json_encode($response, JSON_PRETTY_PRINT))

    ->_display();

    exit;

  }



  $input =[

  'user_id' => $data['user_id'] ,

  'store_id' => $data['store_id'],

  'tipe' => $data['tipe']

  ];





  $this->sada->inputAbsenStatus($input);

  $insertSuccess = ($this->db->affected_rows() != 1) ? false : true;

  if($insertSuccess){

   $response = array(

    'success' => true,

    'content' => 'Berhasil memasukan data');

   $this->output

   ->set_status_header(200)

   ->set_content_type('application/json', 'utf-8')

   ->set_output(json_encode($response, JSON_PRETTY_PRINT))

   ->_display();

   exit;

 }

 $response = array(

  'success' => false,

  'content' => 'Gagal insert Data');

 $this->output

 ->set_status_header(200)

 ->set_content_type('application/json', 'utf-8')

 ->set_output(json_encode($response, JSON_PRETTY_PRINT))

 ->_display();



}





public function inputContactForm()

{

  $data = (array)json_decode(file_get_contents('php://input'));

  switch ($data['tipe']) {

    case 's':

    $tipe = 'switching';

    break;

    case 'n':

    $tipe = 'newRecruit';

    break;

    case 'l';

    $tipe = 'loyal';

    break;

  }

  $aksesUser = $this->sada->getUserStatus($data['user_id']);

  $isSpg = ($aksesUser->akses == 1) ? true : false ;

  $input = [

  'user_id' => $data['user_id'],

  'kategori_id' => $data['kategori_id'],

  'store_id' => $data['store_id'],

  'namaibu' => $data['namaibu'],

  'telp' => $data['telp'],

  'ttl' => $data['ttl'],

  'tipe' => $tipe,

  'beli' => $data['beli'],

  'sampling' => $data['sampling'],

  'samplingQty' => $data['samplingQty'],

  'segmen' => $data['segmen'],

  'oldProduct' => $data['oldProduct']

  ];

  if($this->sada->insertDataContact($input) && $isSpg){

    $response = array(

     'success' => true,

     'content' => 'Berhasil memasukan data');

    $this->output

    ->set_status_header(200)

    ->set_content_type('application/json', 'utf-8')

    ->set_output(json_encode($response, JSON_PRETTY_PRINT))

    ->_display();

    exit;

  }

  $response = array(

   'success' => false,

   'content' => 'Gagal memasukan data');

  $this->output

  ->set_status_header(200)

  ->set_content_type('application/json', 'utf-8')

  ->set_output(json_encode($response, JSON_PRETTY_PRINT))

  ->_display();



}



public function inputConsumerPromo()

{

  $image = $_FILES['image']['name'];

  $newImageName =time()."-promo-consumer-promo".$image;



  $config['upload_path'] = './assets/upload/';

  $config['allowed_types'] = 'gif|jpg|png';

  $config['file_name'] = $newImageName;

  $this->load->library('upload', $config);

  $this->upload->do_upload('image');



      // $image = base64_decode($this->input->post('image'));

      // file_put_contents('./assets/upload'.$newImageName, $image);

  $user_id = $this->input->post('user_id');

  $store_id = $this->input->post('store_id');

  $tipe = $this->input->post('tipe');

  $merk = $this->input->post('merk');

  $jenis = $this->input->post('jenisPromo');

  $keterangan = $this->input->post('keterangan');

  $awalTanggal = $this->input->post('tanggalMulai');

  $selesaiTanggal = $this->input->post('tanggalSelesai');



  $query = $this->sada->insertPromo([

    'user_id' => $user_id,

    'store_id' => $store_id,

    'tipe' => $tipe,

    'merk' => $merk,

    'jenis' => $jenis,

    'keterangan' => $keterangan,

    'awalTanggal' => $awalTanggal,

    'selesaiTanggal' => $selesaiTanggal,

    'foto' =>$newImageName

    ]);



  if($query){

    $response = array(

     'success' => true,

     'content' => 'Berhasil memasukan data');

    $this->output

    ->set_status_header(200)

    ->set_content_type('application/json', 'utf-8')

    ->set_output(json_encode($response, JSON_PRETTY_PRINT))

    ->_display();

    exit;

  }

  $response = array(

   'success' => false,

   'content' => 'Gagal memasukan data');

  $this->output

  ->set_status_header(200)

  ->set_content_type('application/json', 'utf-8')

  ->set_output(json_encode($response, JSON_PRETTY_PRINT))

  ->_display();



}



public function inputOutOfStock()

{

  $user_id = $this->input->post('user_id');

  $produk_id = $this->input->post('produk_id');

  $store_id = $this->input->post('store_id');
  $keterangan = $this->input->post('keterangan');

  if($this->input->get('id_user') == null){

    $response = array(

     'success' => false,

     'content' => 'Gagal memasukan data asd');

    $this->output

    ->set_status_header(200)

    ->set_content_type('application/json', 'utf-8')

    ->set_output(json_encode($response, JSON_PRETTY_PRINT))

    ->_display();

    exit();

  }



  $baAkses = $this->sada->getUserStatus($this->input->get('id_user'));

  if($baAkses->akses == 1){

    $inputJSON = file_get_contents('php://input');

    $dataJson = json_decode($inputJSON, TRUE);
    foreach ($dataJson as $key => $val) {

      $inputData = $this->sada->inputOutOfStock(['user_id' => $val['userId'], 'produk_id' => $val['produkId'],'store_id' => $val['storeId'], 'keterangan' => $val['keterangan']]);
      
      if ($inputData) {
        $response = array(

         'success' => true,

         'decode' => 'aaaa',

         'content' => 'Berhasil memasukan data');          
      }
    }

  }else{

    $response = array(

     'success' => false,

     'content' => 'gagal memasukan data');

  }

      //  echo json_encode(['success'=>false,'content'=>'Gagal Memasukan Data'],JSON_PRETTY_PRINT);

  $this->output

  ->set_status_header(200)

  ->set_content_type('application/json', 'utf-8')

  ->set_output(json_encode($response, JSON_PRETTY_PRINT))

  ->_display();

  exit();





}





    // Report Related API



public function getTl()

{

  $query =$this->sada->getTlName();

  echo json_encode($query->result(),JSON_PRETTY_PRINT);

}



public function getTlCabangAndkota()

{

  $tl_id =  htmlentities($this->input->get('id_tl'), ENT_QUOTES, 'utf-8');

  $result = $this->sada->getTlCabangAndkota($tl_id);

  $response = [];

  foreach ($result->result() as  $value) {

    $response[]=[

    'id_kota' => $value->id_kota,

    'nama_kota' => $value->nama_kota,

    'id_cabang' => $value->id_cabang,

    'nama' => $value->nama

    ];

  }

  echo json_encode($response , JSON_PRETTY_PRINT);

}



public function getBaName()

{

  $query = $this->sada->getBaName();

  $response = [];

  foreach ($query->result() as $key => $value) {

    $response[$value->id_user] = $value->nama;

  }

  echo json_encode($response, JSON_PRETTY_PRINT);



      // Ga tau kenapa pakai ini data result nya jadi ke double

      // $this->output

      //         ->set_status_header(200)

      //         ->set_content_type('application/json', 'utf-8')

      //         ->set_output(json_encode($response, JSON_PRETTY_PRINT))

      //         ->_display();





}





public function getAssignedStore()

{

  $user_id = htmlentities($this->input->get("id_user",TRUE), ENT_QUOTES, 'utf-8');

  $query = $this->sada->getBaAssignedStore($user_id);

  $first = $query->row();

  $explode = explode(",", $first->id_toko);

  $response = [];

  foreach ($explode as $value) {

    $namaToko =  $this->sada->getTokoName($value);

    $result = $namaToko->result();

    foreach($result as $value1)

      $response[] = [

    'id' => $value1->id_toko,

    'nama'=> $value1->nama

    ];

  }



  echo json_encode($response,JSON_PRETTY_PRINT);

}



public function getBranchFromName()

{

  $id_user = htmlentities($this->input->get("id_user",TRUE), ENT_QUOTES, 'utf-8');

  $query = $this->sada->getBranchFromName($id_user);

  // var_dump(array_unique($query,SORT_REGULAR));

  // var_dump($query);

  echo json_encode( array_unique($query,SORT_REGULAR) ,JSON_PRETTY_PRINT);

}



public function getToko()

{

  $query = $this->sada->getToko();

  $response = [];

  foreach ($query->result() as  $value) {

    $response[$value->id_toko] = $value->nama;

  }

  echo json_encode($response,JSON_PRETTY_PRINT);

}





public function getCabangInKota()

{

  $id_toko = $this->input->get('id_toko');

  $query = $this->sada->getCabangInKota($id_toko);

  $response =[

  'id' => $query->row()->id_cabang,

  'nama' => $query->row()->nama

  ];

  echo json_encode($response,JSON_PRETTY_PRINT);

}



public function filterkota()

{

  $id_cabang = $this->input->post("id_cabang");

  $get = $this->db->get_where("sada_kota",array("id_cabang"=>$id_cabang));

  $datas = array();

  foreach ($get->result() as $key => $value) {

    $datas[] = $value;

  }

  echo json_encode($datas);

        // echo json_encode();

}



public function getAllCabang()

{

  $get = $this->sada->getAllCabang();

  echo json_encode($get->result(),JSON_PRETTY_PRINT);

}



public function getKotaInCabang()

{

  $id_cabang = $this->input->get('id_cabang');

  $get = $this->sada->getKotaInCabang($id_cabang);

  echo json_encode($get->result(),JSON_PRETTY_PRINT);

}



public function filterReport()

{

      // Post filter

  $filterTl = ($this->input->post('tl') == "0") ? "" : $this->input->post('tl');

  $filterName = ($this->input->post('ba') == "0") ? "" : $this->input->post('ba');

  $filterToko = (null != $this->input->post('toko') && $this->input->post('toko') !=0) ? $this->input->post('toko') : "";

  $filterCabang = ($this->input->post('cabang') == "0") ? "" : $this->input->post('cabang');

  $filterKota = ($this->input->post('kota') == "0") ? "" : $this->input->post('kota');

  $filterHasilReport =($this->input->post('filterKategori') == "0") ? "" : $this->input->post('filterKategori');

  $startDate =  date('Y-m-d H:i:s', strtotime($this->input->post('startDate')));

  $endDate = date('Y-m-d H:i:s', strtotime($this->input->post('endDate')));



      // Query Result

  $skuFilter =[

  'baName' => $filterName,

  'tokoFilter' => $filterToko,

  'cabangFilter' => $filterCabang,

  'kotaFilter' => $filterKota,

  'startTime' => $startDate,

  'endTime' => $endDate

  ];

  $query = $this->sada->skuReportHeader($skuFilter);

  $result = [];

  $arrayCount =0;

  foreach ($query->result() as  $value) {

    $countFilter =[

    'user_id' => $value->id_user,

    'toko_id' => $value->id_toko,

    'tanggal' => $value->tgl

    ];

    $queryCountBc = $this->sada->skuCount($countFilter,'BC','box');

    $queryCountBti = $this->sada->skuCount($countFilter,'BTI','box');

    $queryCountRusk = $this->sada->skuCount($countFilter,'Rusk','box');

    $queryCountPudding = $this->sada->skuCount($countFilter,'Pudding','box');

    $queryCountOthers = $this->sada->skuCount($countFilter,'Others','box');

    $queryCountBcsSachet = $this->sada->skuCount($countFilter,'BC','sachet');

    $queryCountBtiSachet = $this->sada->skuCount($countFilter,'BTI','sachet');

        // $queryCountRuskSachet = $this->sada->skuCount($countFilter,'Rusk','sachet');

        // $queryCountPuddingSachet = $this->sada->skuCount($countFilter,'Pudding','sachet');

        // $queryCountOthersSachet = $this->sada->skuCount($countFilter,'Others','sachet');



    if($filterHasilReport == '1'){

      $result[$arrayCount] = [

            //  ($arrayCount+=1),

      $value->namaCabang,

      $value->nama_kota,

      $value->store_id,

      $value->namaToko,

      $value->namaBa,

      ($value->stay_mobile == "Y" ) ? "Stay":"Mobile",

      $value->tgl,

      ($queryCountBc->row()->qty == null ) ? 0:$queryCountBc->row()->qty ,

      ($queryCountBti->row()->qty == null )? 0: $queryCountBti->row()->qty,

      ($queryCountRusk->row()->qty == null) ? 0: $queryCountRusk->row()->qty,

      ($queryCountPudding->row()->qty == null) ? 0: $queryCountPudding->row()->qty,

      ($queryCountOthers->row()->qty == null) ? 0: $queryCountOthers->row()->qty,

            //  ($queryCountBcsSachet->row()->qty == null) ? 0: $queryCountBcsSachet->row()->qty,

            //  ($queryCountBtiSachet->row()->qty == null) ? 0: $queryCountBtiSachet->row()->qty

            //  ($queryCountRuskSachet->row()->qty == null) ? 0: $queryCountRuskSachet->row()->qty,

            //  ($queryCountPuddingSachet->row()->qty == null) ? 0: $queryCountPuddingSachet->row()->qty,

            //  ($queryCountOthersSachet->row()->qty == null) ? 0:$queryCountOthersSachet->row()->qty

      ];

    }else if($filterHasilReport == '2'){

      $result[$arrayCount] = [

            //  ($arrayCount+=1),

      $value->namaCabang,

      $value->nama_kota,

      $value->store_id,

      $value->namaToko,

      $value->namaBa,

      ($value->stay_mobile == "Y" ) ? "Stay":"Mobile",

      $value->tgl,

      ($queryCountBcsSachet->row()->qty == null) ? 0: $queryCountBcsSachet->row()->qty,

      ($queryCountBtiSachet->row()->qty == null) ? 0: $queryCountBtiSachet->row()->qty

      ];

    }else if($filterHasilReport == '3'){

      $result[$arrayCount] = [

            //  ($arrayCount+=1),

      $value->namaCabang,

      $value->nama_kota,

      $value->store_id,

      $value->namaToko,

      $value->namaBa,

      ($value->stay_mobile == "Y" ) ? "Stay":"Mobile",

      $value->tgl

      ];

      $produk = $this->sada->getProdukAndCategory();

      foreach ($produk->result() as $countDetails) {

        $produkDetails = $this->sada->skuDetails($countFilter['tanggal'],'box',$countDetails->id_produk);

        array_push($result[$arrayCount],($produkDetails->row()->qty == null ) ? 0: $produkDetails->row()->qty );

        if($countDetails->kategoriNama == 'BC' || $countDetails->kategoriNama == 'BTI'){

          $produkSachet = $this->sada->skuDetails($countFilter['tanggal'],'sachet',$countDetails->id_produk);

          array_push($result[$arrayCount],($produkSachet->row()->qty == null ) ? 0: $produkSachet->row()->qty );

        }

      }

    }else{

      $result[$arrayCount] = [

              //  ($arrayCount+=1),

      $value->namaCabang,

      $value->nama_kota,

      $value->store_id,

      $value->namaToko,

      $value->namaBa,

      ($value->stay_mobile == "Y" ) ? "Stay":"Mobile",

      $value->tgl,

      ($queryCountBc->row()->qty == null ) ? 0:$queryCountBc->row()->qty ,

      ($queryCountBti->row()->qty == null )? 0: $queryCountBti->row()->qty,

      ($queryCountRusk->row()->qty == null) ? 0: $queryCountRusk->row()->qty,

      ($queryCountPudding->row()->qty == null) ? 0: $queryCountPudding->row()->qty,

      ($queryCountOthers->row()->qty == null) ? 0: $queryCountOthers->row()->qty,

      ($queryCountBcsSachet->row()->qty == null) ? 0: $queryCountBcsSachet->row()->qty,

      ($queryCountBtiSachet->row()->qty == null) ? 0: $queryCountBtiSachet->row()->qty

      ];



      $produk = $this->sada->getProdukAndCategory();

      foreach ($produk->result() as $countDetails) {

        $produkDetails = $this->sada->skuDetails($countFilter['tanggal'],'box',$countDetails->id_produk);

        array_push($result[$arrayCount],($produkDetails->row()->qty == null ) ? 0: $produkDetails->row()->qty );

        if($countDetails->kategoriNama == 'BC' || $countDetails->kategoriNama == 'BTI'){

          $produkSachet = $this->sada->skuDetails($countFilter['tanggal'],'sachet',$countDetails->id_produk);

          array_push($result[$arrayCount],($produkSachet->row()->qty == null ) ? 0: $produkSachet->row()->qty );

        }

      }

    }

    $arrayCount++;

  }

  $response =[

  'data' => $result,

  ];

  echo json_encode($response,JSON_PRETTY_PRINT);

}



public function oosReport()

{

  $filterTl = ($this->input->post('tl') == "0") ? "" : $this->input->post('tl');

  $filterName = ($this->input->post('ba') == "0") ? "" : $this->input->post('ba');

  $filterToko = (null != $this->input->post('toko') && $this->input->post('toko') !=0) ? $this->input->post('toko') : "";

  $filterCabang = ($this->input->post('cabang') == "0") ? "" : $this->input->post('cabang');

  $filterKota = ($this->input->post('kota') == "0") ? "" : $this->input->post('kota');

  $startDate =  date('Y-m-d H:i:s', strtotime($this->input->post('startDate')));

  $endDate = date('Y-m-d H:i:s', strtotime($this->input->post('endDate')));

  $startDate =  date('Y-m-d H:i:s', strtotime($this->input->post('startDate')));

  $endDate = date('Y-m-d H:i:s', strtotime($this->input->post('endDate')));

  $query = $this->sada->outOfStockReport(['startDate' => $startDate , 'endDate' => $endDate, 'filterName' => $filterName,'filterToko' => $filterToko,'filterCabang' => $filterCabang,'filterKota' => $filterKota]);

  $result =[];

  foreach($query->result() as $value){

    $result[] =[

    'idOOS' => $value->id_oos,

    'namaCabang' => $value->namaCabang,

    'nama_kota' => $value->nama_kota,

    'store_id' => $value->store_id,

    'namaToko' => $value->namaToko,

    'namaBa' => $value->namaBa,

    'date' => $value->date,

    'namaProduk' => str_replace(',','<br />',$value->namaProduk)

    ];

  }

  $response = [

  'data' => $result

  ];

  echo json_encode($response,JSON_PRETTY_PRINT);

}



public function absensiReportRzl()

{

  $a = date('Y-m-d', strtotime($this->input->post('startDate')));

  $b = date('Y-m-d', strtotime($this->input->post('endDate')));



  $innerQuery = $this->db->select(['user_id','store_id','(select u.nama from sada_user u where a.user_id = u.id_user) nama_user'])

  ->from('sada_absensi a')

  ->group_by('user_id')

  ->get();

      // echo $innerQuery->user_id;

      // foreach ($innerQuery->result() as $val) {



        // foreach ($tanggalFilter as $key => $tgl) {

  $select = "SELECT DISTINCT sada_user.nama,sada_user.id_user,sada_absensi.tipe,sada_toko.nama as 'nama_toko', sada_toko.store_id as 'storeId', sada_kota.nama_kota AS 'namaKota', sada_cabang.nama as 'namaCabang', sada_toko.id_toko as 'idToko'";



  if ($a != "1970-01-01 07:00:00" && $b != "1970-01-01 07:00:00") {



  }

  $select .= "FROM sada_absensi LEFT JOIN sada_user ON sada_absensi.user_id=sada_user.id_user

  LEFT JOIN sada_toko ON sada_absensi.store_id=sada_toko.id_toko

  LEFT JOIN sada_kota ON sada_toko.id_kota=sada_kota.id_kota

  LEFT JOIN sada_cabang ON sada_kota.id_cabang=sada_cabang.id_cabang

  WHERE date(sada_absensi.tanggal) BETWEEN '".$a."' AND '".$b."'

  ";

  echo $select;

  $data = $this->db->query($select);



  foreach ($data->result() as $key => $value) {

                // $datas['name'] = $value->nama;

    $datasss[]= $value;

  }

        // }

      // }

    // $this->output

    // ->set_status_header(200)

    // ->set_content_type('application/json', 'utf-8')

    // ->set_output(json_encode($datasss, JSON_PRETTY_PRINT))

    // ->_display();

    // exit;

}



public function absensiReport()

{

  $a = date('Y-m-d', strtotime($this->input->post('startDate')));

  $b = date('Y-m-d', strtotime($this->input->post('endDate')));

  $result = [];

  $tanggalFilter = [];

  $tanggalFilter[] = $a;

  $count = 0;

      // Masih error kalau input beda bulan

  while($a != $b){

    $a = date('Y-m-d',strtotime('+1day',strtotime($a)));

    $tanggalFilter[] = $a;

  }

      // foreach ($tanggalFilter as $tanggal) {

      //     $result[] = $this->sada->getAbsensiUser($tanggal);

      // }

  $response =[

  'data' => $this->sada->getAbsensiUser($tanggalFilter)

  ];

  echo json_encode($response, JSON_PRETTY_PRINT);

}



public function getAbsensiHeader($value='')

{

  $response = ['cabang','kota','store_id','Nama Store','Nama Ba'];

      // $response = [];

  $startDate = date('j', strtotime($this->input->get('startDate')));

  $endDate = date('j', strtotime($this->input->get('endDate')));

  $maxMonthStart = date('t', strtotime($this->input->get('startDate')));

  $monthStart = date('n', strtotime($this->input->get('startDate')));

  $monthEnd = date('n', strtotime($this->input->get('endDate')));

  $dateCount = $startDate;

      // Masih error kalau input beda bulan

  do{

    if($dateCount > $maxMonthStart && $monthStart < $monthEnd ){

      $dateCount = 1;

      $monthStart++;

    }

    array_push($response,"".$dateCount);

    $dateCount++;

  }while($endDate >= $dateCount);

  echo json_encode($response,JSON_PRETTY_PRINT);

}





    // Pake Datatable ga pake ini

public function oosExcelReport($value='')

{

  $filterTl = ($this->input->get('tl') == "0") ? "" : $this->input->get('tl');

  $filterName = ($this->input->get('ba') == "0") ? "" : $this->input->get('ba');

  $filterToko = (null != $this->input->get('toko') && $this->input->get('toko') !=0) ? $this->input->get('toko') : "";

  $filterCabang = ($this->input->get('cabang') == "0") ? "" : $this->input->get('cabang');

  $filterKota = ($this->input->get('kota') == "0") ? "" : $this->input->get('kota');

  $startDate =  date('Y-m-d H:i:s', strtotime($this->input->get('startDate')));

  $endDate = date('Y-m-d H:i:s', strtotime($this->input->get('endDate')));

  $query = $this->sada->outOfStockReport(['startDate' => $startDate , 'endDate' => $endDate, 'filterName' => $filterName,'filterToko' => $filterToko,'filterCabang' => $filterCabang,'filterKota' => $filterKota]);

  $result = [];

  $result[] = [

  'no','cabang','kota','Customer_id','Nama Toko','Nama Ba','Tanggal','List Out of Stock'

  ];

  $count = 1;

  foreach ($query->result() as $value) {

    $result[]=[

    'count' => ($count++),

    'cabang' => $value->namaCabang,

    'kota' => $value->nama_kota,

    'Customer_id' => $value->store_id,

    'namaToko' => $value->namaToko,

    'namaBa' => $value->namaBa,

    'tanggal' => $value->date,

    'produk' => str_replace(',',"\n",$value->namaProduk)

    ];

  }

  $this->load->library('excel');

  $this->excel->downloadReportOutOfStock($result);

}



public function dContactTotal()

{

  $this->load->library('excel');

  $arr['tl'] = $this->input->get("tl");

  $arr['ba'] = $this->input->get("ba");

  $arr['toko'] = $this->input->get("toko");

  $arr['cabang'] = $this->input->get("cabang");

  $arr['kota'] = $this->input->get("kota");

  $arr['startDate'] = date('Y-m-d H:i:s', strtotime($this->input->get("startDate")));

  $arr['endDate'] = date('Y-m-d H:i:s', strtotime($this->input->get("endDate")));



  $select = "SELECT

  (SELECT sada_kategori.nama FROM sada_kategori where sada_kategori.id=sada_form_contact.kategori_id) AS 'sada_kategori_label',

  (SELECT sada_kategori.id FROM sada_kategori where sada_kategori.id=sada_form_contact.kategori_id AND sada_form_contact.user_id=sada_user.id_user) AS 'count_sampling',

  (SELECT COUNT(*) FROM sada_form_contact AS a WHERE a.user_id=sada_user.id_user AND a.store_id=toko.id_toko AND date(a.tgl_contact)=date(sada_form_contact.tgl_contact)) AS 'contact_count',

  (SELECT COUNT(*) FROM sada_form_contact AS a WHERE sada_form_contact.tipe='newRecruit' AND sada_form_contact.user_id=sada_user.id_user AND sada_form_contact.store_id=toko.id_toko AND date(a.tgl_contact)=date(sada_form_contact.tgl_contact)) AS 'count_recruit',

  (SELECT COUNT(*) FROM sada_form_contact AS a WHERE sada_form_contact.tipe='switching' AND sada_form_contact.user_id=sada_user.id_user AND sada_form_contact.store_id=toko.id_toko AND date(a.tgl_contact)=date(sada_form_contact.tgl_contact)) AS 'count_switching',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.kategori_id='1' AND a.user_id=sada_user.id_user AND a.store_id=toko.id_toko AND date(a.tgl_contact)=date(sada_form_contact.tgl_contact)) AS 'BC',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.kategori_id='2' AND a.user_id=sada_user.id_user AND a.store_id=toko.id_toko AND date(a.tgl_contact)=date(sada_form_contact.tgl_contact)) AS 'BTI',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.kategori_id='3' AND a.user_id=sada_user.id_user AND a.store_id=toko.id_toko AND date(a.tgl_contact)=date(sada_form_contact.tgl_contact)) AS 'Rusk',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.kategori_id='4' AND a.user_id=sada_user.id_user AND a.store_id=toko.id_toko AND date(a.tgl_contact)=date(sada_form_contact.tgl_contact)) AS 'Pudding',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.kategori_id='5' AND a.user_id=sada_user.id_user AND a.store_id=toko.id_toko AND date(a.tgl_contact)=date(sada_form_contact.tgl_contact)) AS 'Others',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.beli='Y' AND sada_form_contact.sampling='Y') AS 'strike_sampling',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.beli='Y' AND sada_form_contact.sampling='Y' AND a.kategori_id='1') AS 'strike_sampling_bc',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.beli='Y' AND sada_form_contact.sampling='Y' AND a.kategori_id='2') AS 'strike_sampling_bti',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.beli='Y' AND sada_form_contact.sampling='Y' AND a.kategori_id='3') AS 'strike_sampling_rusk',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.beli='Y' AND sada_form_contact.sampling='Y' AND a.kategori_id='4') AS 'strike_sampling_pudding',

  (SELECT SUM(a.samplingQty) FROM sada_form_contact AS a WHERE a.beli='Y' AND sada_form_contact.sampling='Y' AND a.kategori_id='5') AS 'strike_sampling_others',

  ";

  $select .= "toko.id_toko,

  toko.store_id,

  toko.id_kota,

  toko.nama AS 'nama_toko',

  sada_user.id_user AS 'id_user',

  sada_user.nama AS 'nama_user',

  sada_user.stay AS 'stay_user',";

  $where = "";

  if ($arr['startDate'] != "1970-01-01 07:00:00" && $arr['endDate'] != "1970-01-01 07:00:00") {

    $where = "WHERE sada_form_contact.tgl_contact BETWEEN '".$arr['startDate']."' and '".$arr['endDate']."'";

    if ($arr['tl'] != 0) {

      $where .= " AND sada_user.id_user='".$arr['tl']."'";

    }

    else{

      if ($arr['ba'] != 0) {

        $where .= " AND sada_user.id_user='".$arr['ba']."'";

        if ($arr['toko'] != 0) {

          $where .= " AND toko.id_toko='".$arr['toko']."'";

          if ($arr['cabang'] != 0) {

            $where .= " AND cabang.id_cabang='".$arr['cabang']."'";

            if ($arr['kota'] != 0) {

              $where .= " AND kota.id_kota='".$arr['kota']."'";

            }

          }

        }

      }

      else{

        if ($arr['toko'] != 0) {

          $where = " WHERE toko.id_toko='".$arr['toko']."'";

          if ($arr['cabang'] != 0) {

            $where = " AND cabang.id_cabang='".$arr['cabang']."'";

            if ($arr['kota'] != 0) {

              $where .= " AND kota.id_kota='".$arr['kota']."'";

            }

          }

        }

        else{

          if ($arr['cabang'] != 0) {

            $where = " WHERE cabang.id_cabang='".$arr['cabang']."'";

            if ($arr['kota'] != 0) {

              $where .= " AND kota.id_kota='".$arr['kota']."'";

            }

          }

        }

      }

    }

  }

  else{

   if ($arr['tl'] != 0) {

    $where = " WHERE sada_user.id_user='".$arr['tl']."'";

  }

  else{

    if ($arr['ba'] != 0) {

      $where = " WHERE sada_user.id_user='".$arr['ba']."'";

    }

    else{

      if ($arr['toko'] != 0) {

        $where = " WHERE toko.id_toko='".$arr['toko']."'";

      }

    }

  }



}

$join = "";

if ($arr['tl'] == 0) {

  if ($arr['ba'] !=0) {



    if ($arr['toko'] != 0) {

      $where .= " AND toko.id_toko='".$arr['toko']."'";

      if ($arr['cabang'] !=0) {

        if ($arr['kota'] !=0) {

          $where .= " AND cabang.id_cabang in (SELECT id_cabang FROM sada_kota WHERE id_cabang='".$arr['cabang']."')";

        }

        else{

          $where .= " AND cabang.id_cabang='".$arr['cabang']."'";

        }

      }

    }

    else{

      if ($arr['cabang'] != 0) {

       $where .= " AND cabang.id_cabang in (SELECT id_cabang FROM sada_kota WHERE id_cabang='".$arr['cabang']."')";

     }

   }

 }

}

else{

  if ($arr['ba']==0) {

    $select .= "                                                                               ";

  }

}



$join .= " LEFT JOIN sada_toko toko ON sada_form_contact.store_id=toko.id_toko";

$join .= " LEFT JOIN sada_kota kota ON toko.id_kota=kota.id_kota";

$join .= " LEFT JOIN sada_cabang cabang ON kota.id_cabang=cabang.id_cabang";



$select .= "

cabang.nama AS 'nama_cabang',

kota.nama_kota 'nama_kota'

FROM sada_form_contact LEFT JOIN sada_user ON sada_form_contact.user_id=sada_user.id_user ".$join." ".$where."  GROUP BY date(sada_form_contact.tgl_contact),sada_form_contact.user_id,sada_form_contact.store_id";

  // echo $select;

$data = $this->db->query($select);



foreach ($data->result() as $key => $value) {

  $datas[] = $value;

  $keys[] = $key;

  $val_cabang[] = $value;

    // echo count($value);



    // echo $value->count_sampling;

    // $sel = "SELECT COUNT(*) AS 'coun_sampling' FROM sada_form_contact WHERE kategori_id='".$value->count_sampling."' AND user_id='".$value->id_user."'";

    // $selects = $this->db->query("SELECT SUM(DISTINCT kategori_id) AS 'coun_sampling' FROM sada_form_contact WHERE kategori_id='".$value->count_sampling."' AND user_id='".$value->id_user."'")->row();

    // foreach ($selects->result() as $key => $valuew) {

    //     echo $valuew->coun_sampling;

    // }

    // echo $selects->coun_sampling;

    // echo $sel;

    // $result[] = [

    //     'Cabang','Nama BA','Status (Mobile / Stay)','Customer_id','Nama Store'

    //   ];

      // $this->excel->downloadtotalcontact(10,$value->nama_cabang);

    // echo $value->nama_cabang;

}

$this->excel->downloadtotalcontact(count($keys),$val_cabang);

  // echo count($keys);

}



public function reportPrm(){

  $this->load->library('excel');

  $arr['tl'] = $this->input->get("tl");

  $arr['ba'] = $this->input->get("ba");

  $arr['toko'] = $this->input->get("toko");

  $arr['cabang'] = $this->input->get("cabang");

  $arr['kota'] = $this->input->get("kota");

  $arr['startDate'] = date('Y-m-d H:i:s', strtotime($this->input->get("startDate")));

  $arr['endDate'] = date('Y-m-d H:i:s', strtotime($this->input->get("endDate")));



  $select = "SELECT DISTINCT sada_promo.tipe,sada_promo.jenis,sada_promo.keterangan,sada_promo.awalTanggal,sada_promo.selesaiTanggal,CAST(sada_promo.timestamp AS DATE) timestamp,

  (

  SELECT DISTINCT

  GROUP_CONCAT(prom.foto SEPARATOR ',')

  FROM

  sada_promo AS prom

  WHERE

  prom.merk LIKE '%romina%'

  AND prom.user_id = sada_user.id_user

  AND prom.store_id = toko.id_toko

  AND date(prom.timestamp) = date(sada_promo.timestamp)

  ) AS 'promina_foto',

  (

  SELECT DISTINCT

  GROUP_CONCAT(prom.foto SEPARATOR ',')

  FROM

  sada_promo AS prom

  WHERE

  prom.merk NOT LIKE '%romina%'

  AND prom.user_id = sada_user.id_user

  AND prom.store_id = toko.id_toko

  AND date(prom.timestamp) = date(sada_promo.timestamp)

  ) AS 'kompetitor_foto',

  (

  SELECT

  GROUP_CONCAT(prom.keterangan SEPARATOR ',')

  FROM

  sada_promo AS prom

  WHERE

  prom.merk  LIKE '%romina%'

  AND prom.user_id = sada_user.id_user

  AND prom.store_id = toko.id_toko

  AND date(prom.timestamp) = date(sada_promo.timestamp)

  ) AS 'keteranganPromina',

  (

  SELECT

  GROUP_CONCAT(prom.keterangan SEPARATOR ',')

  FROM

  sada_promo AS prom

  WHERE

  prom.merk NOT LIKE '%romina%'

  AND prom.user_id = sada_user.id_user

  AND prom.store_id = toko.id_toko

  AND date(prom.timestamp) = date(sada_promo.timestamp)

  ) AS 'keteranganKomptetitor',

  ";

  $select .= "toko.id_toko,

  toko.store_id,

  toko.id_kota,

  toko.nama AS 'nama_toko',

  sada_user.id_user AS 'id_user',

  sada_user.nama AS 'nama_user',

  sada_user.stay AS 'stay_user',

  (SELECT nama FROM sada_user WHERE id_user=tl.id_user) as 'nama_tl',
  ";



  $where = "";

  if ($arr['startDate'] != "1970-01-01" && $arr['endDate'] != "1970-01-01") {

    $where = "WHERE CAST(sada_promo.timestamp AS DATE) BETWEEN '".$arr['startDate']."' and '".$arr['endDate']."'";

    if ($arr['tl'] != 0) {

      $where .= " AND sada_user.id_user='".$arr['tl']."'";

    }

    if ($arr['ba'] != 0) {

      $where .= " AND sada_user.id_user='".$arr['ba']."'";

    }

  }

  else{

   if ($arr['tl'] != 0) {

    $where = " WHERE sada_user.id_user='".$arr['tl']."'";

  }

  if ($arr['ba'] != 0) {

    $where = " WHERE sada_user.id_user='".$arr['ba']."'";

  }

}

$join = "";

if ($arr['tl'] == 0) {

  if ($arr['ba'] !=0) {

    if ($arr['toko'] != 0) {

      $where .= " AND toko.id_toko='".$arr['toko']."'";

      if ($arr['cabang'] !=0) {

        if ($arr['kota'] !=0) {

          $where .= " AND cabang.id_cabang in (SELECT id_cabang FROM sada_kota WHERE id_cabang='".$arr['cabang']."')";

        }

        else{

          $where .= " AND cabang.id_cabang='".$arr['cabang']."'";

        }

      }

    }

    else{

      if ($arr['cabang'] != 0) {

       $where .= " AND cabang.id_cabang in (SELECT id_cabang FROM sada_kota WHERE id_cabang='".$arr['cabang']."')";

     }

   }

 }

}

else{

  if ($arr['ba']==0) {

    $select .= "";

  }

}



$join .= " LEFT JOIN sada_toko toko ON sada_promo.store_id=toko.id_toko";

$join .= " LEFT JOIN sada_kota kota ON toko.id_kota=kota.id_kota";

$join .= " LEFT JOIN sada_cabang cabang ON kota.id_cabang=cabang.id_cabang";

$join .= " LEFT JOIN sada_tl_in_kota tl ON kota.id_kota = tl.id_kota";




$select .= "

cabang.nama AS 'nama_cabang',

kota.nama_kota 'nama_kota'

FROM sada_promo LEFT JOIN sada_user ON sada_promo.user_id=sada_user.id_user ".$join." ".$where." ";



$data = $this->db->query($select);



foreach ($data->result() as $key => $value) {

  $datas[] = $value;

  $keys[] = $key;

  $val_cabang[] = $value;

}

$this->excel->downloadreportpromo(count($keys),$val_cabang);

}

public function excelReport()

{

      // Post filter

  $filterTl = ($this->input->get('tl') == "0") ? "" : $this->input->get('tl');

  $filterName = ($this->input->get('ba') == "0") ? "" : $this->input->get('ba');

  $filterToko = (null != $this->input->get('toko') && $this->input->get('toko') !=0) ? $this->input->get('toko') : "";

  $filterCabang = ($this->input->get('cabang') == "0") ? "" : $this->input->get('cabang');

  $filterKota = ($this->input->get('kota') == "0") ? "" : $this->input->get('kota');

  $startDate =  date('Y-m-d H:i:s', strtotime($this->input->get('startDate')));

  $endDate = date('Y-m-d H:i:s', strtotime($this->input->get('endDate')));





      // Query Result

  $skuFilter =[

  'baName' => $filterName,

  'tokoFilter' => $filterToko,

  'cabangFilter' => $filterCabang,

  'kotaFilter' => $filterKota,

  'startTime' => $startDate,

  'endTime' => $endDate

  ];

  $query = $this->sada->skuReportHeader($skuFilter);

  $result = [];

  $result [0]= [

  'no','cabang','kota','Nama Ba','Mobile/Stay','Store Id','Nama Store','Tanggal',

  'Akumulasi Box BC','Akumulasi Box BTI','Akumulasi Box Rusk','Akumulasi Box Pudding','Akumulasi Box Others',

  'Akumulasi Sachet BC','Akumulasi Sachet BTI','Akumulasi Sachet Rusk','Akumulasi Sachet Pudding','Akumulasi Sachet Others'

  ];

  $produk = $this->sada->getProdukAndCategory();

  foreach ($produk->result() as $value) {

    array_push($result[0],$value->kategoriNama.' '.$value->nama_produk.' Box');

    if($value->kategoriNama == 'BC' || $value->kategoriNama == 'BTI'){

      array_push($result[0],$value->kategoriNama.' '.$value->nama_produk.'Sachet');

    }

  }

  $count = 0;

  $arrayCount =1;

  foreach ($query->result() as  $value) {

    $countFilter =[

    'user_id' => $value->id_user,

    'toko_id' => $value->id_toko,

    'tanggal' => $value->tgl

    ];

    $queryCountBc = $this->sada->skuCount($countFilter,'BC','box');

    $queryCountBti = $this->sada->skuCount($countFilter,'BTI','box');

    $queryCountRusk = $this->sada->skuCount($countFilter,'Rusk','box');

    $queryCountPudding = $this->sada->skuCount($countFilter,'Pudding','box');

    $queryCountOthers = $this->sada->skuCount($countFilter,'Others','box');

    $queryCountBcsSachet = $this->sada->skuCount($countFilter,'BC','sachet');

    $queryCountBtiSachet = $this->sada->skuCount($countFilter,'BTI','sachet');

    $queryCountRuskSachet = $this->sada->skuCount($countFilter,'Rusk','sachet');

    $queryCountPuddingSachet = $this->sada->skuCount($countFilter,'Pudding','sachet');

    $queryCountOthersSachet = $this->sada->skuCount($countFilter,'Others','sachet');

    $result[$arrayCount] = [

    'no' => ($count+=1),

    'namaCabang' => $value->namaCabang,

    'nama_kota' => $value->nama_kota,

    'store_id' => $value->store_id,

    'namaToko' => $value->namaToko,

    'namaBa' => $value->namaBa,

    'stay_mobile' => $value->stay_mobile,

    'tgl' => $value->tgl,

    'qtyBc' => ($queryCountBc->row()->qty == null ) ? "0" :$queryCountBc->row()->qty ,

    'qtyBti' => ($queryCountBti->row()->qty == null )? "0" : $queryCountBti->row()->qty,

    'qtyRusk' => ($queryCountRusk->row()->qty == null) ? "0" : $queryCountRusk->row()->qty,

    'qtyPudding' => ($queryCountPudding->row()->qty == null) ? "0" : $queryCountPudding->row()->qty,

    'qtyOthers' => ($queryCountOthers->row()->qty == null) ? "0" : $queryCountOthers->row()->qty,

    'qtyBcSachet' => ($queryCountBcsSachet->row()->qty == null) ? "0" : $queryCountBcsSachet->row()->qty,

    'qtyBtiSachet' => ($queryCountBtiSachet->row()->qty == null) ? "0" : $queryCountBtiSachet->row()->qty,

    'qtyRuskSachet' => ($queryCountRuskSachet->row()->qty == null) ? "0" : $queryCountRuskSachet->row()->qty,

    'qtyPuddingSachet' => ($queryCountPuddingSachet->row()->qty == null) ? "0" : $queryCountPuddingSachet->row()->qty,

    'qtyOthersSachet' => ($queryCountOthersSachet->row()->qty == null) ? "0":$queryCountOthersSachet->row()->qty

    ];

    $produk = $this->sada->getProdukAndCategory();

    foreach ($produk->result() as $countDetails) {

      $produkDetails = $this->sada->skuDetails($countFilter['tanggal'],'box',$countDetails->id_produk);

      array_push($result[$arrayCount],($produkDetails->row()->qty == null ) ? "0" : $produkDetails->row()->qty );

      if($countDetails->kategoriNama == 'BC' || $countDetails->kategoriNama == 'BTI'){

        $produkSachet = $this->sada->skuDetails($countFilter['tanggal'],'sachet',$countDetails->id_produk);

        array_push($result[$arrayCount],($produkSachet->row()->qty == null ) ? "0" : $produkSachet->row()->qty );

      }

    }

    $arrayCount++;

  }

  $this->load->library('excel');

  $this->excel->downloadSkuReport($result);

}



public function getSkuHeader($value='')

{

  $filterHasilReport =($this->input->get('filter') == "0") ? "" : $this->input->get('filter');

  $result = [];

  if($filterHasilReport == "1"){

    $result [0]= [

    'cabang','kota','Store Id','Nama Store','Nama Ba','Mobile/Stay','Tanggal',

    'Akumulasi Box BC','Akumulasi Box BTI','Akumulasi Box Rusk','Akumulasi Box Pudding','Akumulasi Box Others'

    ];

  }else if($filterHasilReport == "2"){

    $result [0]= [

    'cabang','kota','Store Id','Nama Store','Nama Ba','Mobile/Stay','Tanggal',

    'Akumulasi Sachet BC','Akumulasi Sachet BTI'

    ];

  }else if($filterHasilReport == "3"){

    $result [0]= [

    'cabang','kota','Store Id','Nama Store','Nama Ba','Mobile/Stay','Tanggal'

    ];

    $produk = $this->sada->getProdukAndCategory();

    foreach ($produk->result() as $value){

      array_push($result[0],$value->kategoriNama.' '.$value->nama_produk.' Box');

      if($value->kategoriNama == 'BC' || $value->kategoriNama == 'BTI'){

        array_push($result[0],$value->kategoriNama.' '.$value->nama_produk.'Sachet');

      }

    }

  }else{

    $result [0]= [

    'cabang','kota','Store Id','Nama Store','Nama Ba','Mobile/Stay','Tanggal',

    'Akumulasi Box BC','Akumulasi Box BTI','Akumulasi Box Rusk','Akumulasi Box Pudding','Akumulasi Box Others',

    'Akumulasi Sachet BC','Akumulasi Sachet BTI'

    ];

    $produk = $this->sada->getProdukAndCategory();

    foreach ($produk->result() as $value){

      array_push($result[0],$value->kategoriNama.' '.$value->nama_produk.' Box');

      if($value->kategoriNama == 'BC' || $value->kategoriNama == 'BTI'){

        array_push($result[0],$value->kategoriNama.' '.$value->nama_produk.'Sachet');

      }

    }

  }

  echo json_encode($result[0], JSON_PRETTY_PRINT);

}



public function checkInputPhoneNumber()

{

  $response = [];

  $phoneNumber = htmlentities($this->input->get('phoneNumber'), ENT_QUOTES, 'utf-8');

  $month = htmlentities($this->input->get('month'), ENT_QUOTES, 'utf-8');

  $result = $this->sada->checkInputPhoneNumber($phoneNumber,$month);

  if($result == null){

    $response=['success' => true,'message' =>'ga ada data itu'];

  }else{

    $response = ['success' => false,'message' =>'Sudah pernah input nomor telp itu'];

  }

  echo json_encode($response, JSON_PRETTY_PRINT);

}



public function achievementSampling()

{

  $this->db->select(['(select count(store_id) from sada_form_contact where kategori_id = 1) storeBc',

    '(select sum(samplingQty) from sada_form_contact where kategori_id = 1)  samplingBc',

    "(select sum(samplingQty) from sada_form_contact where kategori_id = 1 and beli= 'Y')  strikeSamplingBc",

    '(select count(store_id) from sada_form_contact where kategori_id = 2) storeBTI',

    '(select sum(samplingQty) from sada_form_contact where kategori_id = 2)  samplingBTI',

    "(select sum(samplingQty) from sada_form_contact where kategori_id = 2 and beli= 'Y')  strikeSamplingBTI",

    '(select count(store_id) from sada_form_contact where kategori_id = 3) storeRusk',

    '(select sum(samplingQty) from sada_form_contact where kategori_id = 3)  samplingRusk',

    "(select sum(samplingQty) from sada_form_contact where kategori_id = 3 and beli= 'Y')  strikeSamplingRusk",

    '(select count(store_id) from sada_form_contact where kategori_id = 4) storePudding',

    '(select sum(samplingQty) from sada_form_contact where kategori_id = 4)  samplingPudding',

    "(select sum(samplingQty) from sada_form_contact where kategori_id = 4 and beli= 'Y')  strikeSamplingPudding",

    '(select count(store_id) from sada_form_contact where kategori_id = 5) storeOthers',

    '(select sum(samplingQty) from sada_form_contact where kategori_id = 5)  samplingOthers',

    "(select sum(samplingQty) from sada_form_contact where kategori_id = 5 and beli= 'Y')  strikeSamplingOthers",



    ])

  ->from('sada_form_contact')

  ->get()

  ->first_row();

}

    // End Report Related API



    // Dummy Testing



public function testing321()

{

      // TODO Pikirin cara ambil nama TL di kota tersebut

      // $query = $this->sada->skuReportHeader();

      // var_dump($query->result());



      // foreach ($query->result() as $value) {

      //     $id_kota = $value->id_kota;

      //     var_dump($value->id_user);

      //     $a = $this->sada->getTlNameInKota($id_kota,$value->id_user);

      //     var_dump($a->result());

      // }







      // $query = $this->sada->skuDetails('','box');

      // var_dump($query->result());



      //

  $query = $this->sada->skuCount(['startTime' => '2016-05-04 15:42:28', 'endTime' => '2016-05-11 15:42:28','tipe' => 'BC','user_id' => '']);

  var_dump($query->row());

}



public function testing123()

{

  $user_id = $this->input->get('id_user');

  $store_id = $this->input->get('store_id');



  $checkAssignedStore = $this->db->select('id_toko')->from('sada_tokoinuser')->where('id_user',$user_id)->get();

  $first = $checkAssignedStore->first_row();

      // var_dump($first);

  $explode = explode(",",$first->id_toko);

  $alllow = false;

  foreach ($explode as  $value) {

    if($store_id == $value){

      $alllow = true;

    }

  }

  if($alllow){

    echo " boleh";

  }else{

    echo 'ga boleh';

  }





  $input =3;

  $a = $this->db->select('id_toko')->from('sada_tokoinuser')->where('id_user',2)->get();

  $b = $a->first_row();

  $data = explode(",",$b->id_toko);

  foreach ($data as  $value) {

    if($input != $value){

      $restricted = true;

    }

  }

}

}

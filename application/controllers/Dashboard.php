<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard extends CI_Controller {

	public function __construct()

	{

		parent::__construct();

		// $this->akses->cek_akses();		
		// echo $datSession['id_user'];
		// echo $datSession['isLogin'];
		// echo $datSession['nama_user'];
		// echo $datSession['akses'];

		$this->load->library("Akses");

	}



	public function keluar()

	{

		$this->session->sess_destroy();

		redirect('','refresh');

	}

	public function home()

	{

		$dataDas['title'] = "Dashboard";

		$dataDas['desk'] = "App Retail";

		

		$dataDas['page'] = "achievement";

		$dataDas['reportAcv'] = $this->sada->acvNatReport();

		$dataDas['region'] = $this->db->get("sada_region");

		foreach ($dataDas['region']->result() as $key => $value) {

			$cab = $this->db->get_where("sada_cabang",array('id_region'=>$value->id_region));

			foreach ($cab->result() as $vcabang) {

				$dataDas['achievements'] = $this->sada->CountAchievement($vcabang->id_cabang);

			}

		}

		// $dataDas['sampling'] = $this->sada->achievementSamplingReport();

		$this->load->view('view_awal', $dataDas, FALSE);



	}

    public function achievment()
	{
		$dataDas['title'] = "Dashboard";

		$dataDas['desk'] = "App Retail";

		

		$dataDas['page'] = "filter_achievment";

		$dataDas['reportAcv'] = $this->sada->acvNatReport();

		$dataDas['region'] = $this->db->get("sada_region");

		foreach ($dataDas['region']->result() as $key => $value) {

			$cab = $this->db->get_where("sada_cabang",array('id_region'=>$value->id_region));

			foreach ($cab->result() as $vcabang) {

				$dataDas['achievements'] = $this->sada->CountAchievement($vcabang->id_cabang);

			}

		}

		// $dataDas['sampling'] = $this->sada->achievementSamplingReport();

		$this->load->view('view_awal', $dataDas, FALSE);
	}
    
	public function keterangan_oos()
	{
		

		if ($this->input->post()) {

			$this->load->model('datatable');

		// if ($this->input->post()) {

			$table 	= "sada_desc_oos";

			$column = array('id_desc','desc');

			$odb 	= array("id_desc"=>"asc");

			$list 	= $this->datatable->get_datatables($table,$column,$odb);

			$data 	= array();

			$no 	= 1;

			foreach ($list as $datatable) {

				$row 		= array();

				$row[] 		= $no++;

				$row[] 		= $datatable->desc;

				if ($this->session->userdata("akses")=="3") {

					$row[] = "";

				}

				else{

					$row[] 		= '<div class="btn-group" >

					<button  class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions

						<i class="fa fa-angle-down"></i>

					</button>

					<ul class="dropdown-menu" role="menu">

						<li>

							'.anchor('keterangan/form_keterangan/'.$datatable->id_desc, '<i class="icon-pencil"></i>Edit', 'attributes').'

						</li>

						<li>

							'.anchor('keterangan/form_keterangan/delete/'.$datatable->id_desc, '<i class="icon-trash"></i>Delete', 'onclick = "if (! confirm(\'Apakah Anda Yakin Untuk Menghapus '.$datatable->desc.'? Data Yang Sudah Di Hapus Tidak Bisa Di Kembalikan\')) { return false; }"').'

						</li>

					</ul>

				</div>';

			}

			$data[] = $row;

		}



		$output = array(

			"draw" => $_POST['draw'],

			"recordsTotal" => $this->datatable->count_all($table,$column,$odb),

			"recordsFiltered" => $this->datatable->count_filtered($table,$column,$odb),

			"data" => $data,

			);

		echo json_encode($output);

	} else {

		$dataDas['title'] = "Keterangan OOS";

		$dataDas['desk'] = "Keterangan OOS";

		$dataDas['page'] = "keterangan/keterangan_oos";

		$dataDas['css'] = $this->sada->CssdataTable();

		$dataDas['js']	= $this->sada->JsdataTable();

		$dataDas['css'][]  	= "assets/global/plugins/select2/css/select2-bootstrap.min.css";

		$dataDas['css'][]	= "assets/global/plugins/select2/css/select2.min.css";



		$dataDas['js'][]	= "assets/pages/scripts/components-select2.min.js";



		    // $dataDas['js'][] ="assets/custom/select2Filter.js";

		$dataDas['js'][]	= "assets/custom/keterangan_oos.js";

		$dataDas['js'][]	= "assets/global/plugins/select2/js/select2.full.min.js";



	    	// $this->db->order_by("id_kota","asc");


		$this->load->view('view_awal', $dataDas, FALSE);

	}
}
public function updatetargetToko()
{
	$id_target = $this->input->post("id_target");
	$target = $this->input->post("target");

	$zql = $this->db->query("UPDATE sada_target SET target = '$target' where id_target = $id_target");
	if ($zql) {
		$data = array('status' =>'Berhasil Update' , 'code'=>1);
	}
	else{
	
		$data = array('status' =>'Gagal Update' , 'code'=>0);
	}
	echo json_encode($data);
}
public function kategori_segmen()
{
	if ($this->input->post()) {

		foreach ($this->input->post() as $key => $value) {
			$field = strip_tags(trim($key));
			$val = $value;
			$rep = array("Rp ",".","_");

			$replace = str_replace($rep, "", $val);
			$exp = explode(':', $field);
			$id_kat = $exp[1];
			$field = $exp[0];

			print_r($replace);
			if (!empty(id_kat) && !empty($field) && !empty($value)) {
				$this->db->query("UPDATE sada_kategori SET $field = '$replace' WHERE id = $id_kat");
				echo "Success Updated";
			}
			else{
				echo "Gagal";
			}

		}


	} else {

		$dataDas['title'] = "Kategori Segmen";

		$dataDas['desk'] = "Kategori Segmen";

		$dataDas['page'] = "keterangan/kategori_segmen";

		$dataDas['css'] = $this->sada->CssdataTable();

		$dataDas['js']	= $this->sada->JsdataTable();

		$dataDas['css'][]  	= "assets/global/plugins/select2/css/select2-bootstrap.min.css";

		$dataDas['css'][]	= "assets/global/plugins/select2/css/select2.min.css";



		$dataDas['js'][]	= "assets/pages/scripts/components-select2.min.js";



		    // $dataDas['js'][] ="assets/custom/select2Filter.js";

		$dataDas['js'][]	= "assets/custom/kategori_segmen.js";

		$dataDas['js'][]	= "assets/global/plugins/select2/js/select2.full.min.js";

		$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.js";	
		$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.extensions.js";	
		$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.numeric.extensions.js";	
		$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.phone.extensions.js";	
		$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.regex.extensions.js";	
		$dataDas['js'][]  = "assets/pages/scripts/decimal/jquery.inputmask.js";	

		$dataDas['js'][]  = "assets/global/scripts/app.min.js";

		$dataDas['js'][] ="assets/custom/price.js";

	    	// $this->db->order_by("id_kota","asc");


		$this->load->view('view_awal', $dataDas, FALSE);


	}
}
public function template_email()
{

	$this->load->view('template_email');
}
public function form_keterangan()
{
	$id = $this->uri->segment(3);
	if ($this->input->post()) {
		$id_desc = $this->input->post("id_desc");
		$data['desc'] = $this->input->post("keterangan");

		if ($id_desc == null) {
			$this->db->insert("sada_desc_oos",$data);
			$this->session->set_flashdata('msg','Data Success Added');
		}
		else {
			$this->db->update("sada_desc_oos",$data,array('id_desc'=>$id_desc));
			$this->session->set_flashdata('msg','Data Success Updated');
		}
		redirect('Dashboard/keterangan_oos');
	}
	else {
		if ($id) {
			$dataDas['edit_desc'] = $this->db->select('id_desc,desc')->where('id_desc',$id)->get('sada_desc_oos')->row();

			$dataDas['id_desc'] = $dataDas['edit_desc']->id_desc;
			$dataDas['desc'] = $dataDas['edit_desc']->desc;
		}
		else{
			$dataDas['id_desc'] = "";
			$dataDas['desc'] = "";
		}
		if ($id == "delete") {
			$id_delete = $this->uri->segment(4);

			$this->db->delete("sada_desc_oos",array('id_desc'=>$id_delete));

			$this->session->set_flashdata('msg','Data Success deleted');
			redirect('Dashboard/keterangan_oos');
		}
		
		$dataDas['title'] = "Form Keterangan";

		$dataDas['desk'] = "";

		$dataDas['page'] = "keterangan/form_keterangan";

		$dataDas['js'][]  = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";

		$dataDas['js'][]  = "assets/global/scripts/app.min.js";
		
		$dataDas['js'][] ="assets/custom/form_keterangan.js";

		$this->load->view('view_awal', $dataDas, FALSE);
	}
}

public function achievement()

{

	$dataDas['title'] = "Achievement Report";

	$dataDas['desk'] = "Achievement Report";

	$dataDas['page'] = "achievement";

	$dataDas['sampling'] = $this->sada->achievementSamplingReport();

	$this->load->view('view_awal', $dataDas, FALSE);



}

public function reportTopSKu()
{
	if ($this->input->post()) {
		$date = array('startDate' => date('Y-m-d H:i:s', strtotime($this->input->post('startDate')." 00:00:00")),
			'endDate' => date('Y-m-d H:i:s', strtotime($this->input->post('endDate')." 23:59:59")));

		$monthAgo = new DateTime($date['startDate']);
		$monthAgo->modify('-1 month');
		$monthAgoEnd = new DateTime($date['endDate']);
		$monthAgoEnd->modify('-1 month');
		$startDateMonthAgo = $monthAgo->format('Y-m-d H:i:s');
		$endDateMonthAgo = $monthAgoEnd->format('Y-m-d H:i:s');

		$data = $this->sada->getTopSku($date['startDate'],$date['endDate'],$startDateMonthAgo,$endDateMonthAgo);

		echo json_encode($data,JSON_PRETTY_PRINT);
	}
	else{
		$dataDas['title'] = "Top Sku Report";
		$dataDas['desk'] = "App Retail";
		$dataDas['page'] = "report/topSKus";
		$dataDas['js'][] = "assets/global/plugins/bootstrap/js/bootstrap.min.js";
		$dataDas['js'][] = "assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js";
		$dataDas['js'][] = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";

		$dataDas['js'][] = "assets/global/scripts/app.min.js";
		$dataDas['js'][] = "assets/pages/scripts/form-validation.min.js";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css";
		$dataDas['css'][] = "assets/global/plugins/select2/css/select2-bootstrap.min.css";
		$dataDas['css'][] = "assets/global/plugins/select2/css/select2.min.css";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css";
		$dataDas['css'][] = "assets/global/plugins/datatables/datatables.min.css";
		$dataDas['css'][] = "assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css";
		$dataDas['js'][] = "assets/global/scripts/datatable.js";
		$dataDas['js'][] = "assets/global/plugins/datatables/datatables.min.js";
		$dataDas['js'][] = "assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js";
		$dataDas['js'][] = "assets/pages/scripts/table-datatables-managed.min.js";
		$dataDas['js'][] = "assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js";
		$dataDas['js'][] = "assets/pages/scripts/components-bootstrap-select.min.js";
		$dataDas['js'][] = "assets/custom/tagSelection.js";
		$dataDas['js'][] = "assets/custom/tagDate.js";
		$dataDas['js'][] = "assets/pages/scripts/components-select2.min.js";
		$dataDas['js'][] = "assets/global/plugins/select2/js/select2.full.min.js";
		$dataDas['js'][] = "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js";
		$dataDas['js'][] = "assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js";
		$dataDas['js'][] = "assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js";
		$dataDas['js'][] = "assets/pages/scripts/components-date-time-pickers.min.js";
		$dataDas['js'][] = "assets/custom/topStockFilter.js";
		$this->load->view('view_awal', $dataDas, FALSE);
	}
}

public function reportTopBA()
{
	if ($this->input->post()) {
		$date = array('startDate' => date('Y-m-d H:i:s', strtotime($this->input->post('startDate')." 00:00:00")),
			'endDate' => date('Y-m-d H:i:s', strtotime($this->input->post('endDate')." 23:59:59")));

		$monthAgo = new DateTime($date['startDate']);
		$monthAgo->modify('-1 month');
		$monthAgoEnd = new DateTime($date['endDate']);
		$monthAgoEnd->modify('-1 month');
		$startDateMonthAgo = $monthAgo->format('Y-m-d H:i:s');
		$endDateMonthAgo = $monthAgoEnd->format('Y-m-d H:i:s');

		$data = $this->sada->getTopBA($date['startDate'],$date['endDate'],$startDateMonthAgo,$endDateMonthAgo);

		echo json_encode($data,JSON_PRETTY_PRINT);
	}
	else{
		$dataDas['title'] = "Top BA Report";
		$dataDas['desk'] = "App Retail";
		$dataDas['page'] = "report/topBA";

		$dataDas['css'] = $this->sada->CssdataTable();

		$dataDas['js']	= $this->sada->JsdataTable();

		$dataDas['js'][] = "assets/global/plugins/bootstrap/js/bootstrap.min.js";
		$dataDas['js'][] = "assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js";
		$dataDas['js'][] = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";

		$dataDas['js'][] = "assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js";
		$dataDas['js'][] = "assets/global/scripts/app.min.js";
		$dataDas['js'][] = "assets/pages/scripts/form-validation.min.js";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css";
		$dataDas['css'][] = "assets/global/plugins/select2/css/select2-bootstrap.min.css";
		$dataDas['css'][] = "assets/global/plugins/select2/css/select2.min.css";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css";

		$dataDas['js'][] = "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js";
		$dataDas['js'][] = "assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js";
		$dataDas['js'][] = "assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js";
		$dataDas['js'][] = "assets/pages/scripts/components-date-time-pickers.min.js";


		$dataDas['js'][] = "assets/pages/scripts/components-bootstrap-switch.min.js";

		$dataDas['js'][] = "assets/custom/topBA.js";

		$this->load->view('view_awal', $dataDas, FALSE);
	}
}
/*USER MANAJEMEN*/

public function reportTopCabang()
{
	if ($this->input->post()) {
		$date = array('startDate' => date('Y-m-d H:i:s', strtotime($this->input->post('startDate')." 00:00:00")),
			'endDate' => date('Y-m-d H:i:s', strtotime($this->input->post('endDate')." 23:59:59")));

		$monthAgo = new DateTime($date['startDate']);
		$monthAgo->modify('-1 month');
		$monthAgoEnd = new DateTime($date['endDate']);
		$monthAgoEnd->modify('-1 month');
		$startDateMonthAgo = $monthAgo->format('Y-m-d H:i:s');
		$endDateMonthAgo = $monthAgoEnd->format('Y-m-d H:i:s');

		$data = $this->sada->getTopCabang($date['startDate'],$date['endDate'],$startDateMonthAgo,$endDateMonthAgo);

		echo json_encode($data,JSON_PRETTY_PRINT);
	}
	else{
		$dataDas['title'] = "Top Cabang Report";
		$dataDas['desk'] = "App Retail";
		$dataDas['page'] = "report/topCabang";

		$dataDas['js'][] = "assets/global/plugins/bootstrap/js/bootstrap.min.js";
		$dataDas['js'][] = "assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js";
		$dataDas['js'][] = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";

		$dataDas['js'][] = "assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js";
		$dataDas['js'][] = "assets/global/scripts/app.min.js";
		$dataDas['js'][] = "assets/pages/scripts/form-validation.min.js";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css";
		$dataDas['css'][] = "assets/global/plugins/select2/css/select2-bootstrap.min.css";
		$dataDas['css'][] = "assets/global/plugins/select2/css/select2.min.css";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css";

		$dataDas['js'][] = "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js";
		$dataDas['js'][] = "assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js";
		$dataDas['js'][] = "assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js";
		$dataDas['js'][] = "assets/pages/scripts/components-date-time-pickers.min.js";


		$dataDas['js'][] = "assets/pages/scripts/components-bootstrap-switch.min.js";

		$dataDas['js'][] = "assets/custom/topCabang.js";

		$this->load->view('view_awal', $dataDas, FALSE);
	}
}

public function reportTopAccount()
{
	if ($this->input->post()) {
		$date = array('startDate' => date('Y-m-d H:i:s', strtotime($this->input->post('startDate')." 00:00:00")),
			'endDate' => date('Y-m-d H:i:s', strtotime($this->input->post('endDate')." 23:59:59")));

		$monthAgo = new DateTime($date['startDate']);
		$monthAgo->modify('-1 month');
		$monthAgoEnd = new DateTime($date['endDate']);
		$monthAgoEnd->modify('-1 month');
		$startDateMonthAgo = $monthAgo->format('Y-m-d H:i:s');
		$endDateMonthAgo = $monthAgoEnd->format('Y-m-d H:i:s');

		$data = $this->sada->getTopAccount($date['startDate'],$date['endDate'],$startDateMonthAgo,$endDateMonthAgo);

		echo json_encode($data);
	}
	else {
		$dataDas['title'] = "Top Account Report";
		$dataDas['desk'] = "App Retail";
		$dataDas['page'] = "report/topAccount";

		$dataDas['js'][] = "assets/global/plugins/bootstrap/js/bootstrap.min.js";
		$dataDas['js'][] = "assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js";
		$dataDas['js'][] = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";

		$dataDas['js'][] = "assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js";
		$dataDas['js'][] = "assets/global/scripts/app.min.js";
		$dataDas['js'][] = "assets/pages/scripts/form-validation.min.js";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css";
		$dataDas['css'][] = "assets/global/plugins/select2/css/select2-bootstrap.min.css";
		$dataDas['css'][] = "assets/global/plugins/select2/css/select2.min.css";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css";

		$dataDas['js'][] = "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js";
		$dataDas['js'][] = "assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js";
		$dataDas['js'][] = "assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js";
		$dataDas['js'][] = "assets/pages/scripts/components-date-time-pickers.min.js";


		$dataDas['js'][] = "assets/pages/scripts/components-bootstrap-switch.min.js";

		$dataDas['js'][] = "assets/custom/topAccount.js";

		$this->load->view('view_awal', $dataDas, FALSE);
	}
}

public function dataUser()

{

	if ($this->input->post()) {

		$this->load->model('datatable');

		// if ($this->input->post()) {

		$table = "sada_user";

		$column = array('nik','nama','akses');

		$odb = array("id_user"=>"desc");

		$q = "";
		if ($_POST['search']['value']) {
			$q .= "";
		}
		else{
			$q .= " WHERE status = 'Y'";
		}

		$list = $this->datatable->get_datatables_users($table.$q,$column,$odb);

		$data = array();

		$no = $_POST['start'];

		foreach ($list as $datatable) {

			$no++;

			$row = array();

			$row[] = $datatable->nik;

			$row[] = $datatable->nama;

			if ($datatable->stay == "Y") {

				$stay = "Stay";

				$x="";

			} elseif ($datatable->stay == "N") {

				$stay = "Mobile";

			}else {

				$stay = "??";

				$x="";

			}

			if ($datatable->akses == 0) {

				$row[] = '<center><span class="label label-sm label-success"> TL </span>&nbsp;<a  class="label label-sm label-danger" id="showToko" href="#page'.$datatable->id_user.'"><small>Show Toko</small></a></center>';

			}elseif ($datatable->akses == 1) {

				$row[] = '<center><span class="label label-sm label-info"> SPG ( '. $stay.' )</span> <a  class="label label-sm label-danger" id="showToko" href="#page'.$datatable->id_user.'"><small>Show Toko</small></a></center>';

			}

			elseif ($datatable->akses == 2) {

				$row[] = '<center><span class="label label-sm label-primary"> Admin </span></center>';

			}

			elseif ($datatable->akses == 3) {

				$row[] = '<center><span class="label label-sm label-danger"> Indofood</span></center>';

			}
			else{

				$row[] = '<center><span class="label label-sm label-danger"> KAS</span></center>';

			}





			if ($this->session->userdata("akses")=="3") {

				$row[] = '';

			}

			else{

				$row[] = '<div class="btn-group" >

				<button  class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions

					<i class="fa fa-angle-down"></i>

				</button>

				<ul class="dropdown-menu" role="menu">

					<li>

						'.anchor('users/edit/'.$datatable->id_user, '<i class="icon-pencil"></i>Edit', 'attributes').'

					</li>

					<li>

						'.anchor('users/delete/'.$datatable->id_user, '<i class="icon-trash"></i>Delete', 'onclick = "if (! confirm(\'Apakah Anda Yakin Untuk Menghapus '.$datatable->nama.'?\')) { return false; }"').'

					</li>

				</ul>

			</div>';



		}

		$data[] = $row;

	}



	$output = array(

		"draw" => $_POST['draw'],

		"recordsTotal" => $this->datatable->count_all($table,$column,$odb),

		"recordsFiltered" => $this->datatable->count_filtered($table,$column,$odb),

		"data" => $data,

		);

			//output to json format

	echo json_encode($output);

} else {

	$dataDas['title'] = "Data User";

	$dataDas['desk'] = "App Retail";

	$dataDas['page'] = "users/data";



	$dataDas['css'] = $this->sada->CssdataTable();

	$dataDas['js']	= $this->sada->JsdataTable();



	$dataDas['js'][]	= "assets/custom/DataUsers.js";



	$this->db->order_by("status","desc");

	$dataDas['query'] = $this->sada->getUser();

	$this->load->view('view_awal', $dataDas, FALSE);

}



}

public function deleteDataUser()

{

	$idParam = $this->uri->segment(3);

	$data['status'] = "N";



	if ($this->sada->deletUser($idParam,$data)) {

		$this->session->set_flashdata('msg', 'User deleted');

		redirect('Dashboard/dataUser', 'refresh');

	}

}
public function dataAccount()
{
	if ($this->input->post()) {

		$this->load->model('datatable');

		// if ($this->input->post()) {

		$table = "sada_account";

		$column = array('id_account','id_toko','nama_account','target');

		$odb = array("id_account"=>"desc");

		$list = $this->datatable->get_datatables($table,$column,$odb);

		$data = array();

		$no = 1;

		foreach ($list as $datatable) {

			$row = array();

			$row[] = $no++;


			$row[] = $datatable->nama_account;
			// $row[] = $datatable->target."%";
			$row[] = '<a  class="label label-sm label-danger" id="showTokoAccount" href="#page'.$datatable->id_account.'"><small>Show Toko Account</small></a>';
			if ($this->session->userdata("akses")=="3") {

				$row[] = "";

			}
			else{
				$row[] = '<div class="btn-group" >

				<button  class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions

					<i class="fa fa-angle-down"></i>

				</button>

				<ul class="dropdown-menu" role="menu">

					<li>

						'.anchor('account/edit/'.$datatable->id_account, '<i class="icon-pencil"></i>Edit', 'attributes').'

					</li>

					<li>

						'.anchor('account/delete/'.$datatable->id_account, '<i class="icon-trash"></i>Delete', 'onclick = "if (! confirm(\'Apakah Anda Yakin Untuk Menghapus '.$datatable->nama_account.'?\')) { return false; }"').'

					</li>

				</ul>

			</div>';



		}
		$data[] = $row;
	}

	$output = array(

		"draw" => $_POST['draw'],

		"recordsTotal" => $this->datatable->count_all($table,$column,$odb),

		"recordsFiltered" => $this->datatable->count_filtered($table,$column,$odb),

		"data" => $data,

		);

	echo json_encode($output);
}
else{

	$dataDas['title'] = "Data Account";

	$dataDas['desk'] = "App Retail";

	$dataDas['page'] = "account/data_account";



	$dataDas['css'] = $this->sada->CssdataTable();

	$dataDas['js']	= $this->sada->JsdataTable();



	$dataDas['js'][]	= "assets/custom/DataAccount.js";

	$this->db->order_by("status","desc");

	$dataDas['query'] = $this->sada->getUser();

	$this->load->view('view_awal', $dataDas, FALSE);

}
}
public function EditdataAccount()
{
	$dataDas['paramId'] = $this->uri->segment(3);
	if ($this->input->post()) {
		$id_account = $this->input->post("id_account");
		$id_toko =  $this->input->post("toko");
		foreach ($id_toko as $id_tok) {
			$id[] = $id_tok;
		}
		$add['id_toko'] = implode(',', $id);
		$add['nama_account'] = $this->input->post("nama_account");
		// $add['target'] = $this->input->post("target");
		
		if ($this->db->update("sada_account",$add,array('id_account'=>$id_account))) {
			if ($this->db->delete("sada_account_temp",array('id_account'=>$id_account))) {
				$ins_temp['id_account'] = $this->input->post("id_account");
				foreach ($id_toko as $key => $value) {
					$ins_temp['id_toko'] = $value;
					$ins_temp['nama_account'] = $this->input->post("nama_account");
					// $ins_temp['target'] = $this->input->post("target");
					$this->db->insert("sada_account_temp",$ins_temp);
				}
			}
			$this->session->set_flashdata('msg', 'Account added');
			redirect('Dashboard/dataAccount', 'refresh');
		}
	}
	else{
		$dataDas['title'] = "Edit Data Account";

		$dataDas['desk'] = "App Retail";

		$dataDas['page'] = "account/edit_account";

		$qry = $this->db->select('id_account,id_toko,nama_account,target')->where('id_account',$dataDas['paramId'])->get('sada_account')->row();

		$dataDas['id_toko'] = explode(",", $qry->id_toko);

		$dataDas['nama_account'] = $qry->nama_account;

		$dataDas['target'] = $qry->target;

		$dataDas['id_account'] = $qry->id_account;

		$dataDas['query_toko'] = $this->db->get_where('sada_toko',array('status'=>"Y"))->result();

		$dataDas['css'][]  	= "assets/global/plugins/select2/css/select2-bootstrap.min.css";

		$dataDas['css'][]	= "assets/global/plugins/select2/css/select2.min.css";

		$dataDas['js'][]  = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";



		$dataDas['js'][]  = "assets/global/scripts/app.min.js";

		$dataDas['js'][] ="assets/custom/DataAccount.js";

		$dataDas['js'][] ="assets/custom/select2Filter.js";

		// $dataDas['js'][]	= "assets/pages/scripts/components-select2.min.js";

		$dataDas['js'][]	= "assets/global/plugins/select2/js/select2.full.min.js";



		$dataDas['js'][]  = "assets/pages/scripts/form-validation.min.js";

		$this->load->view('view_awal', $dataDas, FALSE);
	}
}
public function DeleteAccount()
{
	$id = $this->uri->segment(3);
	$this->sada->deleteAccount($id);
	$this->db->where("id_account",$id);
	$this->db->delete("sada_account_temp");
	$this->session->set_flashdata('msg', 'Account deleted');
	redirect('Dashboard/dataAccount', 'refresh');
}
public function getTokoAccount()
{
	if ($this->input->post()) {
		$id = $this->input->post('id');

		$select = $this->db->select("id_toko")->where("id_account",$id)->get("sada_account")->row();

		$exp = explode(",", $select->id_toko);

		foreach ($exp as $exps) {
			$toko = $this->db->select("store_id,nama,id_toko")->where("id_toko",$exps)->get("sada_toko");

			foreach ($toko->result() as $key => $val_toko) {
				$arrayName['store_id'] = $val_toko->store_id;
				$arrayName['nama'] = $val_toko->nama;
				$arrayName['id_toko'] = $val_toko->id_toko;

				$data[] = $arrayName;
			}
		}
		echo json_encode($data,JSON_PRETTY_PRINT);
	}
}
public function AdddataAccount()
{
	
	$dataDas['title'] = "Add Data Account";

	$dataDas['desk'] = "App Retail";

	$dataDas['page'] = "account/add_account";

	$acc = $this->db->select("id_toko")->get("sada_account");

	if ($acc->num_rows() == 0) {
		$sd_tok = $this->db->query("SELECT id_toko,nama from sada_toko")->result();

		foreach ($sd_tok as $toks) {
			$data[] = $toks;
		}
	}
	else {
		foreach ($acc->result() as $accs) {
			$toko = explode(',', $accs->id_toko);
			foreach ($toko as $id_toko) {
				$id_tok[] = $id_toko;
			}
		}

		$sd_tok = $this->db->query("SELECT id_toko,nama from sada_toko WHERE id_toko NOT IN ('".implode($id_tok, "', '")."')")->result();

		foreach ($sd_tok as $toks) {
			$data[] = $toks;
		}
	}

	$dataDas['query_toko'] = $data;
	$dataDas['css'][]  	= "assets/global/plugins/select2/css/select2-bootstrap.min.css";

	$dataDas['css'][]	= "assets/global/plugins/select2/css/select2.min.css";

	$dataDas['js'][]  = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";



	$dataDas['js'][]  = "assets/global/scripts/app.min.js";

	$dataDas['js'][] ="assets/custom/DataAccount.js";

	$dataDas['js'][] ="assets/custom/select2Filter.js";

		// $dataDas['js'][]	= "assets/pages/scripts/components-select2.min.js";

	$dataDas['js'][]	= "assets/global/plugins/select2/js/select2.full.min.js";



	$dataDas['js'][]  = "assets/pages/scripts/form-validation.min.js";

	$this->load->view('view_awal', $dataDas, FALSE);
}
public function insertAccount()
{
	if ($this->input->post()) {
		$this->load->library('form_validation');
		$id_toko =  $this->input->post("toko");
		foreach ($id_toko as $id_tok) {
			$id[] = $id_tok;
		}
		$add['id_toko'] = implode(',', $id);
		$add['nama_account'] = $this->input->post("nama_account");
		// $add['target'] = $this->input->post("target");
		
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

		// $this->form_validation->set_rules('target', 'Target', 'required');

		$this->form_validation->set_rules('nama_account', 'Nama Account', 'required');
		if ($this->form_validation->run() == FALSE)

		{
			$this->AdddataAccount();
		}

		else{
			if ($this->db->insert("sada_account",$add)) {
				$id_last = $this->db->insert_id();
				foreach ($id as $tok) {
					$add_temp['id_account'] = $id_last;

					$add_temp['id_toko'] = $tok;

					$add_temp['nama_account'] = $this->input->post("nama_account");

					// $add_temp['target'] = $this->input->post("target");

					$this->db->insert("sada_account_temp",$add_temp);
				}

				$this->session->set_flashdata('msg', 'Account added');

				redirect('Dashboard/dataAccount', 'refresh');

			}
		}
	}
	else{
	}
}
public function getTokoo()

{

	if ($this->input->post()) {

		$id = $this->input->post("id");

		$select = $this->db->select("id_toko")->where("id_user",$id)->get("sada_tokoinuser")->row();

		if (count($select)>0) { //Toko Ba in_user
			
			$exp = explode(",", $select->id_toko);

			foreach ($exp as $key => $value) {

				$toko = $this->db->select("store_id,nama,id_toko")->where("id_toko",$value)->get("sada_toko");

				foreach ($toko->result() as $key => $val_toko) {
				// $arrayName = array('id_user' => $id , 'store_id' => $val_toko->store_id, 'nama' => $val_toko->nama , 'id_toko' => $val_toko->id_toko);
					$arrayName['id_user'] = $id;
					$arrayName['store_id'] = $val_toko->store_id;
					$arrayName['nama'] = $val_toko->nama;
					$arrayName['id_toko'] = $val_toko->id_toko;

				// $target_user = "SELECT * FROM sada_target_user WHERE id_toko='".$val_toko->id_toko."' AND id_user='".$id."'";

					$target_user = $this->db->select("id_target_user,target")->where(array("id_toko"=>$val_toko->id_toko,"id_user"=>$id))->get("sada_target_user")->row();

				// foreach ($target_user->result() as $key => $user_target) {
				// $arrayName['target'] = $target_user->target;

				// $arrayName['id_target_user'] = $target_user->id_target_user;
				// }
				// echo $target_user;
					$data[] = $arrayName;

				}

			}
		}
		else{
			$tl = $this->db->get_where('sada_tl_in_kota',array("id_user"=>$id));

			foreach ($tl->result() as $toko_tl) {
				$toko = $this->db->select("store_id,nama,id_toko")->where("id_toko",$toko_tl->id_toko)->get("sada_toko");
				foreach ($toko->result() as $key => $val_toko) {
					$arrayName['id_user'] = $id;
					$arrayName['store_id'] = $val_toko->store_id;
					$arrayName['nama'] = $val_toko->nama;
					$arrayName['id_toko'] = $val_toko->id_toko;

					$data[] = $arrayName;
				}
			}
		}

		echo json_encode($data,JSON_PRETTY_PRINT);

	} else {

		show_404();

	}



}
public function TargetUser()
{

	$update["id_user"] =  htmlentities($this->input->post("id_user",TRUE), ENT_QUOTES, 'utf-8');

	$update["id_toko"] =  htmlentities($this->input->post("id_toko",TRUE), ENT_QUOTES, 'utf-8');

	$update["target"] =  htmlentities($this->input->post("target",TRUE), ENT_QUOTES, 'utf-8');

	$updates["id_target"] =  htmlentities($this->input->post("id_target",TRUE), ENT_QUOTES, 'utf-8');

	$uri_segment = array('id1' => $this->uri->segment(3),
		'id2' => $this->uri->segment(4),
		'id3' => $this->uri->segment(5),
		'id4' => $this->uri->segment(6));


	if ($this->input->post()) {
		if ($updates["id_target"] == null) {

			$this->db->insert("sada_target_user",$update);
			$this->session->set_flashdata('msg', 'Data has been added');

		}
		else{

			$this->db->where("id_target_user",$updates["id_target"]);
			$this->db->update("sada_target_user",$update);
			$this->session->set_flashdata('msg', 'Data has been updated');

		}


		redirect('Dashboard/dataUser', 'refresh');

	}
	else{
		$dataDas['title'] = "Data Target User";

		$dataDas['desk'] = "App Retail";

		$dataDas['page'] = "users/user_target";



		$dataDas['css'] = $this->sada->CssdataTable();

		$dataDas['js']	= $this->sada->JsdataTable();



		$dataDas['js'][]	= "assets/custom/DataUsers.js";



		$this->db->order_by("status","desc");

		$dataDas['query_user_target'] = $this->db->select("id_user,nama as nama_user")->where('id_user',$uri_segment['id1'])->get('sada_user')->row();

		$dataDas['query_toko_target'] = $this->db->select("id_toko,nama as nama_toko")->where('id_toko',$uri_segment['id2'])->get('sada_toko')->row();
		if ($uri_segment['id3']=='null' && $uri_segment['id4']=='null') {

			$dataDas['target'] = "";
			$dataDas['id_target'] = "";

		}
		else{

			$dataDas['target'] = $uri_segment['id3'];
			$dataDas['id_target'] = $uri_segment['id4'];

		}

		$this->load->view('view_awal', $dataDas, FALSE);
	}
}

public function getTargetToko()

{

	if ($this->input->post()) {

		$id = $this->input->post("id");

		$toko = $this->db->select(['k.nama','t.target','t.id_target'])

		->from('sada_target t')

		->join('sada_kategori k','k.id = t.id_kategori','inner')

		->where('t.id_toko', $id)

		->get();

		foreach ($toko->result() as $key => $val_toko) {

			$data[] = $val_toko;

		}

		echo json_encode($data,JSON_PRETTY_PRINT);

	} else {

		show_404();

	}

}

public function AdddataUser()

{

	$this->load->library('form_validation');

		// $zz = array();

	if ($this->input->post()) {

		$dataInsert["nik"] =  htmlentities($this->input->post("nik",TRUE), ENT_QUOTES, 'utf-8');

		$dataInsert["nama"] =  htmlentities($this->input->post("nama",TRUE), ENT_QUOTES, 'utf-8');

		$password =  htmlentities(md5($this->input->post("password",TRUE)), ENT_QUOTES, 'utf-8');

		if ($this->input->post("password",TRUE) == '') {

			$dataInsert['password'] = md5("1234");

		}

		else{

			$dataInsert['password'] = $password;

		}

		$dataInsert["akses"] =  htmlentities($this->input->post("akses",TRUE), ENT_QUOTES, 'utf-8');

		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

		$this->form_validation->set_rules('nik', 'Nik', 'required');

		$this->form_validation->set_rules('nama', 'Nama', 'required');

		// $this->form_validation->set_rules('password', 'password', 'required');

		$this->form_validation->set_rules('akses', 'Akses', 'required');

			// if($dataInsert['akses'] == 0){

			// 	$this->form_validation->set_rules('cabang', 'Cabang', 'required');

			// 	$this->form_validation->set_rules('kota', 'Kota', 'required');

			// }

			// if($dataInsert['akses'] == 1){

			// 	$this->form_validation->set_rules('status', 'Status', 'required');

			// 	$this->form_validation->set_rules('toko', 'Toko', 'required');

			// }

		if ($this->form_validation->run() == FALSE)

		{

			$dataDas['title'] = "Tambah Data User";

			$dataDas['desk'] = "App Retail";

			$dataDas['page'] = "users/Adddata";

			$dataDas['query_toko'] = $this->db->get_where('sada_toko',array('status'=>"Y"))->result();



				// $dataDas['css'] = $this->sada->CssdataTable();

				// $dataDas['js']	= $this->sada->JsdataTable();



			$dataDas['js'][]	= "assets/custom/addUser.js";



			$this->load->view('view_awal', $dataDas, FALSE);

		}

		else{

			if ($dataInsert['akses']==1) {



				$dataInsert["stay"] =  $this->input->post("stay",TRUE);

				$loop 				=  $this->input->post("toko",TRUE);

				foreach ($loop as $key => $value) {

					$exp = explode("|", $value);

					$zz[] = $value;

				}

			}

			if ($dataInsert['akses']==0) {

					// $dataInsert['cabang'] = $this->input->post("cabang",TRUE);

				$dataInsert["stay"] =  "N";

			}



			if ($this->sada->insertUser($dataInsert)) {

				$id=$this->db->select('id_user')->order_by('id_user',"desc")->limit(1)->get('sada_user')->row();

				$toko_tl = $this->input->post("toko_tl",TRUE);

				if ($dataInsert['akses']==0) {

					foreach ($toko_tl as $tl_toko) {
						$insertTL['id_user'] = $id->id_user;

						$insertTL['id_toko'] = $tl_toko;
						$this->db->insert("sada_tl_in_kota",$insertTL);
					}
					$this->session->set_flashdata('msg', 'User added');

					redirect('Dashboard/dataUser', 'refresh');
				}

				if ($dataInsert['akses']==1) {

					$inserttInsus['id_user'] = $id->id_user;

					

					$inserttInsus['id_toko'] = implode(",", $zz);

					

					$inserttInsus['status'] = "Y";


					if ($this->db->insert("sada_tokoinuser",$inserttInsus)) {
						foreach ($loop as $pool) {
							$insertUsTemp['id_user'] = $id->id_user;
							$insertUsTemp['id_toko'] = $pool;
							$insertUsTemp['status'] = "Y";		
							$this->db->insert("sada_tokoinuser_temp",$insertUsTemp);
						}

						$this->session->set_flashdata('msg', 'User added');

						redirect('Dashboard/dataUser', 'refresh');

					}

				}

				$this->session->set_flashdata('msg', 'User added');

				redirect('Dashboard/dataUser', 'refresh');

			}

			else{

				echo "gagal";

			}

		}

	} else {

		$dataDas['title'] = "Tambah Data User";

		$dataDas['desk'] = "App Retail";

		$dataDas['page'] = "users/Adddata";

		$dataDas['query_toko'] = $this->db->get_where('sada_toko',array('status'=>"Y"))->result();

		$dataDas['js'][]	= "assets/custom/addUser.js";

		$this->load->view('view_awal', $dataDas, FALSE);

	}

}

public function EditdataUser()

{

	$dataDas['title'] = "Edit Data User";

	$dataDas['desk'] = "";

	$dataDas['page'] = "users/edit_user";

	$dataDas['paramId'] = $this->uri->segment(3);

	$dataDas['loopEditUser'] = $this->sada->editUser($dataDas['paramId']);

	$dataDas['query_toko'] = $this->db->get_where('sada_toko',array('status'=>"Y"))->result();

	$dataDas['js'][]	= "assets/custom/editUser.js";



	if ($dataDas['loopEditUser']->akses == 1) {

		$qry = $this->db->select('id_user,id_toko')->where('id_user',$dataDas['paramId'])->get('sada_tokoinuser')->row();

		$dataDas['id_toko'] = explode(",", $qry->id_toko);
		$dataDas['tokoa'] = $this->db->get_where("sada_tl_in_kota",array("id_user"=>$dataDas['paramId']));

	}

	elseif ($dataDas['loopEditUser']->akses == 0) {

		// $dataDas['id_toko'] = null;

		$data = $this->sada->cabangGet($dataDas['paramId']);
		foreach ($data as $cab_id) {
			$dataDas['id_cabang'][] = $cab_id->id_cabang;
		}
		$dataDas['tokoa'] = $this->db->get_where("sada_tl_in_kota",array("id_user"=>$dataDas['paramId']));
		
	}
	
	$this->load->view('view_awal', $dataDas, FALSE);

}

public function UpdateEditUser()

{

	if ($this->input->post()) {

		$id_user = htmlentities($this->input->post("id_us",TRUE), ENT_QUOTES, 'utf-8');

		$dataUpdate["nik"] =  htmlentities($this->input->post("nik",TRUE), ENT_QUOTES, 'utf-8');

		$dataUpdate["nama"] =  htmlentities($this->input->post("nama",TRUE), ENT_QUOTES, 'utf-8');

		$password =  htmlentities(md5($this->input->post("password",TRUE)), ENT_QUOTES, 'utf-8');

		$toko_tl = $this->input->post("toko_tl",TRUE);

		if (!$this->input->post("password",TRUE) == '') {

			$dataUpdate['password'] = $password;

		}
		// else{
		// 	$dataUpdate['password'] = md5("1234");	
		// }

		$dataUpdate["akses"] =  htmlentities($this->input->post("akses",TRUE), ENT_QUOTES, 'utf-8');

		if ($dataUpdate['akses']==1) {

			$dataUpdate["stay"] =  $this->input->post("stay",TRUE);

			$loop 				=  $this->input->post("toko",TRUE);

			foreach ($loop as $key => $value) {

				$zz[] = $value;

			}

		}

		if ($dataUpdate['akses']==0) {

				// $dataInsert['cabang'] = $this->input->post("cabang",TRUE);

			$dataUpdate["stay"] =  "N";

		}

		if ($this->sada->updateEditUser($dataUpdate,$id_user)) {

			if ($dataUpdate['akses'] == 0) {
				$id_toko = $this->input->post("toko_tl",TRUE);
				if ($this->db->select("id_user")->where("id_user",$id_user)->get("sada_tl_in_kota")->num_rows() == 0) {
					foreach ($id_toko as $toko_id) {
						$updateTL['id_user'] = $this->input->post("id_us",TRUE);
						$updateTL['id_toko'] = $toko_id;

						if ($this->db->insert("sada_tl_in_kota",$updateTL)) {

							if (count($this->db->select("id_user")->where("id_user",$updateTL['id_user'])->get("sada_tokoinuser")->row()) > 0) {

								$this->db->delete("sada_tokoinuser",array("id_user"=>htmlentities($this->input->post("id_us",TRUE), ENT_QUOTES, 'utf-8')));

							}

						}
					}
				}

				else{
					$id_tokos = $this->input->post("toko_tl",TRUE);
					$this->db->delete("sada_tl_in_kota",array("id_user"=>htmlentities($this->input->post("id_us",TRUE), ENT_QUOTES, 'utf-8')));
					foreach ($id_tokos as $toko_id) {
						$updateTLs['id_user'] = $this->input->post("id_us",TRUE);
						$updateTLs['id_toko'] = $toko_id;
						$this->db->insert("sada_tl_in_kota",$updateTLs);
						$this->session->set_flashdata('msg', 'User Success Updated');
								// print_r($updateTLs);
								// echo $toko_id;
						
					}
						// print_r($id_tokos);
				}
				redirect('Dashboard/dataUser', 'refresh');
			}

			elseif ($dataUpdate['akses'] == 1) {

				$updateTus['id_user'] = htmlentities($this->input->post("id_us",TRUE), ENT_QUOTES, 'utf-8');

				$updateTus['id_toko'] = implode(",", $zz);

				$updateTus['status'] = "Y";

				if (count($this->db->select("id_user")->where("id_user",$updateTus['id_user'])->get("sada_tokoinuser")->row()) == 0) {

					// echo "ngga ada";

					if ($this->db->insert("sada_tokoinuser",$updateTus)) {

						if (count($this->db->select("id_user")->where("id_user",$updateTus['id_user'])->get("sada_tl_in_kota")->row()) > 0) {

							if ($this->db->delete("sada_tl_in_kota",array("id_user"=>htmlentities($this->input->post("id_us",TRUE), ENT_QUOTES, 'utf-8')))) {

								$this->session->set_flashdata('msg', 'User Success Updated');

								redirect('Dashboard/dataUser', 'refresh');

							}

						}

					}

				}

				else{

					if ($this->sada->updateEditTlin_user($updateTus,$id_user)) {
						if ($this->db->delete("sada_tokoinuser_temp",array("id_user"=>$id_user))) {
							foreach ($loop as $pool) {
								$insertUsTemp['id_user'] = htmlentities($this->input->post("id_us",TRUE), ENT_QUOTES, 'utf-8');
								$insertUsTemp['id_toko'] = $pool;
								$insertUsTemp['status'] = "Y";		
								$this->db->insert("sada_tokoinuser_temp",$insertUsTemp);
							}
						}
						$this->session->set_flashdata('msg', 'User Success Updated');

						redirect('Dashboard/dataUser', 'refresh');

					}

				}

			}

			elseif ($dataUpdate['akses'] == 2) {

				$this->session->set_flashdata('msg', 'User Success Updated');

				redirect('Dashboard/dataUser', 'refresh');

			}

			elseif ($dataUpdate['akses'] == 3) {

				$this->session->set_flashdata('msg', 'User Success Updated');

				redirect('Dashboard/dataUser', 'refresh');

			}

		}

		else{

		}

	}

}

public function assignStore($id)

{

	$dataDas['dataUser'] = $this->db->get_where('sada_user',array('id_user'=> $id))->first_row();

	$dataDas['title'] = "Tugaskan BA pada Store";

	$dataDas['desk'] = "App Retail";

	$dataDas['page'] = "users/AssignStore";

	$dataDas['query_toko'] = $this->db->get_where('sada_toko',array('status'=>"Y"))->result();



			// $dataDas['css'] = $this->sada->CssdataTable();

			// $dataDas['js']	= $this->sada->JsdataTable();



			 // $dataDas['js'][]	= "assets/custom/addUser.js";



	$this->load->view('view_awal', $dataDas, FALSE);

}





public function addAssignStore($id)

{

	$stores = $this->input->post('toko');

	$data = [];

	foreach ($stores as $toko) {

		$data[] = [

		'id_toko' => $toko,

		'id_user' => $id

		];

	}

	var_dump($data);

	$this->sada->insertAssignStore($data);

	echo "testing";

}





/*END USER MANAJEMEN*/



/* SKU */

public function dataSku()

{

	if ($this->input->post()) {

		$this->load->model('datatable');

		// if ($this->input->post()) {

		$table = "sada_produk";

		$column = array('id_produk','id_store','id_kategori','nama_produk',);

		$odb = array("id_produk"=>"desc");

		$list = $this->datatable->get_datatables($table,$column,$odb);

		$data = array();

		$no = 1;

		foreach ($list as $datatable) {

			$row = array();

			$row[] = $no++;

				// $select1 = $this->db->select('nama')->from('sada_toko')->where('id_toko',$datatable->id_store)->get()->row();

				// $row[] = $select1->nama;

			$select = $this->db->select('nama')->from('sada_kategori')->where('id',$datatable->id_kategori)->get()->row();

			$row[] = $select->nama;

			$row[] = $datatable->nama_produk;

			$select_price = $this->db->select('price')->from('sada_kategori')->where('id',$datatable->id_kategori)->get()->row();
			if ($this->session->userdata("akses")=="3") {

				$row[] = "";

			}

			else{
				if ($select_price->price == null) {

					$row[] = '<center>
					Price Belum Ditentukan
				</center>';
			}

			else{

				$row[] = '<center><span class="btn grey-cascade" style="cursor:default;">Rp '.substr($select_price->price,0,2).','.substr($select_price->price,2,3).'.'.substr($select_price->price,5,5)."</span></center>";


			}
			$row[] = '<div class="btn-group" >

			<button  class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions

				<i class="fa fa-angle-down"></i>

			</button>

			<ul class="dropdown-menu" role="menu">

				<li>

					'.anchor('sku/edit/'.$datatable->id_produk, '<i class="icon-pencil"></i>Edit', 'attributes').'

				</li>

				<li>

					'.anchor('sku/delete/'.$datatable->id_produk, '<i class="icon-trash"></i>Delete', 'onclick = "if (! confirm(\'Apakah Anda Yakin Untuk Menghapus '.$datatable->nama_produk.'? Data Yang Sudah Di Hapus Tidak Bisa Di Kembalikan\')) { return false; }"').'

				</li>



			</ul>

		</div>';

	}

	$data[] = $row;

}



$output = array(

	"draw" => $_POST['draw'],

	"recordsTotal" => $this->datatable->count_all($table,$column,$odb),

	"recordsFiltered" => $this->datatable->count_filtered($table,$column,$odb),

	"data" => $data,

	);

echo json_encode($output);

} else {

	$dataDas['title'] = "Data SKU";

	$dataDas['desk'] = "App Retail";

	$dataDas['page'] = "sku/data_sku";



	$dataDas['css'] = $this->sada->CssdataTable();

	$dataDas['js']	= $this->sada->JsdataTable();



	$dataDas['js'][]	= "assets/custom/dataProduk.js";

	$this->db->order_by("id_produk","desc");

	$dataDas['query'] = $this->sada->getProduk();



	$this->load->view('view_awal', $dataDas, FALSE);

}

}

public function formPrice()
{
	$dataDas['title'] = "Data Price";

	$dataDas['desk'] = "";

	$dataDas['page'] = "sku/price";



	$dataDas['paramId'] = $this->uri->segment(3);

	$dataDas['js'][]  = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";

	$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.js";	
	$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.extensions.js";	
	$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.numeric.extensions.js";	
	$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.phone.extensions.js";	
	$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.regex.extensions.js";	
	$dataDas['js'][]  = "assets/pages/scripts/decimal/jquery.inputmask.js";	

	$dataDas['js'][]  = "assets/global/scripts/app.min.js";

	$dataDas['js'][] ="assets/custom/price.js";



	$dataDas['js'][] ="assets/custom/select2Filter.js";

	$dataDas['loopEditPrice'] = $this->sada->editPrice($dataDas['paramId'])->row();

		// $dataDas['s'] = var_dump($dataDas['loopEditToko']);

	$this->load->view('view_awal', $dataDas, FALSE);
}

public function AdddataSku()

{

	$dataDas['title'] = "Tambah Data SKU";

	$dataDas['desk'] = "";

	$dataDas['page'] = "sku/add_sku";

	$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.js";	
	$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.extensions.js";	
	$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.numeric.extensions.js";	
	$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.phone.extensions.js";	
	$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.regex.extensions.js";	
	$dataDas['js'][]  = "assets/pages/scripts/decimal/jquery.inputmask.js";	

	$dataDas['js'][]  = "assets/global/scripts/app.min.js";

	$dataDas['js'][] ="assets/custom/price.js";

	$this->load->view('view_awal', $dataDas, FALSE);

}



public function insertDataSku()

{

	$this->load->library('form_validation');

		//$inCabang = htmlentities($this->input->post("nama-cabang",TRUE), ENT_QUOTES, 'utf-8');

	$cabangName = htmlentities($this->input->post("nama-cabang",TRUE), ENT_QUOTES, 'utf-8');

	$skuName = htmlentities($this->input->post("nama-sku",TRUE), ENT_QUOTES, 'utf-8');

	$skuCategory = htmlentities($this->input->post("kategori-sku",TRUE), ENT_QUOTES, 'utf-8');

	$skuStore = htmlentities($this->input->post("kategori-store",TRUE), ENT_QUOTES, 'utf-8');
	
	// $price = htmlentities($this->input->post("price",TRUE), ENT_QUOTES, 'utf-8');

	// $rep = array("Rp ",".","_");

	// $replace = str_replace($rep, "", $price);

	$idCategory = $this->db->get_where('sada_kategori',['nama' => $skuCategory])->first_row();



	$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

	$this->form_validation->set_rules('nama-sku', 'Nama Sku', 'required');

	$this->form_validation->set_rules('kategori-sku', 'Kategori Sku', 'required');

	// $this->form_validation->set_rules('price', 'Price', 'required');

			// $this->form_validation->set_rules('kategori-store', 'Kategori Store', 'required');



		//$idCabang = $this->db->get_where('sada_cabang',['nama' => $inCabang])->first_row();

	if ($this->form_validation->run() == FALSE)

	{

		$this->AdddataSku();

	}

	else{

		$idStore = $this->db->get_where('sada_toko',['nama' => $skuStore])->first_row();

		$this->sada->addNewSku([

			'nama_produk' => $skuName,

			'id_kategori' => $idCategory->id

			// 'price' 	  => $replace

					// 'id_store' 	=> $idStore->id_toko

			]);

		$this->session->set_flashdata('msg', 'Sku product added');

		redirect('Dashboard/dataSku', 'refresh');

	}

}



public function EditdataSku()

{

	$dataDas['title'] = "Edit Data SKU";

	$dataDas['desk'] = "";

	$dataDas['page'] = "sku/edit_sku";

	$dataDas['paramId'] = $this->uri->segment(3);

	$dataDas['loopEditSku'] = $this->sada->editSku($dataDas['paramId']);

		// $dataDas['s'] = var_dump($dataDas['loopEditSku']);

	$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.js";	
	$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.extensions.js";	
	$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.numeric.extensions.js";	
	$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.phone.extensions.js";	
	$dataDas['js'][]  = "assets/pages/scripts/decimal/inputmask.regex.extensions.js";	
	$dataDas['js'][]  = "assets/pages/scripts/decimal/jquery.inputmask.js";	

	$dataDas['js'][]  = "assets/global/scripts/app.min.js";

	$dataDas['js'][] ="assets/custom/price.js";

	$this->load->view('view_awal', $dataDas, FALSE);

}

public function updateDataSku()

{

	$this->load->library('form_validation');

	$skuId = htmlentities($this->input->post("id-sku",TRUE), ENT_QUOTES, 'utf-8');



	$skuName = htmlentities($this->input->post("nama-sku",TRUE), ENT_QUOTES, 'utf-8');

	$skuCategory = htmlentities($this->input->post("kategori-sku",TRUE), ENT_QUOTES, 'utf-8');

	$skuStore = htmlentities($this->input->post("kategori-store",TRUE), ENT_QUOTES, 'utf-8');

	$price = htmlentities($this->input->post("price",TRUE), ENT_QUOTES, 'utf-8');

	$rep = array("Rp ",".","_");

	$replace = str_replace($rep, "", $price);

	$idCategory = $this->db->get_where('sada_kategori',['nama' => $skuCategory])->first_row();

	$idStore = $this->db->get_where('sada_toko',['nama' => $skuStore])->first_row();





	$field = array('id_store' => $idStore->id_toko , 'id_kategori' => $idCategory->id, 'nama_produk' => $skuName, 'price' => $replace);



	$this->sada->updateSku($skuId,$field);

	$this->session->set_flashdata('msg','Sku product success edited');

	redirect('Dashboard/dataSku', 'refresh');

}



public function deleteDataSku()

{

	$skuId = $this->uri->segment(3);

	$this->db->delete('sada_produk',array('id_produk'=>$skuId));

	$this->session->set_flashdata('msg','SKU product success deleted');

	redirect('Dashboard/dataSku', 'refresh');

}

/* END SKU */



	//<CABANG>

public function dataCabang()

{if ($this->input->post()) {

	$this->load->model('datatable');

		// if ($this->input->post()) {

	$table 	= "sada_cabang";

	$column = array('id_cabang','nama','pic','email_pic','aspm','email_aspm');

	$odb 	= array("id_cabang"=>"asc");

	$list 	= $this->datatable->get_datatables($table,$column,$odb);

	$data 	= array();

	$no 	= 1;

	foreach ($list as $datatable) {

		$row 		= array();

		$row[] 		= $no++;

		$row[] 		= $datatable->nama;

		// $row[] 		= $datatable->target;

		$row[] 		= $datatable->pic;
		
		$row[] 		= $datatable->email_pic;

		$row[] 		= $datatable->aspm;

		$row[] 		= $datatable->email_aspm;


		if ($this->session->userdata("akses")=="3") {

			$row[] = "";

		}

		else{

			$row[] 		= '

			<button  class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions

				<i class="fa fa-angle-down"></i>

			</button>

			<ul class="dropdown-menu" role="menu">

				<li>

					'.anchor('cabang/edit/'.$datatable->id_cabang, '<i class="icon-pencil"></i>Edit', 'attributes').'

				</li>

				<li>

					'.anchor('cabang/delete/'.$datatable->id_cabang, '<i class="icon-trash"></i>Delete', 'onclick = "if (! confirm(\'Apakah Anda Yakin Untuk Menghapus '.$datatable->nama.'? Data Yang Sudah Di Hapus Tidak Bisa Di Kembalikan\')) { return false; }"').'

				</li>

			</ul>';

	}

	$data[] = $row;

}

$output = array(

	"draw" => $_POST['draw'],

	"recordsTotal" => $this->datatable->count_all($table,$column,$odb),

	"recordsFiltered" => $this->datatable->count_filtered($table,$column,$odb),

	"data" => $data,

	);

echo json_encode($output);

} else {

	$dataDas['title'] 	= "Data Cabang";

	$dataDas['desk']  	= "";

	$dataDas['page']  	= "cabang/data_cabang";



	$dataDas['css'] 	= $this->sada->CssdataTable();

	$dataDas['js']		= $this->sada->JsdataTable();



	$dataDas['js'][]	= "assets/custom/dataCabang.js";

	$dataDas['query'] 	= $this->sada->getCabang();



	$this->load->view('view_awal', $dataDas, FALSE);

}

}



public function addDataCabang()

{

	$dataDas['title'] = "Tambah Cabang";

	$dataDas['desk'] = "";

	$dataDas['page'] = "cabang/add_cabang";

	
	$dataDas['js'][] ="assets/custom/add_cabang.js";

	$this->load->view('view_awal', $dataDas, FALSE);

}



public function insertDataCabang()

{

	$this->load->library('form_validation');

	$cabangName = htmlentities($this->input->post("nama-cabang",TRUE), ENT_QUOTES, 'utf-8');
	$pic = $this->input->post("namapic");
	$email_pic_field = $this->input->post("emailpic");
	$aspm_field = $this->input->post("aspm");
	$aspm_email_field = $this->input->post("emailaspm");

	// echo print_r($this->input->post());
	// $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
	// $this->form_validation->set_rules('nama-cabang', 'Nama Cabang', 'required');
	// $this->form_validation->set_rules('pic', 'PIC', 'required');

	// // if ($this->form_validation->run() == FALSE)
	// // {

	// // 	$this->addDataCabang();
	// // }
	// // else{
	$this->sada->addNewCabang([

				//'id_cabang' => $idCabang->id_cabang,

		'nama' => $cabangName,
		'pic' => implode(',', $pic),
		'email_pic' => implode(',', $email_pic_field),
		'aspm' => implode(',', $aspm_field),
		'email_aspm' => implode(',', $aspm_email_field)

		]);

	$this->session->set_flashdata('msg', 'Cabang '.$cabangName.' has been ADDED');

	redirect('Dashboard/dataCabang', 'refresh');

	// // }

}



public function editDataCabang()

{

	$dataDas['title'] = "Edit Cabang";

	$dataDas['desk'] = "";

	$dataDas['page'] = "cabang/edit_cabang";


	$dataDas['js'][] ="assets/custom/validation_number.js";

	$dataDas['js'][] ="assets/custom/add_cabang.js";
	$dataDas['paramId'] = $this->uri->segment(3);

	$dataDas['loopEditCabang'] = $this->sada->editCabang($dataDas['paramId']);

		// $dataDas['s'] = var_dump($dataDas['loopEditCabang']);



	$this->load->view('view_awal', $dataDas, FALSE);

}



public function updateDataCabang()

{

	$cabangId = htmlentities($this->input->post("id-cabang",TRUE), ENT_QUOTES, 'utf-8');

	$cabangName = htmlentities($this->input->post("nama-cabang",TRUE), ENT_QUOTES, 'utf-8');
	$pic = $this->input->post("namapic");
	$email_pic_field = $this->input->post("emailpic");
	$aspm_field = $this->input->post("aspm");
	$aspm_email_field = $this->input->post("emailaspm");

	$field = array('nama' => $cabangName,
		'pic' => implode(',', $pic),
		'email_pic' => implode(',', $email_pic_field),
		'aspm' => implode(',', $aspm_field),
		'email_aspm' => implode(',', $aspm_email_field));



	$this->sada->updateCabang($cabangId,$field);

	$this->session->set_flashdata('msg','Cabang '.$cabangName.' has been updated');

	redirect('Dashboard/dataCabang', 'refresh');

}



public function deleteDataCabang()

{

	$cabangId = $this->uri->segment(3);

	$this->db->delete('sada_cabang',array('id_cabang'=>$cabangId));

	$this->session->set_flashdata('msg','Cabang has been DELETED');

	redirect('Dashboard/dataCabang', 'refresh');

}

	//<CABANG/>



	//<KOTA>

public function dataKota()

{if ($this->input->post()) {

	$this->load->model('datatable');

		// if ($this->input->post()) {

	$table 	= "sada_kota";

	$column = array('id_kota','nama_kota','id_cabang');

	$odb 	= array("id_kota"=>"asc");

	$list 	= $this->datatable->get_datatables($table,$column,$odb);

	$data 	= array();

	$no 	= 1;

	foreach ($list as $datatable) {

		$row 		= array();

		$row[] 		= $no++;

		$row[] 		= $datatable->nama_kota;

		$cabang = $this->db->select("nama")->where("id_cabang",$datatable->id_cabang)->get("sada_cabang");

		$string = "";

		foreach ($cabang->result() as $key => $value) {
			$string .= $value->nama;
		}

		$row[] = $string;

		if ($this->session->userdata("akses")=="3") {

			$row[] = "";

		}

		else{

			$row[] 		= '<div class="btn-group" >

			<button  class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions

				<i class="fa fa-angle-down"></i>

			</button>

			<ul class="dropdown-menu" role="menu">

				<li>

					'.anchor('kota/edit/'.$datatable->id_kota, '<i class="icon-pencil"></i>Edit', 'attributes').'

				</li>

				<li>

					'.anchor('kota/delete/'.$datatable->id_kota, '<i class="icon-trash"></i>Delete', 'onclick = "if (! confirm(\'Apakah Anda Yakin Untuk Menghapus '.$datatable->nama_kota.'? Data Yang Sudah Di Hapus Tidak Bisa Di Kembalikan\')) { return false; }"').'

				</li>

			</ul>

		</div>';

	}

	$data[] = $row;

}



$output = array(

	"draw" => $_POST['draw'],

	"recordsTotal" => $this->datatable->count_all($table,$column,$odb),

	"recordsFiltered" => $this->datatable->count_filtered($table,$column,$odb),

	"data" => $data,

	);

echo json_encode($output);

} else {

	$dataDas['title'] = "Data Kota";

	$dataDas['desk'] = "Detail Kota";

	$dataDas['page'] = "kota/data_kota";



	$dataDas['css'] = $this->sada->CssdataTable();

	$dataDas['js']	= $this->sada->JsdataTable();

	$dataDas['css'][]  	= "assets/global/plugins/select2/css/select2-bootstrap.min.css";

	$dataDas['css'][]	= "assets/global/plugins/select2/css/select2.min.css";



	$dataDas['js'][]	= "assets/pages/scripts/components-select2.min.js";



		    // $dataDas['js'][] ="assets/custom/select2Filter.js";

	$dataDas['js'][]	= "assets/custom/dataKota.js";

	$dataDas['js'][]	= "assets/global/plugins/select2/js/select2.full.min.js";



	    	// $this->db->order_by("id_kota","asc");

	$dataDas['query'] = $this->sada->getKota();



	$this->load->view('view_awal', $dataDas, FALSE);

}

}



public function addDataKota()

{

	$dataDas['title'] = "Tambah Kota";

	$dataDas['desk'] = "";

	$dataDas['page'] = "kota/add_kota";

	$dataDas['js'][]  = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";

	$dataDas['js'][] ="assets/custom/addKota.js";





	$this->db->where('status','Y');

	$dataDas['q_cabang'] = $this->db->get('sada_cabang');



	$this->load->view('view_awal', $dataDas, FALSE);

}



public function insertDataKota()

{

	$inCabang = htmlentities($this->input->post("nama_cabang",TRUE), ENT_QUOTES, 'utf-8');

	$kotaName = htmlentities($this->input->post("nama_kota",TRUE), ENT_QUOTES, 'utf-8');

	$idCabang = $this->db->get_where('sada_cabang',['nama' => $inCabang])->first_row();

	$this->sada->addNewKota([

		'id_cabang' => $idCabang->id_cabang,

		'nama_kota' => $kotaName

		]);

	if($inCabang == '0'){



	}



	$this->session->set_flashdata('msg', 'Kota '.$kotaName.' has been ADDED');

	redirect('Dashboard/dataKota', 'refresh');

}



public function editDataKota()

{

	$dataDas['title'] = "Edit Kota";

	$dataDas['desk'] = "";

	$dataDas['page'] = "kota/edit_kota";

	$dataDas['js'][] ="assets/custom/editKota.js";

	$dataDas['paramId'] = $this->uri->segment(3);

	$dataDas['loopEditKota'] = $this->sada->editKota($dataDas['paramId']);

		// $dataDas['s'] = var_dump($dataDas['loopEditKota']);



	$this->load->view('view_awal', $dataDas, FALSE);

}



public function updateDataKota()

{

	$kotaId = htmlentities($this->input->post("id_kota",TRUE), ENT_QUOTES, 'utf-8');

	$data['nama_kota'] = htmlentities($this->input->post("nama_kota",TRUE), ENT_QUOTES, 'utf-8');

	$data['id_cabang'] = htmlentities($this->input->post("cabang",TRUE), ENT_QUOTES, 'utf-8');



		// $field = array('nama_kota' => $kotaName);



	$this->sada->updateKota($kotaId,$data);

	$this->session->set_flashdata('msg','Kota '.$data['nama_kota'].' has been EDITED');

	redirect('Dashboard/dataKota', 'refresh');

}



public function deleteDataKota()

{

	$kotaId = $this->uri->segment(3);

	$this->db->delete('sada_kota',array('id_kota'=>$kotaId));

	$this->session->set_flashdata('msg','Kota has been DELETED');

	redirect('Dashboard/dataKota', 'refresh');

}

	//<KOTA/>





	//<TOKO>



public function dataToko()

{

	if ($this->input->post()) {

		$this->load->model('datatable');

		// if ($this->input->post()) {

		$table = "sada_toko";

		$column = array('id_toko','store_id','nama');

		$odb = array("id_toko"=>"desc");

		$list = $this->datatable->get_datatables($table,$column,$odb);

		$data = array();

		$no = 1;

		$select3 = $this->db->select('id_toko')->from('sada_account')->get();

		foreach ($select3->result() as $val_account) {
			$id_toko[] = explode(',', $val_account->id_toko);

			// var_dump($id_toko);
		}
		foreach ($list as $datatable) {

			$row = array();

			$row[] = $no++;

			$row[] = $datatable->store_id;

			$select1 = $this->db->select('nama_kota')->from('sada_kota')->where('id_kota',$datatable->id_kota)->get()->row();

			$row[] = $select1->nama_kota;

			$select2 = $this->db->select('*')->from('sada_target')->where('id_toko',$datatable->id_toko)->get();

			$row[] = $datatable->nama;


			// $row[] = $datatable->nama; field Account

			if ($select2->num_rows() != $this->db->get('sada_kategori')->num_rows()) {

				if ($select2->num_rows() > 0) {

					$i = '

					<a  class="label label-sm label-danger" id="showTarget" href="#page'.$datatable->id_toko.'"><small>Show Target</small></a>

					';

				}

				else{

					$i = '<span  class="label label-sm label-info"><small>Target belum ditentukan</small></span>';

				}
				
				$duplicate = $this->db->get_where('sada_target',array('id_toko' => $datatable->id_toko, 'id_kategori' => $datatable->id_kategori));
				if ($select2->num_rows() == 7) {
					if ($duplicate->num_rows() > 0) {
						
					}
					else{
						$row[] = '

							<center>

								'.$i.'

							</center>

						';
					}
				}
				else{
					$row[] = '

					<center>

						'.$i.' '.anchor('toko/target/'.$datatable->id_toko, 'Set target', array('class'=>'btn btn-xs blue-hoki')).'

					</center>

				';
				}
			}

			else{

				$row[] = '

				<center>

					<a  class="label label-sm label-danger" id="showTarget" href="#page'.$datatable->id_toko.'"><small>Show Target</small></a>



				</center>

				';

			}

			if ($this->session->userdata("akses")=="3") {

				$row[] = "";

			}

			else{

				$row[] = '<div class="btn-group" >

				<button  class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions

					<i class="fa fa-angle-down"></i>

				</button>

				<ul class="dropdown-menu" role="menu">

					<li>

						'.anchor('toko/edit/'.$datatable->id_toko, '<i class="icon-pencil"></i>Edit', 'attributes').'

					</li>

					<li>

						'.anchor('toko/delete/'.$datatable->id_toko, '<i class="icon-trash"></i>Delete', 'onclick = "if (! confirm(\'Apakah Anda Yakin Untuk Menghapus '.$datatable->nama.'? Data Yang Sudah Di Hapus Tidak Bisa Di Kembalikan\')) { return false; }"').'

					</li>

				</ul>

			</div>';

		}

		$data[] = $row;

	}



	$output = array(

		"draw" => $_POST['draw'],

		"recordsTotal" => $this->datatable->count_all($table,$column,$odb),

		"recordsFiltered" => $this->datatable->count_filtered($table,$column,$odb),

		"data" => $data,

		);

	echo json_encode($output);

} else {

	$dataDas['title'] = "Data Toko";

	$dataDas['desk'] = "App Retail";

	$dataDas['page'] = "toko/data";



	$dataDas['css'] = $this->sada->CssdataTable();

	$dataDas['js']	= $this->sada->JsdataTable();



	$this->db->order_by("status","desc");

	$dataDas['js'][]	= "assets/custom/DataToko.js";

	$dataDas['query'] = $this->db->get('sada_toko');

	$this->load->view('view_awal', $dataDas, FALSE);

}

}

public function tokoTarget()

{

	$dataDas['title'] = "Target Toko";

	$dataDas['desk'] = "";

	$dataDas['page'] = "toko/target_toko";



	$dataDas['paramId'] = $this->uri->segment(3);

	$dataDas['js'][]  = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";

	$dataDas['q_kategori'] = $this->db->get_where("sada_kategori",array('status'=>'Y'));

	$dataDas['js'][]  = "assets/global/scripts/app.min.js";

	$dataDas['js'][] ="assets/custom/editToko.js";

	$dataDas['js'][] ="assets/custom/addToko.js";

	$dataDas['js'][] ="assets/custom/select2Filter.js";

	$dataDas['loopaddTarget'] = $this->db->select("id_toko,nama")->where("id_toko",$dataDas['paramId'])->get("sada_toko")->row();

	$dataDas['param_kategori'] = $this->sada->addTokoTarget($dataDas['paramId']);



		// $dataDas['s'] = var_dump($dataDas['loopEditToko']);



	$this->load->view('view_awal', $dataDas, FALSE);

}

public function InsertTokoTarget()

{

	$data['id_toko'] = htmlentities($this->input->post("id_toko",TRUE), ENT_QUOTES, 'utf-8');

	$data['id_kategori'] = htmlentities($this->input->post("kategori_target",TRUE), ENT_QUOTES, 'utf-8');

	$data['target'] = htmlentities($this->input->post("target",TRUE), ENT_QUOTES, 'utf-8');

	if ($data['id_kategori'] == 0) {
		$this->session->set_flashdata('msg', 'Data target sudah lengkap');
	}
	else{
		if ($this->db->insert('sada_target',$data)) {

			$this->session->set_flashdata('msg', 'Data '.$data['nama'].' has been Updated');

			// redirect('Dashboard/dataToko','refresh');

		}
	}

}

public function editTargetToko()

{

	$dataDas['title'] = "Edit Target Toko";

	$dataDas['desk'] = "";

	$dataDas['page'] = "toko/edit_target";



	$dataDas['paramId'] = $this->uri->segment(3);

	$dataDas['js'][]  = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";



	$dataDas['js'][]  = "assets/global/scripts/app.min.js";

	$dataDas['js'][] ="assets/custom/editToko.js";

	$dataDas['js'][] ="assets/custom/select2Filter.js";

	$dataDas['loopEditTarget'] = $this->sada->editTarget($dataDas['paramId'])->row();

		// $dataDas['s'] = var_dump($dataDas['loopEditToko']);



	$this->load->view('view_awal', $dataDas, FALSE);

}

public function targetUpdate()

{

	if ($this->input->post()) {

		$target['target'] = $this->input->post("target");

		if ($this->sada->updateTarget($this->input->post("id_target"),$target)) {

			$this->session->set_flashdata('msg', 'Data '.$target['target'].' has been Updated');

			redirect('Dashboard/dataToko', 'refresh');

		}

	}

}

public function AdddataToko()

{

	$dataDas['title'] = "Tambah Toko";

	$dataDas['desk'] = "App Retail";

	$dataDas['page'] = "toko/Adddata";

	$this->db->where('status','Y');

	$dataDas['q_kota'] = $this->db->get('sada_kota');



	$dataDas['css'][]  	= "assets/global/plugins/select2/css/select2-bootstrap.min.css";

	$dataDas['css'][]	= "assets/global/plugins/select2/css/select2.min.css";

	$dataDas['js'][]  = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";



	$dataDas['js'][]  = "assets/global/scripts/app.min.js";

	$dataDas['js'][] ="assets/custom/addToko.js";

	$dataDas['js'][] ="assets/custom/select2Filter.js";

		// $dataDas['js'][]	= "assets/pages/scripts/components-select2.min.js";

	$dataDas['js'][]	= "assets/global/plugins/select2/js/select2.full.min.js";



	$dataDas['js'][]  = "assets/pages/scripts/form-validation.min.js";

	$this->load->view('view_awal', $dataDas, FALSE);

}

public function InsertAdddataToko()

{

	$data['store_id'] = htmlentities($this->input->post("store_id",TRUE), ENT_QUOTES, 'utf-8');

	$data['id_kota'] = htmlentities($this->input->post("kota",TRUE), ENT_QUOTES, 'utf-8');

	$data['nama'] = htmlentities($this->input->post("toko",TRUE), ENT_QUOTES, 'utf-8');

	if ($this->db->insert("sada_toko",$data)) {

		$this->session->set_flashdata('msg', 'Data '.$data['nama'].' has been ADDED');

		redirect('Dashboard/dataToko', 'refresh');

	}

}

public function editDataToko()

{

	$dataDas['title'] = "Edit Toko";

	$dataDas['desk'] = "";

	$dataDas['page'] = "toko/edit_toko";



	$dataDas['paramId'] = $this->uri->segment(3);

	$dataDas['js'][]  = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";



	$dataDas['js'][]  = "assets/global/scripts/app.min.js";

	$dataDas['js'][] ="assets/custom/editToko.js";

	$dataDas['js'][] ="assets/custom/select2Filter.js";

	$dataDas['loopEditToko'] = $this->sada->editToko($dataDas['paramId']);

		// $dataDas['s'] = var_dump($dataDas['loopEditToko']);



	$this->load->view('view_awal', $dataDas, FALSE);

}

public function updateDataToko()

{

	$data['store_id'] = htmlentities($this->input->post("store_id",TRUE), ENT_QUOTES, 'utf-8');

	$data['id_kota'] = htmlentities($this->input->post("kota",TRUE), ENT_QUOTES, 'utf-8');

	$data['nama'] = htmlentities($this->input->post("nama",TRUE), ENT_QUOTES, 'utf-8');

	if ($this->sada->updateToko($this->uri->segment(3),$data)) {

		$this->session->set_flashdata('msg', 'Data '.$data['nama'].' has been Updated');

		redirect('Dashboard/dataToko', 'refresh');

	}

}

public function deleteDataToko()

{

	$id = $this->uri->segment(3);



	if ($this->db->delete("sada_toko",array('id_toko'=>$id))) {

		$this->session->set_flashdata('msg','Data successfully deleted');

		redirect('Dashboard/dataToko','refresh');

	}

	else{

		echo "Gagal delete";

	}



}

	//<TOKO/>





public function testData()

{

	$dataDas['title'] = "TEST Data Toko";

	$dataDas['desk'] = "App Retail";

	$dataDas['page'] = "toko/dataTEST";



	$dataDas['css'] = $this->sada->CssdataTable();

	$dataDas['js']	= $this->sada->JsdataTable();

	$dataDas['js'][]	= "assets/custom/DataToko.js";







	$this->load->view('view_awal', $dataDas, FALSE);

}



public function testingToko()

{

	var_dump( $this->db->get_where('sada_tokoinuser',['id_user' => 2, 'id_toko' => 2])->first_row());

}



public function testData2()

{

	$this->load->model('datatable');

		// if ($this->input->post()) {

	$table = "sada_toko";

	$column = array('store_id','id_cabang','nama','status');

	$odb = array("id_toko"=>"desc");

	$list = $this->datatable->get_datatables($table,$column,$odb);

	$data = array();

	$no = $_POST['start'];

	foreach ($list as $datatable) {

		$no++;

		$row = array();

		$row[] = $datatable->store_id;

		$row[] = $datatable->id_cabang;

		$row[] = $datatable->nama;

		$row[] = $datatable->status;



				//add html for action

		$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_datatable('."'".$datatable->id_toko."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>

		<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_datatable('."'".$datatable->id_toko."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';



		$data[] = $row;

	}



	$output = array(

		"draw" => $_POST['draw'],

		"recordsTotal" => $this->datatable->count_all($table,$column,$odb),

		"recordsFiltered" => $this->datatable->count_filtered($table,$column,$odb),

		"data" => $data,

		);

			//output to json format

	echo json_encode($output);

		// }



}



public function absensi()

{

	$dataDas['title'] = "Absensi";

	$dataDas['desk'] = "App Retail";

	$dataDas['page'] = "absensi/data";

	$dataDas['css'][]  	= "assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css";

	$dataDas['css'][]  	= "assets/global/plugins/select2/css/select2-bootstrap.min.css";

	$dataDas['css'][]	= "assets/global/plugins/select2/css/select2.min.css";

	$dataDas['css'][]	= "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css";

	$dataDas['css'][]	= "assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css";

	$dataDas['css'][]	= "assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css";

	$dataDas['css'][]	= "assets/global/plugins/datatables/datatables.min.css";

	$dataDas['css'][]	= "assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css";

	$dataDas['js'][]	= "assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js";

	$dataDas['js'][]	= "assets/global/scripts/datatable.js";

	$dataDas['js'][]	= "assets/global/plugins/datatables/datatables.min.js";

	$dataDas['js'][]	= "assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js";

	$dataDas['js'][]	= "assets/pages/scripts/table-datatables-managed.min.js";

	$dataDas['js'][]	= "assets/custom/tagSelection.js";

	$dataDas['js'][]	= "assets/custom/tagDate.js";

	$dataDas['js'][]	= "assets/pages/scripts/components-select2.min.js";

	$dataDas['js'][]	= "assets/global/plugins/select2/js/select2.full.min.js";

	$dataDas['js'][]	= "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js";

	$dataDas['js'][]	= "assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js";

	$dataDas['js'][]	= "assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js";

	$dataDas['js'][]	= "assets/pages/scripts/components-date-time-pickers.min.js";

	$dataDas['js'][] ="assets/custom/select2FilterAbsensi.js";



	$this->load->view('view_awal', $dataDas, FALSE);

}



public function absensiizin()

{

	$dataDas['title'] = "Ini Title";

	$dataDas['desk'] = "App Retail";

	$dataDas['page'] = "initempatfile";



	$this->load->view('view_awal', $dataDas, FALSE);

}



public function kategori()

{

	$dataDas['title'] = "Ini Title";

	$dataDas['desk'] = "App Retail";

	$dataDas['page'] = "initempatfile";



	$this->load->view('view_awal', $dataDas, FALSE);

}





	//a



public function kategoriadd()

{

	$dataDas['title'] = "Ini Title";

	$dataDas['desk'] = "App Retail";

	$dataDas['page'] = "initempatfile";



	$this->load->view('view_awal', $dataDas, FALSE);

}





	//a



public function oos()

{

	$dataDas['title'] = "Ini Title";

	$dataDas['desk'] = "App Retail";

	$dataDas['page'] = "initempatfile";



	$this->load->view('view_awal', $dataDas, FALSE);

}





	//a



public function reportSku()

{

	$dataDas['title'] = "Sku Report";

	$dataDas['desk'] = "App Retail";

	$dataDas['page'] = "report/sku";

	$dataDas['baName'] = $this->sada->getBaName();

	$dataDas['tlName'] = $this->sada->getTlName();

	$dataDas['toko'] = $this->sada->getToko();



	$dataDas['js'][]  = "assets/global/plugins/bootstrap/js/bootstrap.min.js";

	$dataDas['js'][]  = "assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js";

	$dataDas['js'][]  = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";



	$dataDas['js'][]  = "assets/global/scripts/app.min.js";

	$dataDas['js'][]  = "assets/pages/scripts/form-validation.min.js";

	$dataDas['css'][]  	= "assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css";

	$dataDas['css'][]  	= "assets/global/plugins/select2/css/select2-bootstrap.min.css";

	$dataDas['css'][]	= "assets/global/plugins/select2/css/select2.min.css";

	$dataDas['css'][]	= "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css";

	$dataDas['css'][]	= "assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css";

	$dataDas['css'][]	= "assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css";

	$dataDas['css'][]	= "assets/global/plugins/datatables/datatables.min.css";

	$dataDas['css'][]	= "assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css";

	$dataDas['js'][]	= "assets/global/scripts/datatable.js";

	$dataDas['js'][]	= "assets/global/plugins/datatables/datatables.min.js";

	$dataDas['js'][]	= "assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js";

	$dataDas['js'][]	= "assets/pages/scripts/table-datatables-managed.min.js";

	$dataDas['js'][]	= "assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js";

	$dataDas['js'][]	= "assets/pages/scripts/components-bootstrap-select.min.js";

	$dataDas['js'][]	= "assets/custom/tagSelection.js";

	$dataDas['js'][]	= "assets/custom/tagDate.js";

	$dataDas['js'][]	= "assets/pages/scripts/components-select2.min.js";

	$dataDas['js'][]	= "assets/global/plugins/select2/js/select2.full.min.js";

	$dataDas['js'][]	= "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js";

	$dataDas['js'][]	= "assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js";

	$dataDas['js'][]	= "assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js";

	$dataDas['js'][]	= "assets/pages/scripts/components-date-time-pickers.min.js";

	$dataDas['js'][] ="assets/custom/select2Filter.js";





	$this->load->view('view_awal', $dataDas, FALSE);

}



public function skuExcel()

{

	echo 'tes';

}

public function insertReportSku()

{

	$filterTl = ($this->input->post('tl') == "0") ? "" : $this->input->post('tl');

	$filterName = ($this->input->post('ba') == "0") ? "" : $this->input->post('ba');

	$filterToko = (null != $this->input->post('toko') && $this->input->post('toko') !=0) ? $this->input->post('toko') : "";

	$filterCabang = ($this->input->post('cabang') == "0") ? "" : $this->input->post('cabang');

	$filterKota = ($this->input->post('kota') == "0") ? "" : $this->input->post('kota');

	$startDate =  date('Y-m-d H:i:s', strtotime($this->input->post('startDate')));

	$endDate = $this->input->post('endDate');





		// var_dump($this->input->post('toko'));

		// $a = '2016-05-03 14:11:45';

		// if(strtotime($a) >	 strtotime($startDate)){

		// 	echo 'timestamp win';

		// 	return;

		// }

		// echo 'Start date win';

		// var_dump(strtotime('2016-05-03 14:11:45'));



}



	//a



public function reportdetailcontact()

{





	if ($this->input->post()) {

		$arr['tl'] = $this->input->post("tl");

		$arr['ba'] = $this->input->post("ba");

		$arr['toko'] = $this->input->post("toko");

		$arr['cabang'] = $this->input->post("cabang");

		$arr['kota'] = $this->input->post("kota");

		$arr['startDate'] = date('Y-m-d H:i:s', strtotime($this->input->post("startDate")." 00:00:00"));

		$arr['endDate'] = date('Y-m-d H:i:s', strtotime($this->input->post("endDate")." 23:59:59"));

		$this->load->model('datatable');

		$select = "SELECT
		sada_form_contact.namaibu,
		sada_form_contact.tgl_contact,
		sada_form_contact.ttl,
		sada_form_contact.telp,
		sada_form_contact.tipe,
		CASE
		WHEN sada_form_contact.beli = 'N' THEN 'N'
		WHEN sada_form_contact.beli = 'Y' THEN 'Y'
		ELSE 'Kosong'
		END AS 'beli',
		sada_form_contact.oldProduct,
		sada_form_contact.sampling,
		CASE
		WHEN sada_form_contact.segmen = 'wet' THEN 'Wet'
		WHEN sada_form_contact.segmen = 'dry' THEN 'Dry'
		ELSE 'Kosong'
		END AS 'segmen',
		sada_form_contact.namaanak,
		CASE (
		SELECT
		sada_kategori.nama
		FROM
		sada_kategori
		WHERE
		sada_kategori.id = sada_form_contact.kategori_id
	)
	WHEN (
	SELECT
	sada_kategori.nama
	FROM
	sada_kategori
	WHERE
	sada_kategori.id = sada_form_contact.kategori_id
) IS NULL 
THEN
(
	SELECT
	sada_kategori.nama
	FROM
	sada_kategori
	WHERE
	sada_kategori.id = sada_form_contact.kategori_id
)
ELSE
'Kosong'
END AS 'sada_kategori_label',

(
	SELECT
	sada_kategori.id
	FROM
	sada_kategori
	WHERE
	sada_kategori.id = sada_form_contact.kategori_id
	AND sada_form_contact.user_id = sada_user.id_user
) AS 'count_sampling',
(
	SELECT
	COUNT(*)
	FROM
	sada_form_contact
	WHERE
	sada_form_contact.user_id = sada_user.id_user
	AND sada_form_contact.store_id = toko.id_toko
) AS 'contact_count',
(
	SELECT
	COUNT(*)
	FROM
	sada_form_contact
	WHERE
	sada_form_contact.tipe = 'newRecruit'
	AND sada_form_contact.user_id = sada_user.id_user
	AND sada_form_contact.store_id = toko.id_toko
) AS 'count_recruit',
(
	SELECT
	COUNT(*)
	FROM
	sada_form_contact
	WHERE
	sada_form_contact.tipe = 'switching'
	AND sada_form_contact.user_id = sada_user.id_user
	AND sada_form_contact.store_id = toko.id_toko
) AS 'count_switching',
(
	SELECT
	COUNT(*)
	FROM
	sada_form_contact
	WHERE
	sada_form_contact.kategori_id = '1'
	AND sada_form_contact.user_id = sada_user.id_user
	AND sada_form_contact.store_id = toko.id_toko
) AS 'BC',
(
	SELECT
	COUNT(*)
	FROM
	sada_form_contact
	WHERE
	sada_form_contact.kategori_id = '2'
	AND sada_form_contact.user_id = sada_user.id_user
	AND sada_form_contact.store_id = toko.id_toko
) AS 'BTI',
(
	SELECT
	COUNT(*)
	FROM
	sada_form_contact
	WHERE
	sada_form_contact.kategori_id = '3'
	AND sada_form_contact.user_id = sada_user.id_user
	AND sada_form_contact.store_id = toko.id_toko
) AS 'Rusk',
(
	SELECT
	COUNT(*)
	FROM
	sada_form_contact
	WHERE
	sada_form_contact.kategori_id = '4'
	AND sada_form_contact.user_id = sada_user.id_user
	AND sada_form_contact.store_id = toko.id_toko
) AS 'Pudding',
(
	SELECT
	COUNT(*)
	FROM
	sada_form_contact
	WHERE
	sada_form_contact.kategori_id = '5'
	AND sada_form_contact.user_id = sada_user.id_user
	AND sada_form_contact.store_id = toko.id_toko
) AS 'Others',
(
	SELECT
	COUNT(*)
	FROM
	sada_form_contact
	WHERE
	sada_form_contact.beli = 'Y'
	AND sada_form_contact.sampling = 'Y'
) AS 'strike_sampling',

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

	$where = "WHERE sada_form_contact.tgl_contact BETWEEN '".$arr['startDate']."' AND '".$arr['endDate']."'";

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

FROM sada_form_contact LEFT JOIN sada_user ON sada_form_contact.user_id=sada_user.id_user ".$join." ".$where." ";

  // echo $select;

$data = $this->db->query($select);

$no = 1;

foreach ($data->result() as $key => $value) {

	$row = array();

	$row[] = $no++;

	$row[] = $value->nama_cabang;

	$row[] = $value->nama_kota;

	$row[] = $value->tgl_contact;

	$row[] = $value->nama_user;

	$row[] = $value->nama_toko;

	$row[] = $value->namaibu;

	$row[] = $value->namaanak;

	$row[] = $value->telp;

	$row[] = $value->ttl;

	$row[] = $value->tipe;

	if ($value->beli == "Y") {

		$row[] = "Beli";

	}
	elseif ($value->beli == "N") {

		$row[] = "Tidak Beli";

	}
	else{
		$row[] = $value->beli;
	}

	$row[] = $value->oldProduct;

	if ($value->sampling == "Y") {

		$row[] = "Ya";

	}
	elseif ($value->sampling == "N") {

		$row[] = "Tidak";

	}

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

if (count($datsa) == 0) {

	$output = array(

		"success" => "0",

              // "draw" => $_POST['draw'],

              // "recordsTotal" => $this->datatable->count_all($table,$column,$odb),

              // "recordsFiltered" => $this->datatable->count_filtered($table,$column,$odb),



		);

}

else{

	$output = array(

		"success" => "1",

              // "draw" => $_POST['draw'],

              // "recordsTotal" => $this->datatable->count_all($table,$column,$odb),

              // "recordsFiltered" => $this->datatable->count_filtered($table,$column,$odb),

		"data" => $datsa,

		);

}



echo json_encode($output);

}

else{

	$dataDas['title'] = "Contact Detail";

	$dataDas['desk'] = "App Retail";

	$dataDas['page'] = "contact/contact_detail";



	$dataDas['css'] = $this->sada->CssdataTable();

	$dataDas['js']  = $this->sada->JsdataTable();



	$dataDas['js'][]  = "assets/global/plugins/bootstrap/js/bootstrap.min.js";

	$dataDas['js'][]  = "assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js";

	$dataDas['js'][]  = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";



	$dataDas['js'][]  = "assets/global/scripts/app.min.js";

	$dataDas['js'][]  = "assets/pages/scripts/form-validation.min.js";

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

		// $dataDas['title'] = "Detail Contact";

		// $dataDas['desk'] = "";

		// $dataDas['page'] = "contact/contact_detail";

		// $dataDas['css'] = $this->sada->CssdataTable();

		// $dataDas['js']	= $this->sada->JsdataTable();

		// $dataDas['css'][]  	= "assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css";

		// $dataDas['css'][]  	= "assets/global/plugins/select2/css/select2-bootstrap.min.css";

		// $dataDas['css'][]	= "assets/global/plugins/select2/css/select2.min.css";

		// $dataDas['css'][]	= "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css";

		// $dataDas['css'][]	= "assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css";

		// $dataDas['css'][]	= "assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css";

		// $dataDas['js'][]	= "assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js";

		// $dataDas['js'][]	= "assets/pages/scripts/components-bootstrap-select.min.js";

		// $dataDas['js'][]	= "assets/custom/tagSelection.js";

		// $dataDas['js'][]	= "assets/custom/tagDate.js";

		// $dataDas['js'][]	= "assets/pages/scripts/components-select2.min.js";

		// $dataDas['js'][]	= "assets/global/plugins/select2/js/select2.full.min.js";

		// $dataDas['js'][]	= "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js";

		// $dataDas['js'][]	= "assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js";

		// $dataDas['js'][]	= "assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js";

		// $dataDas['js'][]	= "assets/pages/scripts/components-date-time-pickers.min.js";

		// $dataDas['js'][] ="assets/custom/select2Filter.js";

		// $dataDas['js'][] ="assets/custom/rDetailContact.js";



		// $this->load->view('view_awal', $dataDas, FALSE);

}





	//a



public function reporttotalcontact()

{

	if ($this->input->post()) {
		$this->load->model('datatable');


		$arr['tl'] = ($this->input->post("tl") == 0) ? "" : $this->input->post("tl");

		$arr['ba'] = ($this->input->post("ba") == 0) ? "" : $this->input->post("ba");

		$arr['toko'] = ($this->input->post("toko") == 0) ? "" : $this->input->post("toko");

		$arr['cabang'] = ($this->input->post("cabang") == 0) ? "" : $this->input->post("cabang");

		$arr['kota'] = ($this->input->post("kota") == 0) ? "" : $this->input->post("kota");

		$arr['startDate'] = date('Y-m-d H:i:s', strtotime($this->input->post("startDate")." 00:00:00"));

		$arr['endDate'] = date('Y-m-d H:i:s', strtotime($this->input->post("endDate")." 23:59:59"));

		$data = $this->sada->contactTotal($arr,$limit_excel="");
		
		$datas = array();
		$no = 1;
		foreach ($data->result() as $total_contact) {
			$row = array();
			$row[] = $total_contact->nama_cabang;

			$row[] = $total_contact->nama_ba;

			$row[] = $total_contact->stay;

			$row[] = $total_contact->customer_id;

			$row[] = $total_contact->nama_store;

			$row[] = date('d-m-Y',strtotime($total_contact->tgl_contact));
			
			$row[] = $total_contact->contact_count;

			$row[] = $total_contact->switching;

			$row[] = $total_contact->newRecruit;

			$row[] = $total_contact->sampling_bc;

			$row[] = $total_contact->sampling_bti;

			$row[] = $total_contact->sampling_rusk;

			$row[] = $total_contact->sampling_pudding;

			$row[] = $total_contact->sampling_others;

			$row[] = $total_contact->strike_bc;

			$row[] = $total_contact->strike_bti;
			
			$row[] = $total_contact->strike_rusk;

			$row[] = $total_contact->strike_pudding;

			$row[] = $total_contact->strike_others;

			$datas[] = $row;
		}
		$output = array(

			"data" => $datas,

			);

		echo json_encode($output);
		// print_r($this->input->post());
	}
	else{
		$dataDas['title'] 	= "Total Contact";

		$dataDas['desk'] 	= "";

		$dataDas['page'] 	= "contact/contact_total";

		$dataDas['css'] = $this->sada->CssdataTable();

		$dataDas['js']	= $this->sada->JsdataTable();



		$dataDas['js'][]  = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";



		$dataDas['js'][]  = "assets/global/scripts/app.min.js";

		$dataDas['js'][]  = "assets/pages/scripts/form-validation.min.js";



		$dataDas['css'][]  	= "assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css";

		$dataDas['css'][]  	= "assets/global/plugins/select2/css/select2-bootstrap.min.css";

		$dataDas['css'][]	= "assets/global/plugins/select2/css/select2.min.css";

		$dataDas['css'][]	= "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css";

		$dataDas['css'][]	= "assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css";

		$dataDas['css'][]	= "assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css";

		$dataDas['js'][]	= "assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js";

		$dataDas['js'][]	= "assets/pages/scripts/components-bootstrap-select.min.js";

		$dataDas['js'][]	= "assets/custom/tagSelection.js";

		$dataDas['js'][]	= "assets/custom/tagDate.js";

		$dataDas['js'][]	= "assets/pages/scripts/components-select2.min.js";

		$dataDas['js'][]	= "assets/global/plugins/select2/js/select2.full.min.js";

		$dataDas['js'][]	= "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js";

		$dataDas['js'][]	= "assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js";

		$dataDas['js'][]	= "assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js";

		$dataDas['js'][]	= "assets/pages/scripts/components-date-time-pickers.min.js";

		$dataDas['js'][] ="assets/custom/select2Filter.js";

		$dataDas['js'][] ="assets/custom/CountTotal.js";

		$this->load->view('view_awal', $dataDas, FALSE);
	}

}





	//a



public function reportpromo()

{

	if ($this->input->post()) {

		$this->load->model('datatable');

		// if ($this->input->post()) {



		$arr['tl'] = $this->input->post("tl");

		$arr['ba'] = $this->input->post("ba");

		$arr['toko'] = $this->input->post("toko");

		$arr['cabang'] = $this->input->post("cabang");

		$arr['kota'] = $this->input->post("kota");

		$arr['startDate'] = date('Y-m-d H:i:s', strtotime($this->input->post("startDate")." 00:00:00"));

		$arr['endDate'] = date('Y-m-d H:i:s', strtotime($this->input->post("endDate")." 23:59:59"));



		$select = "SELECT DISTINCT sada_promo.tipe,sada_promo.jenis,sada_promo.selesaiTanggal,CAST(sada_promo.timestamp AS DATE) timestamp,
		(

		SELECT

		GROUP_CONCAT(prom.awalTanggal SEPARATOR '\n')

		FROM

		sada_promo AS prom

		WHERE

		prom.tipe = sada_promo.tipe

		AND prom.jenis = sada_promo.jenis

		AND prom.user_id = sada_user.id_user

		AND prom.store_id = toko.id_toko

		AND date(prom.timestamp) = date(sada_promo.timestamp)

		) AS 'awalTanggal',
		(

		SELECT

		GROUP_CONCAT(prom.selesaiTanggal SEPARATOR '\n')

		FROM

		sada_promo AS prom

		WHERE

		prom.tipe = sada_promo.tipe

		AND prom.jenis = sada_promo.jenis

		AND prom.user_id = sada_user.id_user

		AND prom.store_id = toko.id_toko

		AND date(prom.timestamp) = date(sada_promo.timestamp)

		) AS 'selesaiTanggal',

		(

		SELECT

		GROUP_CONCAT(prom.merk SEPARATOR '\n')

		FROM

		sada_promo AS prom

		WHERE

		prom.tipe = sada_promo.tipe

		AND prom.jenis = sada_promo.jenis

		AND prom.user_id = sada_user.id_user

		AND prom.store_id = toko.id_toko

		AND date(prom.timestamp) = date(sada_promo.timestamp)

		) AS 'merk',

		(

		SELECT

		GROUP_CONCAT(prom.foto SEPARATOR ',')

		FROM

		sada_promo AS prom

		WHERE

		prom.merk LIKE '%romina%'

		AND prom.tipe = sada_promo.tipe

		AND prom.jenis = sada_promo.jenis

		AND prom.user_id = sada_user.id_user

		AND prom.store_id = toko.id_toko

		AND date(prom.timestamp) = date(sada_promo.timestamp)

		) AS 'promina_foto',

		(

		SELECT

		GROUP_CONCAT(prom.foto SEPARATOR ',')

		FROM

		sada_promo AS prom

		WHERE

		prom.merk NOT LIKE '%romina%'

		AND prom.tipe = sada_promo.tipe

		AND prom.jenis = sada_promo.jenis

		AND prom.user_id = sada_user.id_user

		AND prom.store_id = toko.id_toko

		AND date(prom.timestamp) = date(sada_promo.timestamp)

		) AS 'kompetitor_foto',

		(

		SELECT

		GROUP_CONCAT(prom.keterangan SEPARATOR '\n')

		FROM

		sada_promo AS prom

		WHERE

		prom.merk  LIKE '%romina%'

		AND prom.tipe = sada_promo.tipe

		AND prom.jenis = sada_promo.jenis

		AND prom.user_id = sada_user.id_user

		AND prom.store_id = toko.id_toko

		AND date(prom.timestamp) = date(sada_promo.timestamp)

		) AS 'keteranganPromina',

		(

		SELECT

		GROUP_CONCAT(prom.keterangan SEPARATOR '\n')

		FROM

		sada_promo AS prom

		WHERE

		prom.merk NOT LIKE '%romina%'

		AND prom.tipe = sada_promo.tipe

		AND prom.jenis = sada_promo.jenis

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

		
		";

		$join = "";

		// if ($arr['tl'] == 0) {

		// 	if ($arr['ba'] !=0) {

		// 		if ($arr['toko'] != 0) {

		// 			$where .= " AND toko.id_toko='".$arr['toko']."'";

		// 			if ($arr['cabang'] !=0) {

		// 				if ($arr['kota'] !=0) {

		// 					$where .= " AND cabang.id_cabang in (SELECT id_cabang FROM sada_kota WHERE id_cabang='".$arr['cabang']."')";

		// 				}

		// 				else{

		// 					$where .= " AND cabang.id_cabang='".$arr['cabang']."'";

		// 				}

		// 			}

		// 		}

		// 		else{

		// 			if ($arr['cabang'] != 0) {

		// 				$where .= " AND cabang.id_cabang in (SELECT id_cabang FROM sada_kota WHERE id_cabang='".$arr['cabang']."')";

		// 			}

		// 		}

		// 	}

		// }

		// else{

		// 	if ($arr['ba']==0) {

		// 		$select .= "";

		// 	}

		// }
	    $where = ($arr['ba'] == 0) ? '' : ' AND sada_user.id_user = "'.$arr['ba'].'"';
	    $where .= ($arr['toko'] == 0) ? '' : ' AND toko.id_toko = "'.$arr['toko'].'"';
	    $where .= ($arr['cabang'] == 0) ? '' : ' AND cabang.id_cabang = "'.$arr['cabang'].'"';
	    $where .= ($arr['kota'] == 0) ? '' : ' AND cabang.id_kota = "'.$arr['kota'].'"';

		$join .= " LEFT JOIN sada_toko toko ON sada_promo.store_id=toko.id_toko";

		$join .= " LEFT JOIN sada_kota kota ON toko.id_kota=kota.id_kota";

		$join .= " LEFT JOIN sada_cabang cabang ON kota.id_cabang=cabang.id_cabang";

		// $join .= " LEFT JOIN sada_tl_in_kota tl ON toko.id_toko = tl.id_toko";




		$select .= "

		cabang.nama AS 'nama_cabang',

		kota.nama_kota 'nama_kota'

		FROM sada_promo LEFT JOIN sada_user ON sada_promo.user_id=sada_user.id_user ".$join."
		WHERE CAST(sada_promo.timestamp AS DATE) BETWEEN '".$arr['startDate']."' and '".$arr['endDate']."' 
		 ".$where." ";

		  // echo $select;



		// echo $select;

		$table = "sada_user";

		$column = array('nik','nama','akses');

		$odb = array("id_user"=>"desc");

		$datas = $this->db->query($select);
			// echo $select;
		$data = array();

		$no = 1;

			// $no = $_POST['start'];

		foreach ($datas->result() as $datatable) {

			$row = array();

			$row[] = $no++;

			$row[] = $datatable->nama_cabang;

			$row[] = $datatable->nama_kota;

			$row[] = $datatable->store_id;

			$row[] = $datatable->nama_toko;

			$row[] = $datatable->nama_user;

			$tl_nama = $this->db->select('(select nama from sada_user where sada_user.id_user = sada_tl_in_kota.id_user) as tl_name')->where('id_toko',$datatable->id_toko)->get('sada_tl_in_kota');
			if (!$tl_nama->num_rows()>0) {
				$row[] = "<p class='alert alert-warning'><strong>Tidak Mempunyai TL</strong></p>";
			}
			else{
				$nam = $tl_nama->row();
		        // foreach ($tl_nama->result() as $n) {
				$row[] = $nam->tl_name;
		        // }
			}

			// if ($datatable->nama_tl == null) {
			// 	$row[] = "Tidak ada TL";
			// }
			// else{
			// 	// $row[] = "Under Constrouction";
			// 	$row[] = $datatable->nama_tl;
			// }

				// $row[] = "Under Constrouction";

			if ($datatable->tipe == "consumerPromo") {

				$row[] = "Consumer Promo";

			}

			if ($datatable->tipe == "secondaryDisplay") {

				$row[] = "Secondary Display";

			}

			if ($datatable->tipe == "activation") {

				$row[] = "Activation";

			}

			$row[] = $datatable->jenis;

			$row[] = $datatable->keteranganPromina;

			$row[] = $datatable->keteranganKomptetitor;

			$row[] = $datatable->awalTanggal;

			$row[] = $datatable->selesaiTanggal;

			$row[] = $datatable->merk;

			$row[] = $datatable->timestamp;

			$foto_promina = explode(',', $datatable->promina_foto);

			$promina_foto = "";
			foreach ($foto_promina as $key => $value) {

					// echo $value;
				$value = trim($value);
				if ($value == null) {
					$promina_foto .= "Foto Belum Ada";
				}
				else {
					$promina_foto .= "<img src='".base_url('')."assets/upload/".$value."' class='img-thumbnail'>";
				}

			}

			$row[] = $promina_foto;

			$foto_kompetitor = explode(',', $datatable->kompetitor_foto);

			$kompetitor_foto = "";
			foreach ($foto_kompetitor as $key => $values) {

					// echo $value;

				if ($values == null) {
					$kompetitor_foto .= "Foto Belum Ada";
				}
				else {
					$kompetitor_foto .= "<img src='".base_url('')."assets/upload/".$values."' class='img-thumbnail'>";
				}

			}

			$row[] = $kompetitor_foto;

				// $row[] = $datatable->nama;

				// $row[] = $datatable->nama;

				// $row[] = $datatable->nama;







			$data[] = $row;

		}



		$output = array(

							// "draw" => $_POST['draw'],

							// "recordsTotal" => $this->datatable->count_all($table,$column,$odb),

							// "recordsFiltered" => $this->datatable->count_filtered($table,$column,$odb),

			"data" => $data,

			);

		echo json_encode($output);

	}

	else{

		$dataDas['title'] = "Report Promo";

		$dataDas['desk'] = "App Retail";

		$dataDas['page'] = "promo/reportpromo";



		$dataDas['css'] = $this->sada->CssdataTable();

		$dataDas['js']	= $this->sada->JsdataTable();



		$dataDas['js'][]  = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";



		$dataDas['js'][]  = "assets/global/scripts/app.min.js";

		$dataDas['js'][]  = "assets/pages/scripts/form-validation.min.js";



		$dataDas['css'][]  	= "assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css";

		$dataDas['css'][]  	= "assets/global/plugins/select2/css/select2-bootstrap.min.css";

		$dataDas['css'][]	= "assets/global/plugins/select2/css/select2.min.css";

		$dataDas['css'][]	= "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css";

		$dataDas['css'][]	= "assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css";

		$dataDas['css'][]	= "assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css";

		$dataDas['js'][]	= "assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js";

		$dataDas['js'][]	= "assets/pages/scripts/components-bootstrap-select.min.js";

		$dataDas['js'][]	= "assets/custom/tagSelection.js";

		$dataDas['js'][]	= "assets/custom/tagDate.js";

		$dataDas['js'][]	= "assets/pages/scripts/components-select2.min.js";

		$dataDas['js'][]	= "assets/global/plugins/select2/js/select2.full.min.js";

		$dataDas['js'][]	= "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js";

		$dataDas['js'][]	= "assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js";

		$dataDas['js'][]	= "assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js";

		$dataDas['js'][]	= "assets/pages/scripts/components-date-time-pickers.min.js";

		$dataDas['js'][]	= "https://code.jquery.com/jquery-1.10.2.js";

		$dataDas['js'][] ="assets/custom/select2Filter.js";

		$dataDas['js'][] ="assets/custom/CountTotal.js";



		$dataDas['js'][]	= "assets/custom/DataPromo.js";

		$this->load->view('view_awal', $dataDas, FALSE);

	}

}





	//report Out Of Stock

public function reportOutOfStock()

{
	$this->load->library("Carbon");

	$dataDas['title'] = "Out Of Stock Report";

	$dataDas['desk'] = "App Retail";

	$dataDas['page'] = "report/outOfStock";

	$dataDas['js'][]  = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";



	$dataDas['js'][]  = "assets/global/scripts/app.min.js";

	$dataDas['js'][]  = "assets/pages/scripts/form-validation.min.js";

	$dataDas['css'][]  	= "assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css";

	$dataDas['css'][]  	= "assets/global/plugins/select2/css/select2-bootstrap.min.css";

	$dataDas['css'][]	= "assets/global/plugins/select2/css/select2.min.css";

	$dataDas['css'][]	= "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css";

	$dataDas['css'][]	= "assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css";

	$dataDas['css'][]	= "assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css";

	$dataDas['css'][]	= "assets/global/plugins/datatables/datatables.min.css";

	$dataDas['css'][]	= "assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css";

	$dataDas['js'][]	= "assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js";

	$dataDas['js'][]	= "assets/global/scripts/datatable.js";

	$dataDas['js'][]	= "assets/global/plugins/datatables/datatables.min.js";

	$dataDas['js'][]	= "assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js";

	$dataDas['js'][]	= "assets/pages/scripts/table-datatables-managed.min.js";

	$dataDas['js'][]	= "assets/custom/tagSelection.js";

	$dataDas['js'][]	= "assets/custom/tagDate.js";

	$dataDas['js'][]	= "assets/pages/scripts/components-select2.min.js";

	$dataDas['js'][]	= "assets/global/plugins/select2/js/select2.full.min.js";

	$dataDas['js'][]	= "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js";

	$dataDas['js'][]	= "assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js";

	$dataDas['js'][]	= "assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js";

	$dataDas['js'][]	= "assets/pages/scripts/components-date-time-pickers.min.js";

	$dataDas['js'][] ="assets/custom/select2FilterOutOfStock.js";





	$this->load->view('view_awal', $dataDas, FALSE);

}




public function aktifitasUser()
{
	if ($this->input->post()) {
		$date = array('startDate' => date('Y-m-d H:i:s', strtotime($this->input->post('startDate')." 00:00:00")),
			'endDate' => date('Y-m-d H:i:s', strtotime($this->input->post('endDate')." 23:59:59")));

		$monthAgo = new DateTime($date['startDate']);
		$monthAgo->modify('-1 month');
		$monthAgoEnd = new DateTime($date['endDate']);
		$monthAgoEnd->modify('-1 month');
		$startDateMonthAgo = $monthAgo->format('Y-m-d H:i:s');
		$endDateMonthAgo = $monthAgoEnd->format('Y-m-d H:i:s');

		$data = $this->sada->getTopSku($date['startDate'],$date['endDate'],$startDateMonthAgo,$endDateMonthAgo);

		echo json_encode($data,JSON_PRETTY_PRINT);
	}
	else{
		$dataDas['title'] = "User Activity";
		$dataDas['desk'] = "App Retail";
		$dataDas['page'] = "users/userActivity";
		$dataDas['js'][] = "assets/global/plugins/bootstrap/js/bootstrap.min.js";
		$dataDas['js'][] = "assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js";
		$dataDas['js'][] = "assets/global/plugins/jquery-validation/js/jquery.validate.min.js";

		$dataDas['js'][] = "assets/global/scripts/app.min.js";
		$dataDas['js'][] = "assets/pages/scripts/form-validation.min.js";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css";
		$dataDas['css'][] = "assets/global/plugins/select2/css/select2-bootstrap.min.css";
		$dataDas['css'][] = "assets/global/plugins/select2/css/select2.min.css";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css";
		$dataDas['css'][] = "assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css";
		$dataDas['css'][] = "assets/global/plugins/datatables/datatables.min.css";
		$dataDas['css'][] = "assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css";
		$dataDas['js'][] = "assets/global/scripts/datatable.js";
		$dataDas['js'][] = "assets/global/plugins/datatables/datatables.min.js";
		$dataDas['js'][] = "assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js";
		$dataDas['js'][] = "assets/pages/scripts/table-datatables-managed.min.js";
		$dataDas['js'][] = "assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js";
		$dataDas['js'][] = "assets/pages/scripts/components-bootstrap-select.min.js";
		$dataDas['js'][] = "assets/custom/tagSelection.js";
		$dataDas['js'][] = "assets/custom/tagDate.js";
		$dataDas['js'][] = "assets/pages/scripts/components-select2.min.js";
		$dataDas['js'][] = "assets/global/plugins/select2/js/select2.full.min.js";
		$dataDas['js'][] = "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js";
		$dataDas['js'][] = "assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js";
		$dataDas['js'][] = "assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js";
		$dataDas['js'][] = "assets/pages/scripts/components-date-time-pickers.min.js";
		// $dataDas['js'][] = "assets/custom/topStockFilter.js";
		$dataDas['js'][] = "assets/custom/userActivity.js";
		$this->load->view('view_awal', $dataDas, FALSE);
	}
}






/*END*/

















}



/* End of file Dashboard.php */

/* Location: ./application/controllers/Dashboard.php */


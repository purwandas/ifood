<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->akses->cek_login();
		$this->load->library('Recaptcha');
	}
	public function test($x='')
	{
		$d =  trim(rawurldecode($x));

		$c = "MXwwMDF8YmU4NTBhMmQxM2RiNGZmNDI5YzE2NmFmYjNhMmY1Mjg= ";
		echo strlen($d);
		// echo '<body style="background:black;"><p style="color:white;">';
		// echo $d.'</p><p style="color:white;">'.$c.'</p>';
		//echo $d;
		//if ($this->sada->is_Base64(rawurldecode($x))==true) {
		//	echo "iya";
		//}else{
		//	echo "enga";
		//}
	}

	public function index()
	{
		// return response()->json('as');
		if ($this->input->post()) {

			// dd('ads');

			/*CEK TOKEN*/

			if ($this->input->post('xxx')==$this->akses->csrf_token("login")) {
				// $recaptcha = $this->input->post('g-recaptcha-response');
    //    			$response = $this->recaptcha->verifyResponse($recaptcha);
				// if (isset($response['success']) AND $response['success']== true) { /*GOOLE RECAPCAH*/
					$data['nik']		= htmlentities($this->input->post('nik',TRUE));
					$data['password'] 	= htmlentities(md5($this->input->post('password',TRUE)));
					$data['akses']		= '2';
					$data['status']		= "Y";

					// $query = $this->db->get_where('sada_user', $data);
					$query = $this->db->query("SELECT * from sada_user WHERE nik='".$data['nik']."' AND  password='".$data['password']."' AND
						 akses IN ('2','3') AND
						  status='".$data['status']."'");
					/*CEK USER*/
					if ($query->num_rows() == 1) {
						$row = $query->row();
						$datSession['id_user'] =  $row->id_user;
						$datSession['isLogin'] =  TRUE;
						$datSession['nama_user'] =  $row->nama;
						$datSession['akses'] =  $row->akses;

						$this->session->set_userdata('userdata',$datSession);
						$this->session->set_flashdata('info','Sukses Login Sebagai Admin, Selamat datang MR/MRs.'.$row->nama);
						redirect('','refresh');
						
						// redirect('Dashboard/keterangan_oos');

					}else{ /*USER GAGAL*/
						$this->session->set_flashdata('danger','User Tidak Terdaftar');
					
						redirect('login');
					}
				// }else{ //VERTIVIKASI CAPCAH GAGA:
				// 	$this->session->set_flashdata('danger','please verify the captcha');
				// 	redirect('login');
				// }



			}else{ //tooken udah usang
				$this->session->set_flashdata('danger','Token sudah usang');
				redirect('login');
			}



		}else{
			$data =  array(
					'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
            		'script_captcha' => $this->recaptcha->getScriptTag()
				);
			$this->load->view('page/login',$data, FALSE);
		}
	}



	public function LoginMobile()
	  {
	    $data = (array)json_decode(file_get_contents('php://input'));
	    if (@$data['Nik']&&@$data['password']&&@$data['Store_id']) {
	      $this->sada->_getLoginMobile($data);
	    }else{
	      $response = array(
	        'Success' => false,
	        'Info' => 'Data Ada Yang Kosong');

	      $this->output
	        ->set_status_header(201)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	        ->_display();
	        exit;
	    }
  }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
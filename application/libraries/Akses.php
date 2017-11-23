<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
        
	}

	public function cek_akses()
	{
		$this->sesi  = $this->ci->session->userdata('isLogin');
		$this->hak = $this->ci->session->userdata('akses');
		// echo "<script>alert('".$this->sesi."');</script>";
		if($this->sesi != TRUE){
			redirect('login','refresh');
			exit();
		}
	}


	public function cek_login()
	{
		$this->sesi  = $this->ci->session->userdata('isLogin');
		$this->hak = $this->ci->session->userdata('akses');
		if($this->sesi == TRUE){
			redirect('','refresh');
			exit();
		}
	}

	public function hak_akses($kecuali="")
	{	
    	if($this->hak==$kecuali){ 
    		echo "<script>alert('Anda tidak berhak mengakses halaman ini!');</script>";
    		redirect('dashboard');
    	}elseif ($this->hak=="") {
    		echo "<script>alert('Anda belum login!');</script>";
    		redirect('login');
    	}else{
 
    	}
	}

	public function csrf_token($x='')
	{
		if ($x) {
			return md5("Mutahzc0de".$x.date('dYH'));
		}else{
			return md5("Mutahzc0de".date('dmYH'));
		}
	}

	public function isIndofood()
	{
		if ($this->ci->session->userdata("akses") == "3") {
			echo "display:none;";
		}
	}

	/*NUMPANG*/


	/*END NUMPANG*/
	

}

/* End of file Akses.php */
/* Location: ./application/libraries/Akses.php */

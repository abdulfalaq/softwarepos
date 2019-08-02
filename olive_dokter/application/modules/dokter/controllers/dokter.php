<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dokter extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
		$user=$this->session->userdata('astrosession');
		if($user->jabatan!='J_0006' && $user->jabatan!='J_0004' && $user->jabatan!='J_0005'){
			redirect(base_url('authenticate'));	
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('data_dokter/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}


	public function logout()
	{
		$this->session->unset_userdata('astrosession');
		$this->session->sess_destroy();
		clearstatcache();
		redirect($this->cname);
	}


}

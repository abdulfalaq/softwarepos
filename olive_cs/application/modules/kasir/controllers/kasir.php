<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kasir extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
           $data['konten'] = $this->load->view('tambah_kasir', NULL, TRUE);
           $this->load->view ('admin/main', $data);
	}
	public function tambah_kasir()
	{
           $data['konten'] = $this->load->view('kasir', NULL, TRUE);
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

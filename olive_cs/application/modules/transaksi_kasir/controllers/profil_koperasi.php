<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profil_koperasi extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
           $data['konten'] = $this->load->view('profil_koperasi/profil_koperasi', NULL, TRUE);
           $this->load->view ('admin/main', $data);
	}
}

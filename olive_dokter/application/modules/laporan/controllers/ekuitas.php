<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ekuitas extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
           $data['konten'] = $this->load->view('ekuitas/laporan', NULL, TRUE);
           $this->load->view ('admin/main', $data);
	}
}

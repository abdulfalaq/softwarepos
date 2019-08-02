<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class record_produksi extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('record_produksi/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function daftar()
	{
		$data['konten'] = $this->load->view('record_produksi/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('record_produksi/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	
}

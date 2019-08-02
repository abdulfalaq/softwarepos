<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan extends MY_Controller {


	public function index()
	{
		$data['konten'] = $this->load->view('laporan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('laporan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

}

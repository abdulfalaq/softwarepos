<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_new_member extends MY_Controller {


	public function index()
	{

		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('laporan_new_member/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function load_data_cari(){
		$this->load->view('laporan_new_member/table_data_cari');
	}
}

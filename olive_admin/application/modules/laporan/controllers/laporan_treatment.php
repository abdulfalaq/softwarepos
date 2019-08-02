<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_treatment extends MY_Controller {


	public function index()
	{

		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('laporan_treatment/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah()
	{
		$data['konten'] = $this->load->view('laporan_treatment/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('laporan_treatment/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('laporan_treatment/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_data()
	{
		$this->load->view('laporan_treatment/cari_data');
	}
	public function print_data()
	{
		$this->load->view('laporan_treatment/print_data');
	}
	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_analisa_market extends MY_Controller {


	public function index()
	{

		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('laporan_analisa_market/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah()
	{
		$data['konten'] = $this->load->view('laporan_analisa_market/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('laporan_analisa_market/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('laporan_analisa_market/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_data()
	{
		$this->load->view('laporan_analisa_market/cari_data');
		
	}

	public function print_perlengkapan()
	{
		$this->load->view('laporan_analisa_market/cetak_perlengkapan');
	}
	
}

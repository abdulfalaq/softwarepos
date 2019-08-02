<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_produksi_keluar extends MY_Controller {


	public function index()
	{

		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('laporan_produksi_keluar/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah()
	{
		$data['konten'] = $this->load->view('laporan_produksi_keluar/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('laporan_produksi_keluar/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function load_data_cari(){
		$this->load->view('laporan_produksi_keluar/load_table_cari');
	}
	public function print_produksi_keluar()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$this->load->view('laporan_produksi_keluar/cetak_perlengkapan');
	}
	public function detail()
	{
		$data['konten'] = $this->load->view('laporan_produksi_keluar/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_data()
	{
		$this->load->view('laporan_produksi_keluar/cari_data');
	}
	public function print_data()
	{
		$this->load->view('laporan_produksi_keluar/print_data');
	}

	public function print_perlengkapan()
	{
		$this->load->view('laporan_produksi_keluar/cetak_perlengkapan');
	}
}

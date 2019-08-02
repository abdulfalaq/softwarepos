<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_stok_produk extends MY_Controller {


	public function index()
	{
		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('laporan_stok_produk/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$data['konten'] = $this->load->view('laporan_stok_produk/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function print_stok_produk()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$this->load->view('laporan_stok_produk/cetak_stok_produk');
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('laporan_stok_produk/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('laporan_stok_produk/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function load_data_cari(){
		$this->load->view('laporan_stok_produk/load_table_cari');
	}

}

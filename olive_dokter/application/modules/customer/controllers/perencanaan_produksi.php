<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class perencanaan_produksi extends MY_Controller {


	public function index()
	{
		$data['konten'] = $this->load->view('setting', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('perencanaan_produksi/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$data['konten'] = $this->load->view('perencanaan_produksi/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('perencanaan_produksi/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('perencanaan_produksi/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

}

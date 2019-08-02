<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class akun_supplier extends MY_Controller {


	public function index()
	{
		$data['konten'] = $this->load->view('setting', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('akun_supplier/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$data['konten'] = $this->load->view('akun_supplier/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('akun_supplier/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function personal_data()
	{
		$data['konten'] = $this->load->view('akun_supplier/personal_data', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function hutang()
	{
		$data['konten'] = $this->load->view('akun_supplier/hutang', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function record()
	{
		$data['konten'] = $this->load->view('akun_supplier/record', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('akun_supplier/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail2()
	{
		$data['konten'] = $this->load->view('akun_supplier/detail2', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
}

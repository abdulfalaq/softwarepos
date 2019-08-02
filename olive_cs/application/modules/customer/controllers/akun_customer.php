<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class akun_customer extends MY_Controller {


	public function index()
	{
		$data['konten'] = $this->load->view('setting', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('akun_customer/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$data['konten'] = $this->load->view('akun_customer/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function record_transaksi()
	{
		$data['konten'] = $this->load->view('akun_customer/record_transaksi', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function record_transaksi_2()
	{
		$data['konten'] = $this->load->view('akun_customer/record_transaksi_2', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function rekam_medis()
	{
		$data['konten'] = $this->load->view('akun_customer/rekam_medis', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function profil()
	{
		$data['konten'] = $this->load->view('akun_customer/profil', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('akun_customer/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('akun_customer/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class layanan_paket extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('layanan_paket', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function daftar()
	{
		$data['konten'] = $this->load->view('layanan_paket', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail_paket()
	{
		$data['konten'] = $this->load->view('detail_paket', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
}
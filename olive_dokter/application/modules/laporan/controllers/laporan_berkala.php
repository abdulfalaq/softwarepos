<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_berkala extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function bulanan()
	{
		$data['konten'] = $this->load->view('laporan/laporan_berkala/bulanan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_bulanan()
	{
		$this->load->view('laporan/laporan_berkala/cari_bulanan');
	}
	public function triwulan()
	{
		$data['konten'] = $this->load->view('laporan/laporan_berkala/triwulan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_triwulan()
	{
		$this->load->view('laporan/laporan_berkala/cari_triwulan');
	}
	public function tahunan()
	{
		$data['konten'] = $this->load->view('laporan/laporan_berkala/tahunan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_tahunan()
	{
		$this->load->view('laporan/laporan_berkala/cari_tahunan');
	}

}

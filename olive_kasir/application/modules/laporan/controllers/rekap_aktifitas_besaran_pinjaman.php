<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rekap_aktifitas_besaran_pinjaman extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
           $data['konten'] = $this->load->view('besaran_pinjaman/daftar_anggota', NULL, TRUE);
           $this->load->view ('admin/main', $data);
	}
	public function detail_laporan()
	{
           $data['konten'] = $this->load->view('besaran_pinjaman/laporan', NULL, TRUE);
           $this->load->view ('admin/main', $data);
	}
	public function cari_bersaran_pinjaman()
	{
        $this->load->view('besaran_pinjaman/cari_bersaran_pinjaman');
	}
}

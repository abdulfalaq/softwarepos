<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stok_persediaan extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('persediaan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function daftar()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('stok_perlengkapan/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('stok_perlengkapan/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_pembelian extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
		$this->db_master = $this->load->database('kan_master', TRUE);
		$this->db_kasir = $this->load->database('kan_kasir', TRUE);
	}

	public function index()
	{
		$data['konten'] = $this->load->view('laporan_pembelian/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function filtering_report()
	{
		$this->load->view('laporan_pembelian/data_filter');		
	}
	public function print_out_data()
	{
		$this->load->view('laporan_pembelian/print');		
	}
}

/* End of file laporan_pembelian.php */
/* Location: ./application/modules/laporan/controllers/laporan_pembelian.php */
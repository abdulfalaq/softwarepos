<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_hutang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
		$this->db_kasir = $this->load->database('kan_kasir', TRUE);
		$this->db_master = $this->load->database('kan_master', TRUE);
	}

	public function index()
	{
		$data['konten'] = $this->load->view('laporan_hutang/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function filtering_report()
	{
		$this->load->view('laporan_hutang/data_filter');		
	}
	public function print_out_data()
	{
		$this->load->view('laporan_hutang/print');		
	}

}

/* End of file laporan_hutang.php */
/* Location: ./application/modules/laporan/controllers/laporan_hutang.php */
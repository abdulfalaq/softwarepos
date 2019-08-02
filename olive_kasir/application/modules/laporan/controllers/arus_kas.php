<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class arus_kas extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
           $data['konten'] = $this->load->view('arus_kas/laporan', NULL, TRUE);
           $this->load->view ('admin/main', $data);
	}
	public function cari_kas()
	{
           $this->load->view('arus_kas/cari_kas');
           
	}
	public function print_kas()
	{
           $this->load->view('arus_kas/print_kas');
           
	}
}

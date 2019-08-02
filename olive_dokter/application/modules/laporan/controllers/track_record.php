<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track_record extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('track/track_record', NULL, TRUE);
		$this->load->view ('admin/main', $data);	
	}
	public function cari_track()
	{
		$this->load->view('track/cari_track');
	}

}

/* End of file track_record.php */
/* Location: ./application/modules/laporan/controllers/track_record.php */
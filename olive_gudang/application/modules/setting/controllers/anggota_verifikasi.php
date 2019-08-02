<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class anggota_verifikasi extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
		$this->load->library('form_validation');
	}

	public function index()
	{
       $data['konten'] = $this->load->view('anggota/verifikasi', NULL, TRUE);
       $this->load->view ('admin/main', $data);
	}



	public function detail()
	{
       $data['konten'] = $this->load->view('anggota/detail_anggota', NULL, TRUE);
       $this->load->view ('admin/main', $data);
	}

	public function verifikasi()
	{
		$this->form_validation->set_rules('id','ID verifikasi','required');

		if($this->form_validation->run() == FALSE){
			echo validation_errors();
		}else{
			$id = $this->input->post('id');
			$this->db->where('id',$id);
			$data['status_pinjaman'] = 'validasi';
			$this->db->update('data_anggota',$data);
			echo "ok";
		}
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class akun_customer extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}

		$this->db_master = $this->load->database('olive_master', TRUE);
		$this->db_kasir = $this->load->database('olive_kasir', TRUE);
	}

	public function index()
	{
		$data['konten'] = $this->load->view('akun_customer', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function logout()
	{
		$this->session->unset_userdata('astrosession');
		$this->session->sess_destroy();
		clearstatcache();
		redirect($this->cname);
	}


	public function get_data_member(){
		$id = $this->input->post('id');

		$this->db_master->where('id', $id);
		$get_member = $this->db_master->get('master_member')->row_array();
		$get_member['hbd'] = tanggalIndo($get_member['tanggal_lahir']);
		echo json_encode($get_member);
	}


	public function table_rekam_medis(){
		$this->load->view('table_rekam_medis');
	}

	public function table_record_transaksi(){
		$this->load->view('table_record_transaksi');
	}
	
}

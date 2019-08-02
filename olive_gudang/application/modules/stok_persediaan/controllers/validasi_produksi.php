<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class validasi_produksi extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('validasi_produksi/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah()
	{
		$data['konten'] = $this->load->view('validasi_produksi/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('validasi_produksi/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function validasi()
	{
		$data['konten'] = $this->load->view('validasi_produksi/validasi', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function validasi_status(){
		$post = $this->input->post();
		$kode_produksi = $post['kode_produksi'];

		$this->db->where('kode_produksi', $kode_produksi);
		$get_opsi = $this->db->get('opsi_transaksi_produksi')->result();

		foreach($get_opsi as $daftar){
			$update_opsi['status_rilis'] = $post['status_rilis'.$daftar->id_opsi];

			$this->db->where('id_opsi', $daftar->id_opsi);
			$this->db->update('opsi_transaksi_produksi', $update_opsi);
		}

		$update_produksi['status'] = 'valid';
		$this->db->where('kode_produksi', $kode_produksi);
		$this->db->update('transaksi_produksi', $update_produksi);
		
	}

	
	
}

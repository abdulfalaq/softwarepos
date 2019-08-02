<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stok_bahan extends MY_Controller {


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
		$data['konten'] = $this->load->view('stok_bahan/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}



	public function tambah()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('stok_bahan/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('stok_bahan/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('stok_bahan/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}



	public function act_simpan()
	{	
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['kode'] 					= trim($this->input->post('kode'));
		$data['nominal_simpanan_wajib'] = trim($this->input->post('nominal'));
		$data['tanggal_aktivasi'] 		= trim($this->input->post('tanggal_aktivasi'));

		$this->db->insert('master_simpanan_wajib',$data);
		echo "success";
	}

	public function act_update()
	{			
		$this->db2 = $this->load->database('olive_master', TRUE);	
		$data['kode'] 					= trim($this->input->post('kode'));
		$data['nominal_simpanan_wajib'] = trim($this->input->post('nominal'));
		$data['tanggal_aktivasi'] 		= trim($this->input->post('tanggal_aktivasi'));

		$id = $this->input->post('id');
		$this->db->where(array('id'=>$id));
		$this->db->update('master_simpanan_wajib',$data);
		echo "success";
	}

	public function act_delete()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$id = $this->input->post('id');
		$this->db->where(array('id'=>$id));
		$this->db->delete('master_simpanan_wajib');
		echo "delete";
	}

	public function print_perlengkapan()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$this->load->view('stok_bahan/cetak_perlengkapan');
	}
}

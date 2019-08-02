<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pendaftaran_supplier extends MY_Controller {


	public function index()
	{
		$data['konten'] = $this->load->view('setting', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('pendaftaran_supplier/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$this->db2 = $this->load->database('olive_master',TRUE);
		$data['konten'] = $this->load->view('pendaftaran_supplier/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('pendaftaran_supplier/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('pendaftaran_supplier/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function simpan_tambah()
	{
		$this->db2 = $this->load->database('olive_master',TRUE);
		$input = $this->input->post();
		$insert = $this->db2->insert('master_supplier',$input);

		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
	public function hapus_supplier(){
		$this->db2 = $this->load->database('olive_master', TRUE);
		$kode_supplier = $this->input->post('kode_supplier');
		$this->db2->delete('master_supplier', array('kode_supplier' => $kode_supplier ));

	}
	public function simpan_edit()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$input = $this->input->post();
		$insert = $this->db2->update('master_supplier',$input,array('kode_supplier' =>$input['kode_supplier']));
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}

	public function cek_kode_promo(){
		$this->db2 = $this->load->database('olive_master', TRUE);
		$kode_supplier = $this->input->post('kode_supplier');
		$get = $this ->db2 ->get_where('master_supplier', array('kode_supplier' =>$kode_supplier));
		$peringatan = $get->row();
		if(empty($peringatan)){
			$data['peringatan']='kosong';
		}else{
			$data['peringatan']='ada';
		}

		echo json_encode($data);

	}

}

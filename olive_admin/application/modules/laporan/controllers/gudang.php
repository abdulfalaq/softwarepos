<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class gudang extends MY_Controller {


	public function index()
	{
		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$data['konten'] = $this->load->view('gudang/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$data['konten'] = $this->load->view('gudang/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$data['konten'] = $this->load->view('gudang/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$data['konten'] = $this->load->view('gudang/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function simpan_member()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$input = $this->input->post();
		$insert = $this->db2->insert('master_gudang',$input);
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
	public function hapus_gudang(){

		$this->db2 = $this->load->database('master', TRUE);
		$kode_gudang = $this->input->post('kode_gudang');
		$this->db2->delete('master_gudang', array('kode_gudang' => $kode_gudang ));

	}
	public function update_member()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$input = $this->input->post();
		$insert = $this->db2->update('master_gudang',$input,array('kode_gudang' =>$input['kode_gudang']));
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class master_peralatan extends MY_Controller {


	public function index()
	{
		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$data['konten'] = $this->load->view('master_peralatan/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$data['konten'] = $this->load->view('master_peralatan/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$data['konten'] = $this->load->view('master_peralatan/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$data['konten'] = $this->load->view('master_peralatan/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function simpan_member()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$input = $this->input->post();
		$insert = $this->db2->insert('master_peralatan',$input);
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
	public function update_member()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$input = $this->input->post();
		$insert = $this->db2->update('master_peralatan',$input,array('kode_peralatan' =>$input['kode_peralatan']));
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
	public function hapus_gudang(){

		$this->db2 = $this->load->database('master', TRUE);
		$kode_peralatan = $this->input->post('kode_peralatan');
		$this->db2->delete('master_peralatan', array('kode_peralatan' => $kode_peralatan ));

	}

}

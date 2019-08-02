<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class semen_beku extends MY_Controller {


	public function index()
	{
		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$data['konten'] = $this->load->view('semen_beku/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$data['konten'] = $this->load->view('semen_beku/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$data['konten'] = $this->load->view('semen_beku/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$data['konten'] = $this->load->view('semen_beku/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function simpan_member()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$input = $this->input->post();
		$insert = $this->db2->insert('master_Semen_beku',$input);
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
	public function hapus_gudang(){

		$this->db2 = $this->load->database('master', TRUE);
		$kode_semen_beku = $this->input->post('kode_semen_beku');
		$this->db2->delete('master_Semen_beku', array('kode_semen_beku' => $kode_semen_beku ));

	}
	public function update_member()
	{
		$this->db2 = $this->load->database('master', TRUE);
		$input = $this->input->post();
		$insert = $this->db2->update('master_Semen_beku',$input,array('kode_semen_beku' =>$input['kode_semen_beku']));
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
}

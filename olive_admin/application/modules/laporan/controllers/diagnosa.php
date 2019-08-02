<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class diagnosa extends MY_Controller {


	public function index()
	{
		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$this->db_master = $this->load->database('master',TRUE);
		$data['konten'] = $this->load->view('diagnosa/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah()
	{
		$this->db_master = $this->load->database('master',TRUE);
		$data['konten'] = $this->load->view('diagnosa/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$this->db_master = $this->load->database('master',TRUE);
		$data['konten'] = $this->load->view('diagnosa/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$this->db_master = $this->load->database('master',TRUE);
		$data['konten'] = $this->load->view('diagnosa/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function simpan_diagnosa()
	{
		$this->db_master = $this->load->database('master',TRUE);
		$input = $this->input->post();
		$insert = $this->db_master->insert('master_diagnosa_penyakit',$input);
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
	public function update_diagnosa()
	{
		$this->db_master = $this->load->database('master',TRUE);
		$input = $this->input->post();
		$this->db_master->where('kode_diagnosa_penyakit', $input['kode_diagnosa_penyakit']);
		$insert = $this->db_master->update('master_diagnosa_penyakit',$input);

		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}
		echo json_encode($data);

	}
	public function hapus_diagnosa(){
		$this->db_master = $this->load->database('master',TRUE);
		$kode_diagnosa_penyakit = $this->input->post('kode_diagnosa_penyakit');
		$this->db_master->delete('master_diagnosa_penyakit', array('kode_diagnosa_penyakit' => $kode_diagnosa_penyakit ));

	}
}

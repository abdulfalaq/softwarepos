<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class poin extends MY_Controller {


	public function index()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('setting', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('poin/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('poin/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('poin/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('poin/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function update_poin()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$input = $this->input->post();
		$insert = $this->db2->update('setting_poin',$input);
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
	public function get_nomin()
	{   
		$nominal = $this->input->post('nominal');   
		
		echo @format_rupiah($nominal);
		
	}

}

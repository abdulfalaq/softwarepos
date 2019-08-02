<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class redem_poin extends MY_Controller {


	public function index()
	{
		$this->olive_master = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('setting', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$this->olive_master = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('redem_poin/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$this->olive_master = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('redem_poin/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$this->olive_master = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('redem_poin/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$this->olive_master = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('redem_poin/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function simpan()
	{
		$this->olive_master = $this->load->database('olive_master', TRUE);
		$data = $this->input->post();
		$isi= $this->olive_master->insert('master_redem_poin',$data);
		if ($isi) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}

	public function update()
	{
		$this->olive_master = $this->load->database('olive_master', TRUE);
		$data = $this->input->post();	
		$this->olive_master->where('id', $data['id']);	
		$isi = $this->olive_master->update('master_redem_poin',$data);
		if ($isi) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}

	public function hapus()
	{
		$this->olive_master = $this->load->database('olive_master', TRUE);
		$id = $this->input->post('id');
		$this->olive_master->delete('master_redem_poin', array('id' => $id ));

	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_laba_rugi extends MY_Controller {

	public function index()
	{
		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		
		$data['konten'] = $this->load->view('laporan_laba_rugi/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		
		$data['konten'] = $this->load->view('laporan_laba_rugi/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		
		$data['konten'] = $this->load->view('laporan_laba_rugi/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		
		$data['konten'] = $this->load->view('laporan_laba_rugi/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function simpan()
	{
		
		$data = $this->input->post();		
		$isi = $this->db2->insert('laporan_laba_rugi',$data);
		if ($isi) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
	public function update_data()
	{
		
		$data = $this->input->post();	
		$this->db2->where('kode_obat', $data['kode_obat']);	
		$isi = $this->db2->update('laporan_laba_rugi',$data);
		if ($isi) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
	public function hapus_data(){
		
		$kode_obat = $this->input->post('kode_obat');
		$this->db2->delete('laporan_laba_rugi', array('kode_obat' => $kode_obat ));

	}

	public function print_perlengkapan()
	{
		$this->load->view('laporan_laba_rugi/cetak_perlengkapan');
	}
	public function cari_data()
	{
		$this->load->view('laporan_laba_rugi/cari_data');
	}
}

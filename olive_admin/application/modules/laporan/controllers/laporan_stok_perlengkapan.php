<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_stok_perlengkapan extends MY_Controller {

	public function index()
	{
		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		
		$data['konten'] = $this->load->view('laporan_stok_perlengkapan/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		
		$data['konten'] = $this->load->view('laporan_stok_perlengkapan/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		
		$data['konten'] = $this->load->view('laporan_stok_perlengkapan/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function print_stok_perlengkapan()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$this->load->view('laporan_stok_perlengkapan/cetak_stok_perlengkapan');
	}

	public function detail()
	{
		
		$data['konten'] = $this->load->view('laporan_stok_perlengkapan/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function simpan()
	{
		
		$data = $this->input->post();		
		$isi = $this->db2->insert('laporan_stok_perlengkapan',$data);
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
		$isi = $this->db2->update('laporan_stok_perlengkapan',$data);
		if ($isi) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
	public function hapus_data(){
		
		$kode_obat = $this->input->post('kode_obat');
		$this->db2->delete('laporan_stok_perlengkapan', array('kode_obat' => $kode_obat ));

	}

	public function load_data_cari(){
		$this->load->view('laporan_stok_perlengkapan/load_table_cari');
	}
}

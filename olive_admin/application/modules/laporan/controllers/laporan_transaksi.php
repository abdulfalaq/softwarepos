<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_transaksi extends MY_Controller {


	public function index()
	{
		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('laporan_transaksi/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$data['konten'] = $this->load->view('laporan_transaksi/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('laporan_transaksi/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('laporan_transaksi/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function simpan()
	{
		$input = $this->input->post();
		$insert = $this->db_master->insert('laporan_transaksi',$input);
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
	public function update_pelayanan()
	{
		$input = $this->input->post();
		$this->db_master->where('id', $input['id']);
		$insert = $this->db_master->update('laporan_transaksi',$input);
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
	public function hapus_pelayanan()
	{
		$kode_gudang = $this->input->post('id');
		$this->db_master->delete('laporan_transaksi', array('id' => $kode_gudang ));

	}

	public function load_data_cari(){
		$this->load->view('laporan_transaksi/load_table_cari');
	}
	
	public function print_perlengkapan()
	{
		$this->load->view('laporan_transaksi/cetak_perlengkapan');
	}

}
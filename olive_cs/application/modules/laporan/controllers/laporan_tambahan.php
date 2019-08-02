<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_tambahan extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function rekapitulasi_pinjaman()
	{
		$data['konten'] = $this->load->view('laporan/laporan_tambahan/rekapitulasi_pinjaman', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail_rekapitulasi()
	{
		$data['konten'] = $this->load->view('laporan/laporan_tambahan/detail_rekapitulasi', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_rekapitulasi()
	{
		$this->load->view('laporan/laporan_tambahan/cari_rekapitulasi');
	}
	public function print_pinjaman()
	{
		$this->load->view('laporan/laporan_tambahan/print_pinjaman');
	}
	public function export_pinjaman()
	{
		$this->load->view('laporan/laporan_tambahan/export_pinjaman');
	}
	public function piutang_anggota()
	{
		$data['konten'] = $this->load->view('laporan/laporan_tambahan/piutang_anggota', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail_piutang()
	{
		$data['konten'] = $this->load->view('laporan/laporan_tambahan/detail_piutang', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function print_piutang()
	{
		$this->load->view('laporan/laporan_tambahan/print_piutang');
	}
	public function export_piutang()
	{
		$this->load->view('laporan/laporan_tambahan/export_piutang');
	}
	public function detail_angsuran_piutang()
	{
		$data['konten'] = $this->load->view('laporan/laporan_tambahan/detail_angsuran_piutang', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function simpanan_pokok()
	{
		$data['konten'] = $this->load->view('laporan/laporan_tambahan/simpanan_pokok', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function print_simpanan_pokok()
	{
		$this->load->view('laporan/laporan_tambahan/print_simpanan_pokok');
	}
	public function export_simpanan_pokok()
	{
		$this->load->view('laporan/laporan_tambahan/export_simpanan_pokok');
	}
	public function simpanan_wajib()
	{
		$data['konten'] = $this->load->view('laporan/laporan_tambahan/simpanan_wajib', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail_simpanan_wajib()
	{
		$data['konten'] = $this->load->view('laporan/laporan_tambahan/detail_simpanan_wajib', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_detail_simpanan_wajib()
	{
		$this->load->view('laporan/laporan_tambahan/cari_detail_simpanan_wajib');
	}
	public function print_simpanan_wajib()
	{
		$this->load->view('laporan/laporan_tambahan/print_simpanan_wajib');
	}
	public function export_simpanan_wajib()
	{
		$this->load->view('laporan/laporan_tambahan/export_simpanan_wajib');
	}
	public function tabungan()
	{
		$data['konten'] = $this->load->view('laporan/laporan_tambahan/tabungan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail_tabungan()
	{
		$data['konten'] = $this->load->view('laporan/laporan_tambahan/detail_tabungan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_tabungan()
	{
		$this->load->view('laporan/laporan_tambahan/cari_tabungan');
	}
	public function print_tabungan()
	{
		$this->load->view('laporan/laporan_tambahan/print_tabungan');
	}
	public function export_tabungan()
	{
		$this->load->view('laporan/laporan_tambahan/export_tabungan');
	}
	public function print_data_tabungan()
	{
		$this->load->view('laporan/laporan_tambahan/print_data_tabungan');
	}
	public function export_data_tabungan()
	{
		$this->load->view('laporan/laporan_tambahan/export_data_tabungan');
	}
	public function shu_pembagian()
	{
		$data['konten'] = $this->load->view('laporan/laporan_tambahan/shu_pembagian', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_shu_pembagian()
	{
		$this->load->view('laporan/laporan_tambahan/cari_shu_pembagian');
	}
	public function shu_anggota()
	{
		$data['konten'] = $this->load->view('laporan/laporan_tambahan/shu_anggota', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_shu_anggota()
	{
		$this->load->view('laporan/laporan_tambahan/cari_shu_anggota');
	}
	public function data_titipan()
	{
		$data['konten'] = $this->load->view('laporan/laporan_tambahan/data_titipan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail_titipan()
	{
		$data['konten'] = $this->load->view('laporan/laporan_tambahan/detail_titipan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function print_titipan()
	{
		$this->load->view('laporan/laporan_tambahan/print_titipan');
	}
	public function export_titipan()
	{
		$this->load->view('laporan/laporan_tambahan/export_titipan');
	}

}

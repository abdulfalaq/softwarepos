<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk_simpanan_sukarela extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('produk/simpanan/simpanan_sukarela', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}



	public function tambah()
	{
		$data['konten'] = $this->load->view('produk/simpanan/simpanan_sukarela_tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('produk/simpanan/simpanan_sukarela_edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	
	public function load_table()
	{
		$this->load->view('simpanan_sukarela/table/simpanan_sukarela');			
	}


	public function act_simpan()
	{		

		$awal_tahun = new DateTime("31-12-".(date('Y')-1));
		$akhir_tahun = new DateTime("31-12-".date('Y'));
		$jumlah_hari_dalam_setahun = $akhir_tahun->diff($awal_tahun)->format("%a");
		
		
		$data['kode_produk'] =  trim($this->input->post('kode_produk'));
		$data['nama_produk'] = trim($this->input->post('nama_produk_simpanan_sukarela'));
		$data['jasa_per_tahun'] = trim($this->input->post('jasa_simpanan_sukarela'));

		$jasa_per_hari = round($data['jasa_per_tahun'] / $jumlah_hari_dalam_setahun , 3, PHP_ROUND_HALF_UP);
		$data['jasa_per_hari'] = $jasa_per_hari;

		$this->db->insert('master_produk_tabungan',$data);
		echo "success";
		
	}
	public function act_update()
	{		

		$awal_tahun = new DateTime("31-12-".(date('Y')-1));
		$akhir_tahun = new DateTime("31-12-".date('Y'));
		$jumlah_hari_dalam_setahun = $akhir_tahun->diff($awal_tahun)->format("%a");


		
			$data['nama_produk'] = trim($this->input->post('nama_produk_simpanan_sukarela'));
			$data['jasa_per_tahun'] = trim($this->input->post('jasa_simpanan_sukarela'));

			$jasa_per_hari = round($data['jasa_per_tahun'] / $jumlah_hari_dalam_setahun , 2);
			$data['jasa_per_hari'] = $jasa_per_hari;

			$id = $this->input->post('id');
			$this->db->where(array('id'=>$id));
			$this->db->update('master_produk_tabungan',$data);
			echo "success";
	}
	public function act_delete()
	{
		$id = $this->input->post('id');
		$this->db->where(array('id'=>$id));
		$this->db->delete('master_produk_tabungan');
		echo "delete";
	}

}

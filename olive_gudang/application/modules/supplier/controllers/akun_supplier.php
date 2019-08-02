<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class akun_supplier extends MY_Controller {


	public function index()
	{
		$data['konten'] = $this->load->view('setting', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('akun_supplier/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$data['konten'] = $this->load->view('akun_supplier/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('akun_supplier/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function personal_data()
	{
		$data['konten'] = $this->load->view('akun_supplier/personal_data', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function hutang()
	{
		$data['konten'] = $this->load->view('akun_supplier/hutang', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_hutang()
	{
		$this->load->view('akun_supplier/cari_hutang');
		
	}
	public function detail_hutang()
	{
		$data['konten'] = $this->load->view('akun_supplier/detail_hutang', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function bayar_hutang()
	{
		$data['konten'] = $this->load->view('akun_supplier/bayar_hutang', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function record()
	{
		$data['konten'] = $this->load->view('akun_supplier/record', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('akun_supplier/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail2()
	{
		$data['konten'] = $this->load->view('akun_supplier/detail2', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function get_rupiah()
	{
		$angsuran=$this->input->post('angsuran');
		echo format_rupiah($angsuran);
	}
	public function simpan_hutang()
	{
		$kode_transaksi=$this->input->post('kode_transaksi');
		$jenis_transaksi=$this->input->post('jenis_transaksi');
		$nilai_sisa=$this->input->post('nilai_sisa');
		$angsuran=$this->input->post('angsuran');
		$tanggal_jatuh_tempo=$this->input->post('tanggal_jatuh_tempo');

		$this->db->where('kode_transaksi', $kode_transaksi);
		$get_hutang=$this->db->get('transaksi_hutang')->row();
		

		$opsi['kode_transaksi']=$kode_transaksi;
		$opsi['angsuran']=$angsuran;
		$opsi['tanggal_angsuran']=date('Y-m-d');
		$this->db->insert('opsi_hutang', $opsi);

		$transaksi['sisa']=$get_hutang->sisa - @$angsuran;
		$transaksi['angsuran']=@$get_hutang->angsuran + @$angsuran;
		if($jenis_transaksi=='Angsuran'){
			$transaksi['tanggal_jatuh_tempo']=@$tanggal_jatuh_tempo;
		}
		$update=$this->db->update('transaksi_hutang', $transaksi,array('kode_transaksi' =>$kode_transaksi));
		if(@$update){
			$hasil['respon']='sukses';
		}else{
			$hasil['respon']='gagal';
		}
		echo json_encode($hasil);
	}
}

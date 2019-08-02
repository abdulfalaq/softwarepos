<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		redirect(base_url('dokter'));
	}

	public function dashboard(){
		$data['konten'] = $this->load->view('dasboard', NULL, TRUE);
		$this->load->view ('main', $data);
	}

	public function proses_pemberian_jasa(){
		$input = $this->input->post();

		$jasa = new DateTime($input['jasa']);
		$hari_ini = new DateTime($input['hari_ini']);
		$diff = $hari_ini->diff($jasa)->format("%a");

		for ($i=$diff; $i >= 1 ; $i--) {
			$this->db->where('saldo_tabungan !=', '0');
			$get_simpanan = $this->db->get('data_tabungan');
			$hasil_simpanan = $get_simpanan->result();
			$no = 0;

			echo $tanggal_jasa = date('Y-m-d', strtotime('-'.$i.' days'));

			foreach ($hasil_simpanan as $simpanan) {
				$data['kode_transaksi'] = 'TJ_'.date('ymdhis').$i.$no;
				$data['tanggal_transaksi'] = $tanggal_jasa;
				$data['jenis_transaksi'] = 'jasa';
				$data['kode_anggota'] = $simpanan->kode_anggota;
				$data['nama_anggota'] = $simpanan->nama_anggota;
				$data['kode_produk'] = $simpanan->kode_produk;
				$data['nama_produk'] = $simpanan->nama_produk;
				$data['saldo_awal_simpanan'] = $simpanan->saldo_tabungan;
				$data['jasa'] = $simpanan->jasa_perhari;
				$data['nominal'] = $data['jasa']*$data['saldo_awal_simpanan'];
				$data['saldo_akhir'] =$simpanan->total_saldo_tabungan;
				$this->db->insert('transaksi_tabungan', $data);
				$no++;

				$update_simpanan['saldo_jasa'] = $simpanan->saldo_jasa + @$data['nominal'];
				$this->db->where('kode_anggota', $simpanan->kode_anggota);
				$this->db->where('kode_produk', $simpanan->kode_produk);
				$this->db->update('data_tabungan', $update_simpanan);
			}
		}

		$update_setting['reloader_jasa'] = $input['hari_ini'];
		$this->db->update('setting', $update_setting);
	}
	public function proses_penyusutan(){
		$input = $this->input->post();
		$get_aset = $this->db->get('data_pembelian_aset');
		$hasil_get_aset = $get_aset->result();
		foreach ($hasil_get_aset as $aset) {
			$this->db->where('bulan',date('m'));
			$this->db->where('tahun',date('Y'));
			$cek_penyusutan = $this->db->get_where('data_penyusutan_aset',array('kode_aset' =>$aset->kode_aset));
			$hasil_cek_penyusutan = $cek_penyusutan->row();
			if(empty($hasil_cek_penyusutan) and $aset->sisa_umur_efektif_bulan >0){

				$bulan=date('Y-m-d');
				$tgl_penyusutan =date('Y-m-d',strtotime('- 1 month', strtotime($bulan)));
				$bulan_penyusutan=date('m',strtotime($tgl_penyusutan));
				$tahun_penyusutan=date('Y',strtotime($tgl_penyusutan));

				$this->db->where('bulan',$bulan_penyusutan);
				$this->db->where('tahun',$tahun_penyusutan);
				$get_penyusutan = $this->db->get_where('data_penyusutan_aset',array('kode_aset' =>$aset->kode_aset));
				$hasil_get_penyusutan = $get_penyusutan->row();

				$penyusutan['tanggal']=date('Y-m-d');
				$penyusutan['kode_aset']=$aset->kode_aset;
				$penyusutan['nama_aset']=$aset->nama_aset;
				$penyusutan['jumlah_aset']=$aset->jumlah_aset;
				$penyusutan['bulan']=date('m');
				$penyusutan['tahun']=date('Y');
				$penyusutan['harga_awal']=$hasil_get_penyusutan->harga_akhir;
				$penyusutan['total_penyusutan']=$aset->total_penyusutan_bulan;
				$penyusutan['harga_akhir']=$hasil_get_penyusutan->harga_akhir - $aset->total_penyusutan_bulan;
				$this->db->insert('data_penyusutan_aset',$penyusutan);

				$data_aset['sisa_umur_efektif_bulan']=$aset->sisa_umur_efektif_bulan -1;
				$data_aset['total_penyusutan']=$aset->total_penyusutan + $aset->total_penyusutan_bulan;
				$this->db->update('data_pembelian_aset',$data_aset,array('kode_aset' =>$aset->kode_aset));
				
			}
		}
		
	}
	public function pembayaran_pajak(){

		$bulan=date('m',strtotime(date('Y-m-d')));
		$tahun=date('Y',strtotime(date('Y-m-d')));

		$get_setting_akun 	= $this->db->get_where('setting_akun_keuangan',array('no_akun' =>'102','no_sub_akun'=>'1031'));
		$hasil_setting_akun = $get_setting_akun->row();

		$get_laporan_arus_kas 	= $this->db->get_where('laporan_arus_kas',array('no_akun' =>'102','no_sub_akun'=>'1031','bulan'=>$bulan,'triwulan'=>Triwulan($bulan),'tahun'=>$tahun));
		$hasil_laporan_arus_kas  = $get_laporan_arus_kas->row();
		if(empty($hasil_laporan_arus_kas)){

			$tgl_sebelumnya =date('Y-m-d',strtotime('- 1 month', strtotime(date('Y-m-d'))));
			$bulan_sebelumnya=date('m',strtotime($tgl_sebelumnya));
			$tahun_sebelumnya=date('Y',strtotime($tgl_sebelumnya));

			$this->db->select_sum('nominal');
			$get_pemasukan=$this->db->get_where('laporan_arus_kas',array('no_akun' =>'101','bulan'=>$bulan_sebelumnya,'triwulan'=>Triwulan($bulan_sebelumnya),'tahun'=>$tahun_sebelumnya));
			$hasil_pemasukan=$get_pemasukan->row();

			$get_setting=$this->db->get('setting');
			$hasil_setting=$get_setting->row();

			$nominal=($hasil_setting->pajak * $hasil_pemasukan->nominal)/100;

			$insert_arus_kas['no_akun']=$hasil_setting_akun->no_akun;
			$insert_arus_kas['nama_akun']=$hasil_setting_akun->nama_akun;
			$insert_arus_kas['no_sub_akun']=$hasil_setting_akun->no_sub_akun;
			$insert_arus_kas['nama_sub_akun']=$hasil_setting_akun->nama_sub_akun;
			$insert_arus_kas['kategori']=$hasil_setting_akun->kategori;
			$insert_arus_kas['nominal']=$nominal;
			$insert_arus_kas['tanggal']=date('Y-m-d');
			$insert_arus_kas['bulan']=$bulan;
			$insert_arus_kas['triwulan']=Triwulan($bulan);
			$insert_arus_kas['tahun']=$tahun;
			$this->db->insert('laporan_arus_kas',$insert_arus_kas);
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('astrosession');
		$this->session->sess_destroy();
		clearstatcache();
		redirect($this->cname);
	}
}

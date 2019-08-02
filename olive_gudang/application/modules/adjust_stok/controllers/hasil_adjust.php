<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hasil_adjust extends MY_Controller {

	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
		$this->db_master = $this->load->database('olive_master', TRUE);
		$this->db_keuangan = $this->load->database('olive_keuangan', TRUE);
	}

	public function index()
	{
		$data['konten'] = $this->load->view('setting', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('hasil_adjust/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$data['konten'] = $this->load->view('hasil_adjust/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('hasil_adjust/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('hasil_adjust/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_daftar()
	{
		$this->load->view('hasil_adjust/cari_daftar');
	}
	public function tidak_sesuaikan()
	{
		$id = $this->input->post('id');
		$update['validasi'] = 'confirmed';
		$update_opname = $this->db->update('opsi_transaksi_opname', $update, array('id'=>$id));
	}

	public function sesuaikan()
	{
		$param = $this->input->post();
		$status_validasi = $param['status_validasi'];
		$id = $param['id'];


		$get_id_petugas 	= $this->session->userdata('astrosession');
		$id_petugas 		= $get_id_petugas->id;
		$nama_petugas 		= $get_id_petugas->uname;

		$update['validasi'] = 'confirmed';
		
		if($status_validasi=="kurang"){
			$update['nominal_opname'] = $param['nominal_opname'];
		}

		$update_opname = $this->db->update('opsi_transaksi_opname', $update, array('id'=>$id));

		if($update_opname == TRUE){
			$data_opsi = $this->db->get_where('opsi_transaksi_opname',array('id' => $id ));
			$hasil_data = $data_opsi->row();
			
			if($hasil_data->jenis_bahan=='Bahan Baku'){
				$harga_satuan = $this->db_master->get_where('master_bahan_baku',array('kode_bahan_baku'=>$hasil_data->kode_bahan));
				$harga_satuan = $harga_satuan->row()->hpp ;


				$data_stok['real_stock'] = $hasil_data->stok_akhir;

				$this->db_master->update('master_bahan_baku',$data_stok,array('kode_bahan_baku'=>$hasil_data->kode_bahan));
			}elseif ($hasil_data->jenis_bahan=='Produk') {
				$harga_satuan = $this->db_master->get_where('master_produk',array('kode_produk'=>$hasil_data->kode_bahan));
				$harga_satuan = $harga_satuan->row()->hpp ;

				$data_stok['real_stock'] = $hasil_data->stok_akhir;

				$this->db_master->update('master_produk',$data_stok,array('kode_produk'=>$hasil_data->kode_bahan));
			}else{
				$harga_satuan = $this->db_master->get_where('master_perlengkapan',array('kode_perlengkapan'=>$hasil_data->kode_bahan));
				$harga_satuan = $harga_satuan->row()->hpp ;

				$data_stok['real_stock'] = $hasil_data->stok_akhir;

				$this->db_master->update('master_perlengkapan',$data_stok,array('kode_perlengkapan'=>$hasil_data->kode_bahan));
			}

			if($status_validasi=='kurang'){

				$stok_keluar=$hasil_data->selisih;
				$status_stok='keluar';
				$stok['jenis_transaksi'] = 'opname';
				$stok_masuk='';
			}else if ($status_validasi=='lebih' or $status_validasi=='cocok') {
				$stok_masuk=$hasil_data->selisih;
				$status_stok='masuk';
				$stok['sisa_stok'] = @$stok_masuk ;
				$stok['jenis_transaksi'] = 'opname' ;
				$stok_keluar='';

			}

			$stok['kode_transaksi'] = $hasil_data->kode_opname ;
			$stok['kategori_bahan'] = $hasil_data->jenis_bahan;
			$stok['kode_bahan'] = $hasil_data->kode_bahan ;
			$stok['stok_keluar'] = @$stok_keluar;
			$stok['stok_masuk'] = @$stok_masuk ;
			$stok['sisa_stok'] = $hasil_data->stok_akhir ;
			$stok['posisi_awal'] = 'gudang';
			$stok['posisi_akhir'] = '';
			$stok['hpp'] = $harga_satuan ;
			$stok['id_petugas'] = $id_petugas;
			$stok['tanggal_transaksi'] = date("Y-m-d") ;
			$stok['status'] = 'masuk';

			$transaksi_stok = $this->db->insert("transaksi_stok", $stok);

			if($transaksi_stok == TRUE){
				if($status_validasi=='kurang'){
					$nilai_opname=$hasil_data->selisih * $harga_satuan;
					if($param['nominal_opname'] < $nilai_opname){
						$selisih_nominal=$nilai_opname - $param['nominal_opname'];

						$get_keuangan_sub_kategori_akun = $this->db_keuangan->get_where('keuangan_sub_kategori_akun',array('kode_sub_kategori_akun'=>'2.3.2'));
						$get_keuangan_sub_kategori_akun = $get_keuangan_sub_kategori_akun->row();

						$data_keuangan['id_petugas'] 				= $id_petugas ;
						$data_keuangan['kode_referensi'] 			= $hasil_data->kode_opname;
						$data_keuangan['tanggal_transaksi'] 		= date("Y-m-d") ;
						$data_keuangan['keterangan'] 				= 'opname' ;
						$data_keuangan['nominal'] 					= $selisih_nominal;
						$data_keuangan['kode_jenis_keuangan'] 		= $get_keuangan_sub_kategori_akun->kode_jenis_akun;
						$data_keuangan['kode_kategori_keuangan'] 	= $get_keuangan_sub_kategori_akun->kode_kategori_akun;
						$data_keuangan['kode_sub_kategori_keuangan']= $get_keuangan_sub_kategori_akun->kode_sub_kategori_akun;


						$keuangan = $this->db_keuangan->insert("keuangan_keluar", $data_keuangan);

					}elseif ($param['nominal_opname'] > $nilai_opname) {
						$selisih_nominal= $param['nominal_opname'] - $nilai_opname;

						$get_keuangan_sub_kategori_akun = $this->db_keuangan->get_where('keuangan_sub_kategori_akun',array('kode_sub_kategori_akun'=>'1.3.2'));
						$get_keuangan_sub_kategori_akun = $get_keuangan_sub_kategori_akun->row();

						$data_keuangan['id_petugas'] = $id_petugas ;
						$data_keuangan['kode_referensi'] = $hasil_data->kode_opname;
						$data_keuangan['tanggal_transaksi'] = date("Y-m-d") ;
						$data_keuangan['keterangan'] = 'opname' ;
						$data_keuangan['nominal'] = $selisih_nominal;
						$data_keuangan['kode_jenis_keuangan'] = $get_keuangan_sub_kategori_akun->kode_jenis_akun;
						$data_keuangan['kode_kategori_keuangan'] = $get_keuangan_sub_kategori_akun->kode_kategori_akun;
						$data_keuangan['kode_sub_kategori_keuangan'] = $get_keuangan_sub_kategori_akun->kode_sub_kategori_akun;


						$keuangan = $this->db_keuangan->insert("keuangan_masuk", $data_keuangan);

					}

				}elseif ($status_validasi=='kurang_tanpa_nominal') {
					$nilai_opname=$hasil_data->selisih * $harga_satuan;

					$get_keuangan_sub_kategori_akun = $this->db_keuangan->get_where('keuangan_sub_kategori_akun',array('kode_sub_kategori_akun'=>'2.3.2'));
					$get_keuangan_sub_kategori_akun = $get_keuangan_sub_kategori_akun->row();

					$data_keuangan['id_petugas'] = $id_petugas ;
					$data_keuangan['kode_referensi'] = $hasil_data->kode_opname;
					$data_keuangan['tanggal_transaksi'] = date("Y-m-d") ;
					$data_keuangan['keterangan'] = 'opname' ;
					$data_keuangan['nominal'] = $nilai_opname;
					$data_keuangan['kode_jenis_keuangan'] = $get_keuangan_sub_kategori_akun->kode_jenis_akun;
					$data_keuangan['kode_kategori_keuangan'] = $get_keuangan_sub_kategori_akun->kode_kategori_akun;
					$data_keuangan['kode_sub_kategori_keuangan'] = $get_keuangan_sub_kategori_akun->kode_sub_kategori_akun;


					$keuangan = $this->db_keuangan->insert("keuangan_keluar", $data_keuangan);
				}
				

				$hasil['respon']="sukses";
			} else {
				$hasil['respon']="gagal";
				$hasil['notif']='<div class="alert alert-danger">Gagal, menyesuaikan stok opname .</div>';
			}
		} else {
			$hasil['respon']="gagal";
			$hasil['notif']='<div class="alert alert-danger">Gagal, update data approve.</div>';
		}
		echo json_encode($hasil);
	}

}

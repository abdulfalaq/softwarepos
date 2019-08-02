<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produksi extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('produksi/produksi', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah()
	{
		$data['konten'] = $this->load->view('produksi/produksi/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('produksi/produksi/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('produksi/produksi/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function get_produksi_temp(){
		
		$this->load->view('produksi/produksi/tabel_transaksi_temp');
	}
	public function get_tabel_uji_temp(){
		
		$this->load->view('produksi/produksi/tabel_uji_temp');
	}
	public function get_tabel_rilis_produk_temp(){
		
		$this->load->view('produksi/produksi/tabel_rilis_produk');
	}
	
	public function simpan_produksi(){
		$post = $this->input->post();
		$this->db_master = $this->load->database('kan_master', TRUE);

		$user = $this->session->userdata('astrosession');
		$get_setting = $this->db->get('setting')->row();
		$kode_produksi = $post['kode_produksi'];

		$this->db->where('kode_produksi', $kode_produksi);
		$get_opsi = $this->db->get('opsi_transaksi_produksi')->result();
		$jumlah_opsi = count($get_opsi);

		for($i = 0; $i<$jumlah_opsi; $i++){
			$id_opsi = $post['id'][$i];

			$jumlah_produksi = $post['jumlah_akhir'][$i]+$post['barang_rusak'][$i]+$post['sample_uji'][$i];
			$update_opsi['jumlah'] = $post['jumlah_akhir'][$i];
			$update_opsi['barang_rusak'] = $post['barang_rusak'][$i];
			$update_opsi['sample_uji'] = $post['sample_uji'][$i];
			$update_opsi['ph'] = $post['ph'][$i];
			$update_opsi['fat'] = $post['fat'][$i];
			$update_opsi['protein'] = $post['protein'][$i];
			$update_opsi['keasaman'] = $post['keasaman'][$i];
			$update_opsi['coliform'] = $post['coliform'][$i];
			$update_opsi['reduktase'] = $post['reduktase'][$i];
			$update_opsi['tpc'] = $post['tpc'][$i];
			$update_opsi['alkohol'] = $post['alkohol'][$i];
			$update_opsi['bj'] = $post['bj'][$i];
			$update_opsi['tanggal_rilis'] = $post['tanggal_rilis'][$i];	
			$update_opsi['tanggal_produksi'] = $post['tanggal_produksi_opsi'][$i];	
			$update_opsi['tanggal_expired'] = $post['expired_date'][$i];	
			$update_opsi['spesifikasi_bb'] = $post['spesifikasi_bb'.$i];
			$update_opsi['remark_spesifikasi_bb'] = $post['remark_spesifikasi_bb'][$i];	
			$update_opsi['spesifikasi_kemasan'] = $post['spesifikasi_kemasan'.$i];
			$update_opsi['remark_spesifikasi_kemasan'] = $post['remark_spesifikasi_kemasan'][$i];
			$update_opsi['kpp'] = $post['kpp'.$i];
			$update_opsi['remark_kpp'] = $post['remark_kpp'][$i];
			$update_opsi['hasil_analisa'] = $post['hasil_analisa'.$i];
			$update_opsi['remark_hasil_analisa'] = $post['remark_hasil_analisa'][$i];
			$update_opsi['kegagalan_produksi'] = @implode('|', @$post['kegagalan_produksi'.$i]);


			$stok_masuk['tanggal_transaksi'] = date('Y-m-d H:i:s');
			$stok_masuk['jenis_transaksi'] = 'produksi';
			$stok_masuk['kode_transaksi'] = $kode_produksi;
			$stok_masuk['kategori_bahan'] = $post['kategori_bahan'][$i];
			$stok_masuk['kode_bahan'] = $post['kode_bahan'][$i];
			$stok_masuk['stok_masuk'] = $update_opsi['jumlah'];
			$stok_masuk['hpp'] = '';
			$stok_masuk['sisa_stok'] = $update_opsi['jumlah'];
			$stok_masuk['kode_petugas'] = $user->kode_user;
			$stok_masuk['posisi_awal'] = '';
			$stok_masuk['posisi_akhir'] = 'gudang';
			$stok_masuk['status'] = 'masuk';
			$stok_masuk['kode_unit_jabung'] = $get_setting->kode_unit;
			$this->db->insert('transaksi_stok', $stok_masuk);

			$this->db->where('id_opsi', $id_opsi);
			$this->db->update('opsi_transaksi_produksi', $update_opsi);
			if($post['kategori_bahan'][$i] == 'BDP'){
				$this->db_master->where('kode_barang', $post['kode_bahan'][$i]);
				$get_bahan = $this->db_master->get('opsi_master_barang_dalam_proses')->result();
				foreach ($get_bahan as $bahan) {
					$kebutuhan = ($bahan->qty / $bahan->konversi) * $jumlah_produksi;
					$this->db->where('kode_bahan', $bahan->kode_bahan);
					$this->db->where('status', 'masuk');
					$this->db->order_by('tanggal_transaksi', 'asc');
					$get_fifo = $this->db->get('transaksi_stok')->result();
					foreach ($get_fifo as $fifo) {
						echo $sisa_stok = $fifo->sisa_stok - $kebutuhan;
						if($sisa_stok > 0){
							$update_fifo['sisa_stok'] = $sisa_stok;
							$this->db->where('id', $fifo->id);
							$this->db->update('transaksi_stok', $update_fifo);
							break;
						} else{
							$update_fifo['sisa_stok'] = 0;
							$kebutuhan = $kebutuhan - $fifo->sisa_stok;
							$this->db->where('id', $fifo->id);
							$this->db->update('transaksi_stok', $update_fifo);
						}
					}

					$stok['tanggal_transaksi'] = date('Y-m-d H:i:s');
					$stok['jenis_transaksi'] = 'produksi';
					$stok['kode_transaksi'] = $kode_produksi;
					$stok['kategori_bahan'] = $bahan->jenis_bahan;
					$stok['kode_bahan'] = $bahan->kode_bahan;
					$stok['stok_keluar'] = $kebutuhan;
					$stok['hpp'] = '';
					$stok['sisa_stok'] = '';
					$stok['kode_petugas'] = $user->kode_user;
					$stok['posisi_awal'] = 'gudang';
					$stok['posisi_akhir'] = '';
					$stok['status'] = 'keluar';
					$stok['kode_unit_jabung'] = $get_setting->kode_unit;
					$this->db->insert('transaksi_stok', $stok);
				}

			} else{
				$this->db_master->where('kode_produk', $post['kode_bahan'][$i]);
				$get_bahan = $this->db_master->get('opsi_master_produk')->result();
				foreach ($get_bahan as $bahan) {
					$kebutuhan = $bahan->qty * $jumlah_produksi;
					$this->db->where('kode_bahan', $bahan->kode_bahan);
					$this->db->where('status', 'masuk');
					$this->db->order_by('tanggal_transaksi', 'asc');
					$get_fifo = $this->db->get('transaksi_stok')->result();
					foreach ($get_fifo as $fifo) {
						echo $sisa_stok = $fifo->sisa_stok - $kebutuhan;
						if($sisa_stok > 0){
							$update_fifo['sisa_stok'] = $sisa_stok;
							$this->db->where('id', $fifo->id);
							$this->db->update('transaksi_stok', $update_fifo);
							break;
						} else{
							$update_fifo['sisa_stok'] = 0;
							$kebutuhan = $kebutuhan - $fifo->sisa_stok;
							$this->db->where('id', $fifo->id);
							$this->db->update('transaksi_stok', $update_fifo);
						}

						$stok['tanggal_transaksi'] = date('Y-m-d H:i:s');
						$stok['jenis_transaksi'] = 'produksi';
						$stok['kode_transaksi'] = $kode_produksi;
						$stok['kategori_bahan'] = $bahan->jenis_bahan;
						$stok['kode_bahan'] = $bahan->kode_bahan;
						$stok['stok_keluar'] = $kebutuhan;
						$stok['hpp'] = '';
						$stok['sisa_stok'] = '';
						$stok['kode_petugas'] = $user->kode_user;
						$stok['posisi_awal'] = 'gudang';
						$stok['posisi_akhir'] = '';
						$stok['status'] = 'keluar';
						$stok['kode_unit_jabung'] = $get_setting->kode_unit;
						$this->db->insert('transaksi_stok', $stok);
					}

				}
			}
		}

		$update_produksi['tanggal_produksi'] = $post['tanggal_produksi'];
		$update_produksi['tanggal_uji'] = $post['tanggal_uji'];
		$update_produksi['jenis_sample'] = $post['jenis_sample'];
		$update_produksi['status'] = 'proses';

		$this->db->where('kode_produksi', $kode_produksi);
		$this->db->update('transaksi_produksi', $update_produksi);
		
	}
}

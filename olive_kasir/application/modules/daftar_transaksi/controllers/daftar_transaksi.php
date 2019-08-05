<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class daftar_transaksi extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('daftar_transaksi', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_data()
	{
		$this->load->view('cari_data');
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('daftar_transaksi/daftar_transaksi/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail()
	{
		$data['konten'] = $this->load->view('daftar_transaksi/daftar_transaksi/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function info()
	{
		$data['konten'] = $this->load->view('daftar_transaksi/daftar_transaksi/info', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function batal_transaksi()
	{
		$data['konten'] = $this->load->view('daftar_transaksi/daftar_transaksi/batal_transaksi', NULL, TRUE);
		$this->load->view ('admin/main', $data);

		$kode_transaksi = $this->uri->segment(3);
		if(!empty($kode_transaksi)){
			$this->db->delete('opsi_transaksi_batal_temp',array('kode_transaksi' =>$kode_transaksi ));
			$this->db->where('kode_transaksi',$kode_transaksi);
			$get_transaksi_layanan = $this->db->get('opsi_transaksi_layanan');
			$hasil_transaksi_layanan = $get_transaksi_layanan->result_array();
			foreach ($hasil_transaksi_layanan as $value) {
				unset($value['id']);
				if($value['jenis_item']!='kartu member'){
					$this->db->insert('opsi_transaksi_batal_temp', $value);
				}
			}

		}		
	}

	public function table_rekam_medis()
	{	
		$this->load->view('daftar_transaksi/daftar_transaksi/table_rekam_medis');
	}
	public function table_pesan_temp()
	{	
		$this->load->view('daftar_transaksi/daftar_transaksi/table_pesan_temp');
	}
	public function get_data_member()
	{	
		$kode_member=$this->input->post('kode_member');
		$this->db->where('kode_member', $kode_member);
		$this->db->from('clouoid1_olive_master.master_member');
		$get_member=$this->db->get()->row();
		echo json_encode($get_member);
	}
	public function get_data_produk()
	{	
		$kode_produk=$this->input->post('kode_menu');
		$this->db->where('kode_produk', $kode_produk);
		$this->db->from('clouoid1_olive_master.master_produk');
		$this->db->join('clouoid1_olive_master.master_kategori_produk', 'clouoid1_olive_master.master_produk.kode_kategori_produk = clouoid1_olive_master.master_kategori_produk.kode_kategori_produk', 'left');
		$get_produk=$this->db->get()->row();
		echo json_encode($get_produk);
	}
	public function get_data_layanan()
	{	
		$kode_perawatan=$this->input->post('kode_menu_layanan');
		$this->db->where('kode_perawatan', $kode_perawatan);
		$this->db->from('clouoid1_olive_master.master_perawatan');
		$get_perawatan=$this->db->get()->row();
		echo json_encode($get_perawatan);
	}
	public function get_total_pesanan_layanan()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$jenis_diskon_transaksi=$this->input->post('jenis_diskon_transaksi');
		$diskon_transaksi=$this->input->post('diskon_transaksi');

		$this->db->select_sum('subtotal');
		$get_temp=$this->db->get_where('opsi_transaksi_batal_temp',array('kode_transaksi' => $kode_transaksi))->row();

		$jumlah_item=$this->db->get_where('opsi_transaksi_batal_temp',array('kode_transaksi' => $kode_transaksi))->result();
		$hasil['total_item']=count($jumlah_item);

		if(@$jenis_diskon_transaksi=='persen'){
			$nominal_diskon=(@$get_temp->subtotal * $diskon_transaksi) /100;
			$grand_total=@$get_temp->subtotal-@$nominal_diskon;
		}else{
			$nominal_diskon=$diskon_transaksi;
			$grand_total=@$get_temp->subtotal-@$nominal_diskon;
		}
		$hasil['subtotal']=@$get_temp->subtotal;
		$hasil['nominal_subtotal']=@format_rupiah($get_temp->subtotal);
		$hasil['diskon']=@$nominal_diskon;
		$hasil['nominal_diskon']=@format_rupiah($nominal_diskon);
		$hasil['grand_total']=@$grand_total;
		$hasil['nominal_grand_total']=@format_rupiah($grand_total);
		echo json_encode($hasil);
	}
	public function simpan_pesanan_temp()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$kode_menu=$this->input->post('kode_menu');
		$qty=$this->input->post('qty');
		$harga=$this->input->post('harga');
		$jenis_diskon=$this->input->post('jenis_diskon');
		$diskon_item=$this->input->post('diskon_item');
		$kode_terapis=$this->input->post('kode_terapis');
		$jenis_item=$this->input->post('jenis_item');

		$this->db->where('kode_produk', $kode_menu);
		$this->db->from('clouoid1_olive_master.master_produk');
		$this->db->join('clouoid1_olive_master.master_kategori_produk', 'clouoid1_olive_master.master_produk.kode_kategori_produk = clouoid1_olive_master.master_kategori_produk.kode_kategori_produk', 'left');
		$get_produk=$this->db->get()->row();

		if(@$qty <= @$get_produk->real_stock){
			if(@$jenis_diskon=='persen'){
				$nominal_diskon=(($qty * $harga) * $diskon_item) /100;
				$subtotal=($qty * $harga)-$nominal_diskon;
				$data['diskon_persen']=$diskon_item;
			}else{
				$nominal_diskon=$diskon_item;
				$subtotal=($qty * $harga)-$nominal_diskon;
				$data['diskon_rupiah']=$diskon_item;
			}
			$data['kode_transaksi']=$kode_transaksi;
			$data['kode_terapis']=$kode_terapis;
			$data['jenis_item']=$jenis_item;
			$data['kode_item']=$kode_menu;
			$data['qty']=$qty;
			$data['hpp']=$get_produk->hpp;
			$data['harga']=$harga;
			$data['jenis_diskon']=$jenis_diskon;
			$data['subtotal']=$subtotal;
			$this->db->insert('opsi_transaksi_batal_temp', $data);

			$hasil['respon']='sukses';
		}else{
			$hasil['respon']='gagal';
		}
		echo json_encode($hasil);

	}
	public function simpan_layanan()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$kode_menu=$this->input->post('kode_menu');
		$qty=$this->input->post('qty');
		$harga=$this->input->post('harga');
		$jenis_diskon=$this->input->post('jenis_diskon');
		$diskon_item=$this->input->post('diskon_item');
		$kode_terapis=$this->input->post('kode_terapis');
		$jenis_item=$this->input->post('jenis_item');

		$this->db->where('kode_perawatan', $kode_menu);
		$this->db->from('clouoid1_olive_master.master_perawatan');
		$get_perawatan=$this->db->get()->row();

		if(@$jenis_diskon=='persen'){
			$nominal_diskon=(($qty * $harga) * $diskon_item) /100;
			$subtotal=($qty * $harga)-$nominal_diskon;
			$data['diskon_persen']=$diskon_item;
		}else{
			$nominal_diskon=$diskon_item;
			$subtotal=($qty * $harga)-$nominal_diskon;
			$data['diskon_rupiah']=$diskon_item;
		}
		$data['kode_transaksi']=$kode_transaksi;
		$data['kode_terapis']=$kode_terapis;
		$data['jenis_item']='Treatment';
		$data['kode_item']=$kode_menu;
		$data['qty']=$qty;
		$data['hpp']=$get_perawatan->hpp;
		$data['harga']=$harga;
		$data['jenis_diskon']=$jenis_diskon;
		$data['subtotal']=$subtotal;
		$this->db->insert('opsi_transaksi_batal_temp', $data);

		$hasil['respon']='sukses';

		echo json_encode($hasil);

	}
	public function hapus_temp()
	{	
		$id=$this->input->post('id');
		$this->db->delete('opsi_transaksi_batal_temp',array('id' => $id));
	}
	public function get_data_opsi()
	{	
		$id=$this->input->post('id');
		$get_temp=$this->db->get_where('opsi_transaksi_batal_temp',array('id' => $id))->row();
		echo json_encode($get_temp);
	}
	public function update_layanan()
	{	
		$id=$this->input->post('id_temp');
		$kode_menu=$this->input->post('kode_menu');
		$qty=$this->input->post('qty');
		$harga=$this->input->post('harga');
		$jenis_diskon=$this->input->post('jenis_diskon');
		$diskon_item=$this->input->post('diskon_item');
		$kode_terapis=$this->input->post('kode_terapis');
		$jenis_item=$this->input->post('jenis_item');

		$this->db->where('kode_perawatan', $kode_menu);
		$this->db->from('clouoid1_olive_master.master_perawatan');
		$get_perawatan=$this->db->get()->row();
		if(@$jenis_diskon=='persen'){
			$nominal_diskon=(($qty * $harga) * $diskon_item) /100;
			$subtotal=($qty * $harga)-$nominal_diskon;
			$data['diskon_persen']=$diskon_item;
		}else{
			$nominal_diskon=$diskon_item;
			$subtotal=($qty * $harga)-$nominal_diskon;
			$data['diskon_rupiah']=$diskon_item;
		}
		$data['kode_terapis']=$kode_terapis;
		$data['jenis_item']='Treatment';
		$data['kode_item']=$kode_menu;
		$data['qty']=$qty;
		$data['hpp']=$get_perawatan->hpp;
		$data['harga']=$harga;
		$data['jenis_diskon']=$jenis_diskon;
		$data['subtotal']=$subtotal;
		$this->db->update('opsi_transaksi_batal_temp', $data,array('id' =>$id));
		$hasil['respon']='sukses';

		echo json_encode($hasil);
	}
	public function update_pesanan_opsi()
	{	
		$id=$this->input->post('id_temp');
		$kode_menu=$this->input->post('kode_menu');
		$qty=$this->input->post('qty');
		$harga=$this->input->post('harga');
		$jenis_diskon=$this->input->post('jenis_diskon');
		$diskon_item=$this->input->post('diskon_item');
		$kode_terapis=$this->input->post('kode_terapis');
		$jenis_item=$this->input->post('jenis_item');

		$this->db->where('kode_produk', $kode_menu);
		$this->db->from('clouoid1_olive_master.master_produk');
		$this->db->join('clouoid1_olive_master.master_kategori_produk', 'clouoid1_olive_master.master_produk.kode_kategori_produk = clouoid1_olive_master.master_kategori_produk.kode_kategori_produk', 'left');
		$get_produk=$this->db->get()->row();
		if(@$qty <= @$get_produk->real_stock){
			if(@$jenis_diskon=='persen'){
				$nominal_diskon=(($qty * $harga) * $diskon_item) /100;
				$subtotal=($qty * $harga)-$nominal_diskon;
				$data['diskon_persen']=$diskon_item;
			}else{
				$nominal_diskon=$diskon_item;
				$subtotal=($qty * $harga)-$nominal_diskon;
				$data['diskon_rupiah']=$diskon_item;
			}
			$data['kode_terapis']=$kode_terapis;
			$data['jenis_item']=$jenis_item;
			$data['kode_item']=$kode_menu;
			$data['qty']=$qty;
			$data['hpp']=$get_produk->hpp;
			$data['harga']=$harga;
			$data['jenis_diskon']=$jenis_diskon;
			$data['subtotal']=$subtotal;
			$this->db->update('opsi_transaksi_batal_temp', $data,array('id' =>$id));
			$hasil['respon']='sukses';
		}else{
			$hasil['respon']='gagal';
		}
		echo json_encode($hasil);
	}
	public function delete_transaksi()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$this->db->delete('opsi_transaksi_batal_temp',array('kode_transaksi' => $kode_transaksi));
	}
	public function simpan_transaksi()
	{
		$post = $this->input->post();
		$kode_transaksi=@$post['kode_transaksi'];
		$kode_transaksi_baru=@$post['kode_transaksi_baru'];
		$transaksi_pelayanan = $this->db->get_where('transaksi_layanan', array('kode_transaksi' => $kode_transaksi));
		$hasil_transaksi_pelayanan = $transaksi_pelayanan->row();

		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_transaksi');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_periksa');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_dokter');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_terapis');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.jenis_item');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.qty');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.hpp');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.harga');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.jenis_diskon');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.diskon_persen');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.diskon_rupiah');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.subtotal');

		$this->db->select('clouoid1_olive_master.master_produk.real_stock as real_stock_produk');
		$this->db->select('clouoid1_olive_master.master_produk.insentif_masker');
		$this->db->select('clouoid1_olive_cs.opsi_transaksi_reservasi.qty_sisa');
		$this->db->select('clouoid1_olive_cs.opsi_transaksi_reservasi.qty_diambil');

		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->from('clouoid1_olive_kasir.opsi_transaksi_layanan');
		$this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_master.master_produk.kode_produk', 'left');
		$this->db->join('clouoid1_olive_master.master_perawatan', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_master.master_perawatan.kode_perawatan', 'left');
		$this->db->join('clouoid1_olive_cs.opsi_transaksi_reservasi', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_transaksi = clouoid1_olive_cs.opsi_transaksi_reservasi.kode_reservasi and clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_cs.opsi_transaksi_reservasi.kode_item', 'left');
		
		$data_temp=$this->db->get()->result();
		$hpp_penjualan=0;
		foreach ($data_temp as $value) {
			$hpp_penjualan +=@$value->qty * @$value->hpp;
			$opsi['kode_transaksi']=@$value->kode_transaksi;
			$opsi['kode_kasir']=@$hasil_transaksi_pelayanan->kode_kasir;
			$opsi['kode_reservasi']=@$value->kode_reservasi;
			$opsi['kode_periksa']=@$value->kode_periksa;
			$opsi['kode_dokter']=@$value->kode_dokter;
			$opsi['kode_terapis']=@$value->kode_terapis;
			$opsi['jenis_item']=@$value->jenis_item;
			$opsi['kode_item']=@$value->kode_item;
			$opsi['qty']=@$value->qty;
			$opsi['qty_poin']=@$value->qty_poin;
			$opsi['hpp']=@$value->hpp;
			$opsi['harga']=@$value->harga;
			$opsi['poin_terpakai']=@$value->poin_terpakai;
			$opsi['jenis_diskon']=@$value->jenis_diskon;
			$opsi['diskon_persen']=@$value->diskon_persen;
			$opsi['diskon_rupiah']=@$value->diskon_rupiah;
			$opsi['subtotal']=@$value->subtotal;
			$this->db->insert('opsi_transaksi_batal', $opsi);
			if(@$value->ambil_paket=='Ya'){
				$masukan['qty_sisa'] = @$value->qty_sisa + @$value['qty'];
				$masukan['qty_diambil'] =  @$value->qty_diambil - $value->qty;

				$this->db->where('kode_item', @$value['kode_item']);
				$this->db->update('clouoid1_olive_cs.opsi_transaksi_reservasi',$masukan,array('kode_reservasi' => @$value['kode_reservasi']));
				if(@$masukan['qty_sisa'] <= 0){
					$tr_reservasi['status'] = 'selesai';
					$this->db->update('clouoid1_olive_cs.transaksi_reservasi',$tr_reservasi,array('kode_reservasi' => @$value['kode_reservasi']));
				}
			}
			if($value->jenis_item == 'Treatment' || $value->jenis_item == 'treatment'){
				$this->db->where('clouoid1_olive_master.opsi_master_perawatan.kode_perawatan', @$value->kode_item);
				$this->db->select('clouoid1_olive_master.master_perlengkapan.real_stock as real_stock_perlengkapan');

				$this->db->select('clouoid1_olive_master.opsi_master_perawatan.jenis');
				$this->db->select('clouoid1_olive_master.opsi_master_perawatan.kode_perlengkapan');
				$this->db->select('clouoid1_olive_master.opsi_master_perawatan.kode_bahan');
				$this->db->select('clouoid1_olive_master.opsi_master_perawatan.qty');
				$this->db->select('clouoid1_olive_master.master_bahan_baku.real_stock as real_stock_bahan');

				$this->db->from('clouoid1_olive_master.opsi_master_perawatan');
				$this->db->join('clouoid1_olive_master.master_perlengkapan', 'clouoid1_olive_master.opsi_master_perawatan.kode_perlengkapan = clouoid1_olive_master.master_perlengkapan.kode_perlengkapan', 'left');
				$this->db->join('clouoid1_olive_master.master_bahan_baku', 'clouoid1_olive_master.opsi_master_perawatan.kode_bahan = clouoid1_olive_master.master_bahan_baku.kode_bahan_baku', 'left');
				$opsi_perawatan=$this->db->get()->result();
				foreach ($opsi_perawatan as $opsi_per) {
					if($opsi_per->jenis=='Perlengkapan'){

						$this->db->where('kode_perlengkapan', @$opsi_per->kode_perlengkapan);
						$this->db->set('real_stock',@$opsi_per->real_stock_perlengkapan + (@$value->qty * @$opsi_per->qty));
						$this->db->from('clouoid1_olive_master.master_perlengkapan');
						$this->db->update();
					}else{
						$this->db->where('kode_bahan_baku', @$opsi_per->kode_bahan);
						$this->db->set('real_stock',@$opsi_per->real_stock_bahan + (@$value->qty * @$opsi_per->qty));
						$this->db->from('clouoid1_olive_master.master_bahan_baku');
						$this->db->update();
					}
				}
			}else{
				$this->db->where('kode_produk', @$value->kode_item);
				$this->db->set('real_stock',@$value->real_stock_produk + @$value->qty);
				$this->db->from('clouoid1_olive_master.master_produk');
				$this->db->update();
			}

		}
		

		if (@$hasil_transaksi_pelayanan->kode_layanan != '03') {
			$this->db->select('poin');
			$this->db->select('kategori_member');
			$this->db->where('kode_member', @$post['kode_member']);
			$this->db->from('clouoid1_olive_master.master_member');
			$poin_member = $this->db->get();
			$hasil_poin_member = $poin_member->row();

			if (@$hasil_poin_member->kategori_member == 'Member') {
				$this->db->from('clouoid1_olive_master.setting_poin');
				$get_poin = $this->db->get();
				$hasil_get_poin = $get_poin->row();

				if(!empty($hasil_poin_member)){
					if ($hasil_transaksi_pelayanan->grand_total >= @$hasil_get_poin->nominal_transaksi) {
						$total_poin=@$hasil_transaksi_pelayanan->grand_total/@$hasil_get_poin->nominal_transaksi;
						$hasil_poin['poin'] = @$hasil_poin_member->poin - (floor($total_poin));
						$this->db->update('clouoid1_olive_master.master_member', $hasil_poin, array('kode_member'=>$post['kode_member'])); 
					}
				}
			}
		}
		$this->db->select('kode_jenis_akun');
		$this->db->select('kode_sub_kategori_akun');
		$this->db->where('kode_sub_kategori_akun', '2.6.2');
		$this->db->from('clouoid1_olive_keuangan.keuangan_sub_kategori_akun');
		$kategori_keluar = $this->db->get();
		$hasil_kategori_keluar = $kategori_keluar->row();

		$this->update_arus_kas('Pendapatan','1.1.1','Penjualan',@$hasil_transaksi_pelayanan->grand_total);
		$this->update_laba_rugi('Pemasukan','1.1.1','Penjualan',@$hasil_transaksi_pelayanan->grand_total);
		$this->update_laba_rugi('Pengeluaran',@$hasil_kategori_keluar->kode_sub_kategori_akun,'HPP',$hpp_penjualan);

		$this->db->delete('data_record_anggota',array('kode_transaksi' => $kode_transaksi));
		$this->db->delete('clouoid1_olive_keuangan.insentif_terapis',array('kode_transaksi' => $kode_transaksi));
		$this->db->delete('clouoid1_olive_gudang.transaksi_stok',array('kode_transaksi' => $kode_transaksi));
		$this->db->delete('clouoid1_olive_keuangan.keuangan_masuk',array('kode_referensi' => $kode_transaksi));
		$this->db->delete('clouoid1_olive_keuangan.keuangan_keluar',array('kode_referensi' => $kode_transaksi));
		$this->db->delete('opsi_transaksi_layanan',array('kode_transaksi' => $kode_transaksi));
		$this->db->delete('transaksi_layanan',array('kode_transaksi' => $kode_transaksi));

// ============================================== Insert Baru =====================================================
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_batal_temp.kode_transaksi');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_batal_temp.kode_periksa');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_batal_temp.kode_dokter');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_batal_temp.kode_terapis');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_batal_temp.jenis_item');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_batal_temp.kode_item');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_batal_temp.qty');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_batal_temp.hpp');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_batal_temp.harga');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_batal_temp.jenis_diskon');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_batal_temp.diskon_persen');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_batal_temp.diskon_rupiah');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_batal_temp.subtotal');

		$this->db->select('clouoid1_olive_master.master_produk.real_stock as real_stock_produk');
		$this->db->select('clouoid1_olive_master.master_produk.insentif_masker');
		$this->db->select('clouoid1_olive_cs.opsi_transaksi_reservasi.qty_sisa');
		$this->db->select('clouoid1_olive_cs.opsi_transaksi_reservasi.qty_diambil');

		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->from('clouoid1_olive_kasir.opsi_transaksi_batal_temp');
		$this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_kasir.opsi_transaksi_batal_temp.kode_item = clouoid1_olive_master.master_produk.kode_produk', 'left');
		$this->db->join('clouoid1_olive_master.master_perawatan', 'clouoid1_olive_kasir.opsi_transaksi_batal_temp.kode_item = clouoid1_olive_master.master_perawatan.kode_perawatan', 'left');
		$this->db->join('clouoid1_olive_cs.opsi_transaksi_reservasi', 'clouoid1_olive_kasir.opsi_transaksi_batal_temp.kode_transaksi = clouoid1_olive_cs.opsi_transaksi_reservasi.kode_reservasi and clouoid1_olive_kasir.opsi_transaksi_batal_temp.kode_item = clouoid1_olive_cs.opsi_transaksi_reservasi.kode_item', 'left');
		
		$data_temp=$this->db->get()->result();
		$get_id_petugas = $this->session->userdata('astrosession');
		$hpp_penjualan  = 0;
		foreach ($data_temp as $daftar) {
			$hpp_penjualan+=@$daftar->qty * @$daftar->hpp;

			$record['kode_transaksi']=@$temp->kode_transaksi_baru;
			$record['tanggal_transaksi']=date('Y-m-d');
			$record['kode_member']=@$post['kode_member'];
			$record['kode_dokter']=@$temp->kode_dokter;
			$record['kode_item']=@$temp->kode_item;
			$record['qty']=@$temp->qty;
			$this->db->insert('data_record_anggota', $record);

			if(@$daftar->ambil_paket=='Ya'){
				$masukan['qty_sisa'] = @$daftar->qty_sisa - $daftar->qty;
				$masukan['qty_diambil'] = @$daftar->qty_diambil + $daftar->qty;

				$this->db->where('kode_item', $daftar->kode_item);
				$this->db->update('opsi_transaksi_reservasi',$masukan,array('kode_reservasi' => @$daftar->kode_reservasi));
				if(@$masukan['qty_sisa'] <= 0){
					$tr_reservasi['status'] = 'selesai';
					$this->db->update('transaksi_reservasi',$tr_reservasi,array('kode_reservasi' => @$daftar->kode_reservasi));
				}else{
					$tr_reservasi['status'] = 'menunggu';
					$this->db->update('clouoid1_olive_cs.transaksi_reservasi',$tr_reservasi,array('kode_reservasi' => @$value['kode_reservasi']));
				}
			}

			if($daftar->jenis_item == 'Treatment' || $daftar->jenis_item == 'treatment'){
				$this->db->where('clouoid1_olive_master.opsi_master_perawatan.kode_perawatan', @$daftar->kode_item);
				$this->db->select('clouoid1_olive_master.master_perlengkapan.real_stock as real_stock_perlengkapan');

				$this->db->select('clouoid1_olive_master.opsi_master_perawatan.jenis');
				$this->db->select('clouoid1_olive_master.opsi_master_perawatan.kode_perlengkapan');
				$this->db->select('clouoid1_olive_master.opsi_master_perawatan.kode_bahan');
				$this->db->select('clouoid1_olive_master.opsi_master_perawatan.qty');
				$this->db->select('clouoid1_olive_master.master_bahan_baku.real_stock as real_stock_bahan');

				$this->db->from('clouoid1_olive_master.opsi_master_perawatan');
				$this->db->join('clouoid1_olive_master.master_perlengkapan', 'clouoid1_olive_master.opsi_master_perawatan.kode_perlengkapan = clouoid1_olive_master.master_perlengkapan.kode_perlengkapan', 'left');
				$this->db->join('clouoid1_olive_master.master_bahan_baku', 'clouoid1_olive_master.opsi_master_perawatan.kode_bahan = clouoid1_olive_master.master_bahan_baku.kode_bahan_baku', 'left');
				$opsi_perawatan=$this->db->get()->result();
				foreach ($opsi_perawatan as $opsi_per) {
					if($opsi_per->jenis=='Perlengkapan'){

						$this->db->where('kode_perlengkapan', @$opsi_per->kode_perlengkapan);
						$this->db->set('real_stock',@$opsi_per->real_stock_perlengkapan - (@$daftar->qty * @$opsi_per->qty));
						$this->db->from('clouoid1_olive_master.master_perlengkapan');
						$this->db->update();
					}else{
						$this->db->where('kode_bahan_baku', @$opsi_per->kode_bahan);
						$this->db->set('real_stock',@$opsi_per->real_stock_bahan - (@$daftar->qty * @$opsi_per->qty));
						$this->db->from('clouoid1_olive_master.master_bahan_baku');
						$this->db->update();
					}
				}
			}else{
				$this->db->where('kode_produk', @$daftar->kode_item);
				$this->db->set('real_stock',@$daftar->real_stock_produk - @$daftar->qty);
				$this->db->from('clouoid1_olive_master.master_produk');
				$this->db->update();
			}
			$trans_stok['jenis_transaksi'] = 'penjualan';
			$trans_stok['kode_transaksi'] = @$kode_transaksi_baru;
			$trans_stok['kategori_bahan'] = @$daftar->jenis_item;
			$trans_stok['kode_bahan'] = $daftar->kode_item;
			$trans_stok['stok_keluar'] = $daftar->qty;
			$trans_stok['hpp'] = $daftar->harga;
			$trans_stok['id_petugas'] = $get_id_petugas->id;
			$trans_stok['tanggal_transaksi'] = date('Y-m-d');
			$trans_stok['posisi_awal'] = 'gudang';
			$trans_stok['posisi_akhir'] = 'customer';

			$insert_trans_stok = $this->db->insert('clouoid1_olive_gudang.transaksi_stok', $trans_stok);

			$opsi_layanan['kode_transaksi'] = $kode_transaksi_baru;
			$opsi_layanan['kode_periksa'] = @$daftar->kode_periksa;
			$opsi_layanan['kode_dokter'] = @$daftar->kode_dokter;
			$opsi_layanan['kode_terapis'] = @$daftar->kode_terapis;
			$opsi_layanan['jenis_item'] = @$daftar->jenis_item;
			$opsi_layanan['kode_item'] = @$daftar->kode_item;
			$opsi_layanan['qty'] = @$daftar->qty;
			$opsi_layanan['hpp'] = @$daftar->hpp;
			$opsi_layanan['harga'] = @$daftar->harga;
			$opsi_layanan['jenis_diskon'] = @$daftar->jenis_diskon;
			$opsi_layanan['diskon_persen'] = @$daftar->diskon_persen;
			$opsi_layanan['diskon_rupiah'] = @$daftar->diskon_rupiah;
			$opsi_layanan['subtotal'] = @$daftar->subtotal;
			$this->db->insert('opsi_transaksi_layanan', $opsi_layanan);


		}

		
		if(@$post['jenis_diskon_transaksi']=='persen'){
			$transaksi['diskon_persen']=@$post['diskon_transaksi'];
		}else{
			$transaksi['diskon_rupiah']=@$post['diskon_transaksi'];
		}
		$transaksi['kode_transaksi']=@$kode_transaksi_baru;
		$transaksi['kode_layanan']=@$hasil_transaksi_pelayanan->kode_layanan;
		$transaksi['kode_kasir']=@$post['kode_kasir'];
		$transaksi['tanggal_transaksi']=date('Y-m-d');
		$transaksi['kode_member']=@$post['kode_member'];
		$transaksi['kategori_diskon']=@$post['kategori_diskon'];
		$transaksi['jenis_diskon']=@$post['jenis_diskon_transaksi'];
		if(@$post['jenis_diskon_transaksi']=='persen'){
			$transaksi['diskon_persen']=@$post['diskon_transaksi'];
		}else{
			$transaksi['diskon_rupiah']=@$post['diskon_transaksi'];
		}
		if(@$post['kategori_diskon']=='promo'){
			$transaksi['kode']=@$post['kode_promo'];
		}elseif (@$post['kategori_diskon']=='merchant') {
			$transaksi['kode']=@$post['kode_merchant'];
		}
		$transaksi['total_layanan']=@$post['total_pesanan'];
		$transaksi['grand_total']=@$post['grand_total'];
		$transaksi['dibayar']=@$post['dibayar'];
		$transaksi['kembalian']=@$post['kembalian'];
		$transaksi['jenis_transaksi']=@$post['jenis_transaksi'];
		$transaksi['nama_bank']=@$post['nama_bank'];
		$transaksi['nomor_rekening']=@$post['nomor_rekening'];
		$transaksi['id_petugas']=$get_id_petugas->id;
		$transaksi['jam_penjualan']=date('H:i:s');
		$transaksi['status']='selesai';

		$this->db->insert('transaksi_layanan', $transaksi);
		echo $this->db->last_query();

		$get_nama_layanan = $this->db->get_where('transaksi_layanan',array('kode_transaksi'=>$post['kode_transaksi_baru']));
		$hasil_get_nama_layanan = $get_nama_layanan->row();
		if (@$hasil_get_nama_layanan->kode_layanan != '03') {
			$this->db->select('poin');
			$this->db->select('kategori_member');
			$this->db->where('kode_member', @$post['kode_member']);
			$this->db->from('clouoid1_olive_master.master_member');
			$poin_member = $this->db->get();
			$hasil_poin_member = $poin_member->row();
			if ($hasil_poin_member->kategori_member == 'Member') {
				$this->db->from('clouoid1_olive_master.setting_poin');
				$get_poin = $this->db->get();
				$hasil_get_poin = $get_poin->row();

				if(empty($hasil_poin_member)){
					if ($post['grand_total'] >= @$hasil_get_poin->nominal_transaksi) {
						$total_poin=@$post['grand_total']/@$hasil_get_poin->nominal_transaksi;

						$this->db->where('kode_member', $post['kode_member']);
						$this->db->set('poin',floor($total_poin));
						$this->db->from('clouoid1_olive_master.master_member');
						$this->db->update();

					}
				}else{
					if ($post['grand_total'] >= @$hasil_get_poin->nominal_transaksi) {
						$total_poin=@$post['grand_total']/@$hasil_get_poin->nominal_transaksi;

						$this->db->where('kode_member', $post['kode_member']);
						$this->db->set('poin',@$hasil_poin_member->poin + (floor($total_poin)));
						$this->db->from('clouoid1_olive_master.master_member');
						$this->db->update();
					}
				}
			}
		}


		$this->db->select('poin');
		$this->db->select('kategori_member');
		$this->db->where('kode_member', @$post['kode_member']);
		$this->db->from('clouoid1_olive_master.master_member');
		$poin_member = $this->db->get();
		$hasil_poin_member = $poin_member->row();
		if ($hasil_poin_member->kategori_member == 'Member') {
			$this->db->from('clouoid1_olive_master.setting_poin');
			$get_poin = $this->db->get();
			$hasil_get_poin = $get_poin->row();

			if(empty($hasil_poin_member)){
				if ($post['grand_total'] >= @$hasil_get_poin->nominal_transaksi) {
					$total_poin=@$post['grand_total']/@$hasil_get_poin->nominal_transaksi;
					
					$this->db->where('kode_member', $post['kode_member']);
					$this->db->set('poin',floor($total_poin));
					$this->db->from('clouoid1_olive_master.master_member');
					$this->db->update();

				}
			}else{
				if ($post['grand_total'] >= @$hasil_get_poin->nominal_transaksi) {
					$total_poin=@$post['grand_total']/@$hasil_get_poin->nominal_transaksi;

					$this->db->where('kode_member', $post['kode_member']);
					$this->db->set('poin',@$hasil_poin_member->poin + (floor($total_poin)));
					$this->db->from('clouoid1_olive_master.master_member');
					$this->db->update();
				}
			}
		}

		$keuangan['kode_jenis_keuangan'] = '1';
		$keuangan['kode_kategori_keuangan'] = '1.1';
		$kode_sub = '';
		if ($post['jenis_transaksi'] == 'tunai') {
			$kode_sub = '1.1.1';
		} elseif ($post['jenis_transaksi'] == 'debit') {
			$kode_sub = '1.1.2';
		}else {
			$kode_sub = '1.1.5';
		}

		$keuangan['kode_sub_kategori_keuangan'] = $kode_sub;
		$keuangan['nominal'] = @$post['dibayar'];
		$keuangan['tanggal_transaksi'] = date('Y-m-d');
		$keuangan['id_petugas'] =@$get_id_petugas->id;
		$keuangan['kode_referensi'] = $post['kode_transaksi_baru'];
		$this->db->insert('clouoid1_olive_keuangan.keuangan_masuk', $keuangan);

		$this->db->select('kode_jenis_akun');
		$this->db->select('kode_sub_kategori_akun');
		$this->db->where('kode_sub_kategori_akun', '2.6.2');
		$this->db->from('clouoid1_olive_keuangan.keuangan_sub_kategori_akun');
		$kategori_keluar = $this->db->get();
		$hasil_kategori_keluar = $kategori_keluar->row();

		$keuangan['kode_jenis_keuangan'] = $hasil_kategori_keluar->kode_jenis_akun;
		$keuangan['kode_kategori_keuangan'] = '2.6';
		$keuangan['kode_sub_kategori_keuangan'] = $hasil_kategori_keluar->kode_sub_kategori_akun;
		$keuangan['nominal'] = $hpp_penjualan;
		$keuangan['tanggal_transaksi'] = date('Y-m-d');
		$keuangan['id_petugas'] =@$get_id_petugas->id;
		$keuangan['kode_referensi'] = $post['kode_transaksi_baru'];
		$this->db->insert('clouoid1_olive_keuangan.keuangan_keluar', $keuangan);

		$this->simpan_arus_kas('Pendapatan','1.1.1','Penjualan',@$post['grand_total']);
		$this->simpan_laba_rugi('Pemasukan','1.1.1','Penjualan',@$post['grand_total']);
		$this->simpan_laba_rugi('Pengeluaran',@$hasil_kategori_keluar->kode_sub_kategori_akun,'HPP',$hpp_penjualan);

		$this->db->delete('opsi_transaksi_batal_temp',array('kode_transaksi' => @$kode_transaksi));
	}

	public function simpan_batal_transaksi()
	{
		$post = $this->input->post();
		$kode_transaksi=@$post['kode_transaksi'];
		$transaksi_pelayanan = $this->db->get_where('transaksi_layanan', array('kode_transaksi' => $kode_transaksi));
		$hasil_transaksi_pelayanan = $transaksi_pelayanan->row();

		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_transaksi');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_periksa');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_dokter');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_terapis');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.jenis_item');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.qty');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.hpp');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.harga');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.jenis_diskon');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.diskon_persen');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.diskon_rupiah');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.subtotal');

		$this->db->select('clouoid1_olive_master.master_produk.real_stock as real_stock_produk');
		$this->db->select('clouoid1_olive_master.master_produk.insentif_masker');
		$this->db->select('clouoid1_olive_cs.opsi_transaksi_reservasi.qty_sisa');
		$this->db->select('clouoid1_olive_cs.opsi_transaksi_reservasi.qty_diambil');

		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->from('clouoid1_olive_kasir.opsi_transaksi_layanan');
		$this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_master.master_produk.kode_produk', 'left');
		$this->db->join('clouoid1_olive_master.master_perawatan', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_master.master_perawatan.kode_perawatan', 'left');
		$this->db->join('clouoid1_olive_cs.opsi_transaksi_reservasi', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_transaksi = clouoid1_olive_cs.opsi_transaksi_reservasi.kode_reservasi and clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_cs.opsi_transaksi_reservasi.kode_item', 'left');
		
		$data_temp=$this->db->get()->result();
		$hpp_penjualan  = 0;
		foreach ($data_temp as $value) {
			$hpp_penjualan+=@$value->qty * @$value->hpp;

			$opsi['kode_transaksi']=@$value->kode_transaksi;
			$opsi['kode_kasir']=@$hasil_transaksi_pelayanan->kode_kasir;
			$opsi['kode_reservasi']=@$value->kode_reservasi;
			$opsi['kode_periksa']=@$value->kode_periksa;
			$opsi['kode_dokter']=@$value->kode_dokter;
			$opsi['kode_terapis']=@$value->kode_terapis;
			$opsi['jenis_item']=@$value->jenis_item;
			$opsi['kode_item']=@$value->kode_item;
			$opsi['qty']=@$value->qty;
			$opsi['qty_poin']=@$value->qty_poin;
			$opsi['hpp']=@$value->hpp;
			$opsi['harga']=@$value->harga;
			$opsi['poin_terpakai']=@$value->poin_terpakai;
			$opsi['jenis_diskon']=@$value->jenis_diskon;
			$opsi['diskon_persen']=@$value->diskon_persen;
			$opsi['diskon_rupiah']=@$value->diskon_rupiah;
			$opsi['subtotal']=@$value->subtotal;
			$this->db->insert('opsi_transaksi_batal', $opsi);
			if(@$value->ambil_paket=='Ya'){
				$masukan['qty_sisa'] = @$value->qty_sisa + @$value['qty'];
				$masukan['qty_diambil'] =  @$value->qty_diambil - $value->qty;

				$this->db->where('kode_item', @$value['kode_item']);
				$this->db->update('clouoid1_olive_cs.opsi_transaksi_reservasi',$masukan,array('kode_reservasi' => @$value['kode_reservasi']));
				if(@$masukan['qty_sisa'] <= 0){
					$tr_reservasi['status'] = 'selesai';
					$this->db->update('clouoid1_olive_cs.transaksi_reservasi',$tr_reservasi,array('kode_reservasi' => @$value['kode_reservasi']));
				}else{
					$tr_reservasi['status'] = 'menunggu';
					$this->db->update('clouoid1_olive_cs.transaksi_reservasi',$tr_reservasi,array('kode_reservasi' => @$value['kode_reservasi']));
				}
			}
			if($value->jenis_item == 'Treatment' || $value->jenis_item == 'treatment'){
				$this->db->where('clouoid1_olive_master.opsi_master_perawatan.kode_perawatan', @$value->kode_item);
				$this->db->select('clouoid1_olive_master.master_perlengkapan.real_stock as real_stock_perlengkapan');

				$this->db->select('clouoid1_olive_master.opsi_master_perawatan.jenis');
				$this->db->select('clouoid1_olive_master.opsi_master_perawatan.kode_perlengkapan');
				$this->db->select('clouoid1_olive_master.opsi_master_perawatan.kode_bahan');
				$this->db->select('clouoid1_olive_master.opsi_master_perawatan.qty');
				$this->db->select('clouoid1_olive_master.master_bahan_baku.real_stock as real_stock_bahan');

				$this->db->from('clouoid1_olive_master.opsi_master_perawatan');
				$this->db->join('clouoid1_olive_master.master_perlengkapan', 'clouoid1_olive_master.opsi_master_perawatan.kode_perlengkapan = clouoid1_olive_master.master_perlengkapan.kode_perlengkapan', 'left');
				$this->db->join('clouoid1_olive_master.master_bahan_baku', 'clouoid1_olive_master.opsi_master_perawatan.kode_bahan = clouoid1_olive_master.master_bahan_baku.kode_bahan_baku', 'left');
				$opsi_perawatan=$this->db->get()->result();
				foreach ($opsi_perawatan as $opsi_per) {
					if($opsi_per->jenis=='Perlengkapan'){

						$this->db->where('kode_perlengkapan', @$opsi_per->kode_perlengkapan);
						$this->db->set('real_stock',@$opsi_per->real_stock_perlengkapan + (@$value->qty * @$opsi_per->qty));
						$this->db->from('clouoid1_olive_master.master_perlengkapan');
						$this->db->update();
					}else{
						$this->db->where('kode_bahan_baku', @$opsi_per->kode_bahan);
						$this->db->set('real_stock',@$opsi_per->real_stock_bahan + (@$value->qty * @$opsi_per->qty));
						$this->db->from('clouoid1_olive_master.master_bahan_baku');
						$this->db->update();
					}
				}
			}else{
				$this->db->where('kode_produk', @$value->kode_item);
				$this->db->set('real_stock',@$value->real_stock_produk + @$value->qty);
				$this->db->from('clouoid1_olive_master.master_produk');
				$this->db->update();
			}

		}
		

		if (@$hasil_transaksi_pelayanan->kode_layanan != '03') {
			$this->db->select('poin');
			$this->db->select('kategori_member');
			$this->db->where('kode_member', @$post['kode_member']);
			$this->db->from('clouoid1_olive_master.master_member');
			$poin_member = $this->db->get();
			$hasil_poin_member = $poin_member->row();

			if (@$hasil_poin_member->kategori_member == 'Member') {
				$this->db->from('clouoid1_olive_master.setting_poin');
				$get_poin = $this->db->get();
				$hasil_get_poin = $get_poin->row();

				if(!empty($hasil_poin_member)){
					if ($hasil_transaksi_pelayanan->grand_total >= @$hasil_get_poin->nominal_transaksi) {
						$total_poin=@$hasil_transaksi_pelayanan->grand_total/@$hasil_get_poin->nominal_transaksi;
						$hasil_poin['poin'] = @$hasil_poin_member->poin - (floor($total_poin));
						$this->db->update('clouoid1_olive_master.master_member', $hasil_poin, array('kode_member'=>$post['kode_member'])); 
					}
				}
			}
		}

		$this->db->select('kode_jenis_akun');
		$this->db->select('kode_sub_kategori_akun');
		$this->db->where('kode_sub_kategori_akun', '2.6.2');
		$this->db->from('clouoid1_olive_keuangan.keuangan_sub_kategori_akun');
		$kategori_keluar = $this->db->get();
		$hasil_kategori_keluar = $kategori_keluar->row();

		$this->update_arus_kas('Pendapatan','1.1.1','Penjualan',@$hasil_transaksi_pelayanan->grand_total);
		$this->update_laba_rugi('Pemasukan','1.1.1','Penjualan',@$hasil_transaksi_pelayanan->grand_total);
		$this->update_laba_rugi('Pengeluaran',@$hasil_kategori_keluar->kode_sub_kategori_akun,'HPP',$hpp_penjualan);

		$this->db->delete('data_record_anggota',array('kode_transaksi' => $kode_transaksi));
		$this->db->delete('clouoid1_olive_keuangan.insentif_terapis',array('kode_transaksi' => $kode_transaksi));
		$this->db->delete('clouoid1_olive_gudang.transaksi_stok',array('kode_transaksi' => $kode_transaksi));
		$this->db->delete('clouoid1_olive_keuangan.keuangan_masuk',array('kode_referensi' => $kode_transaksi));
		$this->db->delete('clouoid1_olive_keuangan.keuangan_keluar',array('kode_referensi' => $kode_transaksi));
		$this->db->delete('opsi_transaksi_layanan',array('kode_transaksi' => $kode_transaksi));
		$this->db->delete('transaksi_layanan',array('kode_transaksi' => $kode_transaksi));
	}
	public function update_arus_kas($jenis_keuangan,$kode_kategori_keuangan,$nama_kategori_keuangan,$nominal){
		$tanggal=date('Y-m-d');
		$bulan=date('m',strtotime($tanggal));
		$tahun=date('Y',strtotime($tanggal));

		$this->db->select('nominal');
		$get_laporan_arus_kas   = $this->db->get_where('clouoid1_olive_keuangan.laporan_arus_kas',array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		$hasil_laporan_arus_kas  = $get_laporan_arus_kas->row();
		if(!empty($hasil_laporan_arus_kas)){
			$update_arus_kas['nominal']=$hasil_laporan_arus_kas->nominal - $nominal;
			$this->db->update('clouoid1_olive_keuangan.laporan_arus_kas',$update_arus_kas,array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		}

	}
	public function update_laba_rugi($jenis_keuangan,$kode_kategori_keuangan,$nama_kategori_keuangan,$nominal){
		$tanggal=date('Y-m-d');
		$bulan=date('m',strtotime($tanggal));
		$tahun=date('Y',strtotime($tanggal));

		$this->db->select('nominal');
		$get_laporan_laba_rugi   = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		$hasil_laporan_laba_rugi  = $get_laporan_laba_rugi->row();
		if(!empty($hasil_laporan_laba_rugi)){
			$update_laba_rugi['nominal']=$hasil_laporan_laba_rugi->nominal - $nominal;
			$this->db->update('clouoid1_olive_keuangan.laporan_laba_rugi',$update_laba_rugi,array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		}

	}
	public function simpan_arus_kas($jenis_keuangan,$kode_kategori_keuangan,$nama_kategori_keuangan,$nominal){
		$tanggal=date('Y-m-d');
		$bulan=date('m',strtotime($tanggal));
		$tahun=date('Y',strtotime($tanggal));

		$this->db->select('nominal');
		$get_laporan_arus_kas   = $this->db->get_where('clouoid1_olive_keuangan.laporan_arus_kas',array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		$hasil_laporan_arus_kas  = $get_laporan_arus_kas->row();
		if(!empty($hasil_laporan_arus_kas)){
			$update_arus_kas['nominal']=$hasil_laporan_arus_kas->nominal +$nominal;
			$this->db->update('clouoid1_olive_keuangan.laporan_arus_kas',$update_arus_kas,array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		}else{

			$insert_arus_kas['jenis_keuangan']=$jenis_keuangan;
			$insert_arus_kas['kode_kategori_keuangan']=@$kode_kategori_keuangan;
			$insert_arus_kas['nama_kategori_keuangan']=@$nama_kategori_keuangan;
			$insert_arus_kas['nominal']=$nominal;
			$insert_arus_kas['tanggal']=$tanggal;
			$insert_arus_kas['bulan']=$bulan;
			$insert_arus_kas['tahun']=$tahun;
			$this->db->insert('clouoid1_olive_keuangan.laporan_arus_kas',$insert_arus_kas);
		}

	}
	public function simpan_laba_rugi($jenis_keuangan,$kode_kategori_keuangan,$nama_kategori_keuangan,$nominal){
		$tanggal=date('Y-m-d');
		$bulan=date('m',strtotime($tanggal));
		$tahun=date('Y',strtotime($tanggal));

		$this->db->select('nominal');
		$get_laporan_laba_rugi   = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		$hasil_laporan_laba_rugi  = $get_laporan_laba_rugi->row();
		if(!empty($hasil_laporan_laba_rugi)){
			$update_laba_rugi['nominal']=$hasil_laporan_laba_rugi->nominal +$nominal;
			$this->db->update('clouoid1_olive_keuangan.laporan_laba_rugi',$update_laba_rugi,array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		}else{

			$insert_laba_rugi['jenis_keuangan']=$jenis_keuangan;
			$insert_laba_rugi['kode_kategori_keuangan']=@$kode_kategori_keuangan;
			$insert_laba_rugi['nama_kategori_keuangan']=@$nama_kategori_keuangan;
			$insert_laba_rugi['nominal']=$nominal;
			$insert_laba_rugi['tanggal']=$tanggal;
			$insert_laba_rugi['bulan']=$bulan;
			$insert_laba_rugi['tahun']=$tahun;
			$this->db->insert('clouoid1_olive_keuangan.laporan_laba_rugi',$insert_laba_rugi);
		}

	}
	public function print_invoice()
	{
		$this->db->from('clouoid1_olive_master.master_setting');
		$setting = $this->db->get();
		$hasil_setting = $setting->row();

		$kode_transaksi = $this->input->post('kode_penjualan');   
		$transaksi = $this->db->get_where('transaksi_layanan',array('kode_transaksi'=>$kode_transaksi));
		$hasil_transaksi = $transaksi->row();

		$this->db->where('kode_member',@$hasil_transaksi->kode_member);
		$this->db->from('clouoid1_olive_master.master_member');
		$get_member = $this->db->get();
		$hasil_member = $get_member->row();

		$printTestText  = align_center(62,$hasil_setting->nama_perusahaan)."\n";
		$printTestText .= align_center(62,$hasil_setting->web_resto)."\n";
		$printTestText .= align_center(62,$hasil_setting->alamat_perusahaan)."\n";
		$printTestText .= align_center(62,$hasil_setting->telp_perusahaan)."\n";
		$printTestText .= repeat_value(62,'_')."\n";
		$printTestText .= align_left(28,'No.Nota : '.$hasil_transaksi->kode_transaksi)."         ".align_left(26,'Tanggal : '.tanggalIndo($hasil_transaksi->tanggal_transaksi))."\n";
		$printTestText .= align_left(28,'No.RM   : '.$hasil_transaksi->kode_member)."         ".align_left(26,'Kasir   : '."Olive")."\n";
		$printTestText .= align_left(62,'Nama Pasien : '.$hasil_member->nama_member)."\n";
		$printTestText .= repeat_value(62,'_')."\n";
		$printTestText .= align_left(20,'ITEM')." ".align_left(7,'QTY')." ".align_right(11,'HARGA')." ".align_center(9,'DISC')." ".align_right(11,'SUBTOTAL')."\n";
		$printTestText .= repeat_value(62,'_')."\n";
		$subtotal = 0;
		$jmlTTL = 0;

		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.jenis_item');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.kode_item');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.qty');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.hpp');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.harga');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.jenis_diskon');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.diskon_persen');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.diskon_rupiah');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.subtotal');

		$this->db->select('clouoid1_olive_master.master_produk.nama_produk');

		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->from('clouoid1_olive_kasir.opsi_transaksi_layanan_temp');
		$this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_kasir.opsi_transaksi_layanan_temp.kode_item = clouoid1_olive_master.master_produk.kode_produk', 'left');
		$this->db->join('clouoid1_olive_master.kartu_member', 'clouoid1_olive_kasir.opsi_transaksi_layanan_temp.kode_item = clouoid1_olive_master.kartu_member.kode_kartu_member', 'left');
		$data_temp=$this->db->get()->result();
		foreach ($data_temp as $value) {
			if($value->jenis_item!='kartu member'){
				$nama_produk = substr($value->nama_produk,0 ,20);
			}else{
				$nama_produk = substr('Kartu Member',0 ,20);
			}
			

			$printTestText .= align_left(20,@$nama_produk)." ";
			$printTestText .= align_center(7,@$value->qty)." ";
			$printTestText .= align_right(11,format_angka(@$value->harga))." ";
			if ($value->jenis_diskon == 'persen') {
				$printTestText .= align_center(9,@$value->diskon_persen.''.'%')." ";
			} else {
				$printTestText .= align_center(9,format_angka(@$value->diskon_rupiah))." ";
			}
			$printTestText .= align_right(11,format_angka($value->subtotal))."\n";
			$subtotal += $value->subtotal;
			$jmlTTL += $value->qty;
		}
		$printTestText .= repeat_value(62,'_')."\n";
		$printTestText .= align_left(20,'Pembayaran : '.$hasil_transaksi->jenis_transaksi)." ".align_left(15,'Jam Mulai : '.'-')." ".align_left(25,'Jam Selesai : '.$hasil_transaksi->jam_penjualan)."\n";
		$printTestText .= repeat_value(62,'_')."\n\n";
		$printTestText .= align_left(62,'TOTAL   : '.@format_angka(@$hasil_transaksi->total_layanan))."\n";
		if ($hasil_transaksi->diskon_persen != '') { 
			$diskon = $hasil_transaksi->diskon_persen; 
		} 
		else { 
			$diskon = $hasil_transaksi->diskon_rupiah;
		}
		$printTestText .= align_left(62,'POTONGAN: '.$diskon)."\n";
		$printTestText .= align_left(62,'JUMLAH  : '.format_angka($hasil_transaksi->grand_total))."\n";
		$printTestText .= align_left(62,'BAYAR   : '.format_angka($hasil_transaksi->dibayar))."\n";
		$printTestText .= align_left(62,'KEMBALI : '.format_angka($hasil_transaksi->kembalian))."\n";
		if ($hasil_member->poin == '') { 
			$poin = '0'; 
		} else { 
			$poin =$hasil_member->poin; 
		}
		$this->db->from('clouoid1_olive_master.setting_poin');
		$get_poin = $this->db->get();
		$hasil_get_poin = $get_poin->row();
		if ($hasil_member->kategori_member == 'Member') {
			$hasil_poin = round($hasil_transaksi->grand_total/$hasil_get_poin->nominal_transaksi, 0, PHP_ROUND_HALF_DOWN);
		}
		$printTestText  .= align_center(62,'Anda Mendapat '.$hasil_poin.' Stamp')."\n";
		$printTestText  .= align_center(62,'Total '.$poin.' Stamp')."\n";
		$printTestText  .= align_center(62,'-- TERIMA KASIH ATAS KUNJUNGAN ANDA --')."\n\n\n\n";

		print_r($printTestText);
		// $handle = printer_open($hasil_setting->printer);
		// printer_set_option($handle, PRINTER_MODE, "RAW");
		// $font = printer_create_font("Roman Condensed", 10, 25, 300, false, false, false, 0);
		// printer_select_font($handle, $font);
		// printer_write($handle, $printTestText);
		// printer_close($handle);
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class order_paket extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{	
		$data['konten'] = $this->load->view('order_paket', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function proses()
	{	
		$data['konten'] = $this->load->view('order_paket', NULL, TRUE);
		$this->load->view ('admin/main', $data);

		@$kode_reservasi=$this->uri->segment(4);
		if(!empty($kode_reservasi)){
			$this->db->where('kode_transaksi', $kode_reservasi);
			$get_opsi=$this->db->get('olive_cs.opsi_transaksi_order_paket')->result();

			$this->db->delete('opsi_transaksi_layanan_temp',array('kode_transaksi' =>@$kode_reservasi));
			foreach ($get_opsi as  $value) {
				$opsi['kode_transaksi']=$value->kode_transaksi;
				$opsi['jenis_item']=$value->jenis_item;
				$opsi['kode_item']=$value->kode_item;
				$opsi['qty']=$value->qty;
				$opsi['harga']=$value->harga;
				$opsi['hpp']=$value->hpp;
				$opsi['subtotal']=$value->subtotal;
				$this->db->insert('opsi_transaksi_layanan_temp', $opsi);
			}
		}
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function list_transaksi()
	{
		$data['konten'] = $this->load->view('list_transaksi', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function pendaftaran_layanan()
	{
		$data['konten'] = $this->load->view('pendaftaran_layanan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah_kasir()
	{
		$data['konten'] = $this->load->view('kasir', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function get_harga()
	{
		$data = $this->input->post();

		$this->db->select('harga_jual');
		$treatment = $this->db->get_where('olive_master.master_perawatan', array('kode_perawatan' => $data['kode_treatment']));
		$hasil_treatment = $treatment->row();
		echo json_encode($hasil_treatment);
	}

	public function get_harga_paket()
	{
		$data = $this->input->post();

		$this->db->select('harga_jual');
		$paket = $this->db->get_where('olive_master.master_paket', array('kode_paket' => $data['kode_paket']));
		$hasil_paket = $paket->row();
		echo json_encode($hasil_paket);
	}
	
	public function get_data_member()
	{	
		$kode_member=$this->input->post('kode_member');
		$this->db->where('kode_member', $kode_member);
		$this->db->from('olive_master.master_member');
		$get_member=$this->db->get()->row();
		echo json_encode($get_member);
	}

	public function add_item_temp()
	{

		$jenis_reservasi 	= $this->input->post('jenis_reservasi');
		$kode_reservasi 	= $this->input->post('kode_reservasi');
		$kode_member 		= $this->input->post('kode_member');
		$kode_paket 		= $this->input->post('kode_paket');
		$kode_treatment 	= $this->input->post('kode_treatment');
		$jenis_diskon 		= $this->input->post('jenis_diskon');
		$diskon_persen 		= $this->input->post('diskon_persen');
		$diskon_rupiah 		= $this->input->post('diskon_rupiah');


		if($jenis_reservasi == 'Paket'){
			$this->db->where('kode_transaksi', $kode_reservasi);
			$this->db->where('kode_item', $kode_paket);
			$get_temp = $this->db->get('opsi_transaksi_layanan_temp')->num_rows();
			if(empty($get_temp)){

				$master_paket 	= $this->db->get_where("olive_master.master_paket", array("kode_paket"=>$kode_paket))->row();

				$data['kode_transaksi'] = $kode_reservasi;
				$data['jenis_item'] = $jenis_reservasi;
				$data['kode_item'] = $kode_paket;
				$data['qty'] = '1';
				$data['hpp'] = $master_paket->hpp;
				$data['harga'] = $master_paket->harga_jual;
				$data['jenis_diskon'] = $jenis_diskon;
				if($jenis_diskon == 'persen'){
					$data['diskon_persen'] = $diskon_persen;
					$data['diskon_rupiah'] = $master_paket->harga_jual * $diskon_persen/100 ;
				} else{
					$data['diskon_rupiah'] = $diskon_rupiah;
				}
				$data['subtotal'] = $master_paket->harga_jual - $data['diskon_rupiah'];

				$this->db->insert("opsi_transaksi_layanan_temp",$data);
				$feedback['proses'] = 'berhasil';
			} else{
				$feedback['proses'] = 'data_ada';
			}
		}else{
			$this->db->where('kode_transaksi', $kode_reservasi);
			$this->db->where('kode_item', $kode_treatment);
			$get_temp = $this->db->get('opsi_transaksi_layanan_temp')->num_rows();
			if(empty($get_temp)){

				$master_perawatan = $this->db->get_where("olive_master.master_perawatan", array("kode_perawatan"=>$kode_treatment))->row();

				$data['kode_transaksi'] = $kode_reservasi;
				$data['jenis_item'] = $jenis_reservasi;
				$data['kode_item'] = $kode_treatment;
				$data['qty'] = '1';
				$data['hpp'] = $master_perawatan->hpp;
				$data['harga'] = $master_perawatan->harga_jual;
				$data['jenis_diskon'] = $jenis_diskon;
				if($jenis_diskon == 'persen'){
					$data['diskon_persen'] = $diskon_persen;
					$data['diskon_rupiah'] = $master_perawatan->harga_jual * $diskon_persen/100 ;
				} else{
					$data['diskon_rupiah'] = $diskon_rupiah;
				}
				$data['subtotal'] = $master_perawatan->harga_jual - $data['diskon_rupiah'];

				$this->db->insert("opsi_transaksi_layanan_temp",$data);
				$feedback['proses'] = 'berhasil';
			} else{
				$feedback['proses'] = 'data_ada';
			}
		}

		$this->db->where('kode_transaksi', $kode_reservasi);
		$this->db->select('sum(subtotal) as total_transaksi');
		$get_total = $this->db->get('opsi_transaksi_layanan_temp')->row();
		$feedback['total_transaksi'] = $get_total->total_transaksi;
		echo json_encode($feedback);
	}

	public function hapus_temp(){
		$id = $this->input->post('id');
		$kode_reservasi = $this->input->post('kode_reservasi');
		$this->db->where('kode_transaksi', $kode_reservasi);
		$this->db->delete('opsi_transaksi_layanan_temp');

		$this->db->where('kode_transaksi', $kode_reservasi);
		$this->db->select('sum(subtotal) as total_transaksi');
		$get_total = $this->db->get('opsi_transaksi_layanan_temp')->row();
		$feedback['total_transaksi'] = $get_total->total_transaksi;
		echo json_encode($feedback);
	}

	public function delete_item_temp()
	{
		$data['id'] = $this->input->post("id");
		$this->db_cs->delete("opsi_transaksi_layanan_temp",$data);
	}

	public function load_tabel_temp()
	{
		$kode_transaksi = $this->uri->segment(4);
		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->select('opsi.*');
		$this->db->select('pkt.nama_paket');
		$this->db->select('prw.nama_perawatan');
		$this->db->from('opsi_transaksi_layanan_temp opsi');
		$this->db->join('olive_master.master_paket pkt', 'opsi.kode_item = pkt.kode_paket', 'left');
		$this->db->join('olive_master.master_perawatan prw', 'opsi.kode_item = prw.kode_perawatan', 'left');
		$get_temp = $this->db->get();

		$temp['result'] 	= $get_temp->result();
		$temp['num_rows'] 	= $get_temp->num_rows();
		$this->load->view("tabel_transaksi_temp",$temp);
	}
	public function get_total_pesanan()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$jenis_diskon_transaksi=$this->input->post('jenis_diskon_transaksi');
		$diskon_transaksi=$this->input->post('diskon_transaksi');

		$this->db->select_sum('subtotal');
		$get_temp=$this->db->get_where('opsi_transaksi_layanan_temp',array('kode_transaksi' => $kode_transaksi))->row();

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
	public function batal_transaksi()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$this->db->delete('opsi_transaksi_layanan_temp',array('kode_transaksi' => $kode_transaksi));
	}
	public function simpan_transaksi()
	{
		$jenis_reservasi = $this->input->post('jenis_reservasi');
		$kode_reservasi = $this->input->post('kode_reservasi');
		$kode_member = $this->input->post('kode_member');
		$jenis_diskon = $this->input->post('jenis_diskon');
		$diskon_persen = $this->input->post('diskon_persen');
		$diskon_rupiah = $this->input->post('diskon_rupiah');
		$jenis_transaksi = $this->input->post('jenis_transaksi');
		$kategori_diskon = $this->input->post('kategori_diskon');
		$kode_promo = $this->input->post('kode_promo');
		$kode_merchant = $this->input->post('kode_merchant');
		$total = $this->input->post('total');
		$grand_total = $this->input->post('grand_total');
		$dibayar = $this->input->post('dibayar');
		$kembalian = $this->input->post('kembalian');
		$nama_bank = $this->input->post('nama_bank');
		$nomor_rekening = $this->input->post('nomor_rekening');
		$jenis_diskon_transaksi = $this->input->post('jenis_diskon_transaksi');
		$diskon_transaksi = $this->input->post('diskon_transaksi');

		$get_user = $this->session->userdata('astrosession');
		$user = $get_user->id;

		$this->db->where('petugas', $user);
		$this->db->where('status', 'open');
		$get_kasir = $this->db->get('transaksi_kasir')->row();

		$this->db->where('kode_transaksi', $kode_reservasi);
		$get_temp = $this->db->get('opsi_transaksi_layanan_temp')->result_array();
		$hpp_penjualan=0;
		foreach ($get_temp as $temp) {
			unset($temp['id']);
			$hpp_penjualan+=@$temp['qty']* @$temp['hpp'];
			$this->db->insert('opsi_transaksi_layanan', $temp);
		}

		$this->db->where('kode_transaksi', $kode_reservasi);
		$this->db->select('opsi_transaksi_layanan_temp.kode_transaksi');
		$this->db->select('opsi_transaksi_layanan_temp.kode_item');
		if($jenis_reservasi == 'Paket'){
			$this->db->select('pkt.kode_treatment');
			$this->db->select('pkt.jenis_produk');
			$this->db->select('pkt.qty');
			$this->db->join('olive_master.opsi_master_paket pkt', 'opsi_transaksi_layanan_temp.kode_item = pkt.kode_paket', 'left');
		}
		$this->db->from('opsi_transaksi_layanan_temp');
		$get_detail_temp = $this->db->get()->result();
		
		foreach ($get_detail_temp as $detail_temp) {
			$data['kode_reservasi'] = $kode_reservasi;
			if($jenis_reservasi == 'Paket'){
				$data['kode_item'] = $detail_temp->kode_treatment;
				$data['jenis_item'] = $detail_temp->jenis_produk;
				$data['qty_item'] = $detail_temp->qty;
			} else{
				$data['kode_item'] = $detail_temp->kode_item;
				$data['jenis_item'] = 'treatment';
				$data['qty_item'] = '1';
			}
			$data['qty_diambil'] = '0';
			$data['qty_sisa'] = $data['qty_item'];
			$data['status'] = 'proses';
			$this->db->insert('olive_cs.opsi_transaksi_reservasi', $data);
		}
		$data_reservasi['kode_reservasi'] = $kode_reservasi;
		$data_reservasi['tanggal_transaksi'] = date('Y-m-d');
		$data_reservasi['kode_member'] = $kode_member;
		$data_reservasi['status'] = 'menunggu';

		$this->db->insert('olive_cs.transaksi_reservasi', $data_reservasi);

		if($jenis_reservasi == 'Paket'){
			
		}else{
			$insert_data['kode_layanan'] = '01';
		}
		$insert_data['kode_transaksi'] = $kode_reservasi;
		$insert_data['kode_kasir'] = @$get_kasir->kode_transaksi;
		$insert_data['tanggal_transaksi'] = date('Y-m-d');
		$insert_data['kode_member'] = $kode_member;
		$insert_data['kategori_diskon'] = $kategori_diskon;
		if($kategori_diskon=='promo'){
			$insert_data['kode'] = @$kode_promo;
		}else if ($kategori_diskon=='merchant') {
			$insert_data['kode'] = @$kode_merchant;
		}
		$insert_data['jenis_diskon'] = $jenis_diskon_transaksi;
		if(@$jenis_diskon_transaksi=='persen'){
			$insert_data['diskon_persen']=@$diskon_transaksi;
		}else{
			$insert_data['diskon_rupiah']=@$diskon_transaksi;
		}
		$insert_data['total_layanan'] = $total;
		$insert_data['grand_total'] = $grand_total;
		$insert_data['dibayar'] = $dibayar;
		$insert_data['kembalian'] = $kembalian;
		$insert_data['jenis_transaksi'] = $jenis_transaksi;
		$insert_data['nama_bank'] = @$nama_bank;
		$insert_data['nomor_rekening'] = $nomor_rekening;
		$insert_data['id_petugas'] = $user;
		$insert_data['jam_penjualan'] = date('H:i:s');
		$insert_data['status'] = 'selesai';

		$this->db->insert('transaksi_layanan', $insert_data);

		$this->db->select('poin');
		$this->db->select('kategori_member');
		$this->db->where('kode_member', @$kode_member);
		$this->db->from('olive_master.master_member');
		$poin_member = $this->db->get();
		$hasil_poin_member = $poin_member->row();

		if ($hasil_poin_member->kategori_member == 'Member') {
			$this->db->from('olive_master.setting_poin');
			$get_poin = $this->db->get();
			$hasil_get_poin = $get_poin->row();

			if(empty($hasil_poin_member->poin)){
				if ($grand_total >= @$hasil_get_poin->nominal_transaksi) {
					$total_poin=@$grand_total/@$hasil_get_poin->nominal_transaksi;
					
					$this->db->where('kode_member', $kode_member);
					$this->db->set('poin',floor($total_poin));
					$this->db->from('olive_master.master_member');
					$this->db->update();

				}
			}else{
				if ($grand_total >= @$hasil_get_poin->nominal_transaksi) {
					$total_poin=@$grand_total/@$hasil_get_poin->nominal_transaksi;

					$this->db->where('kode_member', $kode_member);
					$this->db->set('poin',@$hasil_poin_member->poin + (floor($total_poin)));
					$this->db->from('olive_master.master_member');
					$this->db->update();
				}
			}
		}

		$order_paket['status'] = 'selesai';
		$this->db->update('olive_cs.transaksi_order_paket', $order_paket,array('kode_transaksi' =>@$kode_reservasi));

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
		$keuangan['nominal'] = @$dibayar;
		$keuangan['tanggal_transaksi'] = date('Y-m-d');
		$keuangan['id_petugas'] = $kode_petugas;
		$keuangan['kode_referensi'] = @$kode_reservasi;
		$this->db->insert('olive_keuangan.keuangan_masuk', $keuangan);

		$this->db->select('kode_jenis_akun');
		$this->db->select('kode_sub_kategori_akun');
		$this->db->where('kode_sub_kategori_akun', '2.6.2');
		$this->db->from('olive_keuangan.keuangan_sub_kategori_akun');
		$kategori_keluar = $this->db->get();
		$hasil_kategori_keluar = $kategori_keluar->row();

		$keuangan['kode_jenis_keuangan'] = $hasil_kategori_keluar->kode_jenis_akun;
		$keuangan['kode_kategori_keuangan'] = '2.6';
		$keuangan['kode_sub_kategori_keuangan'] = $hasil_kategori_keluar->kode_sub_kategori_akun;
		$keuangan['nominal'] = $hpp_penjualan;
		$keuangan['tanggal_transaksi'] = date('Y-m-d');
		$keuangan['id_petugas'] = $kode_petugas;
		$keuangan['kode_referensi'] = @$kode_reservasi;
		$this->db->insert('olive_keuangan.keuangan_keluar', $keuangan);

		$this->simpan_arus_kas('Pendapatan','1.1.1','Penjualan',@$grand_total);
		$this->simpan_laba_rugi('Pemasukan','1.1.1','Penjualan',@$grand_total);
		$this->simpan_laba_rugi('Pengeluaran',@$hasil_kategori_keluar->kode_sub_kategori_akun,'HPP',$hpp_penjualan);

		$this->db->delete('opsi_transaksi_layanan_temp',array('kode_transaksi' => $kode_reservasi));
		$feedback['proses'] = 'berhasil';
		echo json_encode($feedback);
	}
	public function simpan_arus_kas($jenis_keuangan,$kode_kategori_keuangan,$nama_kategori_keuangan,$nominal){
		$tanggal=date('Y-m-d');
		$bulan=date('m',strtotime($tanggal));
		$tahun=date('Y',strtotime($tanggal));

		$this->db->select('nominal');
		$get_laporan_arus_kas   = $this->db->get_where('olive_keuangan.laporan_arus_kas',array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		$hasil_laporan_arus_kas  = $get_laporan_arus_kas->row();
		if(!empty($hasil_laporan_arus_kas)){
			$update_arus_kas['nominal']=$hasil_laporan_arus_kas->nominal +$nominal;
			$this->db->update('olive_keuangan.laporan_arus_kas',$update_arus_kas,array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		}else{

			$insert_arus_kas['jenis_keuangan']=$jenis_keuangan;
			$insert_arus_kas['kode_kategori_keuangan']=@$kode_kategori_keuangan;
			$insert_arus_kas['nama_kategori_keuangan']=@$nama_kategori_keuangan;
			$insert_arus_kas['nominal']=$nominal;
			$insert_arus_kas['tanggal']=$tanggal;
			$insert_arus_kas['bulan']=$bulan;
			$insert_arus_kas['tahun']=$tahun;
			$this->db->insert('olive_keuangan.laporan_arus_kas',$insert_arus_kas);
		}

	}
	public function simpan_laba_rugi($jenis_keuangan,$kode_kategori_keuangan,$nama_kategori_keuangan,$nominal){
		$tanggal=date('Y-m-d');
		$bulan=date('m',strtotime($tanggal));
		$tahun=date('Y',strtotime($tanggal));

		$this->db->select('nominal');
		$get_laporan_laba_rugi   = $this->db->get_where('olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		$hasil_laporan_laba_rugi  = $get_laporan_laba_rugi->row();
		if(!empty($hasil_laporan_laba_rugi)){
			$update_laba_rugi['nominal']=$hasil_laporan_laba_rugi->nominal +$nominal;
			$this->db->update('olive_keuangan.laporan_laba_rugi',$update_laba_rugi,array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		}else{

			$insert_laba_rugi['jenis_keuangan']=$jenis_keuangan;
			$insert_laba_rugi['kode_kategori_keuangan']=@$kode_kategori_keuangan;
			$insert_laba_rugi['nama_kategori_keuangan']=@$nama_kategori_keuangan;
			$insert_laba_rugi['nominal']=$nominal;
			$insert_laba_rugi['tanggal']=$tanggal;
			$insert_laba_rugi['bulan']=$bulan;
			$insert_laba_rugi['tahun']=$tahun;
			$this->db->insert('olive_keuangan.laporan_laba_rugi',$insert_laba_rugi);
		}

	}
}

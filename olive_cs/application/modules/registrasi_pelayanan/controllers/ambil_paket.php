<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ambil_paket extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{	
		$data['konten'] = $this->load->view('ambil_paket', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	
	public function detail()
	{	
		$data['konten'] = $this->load->view('ambil_paket', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function simpan_ambil_data(){
		$data = $this->input->post();



		$data_user 	= $this->session->userdata('astrosession');
		$data 		= $this->input->post();	
		$get_total  = 0 ;


		$kode_layanan_paket = 'PKT_'.date('ymdhis');
		$this->db->select('olive_cs.opsi_transaksi_reservasi.id');
		$this->db->select('olive_master.master_perawatan.hpp hpp_perawatan');
		$this->db->select('olive_master.master_perawatan.harga_jual harga_perawatan');
		$this->db->select('olive_master.master_produk.hpp hpp_produk');
		$this->db->select('olive_master.master_produk.harga_jual harga_produk');
		$this->db->select('olive_cs.opsi_transaksi_reservasi.jenis_item,kode_item,qty_diambil');
		$this->db->from('olive_cs.opsi_transaksi_reservasi');
		$this->db->join('olive_master.master_perawatan','olive_master.master_perawatan.kode_perawatan = olive_cs.opsi_transaksi_reservasi.kode_item','left');
		$this->db->join('olive_master.master_produk','olive_master.master_produk.kode_produk = olive_cs.opsi_transaksi_reservasi.kode_item','left');
		$this->db->where('olive_cs.opsi_transaksi_reservasi.kode_reservasi', $data['kode_reservasi']);
		$data_transaksi = $this->db->get()->result();
		foreach ($data_transaksi as $value) {	
			$input_kasir['kode_transaksi'] 	= $kode_layanan_paket;
			$input_kasir['jenis_item'] 		= $value->jenis_item;
			$input_kasir['kode_item'] 		= $value->kode_item;
			$input_kasir['qty'] 			= @$data['qty_diambil_'.$value->id];
			$input_kasir['diskon_persen'] 	= '0';
			$input_kasir['ambil_paket'] 	= 'Ya';
			if ($value->jenis_item == 'treatment') {
				$input_kasir['hpp'] 		= $value->hpp_perawatan;
				$input_kasir['harga'] 		= $value->harga_perawatan;
			}else{
				$input_kasir['hpp'] 		= $value->hpp_produk;
				$input_kasir['harga'] 		= $value->harga_produk;
			}
			$subtotal						= @$data['qty_diambil_'.$value->id] * $input_kasir['harga'];
			$get_total 						= $get_total + $subtotal; 
			$insert_opsi_layanan            = $this->db->insert('olive_kasir.opsi_transaksi_layanan', $input_kasir);
		}

		$get_opsi = $this->db->get_where('opsi_transaksi_reservasi', array('kode_reservasi' => $data['kode_reservasi'],'status' => 'proses' ))->result();
		foreach ($get_opsi as $value) {
			$update_opsi['qty_diambil'] = $data['qty_diambil_'.$value->id] + $value->qty_diambil;
			$update_opsi['qty_sisa'] 	= $value->qty_item - ($data['qty_diambil_'.$value->id] + $value->qty_diambil);

			if ($update_opsi['qty_sisa'] > 0) {
				$status = 'Proses';
			}else{
				$status = 'Selesai';
			}
			$update_opsi['status'] 		= $status;

			$this->db->where('id',$value->id);
			$this->db->update('olive_cs.opsi_transaksi_reservasi', $update_opsi);
		}

		$data_utama['kode_transaksi'] 		= $kode_layanan_paket;
		$data_utama['tanggal_transaksi'] 	= date('Y-m-d');
		$data_utama['kode_member'] 			= $data['kode_member'];
		$data_utama['total_layanan'] 		= $get_total;
		$data_utama['grand_total'] 		    = $get_total;
		$data_utama['jam_penjualan']	    = date('h:i:s');
		$data_utama['status'] 				= 'proses';
		
		$insert_utama = $this->db->insert('olive_kasir.transaksi_layanan', $data_utama);
		if ($insert_utama) {
			$out['response'] = 'sukses';
		}else{
			$out['response'] = 'gagal';
		}

		echo json_encode($out);
		$this->print_invoice($kode_layanan_paket);
	}

	public function print_invoice($kode_layanan_paket)
	{
		$setting = $this->db->get('olive_master.master_setting');
		$hasil_setting = $setting->row();

		$this->db->from('olive_kasir.transaksi_layanan layanan');
		$this->db->join('olive_master.master_member member','member.kode_member = layanan.kode_member','left');
		$this->db->where('layanan.kode_transaksi',$kode_layanan_paket);
		$hasil_transaksi = $this->db->get()->row();
		
		$printTestText  = align_center(62,'KARTU PERAWATAN')."\n";
		$printTestText .= repeat_value(62,'_')."\n";
		$printTestText .= align_center(62,'TANGGAL : '.tanggalIndo($hasil_transaksi->tanggal_transaksi))."\n";
		$printTestText .= repeat_value(62,'_')."\n";
		$printTestText .= align_left(62,'No. RM   : '.$hasil_transaksi->kode_member)."\n";
		$printTestText .= align_left(62,'Nama     : '.$hasil_transaksi->nama_member)."\n";
		$printTestText .= align_left(62,'Alamat   : '.$hasil_transaksi->alamat_member)."\n";
		$printTestText .= repeat_value(62,'_');
		$printTestText .= "\n".align_left(48,'Jenis Perawatan')."  ".align_right(10,'Terapis')."\n";
		$printTestText .= repeat_value(62,'_')."\n";

		$this->db->from('olive_kasir.opsi_transaksi_layanan layanan');
		$this->db->join('olive_master.master_perawatan','olive_master.master_perawatan.kode_perawatan = layanan.kode_item','left');
		$this->db->join('olive_master.master_produk','olive_master.master_produk.kode_produk = layanan.kode_item','left');
		$this->db->where('layanan.kode_transaksi',$kode_layanan_paket);
		$opsi_transaksi = $this->db->get();
		$hasil_opsi_transaksi = $opsi_transaksi->result();
		foreach ($hasil_opsi_transaksi as $value) {
			$nama_item = $value->nama_perawatan.''.$value->nama_produk;
			$printTestText .= align_left(48,$nama_item)."  ".align_right(10,'')."\n";
		}
		

		$printTestText .= repeat_value(62,'_')."\n";
		$printTestText .= align_left(62,'Keterangan  : '.'-')."\n";
		$printTestText .= align_left(62,'Jam Masuk   : '.$hasil_transaksi->jam_penjualan)."\n";
		$printTestText .= align_left(62,'Jam Selesai : '.'-')."\n\n\n\n";

		//print_r($printTestText);

		$handle = printer_open($hasil_setting->printer2);
		printer_set_option($handle, PRINTER_MODE, "RAW");
		$font = printer_create_font("Roman Condensed", 10, 25, 300, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_write($handle, $printTestText);
		printer_close($handle);
	}
}


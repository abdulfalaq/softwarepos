<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class registrasi_pelayanan extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}

	}

	public function index()
	{
		$data['konten'] = $this->load->view('registrasi_pelayanan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function logout()
	{
		$this->session->unset_userdata('astrosession');
		$this->session->sess_destroy();
		clearstatcache();
		redirect($this->cname);
	}

	public function simpan_member()
	{
		$input = $this->input->post();
		$insert = $this->db->insert('olive_master.kartu_member',$input);
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}

	public function simpan_konsultasi(){
		$data_user = $this->session->userdata('astrosession');
		$data = $this->input->post();
		
		$data['tanggal_transaksi'] 	= date('Y-m-d');
		$data['jam_registrasi'] 	= date('H:i:s');
		$data['status'] 			= 'menunggu';
		$data['id_petugas'] 		= $data_user->id;

		$this->db->insert('transaksi_registrasi', $data);
		$kode_registrasi = $data['kode_transaksi'];
		$this->print_invoice($kode_registrasi);

	}

	public function verifikasi(){
		$data['konten'] = $this->load->view('verifikasi_konsul', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}


	public function simpan_periksa(){
		$data_user = $this->session->userdata('astrosession');
		$data = $this->input->post();

		
		$data['tanggal_transaksi'] 	= date('Y-m-d');
		$data['jam_registrasi'] 	= date('H:i:s');
		$data['status'] 			= 'menunggu';
		$data['id_petugas'] 		= $data_user->id;

		$this->db->insert('transaksi_registrasi', $data);
		$kode_registrasi = $data['kode_transaksi'];
		$this->print_invoice($kode_registrasi);

	}

	public function add_perawatan_temp(){
		$data = $this->input->post();
		
		$this->db->where('kode_transaksi',$data['kode_transaksi']);
		$this->db->where('kode_item',$data['kode_item']);
		$get_temp = $this->db->get('opsi_transaksi_registrasi_temp')->row();
		if (count($get_temp) > 0) {
			$out['response'] = 'ada';
		}else{
			$data['qty']= '1';
			$insert = $this->db->insert('opsi_transaksi_registrasi_temp', $data);
			if ($insert) {
				$out['response'] = 'sukses';
			}else{
				$out['response'] = 'gagal';
			}
		}

		echo json_encode($out);
	}

	public function simpan_treatment(){
		$data_user 	= $this->session->userdata('astrosession');
		$data 		= $this->input->post();	
		$get_total  = 0 ;
		$this->db->from('olive_cs.opsi_transaksi_registrasi_temp');
		$this->db->join('olive_master.master_perawatan','olive_master.master_perawatan.kode_perawatan = olive_cs.opsi_transaksi_registrasi_temp.kode_item','left');
		$this->db->where('olive_cs.opsi_transaksi_registrasi_temp.kode_transaksi', $data['kode_transaksi']);
		$data_transaksi = $this->db->get()->result();
		foreach ($data_transaksi as $value) {	
			$input_kasir['kode_transaksi'] 	= $value->kode_transaksi;
			$input_kasir['jenis_item'] 		= 'Treatment';
			$input_kasir['kode_item'] 		= $value->kode_item;
			$input_kasir['qty'] 			= '1';
			$input_kasir['hpp'] 			= $value->hpp;
			$input_kasir['harga'] 			= $value->harga_jual;
			$input_kasir['diskon_persen'] 	= '0';
			$input_kasir['subtotal'] 		= $value->harga_jual;
			$get_total 						= $value->harga_jual + $get_total; 
			$insert_opsi_layanan            = $this->db->insert('olive_kasir.opsi_transaksi_layanan', $input_kasir);
		}

		$get_temp = $this->db->get_where('opsi_transaksi_registrasi_temp', array('kode_transaksi'=> $data['kode_transaksi']))->result();
		foreach ($get_temp as $value) {		

			$update['kode_transaksi'] = $value->kode_transaksi;
			$update['kode_item']	  = $value->kode_item;
			$update['qty'] 			  = $value->qty;

			$this->db->insert('opsi_transaksi_registrasi', $update);
			
			$this->db->where('id', $value->id);
			$this->db->delete('opsi_transaksi_registrasi_temp');
		}

		$data_utama['kode_transaksi'] 		= $data['kode_transaksi'];
		$data_utama['tanggal_transaksi'] 	= date('Y-m-d');
		$data_utama['kode_layanan'] 		= $data['kode_layanan'];
		$data_utama['kode_member'] 			= $data['kode_member'];
		$data_utama['total_layanan'] 		= $get_total;
		$data_utama['grand_total'] 		    = $get_total;
		$data_utama['status'] 				= 'proses';
		
		$insert_utama = $this->db->insert('olive_kasir.transaksi_layanan', $data_utama);

		$data['tanggal_transaksi'] 	= date('Y-m-d');
		$data['jam_registrasi'] 	= date('H:i:s');
		$data['status'] 			= 'proses';
		$data['id_petugas'] 		= $data_user->id;

		$this->db->insert('transaksi_registrasi', $data);

		$kode_registrasi = $data['kode_transaksi'];
		$this->print_invoice($kode_registrasi);
	}

	public function get_table_produk_temp(){
		$this->load->view('table_perawatan_temp');
	}

	public function update_data_opsi(){
		$data = $this->input->post();
		$updates['qty'] = $data['qty'];
		$update = $this->db->update('opsi_transaksi_registrasi',$updates, array('id' => $data['id'] ));
		$this->db->where('id', $data['id']);
		$get_registrasi = $this->db->get('opsi_transaksi_registrasi')->row();

		$this->db->where('kode_transaksi', @$get_registrasi->kode_transaksi);
		$this->db->where('kode_item', @$get_registrasi->kode_item);
		$get_opsi_layanan = $this->db->get('olive_kasir.opsi_transaksi_layanan')->row();

		$opsi_layanan['qty']=$data['qty'];
		$opsi_layanan['subtotal']=@$get_opsi_layanan->harga * $data['qty'];
		$this->db->update('olive_kasir.opsi_transaksi_layanan',$opsi_layanan, array('kode_transaksi' => @$get_registrasi->kode_transaksi,'kode_item'=>@$get_registrasi->kode_item ));

		if ($update) {
			$out['response'] = 'sukses';
		}else{
			$out['response'] = 'gagal';
		}

		echo json_encode($out);
	}

	public function delete_temp_perawatan(){
		$data = $this->input->post('id');
		
		$this->db->where('id', $data);
		$this->db->delete('opsi_transaksi_registrasi_temp');
	}

	public function hapus_data_opsi(){
		$data = $this->input->post();
		
		$this->db->where('id', $data['id']);
		$get_registrasi = $this->db->get('opsi_transaksi_registrasi')->row();

		$this->db->delete('olive_kasir.opsi_transaksi_layanan', array('kode_transaksi' => @$get_registrasi->kode_transaksi,'kode_item'=>@$get_registrasi->kode_item ));

		$delete = $this->db->delete('opsi_transaksi_registrasi', array('id' => $data['id'] ));
		if ($delete) {
			$out['response'] = 'sukses';
		}else{
			$out['response'] = 'gagal';
		}

		echo json_encode($out);
	}

	public function get_table_all(){
		$this->load->view('table_all_data');
	}

	public function get_member(){
		$kode_member 	= $this->input->post('kode_member');

		$this->db->where('kode_member', $kode_member);
		$data = $this->db->get('olive_master.master_member')->row();


		echo json_encode($data);
	}

	public function simpan_registrasi(){
		$data = $this->input->post();

		$this->db->where('kode_transaksi', @$data['kode_transaksi']);
		$this->db->select_sum('subtotal');
		$data_opsi=$this->db->get('olive_kasir.opsi_transaksi_layanan')->row();
		
		$updates['status'] = 'proses';
		$update = $this->db->update('transaksi_registrasi',$updates, array('kode_transaksi' => $data['kode_transaksi'] ));

		$updates_kasir['status'] = 'proses';
		$updates_kasir['total_layanan'] = @$data_opsi->subtotal;
		$updates_kasir['grand_total'] = @$data_opsi->subtotal;
		$update = $this->db->update('olive_kasir.transaksi_layanan',$updates_kasir, array('kode_transaksi' => $data['kode_transaksi'] ));
		
		
		if ($update) {
			$out['response'] = 'sukses';
		}else{
			$out['response'] = 'gagal';
		}

		echo json_encode($out);
		$this->print_registrasi(@$data['kode_transaksi']);
	}
	public function print_registrasi($kode_transaksi)
	{
		$setting = $this->db->get('olive_master.master_setting');
		$hasil_setting = $setting->row();

		$this->db->from('olive_kasir.transaksi_layanan');
		$this->db->join('olive_master.master_member','olive_master.master_member.kode_member = olive_kasir.transaksi_layanan.kode_member','left');
		$this->db->where('olive_kasir.transaksi_layanan.kode_transaksi',$kode_transaksi);
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


		$this->db->from('olive_cs.opsi_transaksi_registrasi');
		$this->db->join('olive_master.master_perawatan','olive_master.master_perawatan.kode_perawatan = olive_cs.opsi_transaksi_registrasi.kode_item','left');
		$this->db->where('olive_cs.opsi_transaksi_registrasi.kode_transaksi',$kode_transaksi);
		$opsi_transaksi = $this->db->get();
		$hasil_opsi_transaksi = $opsi_transaksi->result();
		foreach ($hasil_opsi_transaksi as $value) {
			$printTestText .= align_left(48,$value->nama_perawatan)."  ".align_right(10,'')."\n";
		}
		
		$printTestText .= repeat_value(62,'_')."\n";
		$printTestText .= align_left(62,'Keterangan  : '.'-')."\n";
		$printTestText .= align_left(62,'Jam Selesai : '.'-')."\n\n\n\n";

		//print_r($printTestText);

		$handle = printer_open($hasil_setting->printer2);
		printer_set_option($handle, PRINTER_MODE, "RAW");
		$font = printer_create_font("Roman Condensed", 10, 25, 300, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_write($handle, $printTestText);
		printer_close($handle);
	}
	public function print_invoice($kode_registrasi)
	{
		$setting = $this->db->get('olive_master.master_setting');
		$hasil_setting = $setting->row();

		$this->db->from('olive_cs.transaksi_registrasi');
		$this->db->join('olive_master.master_member','olive_master.master_member.kode_member = olive_cs.transaksi_registrasi.kode_member','left');
		$this->db->join('olive_master.master_karyawan','olive_master.master_karyawan.kode_karyawan = olive_cs.transaksi_registrasi.kode_dokter','left');
		$this->db->join('olive_master.master_layanan_periksa','olive_master.master_layanan_periksa.kode_periksa = olive_cs.transaksi_registrasi.kode_periksa','left');
		$this->db->where('olive_cs.transaksi_registrasi.kode_transaksi',$kode_registrasi);
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

		if($hasil_transaksi->kode_layanan == '01'){

			$this->db->from('olive_cs.opsi_transaksi_registrasi');
			$this->db->join('olive_master.master_perawatan','olive_master.master_perawatan.kode_perawatan = olive_cs.opsi_transaksi_registrasi.kode_item','left');
			$this->db->where('olive_cs.opsi_transaksi_registrasi.kode_transaksi',$kode_registrasi);
			$opsi_transaksi = $this->db->get();
			$hasil_opsi_transaksi = $opsi_transaksi->result();
			foreach ($hasil_opsi_transaksi as $value) {
				$printTestText .= align_left(48,$value->nama_perawatan)."  ".align_right(10,'')."\n";
			}
		}
		if($hasil_transaksi->kode_layanan == '02'){
			$printTestText .= align_left(48,'Konsul')."  ".align_right(10,'')."\n";
		}
		if($hasil_transaksi->kode_layanan == '03'){
			$printTestText .= align_left(48,'Periksa '.'('.@$hasil_transaksi->nama_periksa.')')."  ".align_right(10,'')."\n";
		}
		$printTestText .= repeat_value(62,'_')."\n";
		$printTestText .= align_left(62,'Nama Dokter : '.$hasil_transaksi->nama_karyawan)."\n";
		$printTestText .= align_left(62,'Keterangan  : '.'-')."\n";
		$printTestText .= align_left(62,'Jam Masuk   : '.$hasil_transaksi->jam_registrasi)."\n";
		$printTestText .= align_left(62,'Jam Selesai : '.'-')."\n\n\n\n";

		//print_r($printTestText);

		$handle = printer_open($hasil_setting->printer2);
		printer_set_option($handle, PRINTER_MODE, "RAW");
		$font = printer_create_font("Roman Condensed", 10, 25, 300, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_write($handle, $printTestText);
		printer_close($handle);
	}
	public function load_data_cari(){
		$this->load->view('registrasi_pelayanan/load_table_cari');
	}
	public function reprint()
	{
		$kode_registrasi = $this->input->post('kode_transaksi');
		$setting = $this->db->get('olive_master.master_setting');
		$hasil_setting = $setting->row();

		$this->db->from('olive_cs.transaksi_registrasi');
		$this->db->join('olive_master.master_member','olive_master.master_member.kode_member = olive_cs.transaksi_registrasi.kode_member','left');
		$this->db->join('olive_master.master_karyawan','olive_master.master_karyawan.kode_karyawan = olive_cs.transaksi_registrasi.kode_dokter','left');
		$this->db->join('olive_master.master_layanan_periksa','olive_master.master_layanan_periksa.kode_periksa = olive_cs.transaksi_registrasi.kode_periksa','left');
		$this->db->where('olive_cs.transaksi_registrasi.kode_transaksi',$kode_registrasi);
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

		if($hasil_transaksi->kode_layanan == '01'){

			$this->db->from('olive_cs.opsi_transaksi_registrasi');
			$this->db->join('olive_master.master_perawatan','olive_master.master_perawatan.kode_perawatan = olive_cs.opsi_transaksi_registrasi.kode_item','left');
			$this->db->where('olive_cs.opsi_transaksi_registrasi.kode_transaksi',$kode_registrasi);
			$opsi_transaksi = $this->db->get();
			$hasil_opsi_transaksi = $opsi_transaksi->result();
			foreach ($hasil_opsi_transaksi as $value) {
				$printTestText .= align_left(48,$value->nama_perawatan)."  ".align_right(10,'')."\n";
			}
		}
		if($hasil_transaksi->kode_layanan == '02'){
			$printTestText .= align_left(48,'Konsul')."  ".align_right(10,'')."\n";
		}
		if($hasil_transaksi->kode_layanan == '03'){
			$printTestText .= align_left(48,'Periksa '.'('.@$hasil_transaksi->nama_periksa.')')."  ".align_right(10,'')."\n";
		}
		$printTestText .= repeat_value(62,'_')."\n";
		$printTestText .= align_left(62,'Nama Dokter : '.$hasil_transaksi->nama_karyawan)."\n";
		$printTestText .= align_left(62,'Keterangan  : '.'-')."\n";
		$printTestText .= align_left(62,'Jam Masuk   : '.$hasil_transaksi->jam_registrasi)."\n";
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

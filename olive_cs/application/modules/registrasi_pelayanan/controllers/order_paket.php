<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class order_paket extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
		// $this->db_master = $this->load->database('olive_master', TRUE);
		// $this->db_cs 	 = $this->load->database('olive_cs', TRUE);
	}

	public function index()
	{	
		$data['konten'] = $this->load->view('order_paket', NULL, TRUE);
		$this->load->view ('admin/main', $data);
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

		$treatment = $this->db->get_where('clouoid1_olive_master.master_perawatan', array('kode_perawatan' => $data['kode_treatment']));
		$hasil_treatment = $treatment->row();
		echo json_encode($hasil_treatment);
	}

	public function get_harga_paket()
	{
		$data = $this->input->post();

		$paket = $this->db->get_where('clouoid1_olive_master.master_paket', array('kode_paket' => $data['kode_paket']));
		$hasil_paket = $paket->row();
		echo json_encode($hasil_paket);
	}
	
	public function logout()
	{
		$this->session->unset_userdata('astrosession');
		$this->session->sess_destroy();
		clearstatcache();
		redirect($this->cname);
	}

	public function add_item_temp()
	{

		$jenis_reservasi 	= $this->input->post('jenis_transaksi');
		$kode_transaksi 	= $this->input->post('kode_transaksi');
		$kode_member 		= $this->input->post('kode_member');
		$kode_paket 		= $this->input->post('kode_paket');
		$kode_treatment 	= $this->input->post('kode_treatment');


		if($jenis_reservasi == 'Paket'){
			$master_paket 	= $this->db->get_where("clouoid1_olive_master.master_paket", array("kode_paket"=>$kode_paket))->row();

			$data['kode_transaksi'] = $kode_transaksi;
			$data['jenis_item'] = $jenis_reservasi;
			$data['kode_item'] = $kode_paket;
			$data['qty'] = '1';
			$data['hpp'] = $master_paket->hpp;
			$data['harga'] = $master_paket->harga_jual;
			$data['subtotal'] = $master_paket->harga_jual;

			$this->db->insert("opsi_transaksi_order_paket_temp",$data);
		}else{
			$master_perawatan = $this->db->get_where("clouoid1_olive_master.master_perawatan", array("kode_perawatan"=>$kode_treatment))->row();

			$data['kode_transaksi'] = $kode_transaksi;
			$data['jenis_item'] = $jenis_reservasi;
			$data['kode_item'] = $kode_treatment;
			$data['qty'] = '1';
			$data['hpp'] = $master_perawatan->hpp;
			$data['harga'] = $master_perawatan->harga_jual;
			$data['subtotal'] = $master_perawatan->harga_jual;

			$this->db->insert("opsi_transaksi_order_paket_temp",$data);
		}
		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->select('sum(subtotal) as total');
		$get_total = $this->db->get('opsi_transaksi_order_paket_temp')->row();

		$feedback['proses'] = 'berhasil';
		$feedback['total'] = $get_total->total;

		echo json_encode($feedback);
	}

	public function hapus_temp(){
		$id 	= $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->delete('opsi_transaksi_order_paket_temp');
	}

	public function delete_item_temp()
	{
		$data['id'] = $this->input->post("id");
		$this->db_cs->delete("opsi_transaksi_order_paket_temp",$data);
	}

	public function load_tabel_temp()
	{
		$kode_transaksi = $this->uri->segment(4);
		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->select('pkt.nama_paket');
		$this->db->select('prw.nama_perawatan');
		$this->db->select('opsi.id,jenis_item');
		$this->db->from('opsi_transaksi_order_paket_temp opsi');
		$this->db->join('clouoid1_olive_master.master_paket pkt', 'opsi.kode_item = pkt.kode_paket', 'left');
		$this->db->join('clouoid1_olive_master.master_perawatan prw', 'opsi.kode_item = prw.kode_perawatan', 'left');
		$get_temp = $this->db->get();
		// echo $this->db->last_query();
		$temp['result'] 	= $get_temp->result();
		$temp['num_rows'] 	= $get_temp->num_rows();
		$this->load->view("table_transaksi_temp",$temp);
	}

	public function simpan_transaksi()
	{
		$jenis_reservasi = $this->input->post('jenis_transaksi');
		$kode_transaksi = $this->input->post('kode_transaksi');
		$kode_member = $this->input->post('kode_member');

		$get_user = $this->session->userdata('astrosession');
		$user = $get_user->id;

		$this->db->where('kode_transaksi', $kode_transaksi);
		$get_temp = $this->db->get('opsi_transaksi_order_paket_temp')->result();
		
		foreach ($get_temp as $temp) {
			$this->db->insert('opsi_transaksi_order_paket', $temp);
		}

		$insert_data['kode_transaksi'] = $kode_transaksi;
		$insert_data['tanggal_transaksi'] = date('Y-m-d');
		$insert_data['kode_member'] = $kode_member;
		$insert_data['id_petugas'] = $user;
		$insert_data['status'] = 'proses';

		$this->db->insert('transaksi_order_paket', $insert_data);

		$this->print_invoice($kode_transaksi);
	}

	public function print_invoice($kode_transaksi)
	{
		$setting = $this->db->get('clouoid1_olive_master.master_setting');
		$hasil_setting = $setting->row();

		$this->db->from('clouoid1_olive_cs.transaksi_order_paket');
		$this->db->join('clouoid1_olive_master.master_member','clouoid1_olive_master.master_member.kode_member = clouoid1_olive_cs.transaksi_order_paket.kode_member','left');
		$this->db->where('clouoid1_olive_cs.transaksi_order_paket.kode_transaksi',$kode_transaksi);
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


		$this->db->from('clouoid1_olive_cs.opsi_transaksi_order_paket');
		$this->db->join('clouoid1_olive_master.master_perawatan','clouoid1_olive_master.master_perawatan.kode_perawatan = clouoid1_olive_cs.opsi_transaksi_order_paket.kode_item','left');
		$this->db->join('clouoid1_olive_master.master_produk','clouoid1_olive_master.master_produk.kode_produk = clouoid1_olive_cs.opsi_transaksi_order_paket.kode_item','left');
		$this->db->where('clouoid1_olive_cs.opsi_transaksi_order_paket.kode_transaksi',$kode_transaksi);
		$opsi_transaksi = $this->db->get();
		$hasil_opsi_transaksi = $opsi_transaksi->result();
		foreach ($hasil_opsi_transaksi as $value) {
			if (!empty($value->nama_perawatan)) {
				$printTestText .= align_left(48,@$value->nama_perawatan)."  ".align_right(10,'')."\n";
			}else{
				$printTestText .= align_left(48,@$value->nama_produk)."  ".align_right(10,'')."\n";
			}
		}
		
		$printTestText .= repeat_value(62,'_')."\n";

		//print_r($printTestText);

		$handle = printer_open($hasil_setting->printer2);
		printer_set_option($handle, PRINTER_MODE, "RAW");
		$font = printer_create_font("Roman Condensed", 10, 25, 300, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_write($handle, $printTestText);
		printer_close($handle);
	}
	
}

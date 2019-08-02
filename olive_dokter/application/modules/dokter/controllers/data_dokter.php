<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_dokter extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		} 
	}

	public function index()
	{
		$data['konten'] = $this->load->view('data_dokter/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function daftar()
	{
		$data['konten'] = $this->load->view('data_dokter/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$data['konten'] = $this->load->view('data_dokter/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('data_dokter/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail()
	{
		$data['konten'] = $this->load->view('data_dokter/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function act_simpan()
	{	
		$data['kode'] 					= trim($this->input->post('kode'));
		$data['nominal_simpanan_wajib'] = trim($this->input->post('nominal'));
		$data['tanggal_aktivasi'] 		= trim($this->input->post('tanggal_aktivasi'));

		$this->db->insert('master_simpanan_wajib',$data);
		echo "success";
	}

	public function act_update()
	{				
		$data['kode'] 					= trim($this->input->post('kode'));
		$data['nominal_simpanan_wajib'] = trim($this->input->post('nominal'));
		$data['tanggal_aktivasi'] 		= trim($this->input->post('tanggal_aktivasi'));

		$id = $this->input->post('id');
		$this->db->where(array('id'=>$id));
		$this->db->update('master_simpanan_wajib',$data);
		echo "success";
	}

	public function act_delete()
	{
		$id = $this->input->post('id');
		$this->db->where(array('id'=>$id));
		$this->db->delete('master_simpanan_wajib');
		echo "delete";
	}

	public function get_table_temp_produk(){
		$this->load->view('data_dokter/table_temp_produk');
	}

	public function get_table_temp_perawatan(){
		$this->load->view('data_dokter/get_table_temp_perawatan');
	}

	public function simpan_produk_opsi(){
		$data = $this->input->post();

		$cek_data = $this->db->get_where('olive_kasir.opsi_transaksi_layanan_temp', array('kode_item' => $data['kode_item'],'kode_transaksi' => $data['kode_transaksi'] ))->row();
		if (count($cek_data) > 0) {
			$out['response'] = 'ada';
		}else{
			$this->db->from('olive_master.master_produk');
			$this->db->join('olive_master.master_kategori_produk', 'olive_master.master_kategori_produk.kode_kategori_produk = olive_master.master_produk.kode_kategori_produk','left');
			$this->db->where('kode_produk',$data['kode_item']);
			$get_produk = $this->db->get()->row();

			if ($get_produk->kode_kategori_produk == 'KP0001') {
				$data['jenis_item'] = 'Oribu';
			} else if ($get_produk->kode_kategori_produk == 'KP0002'){
				$data['jenis_item'] = 'Apotek';
			} else if ($get_produk->kode_kategori_produk == 'KP0003') {
				$data['jenis_item'] = 'Resep';
			}
			
			$data['hpp'] 		= $get_produk->hpp;
			$data['harga'] 		= $get_produk->harga_jual;
			$data['jenis_item'] = $get_produk->nama_kategori_produk;
			$data['subtotal'] 	= $data['qty'] * $get_produk->harga_jual;
			$insert = $this->db->insert('olive_kasir.opsi_transaksi_layanan_temp', $data);
			if ($insert) {
				$out['response'] = 'sukses';
			}else{
				$out['response'] = 'gagal';
			}
		}

		echo json_encode($out);
	}

	public function simpan_perawatan_opsi(){
		$data = $this->input->post();

		$cek_data = $this->db->get_where('olive_kasir.opsi_transaksi_layanan_temp', array('kode_item' => $data['kode_item'],'kode_transaksi' => $data['kode_transaksi'] ))->row();
		if (count($cek_data) > 0) {
			$out['response'] = 'ada';
		}else{
			$this->db->from('olive_master.master_perawatan');
			$this->db->where('kode_perawatan', $data['kode_item']);
			$get_perawatan = $this->db->get_where()->row();

			$data['hpp'] 		= $get_perawatan->hpp;
			$data['harga'] 		= $get_perawatan->harga_jual;
			$data['subtotal'] 	= $data['qty'] * $get_perawatan->harga_jual;
			$data['jenis_item'] = 'Treatment';
			$insert = $this->db->insert('olive_kasir.opsi_transaksi_layanan_temp', $data);
			if ($insert) {
				$out['response'] = 'sukses';
			}else{
				$out['response'] = 'gagal';
			}
		}

		echo json_encode($out);
	}

	public function get_data_opsi(){
		$data = $this->input->post('id');
		$get_produk = $this->db->get_where('olive_kasir.opsi_transaksi_layanan_temp', array('id' => $data ))->row();

		echo json_encode($get_produk);
	}

	public function update_item_produk(){
		$data = $this->input->post();

		$get_perawatan = $this->db->get_where('olive_master.master_produk', array('kode_produk' => $data['kode_item'] ))->row();

		$data['hpp'] 		= $get_perawatan->hpp;
		$data['harga'] 		= $get_perawatan->harga_jual;
		$data['subtotal'] 	= $data['qty'] * $get_perawatan->harga_jual;
		$update = $this->db->update('olive_kasir.opsi_transaksi_layanan_temp', $data, array('id' => $data['id'] ));
		if ($update) {
			$out['response'] = 'sukses';
		}else{
			$out['response'] = 'gagal';
		}
		

		echo json_encode($out);
	}

	public function update_item_perawatan(){
		$data = $this->input->post();

		
		$get_perawatan = $this->db->get_where('olive_kasir.master_perawatan', array('kode_perawatan' => $data['kode_item'] ))->row();

		$data['hpp'] 		= $get_perawatan->hpp;
		$data['harga'] 		= $get_perawatan->harga_jual;
		$data['subtotal'] 	= $data['qty'] * $get_perawatan->harga_jual;
		$update = $this->db->update('olive_kasir.opsi_transaksi_layanan_temp', $data, array('id' => $data['id'] ));
		if ($update) {
			$out['response'] = 'sukses';
		}else{
			$out['response'] = 'gagal';
		}
		

		echo json_encode($out);
	}
	
	public function hapus_opsi_temp(){
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->delete('olive_kasir.opsi_transaksi_layanan_temp');
		echo $this->db->last_query();
	}

	public function simpan_all_data(){
		$data = $this->input->post();

		$get_total = 0;
		$insert_to_opsi = $this->db->get_where('olive_kasir.opsi_transaksi_layanan_temp', array('kode_transaksi' => $data['kode_transaksi'] ))->result();
		foreach ($insert_to_opsi as $value) {
			$insert_opsi['kode_transaksi'] 	= $value->kode_transaksi ;
			$insert_opsi['jenis_item'] 		= $value->jenis_item ;
			$insert_opsi['kode_item'] 		= $value->kode_item ;
			$insert_opsi['qty'] 			= $value->qty ;
			$insert_opsi['hpp'] 			= $value->hpp ;
			$insert_opsi['harga'] 			= $value->harga ;
			$insert_opsi['subtotal'] 		= $value->subtotal ;

			$this->db->insert('olive_kasir.opsi_transaksi_layanan', $insert_opsi);
			$get_total = $insert_opsi['subtotal'] + $get_total;
		}

		foreach ($insert_to_opsi as $value) {
			$insert_opsi_registrasi['kode_transaksi'] 	= $value->kode_transaksi ;			
			$insert_opsi_registrasi['kode_item'] 		= $value->kode_item ;
			$insert_opsi_registrasi['qty'] 				= $value->qty ;

			$this->db->insert('olive_cs.opsi_transaksi_registrasi', $insert_opsi_registrasi);
		}

		$medik['kode_transaksi'] 		= $data['kode_transaksi'];
		$medik['tanggal_transaksi'] 	= date('Y-m-d');
		$medik['kode_dokter'] 			= $data['kode_dokter'];
		$medik['kode_member'] 			= $data['kode_member'];
		$medik['anamnesa'] 				= $data['anamnesa'];
		$medik['diagnosa'] 				= $data['diagnosa'];
		
		$data_medic = $this->db->insert('olive_kasir.data_rekam_medik', $medik);


		if ($data['kode_layanan'] == '02') {
			$data_utama['status']   = 'verifikasi';
			$data_update['status']  = 'verifikasi';
		}
		else{
			$data_utama['status']   = 'proses';
			$data_update['status']  = 'proses';
		}

		$data_utama['kode_transaksi'] 		= $data['kode_transaksi'];
		$data_utama['tanggal_transaksi'] 	= date('Y-m-d');
		$data_utama['kode_member'] 			= $data['kode_member'];
		$data_utama['total_layanan'] 		= $get_total;
		$data_utama['grand_total'] 		    = $get_total;
		
		$insert_utama = $this->db->insert('olive_kasir.transaksi_layanan', $data_utama);

		$this->db->update('transaksi_registrasi', $data_update,array('kode_transaksi' => $data['kode_transaksi'] ));

		$delete_temp = $this->db->get_where('olive_kasir.opsi_transaksi_layanan_temp', array('kode_transaksi' => $data['kode_transaksi'] ))->result();
		foreach ($delete_temp as $value) {
			$this->db->delete('olive_kasir.opsi_transaksi_layanan_temp', array('id' => $value->id ));
		}

		if ($insert_utama) {
			$out['response'] = 'sukses';
		}else{
			$out['response'] = 'gagal';
		}

		echo json_encode($out);
	}



	
}

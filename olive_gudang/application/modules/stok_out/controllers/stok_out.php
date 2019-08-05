<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stok_out extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('stok_out', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function cari_bahan()
	{
		$kode_bahan = $this->input->post('kode_bahan');

		$this->db->from('clouoid1_olive_master.master_bahan_baku');
		$this->db->join('clouoid1_olive_master.master_satuan', 'clouoid1_olive_master.master_satuan.kode = clouoid1_olive_master.master_bahan_baku.kode_satuan_stok');
		$this->db->where('kode_bahan_baku', $kode_bahan);
		$cari_bahan = $this->db->get();
		$hasil_cari = $cari_bahan->row();

		echo json_encode($hasil_cari);      
	}
	public function hapus_temporari_stok(){
		$id = $this->input->post('id');

		$this->db->delete('opsi_transaksi_stok_out_temp', array('id' => $id ));

	}

	public function simpan_temporari()
	{
		$data = $this->input->post();
		
		if ($data['pilih_item'] == 'Bahan' ) {

			$cek_data1   = $this->db->get_where('opsi_transaksi_stok_out_temp', array('kode_bahan_baku' => $data['kode_bahan'], 'jenis_item' => $data['pilih_item'] ))->row();

			if (count($cek_data1) > 0) {
				$ambil['response'] = 'tidak';
			}else{
				$input['kode_bahan_baku'] 	= $data['kode_bahan'];
				$input['kode_stok_out']   	= $data['kode_stok_out'];
				$input['jumlah']   			= $data['jumlah'];
				$input['kode_satuan']   	= $data['satuan'];
				$input['keterangan']   		= $data['keterangan'];
				$input['jenis_item']   		= $data['pilih_item'];

				$insert = $this->db->insert('opsi_transaksi_stok_out_temp',$input);
				if ($insert) {
					$ambil['response'] = 'sukses';
				}else{
					$ambil['response'] = 'gagal';
				}
			}
		}else{
			$cek_data2   = $this->db->get_where('opsi_transaksi_stok_out_temp', array('kode_bahan_baku' => $data['kode_perlengkapan'], 'jenis_item' => $data['pilih_item'] ))->row();

			if (count($cek_data2) > 0) {
				$ambil['response'] = 'tidak';
			}else{
				$input['kode_bahan_baku'] 	= $data['kode_perlengkapan'];
				$input['kode_stok_out']   	= $data['kode_stok_out'];
				$input['jumlah']   			= $data['jumlah'];
				$input['kode_satuan']   	= $data['satuan'];
				$input['keterangan']   		= $data['keterangan'];
				$input['jenis_item']   		= $data['pilih_item'];

				$insert = $this->db->insert('opsi_transaksi_stok_out_temp',$input);
				if ($insert) {
					$ambil['response'] = 'sukses';
				}else{
					$ambil['response'] = 'gagal';
				}

			}
		}

		

		echo json_encode($ambil);
	}

	public function simpan_besar()
	{
		$data = $this->input->post();
		
		

		if ($data['pilih_item']== 'Bahan' ) {

			$get_ayam = $this->db->get_where('opsi_transaksi_stok_out_temp',array('kode_stok_out' => $data['kode_stok_out']))->result();

			foreach ($get_ayam as $value) { 

				$this->db->from('clouoid1_olive_master.master_bahan_baku');
				$this->db->where('kode_bahan_baku', $value->kode_bahan_baku);
				$cari_bahan = $this->db->get();
				$hasil_cari = $cari_bahan->row();


				$masuk['kode_stok_out']     =  $value->kode_stok_out;
				$masuk['kode_bahan_baku']   =  $value->kode_bahan_baku;
				$masuk['jumlah']	  	   	=  $value->jumlah;
				$masuk['kode_satuan']	  	=  $value->kode_satuan;
				$masuk['keterangan']	  	=  $value->keterangan;
				$masuk['jenis_item']	  	=  $value->jenis_item;
				unset($data['pilih_item']);

				$perbarui['real_stock'] = @$hasil_cari->real_stock-$value->jumlah;

				$this->db->where('kode_bahan_baku', $value->kode_bahan_baku);
				$insert = $this->db->update('clouoid1_olive_master.master_bahan_baku', $perbarui);
				$insert = $this->db->insert('opsi_transaksi_stok_out', $masuk);
			}

			$suster['kode_stok_out']      =  $data['kode_stok_out'];
			$suster['tanggal_input']      =  $data['tanggal'];
			$suster['kode_petugas']       =  $data['kode_petugas'];
			unset($data['pilih_item']);	


			$insert = $this->db->insert('transaksi_stok_out', $suster);
			$insert = $this->db->delete('opsi_transaksi_stok_out_temp',array('kode_stok_out' => $data['kode_stok_out']));

			if ($insert) {
				$ambil['response'] = 'sukses';
			}else{
				$ambil['response'] = 'gagal';
			}

		}else if ($data['pilih_item']== 'Perlengkapan') {
			

			$get_ayam2 = $this->db->get_where('opsi_transaksi_stok_out_temp',array('kode_stok_out' => $data['kode_stok_out']))->result();

			foreach ($get_ayam2 as $value) { 

				$this->db->from('clouoid1_olive_master.master_perlengkapan');
				$this->db->where('kode_perlengkapan', $value->kode_bahan_baku);
				$cari_bahan = $this->db->get();
				$hasil_cari = $cari_bahan->row();

				$masuk2['kode_stok_out']     =  $value->kode_stok_out;
				$masuk2['kode_bahan_baku']   =  $value->kode_bahan_baku;
				$masuk2['jumlah']	  	   	=  $value->jumlah;
				$masuk2['kode_satuan']	  	=  $value->kode_satuan;
				$masuk2['keterangan']	  	=  $value->keterangan;
				$masuk2['jenis_item']	  	=  $value->jenis_item;
				unset($data['pilih_item']);
				$perbarui2['real_stock'] = @$hasil_cari->real_stock - $value->jumlah;

				$this->db->where('kode_perlengkapan', $value->kode_bahan_baku);
				$insert = $this->db->update('clouoid1_olive_master.master_perlengkapan', $perbarui2);
				echo $this->db->last_query();
				$insert = $this->db->insert('opsi_transaksi_stok_out', $masuk2);
			}

			$suster2['kode_stok_out']      =  $data['kode_stok_out'];
			$suster2['tanggal_input']      =  $data['tanggal'];
			$suster2['kode_petugas']       =  $data['kode_petugas'];
			unset($data['pilih_item']);	


			$insert = $this->db->insert('transaksi_stok_out', $suster2);
			$insert = $this->db->delete('opsi_transaksi_stok_out_temp',array('kode_stok_out' => $data['kode_stok_out']));

			if ($insert) {
				$ambil['response'] = 'sukses';
			}else{
				$ambil['response'] = 'gagal';
			}


		}

		echo json_encode($ambil);

	}

	public function update_temporari()
	{
		$data = $this->input->post();

		if ($data['pilih_item'] == 'Bahan') {

			$input['kode_bahan_baku'] 	= $data['kode_bahan'];
			$input['kode_stok_out']   	= $data['kode_stok_out'];
			$input['jumlah']   			= $data['jumlah'];
			$input['kode_satuan']   	= $data['satuan'];
			$input['keterangan']   		= $data['keterangan'];
			$input['jenis_item']   		= $data['pilih_item'];

			$this->db->where('id', $data['id']);
			$update1 = $this->db->update('opsi_transaksi_stok_out_temp',$input);
			if ($update1) {
				$data['response'] = 'sukses';
			}else{
				$data['response'] = 'gagal';
			}
		}else{
			$input['kode_bahan_baku'] 	= $data['kode_perlengkapan'];
			$input['kode_stok_out']   	= $data['kode_stok_out'];
			$input['jumlah']   			= $data['jumlah'];
			$input['kode_satuan']   	= $data['satuan'];
			$input['keterangan']   		= $data['keterangan'];
			$input['jenis_item']   		= $data['pilih_item'];

			$this->db->where('id', $data['id']);
			$update2 = $this->db->update('opsi_transaksi_stok_out_temp',$input);
			if ($update2) {
				$data['response'] = 'sukses';
			}else{
				$data['response'] = 'gagal';
			}

		}



		echo json_encode($data);
	}

	public function get_temp_stok()
	{
		$id = $this->input->post('id');

		$this->db->from('clouoid1_olive_gudang.opsi_transaksi_stok_out_temp');

		$this->db->select('clouoid1_olive_gudang.opsi_transaksi_stok_out_temp.id');
		$this->db->select('clouoid1_olive_gudang.opsi_transaksi_stok_out_temp.kode_stok_out');
		$this->db->select('clouoid1_olive_gudang.opsi_transaksi_stok_out_temp.kode_bahan_baku');
		$this->db->select('clouoid1_olive_gudang.opsi_transaksi_stok_out_temp.jumlah');
		$this->db->select('clouoid1_olive_gudang.opsi_transaksi_stok_out_temp.kode_satuan');
		$this->db->select('clouoid1_olive_gudang.opsi_transaksi_stok_out_temp.keterangan');
		$this->db->select('clouoid1_olive_gudang.opsi_transaksi_stok_out_temp.jenis_item');
		$this->db->select('clouoid1_olive_master.master_satuan.alias');

		$this->db->join('clouoid1_olive_master.master_satuan', 'clouoid1_olive_master.master_satuan.kode = clouoid1_olive_gudang.opsi_transaksi_stok_out_temp.kode_satuan', 'left');
		$this->db->where('clouoid1_olive_gudang.opsi_transaksi_stok_out_temp.id', $id);

		$pembelian = $this->db->get();
		$hasil_pembelian = $pembelian->row();
		echo json_encode($hasil_pembelian);
	}

	public function tampil()
	{

		$id = $this->input->post('id');
		$this->load->view('table');
	}

	public function cari_perlengkapan()
	{
		$this->db = $this->load->database('olive_master',TRUE);
		$kode_perlengkapan = $this->input->post('kode_perlengkapan');

		$this->db->from('clouoid1_olive_master.master_perlengkapan');
		$this->db->join('clouoid1_olive_master.master_satuan', 'clouoid1_olive_master.master_satuan.kode = clouoid1_olive_master.master_perlengkapan.kode_satuan_stok');
		$this->db->where('kode_perlengkapan', $kode_perlengkapan);
		$cari_bahan = $this->db->get();
		$hasil_cari = $cari_bahan->row();

		echo json_encode($hasil_cari);      
	}
	public function detail()
	{
		$data['konten'] = $this->load->view('detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$data['konten'] = $this->load->view('tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('stok_out/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function hapus_opsi_stokout_all()
	{
		//$kode_stok_out=$this->input->post('kode_stok_out');
		//$this->db->delete('opsi_transaksi_stok_out_temp', array('kode_stok_out' =>$kode_stok_out));
	}




	public function logout()
	{
		$this->session->unset_userdata('astrosession');
		$this->session->sess_destroy();
		clearstatcache();
		redirect($this->cname);
	}


}

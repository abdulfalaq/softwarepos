<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class adjust extends MY_Controller {

	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
		$this->db_master = $this->load->database('olive_master', TRUE);
	}

	public function index()
	{
		$data['konten'] = $this->load->view('setting', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('adjust/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$data['konten'] = $this->load->view('adjust/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('adjust/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('adjust/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function opsi_jadwal()
	{
		$this->load->view('adjust/opsi_jadwal');
	}

	public function input_opname()
	{
		$data['konten'] = $this->load->view('adjust/opsi_input_opname', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function get_bahan(){
		$get_jenis = $this->input->post('jenis_bahan');

		if ($get_jenis == 'Perlengkapan') {
			$this->db_master->where('status','1');
			$get_perlengkapan = $this->db_master->get('master_perlengkapan')->result();
			foreach ($get_perlengkapan as $value) { ?>
			<option value="<?php echo $value->kode_perlengkapan ?>"><?php echo $value->nama_perlengkapan ?></option>
			<?php }
		}else if ($get_jenis == 'Bahan Baku') {
			$this->db_master->where('status','1');
			$get_bb = $this->db_master->get('master_bahan_baku')->result();
			foreach ($get_bb as $value) { ?>
			<option value="<?php echo $value->kode_bahan_baku ?>"><?php echo $value->nama_bahan_baku ?></option>
			<?php }
		}else if ($get_jenis == 'Produk') {
			$this->db_master->where('status','1');
			$get_produk = $this->db_master->get('master_produk')->result();
			foreach ($get_produk as $value) { ?>
			<option value="<?php echo $value->kode_produk ?>"><?php echo $value->nama_produk ?></option>
			<?php }
		}
	}

	public function add_opsi_jadwal_opname_temp(){
		$data = $this->input->post();
		
		if ($data['jenis_bahan'] == 'Perlengkapan') {
			$this->db_master->where('kode_perlengkapan',$data['kode_bahan']);
			$get_perlengkapan = $this->db_master->get('master_perlengkapan')->row();
			$data['stok_awal'] = $get_perlengkapan->real_stock;
			$data['kode_rak']  = $get_perlengkapan->kode_rak;

			
		}else if ($data['jenis_bahan'] == 'Bahan Baku') {
			$this->db_master->where('kode_bahan_baku',$data['kode_bahan']);
			$get_bb = $this->db_master->get('master_bahan_baku')->row();

			$data['stok_awal'] = $get_bb->real_stock;
			$data['kode_rak']  = $get_bb->kode_rak;
			
		}else if ($data['jenis_bahan'] == 'Produk') {
			$this->db_master->where('kode_produk',$data['kode_bahan']);
			$get_produk = $this->db_master->get('master_produk')->row();

			$data['stok_awal'] = $get_produk->real_stock;
			$data['kode_rak']  = $get_produk->kode_rak;
		}

		$cek_data   = $this->db->get_where('opsi_transaksi_opname_temp', array('kode_opname' => $data['kode_opname'], 'kode_bahan' => $data['kode_bahan'] ))->row();

		if (count($cek_data) > 0) {
			$out['response'] = 'ada';
		}else{
			$insert = $this->db->insert('opsi_transaksi_opname_temp', $data);
			if ($insert) {
				$out['response'] = 'sukses';
			}else{
				$out['response'] = 'gagal';
			}
		}

		echo json_encode($out);
	}

	public function hapus_opsi(){
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->delete('opsi_transaksi_opname_temp');
	}

	public function simpan_opsi_adjust(){
		$data       = $this->input->post();
		$get_data   = $this->db->get_where('opsi_transaksi_opname_temp', array('kode_opname' => $data['kode_opname']))->result();

		foreach ($get_data as $value) {
			$input['kode_opname'] 		= $value->kode_opname;
			$input['kode_bahan'] 		= $value->kode_bahan;
			$input['jenis_bahan'] 		= $value->jenis_bahan;
			$input['tanggal_opname'] 	= $value->tanggal_opname;
			$input['stok_awal'] 		= $value->stok_awal;
			$input['kode_rak'] 			= $value->kode_rak;
			$this->db->insert('opsi_transaksi_opname', $input);

			$this->db->where('id', $value->id);
			$this->db->delete('opsi_transaksi_opname_temp');
		}
	}

	public function simpan_all_adjust(){
		$data = $this->input->post();

		$get_data   = $this->db->get_where('opsi_transaksi_opname', array('kode_opname' => $data['kode_opname']))->result();

		foreach ($get_data as $value) {
			$update['stok_akhir'] 	= $data['qty_akhir_'.$value->id];
			$update['selisih'] 		= $data['selisih_'.$value->id];
			$update['status'] 		= $data['status_'.$value->id];
			$update['keterangan']	= $data['keterangan_'.$value->id];
			$this->db->where('id', $value->id);
			$this->db->update('opsi_transaksi_opname', $update);
		}
		$session = $this->session->userdata('astrosession');
		$get_cek = $this->db->get_where('opsi_transaksi_opname', array('kode_opname' => $data['kode_opname']))->row();
		$data_input['kode_opname'] 		= $get_cek->kode_opname;
		$data_input['tanggal_opname'] 	= $get_cek->tanggal_opname;
		$data_input['id_petugas'] 		= $session->id;
		$this->db->insert('transaksi_opname', $data_input);

	}

	public function hapus_opsi_utama(){
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->delete('opsi_transaksi_opname');
	}
}

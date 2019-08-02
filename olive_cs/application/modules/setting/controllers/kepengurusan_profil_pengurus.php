<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kepengurusan_profil_pengurus extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('profil_pengurus/profil_pengurus', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}



	public function tambah()
	{
		$data['konten'] = $this->load->view('profil_pengurus/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function simpan_tambah()
	{
		$data = $this->input->post();

		$this->db->where('kode_anggota',$data['kode_anggota']);
		$get_anggota 	= $this->db->get('data_anggota');
		$hasil_get 		= $get_anggota->row();
		$data['nama_pengurus'] = @$hasil_get->nama_anggota;
	
		$data['kode_pengurus'] = 'P_'.date('Ymdhis');
		$explode = explode('|',$data['kode_jabatan']);
		$data['kode_jabatan'] = $explode[0];
		$data['nama_jabatan'] = $explode[1];
		$data['kode_pengurus'] = $data['kode_anggota'];
		$data['lama_menjadi_anggota'] =$data['tahun'];
		unset($data['kode_anggota']);
		unset($data['bulan']);
		unset($data['tahun']);
		$this->db->insert('data_pengurus',$data);
	}

	public function simpan_ubah()
	{
		$data = $this->input->post();
		$explode = explode('|',$data['kode_jabatan']);
		$data['kode_jabatan'] = $explode[0];
		$data['nama_jabatan'] = $explode[1];

		$this->db->update('data_pengurus',$data,array('id' => $data['id']));
	}

	public function hapus()
	{
		$id = $this->input->post('id');

		$this->db->delete('data_pengurus',array('id' => $id));
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('profil_pengurus/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function get_data()
	{
		$data = $this->input->post();

		$this->db->where('kode_anggota',$data['kode']);
		$get_anggota 	= $this->db->get('data_anggota');
		$hasil_get 		= $get_anggota->row_array();
		
		$awal  = date_create($hasil_get['tanggal_pendaftaran']);
		$akhir = date_create(); 
		$diff  = date_diff( $awal, $akhir );

		$hasil_get['tahun'] = $diff->y ;
		$hasil_get['bulan'] = $diff->m ;
		echo json_encode($hasil_get); 
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class anggota_akun extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['konten'] = $this->load->view('anggota/akun', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('anggota/detail_anggota', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}


	public function edit()
	{
		$data['konten'] = $this->load->view('anggota/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function act_update()
	{
		$this->form_validation->set_rules('kode_anggota','Kode Anggota','required');
		if($this->form_validation->run() == FALSE){
			echo "error";
		}else{
			$data['kode_pendaftaran'] = trim(date('ymdhis'));
			$data['nama_anggota'] = trim($this->input->post('nama_anggota'));
			$data['kode_anggota'] = trim($this->input->post('kode_anggota'));
			$data['jenis_kelamin'] = trim($this->input->post('jenis_kelamin'));
			$data['tempat_lahir'] = trim($this->input->post('tempat_lahir'));
			$data['tanggal_lahir'] = trim($this->input->post('tanggal_lahir'));
			$data['pekerjaan'] = trim($this->input->post('pekerjaan'));
			$data['alamat'] = trim($this->input->post('alamat'));
			$data['no_telp'] = trim($this->input->post('no_telp'));
			$data['no_telp_alternatif'] = trim($this->input->post('no_telp_alternatif'));
			$data['status_pernikahan'] = trim($this->input->post('status_pernikahan'));
			$data['nama_istri_suami'] = trim($this->input->post('nama_istri_suami'));
			$data['tempat_lahir_istri_suami'] = trim($this->input->post('tempat_lahir_istri_suami'));
			$data['tanggal_lahir_istri_suami'] = trim($this->input->post('tanggal_lahir_istri_suami'));
			$data['pekerjaan_istri_suami'] = trim($this->input->post('pekerjaan_istri_suami'));
			$data['alamat_istri_suami'] = trim($this->input->post('alamat_istri_suami'));
			$data['no_telp_istri_suami'] = trim($this->input->post('no_telp_istri_suami'));
			$data['status_keanggotaan'] = trim('1');
			$data['status_pinjaman'] = trim('validasi');
			$data['tanggal_pendaftaran'] = date('Y-m-d');
			$data['kategori_anggota'] = trim($this->input->post('kategori_anggota'));

			$this->db->where('id',$this->input->post('id'));
			$this->db->update('data_anggota',$data);
			echo "ok";
		}
	}

}

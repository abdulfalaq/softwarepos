<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjaman extends MY_Controller {


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
		$data['konten'] = $this->load->view('pinjaman/form_pinjaman', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function data_produk()
	{
		$data['konten'] = $this->load->view('pinjaman/data_produk', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail_produk()
	{
		$data['konten'] = $this->load->view('pinjaman/detail_produk', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function form_parent()
	{
		$data['konten'] = $this->load->view('pinjaman/form_parent', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function form_reguler()
	{
		$this->load->view('pinjaman/form_reguler');
	}

	public function form_khusus()
	{
		$this->load->view('pinjaman/form_khusus');
	}


	public function act_simpan()
	{
		
			$data['ketentuan_pinjaman'] = $this->input->post('ketentuan_pinjaman');
			$data['jenis_pinjaman'] = $this->input->post('jenis_pinjaman');
			$data['nama_produk'] = $this->input->post('nama_produk');
			$data['kode_produk'] =$this->input->post('kode_pinjaman');// "PRP_".date('ymdhis');
			$data['plafon'] = $this->input->post('plafon');
			$data['tenor'] = $this->input->post('tenor');
			$data['jenis_jasa'] = $this->input->post('jenis_jasa');
			$data['jasa_per_tahun'] = $this->input->post('jasa_per_tahun');
			$data['jasa_per_bulan'] = $this->input->post('jasa_per_bulan');
			$data['status_denda'] = $this->input->post('status_denda');
			$data['nominal_denda'] = $this->input->post('nominal_denda');
			$data['biaya_administrasi'] = $this->input->post('biaya_administrasi');
			$data['nominal_biaya_administrasi'] = $this->input->post('nominal_biaya_administrasi');
			$data['biaya_provisi'] = $this->input->post('biaya_provisi');
			$data['persentase_biaya_provisi'] = $this->input->post('persentase_biaya_provisi');
			$data['nominal_biaya_provisi'] = $this->input->post('nominal_biaya_provisi');
			$data['status_agunan'] = $this->input->post('status_agunan');
			$data['penarikan_jasa_pinjaman'] = $this->input->post('penarikan_jasa_pinjaman');
			$data['potongan_lain'] = $this->input->post('potongan_lain');
			$data['nominal_potongan_lain'] = $this->input->post('nominal_potongan_lain');
			$data['potongan_dansos'] = $this->input->post('potongan_dansos');
			$data['nominal_potongan_dansos'] = $this->input->post('nominal_potongan_dansos');

			$this->db->insert('master_produk_pinjaman',$data);

			echo "ok";
		
	}
	

}

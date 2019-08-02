<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class setting_rekening extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('setting_rekening/setting_rekening', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}


	public function edit()
	{
		$data['konten'] = $this->load->view('setting_rekening/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah_harta()
	{
		$data['konten'] = $this->load->view('setting/setting_rekening/tambah_harta', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function get_nomer()
	{
		$data['konten'] = $this->load->view('setting/setting_rekening/get_nomer', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function daftar_harta()
	{
		$data['konten'] = $this->load->view('setting/setting_rekening/daftar_harta', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function get_kode()
	{
		$param = $this->input->post();
		$no_akun = $param["no_akun"];

		$this->db->select_max('id');
		$get_max_kode = $this->db->get('setting_akun_keuangan');
		$max_kode = $get_max_kode->row();

		$this->db->where('id', $max_kode->id);
		$get_kode = $this->db->get('setting_akun_keuangan');
		$kode = $get_kode->row();

		$nomor = @$kode->id;
                // echo $nomor;
		$nomor = $nomor + 1;
		$string = strlen($nomor);
		if($string == 1){
			$sub_kode =$no_akun.'.'.$nomor;
		} else if($string == 2){
			$sub_kode =$no_akun.'.'.$nomor;
		} else if($string == 3){
			$sub_kode =$no_akun.'.'.$nomor;
		} else if($string == 4){
			$sub_kode =$no_akun.'.'.$nomor;
		}

		echo $sub_kode;

	}

	public function add_item()
	{
		$no_akun = $this->input->post('no_akun');
		$kode_akun = $this->input->post('kode_akun');
		$kode_sub_akun = $this->input->post('kode_sub_akun');

		$ambil_data = $this->db->get_where('setting_kategori_akun',array('kode_kategori'  =>  $kode_akun));
		$hasil_ambil_data = $ambil_data->row();

		$masukan['nama_akun'] = "Harta";
		$masukan['no_akun'] = $no_akun;
		$masukan['nama_sub_akun'] = @$hasil_ambil_data->nama_kategori;
		$masukan['no_sub_akun'] = $kode_sub_akun;

		$this->db->insert('setting_akun_keuangan',$masukan);
		// echo $this->db->last_query();
		// echo "sukses";
	}

	public function simpan_nomer()
	{
		$no_akun = $this->input->post('no_akun');

		$masukan['no_akun_harta'] = $no_akun;
		$this->db->update('setting_rekening',$masukan);
		// echo $this->db->last_query();
		// echo "sukses";

	}

// -------------------------------------------------- kewajiban -------------------------------------------------------//

	public function tambah_kewajiban()
	{
		$data['konten'] = $this->load->view('setting/setting_rekening/tambah_kewajiban', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function get_nomer_kewajiban()
	{
		$data['konten'] = $this->load->view('setting/setting_rekening/get_nomer_kewajiban', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function daftar_kewajiban()
	{
		$data['konten'] = $this->load->view('setting/setting_rekening/daftar_kewajiban', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function add_item_kewajiban()
	{
		$no_akun = $this->input->post('no_akun');
		$kode_akun = $this->input->post('kode_akun');
		$kode_sub_akun = $this->input->post('kode_sub_akun');

		$ambil_data = $this->db->get_where('setting_kategori_akun',array('kode_kategori'  =>  $kode_akun));
		$hasil_ambil_data = $ambil_data->row();

		$masukan['nama_akun'] = "Kewajiban";
		$masukan['no_akun'] = $no_akun;
		$masukan['nama_sub_akun'] = @$hasil_ambil_data->nama_kategori;
		$masukan['no_sub_akun'] = $kode_sub_akun;

		$this->db->insert('setting_akun_keuangan',$masukan);
		// echo $this->db->last_query();
		// echo "sukses";
	}

	public function simpan_nomer_kewajiban()
	{
		$no_akun = $this->input->post('no_akun');

		$masukan['no_akun_kewajiban'] = $no_akun;
		$this->db->update('setting_rekening',$masukan);
		// echo $this->db->last_query();
		// echo "sukses";

	}
	// ---------------------------------------------------- Modal ----------------------------------------------------------//
	public function tambah_modal()
	{
		$data['konten'] = $this->load->view('setting/setting_rekening/tambah_modal', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function get_nomer_modal()
	{
		$data['konten'] = $this->load->view('setting/setting_rekening/get_nomer_modal', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function daftar_modal()
	{
		$data['konten'] = $this->load->view('setting/setting_rekening/daftar_modal', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function add_item_modal()
	{
		$no_akun = $this->input->post('no_akun');
		$kode_akun = $this->input->post('kode_akun');
		$kode_sub_akun = $this->input->post('kode_sub_akun');

		$ambil_data = $this->db->get_where('setting_kategori_akun',array('kode_kategori'  =>  $kode_akun));
		$hasil_ambil_data = $ambil_data->row();

		$masukan['nama_akun'] = "Modal";
		$masukan['no_akun'] = $no_akun;
		$masukan['nama_sub_akun'] = @$hasil_ambil_data->nama_kategori;
		$masukan['no_sub_akun'] = $kode_sub_akun;

		$this->db->insert('setting_akun_keuangan',$masukan);
		// echo $this->db->last_query();
		// echo "sukses";
	}

	public function simpan_nomer_modal()
	{
		$no_akun = $this->input->post('no_akun');

		$masukan['no_akun_modal'] = $no_akun;
		$this->db->update('setting_rekening',$masukan);
		// echo $this->db->last_query();
		// echo "sukses";

	}
	// ---------------------------------------------- pendaparan ------------------------------------------------------------------------------ //
	public function tambah_pendapatan()
	{
		$data['konten'] = $this->load->view('setting/setting_rekening/tambah_pendapatan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function get_nomer_pendapatan()
	{
		$data['konten'] = $this->load->view('setting/setting_rekening/get_nomer_pendapatan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function daftar_pendapatan()
	{
		$data['konten'] = $this->load->view('setting/setting_rekening/daftar_pendapatan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function add_item_pendapatan()
	{
		$no_akun = $this->input->post('no_akun');
		$kode_akun = $this->input->post('kode_akun');
		$kode_sub_akun = $this->input->post('kode_sub_akun');

		$ambil_data = $this->db->get_where('setting_kategori_akun',array('kode_kategori'  =>  $kode_akun));
		$hasil_ambil_data = $ambil_data->row();

		$masukan['nama_akun'] = "Pendapatan";
		$masukan['no_akun'] = $no_akun;
		$masukan['nama_sub_akun'] = @$hasil_ambil_data->nama_kategori;
		$masukan['no_sub_akun'] = $kode_sub_akun;

		$this->db->insert('setting_akun_keuangan',$masukan);
		// echo $this->db->last_query();
		// echo "sukses";
	}

	public function simpan_nomer_pendapatan()
	{
		$no_akun = $this->input->post('no_akun');

		$masukan['no_akun_pendapatan'] = $no_akun;
		$this->db->update('setting_rekening',$masukan);
		// echo $this->db->last_query();
		// echo "sukses";

	}

	// ------------------------------------------------------------ biaya -------------------------------------------------------- //
	public function tambah_biaya()
	{
		$data['konten'] = $this->load->view('setting/setting_rekening/tambah_biaya', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function get_nomer_biaya()
	{
		$data['konten'] = $this->load->view('setting/setting_rekening/get_nomer_biaya', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function daftar_biaya()
	{
		$data['konten'] = $this->load->view('setting/setting_rekening/daftar_biaya', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function add_item_biaya()
	{
		$no_akun = $this->input->post('no_akun');
		$kode_akun = $this->input->post('kode_akun');
		$kode_sub_akun = $this->input->post('kode_sub_akun');

		$ambil_data = $this->db->get_where('setting_kategori_akun',array('kode_kategori'  =>  $kode_akun));
		$hasil_ambil_data = $ambil_data->row();

		$masukan['nama_akun'] = "Biaya";
		$masukan['no_akun'] = $no_akun;
		$masukan['nama_sub_akun'] = @$hasil_ambil_data->nama_kategori;
		$masukan['no_sub_akun'] = $kode_sub_akun;

		$this->db->insert('setting_akun_keuangan',$masukan);
		// echo $this->db->last_query();
		// echo "sukses";
	}

	public function simpan_nomer_biaya()
	{
		$no_akun = $this->input->post('no_akun');

		$masukan['no_akun_biaya'] = $no_akun;
		$this->db->update('setting_rekening',$masukan);
		// echo $this->db->last_query();
		// echo "sukses";

	}
}

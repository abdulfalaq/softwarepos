<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pengeluaran extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$this->db3 = $this->load->database('olive_keuangan',TRUE);
		$data['konten'] = $this->load->view('daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail()
	{
		$this->db3 = $this->load->database('olive_keuangan',TRUE);
		$data['konten'] = $this->load->view('detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$this->db3 = $this->load->database('olive_keuangan',TRUE);
		$data['konten'] = $this->load->view('daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_daftar()
	{
		$this->db3 = $this->load->database('olive_keuangan',TRUE);
		$this->load->view('cari_daftar');
	}
	public function tambah()
	{
		$this->db3 = $this->load->database('olive_keuangan',TRUE);
		$data['konten'] = $this->load->view('tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function get_rupiah_modal_awal()
	{
		$this->db3 = $this->load->database('olive_keuangan',TRUE);
		$modal_awal = $this->input->post('modal_awal');
		$hasil = format_rupiah($modal_awal);

		echo $hasil;

	}

	public function simpan_tambah()
	{
		$this->db3 = $this->load->database('olive_keuangan',TRUE);
		$input = $this->input->post();
		$input['kode_referensi'] = "manual";
		$input['tanggal_transaksi'] = date('Y-m-d');

		$insert = $this->db3->insert('keuangan_keluar',$input);

		$this->simpan_arus_kas('Pengeluaran','2.5.4','Operasional',$input['nominal']);
		$this->simpan_laba_rugi('Pengeluaran','2.5.4','Operasional',$input['nominal']);

		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
	public function simpan_arus_kas($jenis_keuangan,$kode_kategori_keuangan,$nama_kategori_keuangan,$nominal){
		$tanggal=date('Y-m-d');
		$bulan=date('m',strtotime($tanggal));
		$tahun=date('Y',strtotime($tanggal));

		$this->db3 = $this->load->database('olive_keuangan',TRUE);
		$get_laporan_arus_kas   = $this->db3->get_where('laporan_arus_kas',array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		$hasil_laporan_arus_kas  = $get_laporan_arus_kas->row();
		if(!empty($hasil_laporan_arus_kas)){
			$update_arus_kas['nominal']=$hasil_laporan_arus_kas->nominal +$nominal;
			$this->db3->update('laporan_arus_kas',$update_arus_kas,array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		}else{

			$insert_arus_kas['jenis_keuangan']=$jenis_keuangan;
			$insert_arus_kas['kode_kategori_keuangan']=@$kode_kategori_keuangan;
			$insert_arus_kas['nama_kategori_keuangan']=@$nama_kategori_keuangan;
			$insert_arus_kas['nominal']=$nominal;
			$insert_arus_kas['tanggal']=$tanggal;
			$insert_arus_kas['bulan']=$bulan;
			$insert_arus_kas['tahun']=$tahun;
			$this->db3->insert('laporan_arus_kas',$insert_arus_kas);
		}

	}
	public function simpan_laba_rugi($jenis_keuangan,$kode_kategori_keuangan,$nama_kategori_keuangan,$nominal){
		$tanggal=date('Y-m-d');
		$bulan=date('m',strtotime($tanggal));
		$tahun=date('Y',strtotime($tanggal));


		$this->db3 = $this->load->database('olive_keuangan',TRUE);
		$get_laporan_laba_rugi   = $this->db3->get_where('laporan_laba_rugi',array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		$hasil_laporan_laba_rugi  = $get_laporan_laba_rugi->row();
		if(!empty($hasil_laporan_laba_rugi)){
			$update_laba_rugi['nominal']=$hasil_laporan_laba_rugi->nominal +$nominal;
			$this->db3->update('laporan_laba_rugi',$update_laba_rugi,array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		}else{

			$insert_laba_rugi['jenis_keuangan']=$jenis_keuangan;
			$insert_laba_rugi['kode_kategori_keuangan']=@$kode_kategori_keuangan;
			$insert_laba_rugi['nama_kategori_keuangan']=@$nama_kategori_keuangan;
			$insert_laba_rugi['nominal']=$nominal;
			$insert_laba_rugi['tanggal']=$tanggal;
			$insert_laba_rugi['bulan']=$bulan;
			$insert_laba_rugi['tahun']=$tahun;
			$this->db3->insert('laporan_laba_rugi',$insert_laba_rugi);
		}

	}

	public function edit_profile(){
		$data = $input = $this->input->post();
		$this->db3->update('setting',$data,array('id' =>$data['id']));

	}

	public function logout()
	{
		$this->session->unset_userdata('astrosession');
		$this->session->sess_destroy();
		clearstatcache();
		redirect($this->cname);
	}
	public function get_nom()
	{   
		$nom = $this->input->post('nom');   

		echo @format_rupiah($nom);

	}

	
}

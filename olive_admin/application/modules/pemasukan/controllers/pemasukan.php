<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pemasukan extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail()
	{
		$this->olive_keuangan = $this->load->database('olive_keuangan', TRUE);
		$data['konten'] = $this->load->view('detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		
		$data['konten'] = $this->load->view('daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_daftar()
	{
		
		$this->load->view('cari_daftar');
	}
	public function tambah()
	{
		$this->olive_keuangan = $this->load->database('olive_keuangan', TRUE);
		$data['konten'] = $this->load->view('tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function get_rupiah()
	{
		$nominal = $this->input->post('nominal');
		$hasil = format_rupiah($nominal);

		echo $hasil;

	}

	public function simpan(){
		$this->olive_keuangan = $this->load->database('olive_keuangan', TRUE);
		$data = $this->input->post();
		$get_id_petugas = $this->session->userdata('astrosession');
		$id_petugas = $get_id_petugas->id;

		$insert['kode_sub_kategori_keuangan']  				= $data['kode_sub_kategori_keuangan'];
		$insert['nama_kategori_keuangan']  		= $data['nama_kategori_keuangan'];
		$insert['nominal']  		= $data['nominal'];
		$insert['nama_sub_kategori_keuangan']  		= $data['nama_sub_kategori_keuangan'];
		$insert['keterangan']  		= $data['keterangan'];
		$insert['kode_referensi'] = "manual";
		$insert['tanggal_transaksi'] = date('Y-m-d');
		$insert['kode_jenis_keuangan'] = 1;
		$insert['id_petugas'] = $id_petugas;

		$isi = $this->olive_keuangan->insert('keuangan_masuk',$insert);

		$this->simpan_arus_kas('Pendapatan','1.3.1','Pendapatan Lain-lain',$insert['nominal']);
		$this->simpan_laba_rugi('Pemasukan','1.3.1','Pendapatan Lain-lain',$insert['nominal']);

	}

	public function simpan_arus_kas($jenis_keuangan,$kode_kategori_keuangan,$nama_kategori_keuangan,$nominal){
		$tanggal=date('Y-m-d');
		$bulan=date('m',strtotime($tanggal));
		$tahun=date('Y',strtotime($tanggal));

		$get_laporan_arus_kas   = $this->olive_keuangan->get_where('laporan_arus_kas',array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		$hasil_laporan_arus_kas  = $get_laporan_arus_kas->row();
		if(!empty($hasil_laporan_arus_kas)){
			$update_arus_kas['nominal']=$hasil_laporan_arus_kas->nominal +$nominal;
			$this->olive_keuangan->update('laporan_arus_kas',$update_arus_kas,array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		}else{

			$insert_arus_kas['jenis_keuangan']=$jenis_keuangan;
			$insert_arus_kas['kode_kategori_keuangan']=@$kode_kategori_keuangan;
			$insert_arus_kas['nama_kategori_keuangan']=@$nama_kategori_keuangan;
			$insert_arus_kas['nominal']=$nominal;
			$insert_arus_kas['tanggal']=$tanggal;
			$insert_arus_kas['bulan']=$bulan;
			$insert_arus_kas['tahun']=$tahun;
			$this->olive_keuangan->insert('laporan_arus_kas',$insert_arus_kas);
		}

	}
	public function simpan_laba_rugi($jenis_keuangan,$kode_kategori_keuangan,$nama_kategori_keuangan,$nominal){
		$tanggal=date('Y-m-d');
		$bulan=date('m',strtotime($tanggal));
		$tahun=date('Y',strtotime($tanggal));

		$get_laporan_laba_rugi   = $this->olive_keuangan->get_where('laporan_laba_rugi',array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		$hasil_laporan_laba_rugi  = $get_laporan_laba_rugi->row();
		if(!empty($hasil_laporan_laba_rugi)){
			$update_laba_rugi['nominal']=$hasil_laporan_laba_rugi->nominal +$nominal;
			$this->olive_keuangan->update('laporan_laba_rugi',$update_laba_rugi,array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		}else{

			$insert_laba_rugi['jenis_keuangan']=$jenis_keuangan;
			$insert_laba_rugi['kode_kategori_keuangan']=@$kode_kategori_keuangan;
			$insert_laba_rugi['nama_kategori_keuangan']=@$nama_kategori_keuangan;
			$insert_laba_rugi['nominal']=$nominal;
			$insert_laba_rugi['tanggal']=$tanggal;
			$insert_laba_rugi['bulan']=$bulan;
			$insert_laba_rugi['tahun']=$tahun;
			$this->olive_keuangan->insert('laporan_laba_rugi',$insert_laba_rugi);
		}

	}

	public function edit_profile(){
		$data = $input = $this->input->post();
		$this->db->update('setting',$data,array('id' =>$data['id']));

	}

	public function logout()
	{
		$this->session->unset_userdata('astrosession');
		$this->session->sess_destroy();
		clearstatcache();
		redirect($this->cname);
	}

	
}

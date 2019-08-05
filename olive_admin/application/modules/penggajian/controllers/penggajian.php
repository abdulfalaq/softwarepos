<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class penggajian extends MY_Controller {


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
		$data['konten'] = $this->load->view('detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$data['konten'] = $this->load->view('tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function cari_daftar()
	{
		$this->load->view('cari_daftar');
		
	}
	public function get_karyawan()
	{
		$kode_karyawan=$this->input->post('kode_karyawan');
		$this->db->select('kode_karyawan');
		$this->db->select('gaji');
		$this->db->select('clouoid1_olive_master.master_jabatan.kode_jabatan');
		$this->db->select('clouoid1_olive_master.master_jabatan.nama_jabatan');
		$this->db->where('kode_karyawan', $kode_karyawan);
		$this->db->from('clouoid1_olive_master.master_karyawan');
		$this->db->join('clouoid1_olive_master.master_jabatan', 'clouoid1_olive_master.master_karyawan.kode_jabatan = clouoid1_olive_master.master_jabatan.kode_jabatan', 'left');
		$data_karyawan=$this->db->get()->row_array();

		if(@$data_karyawan['kode_jabatan']=='J_0001'){
			$this->db->where('kode_karyawan', @$data_karyawan['kode_karyawan']);
			$this->db->select('total_withdraw');
			$this->db->like('tanggal_transaksi',date('Y-m'));
			$get_insentif=$this->db->get('clouoid1_olive_keuangan.insentif_terapis')->row();
			$data_karyawan['total_withdraw']=$get_insentif->total_withdraw;
			
		}
		echo json_encode(@$data_karyawan);
	}
	public function list_insentif()
	{
		$kode_karyawan=$this->uri->segment(3);
		$this->db->where('kode_karyawan', $kode_karyawan);
		$this->db->order_by('tanggal_transaksi', 'desc');
		$this->db->like('tanggal_transaksi',date('Y-m'));
		$get_insentif=$this->db->get('clouoid1_olive_keuangan.insentif_terapis')->result();
		$no=1;
		foreach ($get_insentif as $value) {
			?>
			<tr>
				<td><?php echo $no++;?></td>
				<td><?php echo @TanggalIndo($value->tanggal_transaksi);?></td>
				<td><?php echo @format_rupiah($value->total_withdraw);?></td>
			</tr>
			<?php
		}
	}
	public function get_total_gaji()
	{
		$gaji_pokok = $this->input->post("gaji_pokok");
		$insentif_treatment = $this->input->post("insentif_treatment");
		$insentif_kehadiran = $this->input->post("insentif_kehadiran");
		$tunjangan_jabatan = $this->input->post("tunjangan_jabatan");
		$insentif_cuti = $this->input->post("insentif_cuti");
		$lembur = $this->input->post("lembur");
		$potongan = $this->input->post("potongan");

		$pemasukan=$gaji_pokok + $insentif_treatment +$insentif_kehadiran +$tunjangan_jabatan +$insentif_cuti + $lembur;
		$total_gaji=$pemasukan - $potongan;
		echo $total_gaji;
	}
	public function simpan_penggajian()
	{
		$post = $this->input->post();
		$this->db->insert('clouoid1_olive_keuangan.transaksi_penggajian', $post);

		$get_akun = $this->db->get_where('clouoid1_olive_keuangan.keuangan_sub_kategori_akun',array('kode_sub_kategori_akun'=>'2.2.1'));
		$hasil = $get_akun->row();

		$get_id_petugas = $this->session->userdata('astrosession');
		$id_petugas = $get_id_petugas->id;

		$data['tanggal_transaksi'] = date('Y-m-d');
		$data['id_petugas'] = $id_petugas;
		$data['kode_jenis_keuangan'] = $hasil->kode_jenis_akun ;
		$data['kode_kategori_keuangan'] = $hasil->kode_kategori_akun ;
		$data['kode_sub_kategori_keuangan'] = $hasil->kode_sub_kategori_akun ;
		$data['nominal'] = $post['total_gaji'];
		$data['kode_referensi'] = $post['kode_transaksi'];
		$masuk = $this->db->insert("clouoid1_olive_keuangan.keuangan_keluar", $data);

		$status['status']='selesai';
		$this->db->where('kode_karyawan', @$post['kode_karyawan']);
		$this->db->like('tanggal_transaksi',date('Y-m'));
		$this->db->update('clouoid1_olive_keuangan.insentif_terapis', $status);

		$this->simpan_arus_kas('Pengeluaran',$hasil->kode_sub_kategori_akun,'Gaji Karyawan',$data['nominal']);
		$this->simpan_laba_rugi('Pengeluaran',$hasil->kode_sub_kategori_akun,'Gaji Karyawan',$data['nominal']);
	}
	public function simpan_arus_kas($jenis_keuangan,$kode_kategori_keuangan,$nama_kategori_keuangan,$nominal){
		$tanggal=date('Y-m-d');
		$bulan=date('m',strtotime($tanggal));
		$tahun=date('Y',strtotime($tanggal));

		$get_laporan_arus_kas   = $this->db->get_where('clouoid1_olive_keuangan.laporan_arus_kas',array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		$hasil_laporan_arus_kas  = $get_laporan_arus_kas->row();
		if(!empty($hasil_laporan_arus_kas)){
			$update_arus_kas['nominal']=$hasil_laporan_arus_kas->nominal +$nominal;
			$this->db->update('clouoid1_olive_keuangan.laporan_arus_kas',$update_arus_kas,array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		}else{

			$insert_arus_kas['jenis_keuangan']=$jenis_keuangan;
			$insert_arus_kas['kode_kategori_keuangan']=@$kode_kategori_keuangan;
			$insert_arus_kas['nama_kategori_keuangan']=@$nama_kategori_keuangan;
			$insert_arus_kas['nominal']=$nominal;
			$insert_arus_kas['tanggal']=$tanggal;
			$insert_arus_kas['bulan']=$bulan;
			$insert_arus_kas['tahun']=$tahun;
			$this->db->insert('clouoid1_olive_keuangan.laporan_arus_kas',$insert_arus_kas);
		}

	}

	public function simpan_laba_rugi($jenis_keuangan,$kode_kategori_keuangan,$nama_kategori_keuangan,$nominal){
		$tanggal=date('Y-m-d');
		$bulan=date('m',strtotime($tanggal));
		$tahun=date('Y',strtotime($tanggal));

		$get_laporan_laba_rugi   = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		$hasil_laporan_laba_rugi  = $get_laporan_laba_rugi->row();
		if(!empty($hasil_laporan_laba_rugi)){
			$update_laba_rugi['nominal']=$hasil_laporan_laba_rugi->nominal +$nominal;
			$this->db->update('clouoid1_olive_keuangan.laporan_laba_rugi',$update_laba_rugi,array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		}else{

			$insert_laba_rugi['jenis_keuangan']=$jenis_keuangan;
			$insert_laba_rugi['kode_kategori_keuangan']=@$kode_kategori_keuangan;
			$insert_laba_rugi['nama_kategori_keuangan']=@$nama_kategori_keuangan;
			$insert_laba_rugi['nominal']=$nominal;
			$insert_laba_rugi['tanggal']=$tanggal;
			$insert_laba_rugi['bulan']=$bulan;
			$insert_laba_rugi['tahun']=$tahun;
			$this->db->insert('clouoid1_olive_keuangan.laporan_laba_rugi',$insert_laba_rugi);
		}

	}
	
}

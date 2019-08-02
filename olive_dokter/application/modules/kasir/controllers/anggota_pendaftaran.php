<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class anggota_pendaftaran extends MY_Controller {


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
		$data['konten'] = $this->load->view('anggota/pendaftaran', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}


	public function act_simpan()
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
			$data['kategori_anggota'] = trim($this->input->post('kategori_anggota'));
			
			if(@$data['kategori_anggota']=='Anggota'){
				$data['status_pinjaman'] = trim('belum divalidasi');
				$data['status_keanggotaan'] = trim('1');
			}else{
				$data['status_pinjaman'] = trim('validasi');
				$data['status_keanggotaan'] = trim('1');
			}
			
			$data['tanggal_pendaftaran'] = date('Y-m-d');
			

			$this->db->insert('data_anggota',$data);
			if(@$data['kategori_anggota']=='Anggota'){

				$simpanan_wajib['kode_anggota'] = $data['kode_anggota'];
				$simpanan_wajib['nama_anggota'] = $data['nama_anggota'];
				$simpanan_wajib['total_simpanan_wajib'] = trim($this->input->post('simpanan_wajib'));
				$this->db->insert('data_simpanan_wajib',$simpanan_wajib);

				$trans_simpanan_wajib['kode_transaksi'] = 'TSW_'.date('ymdhis');
				$trans_simpanan_wajib['tanggal_transaksi'] = date('Y-m-d');
				$trans_simpanan_wajib['periode_simpanan'] = date('m');
				$trans_simpanan_wajib['tahun'] = date('Y');
				$trans_simpanan_wajib['kode_anggota'] = $data['kode_anggota'];
				$trans_simpanan_wajib['nama_anggota'] = $data['nama_anggota'];
				$trans_simpanan_wajib['saldo_awal_simpanan'] = '0';
				$trans_simpanan_wajib['nominal'] = trim($this->input->post('simpanan_wajib'));
				$trans_simpanan_wajib['saldo_akhir'] = trim($this->input->post('simpanan_wajib'));
				$this->db->insert('transaksi_simpanan_wajib',$trans_simpanan_wajib);

				$simpanan_pokok['kode_anggota'] = $data['kode_anggota'];
				$simpanan_pokok['nama_anggota'] = $data['nama_anggota'];
				$simpanan_pokok['total_simpanan_pokok'] = trim($this->input->post('simpanan_pokok'));
				$this->db->insert('data_simpanan_pokok',$simpanan_pokok);

				$trans_simpanan_pokok['kode_transaksi'] = 'TSP_'.date('ymdhis');
				$trans_simpanan_pokok['tanggal_transaksi'] = date('Y-m-d');
				$trans_simpanan_pokok['kode_anggota'] = $data['kode_anggota'];
				$trans_simpanan_pokok['nama_anggota'] = $data['nama_anggota'];
				$trans_simpanan_pokok['jenis_transaksi'] = 'pendaftaran';
				$trans_simpanan_pokok['saldo_awal_simpanan'] = 0;
				$trans_simpanan_pokok['nominal'] = trim($this->input->post('simpanan_pokok'));
				$trans_simpanan_pokok['saldo_akhir'] = trim($this->input->post('simpanan_pokok'));
				$this->db->insert('transaksi_simpanan_pokok',$trans_simpanan_pokok);

				$bulan=date('m',strtotime(date('Y-m-d')));
				$tahun=date('Y',strtotime(date('Y-m-d')));

				$get_akun_keuangan = $this->db->get_where('setting_akun_keuangan',array('no_akun' => '101','no_sub_akun' => '1016' ));
				$hasil_akun_keuangan = $get_akun_keuangan->row();

				$get_laporan_arus_kas 	= $this->db->get_where('laporan_arus_kas',array('no_akun' =>'101','no_sub_akun'=>$hasil_akun_keuangan->no_sub_akun,'bulan'=>$bulan,'triwulan'=>Triwulan($bulan),'tahun'=>$tahun));
				$hasil_laporan_arus_kas  = $get_laporan_arus_kas->row();
				if(!empty($hasil_laporan_arus_kas)){
					$update_arus_kas['nominal']=$hasil_laporan_arus_kas->nominal +trim($this->input->post('simpanan_pokok'));
					$this->db->update('laporan_arus_kas',$update_arus_kas,array('no_akun' =>'101','no_sub_akun'=>$hasil_akun_keuangan->no_sub_akun,'bulan'=>$bulan,'triwulan'=>Triwulan($bulan),'tahun'=>$tahun));
				}else{
					$insert_arus_kas['no_akun']=$hasil_akun_keuangan->no_akun;
					$insert_arus_kas['nama_akun']=$hasil_akun_keuangan->nama_akun;
					$insert_arus_kas['no_sub_akun']=$hasil_akun_keuangan->no_sub_akun;
					$insert_arus_kas['nama_sub_akun']=$hasil_akun_keuangan->nama_sub_akun;
					$insert_arus_kas['kategori']=$hasil_akun_keuangan->kategori;
					$insert_arus_kas['nominal']=trim($this->input->post('simpanan_pokok'));
					$insert_arus_kas['tanggal']=date('Y-m-d');
					$insert_arus_kas['bulan']=$bulan;
					$insert_arus_kas['triwulan']=Triwulan($bulan);
					$insert_arus_kas['tahun']=$tahun;
					$this->db->insert('laporan_arus_kas',$insert_arus_kas);
				}

				$get_akun_keuangan = $this->db->get_where('setting_akun_keuangan',array('no_akun' => '101','no_sub_akun' => '1017' ));
				$hasil_akun_keuangan = $get_akun_keuangan->row();

				$get_laporan_arus_kas 	= $this->db->get_where('laporan_arus_kas',array('no_akun' =>'101','no_sub_akun'=>$hasil_akun_keuangan->no_sub_akun,'bulan'=>$bulan,'triwulan'=>Triwulan($bulan),'tahun'=>$tahun));
				$hasil_laporan_arus_kas  = $get_laporan_arus_kas->row();
				if(!empty($hasil_laporan_arus_kas)){
					$update_arus_kas['nominal']=$hasil_laporan_arus_kas->nominal +trim($this->input->post('simpanan_pokok'));
					$this->db->update('laporan_arus_kas',$update_arus_kas,array('no_akun' =>'101','no_sub_akun'=>$hasil_akun_keuangan->no_sub_akun,'bulan'=>$bulan,'triwulan'=>Triwulan($bulan),'tahun'=>$tahun));
				}else{
					$insert_arus_kas['no_akun']=$hasil_akun_keuangan->no_akun;
					$insert_arus_kas['nama_akun']=$hasil_akun_keuangan->nama_akun;
					$insert_arus_kas['no_sub_akun']=$hasil_akun_keuangan->no_sub_akun;
					$insert_arus_kas['nama_sub_akun']=$hasil_akun_keuangan->nama_sub_akun;
					$insert_arus_kas['kategori']=$hasil_akun_keuangan->kategori;
					$insert_arus_kas['nominal']=trim($this->input->post('simpanan_pokok'));
					$insert_arus_kas['tanggal']=date('Y-m-d');
					$insert_arus_kas['bulan']=$bulan;
					$insert_arus_kas['triwulan']=Triwulan($bulan);
					$insert_arus_kas['tahun']=$tahun;
					$this->db->insert('laporan_arus_kas',$insert_arus_kas);
				}

				
			}

			echo "ok";
		}
	}
}

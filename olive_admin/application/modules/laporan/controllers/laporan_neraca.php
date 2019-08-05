<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_neraca extends MY_Controller {


	public function index()
	{

		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('laporan_neraca/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah()
	{
		$data['konten'] = $this->load->view('laporan_neraca/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('laporan_neraca/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('laporan_neraca/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tutup_buku(){
		$post=$this->input->post();
		
		foreach ($post['aktiva'] as  $aktiva) {
			$value=explode("|", $aktiva);
			$insert_aktiva['nama_akun']=$value[1];
			$insert_aktiva['nominal']=$value[0];
			$insert_aktiva['kategori_keuangan']='Aktiva';
			$insert_aktiva['tanggal']=date('Y-m-d');
			$insert_aktiva['bulan']=date('m');
			
			$insert_aktiva['tahun']=date('Y');

			$get_neraca_aktiva 	= $this->db->get_where('clouoid1_olive_keuangan.laporan_neraca',array('nama_akun' =>$value[1],'bulan'=>date('m'),'tahun'=>date('Y')));
			$neraca_aktiva  = $get_neraca_aktiva->row();
			if(!empty($neraca_aktiva)){

				$update_neraca_aktiva['nominal']=$value[0];
				$this->db->update('clouoid1_olive_keuangan.laporan_neraca',$update_neraca_aktiva,array('nama_akun' =>$value[1],'bulan'=>date('m'),'tahun'=>date('Y')));
			}else{
				$this->db->insert('clouoid1_olive_keuangan.laporan_neraca',$insert_aktiva);
			}
		}
		
		foreach ($post['pasiva'] as  $pasiva) {
			$value=explode("|", $pasiva);
			$insert_pasiva['nama_akun']=$value[1];
			$insert_pasiva['nominal']=$value[0];
			$insert_pasiva['kategori_keuangan']='Pasiva';
			$insert_pasiva['tanggal']=date('Y-m-d');
			$insert_pasiva['bulan']=date('m');
			
			$insert_pasiva['tahun']=date('Y');
			
			$get_neraca_pasiva 	= $this->db->get_where('clouoid1_olive_keuangan.laporan_neraca',array('nama_akun' =>$value[1],'bulan'=>date('m'),'tahun'=>date('Y')));
			$neraca_pasiva  = $get_neraca_pasiva->row();
			if(!empty($neraca_pasiva)){

				$update_neraca_pasiva['nominal']=$value[0];
				$this->db->update('clouoid1_olive_keuangan.laporan_neraca',$update_neraca_pasiva,array('nama_akun' =>$value[1],'bulan'=>date('m'),'tahun'=>date('Y')));
			}else{
				$this->db->insert('clouoid1_olive_keuangan.laporan_neraca',$insert_pasiva);
			}
		}
		
	}

	public function print_perlengkapan()
	{
		$this->load->view('laporan_neraca/cetak_perlengkapan');
	}
}

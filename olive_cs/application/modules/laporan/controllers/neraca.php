<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class neraca extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('neraca/laporan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function print_neraca()
	{
		$this->load->view('neraca/print_neraca');

	}
	public function simpan_neraca(){
		$post=$this->input->post();
		
		foreach ($post['kas'] as  $kas) {
			$value=explode("|", $kas);
			$insert_kas['nama_akun']=$value[1];
			$insert_kas['nominal']=$value[0];
			$insert_kas['kategori_keuangan']='Kas';
			$insert_kas['tanggal']=date('Y-m-d');
			$insert_kas['bulan']=date('m');
			$insert_kas['triwulan']=Triwulan(date('m'));
			$insert_kas['tahun']=date('Y');

			$get_neraca_kas 	= $this->db->get_where('laporan_neraca',array('nama_akun' =>$value[1],'bulan'=>date('m'),'triwulan'=>Triwulan(date('m')),'tahun'=>date('Y')));
			$neraca_kas  = $get_neraca_kas->row();
			if(!empty($neraca_kas)){

				$update_neraca_kas['nominal']=$value[0];
				$this->db->update('laporan_neraca',$update_neraca_kas,array('nama_akun' =>$value[1],'bulan'=>date('m'),'triwulan'=>Triwulan(date('m')),'tahun'=>date('Y')));
			}else{
				$this->db->insert('laporan_neraca',$insert_kas);
			}
		}
		foreach ($post['dana-dana'] as  $dana_dana) {
			$value=explode("|", $dana_dana);
			$insert_dana_dana['nama_akun']=$value[1];
			$insert_dana_dana['nominal']=$value[0];
			$insert_dana_dana['kategori_keuangan']='Dana-Dana';
			$insert_dana_dana['tanggal']=date('Y-m-d');
			$insert_dana_dana['bulan']=date('m');
			$insert_dana_dana['triwulan']=Triwulan(date('m'));
			$insert_dana_dana['tahun']=date('Y');
			
			$get_neraca_dana 	= $this->db->get_where('laporan_neraca',array('nama_akun' =>$value[1],'bulan'=>date('m'),'triwulan'=>Triwulan(date('m')),'tahun'=>date('Y')));
			$neraca_dana  = $get_neraca_dana->row();
			if(!empty($neraca_dana)){

				$update_neraca_dana['nominal']=$value[0];
				$this->db->update('laporan_neraca',$update_neraca_dana,array('nama_akun' =>$value[1],'bulan'=>date('m'),'triwulan'=>Triwulan(date('m')),'tahun'=>date('Y')));
			}else{
				$this->db->insert('laporan_neraca',$insert_dana_dana);
			}
		}
		foreach ($post['aktiva'] as  $aktiva) {
			$value=explode("|", $aktiva);
			$insert_aktiva['nama_akun']=$value[1];
			$insert_aktiva['nominal']=$value[0];
			$insert_aktiva['kategori_keuangan']='Aktiva Tetap';
			$insert_aktiva['tanggal']=date('Y-m-d');
			$insert_aktiva['bulan']=date('m');
			$insert_aktiva['triwulan']=Triwulan(date('m'));
			$insert_aktiva['tahun']=date('Y');
			
			$get_neraca_aktiva 	= $this->db->get_where('laporan_neraca',array('nama_akun' =>$value[1],'bulan'=>date('m'),'triwulan'=>Triwulan(date('m')),'tahun'=>date('Y')));
			$neraca_aktiva  = $get_neraca_aktiva->row();
			if(!empty($neraca_aktiva)){

				$update_neraca_aktiva['nominal']=$value[0];
				$this->db->update('laporan_neraca',$update_neraca_aktiva,array('nama_akun' =>$value[1],'bulan'=>date('m'),'triwulan'=>Triwulan(date('m')),'tahun'=>date('Y')));
			}else{
				$this->db->insert('laporan_neraca',$insert_aktiva);
			}
		}
		foreach ($post['modal'] as  $modal) {
			$value=explode("|", $modal);
			$insert_modal['nama_akun']=$value[1];
			$insert_modal['nominal']=$value[0];
			$insert_modal['kategori_keuangan']='Modal';
			$insert_modal['tanggal']=date('Y-m-d');
			$insert_modal['bulan']=date('m');
			$insert_modal['triwulan']=Triwulan(date('m'));
			$insert_modal['tahun']=date('Y');
			
			$get_neraca_modal 	= $this->db->get_where('laporan_neraca',array('nama_akun' =>$value[1],'bulan'=>date('m'),'triwulan'=>Triwulan(date('m')),'tahun'=>date('Y')));
			$neraca_modal  = $get_neraca_modal->row();
			if(!empty($neraca_modal)){

				$update_neraca_modal['nominal']=$value[0];
				$this->db->update('laporan_neraca',$update_neraca_modal,array('nama_akun' =>$value[1],'bulan'=>date('m'),'triwulan'=>Triwulan(date('m')),'tahun'=>date('Y')));
			}else{
				$this->db->insert('laporan_neraca',$insert_modal);
			}
		}
	}
}

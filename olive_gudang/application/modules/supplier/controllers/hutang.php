<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hutang extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$this->db_master = $this->load->database('kan_master', TRUE);
		$data['konten'] = $this->load->view('hutang/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function daftar()
	{
		$this->db_master = $this->load->database('kan_master', TRUE);
		$data['konten'] = $this->load->view('hutang/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$this->db_kasir = $this->load->database('kan_kasir', TRUE);
		$data['konten'] = $this->load->view('hutang/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function simpan_angsuran(){
		$input = $this->input->post();
		$this->db_kasir = $this->load->database('kan_kasir', TRUE);

		$get_hutang=$this->db_kasir->get_where('transaksi_hutang', array('kode_hutang' =>@$input['kode_transaksi'],'kode_supplier' =>@$input['kode_supplier'],'kode_unit_jabung' =>@$input['kode_unit_jabung']));
		$hasil_hutang=$get_hutang->row();
		if(@$input['jenis_angsuran']=='angsuran'){
			$hutang['tanggal_jatuh_tempo']=@$input['tanggal_jatuh_tempo'];
		}
		$hutang['angsuran']=@$input['dibayar'];
		$hutang['sisa']=@$hasil_hutang->sisa - @$input['dibayar'];

		$this->db_kasir->update('transaksi_hutang',$hutang, array('kode_hutang' =>@$input['kode_transaksi'],'kode_supplier' =>@$input['kode_supplier'],'kode_unit_jabung' =>@$input['kode_unit_jabung']));
		

		$data['kode_angsuran'] ='AS_'.date('ymdHis');
		$data['kode_hutang'] =  $input['kode_transaksi'];
		$data['angsuran'] =  @$input['dibayar'];
		$data['tanggal_angsuran'] = date('Y-m-d');
		$data['kode_unit_jabung'] = @$input['kode_unit_jabung'];
		$data['jenis_pembayaran'] = @$input['jenis_pembayaran'];
		$data['status'] = 'proses';

		$this->db_kasir->insert('opsi_transaksi_hutang',$data);
		
	}

	public function detail_pertransaksi(){
		$this->db_master = $this->load->database('kan_master', TRUE);
		$data['konten']  = $this->load->view('hutang/detail_pertransaksi', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function angsur(){
		$this->db_master = $this->load->database('kan_master', TRUE);
		$data['konten']  = $this->load->view('hutang/angsur', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
}

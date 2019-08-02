<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('produk/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}



	public function tambah()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('produk/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('produk/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('produk/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('produk/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function hapus_gudang(){
		$this->db2 = $this->load->database('olive_master', TRUE);
		$kode_produk = $this->input->post('kode_produk');
		$this->db2->delete('master_produk', array('kode_produk' => $kode_produk ));

	}
	public function get_nomin()
	{   
		$nominal = $this->input->post('nominal');   

		echo @format_rupiah($nominal);

	}

	public function simpan_member()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$input = $this->input->post();
		$insert = $this->db2->insert('master_produk',$input);
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}

	public function cek_kode_promo(){
		$this->db2 = $this->load->database('olive_master', TRUE);
		$kode_produk = $this->input->post('kode_produk');
		$get = $this ->db2 ->get_where('master_produk', array('kode_produk' =>$kode_produk));
		$peringatan = $get->row();
		if(empty($peringatan)){
			$data['peringatan']='kosong';
		}else{
			$data['peringatan']='ada';
		}

		echo json_encode($data);

	}
	public function update_member()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$input = $this->input->post();
		$insert = $this->db2->update('master_produk',$input,array('kode_produk' =>$input['kode_produk']));
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
}

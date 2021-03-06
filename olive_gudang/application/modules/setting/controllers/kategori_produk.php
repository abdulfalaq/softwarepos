<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategori_produk extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
           $data['konten'] = $this->load->view('kategori_produk/daftar', NULL, TRUE);
           $this->load->view ('admin/main', $data);
	}

	public function tambah()
	{
           $data['konten'] = $this->load->view('kategori_produk/tambah', NULL, TRUE);
           $this->load->view ('admin/main', $data);
	}

	public function edit()
	{
           $data['konten'] = $this->load->view('kategori_produk/edit', NULL, TRUE);
           $this->load->view ('admin/main', $data);
	}
	public function detail()
	{
           $data['konten'] = $this->load->view('kategori_produk/detail', NULL, TRUE);
           $this->load->view ('admin/main', $data);
	}



	public function act_simpan()
	{	
		$data['kode'] 					= trim($this->input->post('kode'));
		$data['nominal_simpanan_wajib'] = trim($this->input->post('nominal'));
		$data['tanggal_aktivasi'] 		= trim($this->input->post('tanggal_aktivasi'));

		$this->db->insert('master_simpanan_wajib',$data);
		echo "success";
	}

	public function act_update()
	{				
		$data['kode'] 					= trim($this->input->post('kode'));
		$data['nominal_simpanan_wajib'] = trim($this->input->post('nominal'));
		$data['tanggal_aktivasi'] 		= trim($this->input->post('tanggal_aktivasi'));

			$id = $this->input->post('id');
			$this->db->where(array('id'=>$id));
			$this->db->update('master_simpanan_wajib',$data);
			echo "success";
	}

	public function act_delete()
	{
		$id = $this->input->post('id');
		$this->db->where(array('id'=>$id));
		$this->db->delete('master_simpanan_wajib');
		echo "delete";
	}
}

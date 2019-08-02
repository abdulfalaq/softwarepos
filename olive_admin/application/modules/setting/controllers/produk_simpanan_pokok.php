<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk_simpanan_pokok extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
           $data['konten'] = $this->load->view('produk/simpanan/simpanan_pokok', NULL, TRUE);
           $this->load->view ('admin/main', $data);
	}



	public function tambah()
	{
           $data['konten'] = $this->load->view('produk/simpanan/simpanan_pokok_tambah', NULL, TRUE);
           $this->load->view ('admin/main', $data);
	}

	public function edit()
	{
           $data['konten'] = $this->load->view('produk/simpanan/simpanan_pokok_edit', NULL, TRUE);
           $this->load->view ('admin/main', $data);
	}



	public function act_simpan()
	{	
		$data['kode'] 					= trim($this->input->post('kode'));
		$data['nominal_simpanan_pokok'] = trim($this->input->post('nominal'));
		$data['tanggal_aktivasi'] 		= trim($this->input->post('tanggal_aktivasi'));

		$this->db->insert('master_simpanan_pokok',$data);
		echo "success";
	}

	public function act_update()
	{				
		$data['kode'] 					= trim($this->input->post('kode'));
		$data['nominal_simpanan_pokok'] = trim($this->input->post('nominal'));
		$data['tanggal_aktivasi'] 		= trim($this->input->post('tanggal_aktivasi'));

			$id = $this->input->post('id');
			$this->db->where(array('id'=>$id));
			$this->db->update('master_simpanan_pokok',$data);
			echo "success";
	}

	public function act_delete()
	{
		$id = $this->input->post('id');
		$this->db->where(array('id'=>$id));
		$this->db->delete('master_simpanan_pokok');
		echo "delete";
	}
}

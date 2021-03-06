<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mercant extends MY_Controller {


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
		$data['konten'] = $this->load->view('setting/mercant/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function daftar()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('mercant/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('setting/mercant/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('setting/mercant/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('setting/mercant/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function simpan_member()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$input = $this->input->post();
		$insert = $this->db2->insert('master_merchant',$input);
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}
	public function update_member()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$input = $this->input->post();
		$insert = $this->db2->update('master_merchant',$input,array('kode_merchant' =>$input['kode_merchant']));
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}

	public function hapus_gudang(){
		$this->db2 = $this->load->database('olive_master', TRUE);
		$kode_merchant = $this->input->post('kode_merchant');
		$this->db2->delete('master_merchant', array('kode_merchant' => $kode_merchant ));

	}
	public function cek_kode_promo(){
		$this->db2 = $this->load->database('olive_master', TRUE);
		$kode_merchant = $this->input->post('kode_merchant');
		$get = $this ->db2 ->get_where('master_merchant', array('kode_merchant' =>$kode_merchant));
		$peringatan = $get->row();
		if(empty($peringatan)){
			$data['peringatan']='kosong';
		}else{
			$data['peringatan']='ada';
		}

		echo json_encode($data);

	}

}

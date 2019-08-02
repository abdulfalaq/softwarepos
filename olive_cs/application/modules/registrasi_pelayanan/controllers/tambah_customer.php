<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tambah_customer extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('tambah_customer', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah_customer()
	{
		$data['konten'] = $this->load->view('tambah_customer', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit_customer()
	{
		$data['konten'] = $this->load->view('edit_customer', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function logout()
	{
		$this->session->unset_userdata('astrosession');
		$this->session->sess_destroy();
		clearstatcache();
		redirect($this->cname);
	}

	public function simpan_member()
	{
		$input = $this->input->post();
		$input['tanggal_registrasi'] = date('Y-m-d');
		$input['exp_date_member'] = date('Y-m-d H:i', time() + (60 * 60 * 24 * 730));
		$insert = $this->db->insert('olive_master.master_member',$input);
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}

	public function cek_kode_promo(){
		$kode_member = $this->input->post('kode_member');
		$get = $this ->db ->get_where('olive_master.master_member', array('kode_member' =>$kode_member));
		$peringatan = $get->row();
		if(empty($peringatan)){
			$data['peringatan']='kosong';
		}else{
			$data['peringatan']='ada';
		}

		echo json_encode($data);

	}
	public function hapus_gudang(){
		$kode_member = $this->input->post('kode_member');
		$this->db->delete('olive_master.master_member', array('kode_member' => $kode_member ));

	}
	public function update_member()
	{
		$input = $this->input->post();
		$input['tanggal_registrasi'] = date('Y-m-d');
		$input['exp_date_member'] = date('Y-m-d H:i', time() + (60 * 60 * 24 * 730));
		$insert = $this->db->update('olive_master.master_member',$input,array('kode_member' =>$input['kode_member']));
		if ($insert) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}

	
}

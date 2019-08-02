<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class layanan extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
		$this->olive_master = $this->load->database('olive_master', TRUE);
	}

	public function index()
	{
		$data['konten'] = $this->load->view('setting/layanan/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah()
	{
		$data['konten'] = $this->load->view('setting/layanan/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function daftar()
	{
		$data['konten'] = $this->load->view('setting/layanan/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$this->olive_master = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('setting/layanan/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail()
	{
		$this->olive_master = $this->load->database('olive_master', TRUE);
		$data['konten'] = $this->load->view('setting/layanan/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function simpan()
	{
		$data = $this->input->post(); 
		$get  = $this ->db ->get_where('olive_master.master_layanan_periksa', array('kode_periksa' => $data['kode_periksa']));
		$peringatan = $get->row();
		if(!empty($peringatan)){
			$data['response']='ada';
		}else{ 
			$isi = $this->olive_master->insert('master_layanan_periksa',$data);
			if ($isi) {
				$data['response'] = 'sukses';
			}else{
				$data['response'] = 'gagal';
			}
		}
		echo json_encode($data);
	}

	public function update()
	{
		$data = $this->input->post();	
		$this->olive_master->where('kode_periksa', $data['kode_periksa']);	
		$isi = $this->olive_master->update('master_layanan_periksa',$data);
		if ($isi) {
			$data['response'] = 'sukses';
		}else{
			$data['response'] = 'gagal';
		}

		echo json_encode($data);
	}

	public function hapus()
	{
		$kode_periksa = $this->input->post('kode_periksa');
		$this->olive_master->delete('master_layanan_periksa', array('kode_periksa' => $kode_periksa ));

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

	public function cek_kode_promo()
	{

		$kode_periksa = $this->input->post('kode_periksa');
		$get = $this ->db ->get_where('olive_master.master_layanan_periksa', array('kode_periksa' =>$kode_periksa));
		$peringatan = $get->row();
		if(empty($peringatan)){
			$data['peringatan']='kosong';
		}else{
			$data['peringatan']='ada';
		}

		echo json_encode($data);

	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class customer extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
		
	}

	public function index()
	{
           $data['konten'] = $this->load->view('customer', NULL, TRUE);
           $this->load->view ('admin/main', $data);
	}

	public function get_rupiah_modal_awal()
    {
        $modal_awal = $this->input->post('modal_awal');
        $hasil = format_rupiah($modal_awal);

        echo $hasil;
                         
    }

	public function simpan(){
		$input = $this->input->post();

		$data['kode'] =  $input['kode'];
		$data['nama_koperasi'] = $input['nama_koperasi'];
		$data['nama_pic'] = $input['nama_pic'];
		$data['alamat_koperasi'] = $input['alamat_koperasi'];
		$data['no_telp_koperasi'] = $input['no_telp_koperasi'];
		$data['no_telp_pic'] = $input['no_telp_pic'];
		$data['periode_kerja_bulan'] = $input['periode_kerja_bulan'];
		$data['periode_kerja_tanggal'] = $input['periode_kerja_tanggal'];
		$data['modal_awal'] = $input['modal_awal'];
		$this->db->update('master',$data,array('id' =>$input['id']));
		
		

		$data_feedback['status_simpan'] = 'berhasil';
		echo json_encode($data_feedback);
	}

	public function edit_profile(){
		$data = $input = $this->input->post();
		$this->db->update('master',$data,array('id' =>$data['id']));

	}

	
		
	public function logout()
	{
		$this->session->unset_userdata('astrosession');
		$this->session->sess_destroy();
		clearstatcache();
		redirect($this->cname);
	}

	
}

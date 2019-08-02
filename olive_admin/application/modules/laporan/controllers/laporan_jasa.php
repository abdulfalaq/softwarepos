<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_jasa extends MY_Controller {


	public function index()
	{

		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('laporan_jasa/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah()
	{
		$data['konten'] = $this->load->view('laporan_jasa/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('laporan_jasa/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('laporan_jasa/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function simpan()
	{
        $input = $this->input->post();
        $insert = $this->db_master->insert('laporan_jasa',$input);
        
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
     public function update()
	{
        $input = $this->input->post();
         $this->db_master->where('id', $input['id']);
        $insert = $this->db_master->update('laporan_jasa',$input);
        
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function hapus()
    {

  
        $input = $this->input->post('id');
        $this->db_master->delete('laporan_jasa', array('id' => $input ));

    }
    public function load_data_cari(){
    	$this->load->view('laporan_jasa/load_data_cari');
    }
    public function print_data(){
    	$this->load->view('laporan_jasa/cetak_data');
    }
}

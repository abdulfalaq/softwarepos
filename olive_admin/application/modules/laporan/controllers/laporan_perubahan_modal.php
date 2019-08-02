<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_perubahan_modal extends MY_Controller {


	public function index()
	{

		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('laporan_perubahan_modal/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah()
	{
		$data['konten'] = $this->load->view('laporan_perubahan_modal/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('laporan_perubahan_modal/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('laporan_perubahan_modal/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function simpan()
	{
        $input = $this->input->post();
        $insert = $this->db_master->insert('laporan_perubahan_modal',$input);
        
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
        $insert = $this->db_master->update('laporan_perubahan_modal',$input);
        
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
        $this->db_master->delete('laporan_perubahan_modal', array('id' => $input ));

    }

	public function print_perlengkapan()
	{
		$this->load->view('laporan_perubahan_modal/cetak_perlengkapan');
	}
}

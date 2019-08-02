<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_stok_bahan extends MY_Controller {


	public function index()
	{

		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$data['konten'] = $this->load->view('laporan_stok_bahan/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah()
	{
		$data['konten'] = $this->load->view('laporan_stok_bahan/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$data['konten'] = $this->load->view('laporan_stok_bahan/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('laporan_stok_bahan/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function simpan()
	{
        $input = $this->input->post();
        $insert = $this->db_master->insert('laporan_stok_bahan',$input);
        
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
        $insert = $this->db_master->update('laporan_stok_bahan',$input);
        
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function print_stok_bahan()
	{
		$this->db2 = $this->load->database('olive_master', TRUE);
		$this->load->view('laporan_stok_bahan/cetak_stok_bahan');
	}
    public function hapus()
    {

  
        $input = $this->input->post('id');
        $this->db_master->delete('laporan_stok_bahan', array('id' => $input ));

    }

    public function load_data_cari(){
    	$this->load->view('laporan_stok_bahan/load_table_cari');
    }
}

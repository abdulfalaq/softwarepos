<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategori_penyakit extends MY_Controller {


	public function index()
	{
		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$this->db_master = $this->load->database('master',TRUE);
		$data['konten'] = $this->load->view('kategori_penyakit/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah()
	{	
		$this->db_master = $this->load->database('master',TRUE);
		$data['konten'] = $this->load->view('kategori_penyakit/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{	
		$this->db_master = $this->load->database('master',TRUE);
		$data['konten'] = $this->load->view('kategori_penyakit/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{	
		$this->db_master = $this->load->database('master',TRUE);
		$data['konten'] = $this->load->view('kategori_penyakit/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function simpan()
	{
		$this->db_master = $this->load->database('master',TRUE);
        $input = $this->input->post();
        $insert = $this->db_master->insert('master_kategori_penyakit',$input);
        
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function update()
	{
		$this->db_master = $this->load->database('master',TRUE);
        $input = $this->input->post();
         $this->db_master->where('id', $input['id']);
        $insert = $this->db_master->update('master_kategori_penyakit',$input);
        
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function hapus()
    {

    	$this->db_master = $this->load->database('master',TRUE);
        $input = $this->input->post('id');
        $this->db_master->delete('master_kategori_penyakit', array('id' => $input ));

    }
}

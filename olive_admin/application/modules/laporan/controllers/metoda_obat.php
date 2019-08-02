<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class metoda_obat extends MY_Controller {


	public function index()
	{
		$this->db_master = $this->load->database('master',TRUE);
		$data['konten'] = $this->load->view('master', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$this->db_master = $this->load->database('master',TRUE);
		$data['konten'] = $this->load->view('metoda_obat/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$this->db_master = $this->load->database('master',TRUE);
		$data['konten'] = $this->load->view('metoda_obat/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit()
	{
		$this->db_master = $this->load->database('master',TRUE);
		$data['konten'] = $this->load->view('metoda_obat/edit', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$this->db_master = $this->load->database('master',TRUE);
		$data['konten'] = $this->load->view('metoda_obat/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function simpan()
	{
		$this->db_master = $this->load->database('master',TRUE);
        $input = $this->input->post();
        $insert = $this->db_master->insert('master_metoda_obat',$input);
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function update_metoda()
    {
    	$this->db_master = $this->load->database('master',TRUE);
        $input = $this->input->post();
        $this->db_master->where('id', $input['id']);
        $insert = $this->db_master->update('master_metoda_obat',$input);
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function hapus_metoda(){
    	$this->db_master = $this->load->database('master',TRUE);
        $kode_gudang = $this->input->post('id');
        $this->db_master->delete('master_metoda_obat', array('id' => $kode_gudang ));

    }
}

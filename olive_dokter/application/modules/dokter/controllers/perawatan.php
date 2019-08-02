<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class perawatan extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
    }

    public function index()
    {

        $data['konten'] = $this->load->view('perawatan/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function daftar()
    {

        $data['konten'] = $this->load->view('perawatan/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit()
    {

        $data['konten'] = $this->load->view('perawatan/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function detail()
    {


        $data['konten'] = $this->load->view('perawatan/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar_diterima()
    {

        $data['konten'] = $this->load->view('perawatan/daftar_diterima', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    
    public function tambah()
    {
        $data['konten'] = $this->load->view('perawatan/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function cari_bahan()
    {
        $this->load->view('perawatan/data_perawatan');
    }

    

}

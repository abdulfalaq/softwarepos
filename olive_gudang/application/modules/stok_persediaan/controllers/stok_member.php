<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stok_member extends MY_Controller {


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
        $data['konten'] = $this->load->view('stok_member/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function daftar()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('stok_member/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('stok_member/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function detail()
    {

        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('stok_member/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar_diterima()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('stok_member/daftar_diterima', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    
    public function tambah()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('stok_member/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function cari_bahan()
    {
        $this->load->view('stok_member/data_perawatan');
    }

    

}

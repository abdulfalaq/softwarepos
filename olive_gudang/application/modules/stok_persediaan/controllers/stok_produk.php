<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stok_produk extends MY_Controller {


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
        $data['konten'] = $this->load->view('stok_produk/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function daftar()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('stok_produk/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('stok_produk/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function detail()
    {

        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('stok_produk/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar_diterima()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('stok_produk/daftar_diterima', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    
    public function tambah()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('stok_produk/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function cari_bahan()
    {
        $this->load->view('stok_produk/data_perawatan');
    }

    public function print_perlengkapan()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $this->load->view('stok_produk/cetak_perlengkapan');
    }

    

}

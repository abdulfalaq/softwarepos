<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stok_perlengkapan extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
    }

    public function index()
    {
       
       $data['konten'] = $this->load->view('stok_perlengkapan/daftar', NULL, TRUE);
       $this->load->view ('admin/main', $data);
   }

   public function daftar()
   {
       
       $data['konten'] = $this->load->view('stok_perlengkapan/daftar', NULL, TRUE);
       $this->load->view ('admin/main', $data);
   }
   public function edit()
   {

       $data['konten'] = $this->load->view('stok_perlengkapan/edit', NULL, TRUE);
       $this->load->view ('admin/main', $data);
   }

   public function detail()
   {

       
       $data['konten'] = $this->load->view('stok_perlengkapan/detail', NULL, TRUE);
       $this->load->view ('admin/main', $data);
   }
   public function daftar_diterima()
   {
       
       $data['konten'] = $this->load->view('stok_perlengkapan/daftar_diterima', NULL, TRUE);
       $this->load->view ('admin/main', $data);
   }

   public function tambah()
   {
     
     $data['konten'] = $this->load->view('stok_perlengkapan/tambah', NULL, TRUE);
     $this->load->view ('admin/main', $data);

 }
 public function cari_bahan()
 {
     
     $this->load->view('stok_perlengkapan/data_perawatan');
 }



}

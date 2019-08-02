<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
    }

    public function index()
    {
        $data['konten'] = $this->load->view('user/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
     public function daftar()
    {
        $data['konten'] = $this->load->view('user/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
     public function tambah()
    {
        $data['konten'] = $this->load->view('user/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }


}

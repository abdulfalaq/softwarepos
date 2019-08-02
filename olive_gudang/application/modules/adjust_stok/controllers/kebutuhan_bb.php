<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kebutuhan_bb extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
    }

    public function index()
    {
        $data['konten'] = $this->load->view('kebutuhan_bb/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
     public function daftar()
    {
        $data['konten'] = $this->load->view('kebutuhan_bb/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
     public function tambah()
    {
        $data['konten'] = $this->load->view('kebutuhan_bb/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }


}

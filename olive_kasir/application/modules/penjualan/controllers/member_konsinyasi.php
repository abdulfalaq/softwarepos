<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class member_konsinyasi extends MY_Controller {


    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));
        }
        $this->db_master = $this->load->database('kan_master', TRUE);
    }

    public function record_transaksi_member()
    {
        $data['konten'] = $this->load->view('member/member_konsinyasi/record_transaksi_member', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    
    public function profil_member()
    {
        $data['konten'] = $this->load->view('member/member_konsinyasi/profil_member', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function detail_profil_member()
    {
        $data['konten'] = $this->load->view('member/member_konsinyasi/detail_profile', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    
    public function evaluasi_member()
    {
        $data['konten'] = $this->load->view('member/member_konsinyasi/evaluasi_member', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    
    public function get_detail_record()
    {
       $data['konten'] = $this->load->view('member/member_konsinyasi/detail_record_transaksi', NULL, TRUE);
       $this->load->view ('admin/main', $data);
    }
    public function get_detail_akun(){
        $data['konten'] = $this->load->view('member/member_konsinyasi/detail_profile', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

}

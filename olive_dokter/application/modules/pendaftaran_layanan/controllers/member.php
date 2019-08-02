<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class member extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
        $this->db_master = $this->load->database('kan_master', TRUE);
    }

    public function daftar()
    {
        $data['konten'] = $this->load->view('member/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    
    public function tambah()
    {
        $data['konten'] = $this->load->view('member/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function edit()
    {
        $data['konten'] = $this->load->view('member/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function simpan_member()
    {
        $input = $this->input->post();
        $insert = $this->db_master->insert('master_member',$input);
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    
    public function update_member()
    {
        $input = $this->input->post();
        $insert = $this->db_master->update('master_member',$input,array('kode_member' =>$input['kode_member']));
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }

    public function hapus_member(){
        $data = $this->input->post();

        $this->db_master->where('kode_member', $data['kode_member']);
        $this->db_master->delete('master_member');
    }


}

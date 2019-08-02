<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class gudang extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
        $this->db2 = $this->load->database('kan_master', TRUE);
    }

    public function index()
    {
        $data['konten'] = $this->load->view('gudang/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function daftar()
    {
        $data['konten'] = $this->load->view('gudang/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function tambah()
    {
        $data['konten'] = $this->load->view('gudang/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit()
    {
        $data['konten'] = $this->load->view('gudang/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function detail()
    {
        $data['konten'] = $this->load->view('gudang/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function simpan_gudang()
    {
        $input = $this->input->post();
        $insert = $this->db2->insert('master_gudang',$input);
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function update_gudang()
    {
        $input = $this->input->post();
        $insert = $this->db2->update('master_gudang',$input,array('kode_gudang' =>$input['kode_gudang']));
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function hapus_gudang(){
        $kode_gudang = $this->input->post('kode_gudang');
        $this->db2->delete('master_gudang', array('kode_gudang' => $kode_gudang ));

    }


}

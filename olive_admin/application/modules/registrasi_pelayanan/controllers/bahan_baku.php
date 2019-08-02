<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bahan_baku extends MY_Controller {


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
        $data['konten'] = $this->load->view('bahan_baku/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar()
    {
        $data['konten'] = $this->load->view('bahan_baku/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function tambah()
    {
        $data['konten'] = $this->load->view('bahan_baku/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit()
    {
        $data['konten'] = $this->load->view('bahan_baku/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function detail()
    {
        $data['konten'] = $this->load->view('bahan_baku/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function simpan_bahan_baku()
    {
        $get_unit   = $this->db->get('setting')->row();
        $input      = $this->input->post();

        $input['status'] = 1;
        $input['kode_unit_jabung'] = @$get_unit->kode_unit;
        $insert = $this->db2->insert('master_bahan_baku',$input);
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function update_bahan_baku()
    {
        $get_unit   = $this->db->get('setting')->row();
        $input      = $this->input->post();
        $kode_bahan_baku = $this->input->post('kode_bahan_baku');

        $input['status'] = 1;
        $input['kode_unit_jabung'] = @$get_unit->kode_unit;
        $insert = $this->db2->update('master_bahan_baku',$input,array('kode_bahan_baku' =>$kode_bahan_baku));
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function hapus_bahan_baku(){
        $kode_bahan_baku = $this->input->post('kode_bahan_baku');
        $this->db2->delete('master_bahan_baku', array('kode_bahan_baku' => $kode_bahan_baku ));

    }

}

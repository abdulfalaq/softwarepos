<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rak extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
    }

    public function index()
    {
        $this->db_olive_master = $this->load->database('olive_master',TRUE);
        $data['konten'] = $this->load->view('rak/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function daftar()
    {
        $this->db_olive_master = $this->load->database('olive_master',TRUE);
        $data['konten'] = $this->load->view('rak/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit()
    {

        $this->db_olive_master = $this->load->database('olive_master',TRUE);
        $data['konten'] = $this->load->view('rak/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function detail()
    {


        $this->db_olive_master = $this->load->database('olive_master',TRUE);
        $data['konten'] = $this->load->view('rak/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar_diterima()
    {

        $this->db_olive_master = $this->load->database('olive_master',TRUE);
        $data['konten'] = $this->load->view('rak/daftar_diterima', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    
    public function tambah()
    {
        $this->db_olive_master = $this->load->database('olive_master',TRUE);
        $data['konten'] = $this->load->view('rak/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function cari_bahan()
    {
        $this->load->view('rak/data_perawatan');
    }

    public function simpan()
    {
        $this->db_olive_master = $this->load->database('olive_master',TRUE);
        $input = $this->input->post();
        $insert = $this->db_olive_master->insert('master_rak',$input);
        
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function update()
    {
        $this->db_olive_master = $this->load->database('olive_master',TRUE);
        $input = $this->input->post();
        $this->db_olive_master->where('id', $input['id']);
        $insert = $this->db_olive_master->update('master_rak',$input);
        
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function hapus()
    {

        $this->db_olive_master = $this->load->database('olive_master',TRUE);
        $input = $this->input->post('id');
        $this->db_olive_master->delete('master_rak', array('id' => $input ));

    }

    public function cek_kode_promo(){
        $this->db2 = $this->load->database('olive_master', TRUE);
        $kode_rak = $this->input->post('kode_rak');
        $get = $this ->db2 ->get_where('master_rak', array('kode_rak' =>$kode_rak));
        $peringatan = $get->row();
        if(empty($peringatan)){
            $data['peringatan']='kosong';
        }else{
            $data['peringatan']='ada';
        }

        echo json_encode($data);

    }

}

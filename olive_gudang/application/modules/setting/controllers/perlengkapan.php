<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class perlengkapan extends MY_Controller {


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
        $data['konten'] = $this->load->view('perlengkapan/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function daftar()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('perlengkapan/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('perlengkapan/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function detail()
    {

        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('perlengkapan/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar_diterima()
    {

        $data['konten'] = $this->load->view('perlengkapan/daftar_diterima', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    
    public function tambah()
    { 
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('perlengkapan/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function cari_bahan()
    {
        $this->load->view('perlengkapan/data_promo');
    }
    public function hapus_gudang(){
        $this->db2 = $this->load->database('olive_master', TRUE);
        $kode_perlengkapan = $this->input->post('kode_perlengkapan');
        $this->db2->delete('master_perlengkapan', array('kode_perlengkapan' => $kode_perlengkapan ));

    }
    public function get_nomin()
    {   
        $nominal = $this->input->post('nominal');   
        
        echo @format_rupiah($nominal);
        
    }

    public function simpan_member()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $input = $this->input->post();
        $insert = $this->db2->insert('master_perlengkapan',$input);
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function update_member()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $input = $this->input->post();
        $insert = $this->db2->update('master_perlengkapan',$input,array('kode_perlengkapan' =>$input['kode_perlengkapan']));
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }

    public function cek_kode_promo(){
        $this->db2 = $this->load->database('olive_master', TRUE);
        $kode_perlengkapan = $this->input->post('kode_perlengkapan');
        $get = $this ->db2 ->get_where('master_perlengkapan', array('kode_perlengkapan' =>$kode_perlengkapan));
        $peringatan = $get->row();
        if(empty($peringatan)){
            $data['peringatan']='kosong';
        }else{
            $data['peringatan']='ada';
        }

        echo json_encode($data);

    }

    

}

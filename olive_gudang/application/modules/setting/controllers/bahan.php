<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bahan extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
    }

    public function index()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);

        $data['konten'] = $this->load->view('bahan/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function daftar()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);

        $data['konten'] = $this->load->view('bahan/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);

        $data['konten'] = $this->load->view('bahan/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function detail()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);


        $data['konten'] = $this->load->view('bahan/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar_diterima()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);

        $data['konten'] = $this->load->view('bahan/daftar_diterima', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    
    public function tambah()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $data['konten'] = $this->load->view('bahan/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function cari_bahan()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $this->load->view('bahan/data_paket');
    }

    public function hapus(){
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $kode_obat = $this->input->post('id');
        $this->db_olive->delete('master_bahan_baku', array('id' => $kode_obat ));

    }
    public function update()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $data = $this->input->post();   
        $this->db_olive->where('id', $data['id']); 
        $isi = $this->db_olive->update('master_bahan_baku',$data);
        if ($isi) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function simpan()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $data = $this->input->post();       
        $isi = $this->db_olive->insert('master_bahan_baku',$data);
        if ($isi) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function cek_kode_promo(){
        $this->db_olive = $this->load->database('olive_master', TRUE);
        $kode_bahan_baku = $this->input->post('kode_bahan_baku');
        $get = $this ->db_olive ->get_where('master_bahan_baku', array('kode_bahan_baku' =>$kode_bahan_baku));
        $peringatan = $get->row();
        if(empty($peringatan)){
            $data['peringatan']='kosong';
        }else{
            $data['peringatan']='ada';
        }

        echo json_encode($data);

    }
    

}

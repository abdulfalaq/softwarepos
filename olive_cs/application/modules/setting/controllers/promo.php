<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class promo extends MY_Controller {


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
        $data['konten'] = $this->load->view('promo/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function daftar()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('promo/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('promo/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function detail()
    {

        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('promo/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar_diterima()
    {

        $data['konten'] = $this->load->view('promo/daftar_diterima', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function tambah()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('promo/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function cari_bahan()
    {
        $this->load->view('promo/data_promo');
    }

    public function simpan_member()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $input = $this->input->post();
        $insert = $this->db2->insert('master_promo',$input);
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function hapus_gudang(){
        $this->db2 = $this->load->database('olive_master', TRUE);
        $kode_promo = $this->input->post('kode_promo');
        $this->db2->delete('master_promo', array('kode_promo' => $kode_promo ));

    }
    public function update_member()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $input = $this->input->post();
        $insert = $this->db2->update('master_promo',$input,array('kode_promo' =>$input['kode_promo']));
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function cek_kode_promo(){ 
        $kode_promo = $this->input->post('kode_promo');
        $get = $this ->db ->get_where('olive_master.master_promo', array('kode_promo' =>$kode_promo));
        $peringatan = $get->row();
        if(empty($peringatan)){
            $data['peringatan']='kosong';
        }else{
            $data['peringatan']='ada';
        }

        echo json_encode($data);

    }



}

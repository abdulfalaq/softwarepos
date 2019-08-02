<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jabatan extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
    }

    public function index()
    {

        $data['konten'] = $this->load->view('jabatan/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function daftar()
    {
        $this->olive_master = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('jabatan/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit()
    {
        $this->olive_master = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('jabatan/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function detail()
    {
        $this->olive_master = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('jabatan/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar_diterima()
    {

        $data['konten'] = $this->load->view('jabatan/daftar_diterima', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    
    public function tambah()
    {
        $data['konten'] = $this->load->view('jabatan/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function cari_jabatan()
    {
        $this->load->view('jabatan/data_paket');
    }

    public function simpan()
    {
        $this->olive_master = $this->load->database('olive_master', TRUE);
        $input = $this->input->post();
        $insert = $this->olive_master->insert('master_jabatan',$input);
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }

    public function hapus(){

        $this->olive_master = $this->load->database('olive_master', TRUE);
        $kode_jabatan = $this->input->post('kode_jabatan');
        $this->olive_master->delete('master_jabatan', array('kode_jabatan' => $kode_jabatan ));

    }
    public function update()
    {
        $this->olive_master = $this->load->database('olive_master', TRUE);
        $input = $this->input->post();
        $insert = $this->olive_master->update('master_jabatan',$input,array('kode_jabatan' =>$input['kode_jabatan']));
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }

    public function cek_kode_promo(){
        $this->olive_master = $this->load->database('olive_master', TRUE);
        $kode_jabatan = $this->input->post('kode_jabatan');
        $get = $this ->olive_master ->get_where('master_jabatan', array('kode_jabatan' =>$kode_jabatan));
        $peringatan = $get->row();
        if(empty($peringatan)){
            $data['peringatan']='kosong';
        }else{
            $data['peringatan']='ada';
        }

        echo json_encode($data);

    }
}

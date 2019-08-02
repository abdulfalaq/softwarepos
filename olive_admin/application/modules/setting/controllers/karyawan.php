<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class karyawan extends MY_Controller {


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
        $data['konten'] = $this->load->view('karyawan/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function daftar()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('karyawan/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('karyawan/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function detail()
    {

        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('karyawan/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar_diterima()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('karyawan/daftar_diterima', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    
    public function tambah()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('karyawan/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function cari_bahan()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $this->load->view('karyawan/data_promo');
    }

    public function simpan_member()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $input = $this->input->post();
        $input['status_karyawan']='1';
        $insert = $this->db2->insert('master_karyawan',$input);

        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }

    public function cek_kode_promo(){
        $this->db2 = $this->load->database('olive_master', TRUE);
        $kode_karyawan = $this->input->post('kode_karyawan');
        $get = $this ->db2 ->get_where('master_karyawan', array('kode_karyawan' =>$kode_karyawan));
        $peringatan = $get->row();
        if(empty($peringatan)){
            $data['peringatan']='kosong';
        }else{
            $data['peringatan']='ada';
        }

        echo json_encode($data);

    }
    public function get_nomin()
    {   
        $gaji = $this->input->post('gaji');   

        echo @format_rupiah($gaji);

    }
    public function hapus_gudang(){
        $this->db2 = $this->load->database('olive_master', TRUE);
        $kode_karyawan = $this->input->post('kode_karyawan');
        $this->db2->delete('master_karyawan', array('kode_karyawan' => $kode_karyawan ));

    }
    public function update_member()
    {
        $this->db2 = $this->load->database('olive_master', TRUE);
        $input = $this->input->post();
        $insert = $this->db2->update('master_karyawan',$input,array('kode_karyawan' =>$input['kode_karyawan']));
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }


    

}

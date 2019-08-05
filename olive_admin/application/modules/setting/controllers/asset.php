<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class asset extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
    }

    public function index()
    {
        $data['konten'] = $this->load->view('asset/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function daftar()
    {
        $data['konten'] = $this->load->view('asset/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit()
    {
        $data['konten'] = $this->load->view('asset/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function detail()
    {
        $data['konten'] = $this->load->view('asset/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar_diterima()
    {
        $data['konten'] = $this->load->view('asset/daftar_diterima', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    
    public function tambah()
    {
        $data['konten'] = $this->load->view('asset/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function cari_bahan()
    {
        $this->load->view('asset/data_perawatan');
    }


    public function simpan()
    {
        $input = $this->input->post();

        $this->db->from('clouoid1_olive_master.master_aset');
        $this->db->where('kode_aset', $input['kode_aset']);
        $cari_bahan = $this->db->get();
        $hasil_cari = $cari_bahan->row();
        if(empty($hasil_cari)){
            $insert = $this->db->insert('clouoid1_olive_master.master_aset',$input);
            if ($insert) {
                $data['response'] = 'sukses';
            }else{
                $data['response'] = 'gagal';
            }
        }else{
            $data['response']='ada';
        }
        

        echo json_encode($data);
    }
    public function update()
    {
        $input = $this->input->post();
        $this->db->where('id', $input['id']);
        $insert = $this->db->update('clouoid1_olive_master.master_aset',$input);
        
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    
    public function hapus()
    {

        $input = $this->input->post('id');
        $this->db->delete('clouoid1_olive_master.master_aset', array('id' => $input ));

    }

    public function cek_kode_promo()
    {
        $kode_aset = $this->input->post('kode_aset');
        $get = $this ->db ->get_where('clouoid1_olive_master.master_aset', array('kode_aset' =>$kode_aset));
        $peringatan = $get->row();
        if(empty($peringatan)){
            $data['peringatan']='kosong';
        }else{
            $data['peringatan']='ada';
        }

        echo json_encode($data);

    }
}

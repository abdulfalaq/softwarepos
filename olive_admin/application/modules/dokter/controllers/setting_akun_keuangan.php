<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class setting_akun_keuangan extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
    }

    public function index()
    {
        $data['konten'] = $this->load->view('setting_akun_keuangan/setting_akun_keuangan', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }


    public function get_kode()
    {
        $kode_jabatan = $this->input->post('kode_jabatan');
        $query = $this->db->get_where('master_jabatan',array('kode_jabatan' => $kode_jabatan))->num_rows();

        if($query > 0){
            echo "1";
        }
        else{
            echo "0";
        }
    }

    public function get_edit()
    {
        $id = $this->input->post('id');
        $query = $this->db->get_where('setting_akun_keuangan',array('id' => $id))->row();
        echo json_encode($query);
    }

    public function simpan_tambah()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('no_akun', 'Akun', 'required');
        $this->form_validation->set_rules('no_sub_akun', 'No Sub Akun', 'required');
        $this->form_validation->set_rules('nama_sub_akun', 'Nama Sub Akun', 'required');
        

        if ($this->form_validation->run() == FALSE) {
            echo warn_msg(validation_errors());
        }else {
            $data = $this->input->post(NULL, TRUE);

            if($data['no_akun']==101){
                $data['nama_akun'] = "Pemasukan";
            }else if($data['no_akun']==102){
                $data['nama_akun'] = "Pengeluaran";
            }

            $this->db->insert("setting_akun_keuangan", $data);
            echo "1";
        }
    }



//------------------------------------------ Proses Update----------------- --------------------//

    public function simpan_edit()
    {
       $this->load->library('form_validation');

       $this->form_validation->set_rules('no_sub_akun', 'No Sub Akun', 'required');
       $this->form_validation->set_rules('nama_sub_akun', 'Nama Sub Akun', 'required');



       if ($this->form_validation->run() == FALSE) {
        echo warn_msg(validation_errors());
    }else {
        $data = $this->input->post(NULL, TRUE);

        if(@$data['no_akun']==101){
            $data['nama_akun'] = "Pemasukan";
        }else if(@$data['no_akun']==102){
            $data['nama_akun'] = "Pengeluaran";
        }

        $this->db->update("setting_akun_keuangan", $data,array('id'=>$data['id']));
        echo "1";
    }
}


//------------------------------------------ Proses Delete----------------- --------------------//
public function hapus(){
    $id = $this->input->post('id');
    $this->db->delete('setting_akun_keuangan',array('id'=>$id));
}
}

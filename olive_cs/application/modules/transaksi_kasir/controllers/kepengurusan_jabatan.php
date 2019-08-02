<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kepengurusan_jabatan extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
    }

    public function index()
    {
        $data['konten'] = $this->load->view('jabatan/jabatan', NULL, TRUE);
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
        $query = $this->db->get_where('master_jabatan',array('id' => $id))->row();
        echo json_encode($query);
    }

    public function simpan_tambah()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kode_jabatan', 'Kode jabatan', 'required');
        $this->form_validation->set_rules('nama_jabatan', 'Nama jabatan', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo warn_msg(validation_errors());
        }else {
            $data = $this->input->post(NULL, TRUE);


            $this->db->insert("master_jabatan", $data);
            echo "1";
        }
    }



//------------------------------------------ Proses Update----------------- --------------------//

    public function simpan_edit()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kode_jabatan', 'kode jabatan', 'required');
        $this->form_validation->set_rules('nama_jabatan', 'nama jabatan', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo warn_msg(validation_errors());
        } 
        else {
            $data = $this->input->post(NULL, TRUE);

            $this->db->update("master_jabatan", $data, array('id'=>$data['id']));
            echo "1";         

        }
    }


//------------------------------------------ Proses Delete----------------- --------------------//
    public function hapus(){
        $id = $this->input->post('id');
        $this->db->delete('master_jabatan',array('id'=>$id));
    }
}

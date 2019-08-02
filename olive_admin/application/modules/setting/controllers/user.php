<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['konten'] = $this->load->view('user/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function daftar()
    {
        $this->olive_master = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('user/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit()
    {
        $this->olive_master = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('user/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function detail()
    {
        $this->olive_master = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('user/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar_diterima()
    {

        $data['konten'] = $this->load->view('user/daftar_diterima', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    
    public function tambah()
    {
        $this->olive_master = $this->load->database('olive_master', TRUE);
        $data['konten'] = $this->load->view('user/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function cari_jabatan()
    {
        $this->load->view('jabatan/data_paket');
    }
    public function get_karyawan()
    {
        $kode_karyawan = $this->input->post('kode_karyawan');
        $this->db->from('olive_master.master_karyawan karyawan');
        $this->db->join('olive_master.master_jabatan jabatan','karyawan.kode_jabatan = jabatan.kode_jabatan','left');
        $this->db->where('karyawan.kode_karyawan', $kode_karyawan);
        $get_karyawan = $this->db->get()->row();
        // $get_karyawan = $this->db->get_where('olive_master.master_jabatan', array('kode_jabatan' => $get_karyawan->kode_jabatan))->row();
        echo json_encode($get_karyawan);
    }

    public function simpan_tambah_user()
    {
        $this->olive_master = $this->load->database('olive_master', TRUE);
        $this->form_validation->set_rules('uname', 'username', 'required');
        $this->form_validation->set_rules('upass', 'password', 'required'); 
        $this->form_validation->set_rules('nama_jabatan', 'nama_jabatan', 'required');

        $this->form_validation->set_rules('status', 'status', 'required');
        $jabatan = $this->input->post('jabatan');

        if ($this->form_validation->run() == FALSE) {
            echo warn_msg(validation_errors());
        } 
        else {
            $data = $this->input->post(NULL, TRUE);
            $data['upass'] = paramEncrypt($data['upass']);
            $get_karyawan = $this->olive_master->get_where('master_karyawan', array('kode_karyawan' => $data['kode_karyawan']))->row();

            $user = array(
                'uname' => $data['uname'],
                'upass' => $data['upass'],
                'jabatan' => $get_karyawan->kode_jabatan,
                'kode_karyawan' => $data['kode_karyawan'],
                'nama_karyawan' => $get_karyawan->nama_karyawan,
                'status' => $data['status'],

                );
            if(!empty($user))$add_user = $this->olive_master->insert('master_user',$user);



            echo '<div class="alert alert-success">Sudah tersimpan.</div>';                 
        }
    }

    public function simpan_edit_user()
    {
        $this->olive_master = $this->load->database('olive_master', TRUE);
        $this->form_validation->set_rules('uname', 'username', 'required');
        $this->form_validation->set_rules('upass', 'password', 'required'); 
        $this->form_validation->set_rules('nama_jabatan', 'nama_jabatan', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');


        if ($this->form_validation->run() == FALSE) {
            echo warn_msg(validation_errors());
        }  else {
          $data = $this->input->post(NULL, TRUE);
          $data['upass'] = paramEncrypt($data['upass']);

          $user = array(
            'uname' => $data['uname'],
            'upass' => $data['upass'],
            'status' => $data['status'],
            );

          $this->db->where('kode_karyawan',$data['kode_karyawan']);
          $this->db->update('olive_master.master_user', $user);
          echo '<div class="alert alert-success">Sudah tersimpan.</div>';    
      }

  }

  public function hapus(){
    $this->olive_master = $this->load->database('olive_master', TRUE);
    $kode_karyawan = $this->input->post('kode_karyawan');
    $this->olive_master->delete('master_user',array('kode_karyawan'=>$kode_karyawan));

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
}

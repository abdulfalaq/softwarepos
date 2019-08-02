<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class perawatan extends MY_Controller {


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
        $data['konten'] = $this->load->view('perawatan/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function cek_kode(){
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $kode_perawatan=$this->input->post('kode_perawatan');
        $get = $this->db_olive->get_where('master_perawatan',array('kode_perawatan'=>$kode_perawatan));
        $hasil = $get->row();
        if(empty($hasil)){
            $data['hasil']='kosong';
        }else{
            $data['hasil']='ada';
        }
        echo json_encode($data);

    }
    public function daftar()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $data['konten'] = $this->load->view('perawatan/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit()
    {
        $data['konten'] = $this->load->view('perawatan/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data)
        ;
        $kode_perawatan=$this->uri->segment(4);

        $this->db->delete('olive_master.opsi_master_perawatan_temp', array('kode_perawatan' => $kode_perawatan ));

        $get_ayam = $this->db->get_where('olive_master.opsi_master_perawatan',array('kode_perawatan' => $kode_perawatan))->result();
        foreach ($get_ayam as  $value) {
            $opsi['kode_perawatan']            =  $value->kode_perawatan;
            $opsi['jenis']                     =  $value->jenis;
            $opsi['kode_bahan']                =  $value->kode_bahan;
            $opsi['kode_perlengkapan']         =  $value->kode_perlengkapan;
            $opsi['qty']                       =  $value->qty;
            $opsi['satuan']                    =  $value->satuan;
            $opsi['hpp']                       =  $value->hpp;

            $this->db->insert('olive_master.opsi_master_perawatan_temp', $opsi);
        }

    }


    public function detail()
    {

        $this->db_olive = $this->load->database('olive_master',TRUE);
        $data['konten'] = $this->load->view('perawatan/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function simpan_temporari()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $insert = $this->input->post();
        if($insert['jenis'] == 'Perlengkapan'){
            $this->db_olive->where('kode_perlengkapan',$insert['kode_perlengkapan']);
            unset($insert['kode_bahan']);
        }else{
            unset($insert['kode_perlengkapan']);
            $this->db_olive->where('kode_bahan',$insert['kode_bahan']);
        }
        $this->db_olive->where('jenis',$insert['jenis']);
        $this->db_olive->where('kode_perawatan',$insert['kode_perawatan']);

        $get_cek = $this->db_olive->get('opsi_master_perawatan_temp')->row();
        if(count($get_cek) > 0){
            $update['qty'] = $get_cek->qty+$insert['qty'];
            $this->db_olive->where('id',$get_cek->id);
            $insert = $this->db_olive->update('opsi_master_perawatan_temp', $update);
        }else{
            $insert = $this->db_olive->insert('opsi_master_perawatan_temp', $insert);
        }   

        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }

    public function update_perawatan()
    {
        $data = $this->input->post();
        $this->db->delete('olive_master.opsi_master_perawatan',array('kode_perawatan' => $data['kode_perawatan']));
        $get_ayam = $this->db->get_where('olive_master.opsi_master_perawatan_temp',array('kode_perawatan' => $data['kode_perawatan']))->result();

        foreach ($get_ayam as $value) { 
            $opsi['kode_perawatan']            =  $value->kode_perawatan;
            $opsi['jenis']                     =  $value->jenis;
            $opsi['kode_bahan']                =  $value->kode_bahan;
            $opsi['kode_perlengkapan']         =  $value->kode_perlengkapan;
            $opsi['qty']                       =  $value->qty;
            $opsi['satuan']                    =  $value->satuan;
            $opsi['hpp']                       =  $value->hpp;

            $this->db->insert('olive_master.opsi_master_perawatan', $opsi);

        }

        $masuk['kode_perawatan']            =  $data['kode_perawatan'];
        $masuk['hpp']                       =  $data['hpp'];
        $masuk['nama_perawatan']            =  $data['nama_perawatan'];
        $masuk['harga_jual']                =  $data['harga_jual'];
        $masuk['insentif_terapi']           =  $data['insentif_terapi'];
        $masuk['status']                    =  $data['status'];
        $masuk['redeem_poin']               =  $data['redeem_poin'];

        $this->db->where('kode_perawatan', $data['kode_perawatan']);
        $insert = $this->db->update('olive_master.master_perawatan', $masuk);

        $this->db->delete('olive_master.opsi_master_perawatan_temp',array('kode_perawatan' => $data['kode_perawatan']));
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }

    public function simpan_perawatan()
    {
        $data = $this->input->post();
        $get_ayam = $this->db->get_where('olive_master.opsi_master_perawatan_temp',array('kode_perawatan' => $data['kode_perawatan']))->result();

        foreach ($get_ayam as  $value) {
            $opsi['kode_perawatan']            =  $value->kode_perawatan;
            $opsi['jenis']                     =  $value->jenis;
            $opsi['kode_bahan']                =  $value->kode_bahan;
            $opsi['kode_perlengkapan']         =  $value->kode_perlengkapan;
            $opsi['qty']                       =  $value->qty;
            $opsi['satuan']                    =  $value->satuan;
            $opsi['hpp']                       =  $value->hpp;

            $this->db->insert('olive_master.opsi_master_perawatan', $opsi);
        }

        $masuk['kode_perawatan']            =  $data['kode_perawatan'];
        $masuk['hpp']                       =  $data['hpp'];
        $masuk['nama_perawatan']            =  $data['nama_perawatan'];
        $masuk['harga_jual']                =  $data['harga_jual'];
        $masuk['insentif_terapi']           =  $data['insentif_terapi'];
        $masuk['status']                    =  $data['status'];
        $masuk['redeem_poin']               =  $data['redeem_poin'];
        $insert = $this->db->insert('olive_master.master_perawatan', $masuk);

        $insert = $this->db->delete('olive_master.opsi_master_perawatan_temp',array('kode_perawatan' => $data['kode_perawatan']));
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function update_temporari()
    {

        $update = $this->input->post();
        $this->db->where('id', $update['id']);
        $insert = $this->db->update('olive_master.opsi_master_perawatan_temp', $update);
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }

    public function cari_bahan()
    {
        $kode_bahan = $this->input->post('kode_bahan');

        $this->db->from('olive_master.master_bahan_baku');
        $this->db->join('olive_master.master_satuan', 'olive_master.master_satuan.kode = olive_master.master_bahan_baku.kode_satuan_stok');
        $this->db->where('kode_bahan_baku', $kode_bahan);
        $cari_bahan = $this->db->get();
        $hasil_cari = $cari_bahan->row();

        echo json_encode($hasil_cari);      
    }

    public function cari_perlengkapan()
    {
        $kode_perlengkapan = $this->input->post('kode_perlengkapan');

        $this->db->from('olive_master.master_perlengkapan');
        $this->db->join('olive_master.master_satuan', 'olive_master.master_satuan.kode = olive_master.master_perlengkapan.kode_satuan_stok');
        $this->db->where('kode_perlengkapan', $kode_perlengkapan);
        $cari_bahan = $this->db->get();
        $hasil_cari = $cari_bahan->row();

        echo json_encode($hasil_cari);      
    }

    public function tampil()
    {

        $kode_perawatan = $this->input->post('kode_perawatan');
        $this->load->view('perawatan/table');
    }
    public function daftar_diterima()
    {

        $data['konten'] = $this->load->view('perawatan/daftar_diterima', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function tambah()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $data['konten'] = $this->load->view('perawatan/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function get_hpp()
    {   
        $hpp = $this->input->post('hpp');   

        echo @format_rupiah($hpp);

    }
    public function get_temp_perawatan(){

        $id = $this->input->post('id');
        $this->db->select('*,olive_master.opsi_master_perawatan_temp.id as id_temp');
        $this->db->from('olive_master.opsi_master_perawatan_temp');
        $this->db->join('olive_master.master_satuan', 'olive_master.master_satuan.kode = olive_master.opsi_master_perawatan_temp.satuan', 'left');
        $this->db->where('olive_master.opsi_master_perawatan_temp.id', $id);
        $pembelian = $this->db->get();
        $hasil_pembelian = $pembelian->row();
        echo json_encode($hasil_pembelian);
    }
    public function get_opsi_master_perawatan(){

        $id = $this->input->post('id');

        $this->db->from('olive_master.opsi_master_perawatan');
        $this->db->join('olive_master.master_satuan', 'olive_master.master_satuan.kode = olive_master.opsi_master_perawatan.satuan', 'left');
        $this->db->where('olive_master.opsi_master_perawatan.id', $id);
        $pembelian = $this->db->get();
        $hasil_pembelian = $pembelian->row();
        echo json_encode($hasil_pembelian);
    }
    public function hapus_temporari(){
        $id = $this->input->post('id');
        $this->db->delete('olive_master.opsi_master_perawatan_temp', array('id' => $id ));

    }
    public function hapus_all_temporari(){
        $kode_perawatan = $this->input->post('kode_perawatan');
        $this->db->delete('olive_master.opsi_master_perawatan_temp', array('kode_perawatan' => $kode_perawatan ));

    }
    public function hapus_perawatan(){
        $kode_perawatan = $this->input->post('kode_perawatan');
        $this->db->delete('olive_master.master_perawatan', array('kode_perawatan' => $kode_perawatan ));

        $kode_perawatan = $this->input->post('kode_perawatan');
        $this->db->delete('olive_master.opsi_master_perawatan', array('kode_perawatan' => $kode_perawatan ));

    }

    public function cek_kode_promo(){
        $kode_perawatan = $this->input->post('kode_perawatan');
        $get = $this ->db ->get_where('olive_master.opsi_master_perawatan', array('kode_perawatan' =>$kode_perawatan));
        $peringatan = $get->row();
        if(empty($peringatan)){
            $data['peringatan']='kosong';
        }else{
            $data['peringatan']='ada';
        }

        echo json_encode($data);

    }


}

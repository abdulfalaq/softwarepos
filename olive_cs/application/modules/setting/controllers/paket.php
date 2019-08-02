<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class paket extends MY_Controller {


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
        $data['konten'] = $this->load->view('paket/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function daftar()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $data['konten'] = $this->load->view('paket/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit_gede()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $data['konten'] = $this->load->view('paket/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $data = $this->input->post();
        $get_data = $this->db_olive->get_where('opsi_master_paket_temp',array('kode_paket' => $data['kode_paket']))->row();

        echo json_encode($get_data);
    }
    public function cancel()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $data = $this->input->post();
        $get_data = $this->db_olive->get_where('opsi_master_paket_temp',array('kode_paket' => $data['kode_paket']))->row();

        echo json_encode($get_data);
    }
    public function detail()
    {

        $this->db_olive = $this->load->database('olive_master',TRUE);
        $data['konten'] = $this->load->view('paket/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar_diterima()
    {

        $data['konten'] = $this->load->view('paket/daftar_diterima', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function tambah()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $data['konten'] = $this->load->view('paket/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function load_tabel()
    {
        $this->load->view('paket/tabel');

    }
    public function load_tabel_opsi()
    {
        $this->load->view('paket/tabel_opsi');

    }
    public function get_hpp()
    {   
        $hpp = $this->input->post('hpp');   

        echo @format_rupiah($hpp);

    }
    public function cek_kode_paket()
    {
        $kode_paket = $this->input->post('kode_paket');

        $this->db->from('olive_master.master_paket');
        $this->db->where('kode_paket', $kode_paket);
        $cari_bahan = $this->db->get();
        $hasil_cari = $cari_bahan->row();
        if(empty($hasil_cari)){
            $hasil['respon']='sukses';
        }else{
            $hasil['respon']='gagal';
        }
        echo json_encode($hasil);      
    }
    public function cari_produk()
    {
        $produk = $this->input->post('produk');

        $this->db->from('olive_master.master_produk');
        $this->db->join('olive_master.master_satuan', 'olive_master.master_satuan.kode = olive_master.master_produk.kode_satuan_stok');
        $this->db->where('kode_produk', $produk);
        $cari_bahan = $this->db->get();
        $hasil_cari = $cari_bahan->row();

        echo json_encode($hasil_cari);      
    }

    public function cari_treatment()
    {
        $treatment = $this->input->post('treatment');

        $this->db->from('olive_master.master_perawatan');
        $this->db->where('kode_perawatan', $treatment);
        $cari_bahan = $this->db->get();
        $hasil_cari = $cari_bahan->row();

        echo json_encode($hasil_cari);      
    }

    public function hapus_data(){
        $id = $this->input->post('id');
        $this->db->delete('olive_master.opsi_master_paket_temp', array('id' => $id ));

    }
    public function hapus_data_opsi(){
        $id = $this->input->post('id');
        $this->db->delete('olive_master.opsi_master_paket', array('id' => $id ));

    }
    public function delete_all_temp(){
        $kode_paket = $this->input->post('kode_paket');
        $this->db->delete('olive_master.opsi_master_paket_temp', array('kode_paket' => $kode_paket ));

    }
    public function add()
    {
        $data = $this->input->post();       

        if($data['jenis_produk'] == 'produk'){
            $masuk['jenis_produk']       = ('produk');
            $masuk['kode_paket']         = $data['kode_paket'];
            $masuk['kode_satuan']        = @$data['kode_satuan'];
            $masuk['kode_produk']        = @$data['produk'];
            $masuk['qty']                = $data['qty'];
            $masuk['hpp']                = $data['hpp_total'];

        }else if($data['jenis_produk'] == 'treatment'){
            $masuk['jenis_produk']       = ('treatment');
            $masuk['kode_paket']         = $data['kode_paket'];
            $masuk['kode_treatment']     = @$data['treatment'];
            $masuk['qty']                = $data['qty'];
            $masuk['hpp']                = $data['hpp_total'];

        }else if($data['jenis_produk'] == 'mix'){
            $masuk['jenis_produk']       = $data['jenis']; 
            $masuk['kode_paket']         = $data['kode_paket'];
            $masuk['kode_treatment']     = @$data['treatment'];
            $masuk['kode_satuan']        = @$data['kode_satuan'];
            $masuk['kode_produk']        = @$data['produk'];
            $masuk['qty']                = $data['qty'];
            $masuk['hpp']                = $data['hpp_total'];   
        }

        $isi = $this->db->insert('olive_master.opsi_master_paket_temp',$masuk);
        if ($isi) {
            $ambil['response'] = 'sukses';
        }else{
            $ambil['response'] = 'gagal';
        }

        echo json_encode($ambil);
    }

    public function add_opsi()
    {
        $data = $this->input->post();       

        if($data['jenis_produk'] == 'produk'){
            $masuk['jenis_produk']       = ('produk');
            $masuk['kode_paket']         = $data['kode_paket'];
            $masuk['kode_satuan']        = @$data['kode_satuan'];
            $masuk['kode_produk']        = @$data['produk'];
            $masuk['qty']                = $data['qty'];
            $masuk['hpp']                = $data['hpp_total'];

        }else if($data['jenis_produk'] == 'treatment'){
            $masuk['jenis_produk']       = ('treatment');
            $masuk['kode_paket']         = $data['kode_paket'];
            $masuk['kode_treatment']     = @$data['treatment'];
            $masuk['qty']                = $data['qty'];
            $masuk['hpp']                = $data['hpp_total'];

        }else if($data['jenis_produk'] == 'mix'){
            $masuk['jenis_produk']       = $data['jenis']; 
            $masuk['kode_paket']         = $data['kode_paket'];
            $masuk['kode_treatment']     = @$data['treatment'];
            $masuk['kode_satuan']        = @$data['kode_satuan'];
            $masuk['kode_produk']        = @$data['produk'];
            $masuk['qty']                = $data['qty'];
            $masuk['hpp']                = $data['hpp_total'];   
        }

        $isi = $this->db->insert('olive_master.opsi_master_paket',$masuk);
        if ($isi) {
            $ambil['response'] = 'sukses';
        }else{
            $ambil['response'] = 'gagal';
        }

        echo json_encode($ambil);
    }

    public function simpan_besar()
    {
        $data = $this->input->post();       

        $get_ayam = $this->db->get_where('olive_master.opsi_master_paket_temp',array('kode_paket' => $data['kode_paket']))->result();

        foreach ($get_ayam as $value) { 

            $opsi['kode_paket']       = $value->kode_paket;
            $opsi['kode_treatment']   = @$value->kode_treatment;
            $opsi['kode_produk']      = @$value->kode_produk;
            $opsi['qty']              = $value->qty;
            $opsi['hpp']              = $value->hpp;
            $opsi['jenis_produk']     = $value->jenis_produk;
            $opsi['kode_satuan']       = $value->kode_satuan;
            $isi = $this->db->insert('olive_master.opsi_master_paket',$opsi);
        }
        $masuk['kode_paket']       = @$data['kode_paket'];
        $masuk['nama_paket']       = @$data['nama_paket'];
        $masuk['harga_jual']       = @$data['harga_jual'];
        $masuk['jenis_produk']     = @$value->jenis_produk;
        $masuk['hpp']              = @$data['hpp'];
        $masuk['status']           = @$data['status'];


        $isi = $this->db->insert('olive_master.master_paket',$masuk);

        $isi = $this->db->delete('olive_master.opsi_master_paket_temp',array('kode_paket' => $data['kode_paket']));

        if ($isi) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function hapus_besar(){
        $kode_paket = $this->input->post('kode_paket');
        $this->db->delete('olive_master.master_paket', array('kode_paket' => $kode_paket ));

        $kode_paket = $this->input->post('kode_paket');
        $this->db->delete('olive_master.opsi_master_paket', array('kode_paket' => $kode_paket ));

    }

    public function update_besar()
    {
        $data = $this->input->post();

        $masuk['kode_paket']       = @$data['kode_paket'];
        $masuk['nama_paket']       = @$data['nama_paket'];
        $masuk['harga_jual']       = @$data['harga_jual'];
        unset($data['jenis_produk']);
        $masuk['hpp']              = @$data['hpp'];
        $masuk['status']           = @$data['status'];

        $this->db->where('olive_master.master_paket.id', $data['kode_paket']);
        $insert = $this->db->update('olive_master.master_paket',$masuk);
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }

    public function get_temp_paket(){

        $id = $this->input->post('id');

        $this->db->from('olive_master.opsi_master_paket_temp');
        $this->db->select('olive_master.opsi_master_paket_temp.id');
        $this->db->select('olive_master.opsi_master_paket_temp.jenis_produk');
        $this->db->select('olive_master.opsi_master_paket_temp.kode_paket');
        $this->db->select('olive_master.opsi_master_paket_temp.kode_treatment');
        $this->db->select('olive_master.opsi_master_paket_temp.kode_satuan');
        $this->db->select('olive_master.opsi_master_paket_temp.kode_produk');
        $this->db->select('olive_master.opsi_master_paket_temp.qty');
        $this->db->select('olive_master.opsi_master_paket_temp.hpp');
        $this->db->select('olive_master.master_satuan.alias');


        $this->db->join('olive_master.master_satuan', 'olive_master.master_satuan.kode = olive_master.opsi_master_paket_temp.kode_satuan', 'left');


        $this->db->where('olive_master.opsi_master_paket_temp.id', $id);
        $pembelian = $this->db->get();
        $hasil_pembelian = $pembelian->row();
        echo json_encode($hasil_pembelian);
    }
    public function get_opsi_paket(){

        $id = $this->input->post('id');

        $this->db->from('olive_master.opsi_master_paket');
        $this->db->select('olive_master.opsi_master_paket.id');
        $this->db->select('olive_master.opsi_master_paket.jenis_produk');
        $this->db->select('olive_master.opsi_master_paket.kode_paket');
        $this->db->select('olive_master.opsi_master_paket.kode_treatment');
        $this->db->select('olive_master.opsi_master_paket.kode_satuan');
        $this->db->select('olive_master.opsi_master_paket.kode_produk');
        $this->db->select('olive_master.opsi_master_paket.qty');
        $this->db->select('olive_master.opsi_master_paket.hpp');
        $this->db->select('olive_master.master_satuan.alias');


        $this->db->join('olive_master.master_satuan', 'olive_master.master_satuan.kode = olive_master.opsi_master_paket.kode_satuan', 'left');


        $this->db->where('olive_master.opsi_master_paket.id', $id);
        $pembelian = $this->db->get();
        $hasil_pembelian = $pembelian->row();
        echo json_encode($hasil_pembelian);
    }
    public function update()
    {
        $data = $this->input->post();       

        $insert['kode_paket']       = @$data['kode_paket'];
        if(empty($data['jenis'])){
            $insert['jenis_produk']     = @$data['jenis_produk'];
        }else{
            $insert['jenis_produk']     = @$data['jenis'];
        }
        $insert['kode_treatment']   = $data['treatment'];
        $insert['kode_produk']      = $data['produk'];
        $insert['kode_satuan']      = @$data['kode_satuan'];
        $insert['qty']              = $data['qty'];
        $insert['hpp']              = $data['hpp_total'];


        $this->db->where('opsi_master_paket_temp.id', $data['id_item']);
        $isi = $this->db->update('olive_master.opsi_master_paket_temp',$insert);
        if ($isi) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function update_opsi()
    {
        $data = $this->input->post();       

        $insert['kode_paket']       = @$data['kode_paket'];
        if(empty($data['jenis'])){
            $insert['jenis_produk']     = @$data['jenis_produk'];
        }else{
            $insert['jenis_produk']     = @$data['jenis'];
        }
        $insert['kode_treatment']   = $data['treatment'];
        $insert['kode_produk']      = $data['produk'];
        $insert['kode_satuan']      = @$data['kode_satuan'];
        $insert['qty']              = $data['qty'];
        $insert['hpp']              = $data['hpp_total'];


        $this->db->where('opsi_master_paket.id', $data['id_item']);
        $isi = $this->db->update('olive_master.opsi_master_paket',$insert);
        if ($isi) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }

    public function cari_bahan()
    {
        $this->load->view('paket/data_paket');
    }
    public function cek_kode(){
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $kode_paket=$this->input->post('kode_paket');
        $get = $this->db_olive->get_where('master_paket',array('kode_paket'=>$kode_paket));
        $hasil = $get->row();
        if(empty($hasil)){
            $data['hasil']='kosong';
        }else{
            $data['hasil']='ada';
        }
        echo json_encode($data);

    }
    public function simpan_paket()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $input = $this->input->post();
        $insert = $this->db_olive->insert('master_paket',$input);
        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }

        echo json_encode($data);
    }
    public function update_paket()
    {
        $this->db_olive = $this->load->database('olive_master',TRUE);
        $input = $this->input->post();
        $this->db_olive->where('kode_paket', $input['kode_paket']);
        $insert = $this->db_olive->update('master_paket',$input);

        if ($insert) {
            $data['response'] = 'sukses';
        }else{
            $data['response'] = 'gagal';
        }
        echo json_encode($data);

    }


}

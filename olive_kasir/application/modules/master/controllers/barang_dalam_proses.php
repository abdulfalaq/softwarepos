<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang_dalam_proses extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
        $this->db2 = $this->load->database('kan_master', TRUE);
    }

    public function index()
    {
        $data['konten'] = $this->load->view('barang_dalam_proses/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    
    public function daftar()
    {
        $data['konten'] = $this->load->view('barang_dalam_proses/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function detail()
    {
        $data['konten'] = $this->load->view('barang_dalam_proses/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function load_table_temp()
    {
        $this->load->view ('barang_dalam_proses/table_temp');
    }

    public function tambah()
    {
        $this->db2->truncate('opsi_master_barang_dalam_proses_temp');
        $data['konten'] = $this->load->view('barang_dalam_proses/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
     public function edit()
    {
        $this->db2->truncate('opsi_master_barang_dalam_proses_temp');
        $kode_barang=$this->uri->segment(4);
        $get_opsi_bdp=$this->db2->get_where('opsi_master_barang_dalam_proses',array('kode_barang' =>@$kode_barang));
        $hasil_opsi_bdp=$get_opsi_bdp->result_array();
        foreach ($hasil_opsi_bdp as $opsi_bdp) {
           unset($opsi_bdp['id']);
           $this->db2->insert('opsi_master_barang_dalam_proses_temp',$opsi_bdp);
       }

        $data['konten'] = $this->load->view('barang_dalam_proses/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function get_bahan(){
        $jenis_bahan = $this->input->post('jenis_bahan');
        if ($jenis_bahan == 'BB') { ?>
        <option value="">-- Pilih Bahan</option>
        <?php 
        $get_bahan = $this->db2->get('master_bahan_baku')->result();
        foreach ($get_bahan as $value) { 
            ?>
            <option value="<?= $value->kode_bahan_baku ?>"><?= $value->nama_bahan_baku ?></option>
            <?php }
        }else if($jenis_bahan == 'BDP'){ ?>
        <option value="">-- Pilih Bahan</option>
        <?php 
        $get_bahan = $this->db2->get('master_barang_dalam_proses')->result();
        foreach ($get_bahan as $value) {
           ?>
           <option value="<?= $value->kode_barang ?>"><?= $value->nama_barang ?></option>
           <?php }
       }else{ 
        ?>
        <option value="">-- Pilih Bahan</option>
        <?php }
    }

    public function get_satuan(){
        $kode_bahan  = $this->input->post('kode_bahan');
        $jenis_bahan = $this->input->post('jenis_bahan');

        if ($jenis_bahan == 'BB') {

            $this->db2->select('*');
            $this->db2->from('master_bahan_baku');
            $this->db2->join('master_satuan','master_satuan.kode = master_bahan_baku.kode_satuan_stok');
            $this->db2->where('master_bahan_baku.kode_bahan_baku', $kode_bahan);

            $get_satuan = $this->db2->get()->row();
            $data['satuan'] =  $get_satuan->nama;

        }else if($jenis_bahan == 'BDP'){

            $this->db2->select('*');
            $this->db2->from('master_barang_dalam_proses');
            $this->db2->join('master_satuan', 'master_satuan.kode = master_barang_dalam_proses.kode_satuan_stok');
            $this->db2->where('master_barang_dalam_proses.kode_barang', $kode_bahan);

            $get_satuan = $this->db2->get()->row();
            $data['satuan'] = $get_satuan->nama;

        }else{
            $data['satuan'] = 'Undefined';
        }

        echo json_encode($data);

    }

    public function add_bdp_temp(){
        $input = $this->input->post();

        $data['jenis_bahan']    = $input['jenis_bahan'];
        $data['kode_barang']    = $input['kode_barang'];
        $data['kode_bahan']     = $input['bahan'];
        $data['qty']            = $input['jumlah'];
        $data['konversi']       = $input['konversi'];


        $insert = $this->db2->insert('opsi_master_barang_dalam_proses_temp', $data);
        if ($insert) {
            $output['response'] = 'sukses';
        }else{
            $output['response'] = 'gagal';
        }


        echo json_encode($output);
    }

    public function delete_temporary_item(){
        $id = $this->input->post('id');
        $this->db2->delete('opsi_master_barang_dalam_proses_temp', array('id' => $id ));
    }
    public function simpan_bdp(){
        $input = $this->input->post();

        $get_setting=$this->db->get('setting');
        $hasil_setting=$get_setting->row();
        $kode_unit_jabung=@$hasil_setting->kode_unit;

        $get_opsi_bdp=$this->db2->get_where('opsi_master_barang_dalam_proses_temp',array('kode_barang' =>@$input['kode_barang']));
        $hasil_opsi_bdp=$get_opsi_bdp->result_array();
        foreach ($hasil_opsi_bdp as $opsi_bdp) {
           unset($opsi_bdp['id']);
           $this->db2->insert('opsi_master_barang_dalam_proses',$opsi_bdp);
       }

       $data['kode_barang']     = $input['kode_barang'];
       $data['nama_barang']     = $input['nama_barang'];
       $data['kode_gudang']     = $input['kode_gudang'];
       $data['stok_minimal']    = $input['stok_minimal'];
       $data['kode_satuan_stok']= $input['kode_satuan_stok'];
       $data['kode_unit_jabung']= $kode_unit_jabung;
       $data['status']          = '1';


       $insert = $this->db2->insert('master_barang_dalam_proses', $data);
       if ($insert) {
        $output['response'] = 'sukses';
    }else{
        $output['response'] = 'gagal';
    }
    $this->db2->delete('opsi_master_barang_dalam_proses_temp', array('kode_barang' =>@$input['kode_barang']));

    echo json_encode($output);
}
public function update_bdp(){
        $input = $this->input->post();

        $get_setting=$this->db->get('setting');
        $hasil_setting=$get_setting->row();
        $kode_unit_jabung=@$hasil_setting->kode_unit;

        $this->db2->delete('opsi_master_barang_dalam_proses', array('kode_barang' =>@$input['kode_barang']));

        $get_opsi_bdp=$this->db2->get_where('opsi_master_barang_dalam_proses_temp',array('kode_barang' =>@$input['kode_barang']));
        $hasil_opsi_bdp=$get_opsi_bdp->result_array();
        foreach ($hasil_opsi_bdp as $opsi_bdp) {
           unset($opsi_bdp['id']);
           $this->db2->insert('opsi_master_barang_dalam_proses',$opsi_bdp);
       }

       $data['nama_barang']     = $input['nama_barang'];
       $data['kode_gudang']     = $input['kode_gudang'];
       $data['stok_minimal']    = $input['stok_minimal'];
       $data['kode_satuan_stok']= $input['kode_satuan_stok'];
       $data['kode_unit_jabung']= $kode_unit_jabung;
       $data['status']          = '1';


       $insert = $this->db2->update('master_barang_dalam_proses', $data,array('kode_barang' =>@$input['kode_barang']));
       if ($insert) {
        $output['response'] = 'sukses';
    }else{
        $output['response'] = 'gagal';
    }
    $this->db2->delete('opsi_master_barang_dalam_proses_temp', array('kode_barang' =>@$input['kode_barang']));

    echo json_encode($output);
}

public function hapus_barang(){
    $kode_barang = $this->input->post('kode_barang');
    $this->db2->delete('opsi_master_barang_dalam_proses', array('kode_barang' => $kode_barang ));
    $this->db2->delete('master_barang_dalam_proses', array('kode_barang' => $kode_barang ));

}
}

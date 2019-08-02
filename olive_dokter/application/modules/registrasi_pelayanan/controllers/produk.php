<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk extends MY_Controller {


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
        $data['konten'] = $this->load->view('produk/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar()
    {
        $data['konten'] = $this->load->view('produk/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function detail()
    {
        $data['konten'] = $this->load->view('produk/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function tambah()
    {
        $this->db2->truncate('opsi_master_produk_temp');
        $data['konten'] = $this->load->view('produk/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function edit()
    {
        $this->db2->truncate('opsi_master_produk_temp');
        $kode_produk=$this->uri->segment(4);
        $get_opsi_pro=$this->db2->get_where('opsi_master_produk',array('kode_produk' =>@$kode_produk));
        $hasil_opsi_pro=$get_opsi_pro->result_array();
        foreach ($hasil_opsi_pro as $opsi_pro) {
           unset($opsi_pro['id']);
           $this->db2->insert('opsi_master_produk_temp',$opsi_pro);
       }

       $data['konten'] = $this->load->view('produk/edit', NULL, TRUE);
       $this->load->view ('admin/main', $data);
   }
   public function load_table_temp()
   {
    $this->load->view ('produk/table_temp');
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
public function add_produk_temp(){
    $input = $this->input->post();

    $data['jenis_bahan']    = $input['jenis_bahan'];
    $data['kode_produk']    = $input['kode_produk'];
    $data['kode_bahan']     = $input['bahan'];
    $data['qty']            = $input['jumlah'];


    $insert = $this->db2->insert('opsi_master_produk_temp', $data);
    if ($insert) {
        $output['response'] = 'sukses';
    }else{
        $output['response'] = 'gagal';
    }


    echo json_encode($output);
}
public function delete_temporary_item(){
    $id = $this->input->post('id');
    $this->db2->delete('opsi_master_produk_temp', array('id' => $id ));
}
public function simpan_produk(){
    $input = $this->input->post();

    $get_setting=$this->db->get('setting');
    $hasil_setting=$get_setting->row();
    $kode_unit_jabung=@$hasil_setting->kode_unit;

    $get_opsi_bdp=$this->db2->get_where('opsi_master_produk_temp',array('kode_produk' =>@$input['kode_produk']));
    $hasil_opsi_bdp=$get_opsi_bdp->result_array();
    foreach ($hasil_opsi_bdp as $opsi_bdp) {
     unset($opsi_bdp['id']);
     $this->db2->insert('opsi_master_produk',$opsi_bdp);
 }

 $data['kode_produk']     = $input['kode_produk'];
 $data['nama_produk']     = $input['nama_produk'];
 $data['kode_gudang']     = $input['kode_gudang'];
 $data['stok_minimal']    = $input['stok_minimal'];
 $data['kode_satuan_stok']= $input['kode_satuan_stok'];
 $data['kode_unit_jabung']= $kode_unit_jabung;
 $data['status']          = '1';

 $insert = $this->db2->insert('master_produk', $data);

 $harga['kode_barang']     = $input['kode_produk'];
 $harga['harga1']     = $input['harga1'];
 $harga['harga2']     = $input['harga2'];
 $harga['harga3']     = $input['harga3'];
 $harga['harga4']     = $input['harga4'];
 $harga['harga5']     = $input['harga5'];
 $harga['harga6']     = $input['harga6'];
 $harga['harga7']     = $input['harga7'];
 $harga['harga8']     = $input['harga8'];
 $harga['harga9']     = $input['harga9'];
 $harga['harga10']     = $input['harga10'];

 $insert = $this->db2->insert('master_harga_barang', $harga);


 if ($insert) {
    $output['response'] = 'sukses';
}else{
    $output['response'] = 'gagal';
}
$this->db2->delete('opsi_master_produk_temp', array('kode_produk' =>@$input['kode_produk']));

echo json_encode($output);
}
public function update_produk(){
    $input = $this->input->post();

    $get_setting=$this->db->get('setting');
    $hasil_setting=$get_setting->row();
    $kode_unit_jabung=@$hasil_setting->kode_unit;

    $this->db2->delete('opsi_master_produk', array('kode_produk' =>@$input['kode_produk']));

    $get_opsi_bdp=$this->db2->get_where('opsi_master_produk_temp',array('kode_produk' =>@$input['kode_produk']));
    $hasil_opsi_bdp=$get_opsi_bdp->result_array();
    foreach ($hasil_opsi_bdp as $opsi_bdp) {
     unset($opsi_bdp['id']);
     $this->db2->insert('opsi_master_produk',$opsi_bdp);
 }

 $data['nama_produk']     = $input['nama_produk'];
 $data['kode_gudang']     = $input['kode_gudang'];
 $data['stok_minimal']    = $input['stok_minimal'];
 $data['kode_satuan_stok']= $input['kode_satuan_stok'];
 $data['kode_unit_jabung']= $kode_unit_jabung;
 $data['status']          = '1';

 $insert = $this->db2->update('master_produk', $data,array('kode_produk' =>@$input['kode_produk']));


 $harga['harga1']     = $input['harga1'];
 $harga['harga2']     = $input['harga2'];
 $harga['harga3']     = $input['harga3'];
 $harga['harga4']     = $input['harga4'];
 $harga['harga5']     = $input['harga5'];
 $harga['harga6']     = $input['harga6'];
 $harga['harga7']     = $input['harga7'];
 $harga['harga8']     = $input['harga8'];
 $harga['harga9']     = $input['harga9'];
 $harga['harga10']     = $input['harga10'];

 $insert = $this->db2->update('master_harga_barang', $harga,array('kode_barang' =>@$input['kode_produk']));


 if ($insert) {
    $output['response'] = 'sukses';
}else{
    $output['response'] = 'gagal';
}
$this->db2->delete('opsi_master_produk_temp', array('kode_produk' =>@$input['kode_produk']));

echo json_encode($output);
}
public function hapus_barang(){
    $kode_produk = $this->input->post('kode_produk');
    $this->db2->delete('opsi_master_produk', array('kode_produk' => $kode_produk ));
    $this->db2->delete('master_harga_barang', array('kode_barang' => $kode_produk ));
    $this->db2->delete('master_produk', array('kode_produk' => $kode_produk ));

}
}

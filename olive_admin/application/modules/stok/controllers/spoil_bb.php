<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class spoil_bb extends MY_Controller {


  public function __construct()
  {
    parent::__construct();		
    if ($this->session->userdata('astrosession') == FALSE) {
      redirect(base_url('authenticate'));			
    }
    $this->db_master = $this->load->database('kan_master', TRUE);
  }

  public function index()
  {
    $data['konten'] = $this->load->view('spoil_bb/daftar', NULL, TRUE);
    $this->load->view ('admin/main', $data);
  }
  public function daftar()
  {
    $data['konten'] = $this->load->view('spoil_bb/daftar', NULL, TRUE);
    $this->load->view ('admin/main', $data);
  }
  public function tambah()
  {
    $data['konten'] = $this->load->view('spoil_bb/tambah', NULL, TRUE);
    $this->load->view ('admin/main', $data);
  }
   public function detail()
  {
    $data['konten'] = $this->load->view('spoil_bb/detail', NULL, TRUE);
    $this->load->view ('admin/main', $data);
  }
  public function tambah_spoil()
  {
    $data['konten'] = $this->load->view('spoil_bb/tambah_spoil', NULL, TRUE);
    $this->load->view ('admin/main', $data);
  }

   public function simpan_temp()
  {
   $post=$this->input->post();
   $jml_opsi=count(@$post['opsi_spoil']);

   for ($i=0; $i <=$jml_opsi ; $i++) { 
     $kode_bahan=@$post['opsi_spoil'][$i];
     if(!empty($kode_bahan)){
      $temp['kode_spoil']=@$post['kode_spoil'];
      $temp['kode_bahan']=$kode_bahan;
      $temp['jenis_bahan']='BB';
      $temp['kode_unit_jabung']=@$post['kode_unit'];

      $this->db->insert('opsi_transaksi_spoil_temp', $temp);
      }
    }
  }

  public function simpan_transaksi_spoil()
  {
    $this->db_master = $this->load->database('kan_master', TRUE);
    $post=$this->input->post();

   $user = $this->session->userdata('astrosession');
   $kode_petugas=@$user->kode_user;

   $this->db->where('kode_unit_jabung', @$post['kode_unit']);
   $this->db->where('kode_spoil', @$post['kode_spoil']);
   $this->db->where('jenis_bahan', 'BB');
   $get_temp=$this->db->get('opsi_transaksi_spoil_temp');
   $hasil_temp=$get_temp->result_array();
   foreach ($hasil_temp as $temp) {
     $jumlah='jumlah_spoil_'.@$temp['kode_bahan'];
     $real_stok='real_stok_'.@$temp['kode_bahan'];
     $keterangan='keterangan_'.@$temp['kode_bahan'];

     $temp['jumlah']=$post[$jumlah];
     $temp['keterangan']=$post[$keterangan];
     unset($temp['id']);
     $this->db->insert('opsi_transaksi_spoil', $temp);

     $jumlah_spoil=$post[$jumlah];
     $this->db_master->where('kode_unit_jabung', @$post['kode_unit']);
     $this->db_master->where('kode_bahan_baku',@$temp['kode_bahan']);
     $get_bahan_baku=$this->db_master->get('master_bahan_baku');
     $hasil_bahan_baku=$get_bahan_baku->row();

     $stok_bb['real_stok']=@$hasil_bahan_baku->real_stok - $jumlah_spoil;

     $this->db_master->where('kode_unit_jabung', @$post['kode_unit']);
     $this->db_master->where('kode_bahan_baku',@$temp['kode_bahan']);
     $this->db_master->update('master_bahan_baku', $stok_bb);
     

     $this->db->where('kode_unit_jabung', @$post['kode_unit']);
     $get_data_stok=$this->db->get_where('transaksi_stok',array('jenis_transaksi' =>'pembelian','kategori_bahan' =>'BB','sisa_stok >' =>0,'kode_bahan'=>@$temp['kode_bahan'],'status'=>'masuk'));
     $hasil_data_stok=$get_data_stok->result();
     foreach ($hasil_data_stok as $stok) {
       $sisa_stok=@$stok->sisa_stok - $jumlah_spoil;
       if($sisa_stok < 0){

        $tstok['stok_keluar'] = $stok->stok_masuk;
        $tstok['sisa_stok'] = '0';
        $this->db->update('transaksi_stok', $tstok, array('id'=>$stok->id,'kode_unit_jabung'=>@$post['kode_unit']));

        $record_tstok['jenis_transaksi'] = 'spoil';
        $record_tstok['kode_transaksi'] = @$post['kode_spoil'];
        $record_tstok['kategori_bahan'] = 'BB';
        $record_tstok['kode_bahan'] = $stok->kode_bahan;
        $record_tstok['stok_keluar'] = $stok->sisa_stok;
        $record_tstok['hpp'] = $stok->hpp;
        $record_tstok['kode_petugas'] = $kode_petugas;
        $record_tstok['tanggal_transaksi'] = date('Y-m-d');
        $record_tstok['posisi_awal'] = 'gudang';
        $record_tstok['kode_unit_jabung'] = @$post['kode_unit'];
        $record_tstok['status'] = 'keluar';

        if($stok->sisa_stok !='0' or $stok->sisa_stok > 0){
          $this->db->insert('transaksi_stok', $record_tstok);
        }
      }else{
          $tstok['stok_keluar'] = $jumlah;
          $tstok['sisa_stok'] = $sisa_stok;
          $this->db->update('transaksi_stok', $tstok, array('id'=>$stok->id,'kode_unit_jabung'=>@$post['kode_unit']));

          $record_tstok['jenis_transaksi'] = 'spoil';
          $record_tstok['kode_transaksi'] = @$post['kode_spoil'];
          $record_tstok['kategori_bahan'] = 'BB';
          $record_tstok['kode_bahan'] = $stok->kode_bahan;
          $record_tstok['stok_keluar'] = $sisa_stok;
          $record_tstok['hpp'] = $stok->hpp;
          $record_tstok['kode_petugas'] = $kode_petugas;
          $record_tstok['tanggal_transaksi'] = date('Y-m-d');
          $record_tstok['posisi_awal'] = 'gudang';
          $record_tstok['kode_unit_jabung'] = @$post['kode_unit'];
          $record_tstok['status'] = 'keluar';

          if($sisa_stok > 0){
            $this->db->insert('transaksi_stok', $record_tstok);
          }
          break;
      }

    }
  }

  $transaksi['kode_spoil']=@$post['kode_spoil'];
  $transaksi['tanggal_spoil']=@$post['tanggal_spoil'];
  $transaksi['kode_unit_jabung']=@$post['kode_unit'];
  $transaksi['kode_petugas']=@$kode_petugas;
  $transaksi['jenis_bahan']='BB';

  $this->db->insert('transaksi_spoil', $transaksi);

  $this->db->delete('opsi_transaksi_spoil_temp',array('kode_spoil' =>@$post['kode_spoil']));
}


}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class po extends MY_Controller {


  public function __construct()
  {
    parent::__construct();		
    if ($this->session->userdata('astrosession') == FALSE) {
      redirect(base_url('authenticate'));			
    }
  }

  public function index()
  {
    $data['konten'] = $this->load->view('po/daftar', NULL, TRUE);
    $this->load->view ('admin/main', $data);
  }
  public function daftar()
  {
    $data['konten'] = $this->load->view('po/daftar', NULL, TRUE);
    $this->load->view ('admin/main', $data);
  }
  
  public function daftar_validasi()
  {
    $data['konten'] = $this->load->view('po/daftar_validasi', NULL, TRUE);
    $this->load->view ('admin/main', $data);
  }
  public function detail()
  {
    $this->db_master = $this->load->database('kan_master', TRUE);
    $data['konten'] = $this->load->view('po/detail', NULL, TRUE);
    $this->load->view ('admin/main', $data);
  }
  public function tambah()
  {
    $this->db->truncate('opsi_transaksi_po_temp');
    $this->db_master = $this->load->database('kan_master', TRUE);
    $data['konten'] = $this->load->view('po/tambah', NULL, TRUE);
    $this->load->view ('admin/main', $data);
  }
  public function validasi()
  {
    $this->db_master = $this->load->database('kan_master', TRUE);
    $data['konten'] = $this->load->view('po/validasi', NULL, TRUE);
    $this->load->view ('admin/main', $data);
  }
  public function detail_validasi()
  {
    $this->db_master = $this->load->database('kan_master', TRUE);
    $data['konten'] = $this->load->view('po/detail_validasi', NULL, TRUE);
    $this->load->view ('admin/main', $data);
  }
  public function data_opsi_po()
  {
    $this->load->view('po/data_opsi_po');
  }
  public function cek_kode_po()
  {
    $kode_transaksi=$this->input->post('kode_transaksi');
    $cek_kode=$this->db->get_where('transaksi_po',array('kode_po' =>$kode_transaksi));
    $hasil_kode=$cek_kode->row();
    if(!empty($hasil_kode)){
      $hasil['hasil']='gagal';
    }else{
     $hasil['hasil']='sukses';
   }
   echo json_encode($hasil);
 }
 public function get_bahan_baku()
 {
  $kode_supplier=$this->input->post('kode_supplier');

  $this->db->where('kan_suol.request_po.bulan',date('m'));
  $this->db->where('kan_suol.request_po.tahun',date('Y'));
  $this->db->where('kan_suol.request_po.kode_supplier', $kode_supplier);
  $this->db->from('kan_suol.request_po');
  $this->db->join('kan_master.master_bahan_baku', 'kan_suol.request_po.kode_bahan_baku = kan_master.master_bahan_baku.kode_bahan_baku ');
  $get_bahan_baku = $this->db->get();
  $hasil_bahan_baku=$get_bahan_baku->result();
  echo "<option value=''>- Pilih Bahan -</option>";
  foreach ($hasil_bahan_baku as $bahan_baku) {
    ?>
    <option value="<?php echo $bahan_baku->kode_bahan_baku;?>"><?php echo $bahan_baku->nama_bahan_baku;?></option>
    <?php
  }

}
public function get_satuan()
{
  $kode_bahan_baku=$this->input->post('kode_bahan_baku');

  $this->db->where('kan_master.master_bahan_baku.kode_bahan_baku', $kode_bahan_baku);
  $this->db->from('kan_master.master_bahan_baku');
  $this->db->join('kan_master.master_satuan', 'kan_master.master_bahan_baku.kode_satuan_pembelian = kan_master.master_satuan.kode ');
  $this->db->join('kan_suol.request_po', 'kan_master.master_bahan_baku.kode_bahan_baku = kan_suol.request_po.kode_bahan_baku');
  
  $get_bahan_baku = $this->db->get();
  $hasil_bahan_baku=$get_bahan_baku->row();
  echo json_encode($hasil_bahan_baku);

}

public function filter_by_bulan()
{
  $this->load->view('po/daftar_filter');
}

public function get_opsi_po()
{
  $id=$this->input->post('id');

  $this->db->where('kan_suol.opsi_transaksi_po_temp.id', $id);
  $this->db->where('kan_suol.request_po.bulan',date('m'));
  $this->db->where('kan_suol.request_po.tahun',date('Y'));
  $this->db->from('kan_suol.opsi_transaksi_po_temp');
  $this->db->join('kan_master.master_bahan_baku', 'kan_master.master_bahan_baku.kode_bahan_baku = kan_suol.opsi_transaksi_po_temp.kode_bahan_baku');
  $this->db->join('kan_master.master_satuan', 'kan_master.master_bahan_baku.kode_satuan_pembelian = kan_master.master_satuan.kode ');
  $this->db->join('kan_suol.request_po', 'kan_suol.request_po.kode_bahan_baku = kan_master.master_bahan_baku.kode_bahan_baku ');
  $get_bahan_baku = $this->db->get();
  $hasil_bahan_baku=$get_bahan_baku->row();
  echo json_encode($hasil_bahan_baku);
  
}
public function get_opsi_po_validasi()
{
  $id=$this->input->post('id');

  $this->db->where('kan_suol.opsi_transaksi_po.id', $id);
  $this->db->where('kan_suol.request_po.bulan',date('m'));
  $this->db->where('kan_suol.request_po.tahun',date('Y'));
  $this->db->from('kan_suol.opsi_transaksi_po');
  $this->db->join('kan_master.master_bahan_baku', 'kan_master.master_bahan_baku.kode_bahan_baku = kan_suol.opsi_transaksi_po.kode_bahan_baku');
  $this->db->join('kan_master.master_satuan', 'kan_master.master_bahan_baku.kode_satuan_pembelian = kan_master.master_satuan.kode ');
  $this->db->join('kan_suol.request_po', 'kan_suol.request_po.kode_bahan_baku = kan_master.master_bahan_baku.kode_bahan_baku ');
  $get_bahan_baku = $this->db->get();
  $hasil_bahan_baku=$get_bahan_baku->row();
  echo json_encode($hasil_bahan_baku);
  
}
public function add_item()
{
  $post=$this->input->post();

  $cek_temp=$this->db->get_where('opsi_transaksi_po_temp',array('kode_po' =>$post['kode_transaksi'],'kode_bahan_baku' =>$post['kode_bahan_baku']));
  $hasil_cek=$cek_temp->row();
  if(!empty($hasil_cek)){
    $hasil['hasil']='gagal';
  }else{
   $temp['kode_po']=$post['kode_transaksi'];
   $temp['kode_bahan_baku']=$post['kode_bahan_baku'];
   $temp['kode_supplier']=$post['kode_supplier'];
   $temp['qty']=$post['qty'];
   $temp['kode_satuan']=$post['kode_satuan_pembelian'];
   $temp['harga_satuan']=$post['harga_satuan'];
   $this->db->insert('opsi_transaksi_po_temp',$temp);
   $hasil['hasil']='sukses';
 }
 echo json_encode($hasil);
}

public function update_item()
{
  $post=$this->input->post();

  $cek_temp=$this->db->get_where('opsi_transaksi_po_temp',array('kode_po' =>$post['kode_transaksi'],'kode_bahan_baku' =>$post['kode_bahan_baku'],'id !=' =>$post['id']));
  $hasil_cek=$cek_temp->row();
  if(!empty($hasil_cek)){
    $hasil['hasil']='gagal';
  }else{
   $temp['kode_po']=$post['kode_transaksi'];
   $temp['kode_bahan_baku']=$post['kode_bahan_baku'];
   $temp['kode_supplier']=$post['kode_supplier'];
   $temp['qty']=$post['qty'];
   $temp['kode_satuan']=$post['kode_satuan_pembelian'];
   $temp['harga_satuan']=$post['harga_satuan'];
   $this->db->update('opsi_transaksi_po_temp',$temp,array('id' =>$post['id']));
   $hasil['hasil']='sukses';
 }
 echo json_encode($hasil);
}
public function update_item_validasi()
{
  $post=$this->input->post();

  $temp['kode_po']=$post['kode_transaksi'];
  $temp['kode_bahan_baku']=$post['kode_bahan_baku'];
  $temp['kode_supplier']=$post['kode_supplier'];
  $temp['qty']=$post['qty'];
  $temp['kode_satuan']=$post['kode_satuan_pembelian'];
  $temp['harga_satuan']=$post['harga_satuan'];
  $this->db->update('opsi_transaksi_po',$temp,array('id' =>$post['id']));
  $hasil['hasil']='sukses';
  echo json_encode($hasil);
}
public function hapus_opsi_po()
{
  $id=$this->input->post('id');
  $this->db->delete('opsi_transaksi_po_temp',array('id' =>$id));
}
public function delete_all_temp()
{
  $kode_transaksi=$this->input->post('kode_transaksi');
  $this->db->delete('opsi_transaksi_po_temp',array('kode_po' =>$kode_transaksi));
}
public function hapus_opsi_po_validasi()
{
  $id=$this->input->post('id');
  $this->db->delete('opsi_transaksi_po',array('id' =>$id));
}
public function simpan_po()
{
  $post=$this->input->post();

  $get_setting=$this->db->get('setting');
  $hasil_setting=$get_setting->row();
  $kode_unit_jabung=@$hasil_setting->kode_unit;

  $get_opsi=$this->db->get_where('opsi_transaksi_po_temp',array('kode_po' =>$post['kode_po']));
  $hasil_opsi=$get_opsi->result_array();
  foreach ($hasil_opsi as $opsi) {
    unset($opsi['id']);
    $this->db->insert('opsi_transaksi_po',$opsi);

  }

  $trans['kode_po']=$post['kode_po'];
  $trans['tanggal_input']=$post['tanggal_transaksi'];
  $trans['tanggal_barang_datang']=$post['tanggal_barang_datang'];
  $trans['kode_supplier']=$post['kode_supplier'];
  $trans['kode_petugas']=$post['kode_petugas'];
  $trans['kode_unit_jabung']=$kode_unit_jabung;
  $trans['status']='menunggu';
  $this->db->insert('transaksi_po',$trans);

  $this->db->delete('opsi_transaksi_po_temp',array('kode_po' =>$post['kode_po']));
}
public function terima_po()
{
 $kode_po=$this->input->post('kode_po');

 $status['status']='valid';
 $this->db->update('transaksi_po',$status,array('kode_po' =>$kode_po));

}
public function tolak_po()
{
 $kode_po=$this->input->post('kode_po');

 $status['status']='ditolak';
 $this->db->update('transaksi_po',$status,array('kode_po' =>$kode_po));

}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stok_out extends MY_Controller {


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
    $data['konten'] = $this->load->view('stok/stok_out/daftar', NULL, TRUE);
    $this->load->view ('admin/main', $data);
  }

  public function daftar()
  {
    $data['konten'] = $this->load->view('stok/stok_out/daftar', NULL, TRUE);
    $this->load->view ('admin/main', $data);
  }

  public function tambah()
  {
    $data['konten'] = $this->load->view('stok/stok_out/tambah', NULL, TRUE);
    $this->load->view ('admin/main', $data);
  }

  public function detail()
  {
    $data['konten'] = $this->load->view('stok/stok_out/detail', NULL, TRUE);
    $this->load->view ('admin/main', $data);
  }

  public function data_opsi()
  {
    $this->load->view('stok/stok_out/data_opsi');
  }

  public function get_satuan()
  {
    $kode_bahan_baku=$this->input->post('kode_bahan_baku');

    $this->db->where('kan_master.master_bahan_baku.kode_bahan_baku', $kode_bahan_baku);
    $this->db->from('kan_master.master_bahan_baku');
    $this->db->join('kan_master.master_satuan', 'kan_master.master_bahan_baku.kode_satuan_stok = kan_master.master_satuan.kode ');
    
    $get_bahan_baku = $this->db->get();
    $hasil_bahan_baku=$get_bahan_baku->row();
    echo json_encode($hasil_bahan_baku);
  }

  public function add_item()
  {
    $post=$this->input->post();

    $this->db->from('setting');
    $get_kode_jabung = $this->db->get();
    $hasil_kode_jabung=$get_kode_jabung->row();

    $cek_temp=$this->db->get_where('opsi_transaksi_stok_out_temp',array('kode_stok_out' =>$post['kode_transaksi'],'kode_bahan_baku' =>$post['kode_bahan_baku']));
    $hasil_cek=$cek_temp->row();
    if(!empty($hasil_cek)){
      $hasil['hasil']='gagal';
    }else{
      $temp['kode_stok_out']=$post['kode_transaksi'];
      $temp['kode_bahan_baku']=$post['kode_bahan_baku'];
      $temp['jumlah']=$post['qty'];
      $temp['keterangan']=$post['keterangan'];
      $temp['kode_satuan']=$post['kode_satuan_stok'];
      $temp['kode_unit_jabung']=$hasil_kode_jabung->kode_unit;
      $this->db->insert('opsi_transaksi_stok_out_temp',$temp);
      $hasil['hasil']='sukses';
    }
    echo json_encode($hasil);
  }

  public function get_opsi()
  {
    $id=$this->input->post('id');

    $this->db->where('kan_suol.opsi_transaksi_stok_out_temp.id', $id);
    $this->db->from('kan_suol.opsi_transaksi_stok_out_temp');
    $this->db->join('kan_master.master_bahan_baku', 'kan_master.master_bahan_baku.kode_bahan_baku = kan_suol.opsi_transaksi_stok_out_temp.kode_bahan_baku');
    $this->db->join('kan_master.master_satuan', 'kan_master.master_bahan_baku.kode_satuan_stok = kan_master.master_satuan.kode ');
    $get_bahan_baku = $this->db->get();
    $hasil_bahan_baku=$get_bahan_baku->row();
    echo json_encode($hasil_bahan_baku);
  }

  public function update_item()
  {
    $post=$this->input->post();

    $this->db->from('setting');
    $get_kode_jabung = $this->db->get();
    $hasil_kode_jabung=$get_kode_jabung->row();

    $cek_temp=$this->db->get_where('opsi_transaksi_stok_out_temp',array('kode_stok_out' =>$post['kode_transaksi'],'kode_bahan_baku' =>$post['kode_bahan_baku'],'id !=' =>$post['id']));
    $hasil_cek=$cek_temp->row();
    if(!empty($hasil_cek)){
      $hasil['hasil']='gagal';
    }else{
      $temp['kode_stok_out']=$post['kode_transaksi'];
      $temp['kode_bahan_baku']=$post['kode_bahan_baku'];
      $temp['jumlah']=$post['qty'];
      $temp['kode_satuan']=$post['kode_satuan_stok'];
      $temp['keterangan']=$post['keterangan'];
      $temp['kode_unit_jabung']=$hasil_kode_jabung->kode_unit;
      $this->db->update('opsi_transaksi_stok_out_temp',$temp,array('id' =>$post['id']));
      $hasil['hasil']='sukses';
    }
    echo json_encode($hasil);
  }

  public function hapus_opsi_stokout_all()
  {
    $kode_stok_out=$this->input->post('kode_stok_out');
    $this->db->delete('opsi_transaksi_stok_out_temp', array('kode_stok_out' =>$kode_stok_out));
  }

  public function hapus_opsi()
  {
    $id=$this->input->post('id');
    $this->db->delete('opsi_transaksi_stok_out_temp',array('id' =>$id));
  }

  public function simpan_so()
  {
    $this->db_master = $this->load->database('kan_master', TRUE);
    $post=$this->input->post();

    $user = $this->session->userdata('astrosession');
    $kode_petugas=$user->kode_user;

    $this->db->where('kode_unit_jabung', $post['kode_unit']);
    $this->db->where('kode_stok_out', $post['kode_stok_out']);
    $get_opsi=$this->db->get('opsi_transaksi_stok_out_temp');
    $hasil_opsi=$get_opsi->result_array();
    foreach ($hasil_opsi as $opsi) {
      $opsi_stok['kode_stok_out']=$opsi['kode_stok_out'];
      $opsi_stok['kode_bahan_baku']=$opsi['kode_bahan_baku'];
      $opsi_stok['jumlah']=$opsi['jumlah'];
      $opsi_stok['kode_satuan']=$opsi['kode_satuan'];
      $opsi_stok['keterangan']=$opsi['keterangan'];
      $opsi_stok['kode_unit_jabung']=$post['kode_unit'];
      unset($opsi['id']);
      $this->db->insert('opsi_transaksi_stok_out',$opsi_stok);

      $this->db_master->where('kode_unit_jabung', $post['kode_unit']);
      $this->db_master->where('kode_bahan_baku',$opsi['kode_bahan_baku']);
      $get_bahan_baku=$this->db_master->get('master_bahan_baku');
      $hasil_bahan_baku=$get_bahan_baku->row();

      $stok_bb['real_stok']=$hasil_bahan_baku->real_stok - $opsi['jumlah'];

      $this->db_master->where('kode_unit_jabung', $post['kode_unit']);
      $this->db_master->where('kode_bahan_baku',$opsi['kode_bahan_baku']);
      $this->db_master->update('master_bahan_baku', $stok_bb);

      $this->db->where('kode_unit_jabung', $post['kode_unit']);
      $this->db->where('jenis_transaksi', 'pembelian');
      $this->db->where('kategori_bahan', 'BB');
      $this->db->where('sisa_stok >', 0);
      $this->db->where('kode_bahan', $opsi['kode_bahan_baku']);
      $this->db->where('status', 'masuk');
      $get_data_stok=$this->db->get('transaksi_stok');
      $hasil_data_stok=$get_data_stok->result();

      foreach ($hasil_data_stok as $stok) {
        $sisa_stok=@$stok->sisa_stok - $opsi['jumlah'];
        if($sisa_stok < 0){

          $tstok['stok_keluar'] = $stok->stok_masuk;
          $tstok['sisa_stok'] = '0';
          $this->db->update('transaksi_stok', $tstok, array('id'=>$stok->id,'kode_unit_jabung'=>@$post['kode_unit']));

          $record_tstok['jenis_transaksi'] = 'stok_out';
          $record_tstok['kode_transaksi'] = @$post['kode_stok_out'];
          $record_tstok['kategori_bahan'] = 'BB';
          $record_tstok['kode_bahan'] = $stok->kode_bahan;
          $record_tstok['stok_keluar'] = $opsi['jumlah'];
          $record_tstok['hpp'] = $stok->hpp;
          $record_tstok['kode_petugas'] = $kode_petugas;
          $record_tstok['tanggal_transaksi'] = date('Y-m-d');
          $record_tstok['posisi_awal'] = 'gudang';
          $record_tstok['kode_unit_jabung'] = $post['kode_unit'];
          $record_tstok['status'] = 'keluar';

          if($stok->sisa_stok !='0' or $stok->sisa_stok > 0){
            $this->db->insert('transaksi_stok', $record_tstok);
          }
        }else{
          $tstok['stok_keluar'] = $opsi['jumlah'];
          $tstok['sisa_stok'] = $sisa_stok;
          $this->db->update('transaksi_stok', $tstok, array('id'=>$stok->id,'kode_unit_jabung'=>@$post['kode_unit']));

          $record_tstok['jenis_transaksi'] = 'stok_out';
          $record_tstok['kode_transaksi'] = @$post['kode_stok_out'];
          $record_tstok['kategori_bahan'] = 'BB';
          $record_tstok['kode_bahan'] = $stok->kode_bahan;
          $record_tstok['stok_keluar'] = $opsi['jumlah'];
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

    $trans['kode_stok_out']=$post['kode_stok_out'];
    $trans['tanggal_input']=$post['tanggal_transaksi'];
    $trans['kode_unit_jabung']=@$post['kode_unit'];
    $trans['kode_petugas'] = $kode_petugas;
    $this->db->insert('transaksi_stok_out',$trans);

    $this->db->delete('opsi_transaksi_stok_out_temp',array('kode_stok_out' =>$post['kode_stok_out']));
  }

}

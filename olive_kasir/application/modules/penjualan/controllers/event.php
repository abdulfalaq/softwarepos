<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class event extends MY_Controller {


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
        $data['konten'] = $this->load->view('event/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar()
    {
        $data['konten'] = $this->load->view('event/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function tambah()
    {
        $data['konten'] = $this->load->view('event/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function detail()
    {
        $data['konten'] = $this->load->view('event/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function input()
    {
        $data['konten'] = $this->load->view('event/input', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function tabel_temp()
    {
        $this->load->view('event/tabel_temp');

    }
    public function get_data_produk()
    {
        $post=$this->input->post();
        $this->db->where('kan_master.master_produk.kode_produk', @$post['kode_produk']);
        $this->db->from('kan_master.master_produk');
        $this->db->join('kan_master.master_satuan', 'kan_master.master_produk.kode_satuan_stok= kan_master.master_satuan.kode', 'left');
        $produk=$this->db->get();
        $hasil_produk=$produk->row();


        echo json_encode($hasil_produk);
    }
    public function add_item(){
        $post=$this->input->post();

        $this->db->where('kode_event', @$post['kode_event']);
        $this->db->where('kode_produk', @$post['kode_produk']);
        $cek_produk=$this->db->get('opsi_transaksi_penjualan_event_temp');
        $hasil_cek_produk=$cek_produk->row();

        $this->db->where('kode_bahan', @$post['kode_produk']);
        $this->db->where('jenis_transaksi','produksi');
        $this->db->where('kategori_bahan','produk');
        $this->db->where('tanggal_expired', @$post['tanggal_expired']);
        $cek_ts_stok=$this->db->get('transaksi_stok');
        $hasil_cek_ts_stok=$cek_ts_stok->row();

        if((@$hasil_cek_ts_stok->sisa_stok < @$post['jumlah']) || empty($hasil_cek_ts_stok)){
            $hasil['respon']='gagal';
        }elseif (!empty($hasil_cek_produk)) {
            $hasil['respon']='produk_tersedia';
        }else{
            $temp['kode_event']=@$post['kode_event'];
            $temp['kode_produk']=@$post['kode_produk'];
            $temp['tanggal_expired']=@$post['tanggal_expired'];
            $temp['jumlah']=@$post['jumlah'];
            $temp['kode_satuan']=@$post['kode_satuan'];
            $this->db->insert('opsi_transaksi_penjualan_event_temp', $temp);

            $hasil['respon']='sukses';
        }

        echo json_encode($hasil);
    }
    public function get_data_temp()
    {
        $id=$this->input->post('id');
        $get_temp=$this->db->get_where('opsi_transaksi_penjualan_event_temp', array('id_temp' =>$id));
        $hasil_temp=$get_temp->row();

        echo json_encode($hasil_temp);

    }
    public function update_item(){
        $post=$this->input->post();

        $this->db->where('id_temp !=', @$post['id_opsi']);
        $this->db->where('kode_event', @$post['kode_event']);
        $this->db->where('kode_produk', @$post['kode_produk']);
        $cek_produk=$this->db->get('opsi_transaksi_penjualan_event_temp');
        $hasil_cek_produk=$cek_produk->row();

        $this->db->where('kode_bahan', @$post['kode_produk']);
        $this->db->where('jenis_transaksi','produksi');
        $this->db->where('kategori_bahan','produk');
        $this->db->where('tanggal_expired', @$post['tanggal_expired']);
        $cek_ts_stok=$this->db->get('transaksi_stok');
        $hasil_cek_ts_stok=$cek_ts_stok->row();

        if((@$hasil_cek_ts_stok->sisa_stok < @$post['jumlah']) || empty($hasil_cek_ts_stok)){
            $hasil['respon']='gagal';
        }elseif (!empty($hasil_cek_produk)) {
            $hasil['respon']='produk_tersedia';
        }else{
            $temp['kode_event']=@$post['kode_event'];
            $temp['kode_produk']=@$post['kode_produk'];
            $temp['tanggal_expired']=@$post['tanggal_expired'];
            $temp['jumlah']=@$post['jumlah'];
            $temp['kode_satuan']=@$post['kode_satuan'];

            $this->db->update('opsi_transaksi_penjualan_event_temp', $temp,array('id_temp' => @$post['id_opsi']));

            $hasil['respon']='sukses';
        }

        echo json_encode($hasil);
    }
    public function delete_temp()
    {
        $id=$this->input->post('id');
        $this->db->delete('opsi_transaksi_penjualan_event_temp', array('id_temp' =>$id));

    }
    public function simpan_transaksi()
    {


        $kode_event=$this->input->post('kode_event');
        $post=$this->input->post();

        $get_setting=$this->db->get('setting');
        $hasil_setting=$get_setting->row();
        $kode_unit_jabung=@$hasil_setting->kode_unit;

        $user = $this->session->userdata('astrosession');

        $get_temp=$this->db->get_where('opsi_transaksi_penjualan_event_temp', array('kode_event' =>$kode_event));
        $hasil_temp=$get_temp->row();

        $this->db->where('kan_suol.opsi_transaksi_penjualan_event_temp.kode_event', $kode_event);
        $this->db->where('kan_suol.transaksi_stok.jenis_transaksi','produksi');
        $this->db->where('kan_suol.transaksi_stok.kategori_bahan', 'produk');
        $this->db->from('kan_suol.opsi_transaksi_penjualan_event_temp');
        $this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_penjualan_event_temp.kode_produk = kan_master.master_produk.kode_produk', 'left');
        $this->db->join('kan_suol.transaksi_stok', 'kan_suol.opsi_transaksi_penjualan_event_temp.kode_produk = kan_suol.transaksi_stok.kode_bahan AND kan_suol.opsi_transaksi_penjualan_event_temp.tanggal_expired = kan_suol.transaksi_stok.tanggal_expired', 'left');
        $get_temp=$this->db->get();
        $hasil_temp=$get_temp->result();

        if(!empty($hasil_temp)){
            foreach ($hasil_temp as $temp) {


                $opsi['kode_event']=$temp->kode_event;
                $opsi['kode_produk']=$temp->kode_produk;
                $opsi['tanggal_expired']=$temp->tanggal_expired;
                $opsi['jumlah']=$temp->jumlah;
                $opsi['kode_satuan']=$temp->kode_satuan;
                $this->db->insert('opsi_transaksi_penjualan_event', $opsi);

                $stok_produk['real_stok']=@$temp->real_stok - $temp->jumlah;

                $this->db_master->where('kode_unit_jabung', @$kode_unit_jabung);
                $this->db_master->where('kode_produk',$temp->kode_produk);
                $this->db_master->update('master_produk', $stok_produk);

                $ts_stok['sisa_stok']=@$temp->sisa_stok - $temp->jumlah;
                $ts_stok['stok_keluar']=@$temp->stok_keluar + $temp->jumlah;

                $this->db->where('tanggal_expired', $temp->tanggal_expired);
                $this->db->where('kode_bahan',$temp->kode_produk);
                $this->db->where('jenis_transaksi','produksi');
                $this->db->where('kategori_bahan', 'produk');
                $this->db->update('transaksi_stok', $ts_stok);

                $record_tstok['jenis_transaksi'] = 'penjualan';
                $record_tstok['kode_transaksi'] = $temp->kode_event;
                $record_tstok['kategori_bahan'] = 'Produk';
                $record_tstok['tanggal_expired'] = $temp->tanggal_expired;
                $record_tstok['kode_bahan'] = $temp->kode_produk;
                $record_tstok['stok_keluar'] = $temp->jumlah;
                $record_tstok['hpp'] = $temp->hpp;
                $record_tstok['kode_petugas'] = $user->kode_user;
                $record_tstok['tanggal_transaksi'] = date('Y-m-d H:i:s');
                $record_tstok['posisi_awal'] = 'gudang';
                $record_tstok['kode_unit_jabung'] = $kode_unit_jabung;
                $record_tstok['status'] = 'keluar';
                $this->db->insert('transaksi_stok', $record_tstok);
            }
        }

        if(!empty($hasil_temp)){
            $transaksi['kode_event']=$kode_event;
            $transaksi['nama_event']=@$post['nama_event'];
            $transaksi['tanggal']=@$post['tanggal_event'];
            $transaksi['kode_petugas']=$user->kode_user;
            $transaksi['kode_unit_jabung']=$kode_unit_jabung;
            $transaksi['status']='proses';

            $this->db->insert('transaksi_penjualan_event', $transaksi);

            $this->db->delete('opsi_transaksi_penjualan_event_temp',array('kode_event' =>$kode_event));

            
            $hasil['respon']='sukses';
        }else{
            $hasil['respon']='produk_kosong';
        }
        echo json_encode($hasil);
    }
    public function input_transaksi()
    {
        $this->db_kasir = $this->load->database('kan_kasir', TRUE);

        $kode_event=$this->input->post('kode_event');
        $post=$this->input->post();

        $get_setting=$this->db->get('setting');
        $hasil_setting=$get_setting->row();
        $kode_unit_jabung=@$hasil_setting->kode_unit;

        $user = $this->session->userdata('astrosession');


        $this->db->where('kan_suol.opsi_transaksi_penjualan_event.kode_event', $kode_event);
        $this->db->where('kan_suol.transaksi_stok.kode_transaksi', $kode_event);
        $this->db->where('kan_suol.transaksi_stok.jenis_transaksi','penjualan');
        $this->db->where('kan_suol.transaksi_stok.kategori_bahan', 'Produk');
        $this->db->from('kan_suol.opsi_transaksi_penjualan_event');
        $this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_penjualan_event.kode_produk = kan_master.master_produk.kode_produk', 'left');
        $this->db->join('kan_suol.transaksi_stok', 'kan_suol.opsi_transaksi_penjualan_event.kode_produk = kan_suol.transaksi_stok.kode_bahan AND kan_suol.opsi_transaksi_penjualan_event.tanggal_expired = kan_suol.transaksi_stok.tanggal_expired', 'left');
        $get_temp=$this->db->get();
        $hasil_temp=$get_temp->result();
        $total_nominal=0;
        if(!empty($hasil_temp)){
            foreach ($hasil_temp as $temp) {

                $produk_terjual=$post['produk_terjual_'.$temp->kode_produk];
                $produk_rusak=$post['produk_rusak_'.$temp->kode_produk];
                $sisa=$post['sisa_'.$temp->kode_produk];
                $harga=$post['harga_'.$temp->kode_produk];

                $opsi['jumlah_terjual']=@$produk_terjual;
                $opsi['jumlah_rusak']=@$produk_rusak;
                $opsi['sisa']=@$sisa;
                $opsi['harga_satuan']=@$harga;

                $total_nominal +=@$produk_terjual * @$harga;
                $this->db->update('opsi_transaksi_penjualan_event', $opsi,array('kode_event' =>$kode_event,'kode_produk' =>$temp->kode_produk));

                if(!empty($sisa) and $sisa > 0){
                    $stok_produk['real_stok']=@$temp->real_stok + $sisa;

                    $this->db_master->where('kode_unit_jabung', @$kode_unit_jabung);
                    $this->db_master->where('kode_produk',$temp->kode_produk);
                    $this->db_master->update('master_produk', $stok_produk);

                }

                if(!empty($produk_rusak) and $produk_rusak > 0){

                    $ts_stok['stok_keluar']=@$temp->stok_keluar - $produk_rusak;

                    $this->db->where('kode_transaksi', $kode_event);
                    $this->db->where('tanggal_expired', $temp->tanggal_expired);
                    $this->db->where('kode_bahan',$temp->kode_produk);
                    $this->db->where('jenis_transaksi','penjualan');
                    $this->db->where('kategori_bahan', 'Produk');
                    $this->db->update('transaksi_stok', $ts_stok);

                    $record_tstok['jenis_transaksi'] = 'spoil';
                    $record_tstok['kode_transaksi'] = $temp->kode_event;
                    $record_tstok['kategori_bahan'] = 'Produk';
                    $record_tstok['tanggal_expired'] = $temp->tanggal_expired;
                    $record_tstok['kode_bahan'] = $temp->kode_produk;
                    $record_tstok['stok_keluar'] = $produk_rusak;
                    $record_tstok['hpp'] = $temp->hpp;
                    $record_tstok['kode_petugas'] = $user->kode_user;
                    $record_tstok['tanggal_transaksi'] = date('Y-m-d H:i:s');
                    $record_tstok['posisi_awal'] = 'gudang';
                    $record_tstok['kode_unit_jabung'] = $kode_unit_jabung;
                    $record_tstok['status'] = 'keluar';
                    $this->db->insert('transaksi_stok', $record_tstok);
                }

            }
        }


        $transaksi['total_nominal']=$total_nominal;
        $transaksi['status']='selesai';

        $this->db->update('transaksi_penjualan_event', $transaksi,array('kode_event' =>$kode_event));

        $get_event=$this->db->get_where('transaksi_penjualan_event',array('kode_event' =>@$kode_event));
        $hasil_event=$get_event->row_array();
        unset($hasil_event['id']);
        $this->db_kasir->insert('transaksi_penjualan_event',$hasil_event);

        $get_opsi_event=$this->db->get_where('opsi_transaksi_penjualan_event',array('kode_event' =>@$kode_event));
        $hasil_opsi_event=$get_opsi_event->result_array();
        foreach ($hasil_opsi_event as $opsi_event) {
            unset($opsi_event['id']);
            $this->db_kasir->insert('opsi_transaksi_penjualan_event',$opsi_event);
        }

        $hasil['respon']='sukses';
        
        echo json_encode($hasil);
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pos extends MY_Controller {


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
        $data['konten'] = $this->load->view('pos/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar()
    {
        $data['konten'] = $this->load->view('pos/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function tambah()
    {
        $data['konten'] = $this->load->view('pos/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function detail()
    {
        $data['konten'] = $this->load->view('pos/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function tabel_temp()
    {
        $this->load->view('pos/tabel_temp');

    }
    public function get_data_produk()
    {
        $post=$this->input->post();
        $this->db->where('kan_master.master_produk.kode_produk', @$post['kode_produk']);
        $this->db->from('kan_master.master_produk');
        $this->db->join('kan_master.master_harga_barang', 'kan_master.master_produk.kode_produk= kan_master.master_harga_barang.kode_barang', 'left');
        $produk=$this->db->get();
        $hasil_produk=$produk->row();

        $hasil['kode_satuan']=@$hasil_produk->kode_satuan_stok;

        $this->db_master->where('kode_member', @$post['kode_member']);
        $get_member=$this->db_master->get('master_member');
        $hasil_member=$get_member->row();

        if(@$hasil_member->kategori_harga=='Harga 1' || empty($post['kode_member'])){
            $hasil['harga']=@$hasil_produk->harga1;
        }elseif (@$hasil_member->kategori_harga=='Harga 2') {
            $hasil['harga']=@$hasil_produk->harga2;
        }elseif (@$hasil_member->kategori_harga=='Harga 3') {
            $hasil['harga']=@$hasil_produk->harga3;
        }elseif (@$hasil_member->kategori_harga=='Harga 4') {
            $hasil['harga']=@$hasil_produk->harga4;
        }elseif (@$hasil_member->kategori_harga=='Harga 5') {
            $hasil['harga']=@$hasil_produk->harga5;
        }elseif (@$hasil_member->kategori_harga=='Harga 6') {
            $hasil['harga']=@$hasil_produk->harga6;
        }elseif (@$hasil_member->kategori_harga=='Harga 7') {
            $hasil['harga']=@$hasil_produk->harga7;
        }elseif (@$hasil_member->kategori_harga=='Harga 8') {
            $hasil['harga']=@$hasil_produk->harga8;
        }elseif (@$hasil_member->kategori_harga=='Harga 9') {
            $hasil['harga']=@$hasil_produk->harga9;
        }elseif (@$hasil_member->kategori_harga=='Harga 10') {
            $hasil['harga']=@$hasil_produk->harga10;
        }

        echo json_encode($hasil);
    }
    public function get_data_member()
    {
        $kode_member=$this->input->post('kode_member');

        $get_member=$this->db_master->get_where('master_member', array('kode_member' =>$kode_member));
        $hasil_member=$get_member->row();
        echo json_encode($hasil_member);

    }
    public function cari_transaksi_pesanan()
    {
        $kode_pesanan=$this->input->post('kode_pesanan');
        $kode_penjualan=$this->input->post('kode_penjualan');

        $get_pesanan=$this->db->get_where('transaksi_penjualan_pesanan', array('kode_pesanan' =>$kode_pesanan));
        $hasil_pesanan=$get_pesanan->row();

        if(!empty($hasil_pesanan)){

            $get_pesanan_opsi=$this->db->get_where('opsi_transaksi_penjualan_pesanan', array('kode_pesanan' =>$kode_pesanan));
            $hasil_pesanan_opsi=$get_pesanan_opsi->result_array();
            foreach ($hasil_pesanan_opsi as $opsi) {
                unset($opsi['id']);
                unset($opsi['kode_pesanan']);

                $opsi['kode_penjualan']=$kode_penjualan;
                $this->db->insert('opsi_transaksi_penjualan_temp', $opsi);
            }

        }

        echo json_encode($hasil_pesanan);

    }
    public function get_total_penjualan()
    {
        $kode_penjualan=$this->input->post('kode_penjualan');
        $nominal_diskon=$this->input->post('nominal_diskon');
        $ongkir=$this->input->post('ongkir');

        $this->db->select_sum('subtotal');
        $get_temp=$this->db->get_where('opsi_transaksi_penjualan_temp', array('kode_penjualan' =>$kode_penjualan));
        $hasil_temp=$get_temp->row_array();

        $grandtotal=(@$hasil_temp['subtotal'] - @$nominal_diskon) + @$ongkir;
        $hasil_temp['grandtotal']=$grandtotal;
        echo json_encode($hasil_temp);

    }
    public function add_item(){
        $post=$this->input->post();

        $this->db_master->where('kode_produk', @$post['kode_produk']);
        $get_produk=$this->db_master->get('master_produk');
        $hasil_produk=$get_produk->row();

        $this->db->where('kode_penjualan', @$post['kode_penjualan']);
        $this->db->where('kode_produk', @$post['kode_produk']);
        $cek_produk=$this->db->get('opsi_transaksi_penjualan_temp');
        $hasil_cek_produk=$cek_produk->row();

        $this->db->where('kode_bahan', @$post['kode_produk']);
        $this->db->where('jenis_transaksi','produksi');
        $this->db->where('kategori_bahan','produk');
        $this->db->where('tanggal_expired', @$post['tanggal_expired']);
        $cek_ts_stok=$this->db->get('transaksi_stok');
        $hasil_cek_ts_stok=$cek_ts_stok->row();

        if((@$hasil_cek_ts_stok->sisa_stok < @$post['qty']) || empty($hasil_cek_ts_stok)){
            $hasil['respon']='gagal';
        }elseif (!empty($hasil_cek_produk)) {
            $hasil['respon']='produk_tersedia';
        }else{
            $temp['kode_penjualan']=@$post['kode_penjualan'];
            $temp['kode_produk']=@$post['kode_produk'];
            $temp['tanggal_expired']=@$post['tanggal_expired'];
            $temp['jumlah']=@$post['qty'];
            $temp['kode_satuan']=@$post['kode_satuan'];
            $temp['harga_satuan']=@$post['harga'];
            $temp['jenis_diskon']=@$post['diskon_peritem'];
            $temp['diskon_persen']=@$post['diskon_persen_item'];
            $temp['diskon_rupiah']=@$post['diskon_rupiah_item'];

            if(@$post['diskon_peritem']=='persen'){
                $jml_harga=(@$post['qty'] * @$post['harga']);
                $nominal_diskon=($jml_harga * @$post['diskon_persen_item']) / 100;
                $subtotal=$jml_harga-@$nominal_diskon;
            }else{
                $subtotal=(@$post['qty'] * @$post['harga']) - @$post['diskon_rupiah_item'];
            }
            $temp['subtotal']=$subtotal;

            $this->db->insert('opsi_transaksi_penjualan_temp', $temp);

            $hasil['respon']='sukses';
        }

        echo json_encode($hasil);
    }
    public function get_data_temp()
    {
        $id=$this->input->post('id');
        $get_temp=$this->db->get_where('opsi_transaksi_penjualan_temp', array('id_temp' =>$id));
        $hasil_temp=$get_temp->row();

        echo json_encode($hasil_temp);

    }
    public function update_item(){
        $post=$this->input->post();

        $this->db_master->where('kode_produk', @$post['kode_produk']);
        $get_produk=$this->db_master->get('master_produk');
        $hasil_produk=$get_produk->row();

        $this->db->where('id_temp !=', @$post['id_opsi']);
        $this->db->where('kode_produk', @$post['kode_produk']);
        $cek_produk=$this->db->get('opsi_transaksi_penjualan_temp');
        $hasil_cek_produk=$cek_produk->row();

        $this->db->where('kode_bahan', @$post['kode_produk']);
        $this->db->where('jenis_transaksi','produksi');
        $this->db->where('kategori_bahan','produk');
        $this->db->where('tanggal_expired', @$post['tanggal_expired']);
        $cek_ts_stok=$this->db->get('transaksi_stok');
        $hasil_cek_ts_stok=$cek_ts_stok->row();

        if((@$hasil_cek_ts_stok->sisa_stok < @$post['qty']) || empty($hasil_cek_ts_stok)){
            $hasil['respon']='gagal';
        }elseif (!empty($hasil_cek_produk)) {
            $hasil['respon']='produk_tersedia';
        }else{
            $temp['kode_penjualan']=@$post['kode_penjualan'];
            $temp['kode_produk']=@$post['kode_produk'];
            $temp['tanggal_expired']=@$post['tanggal_expired'];
            $temp['jumlah']=@$post['qty'];
            $temp['kode_satuan']=@$post['kode_satuan'];
            $temp['harga_satuan']=@$post['harga'];
            $temp['jenis_diskon']=@$post['diskon_peritem'];
            $temp['diskon_persen']=@$post['diskon_persen_item'];
            $temp['diskon_rupiah']=@$post['diskon_rupiah_item'];

            if(@$post['diskon_peritem']=='persen'){
                $jml_harga=(@$post['qty'] * @$post['harga']);
                $nominal_diskon=($jml_harga * @$post['diskon_persen_item']) / 100;
                $subtotal=$jml_harga-@$nominal_diskon;
            }else{
                $subtotal=(@$post['qty'] * @$post['harga']) - @$post['diskon_rupiah_item'];
            }
            $temp['subtotal']=$subtotal;

            $this->db->update('opsi_transaksi_penjualan_temp', $temp,array('id_temp' => @$post['id_opsi']));

            $hasil['respon']='sukses';
        }

        echo json_encode($hasil);
    }
    public function delete_temp()
    {
        $id=$this->input->post('id');
        $this->db->delete('opsi_transaksi_penjualan_temp', array('id_temp' =>$id));

    }
    public function delete_all_temp()
    {
        $kode_penjualan=$this->input->post('kode_penjualan');
        $this->db->delete('opsi_transaksi_penjualan_temp', array('kode_penjualan' =>$kode_penjualan));

    }
    public function simpan_transaksi()
    {
        $this->db_kasir = $this->load->database('kan_kasir', TRUE);

        $kode_penjualan=$this->input->post('kode_penjualan');
        $post=$this->input->post();

        $get_setting=$this->db->get('setting');
        $hasil_setting=$get_setting->row();
        $kode_unit_jabung=@$hasil_setting->kode_unit;

        $user = $this->session->userdata('astrosession');

        $this->db->where('kan_suol.transaksi_stok.jenis_transaksi','produksi');
        $this->db->where('kan_suol.transaksi_stok.kategori_bahan', 'produk');
        $this->db->where('kan_suol.opsi_transaksi_penjualan_temp.kode_penjualan', $kode_penjualan);
        $this->db->from('kan_suol.opsi_transaksi_penjualan_temp');
        $this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_penjualan_temp.kode_produk = kan_master.master_produk.kode_produk', 'left');
        $this->db->join('kan_suol.transaksi_stok', 'kan_suol.opsi_transaksi_penjualan_temp.kode_produk = kan_suol.transaksi_stok.kode_bahan AND kan_suol.opsi_transaksi_penjualan_temp.tanggal_expired = kan_suol.transaksi_stok.tanggal_expired', 'left');
        $get_temp=$this->db->get();
        $hasil_temp=$get_temp->result();

        $stok_kurang=0;
        $produk_kurang='';
        foreach ($hasil_temp as $cek_stok) {
            if(@$cek_stok->real_stok < $cek_stok->jumlah){
                $stok_kurang +=1;
                $produk_kurang=$produk_kurang.''.@$cek_stok->nama_produk.' ,';
            }
        }
        if($stok_kurang==0){
            foreach ($hasil_temp as $temp) {
                
                $ts_stok['sisa_stok']=@$temp->sisa_stok - $temp->jumlah;
                $ts_stok['stok_keluar']=@$temp->stok_keluar + $temp->jumlah;

                $this->db->where('tanggal_expired', $temp->tanggal_expired);
                $this->db->where('kode_bahan',$temp->kode_produk);
                $this->db->where('jenis_transaksi','produksi');
                $this->db->where('kategori_bahan', 'Produk');
                $this->db->update('transaksi_stok', $ts_stok);

                $record_tstok['jenis_transaksi'] = 'penjualan';
                $record_tstok['kode_transaksi'] = $temp->kode_penjualan;
                $record_tstok['kategori_bahan'] = 'Produk';
                $record_tstok['tanggal_expired'] = $temp->tanggal_expired;
                $record_tstok['kode_bahan'] = $temp->kode_produk;
                $record_tstok['stok_keluar'] = @$temp->jumlah;
                $record_tstok['hpp'] = @$temp->hpp;
                $record_tstok['kode_petugas'] = @$user->kode_user;
                $record_tstok['tanggal_transaksi'] = date('Y-m-d H:i:s');
                $record_tstok['posisi_awal'] = 'gudang';
                $record_tstok['kode_unit_jabung'] = @$kode_unit_jabung;
                $record_tstok['status'] = 'keluar';
                $this->db->insert('transaksi_stok', $record_tstok);

                $opsi['kode_penjualan']=$temp->kode_penjualan;
                $opsi['kode_produk']=$temp->kode_produk;
                $opsi['tanggal_expired']=$temp->tanggal_expired;
                $opsi['jumlah']=$temp->jumlah;
                $opsi['hpp']=@$stok->hpp;
                $opsi['kode_satuan']=$temp->kode_satuan;
                $opsi['harga_satuan']=$temp->harga_satuan;
                $opsi['jenis_diskon']=$temp->jenis_diskon;
                $opsi['diskon_persen']=$temp->diskon_persen;
                $opsi['diskon_rupiah']=$temp->diskon_rupiah;
                $opsi['subtotal']=$temp->subtotal;
                $this->db->insert('opsi_transaksi_penjualan', $opsi);

                $stok_produk['real_stok']=@$temp->real_stok - $temp->jumlah;

                $this->db_master->where('kode_unit_jabung', @$kode_unit_jabung);
                $this->db_master->where('kode_produk',$temp->kode_produk);
                $this->db_master->update('master_produk', $stok_produk);

            }
        }

        if($stok_kurang==0){
            $transaksi['kode_penjualan']=$kode_penjualan;
            $transaksi['kode_kasir']=@$post['kode_kasir'];
            $transaksi['kode_transaksi']=@$post['kode_pesanan'];
            $transaksi['tanggal_penjualan']=date('Y-m-d');
            $transaksi['jam_penjualan']=date('H:i:s');
            $transaksi['kode_member']=@$post['kode_member'];
            $transaksi['total_nominal']=$post['total_pesanan'];
            $transaksi['grand_total']=$post['grandtotal'];
            $transaksi['jenis_diskon']=@$post['jenis_all_diskon'];
            $transaksi['diskon_persen']=@$post['all_diskon_persen'];
            $transaksi['diskon_rupiah']=@$post['all_diskon_rupiah'];
            $transaksi['grand_total']=$post['grandtotal'];
            $transaksi['kode_petugas']=@$user->kode_user;
            $transaksi['proses_pembayaran']=$post['jenis_transaksi'];
            $transaksi['kode_unit_jabung']=$kode_unit_jabung;
            $transaksi['kategori_penjualan']=$post['kategori_penjualan'];
            $transaksi['ongkos_kirim']=$post['ongkir'];
            $transaksi['tanggal_jatuh_tempo']=@$post['tanggal_jatuh_tempo'];
            $transaksi['status']='proses';

            $this->db->insert('transaksi_penjualan', $transaksi);

            $this->db->delete('opsi_transaksi_penjualan_temp',array('kode_penjualan' =>$kode_penjualan));

            $get_penjualan=$this->db->get_where('transaksi_penjualan',array('kode_penjualan' =>@$kode_penjualan));
            $hasil_penjualan=$get_penjualan->row_array();
            unset($hasil_penjualan['id']);
            $this->db_kasir->insert('transaksi_penjualan',$hasil_penjualan);

            $get_opsi_penjualan=$this->db->get_where('opsi_transaksi_penjualan',array('kode_penjualan' =>@$kode_penjualan));
            $hasil_opsi_penjualan=$get_opsi_penjualan->result_array();
            foreach ($hasil_opsi_penjualan as $opsi_penjualan) {
                unset($opsi_penjualan['id']);
                $this->db_kasir->insert('opsi_transaksi_penjualan',$opsi_penjualan);
            }

            if(!empty($post['kode_pesanan'])){
                $transaksi_pesanan['proses_kasir']='selesai';
                $this->db->update('transaksi_penjualan_pesanan', $transaksi_pesanan,array('kode_pesanan' =>@$post['kode_pesanan']));
            }
            $hasil['respon']='sukses';
        }else{
            $hasil['respon']='stok_kurang';
            $hasil['produk_kurang']=$produk_kurang;
        }
        echo json_encode($hasil);
    }
}

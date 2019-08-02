<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pesanan_penjualan extends MY_Controller {


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
        $data['konten'] = $this->load->view('pesanan_penjualan/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function daftar()
    {
        $data['konten'] = $this->load->view('pesanan_penjualan/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function detail()
    {
        $data['konten'] = $this->load->view('pesanan_penjualan/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function tambah()
    {
        $data['konten'] = $this->load->view('pesanan_penjualan/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function get_data_member()
    {

        $data = $this->input->post();
        $this->db_master->where('kode_member', $data['kode_member']);
        $get_member = $this->db_master->get('master_member')->row();
        echo json_encode($get_member);
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
    public function tabel_temp()
    {
        $this->load->view('pesanan_penjualan/tabel_temp');

    }
    public function get_total_penjualan()
    {
        $kode_pesanan=$this->input->post('kode_pesanan');
     

        $this->db->select_sum('subtotal');
        $get_temp=$this->db->get_where('opsi_transaksi_penjualan_pesanan_temp', array('kode_pesanan' =>$kode_pesanan));
        $hasil_temp=$get_temp->row_array();

        echo json_encode($hasil_temp);

    }
    public function add_item(){
        $post=$this->input->post();

        $this->db_master->where('kode_produk', @$post['kode_produk']);
        $get_produk=$this->db_master->get('master_produk');
        $hasil_produk=$get_produk->row();

        $this->db->where('kode_pesanan', @$post['kode_pesanan']);
        $this->db->where('kode_produk', @$post['kode_produk']);
        $cek_produk=$this->db->get('opsi_transaksi_penjualan_pesanan_temp');
        $hasil_cek_produk=$cek_produk->row();

        if (!empty($hasil_cek_produk)) {
            $hasil['respon']='produk_tersedia';
        }else{
            $temp['kode_pesanan']=@$post['kode_pesanan'];
            $temp['kode_produk']=@$post['kode_produk'];
            $temp['jumlah']=@$post['qty'];
            $temp['kode_satuan']=@$post['kode_satuan'];
            $temp['harga_satuan']=@$post['harga'];
            $temp['jenis_diskon']=@$post['jenis_diskon'];
            $temp['diskon_persen']=@$post['diskon_persen'];
            $temp['diskon_rupiah']=@$post['diskon_rupiah'];
            $temp['tanggal_expired']=@$post['tanggal_expired'];

            if(@$post['jenis_diskon']=='persen'){
                $jml_harga=(@$post['qty'] * @$post['harga']);
                $nominal_diskon=($jml_harga * @$post['diskon_persen']) / 100;
                $subtotal=$jml_harga-@$nominal_diskon;
            }else{
                $subtotal=(@$post['qty'] * @$post['harga']) - @$post['diskon_rupiah'];
            }
            $temp['subtotal']=$subtotal;

            $this->db->insert('opsi_transaksi_penjualan_pesanan_temp', $temp);

            $hasil['respon']='sukses';
        }

        echo json_encode($hasil);
    }

    public function get_data_temp()
    {
        $id=$this->input->post('id');
        $get_temp=$this->db->get_where('opsi_transaksi_penjualan_pesanan_temp', array('id_temp' =>$id));
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
        $cek_produk=$this->db->get('opsi_transaksi_penjualan_pesanan_temp');
        $hasil_cek_produk=$cek_produk->row();

        if (!empty($hasil_cek_produk)) {
            $hasil['respon']='produk_tersedia';
        }else{
            $temp['kode_pesanan']=@$post['kode_pesanan'];
            $temp['kode_produk']=@$post['kode_produk'];
            $temp['jumlah']=@$post['qty'];
            $temp['kode_satuan']=@$post['kode_satuan'];
            $temp['harga_satuan']=@$post['harga'];
            $temp['jenis_diskon']=@$post['jenis_diskon'];
            $temp['diskon_persen']=@$post['diskon_persen'];
            $temp['diskon_rupiah']=@$post['diskon_rupiah'];
            $temp['tanggal_expired']=@$post['tanggal_expired'];

            if(@$post['jenis_diskon']=='persen'){
                $jml_harga=(@$post['qty'] * @$post['harga']);
                $nominal_diskon=($jml_harga * @$post['diskon_persen']) / 100;
                $subtotal=$jml_harga-@$nominal_diskon;
            }else{
                $subtotal=(@$post['qty'] * @$post['harga']) - @$post['diskon_rupiah'];
            }
            $temp['subtotal']=$subtotal;

            $this->db->update('opsi_transaksi_penjualan_pesanan_temp', $temp,array('id_temp' => @$post['id_opsi']));

            $hasil['respon']='sukses';
        }

        echo json_encode($hasil);
    }
    public function delete_temp()
    {
        $id=$this->input->post('id');
        $this->db->delete('opsi_transaksi_penjualan_pesanan_temp', array('id_temp' =>$id));

    }
    public function delete_all_temp()
    {
        $kode_pesanan=$this->input->post('kode_pesanan');
        $this->db->delete('opsi_transaksi_penjualan_pesanan_temp', array('kode_pesanan' =>$kode_pesanan));

    }

    public function penjadwalan_pengiriman(){
        $data = $this->input->post();

        $update['tanggal_pengiriman'] = $data['tanggal_pengiriman'];
        $update['status'] = 'sudah_dijadwalkan';
        $update['dikirim_oleh'] = $data['pengirim'];
        $update['proses_kasir'] = 'proses'; 

        $this->db->where('kode_pesanan', $data['kode_pesanan']);
        $update = $this->db->update('transaksi_penjualan_pesanan',$update);
        if($update){
            $output['status'] = 'berhasil';
        }else{
            $output['status'] = 'gagal';
        }

        echo json_encode($output);

    }

    public function simpan_transaksi()
    {
        $kode_pesanan=$this->input->post('kode_pesanan');
        $post=$this->input->post();

        $get_setting=$this->db->get('setting');
        $hasil_setting=$get_setting->row();
        $kode_unit_jabung=@$hasil_setting->kode_unit;

        $user = $this->session->userdata('astrosession');

        $this->db->where('kode_pesanan', $kode_pesanan);
        $this->db->from('kan_suol.opsi_transaksi_penjualan_pesanan_temp');
        $this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_penjualan_pesanan_temp.kode_produk = kan_master.master_produk.kode_produk', 'left');
        $get_temp=$this->db->get();
        $hasil_temp=$get_temp->result();
        foreach ($hasil_temp as $temp) {

            $opsi['kode_pesanan']=$temp->kode_pesanan;
            $opsi['kode_produk']=$temp->kode_produk;
            $opsi['tanggal_expired']=$temp->tanggal_expired;
            $opsi['jumlah']=$temp->jumlah;
            $opsi['kode_satuan']=$temp->kode_satuan;
            $opsi['harga_satuan']=$temp->harga_satuan;
            $opsi['jenis_diskon']=$temp->jenis_diskon;
            $opsi['diskon_persen']=$temp->diskon_persen;
            $opsi['diskon_rupiah']=$temp->diskon_rupiah;
            $opsi['subtotal']=$temp->subtotal;
            $this->db->insert('opsi_transaksi_penjualan_pesanan', $opsi);

        }

        $transaksi['kode_pesanan']=$kode_pesanan;
        $transaksi['tanggal']=date('Y-m-d');
        $transaksi['kode_member']=@$post['kode_member'];
        $transaksi['total_nominal']=$post['total_pesanan'];
        $transaksi['kode_petugas']=$user->kode_user;
        $transaksi['kode_unit_jabung']=$kode_unit_jabung;
        $transaksi['status']='belum_dijadwalkan';

        $this->db->insert('transaksi_penjualan_pesanan', $transaksi);

        $this->db->delete('opsi_transaksi_penjualan_pesanan_temp',array('kode_pesanan' =>$kode_pesanan));

    }
}

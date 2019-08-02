<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pembelian_bb extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
    }

    public function index()
    {
        $data['konten'] = $this->load->view('pembelian_bb/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar()
    {
        $data['konten'] = $this->load->view('pembelian_bb/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function tambah()
    {
        $data['konten'] = $this->load->view('pembelian_bb/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function detail()
    {
        $this->db_master = $this->load->database('kan_master', TRUE);
        $data['konten'] = $this->load->view('pembelian_bb/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function get_transaksi_po()
    {
        $this->db_master = $this->load->database('kan_master', TRUE);
        $data = $this->input->post();

        $cek_temp = $this->db->get_where('opsi_transaksi_pembelian_temp', array('kode_pembelian' => $data['kode_po'] ))->result();
        foreach ($cek_temp as $value) {
         $this->db->delete('opsi_transaksi_pembelian_temp', array('id_temp' => $value->id_temp ));
     }


     $get_id_petugas = $this->session->userdata('astrosession');
     $this->db->join('kan_master.master_supplier', 'kan_master.master_supplier.kode_supplier = kan_suol.transaksi_po.kode_supplier');
     $get_data = $this->db->get_where('transaksi_po', array('kode_po' => $data['kode_po'] ))->row_array();

     $get_data['kode_petugas'] = $get_id_petugas->nama_user;
     $get_data['nama_petugas'] = $get_id_petugas->kode_user;
     $get_data['kode_po_encript'] = @paramEncrypt($data['kode_po']);

     $get_opsi_tr = $this->db->get_where('opsi_transaksi_po', array('kode_po' => $data['kode_po']))->result();
     foreach ($get_opsi_tr as $value) {
        $input_temp['kode_pembelian']   = $value->kode_po;
        $input_temp['kode_bahan_baku']  = $value->kode_bahan_baku;
        $input_temp['kode_supplier']    = $value->kode_supplier;
        $input_temp['qty_po']           = $value->qty;
        $input_temp['kode_satuan']      = $value->kode_satuan;
        $input_temp['harga_satuan']     = $value->harga_satuan;
        $this->db->insert('opsi_transaksi_pembelian_temp', $input_temp);
    }

    echo json_encode($get_data);
}

public function get_table_produk()
{
    $this->db_master = $this->load->database('kan_master', TRUE);
    $this->load->view('pembelian_bb/table_produk');
}

public function get_edit_data()
{
    $this->db_master = $this->load->database('kan_master', TRUE);
    $data = $this->input->post();
    $this->db->select('*');
    $this->db->from('opsi_transaksi_pembelian_temp');
    $this->db->join('kan_master.master_bahan_baku', 'kan_master.master_bahan_baku.kode_bahan_baku = kan_suol.opsi_transaksi_pembelian_temp.kode_bahan_baku');
    $this->db->join('kan_master.master_satuan', 'kan_master.master_satuan.kode = kan_suol.opsi_transaksi_pembelian_temp.kode_satuan');
    $this->db->where('kan_suol.opsi_transaksi_pembelian_temp.id_temp',$data['id']);
    $get_data = $this->db->get()->row_array();        
    echo json_encode($get_data);
} 

public function simpan_edit_temp()
{
    $data = $this->input->post();

    $input['qty']           = $data['qty'];
    $input['harga_satuan']  = $data['harga_satuan'];
    $this->db->update('opsi_transaksi_pembelian_temp',$input,  array('id_temp' => $data['id_temp'] ));

}

public function cek_nota()
{
    $data = $this->input->post();

    $get_nota = $this->db->get_where('transaksi_pembelian', array('nomor_nota' => $data['nota'] ))->row();
    if (count($get_nota) > 0) {
        $response['cek_nota'] = 'sudah_ada';
    }else{
        $response['cek_nota'] = 'belum_ada';
    }

    echo json_encode($response);
}
public function simpan_pembelian2()
{
 $data = $this->input->post();
 echo $kode_transaksi;
 echo count($data['jatuh_tempo']);    

}


public function simpan_pembelian()
{
    $this->db_kasir = $this->load->database('kan_kasir', TRUE);
    $this->db_master = $this->load->database('kan_master', TRUE);

    $data = $this->input->post();
    $kode_pembelian = (string)$data['kode_transaksi'];

    if($data['jenis_pembayaran']=='kredit' && $data['jenis_kredit']=='dp'){
         $jumlah_angsuran =  count($data['jatuh_tempo']);   
         $total_angsuran  = 0; 
        for ($i=0; $i < $jumlah_angsuran ; $i++) { 
            $total_angsuran = $total_angsuran + $data['angsuran'][$i];
        }

        $yang_harus_diagsur = $data['grand_total'] - $data['bayar_dp'];

        if ( $total_angsuran > $yang_harus_diagsur) {
            echo 'angsuran_melebihi';
            exit();
        }

    }

    if($data['jenis_pembayaran']=='kredit' && $data['jenis_kredit']=='non_dp'){
        $jumlah_angsuran =  count($data['jatuh_tempo']);   
        $total_angsuran  = 0; 
        for ($i=0; $i < $jumlah_angsuran ; $i++) { 
            $total_angsuran = $total_angsuran + $data['angsuran'][$i];
        }

        if ( $total_angsuran > $data['grand_total']) {
            echo 'angsuran_melebihi';
            exit();
        }
    }

    $user = $this->session->userdata('astrosession');
    $get_unit = $this->db->get('setting')->row();

    $this->db->where('kode_po', $kode_pembelian);
    $get_po = $this->db->get('transaksi_po')->row();

    $this->db->where('kan_suol.opsi_transaksi_pembelian_temp.kode_pembelian', $kode_pembelian);
    $this->db->where('kan_suol.opsi_transaksi_pembelian_temp.kode_supplier', $data['kode_supplier']);
    $this->db->from('kan_suol.opsi_transaksi_pembelian_temp');
    $this->db->join('kan_master.master_bahan_baku', 'kan_suol.opsi_transaksi_pembelian_temp.kode_bahan_baku = kan_master.master_bahan_baku.kode_bahan_baku', 'left');
    $get_opsi=$this->db->get();
    $hasil_opsi = $get_opsi->result();

    foreach ($hasil_opsi as $opsi) {
        $opsi_pembelian['kode_pembelian']  = @$opsi->kode_pembelian;
        $opsi_pembelian['kode_bahan_baku'] = @$opsi->kode_bahan_baku;
        $opsi_pembelian['kode_supplier']   = @$opsi->kode_supplier;
        $opsi_pembelian['qty_po']          = @$opsi->qty_po;
        $opsi_pembelian['qty']             = @$opsi->qty * @$opsi->konversi;
        $opsi_pembelian['kode_satuan']     = @$opsi->kode_satuan;
        $opsi_pembelian['harga_satuan']    = @$opsi->harga_satuan;

        $this->db->insert('opsi_transaksi_pembelian', $opsi_pembelian);
        $this->db_kasir->insert('opsi_transaksi_pembelian', $opsi_pembelian);

        $update['real_stok']= @$opsi->real_stok + @$opsi->qty;
        $update['hpp']= @$opsi->harga_satuan / @$opsi->konversi;

        $this->db_master->update('master_bahan_baku', $update,array('kode_bahan_baku' => $opsi->kode_bahan_baku,'kode_unit_jabung' => $get_unit->kode_unit));

        $stok['tanggal_transaksi']  = date('Y-m-d H:i:s');
        $stok['jenis_transaksi']    = 'pembelian';
        $stok['kode_transaksi']     = @$opsi->kode_pembelian;
        $stok['kategori_bahan']     = 'BB';
        $stok['kode_bahan']         = @$opsi->kode_bahan_baku;
        $stok['stok_masuk']         = @$opsi->qty;
        $stok['hpp']                = @$opsi->hpp;
        $stok['sisa_stok']          = @$opsi->qty;
        $stok['kode_petugas']       = $user->kode_user;
        $stok['posisi_awal']        = 'supplier';
        $stok['posisi_akhir']       = 'gudang';
        $stok['status']             = 'masuk';
        $stok['kode_unit_jabung']   = $get_unit->kode_unit;
        $this->db->insert('transaksi_stok', $stok);

    }

    $pembelian['kode_pembelian']    = $kode_pembelian;
    $pembelian['kode_po']           = $data['kode_po'];
    $pembelian['tanggal_pembelian'] = date('Y-m-d');
    $pembelian['nomor_nota']        = $data['nota'];
    $pembelian['kode_supplier']     = $data['kode_supplier'];
    $pembelian['nominal_total']     = $data['subtotal'];
    if($data['jenis_diskon'] == 'rupiah'){
        $pembelian['nominal_diskon'] = $data['input_rupiah'];
    } else {
        $diskon = ($data['subtotal'] * $data['input_persen']) / 100;
        $pembelian['persentase_diskon'] = $data['input_persen'];
        $pembelian['nominal_diskon']    = $diskon;
    }

    $pembelian['nominal_grand_total'] = $data['grand_total'];
    if($data['jenis_pembayaran']=='cash'){
        
        $pembelian['status']             = 'proses';
        $pembelian['bayar']              = $data['grand_total'];

    }else if($data['jenis_pembayaran']=='kredit' && $data['jenis_kredit']=='dp'){
        
        $pembelian['status']             = 'proses';
        $pembelian['bayar']              = $data['bayar_dp'];

        $hutang['kode_hutang']          = $kode_pembelian;
        $hutang['kode_supplier']        = $data['kode_supplier'];
        $hutang['nominal_hutang']       = $data['grand_total'];
        $hutang['angsuran']             = 0;
        $hutang['sisa']                 = $data['grand_total'];
        $hutang['tanggal_transaksi']    = date('Y-m-d'); 
        $hutang['kode_petugas']         = $user->kode_user; 
        $hutang['kode_unit_jabung']     = $get_unit->kode_unit; 

        $this->db_kasir->insert('transaksi_hutang', $hutang);

        $jumlah_angsuran =  count($data['jatuh_tempo']);    
        for ($i=0; $i < $jumlah_angsuran ; $i++) { 
            $opsi_hutang['kode_hutang']          = $kode_pembelian;
            $opsi_hutang['angsuran']             = $data['angsuran'][$i];
            $opsi_hutang['tanggal_jatuh_tempo']  = $data['jatuh_tempo'][$i];
            $opsi_hutang['kode_unit_jabung']     = $get_unit->kode_unit;

            $this->db_kasir->insert('opsi_transaksi_hutang', $opsi_hutang);
        }

    }else if($data['jenis_pembayaran']=='kredit' && $data['jenis_kredit']=='non_dp'){

        $pembelian['bayar']              = 0;
        $pembelian['status']             = 'selesai';


        $hutang['kode_hutang']          = $kode_pembelian;
        $hutang['kode_supplier']        = $data['kode_supplier'];
        $hutang['nominal_hutang']       = $data['grand_total'];
        $hutang['angsuran']             = 0;
        $hutang['sisa']                 = $data['grand_total'];
        $hutang['tanggal_transaksi']    = date('Y-m-d'); 
        $hutang['kode_petugas']         = $user->kode_user; 
        $hutang['kode_unit_jabung']     = $get_unit->kode_unit; 

        $this->db_kasir->insert('transaksi_hutang', $hutang);

        $jumlah_angsuran =  count($data['jatuh_tempo']);    
        for ($i=0; $i < $jumlah_angsuran ; $i++) { 
            $opsi_hutang['kode_hutang']          = $kode_pembelian;
            $opsi_hutang['angsuran']             = $data['angsuran'][$i];
            $opsi_hutang['tanggal_jatuh_tempo']  = $data['jatuh_tempo'][$i];
            $opsi_hutang['kode_unit_jabung']     = $get_unit->kode_unit;

            $this->db_kasir->insert('opsi_transaksi_hutang', $opsi_hutang);
        }

    }
    if($data['jenis_ppn'] == 'ppn'){
        $total = $data['subtotal'] - $pembelian['nominal_diskon'];
        $ppn = ($data['bayar_ppn']*$total)/100;
        $pembelian['ppn'] = $data['bayar_ppn'];
        $pembelian['nominal_ppn']    = $ppn;
    }
    $pembelian['jenis_diskon']      = $data['jenis_diskon'];
    $pembelian['proses_pembayaran'] = $data['jenis_pembayaran'];
    $pembelian['jenis_kredit']      = $data['jenis_kredit'];
    $pembelian['jenis_ppn']         = $data['jenis_ppn'];
    $pembelian['jadwal_pengiriman'] = $get_po->tanggal_barang_datang;
    $pembelian['kode_petugas']      = $user->kode_user;
    $pembelian['kode_unit_jabung']  = $get_unit->kode_unit;
    $this->db->insert('transaksi_pembelian', $pembelian);
    $this->db_kasir->insert('transaksi_pembelian', $pembelian);

    $status['status']='selesai';
    $this->db->update('transaksi_po', $status,array('kode_po' =>$get_po->kode_po,'kode_unit_jabung' =>$get_unit->kode_unit));

    $this->db->delete('opsi_transaksi_pembelian_temp',array('kode_pembelian' =>$kode_pembelian));
}


}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class opname extends MY_Controller {


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
        $data['konten'] = $this->load->view('opname/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar()
    {
        $data['konten'] = $this->load->view('opname/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function tambah()
    {
        $data['konten'] = $this->load->view('opname/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function detail()
    {
        $data['konten'] = $this->load->view('opname/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function detail_jadwal()
    {
        $data['konten'] = $this->load->view('opname/detail_jadwal', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function jadwal_opname()
    {
        $data['konten'] = $this->load->view('opname/jadwal_opname', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function data_jadwal()
    {
        $data['konten'] = $this->load->view('opname/data_jadwal', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function input_opname()
    {
        $data['konten'] = $this->load->view('opname/input_opname', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function input_opname_produk()
    {
        $data['konten'] = $this->load->view('opname/input_opname_produk', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function input_opname_expired()
    {
        $data['konten'] = $this->load->view('opname/input_opname_expired', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function hasil_opname()
    {
        $data['konten'] = $this->load->view('opname/hasil_opname', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function detail_hasil()
    {
        $data['konten'] = $this->load->view('opname/detail_hasil', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function detail_opsi_expired()
    {
        $data['konten'] = $this->load->view('opname/detail_opsi_expired', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function tabel_opsi_temp()
    {
        $this->load->view('opname/tabel_opsi_temp');
        
    }

    public function get_jenis_bahan()
    {
        $jenis_bahan=$this->input->post('jenis_bahan');
        if($jenis_bahan=='BB'){
            ?>
            <option value="">-- Pilih Bahan</option>
            <?php 
            $get_bahan = $this->db_master->get('master_bahan_baku')->result();
            foreach ($get_bahan as $value) { 
                ?>
                <option value="<?php echo $value->kode_bahan_baku ?>"><?php echo $value->nama_bahan_baku ?></option>
                <?php  }

            }elseif ($jenis_bahan=='BDP') {
                ?>
                <option value="">-- Pilih Bahan</option>
                <?php 
                $get_bahan = $this->db_master->get('master_barang_dalam_proses')->result();
                foreach ($get_bahan as $value) {
                 ?>
                 <option value="<?php echo $value->kode_barang ?>"><?php echo $value->nama_barang ?></option>
                 <?php }
             }elseif ($jenis_bahan=='Produk') {
                ?>
                <option value="">-- Pilih Bahan</option>
                <?php 
                $get_bahan = $this->db_master->get('master_produk')->result();
                foreach ($get_bahan as $value) {
                 ?>
                 <option value="<?php echo $value->kode_produk ?>"><?php echo $value->nama_produk ?></option>
                 <?php 
             }
         }


     }
     public function add_item(){
        $input = $this->input->post();

        $this->db->where('kode_opname', $input['kode_opname']);
        $this->db->where('kode_bahan', $input['kode_bahan']);
        $cek_temp=$this->db->get('opsi_transaksi_opname_temp')->row();

        if (empty($cek_temp)) {
            $output['response'] = 'sukses';

            $input = $this->input->post();
            $insert = $this->db->insert('opsi_transaksi_opname_temp', $input);
        }else{
            $output['response'] = 'gagal';
        }


        echo json_encode($output);
    }
    public function hapus_item(){
        $id_temp = $this->input->post('id_temp');
        $this->db->delete('opsi_transaksi_opname_temp',array('id_temp' =>$id_temp));
    }

    public function simpan_jadwal(){
        $input = $this->input->post();

        $kode_opname=@$input['kode_opname'];
        $jenis_bahan=@$input['jenis_bahan'];

        $user = $this->session->userdata('astrosession');
        $kode_petugas=@$user->kode_user;


        $this->db->where('kan_suol.opsi_transaksi_opname_temp.kode_opname', @$kode_opname);
        $this->db->where('kan_suol.opsi_transaksi_opname_temp.kode_unit_jabung', @$input['kode_unit_jabung']);
        $this->db->from('kan_suol.opsi_transaksi_opname_temp');
        if($jenis_bahan=='BB'){
            $this->db->join('kan_master.master_bahan_baku', 'kan_suol.opsi_transaksi_opname_temp.kode_bahan=kan_master.master_bahan_baku.kode_bahan_baku', 'left');
        }
        if($jenis_bahan=='BDP'){
            $this->db->join('kan_master.master_barang_dalam_proses', 'kan_suol.opsi_transaksi_opname_temp.kode_bahan=kan_master.master_barang_dalam_proses.kode_barang');

        }elseif ($jenis_bahan=='Produk') {
            $this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_opname_temp.kode_bahan=kan_master.master_produk.kode_produk');
            
        }
        $get_temp=$this->db->get();
        $hasil_temp=$get_temp->result();
        $no=1;
        foreach ($hasil_temp as $temp) {
            $opsi['stok_awal']=@$temp->real_stok;
            $opsi['kode_opname']=@$temp->kode_opname;
            $opsi['kode_bahan']=@$temp->kode_bahan;
            $opsi['jenis_bahan']=@$temp->jenis_bahan;
            $opsi['kode_unit_jabung']=@$temp->kode_unit_jabung;
            $opsi['tanggal_opname']=@$input['tanggal'];
            $opsi['validasi']='menunggu';
            $this->db->insert('opsi_transaksi_opname', $opsi);
        }

        $transaksi['kode_opname']=$kode_opname;
        $transaksi['tanggal_opname']=@$input['tanggal'];
        $transaksi['kode_unit_jabung']=@$input['kode_unit_jabung'];
        $transaksi['status']='proses';
        $transaksi['kode_petugas']=@$kode_petugas;
        $transaksi['jenis_bahan']=@$jenis_bahan;

        $this->db->insert('transaksi_opname', $transaksi);
        $this->db->delete('opsi_transaksi_opname_temp',array('kode_opname' =>@$kode_opname));
    }

    public function hapus_item_opsi(){
        $id_opsi = $this->input->post('id_opsi');
        $this->db->delete('opsi_transaksi_opname',array('id_opsi' =>$id_opsi));
    }

    public function simpan_transaksi_opname()
    {
        $this->db_master = $this->load->database('kan_master', TRUE);
        $post=$this->input->post();

        $user = $this->session->userdata('astrosession');
        $kode_petugas=@$user->kode_user;

        $this->db->where('kode_opname', @$post['kode_opname']);
        $this->db->where('jenis_bahan', 'BB');
        $get_temp=$this->db->get('opsi_transaksi_opname');
        $hasil_temp=$get_temp->result_array();
        foreach ($hasil_temp as $temp) {
         $qty_fisik='qty_fisik_'.@$temp['kode_bahan'];
         $stok_awal='stok_awal_'.@$temp['kode_bahan'];
         $selisih='selisih_'.@$temp['kode_bahan'];
         $status='status_'.@$temp['kode_bahan'];

         $update_opsi['stok_awal']=$post[$stok_awal];
         $update_opsi['stok_akhir']=$post[$qty_fisik];
         $update_opsi['selisih']=$post[$selisih];
         $update_opsi['status']=$post[$status];

         $this->db->update('opsi_transaksi_opname', $update_opsi,array('kode_opname' =>@$post['kode_opname'],'kode_bahan' =>@$temp['kode_bahan']));

     }

     $update_opsi['status']='menunggu_validasi';

     $this->db->update('transaksi_opname', $update_opsi,array('kode_opname' =>@$post['kode_opname']));

 }
 public function simpan_opname_expired()
 {
    $post=$this->input->post();
    $jumlah_opsi=count($post['id_transaksi']);
    $qty_opname=0;
    for ($i=0; $i < $jumlah_opsi; $i++) { 
        $detail['kode_opname']=@$post['kode_opname'];
        $detail['tanggal_opname']=@$post['tanggal'];
        $detail['kode_bahan']=@$post['kode_bahan'];
        $detail['jenis_bahan']=@$post['jenis_bahan'];
        $detail['kode_unit_jabung']=@$post['kode_unit'];
        $detail['id_transaksi_stok']=@$post['id_transaksi'][$i];
        $detail['qty_stok']=@$post['qty_stok'][$i];
        $detail['qty_opname']=@$post['qty_opname'][$i];
        $detail['tanggal_expired']=@$post['exp_date'][$i];

        $this->db->insert('opsi_detail_transaksi_opname', $detail);
        $qty_opname +=@$post['qty_opname'][$i];
    }
    $this->db->where('kode_opname', @$post['kode_opname']);
    $this->db->where('jenis_bahan', @$post['jenis_bahan']);
    $this->db->where('kode_bahan', @$post['kode_bahan']);
    $get_opsi=$this->db->get('opsi_transaksi_opname');
    $hasil_opsi=$get_opsi->row();

    if(@$hasil_opsi->stok_awal < $qty_opname){
        $opsi['stok_akhir']=$qty_opname;
        $opsi['selisih']=$qty_opname - @$hasil_opsi->stok_awal;
        $opsi['status']='lebih';
    }elseif (@$hasil_opsi->stok_awal > $qty_opname) {
        $opsi['stok_akhir']=$qty_opname;
        $opsi['selisih']=@$hasil_opsi->stok_awal - $qty_opname;
        $opsi['status']='kurang';

    }
    $this->db->where('kode_opname', @$post['kode_opname']);
    $this->db->where('jenis_bahan', @$post['jenis_bahan']);
    $this->db->where('kode_bahan', @$post['kode_bahan']);
    $this->db->update('opsi_transaksi_opname', $opsi);

}
public function simpan_opname_produk()
{
    $post=$this->input->post();
    
    $transaksi['status']='menunggu_validasi';

    $this->db->where('kode_opname', @$post['kode_opname']);
    $this->db->where('kode_unit_jabung', @$post['kode_unit']);
    $this->db->update('transaksi_opname', $transaksi);

}
public function simpan_tidak_disesuaikan()
{
    $post=$this->input->post();
    
    $transaksi['validasi']='selesai';

    $this->db->where('kode_opname', @$post['kode_opname']);
    $this->db->where('kode_unit_jabung', @$post['kode_unit']);
    $this->db->where('kode_bahan', @$post['kode_bahan']);
    $this->db->update('opsi_transaksi_opname', $transaksi);

}
public function simpan_disesuaikan()
{
    $post=$this->input->post();
    $jenis_bahan=@$post['jenis_bahan'];

    $user = $this->session->userdata('astrosession');
    $kode_petugas=@$user->kode_user;

    if($jenis_bahan=='BB'){
        $this->db->where('kode_opname', @$post['kode_opname']);
        $this->db->where('kode_bahan', @$post['kode_bahan']);
        $this->db->where('jenis_bahan', 'BB');
        $get_opsi=$this->db->get('opsi_transaksi_opname');
        $hasil_opsi=$get_opsi->row();

        $this->db->where('kode_unit_jabung', @$post['kode_unit']);
        $this->db->order_by('tanggal_transaksi', 'DESC');
        $get_data_stok=$this->db->get_where('transaksi_stok',array('jenis_transaksi' =>'pembelian','kategori_bahan' =>'BB','sisa_stok >' =>0,'kode_bahan'=>@$post['kode_bahan'],'status'=>'masuk'));
        $hasil_data_stok=$get_data_stok->row();

        if(@$hasil_opsi->status=='lebih'){
            $tstok['stok_masuk'] = $hasil_data_stok->stok_masuk + $hasil_opsi->selisih;
            $tstok['sisa_stok'] = $hasil_data_stok->sisa_stok + $hasil_opsi->selisih;
        }else if(@$hasil_opsi->status=='kurang'){
            $tstok['stok_masuk'] = $hasil_data_stok->stok_masuk - $hasil_opsi->selisih;
            $tstok['sisa_stok'] = $hasil_data_stok->sisa_stok - $hasil_opsi->selisih;
        }
        $this->db->update('transaksi_stok', $tstok, array('id'=>$hasil_data_stok->id,'kode_unit_jabung'=>@$post['kode_unit']));


        if(@$hasil_opsi->status=='lebih'){
            $record_tstok['status'] = 'masuk';
            $record_tstok['stok_masuk'] = $hasil_opsi->selisih;
            $record_tstok['stok_keluar'] ='';
        }else if(@$hasil_opsi->status=='kurang'){
            $record_tstok['status'] = 'keluar';
            $record_tstok['stok_keluar'] = $hasil_opsi->selisih;
            $record_tstok['stok_masuk'] = '';
        }
        $record_tstok['jenis_transaksi'] = 'opname';
        $record_tstok['kode_transaksi'] = @$post['kode_opname'];
        $record_tstok['kategori_bahan'] = 'BB';
        $record_tstok['kode_bahan'] = $hasil_data_stok->kode_bahan;
        $record_tstok['hpp'] = $hasil_data_stok->hpp;
        $record_tstok['kode_petugas'] = $kode_petugas;
        $record_tstok['tanggal_transaksi'] = date('Y-m-d H:i:s');
        $record_tstok['posisi_awal'] = 'gudang';
        $record_tstok['kode_unit_jabung'] = @$post['kode_unit'];

        $this->db->insert('transaksi_stok', $record_tstok);

        $stok_bb['real_stok']=$hasil_opsi->stok_akhir;

        $this->db_master->where('kode_unit_jabung', @$post['kode_unit']);
        $this->db_master->where('kode_bahan_baku',@$post['kode_bahan']);
        $this->db_master->update('master_bahan_baku', $stok_bb);

    }else{

        $this->db->where('kode_opname', @$post['kode_opname']);
        $this->db->where('kode_bahan', @$post['kode_bahan']);
        $this->db->where('jenis_bahan', $jenis_bahan);
        $get_detail=$this->db->get('opsi_detail_transaksi_opname');
        $hasil_detail=$get_detail->result();

        foreach ($hasil_detail as $detail) {
            $this->db->where('id', @$detail->id_transaksi_stok);
            $get_tsstok=$this->db->get('transaksi_stok');
            $hasil_tsstok=$get_tsstok->row();

            if(($detail->qty_stok > $detail->qty_opname) && $detail->qty_opname > 0){
                $selisih=$detail->qty_stok - $detail->qty_opname;
                $upstok['sisa_stok']=$hasil_tsstok->sisa_stok - $selisih;
                
                $this->db->where('id', @$detail->id_transaksi_stok);
                $this->db->update('transaksi_stok', $upstok);

            }elseif (($detail->qty_stok < $detail->qty_opname) && $detail->qty_opname > 0) {
                $selisih=$detail->qty_opname - $detail->qty_stok;
                $upstok['sisa_stok']=$hasil_tsstok->sisa_stok + $selisih;

                $this->db->where('id', @$detail->id_transaksi_stok);
                $this->db->update('transaksi_stok', $upstok);
            }
            
            
        }
        
        $this->db->where('kode_opname', @$post['kode_opname']);
        $this->db->where('kode_bahan', @$post['kode_bahan']);
        $this->db->where('jenis_bahan', $jenis_bahan);
        $get_opsi=$this->db->get('opsi_transaksi_opname');
        $hasil_opsi=$get_opsi->row();


        if ($jenis_bahan=='BDP'){

            $stok_bdp['real_stok']=@$hasil_opsi->stok_akhir;

            $this->db_master->where('kode_unit_jabung', @$post['kode_unit']);
            $this->db_master->where('kode_barang',@$post['kode_bahan']);
            $this->db_master->update('master_barang_dalam_proses', $stok_bdp);

        }elseif ($jenis_bahan=='Produk') {
            $stok_produk['real_stok']=@$hasil_opsi->stok_akhir;

            $this->db_master->where('kode_unit_jabung', @$post['kode_unit']);
            $this->db_master->where('kode_produk',@$post['kode_bahan']);
            $this->db_master->update('master_produk', $stok_produk);
        }
        

    }

    $opsi_transaksi['validasi']='selesai';

    $this->db->where('kode_opname', @$post['kode_opname']);
    $this->db->where('kode_unit_jabung', @$post['kode_unit']);
    $this->db->where('kode_bahan', @$post['kode_bahan']);
    $this->db->update('opsi_transaksi_opname', $opsi_transaksi);

}
public function validasi_transaksi_opname()
{
    $this->db_master = $this->load->database('kan_master', TRUE);
    $post=$this->input->post();

    $user = $this->session->userdata('astrosession');
    $kode_petugas=@$user->kode_user;

    $this->db->where('kode_opname', @$post['kode_opname']);
    $this->db->where('jenis_bahan', 'BB');
    $get_temp=$this->db->get('opsi_transaksi_opname');
    $hasil_temp=$get_temp->result_array();
    foreach ($hasil_temp as $temp) {
     $qty_fisik='qty_fisik_'.@$temp['kode_bahan'];
     $stok_awal='stok_awal_'.@$temp['kode_bahan'];
     $selisih='selisih_'.@$temp['kode_bahan'];
     $status='status_'.@$temp['kode_bahan'];

     $update_opsi['stok_awal']=$post[$stok_awal];
     $update_opsi['stok_akhir']=$post[$qty_fisik];
     $update_opsi['selisih']=$post[$selisih];
     $update_opsi['status']=$post[$status];

     $this->db->update('opsi_transaksi_opname', $update_opsi,array('kode_opname' =>@$post['kode_opname'],'kode_bahan' =>@$temp['kode_bahan']));


     $stok_bb['real_stok']=$post[$qty_fisik];

     $this->db_master->where('kode_unit_jabung', @$post['kode_unit']);
     $this->db_master->where('kode_bahan_baku',@$temp['kode_bahan']);
     $this->db_master->update('master_bahan_baku', $stok_bb);

     $this->db->where('kode_unit_jabung', @$post['kode_unit']);
     $this->db->order_by('tanggal_transaksi', 'DESC');
     $get_data_stok=$this->db->get_where('transaksi_stok',array('jenis_transaksi' =>'pembelian','kategori_bahan' =>'BB','sisa_stok >' =>0,'kode_bahan'=>@$temp['kode_bahan'],'status'=>'masuk'));
     $hasil_data_stok=$get_data_stok->row();

     if($post[$status]=='lebih'){
        $tstok['stok_masuk'] = $hasil_data_stok->stok_masuk + $post[$selisih];
        $tstok['sisa_stok'] = $hasil_data_stok->sisa_stok + $post[$selisih];
    }else if($post[$status]=='kurang'){
        $tstok['stok_masuk'] = $hasil_data_stok->stok_masuk - $post[$selisih];
        $tstok['sisa_stok'] = $hasil_data_stok->sisa_stok - $post[$selisih];
    }
    $this->db->update('transaksi_stok', $tstok, array('id'=>$hasil_data_stok->id,'kode_unit_jabung'=>@$post['kode_unit']));


    if($post[$status]=='lebih'){
        $record_tstok['status'] = 'masuk';
        $record_tstok['stok_masuk'] = $post[$selisih];
        $record_tstok['stok_keluar'] ='';
    }else if($post[$status]=='kurang'){
        $record_tstok['status'] = 'keluar';
        $record_tstok['stok_keluar'] = $post[$selisih];
        $record_tstok['stok_masuk'] = '';
    }
    $record_tstok['jenis_transaksi'] = 'opname';
    $record_tstok['kode_transaksi'] = @$post['kode_opname'];
    $record_tstok['kategori_bahan'] = 'BB';
    $record_tstok['kode_bahan'] = $hasil_data_stok->kode_bahan;
    $record_tstok['hpp'] = $hasil_data_stok->hpp;
    $record_tstok['kode_petugas'] = $kode_petugas;
    $record_tstok['tanggal_transaksi'] = date('Y-m-d H:i:s');
    $record_tstok['posisi_awal'] = 'gudang';
    $record_tstok['kode_unit_jabung'] = @$post['kode_unit'];

    $this->db->insert('transaksi_stok', $record_tstok);

}

$update_opsi['status']='menunggu_validasi';

$this->db->update('transaksi_opname', $update_opsi,array('kode_opname' =>@$post['kode_opname']));

}
}

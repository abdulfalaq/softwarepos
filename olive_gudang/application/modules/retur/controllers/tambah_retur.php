<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tambah_retur extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
    }

    public function index()
    {

        $data['konten'] = $this->load->view('tambah_retur/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar()
    {

        $data['konten'] = $this->load->view('daftar_retur/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function tambah()
    {
        $this->db->truncate('opsi_transaksi_retur_temp');
        $data['konten'] = $this->load->view('tambah_retur/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }   
    public function edit()
    {

        $data['konten'] = $this->load->view('daftar_retur/edit_retur', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function detail()
    {

        $data['konten'] = $this->load->view('daftar_retur/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar_diterima()
    {

        $data['konten'] = $this->load->view('tambah_retur/daftar_diterima', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function tabel_temp_data_retur()
    {
        $this->load->view('tambah_retur/tabel_temp_data_retur');
    }
    public function get_table_input_retur()
    {
        $this->load->view('daftar_retur/table_input_retur');
    }
    public function cari_retur()
    {
        $this->load->view('daftar_retur/cari_retur');
    }

    public function get_bahan()
    {
        $kategori_bahan = $this->input->post('kategori_bahan');

        if(@$kategori_bahan=='bahan baku'){
            $this->db->where('status', '1');
            $this->db->from('olive_master.master_bahan_baku');
            $get_bahan_baku=$this->db->get()->result();
            echo "<option value=''>- Pilih -</option>";
            foreach ($get_bahan_baku as $value) {
                ?>
                <option value="<?php echo @$value->kode_bahan_baku;?>"><?php echo @$value->nama_bahan_baku;?></option>
                <?php
            }
        }elseif (@$kategori_bahan=='produk') {
            $this->db->where('status', '1');
            $this->db->from('olive_master.master_produk');
            $get_produk=$this->db->get()->result();
            echo "<option value=''>- Pilih -</option>";
            foreach ($get_produk as $value) {
                ?>
                <option value="<?php echo @$value->kode_produk;?>"><?php echo @$value->nama_produk;?></option>
                <?php
            }
        }elseif (@$kategori_bahan=='perlengkapan') {
            $this->db->where('status', '1');
            $this->db->from('olive_master.master_perlengkapan');
            $get_perlengkapan=$this->db->get()->result();
            echo "<option value=''>- Pilih -</option>";
            foreach ($get_perlengkapan as $value) {
                ?>
                <option value="<?php echo @$value->kode_perlengkapan;?>"><?php echo @$value->nama_perlengkapan;?></option>
                <?php
            }
        }


    }
    public function get_satuan()
    {
        $kategori_bahan = $this->input->post('kategori_bahan');
        $kode_bahan = $this->input->post('kode_bahan');
        if(@$kategori_bahan=='bahan baku'){
            $this->db->where('kode_bahan_baku', $kode_bahan);
            $this->db->where('status', '1');
            $this->db->from('olive_master.master_bahan_baku');
            $this->db->join('olive_master.master_satuan', 'olive_master.master_bahan_baku.kode_satuan_stok = olive_master.master_satuan.kode', 'left');
            $get_bahan_baku=$this->db->get()->row();
            echo json_encode($get_bahan_baku);
        }elseif (@$kategori_bahan=='produk') {
            $this->db->where('kode_produk', $kode_bahan);
            $this->db->where('status', '1');
            $this->db->from('olive_master.master_produk');
            $this->db->join('olive_master.master_satuan', 'olive_master.master_produk.kode_satuan_stok = olive_master.master_satuan.kode', 'left');
            $get_produk=$this->db->get()->row();
            echo json_encode($get_produk);
        }elseif (@$kategori_bahan=='perlengkapan') {
            $this->db->where('kode_perlengkapan', $kode_bahan);
            $this->db->where('status', '1');
            $this->db->from('olive_master.master_perlengkapan');
            $this->db->join('olive_master.master_satuan', 'olive_master.master_perlengkapan.kode_satuan_stok = olive_master.master_satuan.kode', 'left');
            $get_perlengkapan=$this->db->get()->row();
            echo json_encode($get_perlengkapan);
        }elseif (@$kategori_bahan=='kartu member') {
            $this->db->where('kode_kartu_member', $kode_bahan);
            $this->db->from('olive_master.kartu_member');
            $get_kartu_member=$this->db->get()->row();
            echo json_encode($get_kartu_member);
        }

    }
    public function cari_kode_pembelian()
    {

        $kode_pembelian = $this->input->post('cari_kode_pembelian');
        $kode_retur = $this->input->post('kode_retur');

        $this->db->where('kode_pembelian', $kode_pembelian);
        $this->db->select('kode_pembelian');
        $this->db->select('nomor_nota');
        $this->db->select('nama_supplier');
        $this->db->select('olive_gudang.transaksi_pembelian.kode_supplier');
        $this->db->from('olive_gudang.transaksi_pembelian');
        $this->db->join('olive_master.master_supplier', 'olive_gudang.transaksi_pembelian.kode_supplier = olive_master.master_supplier.kode_supplier', 'left');
        $query = $this->db->get();
        $data = $query->row();
        if(empty($data)){
            $hasil['respon']='kosong';
        }
        else{

            $pembelian = $this->db->get_where('opsi_transaksi_pembelian',array('kode_pembelian'=>$kode_pembelian));
            $list_pembelian = $pembelian->result();
            foreach($list_pembelian as $daftar){ 
                if(@$daftar->kategori_bahan !='kartu member'){
                    $masukan['kode_retur'] = $kode_retur;
                    $masukan['kategori_bahan'] = $daftar->kategori_bahan;
                    $masukan['kode_bahan'] = $daftar->kode_bahan; 
                    $masukan['jumlah'] = $daftar->jumlah; 
                    $masukan['kode_satuan'] = $daftar->kode_satuan;
                    $masukan['harga_satuan'] = $daftar->harga_satuan;
                    $masukan['diskon_item'] = $daftar->diskon_item;
                    $masukan['subtotal'] = $daftar->subtotal; 
                    $masukan['status']='keluar';
                    $input = $this->db->insert('opsi_transaksi_retur_temp',$masukan);
                }
            }

            $hasil['nomor_nota']=@$data->nomor_nota;
            $hasil['kode_pembelian']=@$data->kode_pembelian;
            $hasil['kode_supplier']=@$data->kode_supplier;
            $hasil['nama_supplier']=@$data->nama_supplier;
            $hasil['respon']='sukses';

        }
        echo json_encode($hasil);
    }
    public function hapus_bahan_temp()
    {
        $id = $this->input->post('id');
        $this->db->delete('opsi_transaksi_retur_temp',array('id' =>$id));
    }
    public function get_temp_retur()
    {
        $id = $this->input->post('id');

        $this->db->where('olive_gudang.opsi_transaksi_retur_temp.id', $id);
        $this->db->select('nama');
        $this->db->select('nama_bahan_baku');
        $this->db->select('nama_perlengkapan');
        $this->db->select('nama_produk');
        $this->db->select('olive_gudang.opsi_transaksi_retur_temp.id');
        $this->db->select('olive_gudang.opsi_transaksi_retur_temp.jumlah');
        $this->db->select('olive_gudang.opsi_transaksi_retur_temp.harga_satuan');
        $this->db->select('olive_gudang.opsi_transaksi_retur_temp.subtotal');
        $this->db->select('olive_gudang.opsi_transaksi_retur_temp.kategori_bahan');
        $this->db->select('olive_gudang.opsi_transaksi_retur_temp.kode_bahan');
        $this->db->select('olive_gudang.opsi_transaksi_retur_temp.kode_satuan');
        $this->db->select('olive_gudang.opsi_transaksi_retur_temp.expired_date');

        $this->db->from('olive_gudang.opsi_transaksi_retur_temp');
        $this->db->join('olive_master.master_bahan_baku', 'olive_gudang.opsi_transaksi_retur_temp.kode_bahan = olive_master.master_bahan_baku.kode_bahan_baku', 'left');
        $this->db->join('olive_master.master_perlengkapan', 'olive_gudang.opsi_transaksi_retur_temp.kode_bahan = olive_master.master_perlengkapan.kode_perlengkapan', 'left');
        $this->db->join('olive_master.master_produk', 'olive_gudang.opsi_transaksi_retur_temp.kode_bahan = olive_master.master_produk.kode_produk', 'left');
        $this->db->join('olive_master.master_satuan', 'olive_gudang.opsi_transaksi_retur_temp.kode_satuan = olive_master.master_satuan.kode', 'left');
        $get_temp=$this->db->get()->row();
        echo json_encode($get_temp);
    }
    public function update_item()
    {
        $id = $this->input->post('id');
        $kode_pembelian = $this->input->post('kode_pembelian');
        $kode_bahan = $this->input->post('kode_bahan');
        $jumlah = $this->input->post('jumlah');
        $harga_satuan = $this->input->post('harga_satuan');

        $pembelian = $this->db->get_where('opsi_transaksi_pembelian',array('kode_pembelian'=>$kode_pembelian,'kode_bahan'=>$kode_bahan));
        $cek_pembelian = $pembelian->row();
        if(@$cek_pembelian->jumlah >=@$jumlah){
            $data['jumlah']=@$jumlah;
            $data['subtotal']=@$jumlah * $harga_satuan;
            $this->db->update('opsi_transaksi_retur_temp',$data,array('id' =>$id));
            $hasil['respon']='sukses';
        }else{
            $hasil['respon']='gagal';
        }
        echo json_encode(@$hasil);
    }    
    public function simpan_retur()
    {
        $this->db_master = $this->load->database('olive_master', TRUE);
        $input = $this->input->post();
        $kode_retur = $input['kode_retur'];
        $kode_pembelian = $input['kode_pembelian'];
        $kode_supplier = $input['kode_supplier'];

        $get_id_petugas = $this->session->userdata('astrosession');
        $id_petugas = $get_id_petugas->id;
        $nama_petugas = $get_id_petugas->uname;


        $this->db->where('olive_gudang.opsi_transaksi_retur_temp.kode_retur', $kode_retur);
        $this->db->where('olive_gudang.opsi_transaksi_retur_temp.status', 'keluar');
        $this->db->select('nama_bahan_baku');
        $this->db->select('nama_perlengkapan');
        $this->db->select('nama_produk');
        $this->db->select('olive_gudang.opsi_transaksi_retur_temp.id');
        $this->db->select('olive_gudang.opsi_transaksi_retur_temp.jumlah');
        $this->db->select('olive_gudang.opsi_transaksi_retur_temp.harga_satuan');
        $this->db->select('olive_gudang.opsi_transaksi_retur_temp.subtotal');
        $this->db->select('olive_gudang.opsi_transaksi_retur_temp.kategori_bahan');
        $this->db->select('olive_gudang.opsi_transaksi_retur_temp.kode_bahan');
        $this->db->select('olive_gudang.opsi_transaksi_retur_temp.kode_satuan');
        $this->db->select('olive_gudang.opsi_transaksi_retur_temp.status');

        $this->db->select('olive_master.master_produk.real_stock as real_stock_produk');
        $this->db->select('olive_master.master_bahan_baku.real_stock as real_stock_bahan_baku');
        $this->db->select('olive_master.master_perlengkapan.real_stock as real_stock_perlengkapan');

        $this->db->from('olive_gudang.opsi_transaksi_retur_temp');
        $this->db->join('olive_master.master_bahan_baku', 'olive_gudang.opsi_transaksi_retur_temp.kode_bahan = olive_master.master_bahan_baku.kode_bahan_baku', 'left');
        $this->db->join('olive_master.master_perlengkapan', 'olive_gudang.opsi_transaksi_retur_temp.kode_bahan = olive_master.master_perlengkapan.kode_perlengkapan', 'left');
        $this->db->join('olive_master.master_produk', 'olive_gudang.opsi_transaksi_retur_temp.kode_bahan = olive_master.master_produk.kode_produk', 'left');

        $query_retur_temp=$this->db->get();

        $grand_total = 0;
        foreach ($query_retur_temp->result() as $item){
            $data_opsi['kode_retur'] = $kode_retur;
            $data_opsi['kategori_bahan'] = $item->kategori_bahan;
            $data_opsi['kode_bahan'] = $item->kode_bahan;
            $data_opsi['jumlah'] = $item->jumlah;
            $data_opsi['kode_satuan'] = $item->kode_satuan;
            $data_opsi['harga_satuan'] = $item->harga_satuan;
            $data_opsi['subtotal'] = $item->subtotal;
            $data_opsi['status'] = @$item->status;

            $tabel_opsi_transaksi_retur = $this->db->insert("opsi_transaksi_retur", $data_opsi);

            $grand_total += $item->subtotal;
            $stok_keluar = $item->jumlah;
            $kategori_bahan = $item->kategori_bahan;
            $kode_bahan = $item->kode_bahan;
            $harga_satuan = $item->harga_satuan;

            if($kategori_bahan=='bahan baku'){
                if(!empty($item->real_stock_bahan_baku)){

                    $data_stok['real_stock'] = @$item->real_stock_bahan_baku - ($stok_keluar)  ;
                    $this->db_master->update('master_bahan_baku',$data_stok,array('kode_bahan_baku'=>$kode_bahan));

                    $stok['jenis_transaksi'] = 'retur' ;
                    $stok['kode_transaksi'] = $kode_retur ;
                    $stok['kategori_bahan'] = $kategori_bahan ;
                    $stok['kode_bahan'] = $kode_bahan ;
                    $stok['stok_keluar'] = $stok_keluar;
                    $stok['stok_masuk'] =  '';
                    $stok['posisi_awal'] = 'gudang';
                    $stok['posisi_akhir'] = 'supplier';
                    $stok['hpp'] = $harga_satuan ;
                    $stok['sisa_stok'] = '' ;
                    $stok['id_petugas'] = $id_petugas;
                    $stok['tanggal_transaksi'] = date("Y-m-d") ;

                    $transaksi_stok = $this->db->insert("transaksi_stok", $stok);

                }
            }
            if($kategori_bahan=='perlengkapan'){
                if(!empty($item->real_stock_perlengkapan)){

                    $data_stok['real_stock'] = @$item->real_stock_perlengkapan- ($stok_keluar)  ;
                    $this->db_master->update('master_perlengkapan',$data_stok,array('kode_perlengkapan'=>$kode_bahan));


                    $stok['jenis_transaksi'] = 'retur' ;
                    $stok['kode_transaksi'] = $kode_retur ;
                    $stok['kategori_bahan'] = $kategori_bahan ;
                    $stok['kode_bahan'] = $kode_bahan ;
                    $stok['stok_keluar'] = $stok_keluar;
                    $stok['stok_masuk'] =  '';
                    $stok['posisi_awal'] = 'gudang';
                    $stok['posisi_akhir'] = 'supplier';
                    $stok['hpp'] = $harga_satuan ;
                    $stok['sisa_stok'] = '' ;
                    $stok['id_petugas'] = $id_petugas;
                    $stok['tanggal_transaksi'] = date("Y-m-d") ;

                    $transaksi_stok = $this->db->insert("transaksi_stok", $stok);

                }
            }

            if($kategori_bahan=='produk'){
                if(!empty($item->real_stock_produk)){

                    $data_stok['real_stock'] = @$item->real_stock_produk - ($stok_keluar)  ;
                    $this->db_master->update('master_produk',$data_stok,array('kode_produk'=>$kode_bahan));


                    $stok['jenis_transaksi'] = 'retur' ;
                    $stok['kode_transaksi'] = $kode_retur ;
                    $stok['kategori_bahan'] = $kategori_bahan ;
                    $stok['kode_bahan'] = $kode_bahan ;
                    $stok['stok_keluar'] = $stok_keluar;
                    $stok['stok_masuk'] =  '';
                    $stok['posisi_awal'] = 'gudang';
                    $stok['posisi_akhir'] = 'supplier';
                    $stok['hpp'] = $harga_satuan ;
                    $stok['sisa_stok'] = '' ;
                    $stok['id_petugas'] = $id_petugas;
                    $stok['tanggal_transaksi'] = date("Y-m-d") ;

                    $transaksi_stok = $this->db->insert("transaksi_stok", $stok);

                }
            }

            $this->db->select('jumlah_retur');
            $get_transaksi_opsi = $this->db->get_where('opsi_transaksi_pembelian',array('kode_pembelian'=>$kode_pembelian,'kode_bahan'=>$kode_bahan,'kategori_bahan'=>$kategori_bahan));
            $data_transaksi_opsi = $get_transaksi_opsi->row();

            $data_pembelian['jumlah_retur'] = @$data_transaksi_opsi->jumlah_retur + ($stok_keluar)  ;
            $this->db->update('opsi_transaksi_pembelian',$data_pembelian,array('kode_pembelian'=>$kode_pembelian,'kode_bahan'=>$kode_bahan,'kategori_bahan'=>$kategori_bahan));
        }
        if(@$transaksi_stok){

            $input['tanggal_retur_keluar'] = date("Y-m-d") ;
            $input['tanggal_retur_masuk'] = '' ;
            $input['total_nominal'] = '' ;
            $input['sisa_nominal'] = '' ;
            $input['potongan'] = '' ;
            $input['total_nominal'] = $grand_total ;
            $input['grand_total'] = $grand_total;
            $input['id_petugas'] = $id_petugas ;
            $input['kode_supplier'] = $kode_supplier ;

            $input['status_retur'] = 'menunggu' ;
            $tabel_transaksi_retur = $this->db->insert("transaksi_retur", $input);
            if($tabel_transaksi_retur){
                $hasil['respon']='sukses';
                $delete_temp = $this->db->delete("opsi_transaksi_retur_temp", array('kode_retur'=>$kode_retur,'status'=>'keluar'));
            }
            else{
                $hasil['respon']='gagal';
            }
        }
        else{

            $hasil['respon']='gagal'; 
        }

 
        echo json_encode(@$hasil);
    }

    public function add_item_temp()
    {
        $jenis = $this->input->post('kategori_bahan');
        $kode_barang = $this->input->post('kode_barang');

        if($jenis!==""){
            $data['kode_bahan'] = $this->input->post('kode_bahan');
            $data['kode_retur'] = $this->input->post('kode_retur');
            $data['kategori_bahan'] = $this->input->post('kategori_bahan');
            $data['jumlah'] = $this->input->post('jumlah');
            $data['kode_satuan'] = $this->input->post('kode_satuan');
            $data['harga_satuan'] = $this->input->post('harga');
            $data['subtotal'] = $this->input->post('sub_total');
            $data['expired_date'] = $this->input->post('expired_date');
            $data['status'] = 'masuk';

            $this->db->insert("opsi_transaksi_retur_temp",$data);

        }
    }
    public function update_item_input()
    {
        $data['expired_date'] = $this->input->post('expired_date');
        $data['jumlah'] = $this->input->post('jumlah');
        $data['subtotal'] = $this->input->post('subtotal');

        $this->db->where(array('id'=>$this->input->post('id')));
        $this->db->update('opsi_transaksi_retur_temp',$data);
    }
    public function simpan_input_retur()
    {
       $this->db_master = $this->load->database('olive_master', TRUE);
       $input = $this->input->post();
       $kode_retur = $input['kode_retur'];
       $kode_pembelian = $input['kode_pembelian'];

       $get_id_petugas = $this->session->userdata('astrosession');
       $id_petugas = $get_id_petugas->id;
       $nama_petugas = $get_id_petugas->uname;


       $this->db->where('olive_gudang.opsi_transaksi_retur_temp.kode_retur', $kode_retur);
       $this->db->where('olive_gudang.opsi_transaksi_retur_temp.status', 'masuk');
       $this->db->select('nama_bahan_baku');
       $this->db->select('nama_perlengkapan');
       $this->db->select('nama_produk');
       $this->db->select('olive_gudang.opsi_transaksi_retur_temp.id');
       $this->db->select('olive_gudang.opsi_transaksi_retur_temp.jumlah');
       $this->db->select('olive_gudang.opsi_transaksi_retur_temp.harga_satuan');
       $this->db->select('olive_gudang.opsi_transaksi_retur_temp.subtotal');
       $this->db->select('olive_gudang.opsi_transaksi_retur_temp.kategori_bahan');
       $this->db->select('olive_gudang.opsi_transaksi_retur_temp.kode_bahan');
       $this->db->select('olive_gudang.opsi_transaksi_retur_temp.kode_satuan');
       $this->db->select('olive_gudang.opsi_transaksi_retur_temp.status');
       $this->db->select('olive_gudang.opsi_transaksi_retur_temp.expired_date');

       $this->db->select('olive_master.master_produk.real_stock as real_stock_produk');
       $this->db->select('olive_master.master_bahan_baku.real_stock as real_stock_bahan_baku');
       $this->db->select('olive_master.master_perlengkapan.real_stock as real_stock_perlengkapan');

       $this->db->from('olive_gudang.opsi_transaksi_retur_temp');
       $this->db->join('olive_master.master_bahan_baku', 'olive_gudang.opsi_transaksi_retur_temp.kode_bahan = olive_master.master_bahan_baku.kode_bahan_baku', 'left');
       $this->db->join('olive_master.master_perlengkapan', 'olive_gudang.opsi_transaksi_retur_temp.kode_bahan = olive_master.master_perlengkapan.kode_perlengkapan', 'left');
       $this->db->join('olive_master.master_produk', 'olive_gudang.opsi_transaksi_retur_temp.kode_bahan = olive_master.master_produk.kode_produk', 'left');

       $query_retur_temp=$this->db->get();
       $total = 0;
       foreach ($query_retur_temp->result() as $item){
        $data_opsi['kode_retur'] = $kode_retur;
        $data_opsi['kategori_bahan'] = $item->kategori_bahan;
        $data_opsi['kode_bahan'] = $item->kode_bahan;
        $data_opsi['jumlah'] = $item->jumlah;
        $data_opsi['kode_satuan'] = $item->kode_satuan;
        $data_opsi['harga_satuan'] = $item->harga_satuan;
        $data_opsi['subtotal'] = $item->subtotal;
        $data_opsi['status'] = $item->status;
        $data_opsi['expired_date'] = $item->expired_date;


        $stok_masuk = $item->jumlah;
        $kategori_bahan = $item->kategori_bahan;
        $kode_bahan = $item->kode_bahan;
        $harga_satuan = $item->harga_satuan;

        $tabel_opsi_transaksi_retur = $this->db->insert("opsi_transaksi_retur", $data_opsi);
        if($kategori_bahan=='perlengkapan'){

            $data_stok['real_stock'] = $item->real_stock_perlengkapan + $item->jumlah  ;
            $this->db_master->update('master_perlengkapan',$data_stok,array('kode_perlengkapan'=>$kode_bahan));
        }else if($kategori_bahan=='bahan baku'){
            $data_stok['real_stock'] = $item->real_stock_bahan_baku + $item->jumlah  ;
            $this->db_master->update('master_bahan_baku',$data_stok,array('kode_bahan_baku'=>$kode_bahan));
        }else if($kategori_bahan=='produk'){
            $data_stok['real_stock'] = $item->real_stock_produk + $item->jumlah  ;
            $this->db_master->update('master_produk',$data_stok,array('kode_produk'=>$kode_bahan));
        }
        $stok['jenis_transaksi'] = 'retur' ;
        $stok['kode_transaksi'] = $kode_retur ;
        $stok['kategori_bahan'] = $kategori_bahan ;
        $stok['kode_bahan'] = $kode_bahan ;
        $stok['stok_masuk'] = $stok_masuk;
        $stok['posisi_awal'] = 'supplier';
        $stok['posisi_akhir'] = 'gudang';
        $stok['hpp'] = $harga_satuan ;
        $stok['sisa_stok'] = $stok_masuk ;
        $stok['id_petugas'] = $id_petugas;
        $stok['tanggal_transaksi'] = date("Y-m-d") ;

        $transaksi_stok = $this->db->insert("transaksi_stok", $stok);

    }

    $update_retur['tanggal_retur_masuk'] = date("Y-m-d") ;
    $update_retur['status_retur'] = 'selesai';

    $update_transaksi_retur=$this->db->update("transaksi_retur", $update_retur, array('kode_retur' => $kode_retur));
    if($update_transaksi_retur){
        $hasil['respon']='sukses'; 
        $delete_temp = $this->db->delete("opsi_transaksi_retur_temp", array('kode_retur'=>$kode_retur,'status'=>'masuk'));
    }
    else{

        $hasil['respon']='gagal'; 
    }
    echo json_encode(@$hasil);
}
}

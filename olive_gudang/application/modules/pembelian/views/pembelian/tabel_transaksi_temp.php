<?php
if(@$kode){
  $this->db->select('nama');
  $this->db->select('nama_bahan_baku');
  $this->db->select('nama_perlengkapan');
  $this->db->select('nama_produk');
  $this->db->select('olive_gudang.opsi_transaksi_pembelian_temp.id');
  $this->db->select('olive_gudang.opsi_transaksi_pembelian_temp.jumlah');
  $this->db->select('olive_gudang.opsi_transaksi_pembelian_temp.expired_date');
  $this->db->select('olive_gudang.opsi_transaksi_pembelian_temp.harga_satuan');
  $this->db->select('olive_gudang.opsi_transaksi_pembelian_temp.jenis_diskon');
  $this->db->select('olive_gudang.opsi_transaksi_pembelian_temp.diskon_item');
  $this->db->select('olive_gudang.opsi_transaksi_pembelian_temp.subtotal');
  $this->db->select('olive_gudang.opsi_transaksi_pembelian_temp.kategori_bahan');

  $this->db->where('kode_pembelian',@$kode);
  $this->db->from('olive_gudang.opsi_transaksi_pembelian_temp');
  $this->db->join('olive_master.master_bahan_baku', 'olive_gudang.opsi_transaksi_pembelian_temp.kode_bahan = olive_master.master_bahan_baku.kode_bahan_baku', 'left');
  $this->db->join('olive_master.master_produk', 'olive_gudang.opsi_transaksi_pembelian_temp.kode_bahan = olive_master.master_produk.kode_produk', 'left');
  $this->db->join('olive_master.master_perlengkapan', 'olive_gudang.opsi_transaksi_pembelian_temp.kode_bahan = olive_master.master_perlengkapan.kode_perlengkapan', 'left');
  $this->db->join('olive_master.master_satuan', 'olive_gudang.opsi_transaksi_pembelian_temp.kode_satuan = olive_master.master_satuan.kode', 'left');
  $pembelian = $this->db->get();
  $list_pembelian = $pembelian->result();
  $nomor = 1;  $total = 0;

  foreach($list_pembelian as $daftar){ 
   
    ?> 
    <tr>
      <td><?php echo $nomor; ?></td>
      <td>
        <?php 
        if(@$daftar->kategori_bahan=='bahan baku'){
          echo @$daftar->nama_bahan_baku;
        }elseif (@$daftar->kategori_bahan=='produk') {
           echo @$daftar->nama_produk;
        }elseif (@$daftar->kategori_bahan=='perlengkapan') {
           echo @$daftar->nama_perlengkapan;
        }elseif (@$daftar->kategori_bahan=='kartu member') {
           echo 'kartu member';
        }
        ?>  
        </td>
      <td><?php echo @$daftar->expired_date=="0000-00-00"?"-":TanggalIndo(@$daftar->expired_date); ?></td>
      <td><?php echo @$daftar->jumlah.' '.@$daftar->nama; ?></td>
      <td><?php echo format_rupiah(@$daftar->harga_satuan); ?></td>
      <td><?php if(@$daftar->jenis_diskon=='Rupiah'){echo @format_rupiah($daftar->diskon_item);}else{echo @$daftar->diskon_item.' %'; }; ?></td>
      <td><?php echo format_rupiah(@$daftar->subtotal); ?></td>
    
      <td><?php echo get_edit_delete(@$daftar->id); ?></td>
    </tr>
    <?php 
    @$total = $total + @$daftar->subtotal;
    $nomor++; 
  } 
}
?>

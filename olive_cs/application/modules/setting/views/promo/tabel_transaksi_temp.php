<?php
$kode = $this->uri->segment(3);
$this->db->where('kan_suol.opsi_transaksi_produksi.kode_produksi', $kode);
$this->db->from('kan_suol.opsi_transaksi_produksi');
$this->db->join('kan_master.master_barang_dalam_proses', 'kan_suol.opsi_transaksi_produksi.kode_bahan = kan_master.master_barang_dalam_proses.kode_barang', 'left');
$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_produksi.kode_bahan = kan_master.master_produk.kode_produk', 'left');
$this->db->join('kan_master.master_satuan', 'kan_suol.opsi_transaksi_produksi.kode_satuan = kan_master.master_satuan.kode', 'left');
$hasil_data_opsi= $this->db->get()->result();
$nomor = 1;

foreach($hasil_data_opsi as $opsi){
  ?> 
  <tr>
    <td><?php echo $nomor++; ?></td>
    <td>
      <?php 
      if($opsi->kategori_bahan == 'Produk'){
        echo $opsi->nama_produk;
      } else{
        echo $opsi->nama_barang;
      }
      ?>
    </td>
    <td>
      <div id="show_jumlah"><?php echo @$opsi->jumlah.' '.$opsi->alias;?></div>
      <input type="hidden" name="id[]" value="<?php echo $opsi->id_opsi?>">
      <input type="hidden" id="jumlah_produksi" value="<?php echo $opsi->jumlah?>">
      <input type="hidden" id="satuan_bahan" value="<?php echo $opsi->alias?>">
      <input type="hidden" name="jumlah_akhir[]" id="jumlah_akhir" value="<?php echo $opsi->jumlah?>">
      <input type="hidden" name="kategori_bahan[]" id="jumlah_akhir" value="<?php echo $opsi->kategori_bahan?>">
      <input type="hidden" name="kode_bahan[]" id="jumlah_akhir" value="<?php echo $opsi->kode_bahan?>">
    </td>
    <td><input type="text" class='form-control' onkeyup="get_jumlah_akhir(this)" name="barang_rusak[]" placeholder="Barang Rusak" required /></td>
    <td><input type="text" class='form-control' onkeyup="get_jumlah_akhir(this)" name="sample_uji[]" placeholder="Sample Uji" required /></td>
  </tr>
  <?php
}
?>
<script type="text/javascript">
  function get_jumlah_akhir(obj){
    tr = $(obj).parent().parent();
    jumlah_produksi = parseInt(tr.find('#jumlah_produksi').val());
    satuan = tr.find('#satuan_bahan').val();
    barang_rusak = parseInt(tr.find('input[name="barang_rusak[]"]').val());
    sample_uji = parseInt(tr.find('input[name="sample_uji[]"]').val());
    jumlah_akhir = jumlah_produksi;
    if (!isNaN(barang_rusak)) {
      jumlah_akhir = jumlah_akhir - barang_rusak;
    }
    if (!isNaN(sample_uji)) {
      jumlah_akhir = jumlah_akhir - sample_uji;
    }
    tr.find('input[name="jumlah_akhir[]"]').val(jumlah_akhir);
    tr.find('#show_jumlah').text(jumlah_akhir+' '+satuan);
  }
</script>
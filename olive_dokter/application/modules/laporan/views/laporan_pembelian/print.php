<?php 

$bulan = $this->uri->segment(4);
$tahun =  $this->uri->segment(5);

?>
<body onload="window.print()"; onfocus="window.close()">
  <style type="text/css">
  td{
    text-align: center;
  }
</style>
<table  style="width: 100%;font-size:15px">
  <tr>
   <tr>
    <td colspan="8">
     <h2 style="text-align:center">
      LAPORAN PEMBELIAN
    </h2>
    <br>
    <br>
  </td>
</tr>
</tr>

</table>
<br>
<br>
<h5 style="float:right">Bulan : <?php echo BulanIndo($bulan).' '.@$tahun; ?></h5>
<table border="1" style="width: 100%;border-collapse: collapse;">
  <thead>
   <tr>
    <th>NO</th>
    <th>Tanggal</th>
    <th>Kode Pembelian</th>
    <th>Kode PO</th>
    <th>Nomer Nota  </th>
    <th>Pembayaran</th>
    <th>Petugas</th>
  </tr>
</thead>
<tbody id="load_data">
  <?php 

  $no = 0;
  $this->db_kasir->select('*');
  $this->db_kasir->from('transaksi_pembelian');
  $this->db_kasir->join('kan_master.master_user', 'kan_master.master_user.kode_user = kan_kasir.transaksi_pembelian.kode_petugas ');
  $this->db_kasir->where('YEAR(kan_kasir.transaksi_pembelian.tanggal_pembelian) ',$tahun, false);
  $this->db_kasir->where('MONTH(kan_kasir.transaksi_pembelian.tanggal_pembelian) ',$bulan, false);
  $this->db_kasir->where('kan_kasir.transaksi_pembelian.status','selesai');
  $this->db_kasir->order_by('kan_kasir.transaksi_pembelian.id', 'DESC');
  $get_produksi = $this->db_kasir->get()->result();
  foreach ($get_produksi as $value) { $no++ ?>  
  <tr>
    <td><?= $no ?></td>
    <td><?= @TanggalIndo($value->tanggal_pembelian) ?></td>
    <td><?= @$value->kode_pembelian ?></td>
    <td><?= @$value->kode_po ?></td>
    <td><?= @$value->nomor_nota ?></td>
    <td><?= @format_rupiah($value->nominal_grand_total) ?></td>
    <td><?= @$value->nama_user ?></td>
  </tr>
  <?php }
  ?>

</tbody>
</table>
</body>

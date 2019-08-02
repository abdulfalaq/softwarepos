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
      LAPORAN PIUTANG
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
      <th>Tanggal Transaksi</th>
      <th>Tanggal Jatuh Tempo</th>
      <th>Nama Member</th>
      <th>Nominal Piutang</th>
      <th>Sisa Angsuran</th>
      <th>Petugas</th>
    </tr>
  </thead>
  <tbody id="load_data">
    <?php 

    $no = 0;
    $this->db_kasir->select('*');
    $this->db_kasir->from('transaksi_piutang');
    $this->db_kasir->join('kan_master.master_user', 'kan_master.master_user.kode_user = kan_kasir.transaksi_piutang.kode_petugas ');
    $this->db_kasir->join('kan_master.master_member', 'kan_master.master_member.kode_member = kan_kasir.transaksi_piutang.kode_member ');
    $this->db_kasir->where('kan_kasir.transaksi_piutang.status_piutang','selesai');
    $this->db_kasir->where('YEAR(kan_kasir.transaksi_piutang.tanggal_transaksi) ',$tahun, false);
    $this->db_kasir->where('MONTH(kan_kasir.transaksi_piutang.tanggal_transaksi) ',$bulan, false);
    $this->db_kasir->order_by('kan_kasir.transaksi_piutang.id', 'DESC');
    $get_produksi = $this->db_kasir->get()->result();
    foreach ($get_produksi as $value) { $no++ ?>  
    <tr>
      <td><?php echo $no ?></td>
      <td><?php echo @TanggalIndo($value->tanggal_transaksi) ?></td>
      <td><?php echo @TanggalIndo($value->tanggal_jatuh_tempo) ?></td>
      <td><?php echo @$value->nama_pic ?></td>
      <td><?php echo @format_rupiah($value->nominal_piutang) ?></td>
      <td><?php echo @format_rupiah($value->sisa) ?></td>
      <td><?php echo @$value->nama_user ?></td>
    </tr>
    <?php }
    ?>

  </tbody>
</table>
</body>

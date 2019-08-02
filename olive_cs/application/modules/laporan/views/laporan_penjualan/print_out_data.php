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
            LAPORAN PENJUALAN
          </h2>
        </td>
      </tr>
    </tr>

  </table>
  <h5 style="float:right">Bulan : <?php echo BulanIndo($bulan).' '.@$tahun; ?></h5>
  <table width="100%" class="table" border="1" style="border-collapse:collapse;">
    <thead>
      <tr>
        <th>NO</th>
        <th>Kode Produksi</th>
        <th>Tanggal Perintah Produksi</th>
        <th>Tanggal Produksi</th>
        <th>Jenis Sample</th>
        <th>Petugas</th>
      </tr>        
    </thead>

    <tbody>
      <?php
      $no = 0;
      $this->db->select('*');
      $this->db->from('transaksi_penjualan');
      $this->db->join('kan_master.master_user', 'kan_master.master_user.kode_user = kan_suol.transaksi_penjualan.kode_petugas ');
      $this->db->order_by('kan_suol.transaksi_penjualan.id', 'DESC');
      $this->db->where('YEAR(kan_suol.transaksi_penjualan.tanggal_penjualan) ',$tahun, false);
      $this->db->where('MONTH(kan_suol.transaksi_penjualan.tanggal_penjualan) ',$bulan, false);
      $this->db->where('kan_suol.transaksi_penjualan.status','selesai');
      $get_produksi = $this->db->get()->result();
      foreach ($get_produksi as $value) { $no++ ?>
      <tr>
        <td><?= $no ?></td>
        <td><?= $value->tanggal_penjualan ?></td>
        <td><?= $value->kode_penjualan ?></td>
        <td><?= $value->kode_transaksi ?></td>
        <td><?= $value->nama_user ?></td>
        <td><?= $value->grand_total ?></td>
      </tr>
      <?php }
      ?>

    </tbody>
  </table>
  <br>
</tbody>
</table>
<br>
</body>

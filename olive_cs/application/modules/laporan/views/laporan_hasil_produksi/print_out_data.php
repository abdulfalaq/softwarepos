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
          LAPORAN HASIL PRODUKSI
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
<table width="100%" class="table" border="1" style="border-collapse:collapse;">
  <thead>
   <tr>
    <th>NO</th>
    <th>Kode Produksi</th>
    <th>Tanggal Perintah Produksi</th>
    <th>Tanggal Produksi</th>
    <th>Jenis Sample</th>
    <th>Petugas</th>
    <th>Kode Unit Jabung</th>
  </tr>        
</thead>

<tbody>
 <?php
 $no = 0;
 $this->db->select('*');
 $this->db->from('transaksi_produksi');
 $this->db->join('kan_master.master_unit', 'kan_master.master_unit.kode_unit = kan_suol.transaksi_produksi.kode_unit_jabung ');
 $this->db->join('kan_master.master_user', 'kan_master.master_user.kode_user = kan_suol.transaksi_produksi.kode_petugas ');
 $this->db->order_by('kan_suol.transaksi_produksi.id', 'DESC');
 $this->db->where('YEAR(kan_suol.transaksi_produksi.tanggal_produksi) ',$tahun, false);
 $this->db->where('MONTH(kan_suol.transaksi_produksi.tanggal_produksi) ',$bulan, false);
 $this->db->where('kan_suol.transaksi_produksi.status','valid');
 $get_produksi = $this->db->get()->result();  
 foreach ($get_produksi as $value) { $no++ ?>
 <tr>
  <td><?= $no ?></td>
  <td><?= $value->kode_produksi ?></td>
  <td><?= $value->tanggal_perintah_produksi ?></td>
  <td><?= $value->tanggal_produksi ?></td>
  <td><?= $value->jenis_sample ?></td>
  <td><?= $value->nama_user ?></td>
  <td><?= $value->nama_unit ?></td>
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

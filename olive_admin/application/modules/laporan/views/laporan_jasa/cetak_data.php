<!DOCTYPE html>
<head>
	<title>Laporan Jasa Terapis
</title>
</head>
<body onload="window.print()">
	<h1 style="text-align: center">Laporan Jasa Terapis
</h1>
	<br>
	<table style="width:100%;padding-left:5px;border-collapse:collapse;font-size:18px" border="1">
		<thead>
    <tr>
      <th width="50px;">No</th>
      <th>Kode Terapis</th>
      <th>Nama Terapis</th>
      <th>Treatment</th>
      <th>Jumlah</th>
      <th>Nominal Insentif</th>
      <th>Total</th>
    </tr>
  </thead>              
  <tbody>
    <?php
    $tgl_awal=$this->uri->segment(4);
    $tgl_akhir=$this->uri->segment(5);
    $data = $this->input->post(); 
    $this->db->group_by('kode_terapis');
    $this->db->join('clouoid1_olive_master.master_karyawan','clouoid1_olive_master.master_karyawan.kode_karyawan = clouoid1_olive_kasir.opsi_transaksi_layanan.kode_terapis','left');
    $get_terapis = $this->db->get_where('clouoid1_olive_kasir.opsi_transaksi_layanan',array('kode_terapis !=' => ''));
    $hasil_terapis = $get_terapis->result();
    $no=1;
    foreach ($hasil_terapis as $value) {

      $this->db->group_by('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item');
      $this->db->select_sum('clouoid1_olive_kasir.opsi_transaksi_layanan.qty');
      $this->db->select_sum('clouoid1_olive_keuangan.insentif_terapis.total_withdraw');
      $this->db->select('clouoid1_olive_master.master_perawatan.nama_perawatan');
      $this->db->select('clouoid1_olive_master.master_perawatan.insentif_terapi');
      $this->db->where('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_terapis',$value->kode_terapis);
      $this->db->where('clouoid1_olive_keuangan.insentif_terapis.tanggal_transaksi >=',@$tgl_awal);
      $this->db->where('clouoid1_olive_keuangan.insentif_terapis.tanggal_transaksi <=',@$tgl_akhir);

      $this->db->from('clouoid1_olive_kasir.opsi_transaksi_layanan');
      $this->db->join('clouoid1_olive_master.master_perawatan', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_master.master_perawatan.kode_perawatan', 'left');
      $this->db->join('clouoid1_olive_keuangan.insentif_terapis', 'clouoid1_olive_keuangan.insentif_terapis.kode_transaksi = clouoid1_olive_kasir.opsi_transaksi_layanan.kode_transaksi', 'left');
      $get_treatment= $this->db->get();
      $hasil_treatment = $get_treatment->result();
      $list=1;
      $total_terapis=0;
      foreach ($hasil_treatment as  $treatment) {
        $total_terapis +=$treatment->qty * $treatment->total_withdraw;
        if($list==1){
          ?>
          <tr>
            <td rowspan="<?php echo count($hasil_treatment);?>"><?php echo $no++?></td>
            <td rowspan="<?php echo count($hasil_treatment);?>"><?php echo $value->kode_terapis;?></td>
            <td rowspan="<?php echo count($hasil_treatment);?>"><?php echo $value->nama_karyawan;?></td>
            <td><?php echo $treatment->nama_perawatan;?></td>
            <td><?php echo $treatment->qty;?></td>
            <td style="text-align: right;"><?php echo @format_rupiah($treatment->total_withdraw);?></td>
            <td style="text-align: right;"><?php echo @format_rupiah($treatment->qty * $treatment->total_withdraw);?></td>
          </tr>
          <?php
        }else{
          ?>
          <tr>
            <td><?php echo $treatment->nama_perawatan;?></td>
            <td><?php echo $treatment->qty;?></td>
            <td style="text-align: right;"><?php echo @format_rupiah($treatment->total_withdraw);?></td>
            <td style="text-align: right;"><?php echo @format_rupiah($treatment->qty * $treatment->total_withdraw);?></td>
          </tr>
          <?php
        }
        $list++;
      }
      ?>
      <tr>
        <th colspan="6" style="text-align: right;">Total</th>
        <th style="text-align: right;"><?php echo @format_rupiah($total_terapis);?></th>
      </tr>
      <?php
    }
    ?>                
  </tbody>

	</table>

</body>
</html>
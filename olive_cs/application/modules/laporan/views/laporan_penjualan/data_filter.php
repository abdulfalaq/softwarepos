
<?php 
$data = $this->input->post();

$tgl 	= date('Y-m',strtotime($data['bulan_report']));
$bulan 	= date('m',strtotime($tgl));
$tahun 	= date('Y',strtotime($tgl));


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


<input type="hidden" value="<?= $bulan ?>" id="bulan">
<input type="hidden" value="<?= $tahun ?>" id="tahun">

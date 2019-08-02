
<?php 
$data = $this->input->post();

$tgl 	= date('Y-m',strtotime($data['bulan_report']));
$bulan 	= date('m',strtotime($tgl));
$tahun 	= date('Y',strtotime($tgl));

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

<input type="hidden" value="<?= $bulan ?>" id="bulan">
<input type="hidden" value="<?= $tahun ?>" id="tahun">

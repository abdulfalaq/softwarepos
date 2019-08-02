<?php 

$data = $this->input->post();

$tgl 	= date('Y-m',strtotime($data['bulan_report']));
$bulan 	= date('m',strtotime($tgl));
$tahun 	= date('Y',strtotime($tgl));


$no = 0;
$this->db_kasir->select('*');
$this->db_kasir->from('transaksi_hutang');
$this->db_kasir->join('kan_master.master_supplier', 'kan_master.master_supplier.kode_supplier = kan_kasir.transaksi_hutang.kode_supplier ','left');
$this->db_kasir->join('kan_master.master_user', 'kan_master.master_user.kode_user = kan_kasir.transaksi_hutang.kode_petugas ','left');
$this->db_kasir->where('kan_kasir.transaksi_hutang.status_hutang','selesai');
$this->db_kasir->where('YEAR(kan_kasir.transaksi_hutang.tanggal_transaksi) ',$tahun, false);
$this->db_kasir->where('MONTH(kan_kasir.transaksi_hutang.tanggal_transaksi) ',$bulan, false);
$this->db_kasir->order_by('kan_kasir.transaksi_hutang.id', 'DESC');
$get_produksi = $this->db_kasir->get()->result();
foreach ($get_produksi as $value) { $no++ ?>	
<tr>
	<td><?= $no ?></td>
	<td><?= @TanggalIndo($value->tanggal_transaksi) ?></td>
	<td><?= @$value->kode_hutang ?></td>
	<td><?= @$value->nama_supplier ?></td>
	<td><?= @$value->nama_user ?></td>
	<td><?= format_rupiah(@$value->nominal_hutang) ?></td>
</tr>
<?php }
?>

<input type="hidden" value="<?= $bulan ?>" id="bulan">
<input type="hidden" value="<?= $tahun ?>" id="tahun">
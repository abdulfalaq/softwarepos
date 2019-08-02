<?php 

$data = $this->input->post();

$tgl 	= date('Y-m',strtotime($data['bulan_report']));
$bulan 	= date('m',strtotime($tgl));
$tahun 	= date('Y',strtotime($tgl));


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
<input type="hidden" value="<?= $bulan ?>" id="bulan">
<input type="hidden" value="<?= $tahun ?>" id="tahun">
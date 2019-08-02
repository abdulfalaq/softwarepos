<?php 

$data = $this->input->post();

$tgl 	= date('Y-m',strtotime($data['bulan_report']));
$bulan 	= date('m',strtotime($tgl));
$tahun 	= date('Y',strtotime($tgl));


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
<input type="hidden" value="<?= $bulan ?>" id="bulan">
<input type="hidden" value="<?= $tahun ?>" id="tahun">

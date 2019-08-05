<!DOCTYPE html>
<head>
	<title>Laporan Transaksi</title>
</head>
<body onload="window.print()">
	<h1 style="text-align: center">Laporan Transaksi</h1>
	<?php
	$tgl_awal=$this->uri->segment(4);
	$tgl_akhir=$this->uri->segment(5);

	if(!empty($tgl_awal) && !empty($tgl_akhir)){
	$this->db->where('tanggal_transaksi >=', $tgl_awal);
	$this->db->where('tanggal_transaksi <=', $tgl_akhir);
}
$this->db->select_sum('grand_total');
$get_transaksi_tunai=$this->db->get_where('clouoid1_olive_kasir.transaksi_layanan',array('jenis_transaksi' =>'tunai'));
$hasil_transaksi_tunai=$get_transaksi_tunai->row();

if(!empty($tgl_awal) && !empty($tgl_akhir)){
	$this->db->where('tanggal_transaksi >=', $tgl_awal);
	$this->db->where('tanggal_transaksi <=', $tgl_akhir);
}
$this->db->select_sum('grand_total');
$get_transaksi_debit=$this->db->get_where('clouoid1_olive_kasir.transaksi_layanan',array('jenis_transaksi' =>'debit'));
$hasil_transaksi_debit=$get_transaksi_debit->row();

if(!empty($tgl_awal) && !empty($tgl_akhir)){
	$this->db->where('tanggal_transaksi >=', $tgl_awal);
	$this->db->where('tanggal_transaksi <=', $tgl_akhir);
}
$this->db->select_sum('grand_total');
$get_transaksi_cc=$this->db->get_where('clouoid1_olive_kasir.transaksi_layanan',array('jenis_transaksi' =>'kredit'));
$hasil_transaksi_cc=$get_transaksi_cc->row();

$total_transaksi=$hasil_transaksi_tunai->grand_total + $hasil_transaksi_debit->grand_total +$hasil_transaksi_cc->grand_total;

if(!empty($tgl_awal) && !empty($tgl_akhir)){
	$this->db->where('tanggal_transaksi >=', $tgl_awal);
	$this->db->where('tanggal_transaksi <=', $tgl_akhir);
}
$this->db->select_sum('subtotal');
$this->db->where('jenis_item', 'Treatment');
$this->db->from('clouoid1_olive_kasir.opsi_transaksi_layanan');
$this->db->join('clouoid1_olive_kasir.transaksi_layanan', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_transaksi = clouoid1_olive_kasir.transaksi_layanan.kode_transaksi', 'left');
$get_omset_treatment=$this->db->get();
$hasil_omset_treatment=$get_omset_treatment->row();

if(!empty($tgl_awal) && !empty($tgl_akhir)){
	$this->db->where('tanggal_transaksi >=', $tgl_awal);
	$this->db->where('tanggal_transaksi <=', $tgl_akhir);
}
$this->db->select_sum('subtotal');
$this->db->where('jenis_item !=', 'Treatment');
$this->db->where('jenis_item !=', 'kartu member');
$this->db->from('clouoid1_olive_kasir.opsi_transaksi_layanan');
$this->db->join('clouoid1_olive_kasir.transaksi_layanan', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_transaksi = clouoid1_olive_kasir.transaksi_layanan.kode_transaksi', 'left');
$get_omset_produk=$this->db->get();
$hasil_omset_produk=$get_omset_produk->row();

if(!empty($tgl_awal) && !empty($tgl_akhir)){
	$this->db->where('tanggal_transaksi >=', $tgl_awal);
	$this->db->where('tanggal_transaksi <=', $tgl_akhir);
}
$this->db->where('jenis_item', 'kartu member');
$this->db->select_sum('subtotal');
$this->db->from('clouoid1_olive_kasir.opsi_transaksi_layanan');
$this->db->join('clouoid1_olive_kasir.transaksi_layanan', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_transaksi = clouoid1_olive_kasir.transaksi_layanan.kode_transaksi', 'left');
$get_omset_member=$this->db->get();
$hasil_omset_member=$get_omset_member->row();

if(!empty($tgl_awal) && !empty($tgl_akhir)){
	$this->db->where('tanggal_transaksi >=', $tgl_awal);
	$this->db->where('tanggal_transaksi <=', $tgl_akhir);
}
$this->db->where('clouoid1_olive_kasir.opsi_transaksi_layanan.jenis_diskon !=', '');
$this->db->from('clouoid1_olive_kasir.opsi_transaksi_layanan');
$this->db->join('clouoid1_olive_kasir.transaksi_layanan', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_transaksi = clouoid1_olive_kasir.transaksi_layanan.kode_transaksi', 'left');
$get_opsi_layanan=$this->db->get();
$hasil_opsi_layanan=$get_opsi_layanan->result();
$total_diskon=0;
foreach ($hasil_opsi_layanan as $opsi) {
	if($opsi->jenis_diskon=='persen' || $opsi->jenis_diskon=='Persen'){
		$total_diskon +=(($opsi->qty * $opsi->harga) * $opsi->diskon_persen)/100;
	}else{
		$total_diskon +=$opsi->diskon_rupiah;
	}
}
	?>
	<br>
	<table style="width:100%;padding-left:5px;border-collapse:collapse;font-size:18px" border="1">
		<thead>
			<tr>
				<th width="30%">Keterangan</th>
				<th>Nominal</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Tunai</td>
				<td align="right"><?php echo @format_rupiah($hasil_transaksi_tunai->grand_total);?></td>
			</tr>
			<tr>
				<td>Debit</td>
				<td align="right"><?php echo @format_rupiah($hasil_transaksi_debit->grand_total);?></td>
			</tr>
			<tr>
				<td>CC</td>
				<td align="right"><?php echo @format_rupiah($hasil_transaksi_cc->grand_total);?></td>
			</tr>
			<tr>
				<td><b>Total</b></td>
				<td align="right"><b><?php echo @format_rupiah($total_transaksi);?></b></td>
			</tr>
			<tr>
				<td>Omset Treatment</td>
				<td align="right"><?php echo @format_rupiah($hasil_omset_treatment->subtotal);?></td>
			</tr>
			<tr>
				<td>Omset Produk</td>
				<td align="right"><?php echo @format_rupiah($hasil_omset_produk->subtotal);?></td>
			</tr>
			<tr>
				<td>Omset Member</td>
				<td align="right"><?php echo @format_rupiah($hasil_omset_member->subtotal);?></td>
			</tr>
			<tr>
				<td><b>Total Diskon</b></td>
				<td align="right"><b><?php echo @format_rupiah($total_diskon);?></b></td>
			</tr>
		</tbody>                
	</table>
	<div class="row">

	</div>
</div>
<br>
<div class="panel panel-default">
	<div class="panel-heading text-right">
		<span class="pull-left" style="font-size: 24px">Pembatalan</span>
		<br>
		<br>
	</div>
	<div class="panel-body">
		<table style="width:100%;padding-left:5px;border-collapse:collapse;font-size:18px" border="1">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Transaksi</th>
					<th>Total Nominal</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$this->db->group_by('kode_transaksi');
				$this->db->select('kode_transaksi');
				$this->db->select_sum('subtotal');
				$get_batal=$this->db->get('clouoid1_olive_kasir.opsi_transaksi_batal');
				if (!empty($tgl_awal)) {
					$this->db->where('clouoid1_olive_kasir.opsi_transaksi_batal.tanggal_transaksi >=',$tgl_awal);
				}
				if (!empty($tgl_akhir)) {
					$this->db->where('clouoid1_olive_kasir.opsi_transaksi_batal.tanggal_transaksi <=',$tgl_akhir);
				}
				$hasil_batal=$get_batal->result();
				$no=1;
				foreach ($hasil_batal as $value) {
					?>
					<tr>
						<td><?php echo $no++?></td>
						<td><?php echo @$value->kode_transaksi;?></td>
						<td><?php echo @format_rupiah($value->subtotal);?></td>
					</tr>
					<?php
				}
				?>


			</tbody>                
		</table>
	</body>
	</html>

<?php
$kode_member=$this->uri->segment(4);
$this->db->from('clouoid1_olive_kasir.data_record_anggota');
$this->db->where('clouoid1_olive_kasir.data_record_anggota.kode_member', @$kode_member);
$this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_kasir.data_record_anggota.kode_item = master_produk.kode_produk', 'left');
$this->db->join('clouoid1_olive_master.master_perawatan','clouoid1_olive_master.master_perawatan.kode_perawatan = clouoid1_olive_kasir.data_record_anggota.kode_item','left');
$data_record = $this->db->get()->result();
foreach ($data_record as $data) {
	?>
	<tr>
		<td><?php echo TanggalIndo($data->tanggal_transaksi);?></td>
		<td><?php echo @$data->nama_perawatan; echo @$data->nama_produk ?></td>
		<td><?php echo $data->qty;?></td>
	</tr>
	<?php
}
?>


<?php
$kode_member=$this->uri->segment(3);
$this->db->where('kode_member', @$kode_member);
$this->db->from('olive_kasir.data_record_anggota');
$this->db->join('olive_master.master_produk', 'olive_kasir.data_record_anggota.kode_item = master_produk.kode_produk', 'left');
$data_rekam_medis=$this->db->get()->result();
foreach ($data_rekam_medis as $data) {
	?>
	<tr>
		<td><?php echo @TanggalIndo($data->tanggal_transaksi);?></td>
		<td><?php echo @$data->nama_produk;?></td>
		<td><?php echo @$data->qty;?></td>
	</tr>
	<?php
}
?>

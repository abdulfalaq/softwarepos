<?php
$kode_event=$this->uri->segment(4);
$this->db->where('kan_suol.opsi_transaksi_penjualan_event_temp.kode_event', $kode_event);
$this->db->from('kan_suol.opsi_transaksi_penjualan_event_temp');
$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_penjualan_event_temp.kode_produk = kan_master.master_produk.kode_produk', 'left');
$this->db->join('kan_master.master_satuan', 'kan_master.master_produk.kode_satuan_stok = kan_master.master_satuan.kode', 'left');
$get_temp=$this->db->get('');
$hasil_temp=$get_temp->result();
$no=1;
foreach ($hasil_temp as $temp) {
	?>
	<tr>
		<td><?php echo $no++;?></td>
		<td><?php echo @$temp->nama_produk;?></td>
		<td><?php echo @$temp->jumlah.' '.@$temp->nama;?></td>
		<td><?php echo @TanggalIndo($temp->tanggal_expired);?></td>
		<td><?php echo @get_edit_delete($temp->id_temp);?></td>
	</tr>
	<?php
}
?>

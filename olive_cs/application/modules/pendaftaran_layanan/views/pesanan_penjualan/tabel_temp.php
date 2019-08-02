<?php
$kode_pesanan=$this->uri->segment(4);
$this->db->where('kan_suol.opsi_transaksi_penjualan_pesanan_temp.kode_pesanan', $kode_pesanan);
$this->db->from('kan_suol.opsi_transaksi_penjualan_pesanan_temp');
$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_penjualan_pesanan_temp.kode_produk = kan_master.master_produk.kode_produk', 'left');
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
		<td><?php echo @format_rupiah($temp->harga_satuan);?></td>
		<td><?php echo @format_rupiah($temp->subtotal);?></td>
		<td>
			<?php 
			if(@$temp->jenis_diskon=='persen'){
				echo @$temp->diskon_persen.'%';
			}else{
				echo @format_rupiah($temp->diskon_rupiah);
			}
			?>
		</td>
		<td><?php echo @TanggalIndo($temp->tanggal_expired);?></td>
		<td><?php echo @get_edit_delete($temp->id_temp);?></td>
	</tr>
	<?php
}
?>
